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

$tpl->addScript( array('prototype.js', 'scriptaculous/scriptaculous.js', 'AdPosition.js', 'datepicker.js') );

require_once(SITE_ADMIN_PATH.'core/method_cache_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/production.class.php');
require_once(SITE_ADMIN_PATH.'core/production_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/content_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/content.class.php');
require_once(SITE_ADMIN_PATH.'core/content_category.class.php');
require_once(SITE_ADMIN_PATH.'core/content_category_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/customer.class.php');
require_once(SITE_ADMIN_PATH.'core/tracking.class.php');
require_once(SITE_ADMIN_PATH.'core/customer_tracking.class.php');
require_once(SITE_ADMIN_PATH.'core/user.class.php');

function buildFilter($filter) {
    $filters = array();
    $url = array();

    $filters[] = $filter;

    if(isset($_REQUEST['filter']['city'])
       && (!empty($_REQUEST['filter']['city']))) {
        $filters[] = '`city` LIKE "%' . $_REQUEST['filter']['city'].'%"';

        $url[] = 'filter["city"]=' . $_REQUEST['filter']['city'];
    }


    if(isset($_REQUEST['filter']['state'])
       && (!empty($_REQUEST['filter']['state']))) {
        $filters[] = '`state` LIKE "%' . $_REQUEST['filter']['state'].'%"';

        $url[] = 'filter["state"]=' . $_REQUEST['filter']['state'];
    }


    if(isset($_REQUEST['filter']['agent'])
       && ($_REQUEST['filter']['agent'] > 0)) {
        $filters[] = '`fk_creator`=' . $_REQUEST['filter']['agent'];

        $url[] = 'filter["agent"]=' . $_REQUEST['filter']['agent'];
    }

     if(isset($_REQUEST['filter']['next_date'])
       && ($_REQUEST['filter']['next_date'] > 0)) {
        $filters[] = '`next_app_date` LIKE "' . $_REQUEST['filter']['next_date'].'%"'; //segundos//.' 00:00:00"';

        $url[] = 'filter["next_date"]=' . $_REQUEST['filter']['next_date'];
    }

    if(isset($_REQUEST['filter']['name'])
       && !empty($_REQUEST['filter']['name'])) {
       /* $filters[] = 'MATCH(`company_name`, `telf1`, `email1`, `email2`) AGAINST ("' . $_REQUEST['filter']['name']. '" IN BOOLEAN MODE)'; */
        // Cambiar ft_min_word_len

        $filters[] = '(`name` LIKE "%' . $_REQUEST['filter']['name'].'%" '.
                     ' OR `address1` LIKE "%' . $_REQUEST['filter']['name'].'%" '.
                     ' OR `company_name` LIKE "%' . $_REQUEST['filter']['name'].'%" '.
                     ' OR `email1` LIKE "%' . $_REQUEST['filter']['name'].'%" '.
                     ' OR `telf1` LIKE "%' . $_REQUEST['filter']['name'].'%" '.
                     ' OR `email2` LIKE "%' . $_REQUEST['filter']['name'].'%" '.
                     ' OR `city` LIKE "%' . $_REQUEST['filter']['name'].'%")';

        $url[] = 'filter["name"]=' . $_REQUEST['filter']['name'];

    }

    return array( implode(' AND ',$filters), implode('&amp;', $url) );
}

if(!isset($_REQUEST['page']) || empty($_REQUEST['page']) ) {
    $_REQUEST['page']=1;
}
// CATEGORYS
//$ccm = new ContentCategoryManager();
//$allcategories = $ccm->find(' fk_content_category =0', 'ORDER BY name');
//$tpl->assign('allcategories', $allcategories);

if( isset($_REQUEST['action']) ) {
    switch($_REQUEST['action']) {
        case 'list': {
            $pm = new ProductionManager();




            // Filters
            $categoryOptions = array();
            $categoryOptions[] = '--'._('Select section').'--';
            foreach($allcategories as $cat) {
                $categoryOptions[$cat->pk_content_category] = $cat->title;
            }

            $trackingsList = $cm->find('tracking', 'fk_content_type=2 ', 'ORDER BY  contents.name ASC ');
            $trackingsOp[] = '--'._('Select tracking').'--';
            foreach($trackingsList as $track) {
                $trackingsOp[$track->pk_content] = $track->name;
            }
            $agentsOp = array();
            if(Acl::_('USER_ADMIN')) {
                $user = new User();
                $agentsList = $user->get_users(null);
                $agentsOp[] = '--'._('Select agent').'--';
                foreach($agentsList as $agent) {
                    $agentsOp[$agent->id] = $agent->name;
                }
                $filter_ini = 'fk_content_type=1';
            }else{
                $filter_ini ='fk_content_type=1 AND fk_creator = '.$_SESSION['userid'];

            }

            $last_trackings = CustomerTracking::get_last_trackings(); // used in column last_tracking and filter tracking
            $tpl->assign('last_trackings', $last_trackings);

            if(isset($_REQUEST['filter']['tracking']) && ($_REQUEST['filter']['tracking'] > 0)) {
                $where = "1=1";
                if($_REQUEST['filter']['fecha']){
                    $start= $_REQUEST['filter']['fecha'].' 00:00:00';
                    $end= $_REQUEST['filter']['fecha'].' 23:59:59';
                    $where = "(date >='".$start."' AND date <= '".$end."')";
                }
                $the_trackings = CustomerTracking::get_customers($_REQUEST['filter']['tracking'], $where);
                $track_array =array();
                foreach($the_trackings as $c=>$track){
                        $track_array[] = $c;
                }

                if(!empty($track_array)) { $filter_ini .=" AND `contents`.`pk_content` IN (".implode(' , ',$track_array).")";
                }else{  //Ninguno
                    $filter_ini .=" AND 1=2";
                }

            }
            // Get filter and uri with params of list (query_string), remember don't assign to template $params
            $filter_options['category'] = $categoryOptions;
            $filter_options['tracking'] = $trackingsOp;
            $filter_options['agent'] = $agentsOp;

            list($filters, $query_string) = buildFilter($filter_ini);
               $tpl->assign('query_string', $query_string);

            // ContentManager::find_pages(<TIPO_CONTENIDO>, <CLAUSE_WHERE>, <CLAUSE_ORDER>,<PAGE>,<ITEMS_PER_PAGE>,<CATEGORY>);
            if(isset($_REQUEST['filter']['category']) && !empty($_REQUEST['filter']['category']) ) {
                $_category = $_REQUEST['filter']['category'];
            }else{
                $_category = NULL;
            }
            $_order = 'ORDER BY contents.name ASC, created DESC ';
            if(!empty($_REQUEST['filter']['next_date'])){
                 $_order = 'ORDER BY next_app_date ASC, contents.name ASC, created DESC ';
            }

            list($customers, $pager)= $cm->find_pages('Customer', $filters , $_order , $_REQUEST['page'], 20, $_category);

            if(Acl::_('USER_ADMIN')) {
                foreach($customers as $custom){
                    //$agentsOp -- array of agents
                    $custom->agent = $agentsOp[ $custom->fk_creator];
                }
            }

            $tpl->assign('paginacion', $pager);
            $tpl->assign('customers', $customers);



        } break;

        case 'new':
           /* if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
            } */
            $cm = new ContentManager();
            list($trackings, $pager)= $cm->find_pages('tracking', 'fk_content_type=2 ', 'ORDER BY  contents.name ASC ',$_REQUEST['page'],100);
            $tpl->assign('trackings', $trackings);
            $tpl->assign('user', $_SESSION['username']);
            if(Acl::_('USER_ADMIN')) {
                $user = new User();
                $agentsOp=array();
                $agentsList = $user->get_users(null);
                foreach($agentsList as $agent) {
                    $agentsOp[$agent->id] = $agent->name;
                }
                $tpl->assign('agentsOp', $agentsOp);
            }


        break;

        case 'read': {
            //habrá que tener en cuenta el tipo
            if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
            }
            $cm = new ContentManager();
            list($trackings, $pager)= $cm->find_pages('tracking', 'fk_content_type=2 ', 'ORDER BY  contents.name ASC ',$_REQUEST['page'],100);
            $tpl->assign('trackings', $trackings);
            $customer = new Customer( $_REQUEST['id'] );
            $user = new User($customer->fk_creator);
            $tpl->assign('user', $user->name);
            $tpl->assign('customer', $customer);
            $customtracks = CustomerTracking::get_trackings($_REQUEST['id']);
            $tpl->assign('customtracks', $customtracks);

            if(Acl::_('USER_ADMIN')) {
                $user = new User();
                $agentsOp=array();
                $agentsList = $user->get_users(null);
                foreach($agentsList as $agent) {
                    $agentsOp[$agent->id] = $agent->name;
                }
                $tpl->assign('agentsOp', $agentsOp);
            }


        } break;

        case 'create': {
            if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
            }
            $customer = new Customer();
            if(empty($_POST['fk_creator']))
                $_POST['fk_creator'] = $_SESSION['userid'];
             if($customer->create( $_POST )) {
                Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
            } else {
                $tpl->assign('errors', $customer->errors);
            }
        } break;


        case 'update': {
            if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
            }

            $customer = new Customer($_REQUEST['id']);
            if(empty($_REQUEST['fk_creator']))
                $_REQUEST['fk_creator'] = $customer->fk_creator; //don't change.

            $customer->update( $_REQUEST );

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
        } break;

         case 'validate':
            if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
            }
            $customer = null;
            if(empty($_POST["id"])) {
                $customer = new customer();
                if(empty($_POST['fk_creator']))
                    $_POST['fk_creator'] = $_SESSION['userid'];
                if(!$customer->create( $_POST ))
                    $tpl->assign('errors', $tracking->errors);
            } else {
                $customer = new Customer($_POST["id"]);
                if(empty($_REQUEST['fk_creator']))
                    $_REQUEST['fk_creator'] = $customer->fk_creator; //don't change.
                //Estamos atualizando un artículo
                $customer->update( $_REQUEST );
            }

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=read&id='.$customer->id);
        break;

        case 'delete': {
            if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
            }
            $msg='';
            $customer = new Customer($_POST['id']);
            $customtracks = CustomerTracking::get_tracks( $_POST['id'] );
            if(!empty($customtracks)){
                $msg.= "<h3> No se puede eliminar $customer->name tiene incidencias asociadas: ".implode(', ', $customtracks).' </h3>';
             /*   $msg.="¿Desea eliminarlos de todos modos?  <br>
                        <a title='si' href='".$_SERVER['SCRIPT_NAME']."?action=confirm_delete&id=".$_POST['id']."&page=".$_REQUEST['page']."&".$query_string."'>Si</a> |
                        <a title='no' href='".$_SERVER['SCRIPT_NAME']."?action=list'>No</a>
                     "; */
                $confirm='ok';
            }else{
                $customer->delete( $_POST['id'] );
                $msg="El cliente se ha eliminado correctamente ";
            }


            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&id_del='.$_POST['id'].'&msg='.$msg.'&'.$query_string);
        } break;

         case 'confirm_delete': {
            if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
            }
            $customer = new Customer($_GET['id']);

            $customer->delete( $_GET['id'] );
            $msg="El cliente se ha eliminado correctamente ";

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&msg='.$msg.'&'.$query_string);
        } break;


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
                        $customer = new Customer($i);
                        $customtracks = CustomerTracking::get_tracks($i);
                        if(!empty($customtracks)){
                            $msg.= "<h3> No se puede eliminar $customer->name tiene incidencias asociadas: ".implode(', ', $customtracks).'</h3>';
                        }else{

                            $customer->delete( $i,$_SESSION['userid'] );
                        }
                    }
                    if(!empty($msg)){ $msg.= '<h3>Eliminelos uno a uno. </h3>';}

                 }
            }

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&msg='.$msg.'&page='.$_REQUEST['page'].'&'.$query_string);
        break;


        case 'save_tracking':{
             if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
             }
             $customtracks = new CustomerTracking();
             $resp = $customtracks->create($_REQUEST['id'], $_REQUEST['tracking'], $_REQUEST['info']);
             $customtracks = $customtracks->get_trackings($_REQUEST['id']);
             $tpl->assign('customtracks', $customtracks);
             $customer =null;
             $customer->id=$_REQUEST['id'];
             $tpl->assign('customer', $customer);

             $html_out=$tpl->fetch('custom_trackings.tpl');
             Application::ajax_out($html_out);



        }break;

        case 'delete_tracking':{
             if(!Acl::_('CUSTOMER_ADMIN')) {
                Acl::deny();
             }
             $customtracks = new CustomerTracking();
             $resp = $customtracks->delete($_REQUEST['id']);

             $customtracks = $customtracks->get_trackings($_REQUEST['pk_customer']);
             $tpl->assign('customtracks', $customtracks);
             $customer =null;
             $customer->id=$_REQUEST['pk_customer'];
             $tpl->assign('customer', $customer);

             $html_out=$tpl->fetch('custom_trackings.tpl');
            Application::ajax_out($html_out);

        }break;


        case 'check_tfno': {

            $html_out='';
            $cm = new ContentManager();
            $trackings = $cm->find('customer', 'fk_content_type=1 AND telf1 ="'.$_REQUEST['tfno'].'"', 'ORDER BY  contents.name ASC ');

            if(!empty($trackings)) {
                $html_out= "Ya existe un cliente con ese telefono  ";
            }

            Application::ajax_out($html_out);


        } break;


        default: {
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
        } break;
    }

} else {
    Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page'].'&'.$query_string);
}

$tpl->display('customers.tpl');
