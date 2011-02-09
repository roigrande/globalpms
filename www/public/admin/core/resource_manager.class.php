<?php
/* -*- Mode: PHP; tab-width: 4 -*- */
/**
 * OpenNemas project
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   OpenNemas
 * @package    OpenNemas
 * @copyright  Copyright (c) 2010 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * ContentManager
 *
 * @package    Onm
 * @subpackage Core
 * @copyright  Copyright (c) 2010 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: resource_manager.class.php 1 2010-04-13 11:17:42Z vifito $
 */
class ResourceManager
{
    public $resourceType = null;
    public $table = null;
    public $pager = null;


    public function __construct($resourceType=null)
    {
        $this->ResourceManager($resourceType);
    }


    public function ResourceManager($resourceType=null)
    {
        // Nombre de la tabla en minusculas y
        // tipo de contenido con la sintaxis del nombre de la clase
         
        if(!is_null($resourceType)) {
            $this->init($resourceType);
        }

     //   $this->cache = new MethodCacheManager($this, array('ttl' => 30));
    }


    public function init($resourceType)
    {
        $this->table = $this->pluralize( $resourceType );
        $this->resourceType = $resourceType;
    }


    // Cargar los valores devueltos del sql en objetos.
    public function load_obj($rs,$resourceType)
    {
        //var_dump($rs->fields);
        //var_dump($resource_type);

        $items = array();

        if($rs !== false) {
            while(!$rs->EOF) {
                $obj = new $resourceType();
                $obj->load($rs->fields);
        //var_dump($obj);

                $items[] = $obj;

                $rs->MoveNext();
            }
        }

        return $items;
    }


    public function find($resourceType, $filter='1=1', $_order_by='ORDER BY 1', $fields='*')
    {
   
        $this->init($resourceType);
        $items = array();

//        $_where = '`resources`.`in_litter`=0';

//        if( !is_null($filter) ) {
//            if( $filter == 'in_litter=1') { //se busca desde la litter.php
                $_where = $filter;
//            } else {
//                $_where = ' `resources`.`in_litter`=0 AND '.$filter;
//            }
//        }

        $sql = 'SELECT '.$fields.' FROM `resources`, `'.$this->table.'` ' .
                'WHERE '.$_where.' AND `resources`.`pk_resource`= `'.$this->table.'`.`pk_'.strtolower($resourceType).'` '.$_order_by;


        $rs = $GLOBALS['application']->conn->Execute($sql);
        $items = $this->load_obj($rs, $resourceType);
        return $items;
    }

/*
    public function find_all($resource_type, $filter=null, $_order_by='ORDER BY 1', $fields='*')
    {
        $this->init($resource_type);
        $items = array();

        $_where = '`resources`.`in_litter`=0';

        if( !is_null($filter) ) {
            if( $filter == 'in_litter=1') { //se busca desde la litter.php
                $_where = $filter;
            } else{
                $_where = ' `resources`.`in_litter`=0 AND '.$filter;
            }
        }

        $sql = 'SELECT '.$fields.' FROM `resources`, `'.$this->table.'`, `resources_categories` ' .
                ' WHERE '.$_where.' AND `resources`.`pk_resource`= `'.$this->table.'`.`pk_'.strtolower($resource_type).'` '.
                ' AND `resources`.`pk_resource`= `resources_categories`.`pk_fk_resource` '.$_order_by;

        $rs = $GLOBALS['application']->conn->Execute($sql);
        $items = $this->load_obj($rs, $resource_type);

        return $items;
    }


    /**
     * Count: Contanbiliza el numero de elementos de un tipo.
     */
  /*  public function count($resource_type, $filter=null, $pk_fk_resource_category=null)
    {
        $this->init($resource_type);
        $items = array();
        $_where = 'in_litter=0';

        if( !is_null($filter) ) {
            if(($filter == ' `resources`.`in_litter`=1')|| ($filter == 'in_litter=1')) { //se busca desde la litter.php
                  $_where = $filter;
            } else{
                $_where = ' `resources`.`in_litter`=0 AND '.$filter;
            }
        }

        if( intval($pk_fk_resource_category) != null) {
            $sql = 'SELECT COUNT(resources.pk_resource) FROM `resources_categories`, `resources`, ' . $this->table . '  ' .
                   ' WHERE '.$_where.' AND `resources_categories`.`pk_fk_resource_category`='.$pk_fk_resource_category .
                   '  AND pk_resource=`'.$this->table.'`.`pk_'.strtolower($resource_type) .
                   '` AND  `resources_categories`.`pk_fk_resource` = `resources`.`pk_resource` ';

        } else {
           $sql = 'SELECT COUNT(resources.pk_resource) AS total FROM `resources`, `'.$this->table.'` ' .
                  'WHERE '.$_where.' AND `resources`.`pk_resource`=`'.$this->table.'`.`pk_'.strtolower($resource_type).'` ';
        }

        $rs = $GLOBALS['application']->conn->GetOne($sql);

        return $rs;
    }


    /**
     * find_pages: Se utiliza para generar los listados en la parte de administracion.
     * Genera las consultas de find o find_by_category y la paginacion
     * Devuelve el array con el segmento de resources que se visualizan en la pagina dada.
     *
     * <code>
     * ContentManager::find_pages($resource_type, $filter=null, $_order_by='ORDER BY 1',
     *                            $page=1, $items_page=10, $pk_fk_resource_category=null);
     * </code>
     *
     * @param int $resource_type     Tipo contenido.
     * @param string|null $filter   Condiciones para clausula where.
     * @param string $_order_by     Orden de visualizacion
     * @param int $page             Página que se quiere visualizar.
     * @param int $items_page       Número de elementos por pagina.
     * @param int|null $pk_fk_resource_category Id de categoria (para find_by_category y si null es find).
     * @return array                Array ($items, $pager)
     */
   /* public function find_pages($resource_type, $filter=null, $_order_by='ORDER BY 1', $page=1, $items_page=10,$pk_fk_resource_category=null )
    {
        $this->init($resource_type);
        $items = array();
        $_where = '`resources`.`in_litter`=0';

        if( !is_null($filter) ) {
            if(( $filter == ' `resources`.`in_litter`=1') || ($filter == 'in_litter=1')){ //se busca desde la litter.php
                $_where = $filter;
            } else {
                $_where = ' `resources`.`in_litter`=0 AND '.$filter;
            }
        }
        $total_resources=$this->count($resource_type, $filter, $pk_fk_resource_category);
        if(empty($page)) {
            $page = 1;
        }
        if(empty($page)) {
            $items_page=10;
        }
        $_limit='LIMIT '.($page-1)*$items_page.', '.($items_page);


        if( intval($pk_fk_resource_category) != null) {
            $sql = 'SELECT * FROM resources_categories, resources, '.$this->table.'  ' .
                ' WHERE '.$_where.' AND `resources_categories`.`pk_fk_resource_category`='.$pk_fk_resource_category.
                '  AND `resources`.`pk_resource`=`'.$this->table.'`.`pk_'.strtolower($resource_type).'` AND  `resources_categories`.`pk_fk_resource` = `resources`.`pk_resource` '.
                 $_order_by.$_limit;
        } else {

            $sql = 'SELECT * FROM `resources`, `'.$this->table.'` ' .
                    ' WHERE '.$_where.' AND `resources`.`pk_resource`=`'.$this->table.'`.`pk_'.strtolower($resource_type).'` '.$_order_by.$_limit;
        }

        $rs = $GLOBALS['application']->conn->Execute($sql);

        $items = $this->load_obj($rs, $resource_type);

        $pager_options = array(
            'mode'        => 'Sliding',
            'perPage'     => $items_page,
            'delta'       => 4,
            'clearIfVoid' => true,
            'urlVar'      => 'page',
            'totalItems'  => $total_resources,
        );
        $pager = Pager::factory($pager_options);

        return array($items, $pager);
    }



    //FIXME: unificar todos los paginates
    //create_paginate() -
    /*  PARAMS:
     * $total_items ->num eltos a  paginar
     * $num_pages -> numero de elementos por pagina
     * $delta ->cantidad de numeros que se visualizan.
     *  $function ->nombre de la funcion en js / URL (segun se quiera recargar ajax o una url)
     * $params -> parametros de la funcion js / dir url  que se carga
     */
    public function create_paginate($total_items, $num_pages, $delta, $funcion='null', $params='null')
    {
        if(!isset($num_pages)) {
            $num_pages = 5;
        }

        if(!isset($total_items)) {
            $total_items = 40;
        }

        if(!isset($delta)) {
            $delta = 2;
        }

        $page='page';
        $path='';

        if($funcion == 'URL'){
            $fun="%d/";
            $append=false;
            $path = SITE_URL.$params;

            if($params=='/seccion/opinion') {
                //En listado de opinion, hay dos pages. List autors y list opinions.
                $page='pageop';
            }

        } elseif($function != "null") {
            if($params=='null') {
                $fun = 'javascript:'.$funcion.'(%d)';
            } else {
                $fun = 'javascript:'.$funcion.'('.$params.',%d)';
            }

            $append = false;

        } else {
            $fun = "";
            $append = true;
        }

        $pager_options = array(
            'mode'        => 'Sliding',
            'perPage'     => $num_pages,
            'delta'       => $delta,
            'clearIfVoid' => true,
            'urlVar'      => $page,
            'separator' => '|',
            'spacesBeforeSeparator' => 1,
            'spacesAfterSeparator' => 1,
            'totalItems'  => $total_items,
            'append'      => $append,
            'path'        => $path,
            'fileName'    => $fun,
            'altPage'     => 'Página %d',
            'altFirst'    => 'Primera',
            'altLast'     => 'Última',
            'altPrev'     => 'Página previa',
            'altNext'     => 'Siguiente página'
        );

        $pager = Pager::factory($pager_options);

        return $pager;
    }


    //FIXME: unificar todos los paginates
    //Paginate para resources de num_pages
    //index_paginate_articles
    //Admin  advertisement.php, advertisement_images.php, opinion.php, preview_resource.php
    public function paginate_num($items, $num_pages)
    {
        $_items = array();

        foreach($items as $v) {
            $_items[] = $v->id;
        }

        $items_page = (defined(ITEMS_PAGE))?ITEMS_PAGE: $num_pages;

        $params = array(
            'itemData'    => $_items,
            'perPage'     => $items_page,
            'delta'       => 1, //Num de paginas antes y despues de la actual
            'append'      => true,
            'separator'   => '|',
            'spacesBeforeSeparator' => 1,
            'spacesAfterSeparator'  => 1,
            'clearIfVoid' => true,
            'urlVar'      => 'page',
            'mode'        => 'Sliding',
            'linkClass'   => 'pagination',
            'altFirst'    => 'primera p&aacute;gina',
            'altLast'     => '&uacute;ltima p&aacute;gina',
            'altNext'     => 'p&aacute;gina seguinte',
            'altPrev'     => 'p&aacute;gina anterior',
            'altPage'     => 'p&aacute;gina'
        );

        $this->pager = &Pager::factory($params);
        $data  = $this->pager->getPageData();

        $result = array();
        foreach($items as $k => $v) {
            if( in_array($v->id, $data) ) {
                $result[] = $v; // Array 0-n compatible con sections Smarty
            }
        }

        return($result);
    }


    //Mantener pagina en frontend comentarios y Planconecta.
    //Paginate para resources de num_pages
    public function paginate_num_js($items, $num_pages, $delta, $funcion,$params='null')
    {
        if(!isset($num_pages)){
            $num_pages = 20;
        }

        if(!isset($delta)) {
            $delta = 1;
        }

        if($params=='null') {
            $fun = $funcion.'(%d)';
        } else {
            $fun = $funcion.'('.$params.',%d)';
        }

        $_items = array();

        foreach($items as $v) {
            $_items[] = $v->id;
        }

        $items_page = (defined(ITEMS_PAGE))? ITEMS_PAGE: $num_pages;

        $params = array(
            'itemData'      => $_items,
            'perPage'       => $items_page,
            'delta'         => $delta, //Num de paginas antes y despues de la actual
            'append'        => true,
            'separator'     => '|',
            'spacesBeforeSeparator' => 1,
            'spacesAfterSeparator' => 1,
            'clearIfVoid'   => true,
            'urlVar'        => 'page',
            'mode'          => 'Sliding',
            'append'        => false,
             'path'         => '',
            'fileName'      => 'javascript:'.$fun,
            'linkClass'     => 'pagination',
            'altFirst'      => 'primera p&aacute;gina',
            'altLast'       => '&uacute;ltima p&aacute;gina',
            'altNext'       => 'p&aacute;gina seguinte',
            'altPrev'       => 'p&aacute;gina anterior',
            'altPage'       => 'p&aacute;gina'
        );

        $this->pager = &Pager::factory($params);
        $data  = $this->pager->getPageData();

        $result = array();
        foreach($items as $k => $v) {
            if( in_array($v->id, $data) ) {
                $result[] = $v; // Array 0-n compatible con sections Smarty
            }
        }

        return($result);
    }


    // admin - article.php - search related.
    //FIXME: unificar todos los paginates
    public function paginate_array_num_js($items, $num_pages, $delta, $funcion, $params='null')
    {
        $_items = array();

        foreach($items as $v) {
            $_items[] = $v['id'];
        }

        if(!isset($num_pages)) {
            $num_pages = 20;
        }

        if(!isset($delta)) {
            $delta = 1;
        }

        if($params=='null') {
            $fun = $funcion.'(%d)';
        } else {
            $fun = $funcion.'('.$params.',%d)';
        }

        $items_page = (defined(ITEMS_PAGE))?ITEMS_PAGE: $num_pages;
        //'fileName' => '/opinion/%d'
        $params = array(
            'itemData'      => $_items,
            'perPage'       => $items_page,
            'delta'         => $delta,
            'append'        => true,
            'separator'     => '|',
            'spacesBeforeSeparator' => 1,
            'spacesAfterSeparator' => 1,
            'clearIfVoid'   => true,
            'urlVar'        => 'page',
            'append'        => false,
            'path'          => '',
            'fileName'      => 'javascript:'.$fun,
            'mode'          => 'Sliding',

            'linkClass'     => 'pagination',
            'altFirst'      => 'primera p&aacute;gina',
            'altLast'       => '&uacute;ltima p&aacute;gina',
            'altNext'       => 'p&aacute;gina seguinte',
            'altPrev'       => 'p&aacute;gina anterior',
            'altPage'       => 'p&aacute;gina'
        );

        $this->pager = &Pager::factory($params);
        $data  = $this->pager->getPageData();

        $result = array();
        foreach($items as $k => $v) {
            if( in_array($v['id'], $data) ) {
                $result[] = $v; // Array 0-n compatible con sections Smarty
            }
        }

        return($result);
    }


    //FIXME: pinta las paginas que ejecutan js
    //admin article.php, article_change_videos.php
    public function makePagesLinkjs($Pager, $funcion, $params)
    {
        $szPages=null;
        if($Pager->_totalPages>1) {
            $szPages = '<p align="center">';

            if ($Pager->_currentPage != 1) {
                $szPages .= '<a style="cursor:pointer;" onClick="'.$funcion.'('.$params.',1);">Primera</a> ... | ';
            }

            for($iIndex=$Pager->_currentPage-2; $iIndex<=$Pager->_currentPage+2 && $iIndex <= $Pager->_totalPages;$iIndex++) {

                if($Pager->_currentPage == 1) {
                    if(($iIndex+2) > $Pager->_totalPages) {
                        break;
                    }

                    $szPages .= '<a style="cursor:pointer;" onClick="'.$funcion.'('.$params.','.($iIndex+2).');">';
                    if($Pager->_currentPage == ($iIndex+2)) {
                        $szPages .= '<b>' . ($iIndex+2) . '</b></a> | ';
                    } else {
                        $szPages .= ($iIndex+2) . '</a> | ';
                    }

                } elseif($Pager->_currentPage == 2) {
                    if(($iIndex+1) > $Pager->_totalPages) {
                        break;
                    }

                    $szPages .= '<a style="cursor:pointer;" onClick="'.$funcion.'('.$params.','.($iIndex+1).');">';
                    if($Pager->_currentPage == ($iIndex+1)) {
                        $szPages .= '<b>' . ($iIndex+1) . '</b></a> | ';
                    } else {
                        $szPages .= ($iIndex+1) . '</a> | ';
                    }

                } else {
                    $szPages .= '<a style="cursor:pointer;" onClick="'.$funcion.'('.$params.','.$iIndex.');">';
                    if($Pager->_currentPage == ($iIndex)) {
                        $szPages .= '<b>' . $iIndex . '</b></a> | ';
                    } else {
                        $szPages .= $iIndex . '</a> | ';
                    }
                }

            }

            if($Pager->_currentPage != $Pager->_lastPageText) {
                $szPages .= '... <a style="cursor:pointer;" onClick="' . $funcion .
                                    '(' . $params.','.$Pager->_lastPageText.');">Última </a>';
            }

            $szPages .= "</p> ";
        }

        return $szPages;
    }


    //FIXME: unificar todos los paginates
    //Print Pagination links for function get_images(category,page,action, metadatas)
    //admin article.php, article_change_images.php
    public function makePagesLink($Pager, $category, $action, $metadatas)
    {
        $szPages = null;

        if($Pager->_totalPages>1) {
            $szPages = '<p align="center">';
            if ($Pager->_currentPage != 1) {
                $szPages .= '<a style="cursor:pointer;" onClick="get_images(' .
                        $category.',1, \''.$action.'\', \''.$metadatas.'\');">Primera</a> ... | ';
            }

            for($iIndex=$Pager->_currentPage-2; $iIndex<=$Pager->_currentPage+2 && $iIndex <= $Pager->_totalPages; $iIndex++) {
                if($Pager->_currentPage == 1) {
                    if(($iIndex+2) > $Pager->_totalPages) {
                        break;
                    }

                    $szPages .= '<a style="cursor:pointer;" onClick="get_images('.$category.',' .
                            ($iIndex+2).',     \''.$action.'\', \''.$metadatas.'\');">';

                    if($Pager->_currentPage == ($iIndex+2)) {
                        $szPages .= '<b>' . ($iIndex+2) . '</b></a> | ';
                    } else {
                        $szPages .= ($iIndex+2) . '</a> | ';
                    }

                } elseif($Pager->_currentPage == 2) {
                    if(($iIndex+1) > $Pager->_totalPages) {
                        break;
                    }

                    $szPages .= '<a style="cursor:pointer;" onClick="get_images('.$category.',' .
                            ($iIndex+1).',     \''.$action.'\', \''.$metadatas.'\');">';
                    if($Pager->_currentPage == ($iIndex+1)) {
                        $szPages .= '<b>' . ($iIndex+1) . '</b></a> | ';
                    } else {
                        $szPages .= ($iIndex+1) . '</a> | ';
                    }

                } else {
                    $szPages .= '<a style="cursor:pointer;" onClick="get_images(' . $category.',' .
                            $iIndex.', \''.$action.'\', \''.$metadatas.'\');">';
                    if($Pager->_currentPage == ($iIndex)) {
                        $szPages .= '<b>' . $iIndex . '</b></a> | ';
                    } else {
                        $szPages .= $iIndex . '</a> | ';
                    }
                }

            }

            if($Pager->_currentPage != $Pager->_lastPageText) {
                $szPages .= '... <a style="cursor:pointer;" onClick="get_images('.$category.',' .
                        $Pager->_lastPageText.', \''.$action.'\', \''.$metadatas.'\');">Última </a>';
            }

            $szPages .= "</p> ";
        }

        return $szPages;
    }


    /* FIXME: Establecer los plurales siguiendo el criterio del idioma espanhol
    para otros casos ya tenemos versiones inglesas */
    public function pluralize($name)
    {
        $name = strtolower($name);
        return $name . 's';
    }


    //Coge todos los tipos que hay en la tabla
    public function get_types()
    {
        $items = array();
        $sql = 'SELECT pk_resource_type, name FROM resource_types ';

        $rs = $GLOBALS['application']->conn->Execute($sql);
        while(!$rs->EOF) {
            $items[ $rs->fields['pk_resource_type'] ] = $rs->fields['name'];
            $rs->MoveNext();
        }

        return $items;
    }


    //Devuelve un array de objetos segun se pase un array de id's
    public function getContents($pk_resources)
    {
        $resources = array();
        if( is_array($pk_resources) && count($pk_resources) > 0 ) {
            $sql  = 'SELECT * FROM `resources` WHERE pk_resource IN ('.implode(',', $pk_resources).')';
            $rs = $GLOBALS['application']->conn->Execute($sql);

            if($rs !== false) {
                while(!$rs->EOF) {
                    $obj = new Content();
                    $obj->load($rs->fields);
                    $obj->resource_type = $GLOBALS['application']->conn->GetOne('SELECT title FROM `resource_types` WHERE pk_resource_type = "' .
                                                                                    $obj->fk_resource_type . '"');
                    $obj->category_name = $obj->loadCategoryName($obj->id);

                    $resources[] = $obj;

                    $rs->MoveNext();
                }
            }
        }

        $resourcesOrdered = array();
        foreach($pk_resources as $pk_resource) {
            foreach($resources as $resource) {
                if($resource->pk_resource == $pk_resource) {
                    $resourcesOrdered[] = $resource;
                    break;
                }
            }
        }

        return $resourcesOrdered;
    }

}
