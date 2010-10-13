<?php
//error_reporting(E_ALL);
require_once('./config.inc.php');
require_once(SITE_ADMIN_PATH.'session_bootstrap.php');

// Ejemplo para tener objeto global
require_once(SITE_ADMIN_PATH.'core/application.class.php');
require_once(SITE_ADMIN_PATH.'core/user.class.php');

Application::import_libs('*');
$app = Application::load();

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Panel de Control');

if(isset($_SESSION['authGmail'])) {
    $user = new User();
    $messages = $user->cache->parseGmailInbox(base64_decode($_SESSION['authGmail']));        
    
    $tpl->assign('messages', $messages);
}


$tpl->display('welcome.tpl');