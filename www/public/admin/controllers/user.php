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
$tpl->display('user/user.tpl');

?>
