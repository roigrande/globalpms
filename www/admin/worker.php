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
            //habrá que tener en cuenta el tipo
//            if(!Acl::_('CUSTOMER_ADMIN')) {
//                Acl::deny();
//            }
            $worker = new Worker( $_REQUEST['id'] );
          
            //$user = new User($worker->fk_creator);
            //$tpl->assign('user', $user->name);
           // var_dump($worker);
            $tpl->assign('worker', $worker);

 

        } break;
        
        case 'create': {
//            if(!Acl::_('CUSTOMER_ADMIN')) {
//                Acl::deny();
//            }
           $worker = new worker();
         //    if(empty($_POST['fk_creator']))
         //     $_POST['fk_creator'] = $_SESSION['userid'];
             if($worker->create( $_POST )) {
                Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
            } else {
                $tpl->assign('errors', $worker->errors);
           }


        } break;
       
 
        case 'update': {/*
            if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
            }
            */
            $worker = new Worker($_REQUEST['id']);
   //        if(empty($_REQUEST['fk_creator']))
    //            $_REQUEST['fk_creator'] = $worker->fk_creator; //don't change.
         
            $worker->update( $_REQUEST );
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);

           } break;

//
        case 'validate':

//            if(!Acl::_('CUSTOMER_ADMIN')) {
//                Acl::deny();
//            }
            echo "validate2";
            if(empty($_POST["id"])) {
               
                $worker = new worker();
                if(!$worker->create( $_POST ))

                        $tpl->assign('errors', $tracking->errors);
            } else {
                
                $worker = new Worker($_POST["id"]);
               var_dump($worker);
                $worker->update( $_REQUEST );

            }

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=read&id='.$worker->id);
        break;

        case 'delete': {
       /*     if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
            }
        *
        */
            $msg='';
            $worker = new Worker($_POST['id']);
            var_dump($worker);
                $worker->delete( $_POST['id'] );
                $msg="El Puto trabajador se ha eliminado correctamente ";


            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&id_del='.$_POST['id'].'&msg='.$msg.'&'.$query_string);
        } break;
//
//
//
//
//        case 'mdelete':
//            if(isset($_REQUEST['selected_fld']) && count($_REQUEST['selected_fld'])>0){
//                $fields = $_REQUEST['selected_fld'];
//                if(is_array($fields)) {
//                    $msg = "";
//
//                    foreach($fields as $i ) {
//                        $worker = new Customer($i);
//                        $customtracks = CustomerTracking::get_tracks($i);
//                        if(!empty($customtracks)){
//                            $msg.= "<h3> No se puede eliminar $worker->name tiene incidencias asociadas: ".implode(', ', $customtracks).'</h3>';
//                        }else{
//
//                            $worker->delete( $i,$_SESSION['userid'] );
//                        }
//                    }
//                    if(!empty($msg)){ $msg.= '<h3>Eliminelos uno a uno. </h3>';}
//
//                 }
//            }
//
//            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&msg='.$msg.'&page='.$_REQUEST['page'].'&'.$query_string);
//        break;
//
//
//
//        case 'check_tfno': {
//
//            $html_out='';
//            $cm = new ContentManager();
//            $trackings = $cm->find('worker', 'fk_content_type=1 AND telf1 ="'.$_REQUEST['tfno'].'"', 'ORDER BY  contents.name ASC ');
//
//            if(!empty($trackings)) {
//                $html_out= "Ya existe un cliente con ese telefono  ";
//            }
//
//            Application::ajax_out($html_out);
//
//
//        } break;
//

        default: {
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
        } break;
    
    }

} else {
    Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
}


$tpl->display('worker/workers.tpl');