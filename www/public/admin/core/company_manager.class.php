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
 * @version    $Id: company_manager.class.php 1 2010-04-13 11:17:42Z vifito $
 */
class CompanyManager
{
    public $companyType = null;
    public $table = null;
    public $pager = null;


    public function __construct($companyType=null)
    {
              
        if(!is_null($companyType)) {
            $this->init($companyType);
        }

    }

    public function init($companyType)
    {
        $this->table = $this->pluralize($companyType);
        $this->companyType = $companyType;
    }


    // Cargar los valores devueltos del sql en objetos.
    public function load_obj($rs)
    {      
        $items = array();
        if($rs !== false) {
            while(!$rs->EOF) {
                $obj = new Company();
                $obj->load($rs->fields);
                $items[] = $obj;
                $rs->MoveNext();
            }
        }
        return $items;
    }


    public function find($companyType, $filter='1=1', $_order_by='ORDER BY 1', $fields='*')
    {
   
        $this->init($companyType);
        $items = array();

//        $_where = '`companys`.`in_litter`=0';

//        if( !is_null($filter) ) {
//            if( $filter == 'in_litter=1') { //se busca desde la litter.php
                $_where = $filter;
//            } else {
//                $_where = ' `companys`.`in_litter`=0 AND '.$filter;
//            }
//        }

        $sql = 'SELECT '.$fields.' FROM `companies` '.
                'WHERE '.$_where. $_order_by;
                echo $sql;

        $rs = $GLOBALS['application']->conn->Execute($sql);
        $items = $this->load_obj($rs);
        return $items;
    }

/*
    public function find_all($company_type, $filter=null, $_order_by='ORDER BY 1', $fields='*')
    {
        $this->init($company_type);
        $items = array();

        $_where = '`companys`.`in_litter`=0';

        if( !is_null($filter) ) {
            if( $filter == 'in_litter=1') { //se busca desde la litter.php
                $_where = $filter;
            } else{
                $_where = ' `companys`.`in_litter`=0 AND '.$filter;
            }
        }

        $sql = 'SELECT '.$fields.' FROM `companys`, `'.$this->table.'`, `companys_categories` ' .
                ' WHERE '.$_where.' AND `companys`.`pk_company`= `'.$this->table.'`.`pk_'.strtolower($company_type).'` '.
                ' AND `companys`.`pk_company`= `companys_categories`.`pk_fk_company` '.$_order_by;

        $rs = $GLOBALS['application']->conn->Execute($sql);
        $items = $this->load_obj($rs, $company_type);

        return $items;
    }


    /**
     * Count: Contanbiliza el numero de elementos de un tipo.
     */
  /*  public function count($company_type, $filter=null, $pk_fk_company_category=null)
    {
        $this->init($company_type);
        $items = array();
        $_where = 'in_litter=0';

        if( !is_null($filter) ) {
            if(($filter == ' `companys`.`in_litter`=1')|| ($filter == 'in_litter=1')) { //se busca desde la litter.php
                  $_where = $filter;
            } else{
                $_where = ' `companys`.`in_litter`=0 AND '.$filter;
            }
        }

        if( intval($pk_fk_company_category) != null) {
            $sql = 'SELECT COUNT(companys.pk_company) FROM `companys_categories`, `companys`, ' . $this->table . '  ' .
                   ' WHERE '.$_where.' AND `companys_categories`.`pk_fk_company_category`='.$pk_fk_company_category .
                   '  AND pk_company=`'.$this->table.'`.`pk_'.strtolower($company_type) .
                   '` AND  `companys_categories`.`pk_fk_company` = `companys`.`pk_company` ';

        } else {
           $sql = 'SELECT COUNT(companys.pk_company) AS total FROM `companys`, `'.$this->table.'` ' .
                  'WHERE '.$_where.' AND `companys`.`pk_company`=`'.$this->table.'`.`pk_'.strtolower($company_type).'` ';
        }

        $rs = $GLOBALS['application']->conn->GetOne($sql);

        return $rs;
    }


    /**
     * find_pages: Se utiliza para generar los listados en la parte de administracion.
     * Genera las consultas de find o find_by_category y la paginacion
     * Devuelve el array con el segmento de companys que se visualizan en la pagina dada.
     *
     * <code>
     * ContentManager::find_pages($company_type, $filter=null, $_order_by='ORDER BY 1',
     *                            $page=1, $items_page=10, $pk_fk_company_category=null);
     * </code>
     *
     * @param int $company_type     Tipo contenido.
     * @param string|null $filter   Condiciones para clausula where.
     * @param string $_order_by     Orden de visualizacion
     * @param int $page             Página que se quiere visualizar.
     * @param int $items_page       Número de elementos por pagina.
     * @param int|null $pk_fk_company_category Id de categoria (para find_by_category y si null es find).
     * @return array                Array ($items, $pager)
     */
   /* public function find_pages($company_type, $filter=null, $_order_by='ORDER BY 1', $page=1, $items_page=10,$pk_fk_company_category=null )
    {
        $this->init($company_type);
        $items = array();
        $_where = '`companys`.`in_litter`=0';

        if( !is_null($filter) ) {
            if(( $filter == ' `companys`.`in_litter`=1') || ($filter == 'in_litter=1')){ //se busca desde la litter.php
                $_where = $filter;
            } else {
                $_where = ' `companys`.`in_litter`=0 AND '.$filter;
            }
        }
        $total_companys=$this->count($company_type, $filter, $pk_fk_company_category);
        if(empty($page)) {
            $page = 1;
        }
        if(empty($page)) {
            $items_page=10;
        }
        $_limit='LIMIT '.($page-1)*$items_page.', '.($items_page);


        if( intval($pk_fk_company_category) != null) {
            $sql = 'SELECT * FROM companys_categories, companys, '.$this->table.'  ' .
                ' WHERE '.$_where.' AND `companys_categories`.`pk_fk_company_category`='.$pk_fk_company_category.
                '  AND `companys`.`pk_company`=`'.$this->table.'`.`pk_'.strtolower($company_type).'` AND  `companys_categories`.`pk_fk_company` = `companys`.`pk_company` '.
                 $_order_by.$_limit;
        } else {

            $sql = 'SELECT * FROM `companys`, `'.$this->table.'` ' .
                    ' WHERE '.$_where.' AND `companys`.`pk_company`=`'.$this->table.'`.`pk_'.strtolower($company_type).'` '.$_order_by.$_limit;
        }

        $rs = $GLOBALS['application']->conn->Execute($sql);

        $items = $this->load_obj($rs, $company_type);

        $pager_options = array(
            'mode'        => 'Sliding',
            'perPage'     => $items_page,
            'delta'       => 4,
            'clearIfVoid' => true,
            'urlVar'      => 'page',
            'totalItems'  => $total_companys,
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
    //Paginate para companys de num_pages
    //index_paginate_articles
    //Admin  advertisement.php, advertisement_images.php, opinion.php, preview_company.php
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
    //Paginate para companys de num_pages
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
        $sql = 'SELECT pk_company_type, name FROM company_types ';

        $rs = $GLOBALS['application']->conn->Execute($sql);
        while(!$rs->EOF) {
            $items[ $rs->fields['pk_company_type'] ] = $rs->fields['name'];
            $rs->MoveNext();
        }

        return $items;
    }


    //Devuelve un array de objetos segun se pase un array de id's
    public function getContents($pk_companys)
    {
        $companys = array();
        if( is_array($pk_companys) && count($pk_companys) > 0 ) {
            $sql  = 'SELECT * FROM `companys` WHERE pk_company IN ('.implode(',', $pk_companys).')';
            $rs = $GLOBALS['application']->conn->Execute($sql);

            if($rs !== false) {
                while(!$rs->EOF) {
                    $obj = new Content();
                    $obj->load($rs->fields);
                    $obj->company_type = $GLOBALS['application']->conn->GetOne('SELECT title FROM `company_types` WHERE pk_company_type = "' .
                                                                                    $obj->fk_company_type . '"');
                    $obj->category_name = $obj->loadCategoryName($obj->id);

                    $companys[] = $obj;

                    $rs->MoveNext();
                }
            }
        }

        $companysOrdered = array();
        foreach($pk_companys as $pk_company) {
            foreach($companys as $company) {
                if($company->pk_company == $pk_company) {
                    $companysOrdered[] = $company;
                    break;
                }
            }
        }

        return $companysOrdered;
    }

}
