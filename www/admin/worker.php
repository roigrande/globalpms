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
require_once(SITE_ADMIN_PATH.'core/worker.class.php');
require_once(SITE_ADMIN_PATH.'core/user.class.php');
 
if(!isset($_REQUEST['page']) || empty($_REQUEST['page']) ) {
    $_REQUEST['page']=1;
}

$query_string = '';
// Workers

if( isset($_REQUEST['action']) ) {
    switch($_REQUEST['action']) {
        case 'list': {                        
 
            $cm = new ResourceManager();

            $filters = ' 1=1 ';
            $_order='ORDER BY 1';
            $fields='*';
            $workers = $cm->find('worker', $filters , $_order , $fields);
            
            $tpl->assign('workers', $workers);

        } break;
        
        case 'new': {
          
           
        }
        break;

        case 'read': {

            $worker = new Worker( $_REQUEST['id'] );         
            $tpl->assign('worker', $worker);

        } break;
        
        case 'create': {

            $worker = new worker();
            if($worker->create( $_POST )) {
                Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
            } else {
                $tpl->assign('errors', $worker->errors);
            }


        } break;
       
 
        case 'update': {
            
            $worker = new Worker($_REQUEST['id']);
            $worker->update( $_REQUEST );
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);

           } break;


        case 'validate':
           
            if(empty($_POST["id"])) {
               
                $worker = new worker();
                if(!$worker->create( $_POST ))
                    $tpl->assign('errors', $tracking->errors);
            } else {
                $worker = new Worker($_POST["id"]);
                $worker->update( $_REQUEST );
            }

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=read&id='.$worker->id);
        break;

        case 'delete': {
    
            $msg='';
            $worker = new Worker($_POST['id']);
                $worker->delete( $_POST['id'] );
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


$tpl->display('worker/workers.tpl');