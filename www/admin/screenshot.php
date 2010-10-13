<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

// Ejemplo para tener objeto global
require_once('core/application.class.php');
Application::import_libs('*');
$app = Application::load();

require_once('core/user.class.php');

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Screenshot');

if(isset($_REQUEST['action']) ) {
	switch($_REQUEST['action']) {
		case 'list':	
			Application::forward(MEDIA_IMG_PATH_URL.'/myscreenshot.png');
		break;

		case 'take':
			$im = imagegrabscreen();
			imagepng($im, "/media/images/myscreenshot.png");
			imagedestroy($im);
		break;
		default:
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
		break;
	}
} else {
	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
}
//$tpl->display('dashboard.tpl');
?>
