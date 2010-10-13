<?php
require_once('./config.inc.php');
require_once(SITE_ADMIN_PATH.'session_bootstrap.php');

$sessions = $GLOBALS['Session']->getSessions();

// Ejemplo para tener objeto global
require_once(SITE_ADMIN_PATH.'core/application.class.php');
Application::import_libs('*');
$app = Application::load();

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Gesti&oacute;n de Grupos de Usuarios');

require_once(SITE_ADMIN_PATH.'core/content_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/content.class.php');
require_once(SITE_ADMIN_PATH.'core/user_group.class.php');
require_once(SITE_ADMIN_PATH.'core/privilege.class.php');
require_once(SITE_ADMIN_PATH.'core/privileges_check.class.php');

if(!Acl::_('USER_ADMIN'))
{
    Privileges_check::AccessDeniedAction();
}

if( isset($_REQUEST['action']) ) {
	switch($_REQUEST['action']) {
		case 'list':
			$user_group = new User_group();
			$user_groups = $user_group->get_user_groups();
			// FIXME: Set pagination
			$tpl->assign('user_groups', $user_groups);
		break;

		case 'new':
			$user_group = new User_group();
			$privilege = new Privilege();
			$tpl->assign('user_group', $user_group);
			$tpl->assign('privileges', $privilege->get_privileges());
		break;

		case 'read':
			$user_group = new User_group($_REQUEST['id']);
			$privilege = new Privilege();
			$tpl->assign('user_group', $user_group);
			$tpl->assign('privileges', $privilege->get_privileges());
		break;

		case 'update':
			// TODO: validar datos
			$user_group = new User_group();
			$user_group->update( $_REQUEST );
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
		break;

		case 'create':
			$user_group = new User_group();
			if($user_group->create( $_POST )) {
				Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
			} else {
				$tpl->assign('errors', $user_group->errors);
			}
		break;

		case 'delete':
			$user_group = new User_group();
			$user_group->delete( $_POST['id'] );
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
		break;

		
		case 'validate':
			$user_group = new User_group();
			if(empty($_POST["id"])) {
				if($user_group->create( $_POST ))
					$tpl->assign('errors', $user_group->errors);		
			} else {
				$user_group = new User_group();
				$user_group->update( $_REQUEST );
			}
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=read&id='.$user_group->id);
		break;

		default:
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
		break;
	}
} else {
	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
}

$tpl->display('user_group.tpl');