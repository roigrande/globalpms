<?php
/* -*- Mode: PHP; tab-width: 4 -*- */
/**
 * OpenNeMas project
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
 * @category   OpenNeMas
 * @package    OpenNeMas
 * @copyright  Copyright (c) 2009 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
 
/**
 * Content
 * 
 * @package    OpenNeMas
 * @copyright  Copyright (c) 2009 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: content.class.php   $
 */
class Content {
    
    var $id = null;
    var $fk_content_type = null; //id
    var $content_type = null; //name
    var $name = null;
    var $description = null;
    var $metadata = null;    
    var $created = null;
    var $changed = null;
    var $fk_creator = null;   
    var $category = null;
    var $category_name = null;
    var $views = null; 
    var $in_litter= null; 
    
    function Content($id=null) {
        $this->cache = new MethodCacheManager($this, array('ttl' => 30));
        
        if(!is_null($id)) {
            $this->read($id);
        }                
    }

    function __construct($id=null){
        $this->Content($id);
    }        
    
    function create( $data ) {
        $data['views'] = 1;
        $data['created'] = date("Y-m-d H:i:s");
        $data['in_litter']= 0;

        $fk_content_type = $GLOBALS['application']->conn->GetOne('SELECT * FROM `content_types` WHERE name = "'. $this->content_type.'"');

        $sql = "INSERT INTO contents (`fk_content_type`, `name`, `description`,
                                      `metadata`, `created`, `views`, `fk_creator`,`in_litter`)".
                   " VALUES (?,?,?, ?,?,?, ?,?)";
        
        $values = array($fk_content_type, $data['name'], $data['description'],
                        $data['metadata'], $data['created'], $data['views'],
                        $data['fk_creator'], $data['in_litter']);

        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
    
            return false;
        }
        
        $this->id = $GLOBALS['application']->conn->Insert_ID();
        $category_name ='';
        if(!empty($data['category'])) {
            $category_name = ContentCategoryManager::get_name($data['category']);
        }

        $sql = "INSERT INTO contents_categories (`pk_fk_content` ,`pk_fk_content_category`, `catName`) VALUES (?,?,?)";
        $values = array($this->id, $data['category'], $category_name);
       
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return false;
        }
        
        return true;
    }
     
    function read($id) {
        
        $sql = 'SELECT * FROM contents, contents_categories WHERE pk_content = '.($id).' AND pk_content = pk_fk_content';
        $rs = $GLOBALS['application']->conn->Execute( $sql );
        
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return false;
        }
        
        // Load object properties
        $this->load( $rs->fields );        
         
    }  
    
    function loadCategoryName($pk_content) {
        require_once( SITE_ADMIN_PATH.'/content_category_manager.class.php' );
        $ccm = ContentCategoryManager::get_instance();
        
        if(empty($this->category)) {
            $sql = 'SELECT pk_fk_content_category FROM `contents_categories` WHERE pk_fk_content =?';
            $rs = $GLOBALS['application']->conn->GetOne($sql, $pk_content);
            $this->category = $rs;
        }
        
        return $ccm->get_name($this->category);
    }

    function loadCategoryTitle($pk_content) {
        require_once(SITE_ADMIN_PATH.'/content_category_manager.class.php' );
        $ccm = ContentCategoryManager::get_instance();

        if(empty($this->category_name)) {
            $sql = 'SELECT pk_fk_content_category FROM `contents_categories` WHERE pk_fk_content =?';
            $rs = $GLOBALS['application']->conn->GetOne($sql, $pk_content);
            $this->category = $rs;
            $this->loadCategoryName( $this->category );
        }

        return $ccm->get_title($this->category_name);
    }
    

    // FIXME: check funcionality
    function load($properties) {
        if(is_array($properties)) {
            foreach($properties as $k => $v) {
                if( !is_numeric($k) ) {
                    $this->{$k} = $v;
                }
            }
        }elseif(is_object($properties)) {
            $properties = get_object_vars($properties);
            foreach($properties as $k => $v) {
                if( !is_numeric($k) ) {
                    $this->{$k} = $v;
                }
            }
        }
        
        // Special properties
        $this->id = $this->pk_content;                
      
        if( isset($this->pk_fk_content_category) ) {
            // INFO: Se ven como propiedade pk_fk_content_category despois evítase unha consulta
            $this->category = $this->pk_fk_content_category;
        }
        
        //$this->category_name = $this->loadCategoryName($this->pk_content);
    }

    function update($data) {
        // $GLOBALS['application']->dispatch('onBeforeUpdate', $this);
        
        $name_type = $this->content_type;
        
        $sql = "UPDATE contents SET  `name`=?, `description`=?,
                                      `metadata`=?,                                         
                                WHERE pk_=".($data['id']);
        echo $sql;
        $this->read( $data['id']); //????
     
    
        
        $values = array( $data['name'], $data['description'],
            $data['metadata'], $data['fk_creator']  );
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return;
        }

        $this->category_name ='';
        $this->category = $data['category'];
        if(!empty($this->category))
            $this->category_name = ContentCategoryManager::get_name($data['category']);
            
        $sql = "UPDATE contents_categories SET `pk_fk_content_category`=?, `catName`=? " .
               "WHERE pk_fk_content=".($data['id']);
        $values = array($data['category'],$this->category_name);
      
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return(false);
        }
     }
    
    //Elimina de la BD
    function remove($id) {       
        $sql = 'DELETE FROM contents WHERE pk_content='.($id);

        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }
    
        $sql = 'DELETE FROM contents_categories WHERE pk_fk_content='.($id);

        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return;
        }
    }
    
    //Envia a la papelera
    function delete($id) {
        
        $sql = 'UPDATE contents SET `in_litter`=?  
          	WHERE pk_content='.($id);
        
        $values = array(1);
           
        if($GLOBALS['application']->conn->Execute($sql, $values)===false) {
             $error_msg = $GLOBALS['application']->conn->ErrorMsg();
             $GLOBALS['application']->logger->debug('Error: '.$error_msg);
             $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
        
             return;
         }
    }

    //Devolver desde la papelera
    function no_delete($id) {
    
		  $sql = 'UPDATE contents SET `in_litter`=? 
		   		WHERE pk_content='.($id);

          $values = array(0);
          
         if($GLOBALS['application']->conn->Execute($sql, $values)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return;
        }
    }
   
    function set_numviews($id=null) {

        if(is_null($id) && $this->id != null ) {
            $id = $this->id;
        } elseif (is_null ($id)) {
            return false;
        }
        
        // Multiple exec SQL
        if(is_array($id) && count($id)>0) {
            // Recuperar todos los IDs a actualizar
            $ids = array();
            foreach($id as $item) {
                if(isset($item->pk_content) && !empty($item->pk_content)) {
                    $ids[] = $item->pk_content;
                }
            }

            $sql = 'UPDATE `contents` SET `views`=`views`+1 WHERE `available`=1 AND `pk_content` IN ('.implode(',', $ids).')';
        } else {
            $sql = 'UPDATE `contents` SET `views`=`views`+1 WHERE `available`=1 AND `pk_content`='.$id;
        }

	if($GLOBALS['application']->conn->Execute($sql) === false) {
	  $error_msg = $GLOBALS['application']->conn->ErrorMsg();
	  $GLOBALS['application']->logger->debug('Error: '.$error_msg);
	  $GLOBALS['application']->errors[] = 'Error: '.$error_msg;	  

	  return;
        }
    }
    
    /**
     * Abstract factory method getter
     *
     * @param string $pk_content Content identifier
     * @return object Instance of an specific object in function of content type
    */
    public static function get($pk_content)
    {
        $sql  = 'SELECT `content_types`.name FROM `contents`, `content_types` WHERE pk_content=? AND fk_content_type=pk_content_type';
        $type = $GLOBALS['application']->conn->GetOne($sql, array($pk_content));
        
        if($type === false) {
            return null;
        }
        
        $type = ucfirst( $type );
        try {
            return new $type($pk_content);
        } catch(Exception $e) {
            return null;
        }
    }
 
    // FIXME: mover a un novo script que cargue todo o sistema por defecto "bootstrap"
    function __autoload($className) {
        $filename = strtolower($className);
        if( file_exists(dirname(__FILE__).'/'.$filename.'.class.php') ) {
            require dirname(__FILE__).'/'.$filename.'.class.php';

        } else{

            // Try convert MethodCacheManager to method_cache_manager
            $filename = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $className));

            if( file_exists(dirname(__FILE__).'/'.$filename.'.class.php') ) {
                require dirname(__FILE__).'/'.$filename.'.class.php';
            }
        }


    }
 
}