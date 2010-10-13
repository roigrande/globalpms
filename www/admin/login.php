<?php
//error_reporting(E_ALL);
require_once('./config.inc.php');
require_once('./core/application.class.php');
require_once('./core/user.class.php');
require_once('./core/user_group.class.php');
require_once('./core/content_category.class.php');
require_once('./core/privilege.class.php');
require_once('./core/privileges_check.class.php');

require_once('./core/method_cache_manager.class.php');

Application::import_libs('*');
$app = Application::load();

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);

if( isset($_REQUEST['action'])){
	switch($_REQUEST['action']) {

		case 'login':
            $user = new User();
            
            $token   = (isset($_REQUEST['token']))?   $_REQUEST['token']:   null;
            $captcha = (isset($_REQUEST['captcha']))? $_REQUEST['captcha']: null;
            
            $result = $user->login($_REQUEST['login'], $_REQUEST['password'], $token, $captcha);

            if ($result === true) { // must be same type (===)
                
                if( isset($_REQUEST['rememberme']) ) {
                    // Use long expression of setcookie to have more security
                    /*
                      setcookie("login", $_REQUEST['login'], time()+3600, "/admin/", ".dominio.com", TRUE, TRUE);
                      setcookie("password", $_REQUEST['password'], time()+3600, "/admin/", ".dominio.com", TRUE, TRUE);
                    */
                    
                    $app->setcookie_secure("login_username", $_REQUEST['login'],    time()+60*60*24*30, '/admin/');
                    $app->setcookie_secure("login_password", $_REQUEST['password'], time()+60*60*24*30, '/admin/');
                    
                    
                } else {
                    if( isset($_COOKIE['login_username']) ) {
                        // Caducar a cookie
                        setcookie("login_username", '', time()-(60*60) );
                        setcookie("login_password", '', time()-(60*60) );
                    }
                }
                
                // Load session
                require_once('session_bootstrap.php');                
                
                $_SESSION = array(); // Clear before to load
                
                $_SESSION['userid']     = $user->id;
                $_SESSION['username']   = $user->login;
                $_SESSION['email']      = $user->email;                
                // SYS_NAME_GROUP_ADMIN defined into config.inc.php
                $_SESSION['isAdmin']    = ( User_group::getGroupName($user->fk_user_group)==SYS_NAME_GROUP_ADMIN ); 
                $_SESSION['privileges'] = Privilege::get_privileges_by_user($user->id);
                $_SESSION['accesscategories'] = $user->get_access_categories_id();
                
                // Method authentication: database|google_clientlogin
                $_SESSION['authMethod'] = $user->authMethod;
                if($user->authMethod == 'google_clientlogin') {
                    $_SESSION['authGmail']  = base64_encode($_REQUEST['login'].':'.$_REQUEST['password']);
                    /* $_SESSION['loginToken'] = $user->clientLoginToken;
                    $_SESSION['passwd'] = $_REQUEST['password']; */
                }
                
                //Carga en la varible de _SESSION expire el tiempo de expiración del usuario la sesión.
                $_SESSION['default_expire'] = $user->sessionexpire;
                $app->setcookie_secure('default_expire', $user->sessionexpire, 0, '/admin/');                
                
                Privileges_check::loadSessionExpireTime();                                                            
                
                //initHandleErrorPrivileges();
                Application::forward(SITE_URL.'admin/index.php');
            } else {                
                // Show google captcha
                if(isset($result['token'])) {
                    $tpl->assign('token', $result['token']);
                    $tpl->assign('captcha', $result['captcha']);
                }
                
                $tpl->assign('message', 'Nome de usuario ou contrasinal incorrecto.');
            }
        break;
	}
}


$tpl->display('login.tpl');

