<?php
error_reporting(E_ALL);
require_once('./config.inc.php');
require_once(SITE_ADMIN_PATH.'/session_bootstrap.php');

require_once(SITE_ADMIN_PATH.'core/application.class.php');
Application::import_libs('*');
$app = Application::load();


$tpl = new TemplateAdmin(TEMPLATE_ADMIN);

$tpl->assign('titulo_barra', 'Gesti&oacute;n de Incidencias');

require_once(SITE_ADMIN_PATH.'core/method_cache_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/content_category_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/content_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/content.class.php');
require_once(SITE_ADMIN_PATH.'core/content_category.class.php');
require_once(SITE_ADMIN_PATH.'core/tracking.class.php');
require_once(SITE_ADMIN_PATH.'core/customer_tracking.class.php');

// Check ACL
require_once(SITE_ADMIN_PATH.'core/privileges_check.class.php');
if(!Acl::_('CUSTOMER_ADMIN')) {
    Acl::deny();
}

if(!isset($_REQUEST['page']) || empty($_REQUEST['page']) ) {
    $_REQUEST['page']=1;
}

if(isset($_REQUEST['action']) ) {
    switch($_REQUEST['action']) {
        case 'list':  //Buscar publicidad entre los content
            $cm = new ContentManager();
            // ContentManager::find_pages(<TIPO_CONTENIDO>, <CLAUSE_WHERE>, <CLAUSE_ORDER>,<PAGE>,<ITEMS_PER_PAGE>,<CATEGORY>);
            list($trackings, $pager)= $cm->find_pages('tracking', 'fk_content_type=2 ', 'ORDER BY  created DESC ',$_REQUEST['page'],20);

            /* Ponemos en la plantilla la referencia al objeto pager */
            $tpl->assign('paginacion', $pager);
            $tpl->assign('trackings', $trackings);
       

        break;

        case 'new':
            //
        break;

        case 'read':
            $tracking = new tracking( $_REQUEST['id'] );
            $tpl->assign('tracking', $tracking);

        break;

        case 'update':
            $_REQUEST['fk_creator'] = $_SESSION['userid'];
            $tracking = new tracking();
            $tracking->update( $_REQUEST );

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
        break;

        case 'create':
            $_POST['fk_creator'] = $_SESSION['userid'];
            $tracking = new tracking();
            if($tracking->create( $_POST )) {
                    Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
            } else {
                    $tpl->assign('errors', $tracking->errors);
            }
        break;

        case 'validate':
            $_REQUEST['fk_creator'] = $_SESSION['userid'];
            $tracking = null;
            if(empty($_POST["id"])) {
                $tracking = new tracking();
                //Estamos creando un nuevo artículo
                if(!$tracking->create( $_POST ))
                    $tpl->assign('errors', $tracking->errors);
            } else {
                $tracking = new tracking($_POST["id"]);
                //Estamos atualizando un artículo
                $tracking->update( $_REQUEST );
            }
            
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=read&id='.$tracking->id);
        break;

        case 'delete':
              
            if($_REQUEST['id']){               
                $customtracks = CustomerTracking::get_customers($_REQUEST['id']);
                if(!empty($customtracks)){
                    $msg="<p> No se puede eliminar, está asignado a los clientes: ".implode(', ', $customtracks).'</p>';
                }else{
                    $msg='';
                    $tracking = new Tracking($_REQUEST['id']);
                    $tracking->delete( $_REQUEST['id'],$_SESSION['userid'] );
                }
            }

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&msg='.$msg);
        break;

        case 'confirm_del':
             //Delete relations            
            CustomerTracking::delete_all($_REQUEST['id']);
            Tracking::delete( $_REQUEST['id'],$_SESSION['userid'] );
            
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
        break;
    
        case 'mdelete':
            if(isset($_REQUEST['selected_fld']) && count($_REQUEST['selected_fld'])>0){
                $fields = $_REQUEST['selected_fld'];
                if(is_array($fields)) {
                    $msg = "";

                    foreach($fields as $i ) {
                        $tracking = new Tracking($i);
                        $customtracks = CustomerTracking::get_customers($i);
                        if(!empty($customtracks)){
                            $msg.= "<h3> No se puede eliminar $tracking->name está asignado a los clientes: ".implode(', ', $customtracks).'</h3>';
                        }else{
                            
                            $tracking->delete( $i,$_SESSION['userid'] );
                        }
                    }
                   
                 }
            }
            
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&msg='.$msg.'&page='.$_REQUEST['page']);
        break;

        default:
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
        break;
    }
} else {
    Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
}

$tpl->display('tracking.tpl');
 
