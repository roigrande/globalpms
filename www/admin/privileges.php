<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

require_once('./core/application.class.php');
require_once('./core/privilege.class.php');
require_once(SITE_ADMIN_PATH.'core/privileges_check.class.php');

Application::import_libs('*');
$app = Application::load();

function buildFilter() {
    if(isset($_REQUEST['module']) && !empty($_REQUEST['module'])) {
        return 'module="'.$_REQUEST['module'].'"';
    }
    
    return null;
}



// Check ACL {{{

if(!Acl::_('USER_ADMIN')) {
    Acl::deny();
}
// }}}

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Gesti&oacute;n de Permisos');

$privilege = new Privilege();

$_REQUEST['action'] = isset($_REQUEST['action'])? $_REQUEST['action']: 'list';
switch($_REQUEST['action']) {
    case 'list': {
        $filter = buildFilter();        
        
        $privileges = $privilege->get_privileges($filter);
        // FIXME: Set pagination
        $tpl->assign('privileges', $privileges);
        
        // To filter
        $modules = $privilege->getModuleNames();
        $tpl->assign('modules', $modules);
    } break;

    // Crear un nuevo permiso
    case 'new': {
        $modules = $privilege->getModuleNames();                        
        $tpl->assign('modules', $modules);            
    } break;
    
    case 'read': {                        
        $privilege->read($_REQUEST['id']);
        $tpl->assign('privilege', $privilege);
        $tpl->assign('id', $privilege->pk_privilege);
        
        $modules = $privilege->getModuleNames();                        
        $tpl->assign('modules', $modules);
    } break;

    case 'update': {            
        $privilege->update( $_REQUEST );
        Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
    } break;

    case 'create': {
        if($privilege->create( $_POST )) {
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
        } else {
            $tpl->assign('errors', $privilege->errors);
        }
    } break;
            
    case 'validate': {
        $privilege = null;
        if(empty($_POST["id"])) {
            $privilege = new Privilege();
            if(!$privilege->create( $_POST ))
                $tpl->assign('errors', $user->errors);
        } else {
            $privilege = new Privilege($_REQUEST["id"]);
            $privilege->update( $_REQUEST );
        }
        Application::forward($_SERVER['SCRIPT_NAME'].'?action=read&id='.$privilege->id);
    } break;

    case 'delete': {
        $privilege->delete( $_POST['id'] );
        Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
    } break;
    
    default: {
        Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
    } break;
}    

$tpl->display('privilege/privilege.tpl');
