<?php

require_once('./config.inc.php');
require_once(SITE_ADMIN_PATH.'/session_bootstrap.php');

// Ejemplo para tener objeto global
require_once(SITE_ADMIN_PATH.'/core/application.class.php');
Application::import_libs('*');
$app = Application::load();

// Check ACL
require_once(SITE_ADMIN_PATH.'core/privileges_check.class.php');
/*if(!Acl::_('CUSTOMER_ADMIN')) {
    Acl::deny();
}
*/

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Gesti&oacute;n de Clientes');

//$tpl->addScript( array('prototype.js', 'scriptaculous/scriptaculous.js', 'AdPosition.js', 'datepicker.js') );

//require_once(SITE_ADMIN_PATH.'core/method_cache_manager.class.php');

require_once(SITE_ADMIN_PATH.'core/resource_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/resource.class.php');
require_once(SITE_ADMIN_PATH.'core/material.class.php');
require_once(SITE_ADMIN_PATH.'core/user.class.php');
require_once(SITE_ADMIN_PATH.'core/string_utils.class.php');
 
if(!isset($_REQUEST['page']) || empty($_REQUEST['page']) ) {
    $_REQUEST['page']=1;
}

$query_string = '';
// Materials

if( isset($_REQUEST['action']) ) {
    switch($_REQUEST['action']) {
        case 'list': {                        
 
            $cm = new ResourceManager();

            $filters = ' 1=1 ';
            $_order='ORDER BY 1';
            $fields='*';
            $materials = $cm->find('material', $filters , $_order , $fields);
            $tpl->assign('materials', $materials);

        } break;
        
        case 'new': {
          
           
        }
        break;

        case 'read': {
           
            $material = new Material( $_REQUEST['id'] );
            $tpl->assign('material', $material);

        } break;
        
        case 'create': {

            $material = new material();
           
            if($material->create( $_POST )) {
                Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
            } else {
                $tpl->assign('errors', $material->errors);
            }


        } break;
       
 
        case 'update': {
           
            $material = new Material($_REQUEST['id']);

            $material->update( $_REQUEST );
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);

           } break;


        case 'validate':
            if(empty($_POST["id"])) {
               
                $material = new Material();
                if(!$material->create( $_POST ))
                    $tpl->assign('errors', $tracking->errors);
            } else {
                $material = new Material($_POST["id"]);
                $material->update( $_REQUEST );
            }

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=read&id='.$material->pkResource);
        break;

        case 'delete': {
    
            $msg='';
                $material = new Material($_POST['id']);
                $material->delete( $_POST['id'] );
                $msg="El trabajador se ha eliminado correctamente ";
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&id_del='.$_POST['id'].'&msg='.$msg.'&'.$query_string);
        } break;

        default: {
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
        } break;
    
    }

} else {
    Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
}

if (( $_REQUEST['action'] )=="list"){

    $tpl->display('material/materials_list.tpl');

}else{
    $tpl->display('material/materials_create_update.tpl');
}