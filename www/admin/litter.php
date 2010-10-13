<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

// Ejemplo para tener objeto global
require_once(SITE_ADMIN_PATH.'core/application.class.php');
Application::import_libs('*');
$app = Application::load();

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);

$tpl->assign('titulo_barra', 'Papelera de elementos');

require_once(SITE_ADMIN_PATH.'core/method_cache_manager.class.php');

require_once(SITE_ADMIN_PATH.'core/content_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/content.class.php');
require_once(SITE_ADMIN_PATH.'core/content_category.class.php');
require_once(SITE_ADMIN_PATH.'core/customer.class.php');
require_once(SITE_ADMIN_PATH.'core/tracking.class.php');
 

require_once(SITE_ADMIN_PATH.'core/content_category.class.php');
require_once(SITE_ADMIN_PATH.'core/content_category_manager.class.php');

// Check ACL
require_once(SITE_ADMIN_PATH.'core/privileges_check.class.php');
if(!Acl::_('USER_ADMIN')) {
    Acl::deny();
}


if (!isset($_GET['page']) || empty($_GET['page'])) {$_GET['page'] = 1;}

if (!isset($_REQUEST['mytype'])) {$_REQUEST['mytype'] = 'customer';}
$tpl->assign('mytype', $_REQUEST['mytype']);

if(isset($_REQUEST['action']) ) {
	switch($_REQUEST['action']) {
		case 'list':

            $cm = new ContentManager();
			$types_content = $cm->get_types();		
			$tpl->assign('types_content', $types_content);
       
			//$litterelems= $cm->find($_REQUEST['mytype'], 'in_litter=1', 'ORDER BY archive DESC ');
            list($litterelems, $pager)= $cm->find_pages($_REQUEST['mytype'], 'in_litter=1', 'ORDER BY `contents`.`name` DESC ',$_GET['page'],20);

            $tpl->assign('paginacion', $pager);

            $tpl->assign('litterelems', $litterelems);

		break;

		case 'm_no_in_litter':
   
            if(isset($_REQUEST['selected_fld']) && count($_REQUEST['selected_fld'])>0)
            {
                $fields = $_REQUEST['selected_fld'];

                if(is_array($fields)) {
                    foreach($fields as $i ) {
                        $contenido=new content($i);
                        $contenido->no_delete($i,$_SESSION['userid']);
                    }
                }
            }
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&mytype='.$_REQUEST['mytype'].'&page='.$_REQUEST['page']);
		break;
		
		case 'no_in_litter':		   			
            $contenido=new Content($_REQUEST['id']);
            $contenido->no_delete($_REQUEST['id'],$_SESSION['userid']);

            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&mytype='.$_REQUEST['mytype'].'&page='.$_REQUEST['page']);
          
		break;
		
		case 'remove':
 
            $contenido = new Content($_REQUEST['id']);

            $contenido->remove($_POST['id']); // eliminamos

			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
		break;
		
		
		case 'mremove':		
           if($_REQUEST['id']==6){ //Eliminar todos
                $cm = new ContentManager();
                $contents = $cm->find($_REQUEST['mytype'], 'in_litter=1', 'ORDER BY created DESC ');
                foreach ($contents as $cont){
                      $content = new Content($cont->id);
                      $content->remove($cont->id);
                }
                Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&mytype='.$_REQUEST['mytype'].'&page='.$_REQUEST['page']);
            }
					
            if(isset($_REQUEST['selected_fld']) && count($_REQUEST['selected_fld'])>0) {
			     $fields = $_REQUEST['selected_fld'];
 
		         if(is_array($fields)) {
			        foreach($fields as $i ) {
			     	 
			     		$content=new Content($i);
			     		$content->remove($i); // eliminamos
			        } 
        		 }
			  }
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&mytype='.$_REQUEST['mytype'].'&page='.$_REQUEST['page']);
		break;
		

		default:
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
		break;
	}
} else {
	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
}

$tpl->display('litter.tpl');
?>
