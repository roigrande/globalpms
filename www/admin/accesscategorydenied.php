<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

Application::import_libs('*');
//$app = Application::load();

require_once('session_bootstrap.php');

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('linkReturn', $_SESSION['lasturlcategory']);
$tpl->assign('category', $_REQUEST['category']);
$tpl->display('accesscategorydenied.tpl');