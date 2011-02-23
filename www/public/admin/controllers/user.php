<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../bootstrap.php';
require_once(SITE_ADMIN_PATH.'controllers/session_bootstrap.php');
$sessions = $GLOBALS['Session']->getSessions();
require_once(SITE_CORE_PATH.'/privileges_check.class.php');
require_once(SITE_CORE_PATH.'/method_cache_manager.class.php');
require_once(SITE_CORE_PATH.'/user.class.php');
$tpl = new TemplateAdmin(TEMPLATE_ADMIN);

//$tpl->assign('users',$users);
//$tpl->assign('usersjson',$usersjson);
$action = (isset($_GET[ 'action' ])) ? $_GET[ 'action' ] : "";


    switch($action) {
        case 'list_ajax': {
            $user = new User();
            $users = $user->get_users();
            $usersjson = json_encode($users);
            Application::ajax_out($usersjson);
        }break;

        case 'create': {
           $tpl->display('user/user_create_update.tpl');
        }break;

        case 'update': {
           $tpl->display('user/user_create_update.tpl');
        }break;


        default : {
            $user = new User();
            $users = $user->get_users();
            $usersjson = json_encode($users);
            $tpl->display('user/users_list.tpl');
        }break;
    }
?>
