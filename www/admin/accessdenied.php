<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

require_once('core/application.class.php');

Application::import_libs('*');
//$app = Application::load();


$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('linkReturn', $_SESSION['lasturl']);
$tpl->display('accessdenied.tpl');


