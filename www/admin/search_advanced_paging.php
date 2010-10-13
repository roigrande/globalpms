<?php
/**
 * ESTE FICHEIRO HAI QUE REFACELO PARA QUE SE UTILICE UNICAMENTE search_advanced.php
 *
 * 28/07/2009 -> Creo que ya no se utiliza en ningun sitio, search_advanced.php no lo hace
 *
 */
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

// Ejemplo para tener objeto global
require_once('core/application.class.php');
Application::import_libs('*');
$app = Application::load();

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);

require_once('core/content_manager.class.php');
require_once('core/content.class.php');
require_once('core/content_category.class.php');
require_once('core/article.class.php');
require_once('core/search.class.php');
require_once('core/content_category.class.php');
require_once('core/photo.class.php');

if(isset($_REQUEST['action']) )
{
	switch($_REQUEST['action'])
    {
        case 'search':

            if( !isset($_REQUEST['stringSearch']) ||
                empty($_REQUEST['stringSearch']))
            {
                $Types = getContentTypes();
                break;
            }
            $Types = getContentTypes();

            $htmlChecks=null;
            $szCheckedTypes = checkTypes();
            $szTags  = trim($_REQUEST['stringSearch']);
            $objSearch = cSearch::Instance();

            $arrayResults = $objSearch->SearchContentsSelectMerge("contents.title, permalink, description, created, contents.pk_content as id, catName, content_types.title, contents.available, content_types.name as content_type",
                    $szTags,
                    $szCheckedTypes,
                    "pk_content = pk_fk_content AND fk_content_type = pk_content_type",
                    "contents_categories, content_types",
                    100);
    }
            
}

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
    'poll' => 'pc_poll.php'
);

//$Pager = null;
if( isset($arrayResults) &&
    !empty($arrayResults))
    $arrayResults = cSearch::Paginate($Pager, $arrayResults, "id", 5);

$htmlPaging = PaginateLink($Pager,$szTags, explode(", ", $szCheckedTypes));
$htmlPaging = '<table align="center"><tr><td>' . $htmlPaging . "</td></tr></table>";

$htmlList = null;

if($arrayResults)
{
    $htmlList = '<table class="adminlist">
                <tr>
                    <th class="title">T&iacute;tulo</th>
                    <th align="center">Tipo de Contenido</th>
                    <th align="center">Secci&oacute;n</th>
                    <th align="center">Fecha</th>
                    <th align="center">Publicado</th>
                    <th align="center">Editar</th>
                    <th align="center">Visualizar</th>
                </tr>';
    foreach ($arrayResults as $item)
    {
        $htmlList .= '<tr {cycle values="class=row0,class=row1"}>
                <td style="padding:10px;font-size: 11px;width:50%;">' . $item[0] .
                '</td>
                <td style="padding:10px;font-size: 11px;width:15%;" align="center">'. $item[6] .
                '</td>
                <td style="padding:10px;font-size: 11px;width:15%;" align="center">' . $item[5] .
                '</td>
                <td style="padding:10px;font-size: 11px;width:15%;" align="center">' . $item[3] .
                '</td>
                <td style="padding:10px;width:10%;" align="center">';
        if ($item[7] == 1)
            $htmlList .= '<img src="' . $tpl->image_dir . 'publish_g.png" border="0" alt="En Portada" />';
        else
            $htmlList .= '<img src="' . $tpl->image_dir . 'publish_r.png" border="0" alt="En Pendientes" />';
            
        $htmlList .= '</td>
                <td style="padding:10px;width:10%;" align="center">
                        <a href="/admin/'.$type2res[$item['content_type']].'?action=read&id=' . $item[4] .'" title="Editar">
                        <img src="' . $tpl->image_dir . 'edit.png" border="0" /></a>
                </td>
                <td style="padding:10px;width:10%;" align="center">
                    <a href="?action=read&id=' .$item[4] . '&stringSearch= ' . $_REQUEST["stringSearch"] .
                    '&page=' . $_REQUEST['page'] . '" title="Visualizar">
                        <img src="' . $tpl->image_dir . 'visualizar.png" border="0" /></a>
                </td>
            </tr>';
    }
    echo  '</table>';
}
echo '<table class="adminheading"><tr>
            <td><b>Resultados de la búsqueda&nbsp&nbsp</b><em>'. $_REQUEST['stringSearch'] .
                '</em></td><td style="font-size: 10px;" align="right"></td></tr>
    </table>';
echo $htmlPaging; //Link superiores de la paginación.
echo $htmlList;
echo $htmlPaging; //Links inferiores de la paginacion.


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
function checkTypes()
{
    $arrayTypes = getContentTypes();
    $szTypes;
    foreach($arrayTypes as $aType)
    {
        if(isset($_REQUEST[$aType['name']]))
        {
            $szTypes .= $aType['name'] . ", ";
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
            $szPages .= '<a style="cursor:pointer;" href="#" onclick="paginate_search(\'search\', 1, \''.
                        $szSearchString.'\', \'';
            foreach($arrayCheckedTypes as $itemType)
                $szPages .= "&".$itemType."=on";
            $szPages .= '\')">Primera</a> ... | ';
        }

        for($iIndex=$Pager->_currentPage-1; $iIndex<=$Pager->_currentPage+1 && $iIndex <= $Pager->_totalPages;$iIndex++)
        {
            if($Pager->_currentPage == 1)
            {
                if(($iIndex+1) > $Pager->_totalPages)
                    break;
                $szPages .= '<a style="cursor:pointer;" href="#" onclick="paginate_search(\'search\',' .
                            ($iIndex+1) . ', \''. $szSearchString.'\', \'';
                foreach($arrayCheckedTypes as $itemType)
                    $szPages .= "&".$itemType."=on";
                $szPages .= '\')">';

                if($Pager->_currentPage == ($iIndex+1))
                    $szPages .= '<b>' . ($iIndex+1) . '</b></a> | ';
                else
                    $szPages .= ($iIndex+1) . '</a> | ';
            }
            else
            {
                $szPages .= '<a style="cursor:pointer;" href="#" onclick="paginate_search(\'search\',' .
                            $iIndex . ', \''. $szSearchString.'\', \'';
                foreach($arrayCheckedTypes as $itemType)
                    $szPages .= "&".$itemType."=on";
                $szPages .= '\')">';

                if($Pager->_currentPage == ($iIndex))
                    $szPages .= '<b>' . $iIndex . '</b></a> | ';
                else
                    $szPages .= $iIndex . '</a> | ';
            }
        }
        if($Pager->_currentPage != $Pager->_lastPageText)
        {
            $szPages .= '... <a style="cursor:pointer;" href="#" onclick="paginate_search(\'search\',' .
                            $Pager->_lastPageText . ', \''. $szSearchString.'\', \'';
            foreach($arrayCheckedTypes as $itemType)
                    $szPages .= "&".$itemType."=on";
            $szPages .= '\')">Última</a>';
        }
        $szPages .= "</p> ";
    }
    return $szPages;
}

?>
