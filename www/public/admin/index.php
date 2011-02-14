<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../bootstrap.php';
require_once(SITE_ADMIN_PATH.'controllers/session_bootstrap.php');
$sessions = $GLOBALS['Session']->getSessions();
require_once(SITE_CORE_PATH.'/privileges_check.class.php');
require_once(SITE_CORE_PATH.'/method_cache_manager.class.php');
require_once(SITE_CORE_PATH.'/user.class.php');


//var_dump($GLOBALS['Session']);
//Application::forward($server.'?action=list');
$action       = filter_input(INPUT_GET,'action');
// example smarty and adobd
/*
$sql = 'SELECT * FROM workers WHERE pk_worker = 2';
        $rs = $GLOBALS['application']->conn->Execute( $sql );

        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return;
        }
*/
$tpl = new TemplateAdmin(TEMPLATE_ADMIN);

if( $action != null ) {

    switch($action) {
        case 'users': {
                Application::forward($server.'controllers/user.php');
        } break;
        default :{         
            $tpl->display('index.tpl');         
            } break;
    }
} else {
    $tpl->display('index.tpl');

}

?>
