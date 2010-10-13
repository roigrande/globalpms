<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

require_once('core/application.class.php');

function checkPrivileges($Privilege) {
    try {

        if( !isset($_SESSION['userid']) ||
            expire_session())
        {
            //Application::forward($_SERVER['SITE_URL_ADMIN']);
            Application::forwardTargetParent("/admin/login.php");
        }

        if( !isset($_SESSION['privileges']) ||
            empty($_SESSION['userid']) ||
            !in_array($Privilege,$_SESSION['privileges']))
        {
            return false;
        }
    }catch(Exception $e)
    { 
        return false;
    }
    return true;
}


// Comprobación de session caducada y privilegios
function handleError($errno, $errstr, $errfile, $errline)
{
    //no difference between excpetions and E_WARNING
    /*echo "<pre>user error handler:<il><li>e_warning=".E_WARNING."<li>num=".$errno." <li>msg=".$errstr.
        " <li>line=".$errline." <li>file=".$errfile."</il></pre>\n\n\n";*/
    throw new Exception($errstr, $errno);
    return true;
    //change to return false to make the "catch" block execute;
}

function initHandleErrorPrivileges()
{
    set_error_handler('handleError');
}

function loadTimeExpireSession()
{
    $_SESSION['expire']=time()+(45*60);
}

function expire_session()
{
	if(time() > $_SESSION['expire'])
	{
        session_destroy();
        unset($_SESSION);
        return true;
	}
	//Actuliza la sesion
    loadTimeExpireSession();
	return false;
}

?>
