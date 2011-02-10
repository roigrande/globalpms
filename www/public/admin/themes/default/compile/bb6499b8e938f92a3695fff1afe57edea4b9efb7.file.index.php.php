<?php /* Smarty version Smarty-3.0.6, created on 2011-02-10 12:32:02
         compiled from "index.php" */ ?>
<?php /*%%SmartyHeaderCode:6963592744d53ccb2193cb9-22040921%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb6499b8e938f92a3695fff1afe57edea4b9efb7' => 
    array (
      0 => 'index.php',
      1 => 1297337521,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6963592744d53ccb2193cb9-22040921',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<<?php ?>?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../bootstrap.php';
require_once(SITE_ADMIN_PATH.'controllers/session_bootstrap.php');
$sessions = $GLOBALS['Session']->getSessions();
require_once(SITE_ADMIN_CORE_PATH.'/privileges_check.class.php');
require_once(SITE_ADMIN_CORE_PATH.'/method_cache_manager.class.php');
require_once(SITE_ADMIN_CORE_PATH.'/user.class.php');


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
            $tpl->display('users.tpl');
        } break;
        default :{
            $tpl->display('index.php');
            } break;
    }
} else {
  echo"holaaaaaaaaaaaa";
    $tpl->display('index.php');
}
?<?php ?>>
