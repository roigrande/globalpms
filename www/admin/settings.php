<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

// Ejemplo para tener objeto global
require_once('core/application.class.php');
Application::import_libs('*');
$app = Application::load();

require_once('core/settings.class.php');

//$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Administrador de variables de sistema');

if(isset($_REQUEST['action']) ) {
  switch($_REQUEST['action']) {
    case 'list':	
	$c = new Configuration();

	$tpl->assign('config_vbles', $c->get_items());
	$tpl->assign('conf_file', $c->get_conf_file());
	
	$tpl->assign('SITE', SITE);
	$tpl->assign('SITE_PATH', SITE_PATH);
	$tpl->assign('SITE_ADMIN_DIR', SITE_ADMIN_DIR);
	$tpl->assign('SITE_ADMIN_PATH', SITE_ADMIN_PATH);
	$tpl->assign('SITE_URL', SITE_URL);
	$tpl->assign('SITE_URL_SSL', SITE_URL_SSL);
	$tpl->assign('SITE_URL_ADMIN', SITE_URL_ADMIN);
	$tpl->assign('SITE_URL_ADMIN_SSL', SITE_URL_ADMIN_SSL);
	$tpl->assign('SITE_LIBS_PATH', SITE_LIBS_PATH);
	
	$tpl->assign('URL', SITE_URL_ADMIN);
	$tpl->assign('URL_PUBLIC', SITE_URL);
	$tpl->assign('RELATIVE_PATH', SITE_ADMIN_PATH);
	$tpl->assign('PATH_APP', PATH_APP);
	$tpl->assign('SYS_LOG', SYS_LOG);

	$tpl->assign('MEDIA_DIR', MEDIA_DIR);
	$tpl->assign('MEDIA_PATH', MEDIA_PATH);
	$tpl->assign('MEDIA_PATH_URL', MEDIA_PATH_URL);
	$tpl->assign('MEDIA_IMG_DIR', MEDIA_IMG_DIR);
	$tpl->assign('MEDIA_IMG_PATH', MEDIA_IMG_PATH);
	$tpl->assign('MEDIA_IMG_PATH_URL', MEDIA_IMG_PATH_URL);
	
	$tpl->assign('PATH_UPLOAD', PATH_UPLOAD);
	$tpl->assign('URL_UPLOAD', URL_UPLOAD);
	
	$tpl->assign('BD_DSN', BD_DSN);
	
	break;

    case 'save':
	$c = new Configuration();
	$c->set_items( $_REQUEST );
	$c->save();
	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
	break;
    case 'permissions':
	$c = new Configuration();
	$c->applyPermissions( SITE_PATH );


	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
	break;
    default:
	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
	break;
    }
} else {
	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
}
$tpl->display('settings.tpl');
?>
