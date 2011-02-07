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
 * @version    $Id: content_manager.class.php 1 2010-04-13 11:17:42Z vifito $
 */
class ContentManager 
{
    public $content_type = null;
    public $table = null;
    public $pager = null;
    
    
    public function __construct($content_type=null)
    {
        $this->ContentManager($content_type);
    }
    
    
    public function ContentManager($content_type=null)
    {
        // Nombre de la tabla en minusculas y
        // tipo de contenido con la sintaxis del nombre de la clase
        if(!is_null($content_type)) {
            $this->init($content_type);
        }
        
        $this->cache = new MethodCacheManager($this, array('ttl' => 30));
    }
    
    
    public function init($content_type)
    {
        $this->table = $this->pluralize( $content_type );
        $this->content_type = $content_type;
    }
    
    
    // Cargar los valores devueltos del sql en objetos.
    public function load_obj($rs,$content_type)
    {
        $items = array();
        
        if($rs !== false) {
            while(!$rs->EOF) {
                $obj = new $content_type();
                $obj->load($rs->fields);

                $items[] = $obj;
                
                $rs->MoveNext();
            }
        }
        
        return $items;
    }
    
    
    public function find($content_type, $filter=null, $_order_by='ORDER BY 1', $fields='*')
    {
        $this->init($content_type);
        $items = array();
        
        $_where = '`contents`.`in_litter`=0';
        
        if( !is_null($filter) ) {
            if( $filter == 'in_litter=1') { //se busca desde la litter.php
                $_where = $filter;
            } else {
                $_where = ' `contents`.`in_litter`=0 AND '.$filter;
            }
        }
        
        $sql = 'SELECT '.$fields.' FROM `contents`, `'.$this->table.'` ' .
                'WHERE '.$_where.' AND `contents`.`pk_content`= `'.$this->table.'`.`pk_'.strtolower($content_type).'` '.$_order_by;
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        $items = $this->load_obj($rs, $content_type);
        
        return $items;
    }
    
    
    public function find_all($content_type, $filter=null, $_order_by='ORDER BY 1', $fields='*')
    {
        $this->init($content_type);
        $items = array();
        
        $_where = '`contents`.`in_litter`=0';
        
        if( !is_null($filter) ) {
            if( $filter == 'in_litter=1') { //se busca desde la litter.php
                $_where = $filter;
            } else{
                $_where = ' `contents`.`in_litter`=0 AND '.$filter;
            }
        }
        
        $sql = 'SELECT '.$fields.' FROM `contents`, `'.$this->table.'`, `contents_categories` ' .
                ' WHERE '.$_where.' AND `contents`.`pk_content`= `'.$this->table.'`.`pk_'.strtolower($content_type).'` '.
                ' AND `contents`.`pk_content`= `contents_categories`.`pk_fk_content` '.$_order_by;
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        $items = $this->load_obj($rs, $content_type);
        
        return $items;
    }
    
   
    /**
     * Count: Contanbiliza el numero de elementos de un tipo.
     */
    public function count($content_type, $filter=null, $pk_fk_content_category=null)
    {
        $this->init($content_type);
        $items = array();
        $_where = 'in_litter=0';
        
        if( !is_null($filter) ) {
            if(($filter == ' `contents`.`in_litter`=1')|| ($filter == 'in_litter=1')) { //se busca desde la litter.php
                  $_where = $filter;
            } else{
                $_where = ' `contents`.`in_litter`=0 AND '.$filter;
            }
        }
        
        if( intval($pk_fk_content_category) != null) {
            $sql = 'SELECT COUNT(contents.pk_content) FROM `contents_categories`, `contents`, ' . $this->table . '  ' .
                   ' WHERE '.$_where.' AND `contents_categories`.`pk_fk_content_category`='.$pk_fk_content_category .
                   '  AND pk_content=`'.$this->table.'`.`pk_'.strtolower($content_type) .
                   '` AND  `contents_categories`.`pk_fk_content` = `contents`.`pk_content` ';
                
        } else {
           $sql = 'SELECT COUNT(contents.pk_content) AS total FROM `contents`, `'.$this->table.'` ' .
                  'WHERE '.$_where.' AND `contents`.`pk_content`=`'.$this->table.'`.`pk_'.strtolower($content_type).'` ';
        }
        
        $rs = $GLOBALS['application']->conn->GetOne($sql);
        
        return $rs;
    }
    
    
    /**
     * find_pages: Se utiliza para generar los listados en la parte de administracion.
     * Genera las consultas de find o find_by_category y la paginacion
     * Devuelve el array con el segmento de contents que se visualizan en la pagina dada.
     * 
     * <code>
     * ContentManager::find_pages($content_type, $filter=null, $_order_by='ORDER BY 1',
     *                            $page=1, $items_page=10, $pk_fk_content_category=null);
     * </code>
     * 
     * @param int $content_type     Tipo contenido.
     * @param string|null $filter   Condiciones para clausula where.
     * @param string $_order_by     Orden de visualizacion
     * @param int $page             Página que se quiere visualizar.
     * @param int $items_page       Número de elementos por pagina.
     * @param int|null $pk_fk_content_category Id de categoria (para find_by_category y si null es find).
     * @return array                Array ($items, $pager)
     */
    public function find_pages($content_type, $filter=null, $_order_by='ORDER BY 1', $page=1, $items_page=10,$pk_fk_content_category=null )
    {
        $this->init($content_type);
        $items = array();
        $_where = '`contents`.`in_litter`=0';
        
        if( !is_null($filter) ) {
            if(( $filter == ' `contents`.`in_litter`=1') || ($filter == 'in_litter=1')){ //se busca desde la litter.php
                $_where = $filter;
            } else {
                $_where = ' `contents`.`in_litter`=0 AND '.$filter;
            }
        }
        $total_contents=$this->count($content_type, $filter, $pk_fk_content_category);
        if(empty($page)) {
            $page = 1;
        }
        if(empty($page)) {
            $items_page=10;
        }
        $_limit='LIMIT '.($page-1)*$items_page.', '.($items_page);
        
   
        if( intval($pk_fk_content_category) != null) {
            $sql = 'SELECT * FROM contents_categories, contents, '.$this->table.'  ' .
                ' WHERE '.$_where.' AND `contents_categories`.`pk_fk_content_category`='.$pk_fk_content_category.
                '  AND `contents`.`pk_content`=`'.$this->table.'`.`pk_'.strtolower($content_type).'` AND  `contents_categories`.`pk_fk_content` = `contents`.`pk_content` '.
                 $_order_by.$_limit;
        } else {

            $sql = 'SELECT * FROM `contents`, `'.$this->table.'` ' .
                    ' WHERE '.$_where.' AND `contents`.`pk_content`=`'.$this->table.'`.`pk_'.strtolower($content_type).'` '.$_order_by.$_limit;
        }
     
        $rs = $GLOBALS['application']->conn->Execute($sql); 

        $items = $this->load_obj($rs, $content_type);

        $pager_options = array(
            'mode'        => 'Sliding',
            'perPage'     => $items_page,
            'delta'       => 4,
            'clearIfVoid' => true,
            'urlVar'      => 'page',
            'totalItems'  => $total_contents,
        );
        $pager = Pager::factory($pager_options);
        
        return array($items, $pager);
    }
    
    
    public function find_by_category($content_type, $pk_fk_content_category, $filter=null, $_order_by='ORDER BY 1')
    {
        $this->init($content_type);
        
        $items = array();
        $_where = 'AND in_litter=0';
        
        if( !is_null($filter) ) {
            if( $filter == 'in_litter=1') { //se busca desde la litter.php
                $_where = $filter;
            } else {
                $_where = ' in_litter=0 AND '.$filter;
            }
        }
        
        if( intval($pk_fk_content_category) > 0 ) {
            $sql = 'SELECT * FROM contents_categories, contents, '.$this->table.'  ' .
                   'WHERE '.$_where.' AND `contents_categories`.`pk_fk_content_category`=' .
                   $pk_fk_content_category.'  AND `contents`.`pk_content`=`' . $this->table . '`.`pk_'.strtolower($content_type) .
                   '` AND  `contents_categories`.`pk_fk_content` = `contents`.`pk_content` ' . $_order_by;
        } else {
            return( $items );
        }
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        
        $items=$this->load_obj($rs,$content_type);
        
        return $items;
    }
    
    
    public function find_by_category_name($content_type, $category_name, $filter=null, $_order_by='ORDER BY 1')
    {
        $this->init($content_type); //recupera el id de la categoria del array.
        $pk_fk_content_category=$this->get_id($category_name);
        $items = array();
        $_where = 'in_litter=0';
        
        if( !is_null($filter) ) {
            if( preg_match('/in_litter=1/i', $filter) ) { //se busca desde la litter.php
                $_where = $filter;
            } else {
                $_where = $filter.' AND in_litter=0';
            }
        }
        
        $sql = 'SELECT * FROM contents_categories, contents,  '.$this->table.'  ' .
                'WHERE '.$_where.' AND `contents_categories`.`pk_fk_content_category`='.$pk_fk_content_category .
                '  AND `contents`.`pk_content`= `'.$this->table.'`.`pk_'.strtolower($content_type) .
                '` AND `contents_categories`.`pk_fk_content` = `contents`.`pk_content` '.$_order_by;
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        
        $items = $this->load_obj($rs,$content_type);      
        
        return $items;
    }
    
    
    //this function returns last contents of Subcategories of a given category
    public function find_inSubcategory_by_categoryName($content_type, $category_name, $filter=null, $_order_by='ORDER BY 1')
    {
        $this->init($content_type);
        $items = array();
        $_where = '1=1  AND in_litter=0';
        
        if( !is_null($filter) )
        {
            if( $filter == 'in_litter=1') {
                //se busca desde la litter.php
                $_where = $filter;
            }
            
            $_where = $filter.' AND in_litter=0';
        }
        
        $sql= 'SELECT contents.pk_content FROM contents,content_categories, contents_categories '. $_where.
              ' AND content_categories.fk_content_category=\''.$this->get_id($category_name).'\''.
              ' WHERE content_categories.pk_content_category=contents_categories.pk_fk_content_category '.
              ' AND contents.pk_content = contents_categories.pk_fk_content '. $_order_by;
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        
        if (!$rs) {
            return( $items );
            
        } else {
            $items=$this->load_obj($rs,$content_type);      
        }
        
        return( $items );
    }
    
    
    //Find title, date and permalink from category id.
    // Assing values to new object call Headline
    public function find_category_headline($pk_fk_content_category, $filter=null, $_order_by='ORDER BY 1')
    {
        $_where = 'in_litter=0';
        if( !is_null($filter) ) {
            if( preg_match('/in_litter=1/i', $filter) ) {
                //se busca desde la litter.php
                $_where = $filter;
            } else {
                $_where = $filter.' AND in_litter=0';
            }
        }
        
        $sql = 'SELECT contents.pk_content, contents.title, contents.permalink, contents.created, contents.changed,
                       contents.starttime, contents.endtime  FROM contents_categories, contents ' .
               'WHERE contents.fk_content_type=1 and '.$_where.' AND pk_fk_content_category=\'' .
               $pk_fk_content_category.'\'  AND  pk_fk_content = pk_content '.$_order_by;
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        
        $items = $this->load_obj($rs, 'Headline');
        return $items;
    }
    
    
    //this function returns title,catName and permalinks of last headlines from Subcategories of a given category
    public function find_headlines(/*$filter=null, $_order_by='ORDER BY 1'*/)
    {
        $sql = 'SELECT `contents`.`title` , `contents`.`created` ,  `contents`.`permalink` , `contents`.`starttime` ,
                       `contents`.`endtime` , `contents_categories`.`pk_fk_content_category` AS `category_id` 
                FROM `contents`
                    LEFT JOIN contents_categories ON ( `contents`.`pk_content` = `contents_categories`.`pk_fk_content` )
                WHERE `contents`.`content_status` =1
                    AND `contents`.`frontpage` =1
                    AND `contents`.`available` =1
                    AND `contents`.`fk_content_type` =1
                    AND `contents`.`in_litter` =0
                ORDER BY `contents`.`placeholder` ASC, `created` DESC ';
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        $ccm = ContentCategoryManager::get_instance();
        
        while(!$rs->EOF) {
            $items[] = array(
                'title'=>$rs->fields['title'],
                'catName'=> $ccm->get_name($rs->fields['category_id']),
                'permalink'=> $rs->fields['permalink'],
                'created'=> $rs->fields['created'],
                'category_title'=> $ccm->get_title($ccm->get_name($rs->fields['category_id']))
            );
            
            $rs->MoveNext();
        }
        
        $items = $this->getInTime($items);
        
        return( $items );
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
    //Paginate para contents de num_pages
    //index_paginate_articles
    //Admin  advertisement.php, advertisement_images.php, opinion.php, preview_content.php
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
    //Paginate para contents de num_pages
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
        $sql = 'SELECT pk_content_type, name FROM content_types ';
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        while(!$rs->EOF) {
            $items[ $rs->fields['pk_content_type'] ] = $rs->fields['name'];
            $rs->MoveNext();
        }
        
        return $items;
    }
    
    
    //returns an array with permalinks of the articles in the subsections of a given section
    public function get_permalinks_by_categoryID($categoryID, $filter=null, $_order_by='ORDER BY 1')
    {
        $this->init($content_type); // ¿?¿?¿? $content_type ¿?¿?¿?
        $items = array();
        $_where = '1=1  AND in_litter=0';
        
        if( !is_null($filter) ) {
            if( $filter == 'in_litter=1') {
                $_where = $filter;
            }
            
            $_where = $filter . ' AND in_litter=0';
        }
        
        $sql= 'SELECT contents.title, contents.permalink, contents.created, contents.changed,
                      contents.metadata, contents.starttime, contents.endtime FROM contents, contents_categories 
               WHERE contents.pk_content = contents_categories.pk_fk_content 
                     AND contents_categories.pk_fk_content_category=\''.$categoryID.'\' 
                     AND '.$_where.' '.$_order_by;
        
        $GLOBALS['application']->conn->SetFetchMode(ADODB_FETCH_ASSOC);
        $rs = $GLOBALS['application']->conn->Execute($sql);
        
        $items = $rs->GetArray();
        return $items;
    }
    
    
    /**
      * Get authors for sitemap XML
      *
      * @param string $filter
      * @param string $_order_by
      * @return array
     */
    public function getOpinionAuthorsPermalinks($filter=null, $_order_by='ORDER BY 1')
    {
        $this->init($content_type);
        $items = array();
        $_where = '1=1  AND in_litter=0';
        
        if( !is_null($filter) ) {
            if( $filter == 'in_litter=1') {
                //se busca desde la litter.php
                $_where = $filter;
            }
            
            $_where = $filter.' AND in_litter=0';
        }
        
        // METER TB LEFT JOIN
        //necesita el as id para paginacion
        
         $sql= 'SELECT contents.title, contents.metadata,contents.permalink,contents.changed,contents.starttime,contents.endtime 
                FROM contents, opinions
                    LEFT JOIN authors ON (authors.pk_author=opinions.fk_author)
                    LEFT JOIN author_imgs ON (opinions.fk_author_img=author_imgs.pk_img)
                WHERE `contents`.`fk_content_type`=4 and contents.pk_content=opinions.pk_opinion
                    AND '.$_where.' '.$_order_by;
        
        $GLOBALS['application']->conn->SetFetchMode(ADODB_FETCH_ASSOC);
        $rs = $GLOBALS['application']->conn->Execute($sql);
        $items = $rs->GetArray();
        
        return $items;
    }
    
    
    /// QUITAR - esta en content_category_manager
    //Returns cetegory id
    public function get_id($category)
    {
        $sql = 'SELECT pk_content_category FROM content_categories WHERE name = \''.$category.'\'';
        //echo "<hr>".$sql."<br>";
        $rs = $GLOBALS['application']->conn->Execute( $sql );
        
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }
        
        return $rs->fields['pk_content_category'];
    }
    
    
    //Returns categoryName with the content Id
    public function get_categoryName_by_contentId($contentId)
    {
        $sql = 'SELECT pk_fk_contents_category FROM `contents_categories` where pk_fk_content = \''.$contentId.'\'';
        $rs = $GLOBALS['application']->conn->GetOne($sql);
        
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }
        
        $category_name=$this->get_title($rs);
        
        return $category_name;
    }
    
    
    //Devuelve un array de objetos segun se pase un array de id's
    public function getContents($pk_contents)
    {
        $contents = array();
        if( is_array($pk_contents) && count($pk_contents) > 0 ) {
            $sql  = 'SELECT * FROM `contents` WHERE pk_content IN ('.implode(',', $pk_contents).')';
            $rs = $GLOBALS['application']->conn->Execute($sql);
            
            if($rs !== false) {
                while(!$rs->EOF) {
                    $obj = new Content();
                    $obj->load($rs->fields);
                    $obj->content_type = $GLOBALS['application']->conn->GetOne('SELECT title FROM `content_types` WHERE pk_content_type = "' .
                                                                                    $obj->fk_content_type . '"');
                    $obj->category_name = $obj->loadCategoryName($obj->id);
                    
                    $contents[] = $obj; 
                    
                    $rs->MoveNext();
                }
            }
        }
        
        $contentsOrdered = array();
        foreach($pk_contents as $pk_content) {
            foreach($contents as $content) {
                if($content->pk_content == $pk_content) {
                    $contentsOrdered[] = $content;
                    break;
                }
            }
        }
        
        return $contentsOrdered;
    }
    
}
