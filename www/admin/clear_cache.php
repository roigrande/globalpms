<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

require_once('core/application.class.php');

Application::import_libs('*');
$app = Application::load();

$tpl = new Template(TEMPLATE_USER);
$tpl->clear_all_cache();

echo('OK');