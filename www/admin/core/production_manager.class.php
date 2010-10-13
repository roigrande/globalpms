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
 * @license    GPL v2 License
 */

/**
 * ProductionManager
 * 
 * @package    Onm
 * @subpackage Core
 * @copyright  Copyright (c) 2010 Openhost S.L. (http://openhost.es)
 * @license    GPL v2 License
 * @version    $Id: production_manager.class.php 1 2010-08-26 18:46:10Z roigrande $
 */
class ProductManager
{
    public $content_type = null;
    public $table = null;
    public $pager = null;
    
    
    public function __construct()
    {
        $this->ProductManager();
    }
    
    
    public function ProductManager()
    {
        // Nombre de la tabla en minusculas y
        // tipo de contenido con la sintaxis del nombre de la clase
        if(!is_null()) {
            $this->init();
        }
        
        $this->cache = new MethodCacheManager($this, array('ttl' => 30));
    }
    
    
    public function init($production)
    {
        $this->table = $this->pluralize( $production);
        $this->production = $production;
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
    
    /** REVISAR
     * find: Se utiliza para generar los listados en la parte de administracion.
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
    public function find($production, $filter=null, $_order_by='ORDER BY 1', $fields='*')
    {
        $this->init($production);
        $items = array();
        
        $_where = '`production`.`budget`=0';
        
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
    
     /** REVISAR
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
    public function find_all($filter=null, $_order_by='ORDER BY 1', $fields='*')
    {
        $items = array();
        
        $_where = '`production`.`in_litter`=0';
        
        if( !is_null($filter) ) {
            if( $filter == 'in_litter=1') { //se busca desde la litter.php
                $_where = $filter;
            } else{
                $_where = ' `contents`.`in_litter`=0 AND '.$filter;
            }
        }
        
        $sql = 'SELECT '.$fields.' FROM `production` ' .
                ' WHERE '.$_where;
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        $items = $this->load_obj($rs, $content_type);
        
        return $items;
    }
    
   
    /**
     * Count: 
     */
     /** REVISAR
     * Count: Contanbiliza el numero de elementos de un tipo.
     * Devuelve 
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
    
    
    
    
}
