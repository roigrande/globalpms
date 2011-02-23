<?php
require_once('./config.inc.php');
require_once(SITE_ADMIN_PATH.'/session_bootstrap.php');

// Ejemplo para tener objeto global
require_once(SITE_ADMIN_PATH.'/core/application.class.php');
Application::import_libs('*');
$app = Application::load();

// Check ACL
require_once(SITE_ADMIN_PATH.'core/privileges_check.class.php');
require_once(SITE_ADMIN_PATH.'core/resource_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/resource.class.php');
require_once(SITE_ADMIN_PATH.'core/worker.class.php');
require_once(SITE_ADMIN_PATH.'core/user.class.php');
require_once(SITE_ADMIN_PATH.'core/string_utils.class.php');
require_once(SITE_ADMIN_PATH.'core/functions_input.php');


$query_string = '';
$action       = functionsInput::filter_input_request('action');
$page         = functionsInput::filter_input_request('page');
$id           = functionsInput::filter_input_request('id',FILTER_VALIDATE_INT);
$server       = functionsInput::filter_input_request('SCRIPT_NAME');

if ($action=="read" OR $action=="update" OR $action=="validate"){
    $worker_validate = array(
                 //WORKER
                    'nif'         => FILTER_SANITIZE_ENCODED,
                    'nss'         => FILTER_SANITIZE_ENCODED,
                    'dob'         => FILTER_SANITIZE_STRING,
                    'email1'      => FILTER_SANITIZE_EMAIL,
                    'email2'      => FILTER_SANITIZE_EMAIL,
                    'address'     => FILTER_SANITIZE_STRING,
                    'city'        => FILTER_SANITIZE_STRING,
                    'telf1'       => FILTER_SANITIZE_NUMBER_INT,
                    'telf2'       => FILTER_SANITIZE_NUMBER_INT,
                    'address'     => FILTER_SANITIZE_STRING,
                    'city'        => FILTER_SANITIZE_STRING,
                //RESOURCE
                    'name'        => FILTER_SANITIZE_STRING,
                    'status'      => FILTER_SANITIZE_STRING,
                    'created'     => FILTER_SANITIZE_STRING,
                    'changed'     => FILTER_SANITIZE_STRING,
                    'metadata'    => FILTER_SANITIZE_STRING,
                    'description' => FILTER_SANITIZE_STRING,
                    'image'       => FILTER_SANITIZE_STRING,
                    'id'          => FILTER_SANITIZE_ENCODED
    );
    $worker_post    = filter_input_array(INPUT_POST, $worker_validate);
    $worker_get     = filter_input_array(INPUT_GET);
}
$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Gesti&oacute;n de Clientes');

if(!isset($page) || empty($page) ) {
    $page=1;
}


if( $action != null ) {
    switch($action) {
        case 'list': {                        
 
            $cm = new ResourceManager();
            $filters = ' 1=1 ';
            $_order='ORDER BY 1';
            $fields='*';
            $workers = $cm->find('worker', $filters , $_order , $fields);
            Application::ajax_out(json_encode($workers));
            $tpl->assign('workers', $workers);

        } break;
        
        case 'new': {
          
           
        }
        break;

        case 'read': {          
            $worker = new Worker( $id );
            $tpl->assign('worker', $worker);
        } break;
        
        case 'create': {

            $worker = new worker();
            if($worker->create($worker_post)) {
                Application::forward($server.'?action=list&page='.$page.'&'.$query_string);
            } else {
                $tpl->assign('errors', $worker->errors);
            }


        } break;
       
 
        case 'update': {
           
            $worker = new Worker($id);
            $worker->update($worker_post);
            Application::forward($server.'?action=list&page='.$page.'&'.$query_string);

           } break;


        case 'validate':
            if(empty($id)) {
               
                $worker = new Worker();
                if(!$worker->create( $worker_post))
                    $tpl->assign('errors', $tracking->error);
            } else {
                $worker = new Worker($id);
                $worker->update( $worker_post);
            }

            Application::forward($server.'?action=read&id='.$worker->pkResource.'&page='.$page);
        break;

        case 'delete': {
    
            $msg='';
                $worker = new Worker($id);
                $worker->delete( $id );
                $msg="El trabajador se ha eliminado correctamente ";
            Application::forward($server.'?action=list&page='.$page.'&id_del='.$id.'&msg='.$msg.'&'.$query_string);
        } break;

        default: {
            Application::forward($server.'?action=list&page='.$page.'&'.$query_string);
        } break;
    
    }

} else {
    Application::forward($server.'?action=list&page='.$page.'&'.$query_string);
}

//LOADING TEMPLATES//////////

if ( $action=="list"){
    $tpl->display('worker/workers_list.tpl');

}else{
    $tpl->display('worker/workers_create_update.tpl');
}