<?php
error_reporting(E_ALL);
require_once('./config.inc.php');
require_once(SITE_ADMIN_PATH.'/session_bootstrap.php');

require_once('libs/utils.functions.php');

// Ejemplo para tener objeto global
require_once('core/application.class.php');
Application::import_libs('*');
$app = Application::load();


$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Gesti&oacute;n de Secciones');

require_once(SITE_ADMIN_PATH.'core/method_cache_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/content_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/content.class.php');
require_once(SITE_ADMIN_PATH.'core/content_category.class.php');
require_once(SITE_ADMIN_PATH.'core/content_category_manager.class.php');


//if( !in_array('USR_ADMIN',$_SESSION['privileges']))
//if(!Acl::_('USR_ADMIN'))
//{
//    Application::forward($_SERVER['HTTP_REFERER'].'?action=list_pendientes');
//}

if( isset($_REQUEST['action']) ) {
	switch($_REQUEST['action']) {
		case 'list':
                    $ccm = new ContentCategoryManager();
                    $allcategorys = $ccm->find(' fk_content_category =0', 'ORDER BY name');


                    /*foreach( $allcategorys as $prima) {
                        $subcat[] = $cc->find('  fk_content_category ='.$prima->pk_content_category, 'ORDER BY name');
                    }
                    $tpl->assign('subcat', $subcat);
                     */

                     $tpl->assign('categorys', $allcategorys);
                   

		break;

		case 'new':

		break;

		case 'read': //habrá que tener en cuenta el tipo

			$category = new ContentCategory( $_REQUEST['id'] );
			$tpl->assign('category', $category);
			 
		break;

		case 'update':
			$category = new ContentCategory();

			$category->update( $_REQUEST );

			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
		break;

		case 'create':
                        $category = new ContentCategory();
			if($resp = $category->create( $_POST )) {
			 	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&resp='.$resp);
			} else {
                              $tpl->assign('errors', $category->errors);
			}
		break;

		case 'delete':
			$category = new ContentCategory();
			$resp=$category->delete( $_POST['id'] );
			
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&resp='.$resp);
		break;
		
		case 'set_inmenu':           
			$category = new ContentCategory($_REQUEST['id']);
			// FIXME: evitar otros valores erróneos
			$status = ($_REQUEST['status']==1)? 1: 0; // Evitar otros valores
			$category->set_inmenu($status);

		 	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list_pendientes&category='.$_REQUEST['category'].'&page='.$_REQUEST['page']);
		break;

		case 'validate':
			if(empty($_POST["id"])) {
				$category = new ContentCategory();
				if(!$category->create( $_POST ))		
						$tpl->assign('errors', $category->errors);	
			} else {
				$category = new ContentCategory($_POST["id"]);
				$category->update( $_REQUEST );
			}
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=read&id='.$category->pk_content_category);
		break;

		default:
			Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
		break;
	}
} else {
	Application::forward($_SERVER['SCRIPT_NAME'].'?action=list');
}

$tpl->display('category.tpl');