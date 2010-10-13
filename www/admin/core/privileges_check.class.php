<?php
require_once('core/application.class.php');

// TODO: documentar

class Privileges_check
{    

    public static function CheckAccessCategories($CategoryId)
        {                
        try {
            if(!isset($CategoryId) || empty($CategoryId)) {
                $_SESSION['lasturlcategory'] = $_SERVER['REQUEST_URI'];
                return true;
            }
            
            if( isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] ) {
                return true;
            }
            
            if( !isset($_SESSION['accesscategories']) || 
                empty($_SESSION['accesscategories'])  ||
                !in_array($CategoryId,$_SESSION['accesscategories']))
                return false;
                 
        } catch(Exception $e) {
            return false;
        }
        
        $_SESSION['lasturlcategory'] = $_SERVER['REQUEST_URI'];
        return true;
    }


    public static function CheckPrivileges($Privilege)
    {
        try {
            if( !isset($_SESSION['userid']) || Privileges_check::CheckSessionExpireTime() ) {
                Privileges_check::SessionExpireTimeAction();
            }
            
            if( isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] ) {
                return true;
            }
            
            if( !isset($_SESSION['privileges']) ||
                empty($_SESSION['userid']) ||
                !in_array($Privilege,$_SESSION['privileges'])) {                
                    return false;
            }
            
        } catch(Exception $e) {
            return false;
        }
        
        $_SESSION['lasturl'] = $_SERVER['REQUEST_URI'];
        return true;
    }

    private static function SessionExpireTimeAction() {
        Application::forwardTargetParent("/admin/login.php");
    }

    public static function AccessDeniedAction() {
        Application::forward('/admin/accessdenied.php'.'?action=list_pendientes&category='.$_REQUEST['category']);
    }

    public static function AccessCategoryDeniedAction() {
        Application::forward('/admin/accesscategorydenied.php');
    }

    public static function LoadSessionExpireTime() {
        if(isset($_SESSION) && isset($_SESSION['default_expire'])) {
            $_SESSION['expire'] = time()+($_SESSION['default_expire']*60);
        }
    }

    private static function CheckSessionExpireTime() {    
        if(time() > $_SESSION['expire']) {
            session_destroy(); 
            unset($_SESSION);
            return true;
        }
        //Actuliza la sesion
        Privileges_check::LoadSessionExpireTime();
        return false;
    }

    // Comprobación de session caducada y privilegios
    function HandleError($errno, $errstr, $errfile, $errline) {
        //no difference between excpetions and E_WARNING
        /*echo "<pre>user error handler:<il><li>e_warning=".E_WARNING."<li>num=".$errno." <li>msg=".$errstr.
            " <li>line=".$errline." <li>file=".$errfile."</il></pre>\n\n\n";*/
        throw new Exception($errstr, $errno);
        return true;
        //change to return false to make the "catch" block execute;
    }

    function InitHandleErrorPrivileges() {
        set_error_handler('handleError');
    }
}

/**
 * Shortcut static class to test privileges
 * 
 */
class Acl
{
    /**
     * Shortcut to check privilege
     * 
     * @see Privileges_check::CheckPrivileges()
     * @param string $rule
     * @param string $module
     * @return boolean
    */
    public static function _($rule, $module=null)
    {
        if(!is_null($module)) {
            $rule = strtoupper($module) . '_' . strtoupper($rule);
        }
        
        return Privileges_check::CheckPrivileges($rule);
    }
    
    /**
     * Shortcut to check access to category
     *
     * @see Privileges_check::CheckAccessCategories()
     * @param string $category
     * @return boolean
    */
    public static function _C($category)
    {
        return Privileges_check::CheckAccessCategories($category);
    }
    
    public static function deny($message='Acceso no permitido')
    {
        if(strlen($message) > 0) {
            $message = new Message($message, 'error');
            $message->push();
        }        
        
        Application::forward('welcome.php');
    }
}


