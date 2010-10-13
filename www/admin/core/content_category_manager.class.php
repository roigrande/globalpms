<?php

class ContentCategoryManager {
    
    /**
     * @var array with categories
     */
    public $categories = null;
    
    /**
     * @var ContentCategoryManager instance, singleton pattern
     */
    static private $instance = null;

    function __construct() {
        if( is_null(self::$instance) ) {                        
            // Posibilidad de cachear resultados de métodos
            $this->cache = new MethodCacheManager($this, array('ttl' => 30));
            
            // Rellenar categorías dende caché            
            $this->categories = $this->cache->populate_categories();
            
            self::$instance = $this;                        
            return self::$instance;
        } else {
           return self::$instance;
        }        
    }
    
    static function get_instance() {
        if( is_null(self::$instance) ) {
            $instance = new ContentCategoryManager();
            
            self::$instance = $instance;
            return self::$instance;
        } else {
            return self::$instance;
        }
       
    }     
    
    /**
     * populate_categories, load internal array $this->categories for a
     * singleton instance
     *
     * @return array Array with Content_category objects
    */
    function populate_categories() {
        $sql = 'SELECT * FROM content_categories';
        $rs = $GLOBALS['application']->conn->Execute( $sql );
        
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            // FIXME: controlar erros
            return('');
        }
        
        // clear content
        $this->categories = array();        
        if($rs!=false) {
            while($obj = $rs->FetchNextObject($toupper=false)) {            
                $this->categories[ $obj->pk_content_category ] = $obj;
            }
        }        
        
        return( $this->categories );
    }
    
    
 /**
     * find objects of category and subcategory
     *
     * @param $filter - filter of sql
     * @param $order_by
     * @return array Return category objects
    */
    function find($filter=NULL, $_order_by='ORDER BY 1') {
        $items = array();
        $_where = '1=1';

        if( !is_null($filter) ) {
            $_where = $filter;
        }

        $sql = 'SELECT * FROM content_categories ' .
                'WHERE  '.$_where.' '.$_order_by;   

        $rs = $GLOBALS['application']->conn->Execute($sql);
        if($rs !== false) {
            while(!$rs->EOF) {                
                $obj = new ContentCategory();
                $obj->load($rs->fields);
                
                $items[] = $obj;
                
                $rs->MoveNext();
            }
        }
        
        return $items;
    }    

/**
     * find category and subcategory of type content.
     * @param $fk_content_type type of elements category.
     * @param $filter - filter of sql
     * @param $order_by
     * @return array Return category objects
    */
    
    //Returns an all cetegories array
    function get_all_categories() {
        if( is_null($this->categories) ) {
            $sql = 'SELECT name FROM content_categories';
          
            $rs = $GLOBALS['application']->conn->Execute( $sql );
            
            if (!$rs) {
                $error_msg = $GLOBALS['application']->conn->ErrorMsg();
                $GLOBALS['application']->logger->debug('Error: '.$error_msg);
                $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
                return;
            }
            
            $items = array ();
            while(!$rs->EOF) {
                $str = $rs->fields['name'];
                $items[$str]=0;
                $rs->MoveNext();
            }
                
            return $items;
        }
        
        // Singleton version
        $items = array();
        foreach($this->categories as $category) {
            $items[$category->name] = 0;
        }
        
        return( $items );
    }

        //Returns an all cetegories array
    function get_all_categoriesID() {
        if( is_null($this->categories) ) {
            $sql = 'SELECT pk_content_category FROM content_categories';
            $rs = $GLOBALS['application']->conn->Execute( $sql );
            
            if (!$rs) {
                $error_msg = $GLOBALS['application']->conn->ErrorMsg();
                $GLOBALS['application']->logger->debug('Error: '.$error_msg);
                $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
                return;
            }
            $items = array ();
            while(!$rs->EOF) {
                $str = $rs->fields['pk_content_category'];
                $items[$str]=$str;
                $rs->MoveNext();
            }
            
            return $items;
        }
        
        // Singleton version
        $items = array();
        foreach($this->categories as $category) {
             
                $items[$category->pk_content_category] = $category->pk_content_category;
             
        }
        
        return( $items );    
    }

    //Devuelve el nombre de una categoria para los upload y posible las urls
    function get_name($id) {
        if( is_null($this->categories) ) {
            $sql = 'SELECT name FROM content_categories WHERE pk_content_category = ?';
            $rs = $GLOBALS['application']->conn->Execute( $sql, array($id) );
    
            if (!$rs) {
                $error_msg = $GLOBALS['application']->conn->ErrorMsg();
                $GLOBALS['application']->logger->debug('Error: '.$error_msg);
                $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
                return;
            }
            return $rs->fields['name'];         
        }
        
        if(isset($this->categories[$id]->name)) {
            return($this->categories[$id]->name);
        } else {
            return('');
        }
    }

    //Returns false if the category does not exist
    function exists($category_name) {
        if( is_null($this->categories) ) {
            $sql = 'SELECT count(*) AS total FROM content_categories WHERE name = ?';
            $rs  = $GLOBALS['application']->conn->GetOne( $sql, $category_name );
            
            return( $rs || $rs > 0 );
        }
        
        // Singleton version
 
        foreach($this->categories as $category) {
            
                return true;
             
        }                        
        
        return false;
    }

    //Returns true if there is no contents in that category name
    function isEmpty($category) {
        $pk_category = $this->get_id($category);
        $sql = 'SELECT count(pk_content) AS number FROM `contents`, `contents_categories`
            WHERE `contents`.`fk_content_type`=1 AND `contents`.`in_litter`=0 AND
            `contents_categories`.`pk_fk_content_category`=? AND
            `contents`.`pk_content`=`contents_categories`.`pk_fk_content`';
        $rs = $GLOBALS['application']->conn->Execute( $sql, array($pk_category) );
        
        return( $rs->fields['number'] == 0 );
    }

 //Returns true if there is no contents in that category id
    function is_Empty($category) {
        $sql = 'SELECT count(pk_content) AS number FROM `contents`, `contents_categories`
            WHERE `fk_content_type`=1 AND `in_litter`=0 AND contents_categories.pk_fk_content_category=? AND contents.pk_content=pk_fk_content';
        $rs = $GLOBALS['application']->conn->Execute( $sql, array($category) );

        return( $rs->fields['number'] == 0 );
    }


    function count_content_by_type($category, $type) {        
        $sql = 'SELECT count(pk_content) AS number FROM `contents`,`contents_categories` WHERE'.
            ' contents.pk_content=pk_fk_content AND pk_fk_content_category=? AND `fk_content_type`=?';
        $rs = $GLOBALS['application']->conn->Execute( $sql, array($category, $type) );
        
        if($rs->fields['number']) {
            return $rs->fields['number'];
        } else {
            return 0;
        }
    }
    
    /**
     *
     *
     * @see ContentCategoryManager::count_content_by_type
    */
    function count_content_by_type_group($type, $filter=NULL) {
         $_where = '1=1';
        if( !is_null($filter) ) {
            $_where = $filter;
        }
        $sql = 'SELECT count(contents.pk_content) AS number, `contents_categories`.`pk_fk_content_category` AS cat
                FROM `contents`,`contents_categories`
                WHERE `contents`.`pk_content`=`contents_categories`.`pk_fk_content` AND `in_litter`=0 AND `contents`.`fk_content_type`=? AND '.$_where.
                ' GROUP BY `contents_categories`.`pk_fk_content_category`';
       
        $rs = $GLOBALS['application']->conn->Execute( $sql, array($type) );
        
        $groups = array();
        
        if($rs!==false) {
            while(!$rs->EOF) {
                $groups[ $rs->fields['cat'] ] = $rs->fields['number'];
                $rs->MoveNext();
            }            
        }
        
        return $groups;
    }    

     
    function getCategories() {

        //fullcat contains array with all cats order by posmenu
        //parentCategories is an array with all menu cats in frontpage
        $fullcat = $this->order_by_posmenu($this->categories);
        $parentCategories = array();
        foreach( $fullcat as $prima) {
            if (  ($prima->fk_content_category == 0) ) {
                $parentCategories[] = $prima;
            }								 
        }
        
        return $parentCategories;
    }
    
    



}

