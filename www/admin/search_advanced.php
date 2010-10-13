<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

require_once('core/application.class.php');
require_once('core/search.class.php');

require_once('libs/Pager/Pager.php');
require_once('core/content_manager.class.php');
require_once('core/content.class.php');
require_once('core/content_category.class.php');
require_once('core/article.class.php');
require_once('core/related_content.class.php');
require_once('core/attachment.class.php');
require_once('core/attach_content.class.php');
require_once('core/img_galery.class.php');
require('core/media.manager.class.php');
require_once('core/comment.class.php');
require_once('core/photo.class.php');
require_once('core/video.class.php');

require_once('core/author.class.php');


require_once('core/content_category.class.php');
require_once('core/content_category_manager.class.php');

Application::import_libs('*');
$app = Application::load();

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);

$tpl->assign('titulo_barra', 'Búsqueda Avanzada');

  $_SESSION['_from'] ='search_advanced';
if( !isset($_REQUEST['action']) )
{
    $Types = getContentTypes();

    $tpl->assign('arrayTypes', $Types);
    $tpl->display('search_advanced.tpl');
    return;
}

// Assocciate content_type to resource, it has be static array because
// don't exist a convention, sample attachment go on fichero.php
$type2res = array(
    'article' => 'article.php',
    'advertisement' => 'advertisement.php',
    'attachment' => 'ficheros.php',
    'opinion' => 'opinion.php',
    'comment' => 'comment.php',
    'album' => 'album.php',
    'photo' => 'mediamanager.php',
    'video' => 'video.php',
    'interviu' => 'interviu.php',
    'poll' => 'pc_poll.php',
    'static_page' => 'static_pages.php',
);


switch($_REQUEST['action'])
{
    case 'load':
        $Types = getContentTypes();
        $tpl->assign('arrayTypes', $Types);
        break;

    case 'search':

        if( !isset($_REQUEST['stringSearch']) ||
            empty($_REQUEST['stringSearch']))
        {
            $Types = getContentTypes();
            $tpl->assign('arrayTypes', $Types);
            break;
        }        
        
        $Types = getContentTypes();
        $tpl->assign('arrayTypes', $Types);
        
        $htmlChecks=null;
        $szCheckedTypes = checkTypes($htmlChecks);
        $szTags  = trim($_REQUEST['stringSearch']);                
        $objSearch = cSearch::Instance();
        $arrayResults = $objSearch->SearchContentsSelectMerge("contents.title as titule, contents.permalink, contents.description, contents.created, contents.pk_content as id, contents_categories.catName, contents_categories.pk_fk_content_category as category, content_types.title as type, contents.available, contents.content_status, contents.in_litter, content_types.name as content_type",
                                                            $szTags,
                                                            $szCheckedTypes,
                                                            "pk_content = pk_fk_content AND fk_content_type = pk_content_type",
                                                            "contents_categories, content_types",
                                                            100);
        $Pager = null;
       
        $arrayResults = cSearch::Paginate($Pager, $arrayResults, "id", 10);
 
        $szPagesLink = PaginateLink($Pager,$szTags, explode(", ", $szCheckedTypes));
        
        $tpl->assign('type2res', $type2res);

        $tpl->assign('arrayResults', $arrayResults);
        $tpl->assign('htmlCheckedTypes', $htmlChecks);
        $tpl->assign('pagination', $szPagesLink);

    break;

    case 'search_paging':


        if( !isset($_REQUEST['stringSearch']) ||
            empty($_REQUEST['stringSearch']))
        {
            $Types = getContentTypes();
            break;
        }
        $Types = getContentTypes();

        $htmlChecks=null;
        $szCheckedTypes = checkTypes($htmlChecks);
        $szTags  = trim($_REQUEST['stringSearch']);
        $objSearch = cSearch::Instance();

        $arrayResults = $objSearch->SearchContentsSelectMerge("contents.title as titule, contents.permalink, contents.description, contents.created, contents.pk_content as id, contents_categories.catName, contents_categories.pk_fk_content_category as category, content_types.title as type, contents.available, contents.content_status, contents.in_litter, content_types.name as content_type",
                $szTags,
                $szCheckedTypes,
                "pk_content = pk_fk_content AND fk_content_type = pk_content_type",
                "contents_categories, content_types",
                100);


        //$Pager = null;
        if( isset($arrayResults) &&
            !empty($arrayResults))
            $arrayResults = cSearch::Paginate($Pager, $arrayResults, "id", 10);
            $htmlPaging = PaginateLink($Pager,$szTags, explode(", ", $szCheckedTypes));

             $tpl->assign('type2res', $type2res);

            $tpl->assign('pagination', $htmlPaging);
            $tpl->assign('arrayResults',$arrayResults);

            $html_out=$tpl->fetch('search_advanced_list.tpl');
        Application::ajax_out($htmlTitle.$htmlPaging.$html_out.$htmlPaging);

    break;

    case 'read':

        $tpl->assign('subcat', $subcat);
        // FIXME: Set pagination
        $tpl->assign('allcategorys', $allcategorys);

        $article = new Article( $_REQUEST['id'] );
        $tpl->assign('article', $article);

        $cm = new ContentManager();
        //Photos de noticia
        $img1=$article->img1;
        if(isset($img1)){
            //Buscar foto where pk_foto=img1
            $photo1=new Photo($img1);
        }

        $tpl->assign('photo1', $photo1);
        $img2=$article->img2;
        if(isset($img2)){
                //Buscar foto where pk_foto=img2
            $photo2=new Photo($img2);
        }

        $tpl->assign('photo2', $photo2);
            //Comentarios
        $comment = new Comment();
        $comments = $cm->find('Comment', 'content_status=1 and fk_content="'.$_REQUEST['id'].'"', NULL);
        $tpl->assign('comments', $comments);
         //Listado Autores
        $aut=new Author();
        $todos=$aut->all_authors();
        $tpl->assign('todos', $todos);



        $relationes=array();
        $rel= new Related_content();

        $relationes = $rel->get_relations( $_REQUEST['id'] );//de portada
        $tpl->assign('yarelations', $relationes); //Portada
        foreach($relationes as $aret) {
             $resul = new Article($aret);
             $losrel[]=$resul;
        }
        $tpl->assign('losrel', $losrel);
        //Relacionados de interior
        $intrelationes = $rel->get_relations_int( $_REQUEST['id'] );//de interor
        $tpl->assign('intrelations', $intrelationes); //interior
        foreach($intrelationes as $aret) {
             $resul = new Article($aret);
             $intrel[]=$resul;
        }
        $tpl->assign('intrel', $intrel);


        $attach_rel = new Attach_content();

        $reles=array();
        $reles=$attach_rel->get_attach($_REQUEST['id']);
        foreach($reles as $attaches) {
             $resul = new Attachment($attaches);
             $adjuntos[]=$resul;
        }
        $tpl->assign('adjuntos', $adjuntos);

        $relespor=$attach_rel->get_attach_relations($_REQUEST['id']);
        foreach($relespor as $attaches) {
             $resul = new Attachment($attaches);
             $adjuntospor[]=$resul;
        }
        $tpl->assign('adjuntospor', $adjuntospor);


        $relesint=$attach_rel->get_attach_relations_int($_REQUEST['id']);
        foreach($relesint as $attaches) {
             $resul = new Attachment($attaches);
             $adjuntosint[]=$resul;
        }
        $tpl->assign('adjuntosint', $adjuntosint);
        break;
    case 'confirm_notify':

         $msg='¡ATENCION! <br />Esto es una funcionalidad para notificar la desaparicion de noticias. ¿Está seguro que desea enviarla?  <br />';
         $msg.='   <a href="#" onClick="send_notify(\''.$_REQUEST['id'].'\',\'send_notify\');"> <img src="themes/default/images/ok.png" title="SI"> SI </a> <a href="#" onClick="hideMsgContainer(\'msgBox\');"> <img src="themes/default/images/no.png" title="NO"> No </a><br /><br />';
         echo $msg;
         exit(0);
    break;
        
    case 'send_notify':
            $article = new Article( $_REQUEST['id'] );
            $article_data=" \n ID -".$article->id;
            $article_data.=" \n Titulo -".$article->title;
            $article_data.=" \n Content_status -".$article->content_status;
            $article_data.=" \n Available -".$article->available;
            $article_data.=" \n Frontpage -".$article->frontpage;
            $article_data.=" \n posic -".$article->position;
            $article_data.=" \n In_home -".$article->in_home;
            $article_data.=" \n home_pos -".$article->home_pos;
            $article_data.=" \n place -".$article->placeholder;
            $article_data.=" \n home_place -".$article->home_placeholder;
            $article_data.=" \n \n category -".$article->category;
            $article_data.=" \n category name -".$article->catName;
            $article_data.=" \n papelera -".$article->in_litter;
            $article_data.=" \n fk_publisher -".$article->fk_publisher;
            $article_data.=" \n fk_user_last_editor -".$article->fk_user_last_editor;

 
   
            $GLOBALS['application']->workflow->log( '\n NOTIFY - ' .
                              $_SESSION['username'] . ' - ' . $sql . ' ' . print_r($article_data,true), PEAR_LOG_INFO );
            $destinatario="sandra@openhost.es";
            $params="";
            $htmlcontent=$article_data;
            send_notify( $destinatario, $htmlcontent );

         $msg='Notificacion enviada <br />';
         $msg.='   <a href="#" onClick="hideMsgContainer(\'msgBox\');"> Aceptar </a><br />';
        echo $msg;
        exit(0);
    break;


    default:
        Application::forward('search_advanced.php');
        return;
}

$tpl->display('search_advanced.tpl');


/*
 * Name: getContentTypes
 *
 * Description: Obtine de la base de datos los distintos tipos de contenidos.
 *
 * Input:   void.
 *
 * Output: array con los distintos tipos de contenidos. ID, Nombre y titulo.
*/
function getContentTypes()
{
    $szSqlContentTypes = "SELECT pk_content_type, name, title FROM content_types";
    $resultSet = $GLOBALS['application']->conn->Execute($szSqlContentTypes);

    if(!$resultSet)
    {
        printf("Get Content Types: Error al obtener el record Set.<br/>" .
            "<pre>" . $szSqlContentTypes . "</pre><br/><br/>");
        return null;
    }

    try
    {
        $resultArray = $resultSet->GetArray();
    }
    catch(exception $e)
    {
        printf("Excepcion: " . $e.message);
        return null;
    }
    return $resultArray;
}

/*
 * Name: checkTypes
 *
 * Description: Parsea el $_REQUEST y obtiene un string con los tipos de contenidos enviados a la página.
 *
 * Input:   $void
 *
 * Output: cadena de texto con los nombre de los tipos de contenidos separados por comas.
*/
function checkTypes(& $htmlCheck)
{
    $arrayTypes = getContentTypes();
    $szTypes;
    foreach($arrayTypes as $aType)
    {

         if ($aType['pk_content_type'] != 5 && $aType['pk_content_type'] != 10){  //Eventos y entrevistas no
            if(isset($_REQUEST[$aType['name']]))
            {
                $szTypes .= $aType['name'] . ", ";
                $htmlCheck .= '<input id="'.$aType['name'] .'" name="' . $aType['name'] .'"  type="checkbox" valign="center" checked="true"/>'.$aType['title'];
            }
            else
            {
                $htmlCheck .= '<input id="'. $aType['name'].'" name="'.$aType['name'].'"  type="checkbox" valign="center"/>'.$aType['title'];
            }
         }
    }
    try
    {
        $szTypes = trim($szTypes);
        $szTypes = substr($szTypes,0,strlen($szTypes)-1);
    }
    catch(exception $e) {}

    return $szTypes;
}

/*
 * Name: PaginateLink
 *
 * Description: Crea los link clicables con tres paginas para seleccionar y un primera y última.
 *
 * Input:   $Pager.......: (object) Paginador de la libreria externa.
 *          $szSearchString..: (strings) Metadatos a buscar en la base de datos.
 *          $arrayCheckedTypes..: (array) Array con los tipos de datos en los cuales buscaremos.
 *
 * Output: codigo html con los links a las diferentes páginas.
*/
function PaginateLink($Pager, $szSearchString, $arrayCheckedTypes)
{
    $szPages=null;
    if($Pager->_totalPages>1)
    {
        $szPages = '<p align="center">';
        if ($Pager->_currentPage != 1)
        {
            $szPages .= '<a style="cursor:pointer;" href="#" onclick="paginate_search(\'search_paging\', 1, \''.
                        $szSearchString.'\', \'';
            foreach($arrayCheckedTypes as $itemType)
                $szPages .= "&".$itemType."=on";
            $szPages .= '\'); return false;">Primera</a> ... | ';
        }

        for($iIndex=$Pager->_currentPage-1; $iIndex<=$Pager->_currentPage+1 && $iIndex <= $Pager->_totalPages;$iIndex++)
        {
            if($Pager->_currentPage == 1)
            {
                if(($iIndex+1) > $Pager->_totalPages)
                    break;
                $szPages .= '<a style="cursor:pointer;" href="#" onclick="paginate_search(\'search_paging\',' .
                            ($iIndex+1) . ', \''. $szSearchString.'\', \'';
                foreach($arrayCheckedTypes as $itemType)
                    $szPages .= "&".$itemType."=on";
                $szPages .= '\'); return false;">';

                if($Pager->_currentPage == ($iIndex+1))
                    $szPages .= '<b>' . ($iIndex+1) . '</b></a> | ';
                else
                    $szPages .= ($iIndex+1) . '</a> | ';
            }
            else
            {
                $szPages .= '<a style="cursor:pointer;" href="#" onclick="paginate_search(\'search_paging\',' .
                            $iIndex . ', \''. $szSearchString.'\', \'';
                foreach($arrayCheckedTypes as $itemType)
                    $szPages .= "&".$itemType."=on";
                $szPages .= '\'); return false;">';

                if($Pager->_currentPage == ($iIndex))
                    $szPages .= '<b>' . $iIndex . '</b></a> | ';
                else
                    $szPages .= $iIndex . '</a> | ';
            }
        }
        if($Pager->_currentPage != $Pager->_lastPageText)
        {
            $szPages .= '... <a style="cursor:pointer;" href="#" onclick="paginate_search(\'search_paging\',' .
                            $Pager->_lastPageText . ', \''. $szSearchString.'\', \'';
            foreach($arrayCheckedTypes as $itemType)
                    $szPages .= "&".$itemType."=on";
                    $szPages .= '\'); return false;">Última</a>';
        }
        $szPages .= "</p> ";
    }
    return $szPages;
}


function send_notify( $destinatario, $htmlcontent ) {
        require_once('libs/phpmailer/class.phpmailer.php');

        	$mail = new PHPMailer();
                $mail->SetLanguage('es');
		$mail->IsSMTP();
		$mail->Host = MAIL_HOST;
		$mail->SMTPAuth = true;
    
		$mail->Username = MAIL_USER;
		$mail->Password = MAIL_PASS;

        // FIXME: Eliminar las cadenas y poner constantes Ó implementar una clase especializada para envíos
		$mail->From = $destinatario;
		$mail->FromName = utf8_decode("OpenNemas");
		$mail->IsHTML(true);


		$mail->AddAddress($destinatario, $destinatario);

                $mail->Subject  = utf8_decode("OpenNemas").' NOTIFY ';

		/* $this->HTML = preg_replace('/>[^<]*"[^<]*</', '&#34;', $this->HTML);
		$this->HTML = preg_replace("/>[^<]*'[^<]*</", '&#39;', $this->HTML); */

		$mail->Body = utf8_decode( $htmlcontent );
//print_r($mail);
		if(!$mail->Send()) {
                //    $this->errors[] = "Error en el envío del mensaje " . $mail->ErrorInfo;

		}
	}
?>
