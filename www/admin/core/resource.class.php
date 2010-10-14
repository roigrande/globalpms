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
 * @version    $Id: resource.class.php   $
 */
class Resource {

    var $pk_resource; //id
    var $fk_resource_type = null;
    var $name = null;
    var $description = null;
    var $metadata = null;
    var $created = null;
    var $changed = null;
    var $picture = null;
   
    function Resource($id=null) {
  //      $this->cache = new MethodCacheManager($this, array('ttl' => 30));

        if(!is_null($id)) {
            $this->read($id);
        }
    }

    function __construct($id=null){
        $this->Resource($id);
    }

    function create( $data ) {
        $data['created'] = date("Y-m-d H:i:s");
        $data['changed'] = date("Y-m-d H:i:s");
        $data['available'] = isset($data['available'])? $data['available'] : `available` ;
        


    
        $fk_resource_type ='1'; // $GLOBALS['application']->conn->GetOne('SELECT * FROM `resource_types` WHERE name = '. $this->resource_type.'"');

        $sql = "INSERT INTO resources (`fk_resource_type`, `name`, `available`,
                                       `created`,`changed`, `metadata`,
                                       `description`,`image`)".
                   " VALUES (?,?,?, ?,?,?, ?,?)";
//echo $sql;

        $values = array($fk_resource_type, $data['name'], $data['available'],
                        $data['created'],$data['changed'], $data['metadata'],
                        $data['description'], $data['image']);
//var_dump($values);
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return false;
        }
        
        $this->id = $GLOBALS['application']->conn->Insert_ID();


        return true;
    }

    function read($id) {

        $sql = 'SELECT * FROM resources  WHERE pk_resource = '.($id).' ';
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
        $this->id = $this->pk_resource;

              //$this->category_name = $this->loadCategoryName($this->pk_resource);
    }


    function update($data) {
        // $GLOBALS['application']->dispatch('onBeforeUpdate', $this);
        $data['changed'] = date("Y-m-d H:i:s");
        $name_type = $this->resource_type;
         $this->read( $data['id']); //????
        echo $name_type;

        $sql = "UPDATE resources SET `name`=?,`changed`=?, `description`=?,
                                    `metadata`=?

                    WHERE pk_resource=".($data['id']);
        //echo $sql;


        $values = array( $data['name'], $data['changed'], $data['description'], $data['metadata']);
        //var_dump($data);
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return;
        }

            
        return(true);


     }


    //Elimina de la BD
    function delete($id) {
        $sql = 'DELETE FROM resources WHERE pk_resource='.($id);

        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }

    }
    /*
    //Envia a la papelera
    function delete($id) {

        $sql = 'UPDATE resources SET `in_litter`=?
          	WHERE pk_resource='.($id);

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

		  $sql = 'UPDATE resources SET `in_litter`=?
		   		WHERE pk_resource='.($id);

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
                if(isset($item->pk_resource) && !empty($item->pk_resource)) {
                    $ids[] = $item->pk_resource;
                }
            }

            $sql = 'UPDATE `resources` SET `views`=`views`+1 WHERE `available`=1 AND `pk_resource` IN ('.implode(',', $ids).')';
        } else {
            $sql = 'UPDATE `resources` SET `views`=`views`+1 WHERE `available`=1 AND `pk_resource`='.$id;
        }

	if($GLOBALS['application']->conn->Execute($sql) === false) {
	  $error_msg = $GLOBALS['application']->conn->ErrorMsg();
	  $GLOBALS['application']->logger->debug('Error: '.$error_msg);
	  $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

	  return;
        }
    }
    */
    /**
     * Abstract factory method getter
     *
     * @param string $pk_resource Content identifier
     * @return object Instance of an specific object in function of resource type
    */

    public static function get($pk_resource)
    {
        $sql  = 'SELECT `resource_types`.name FROM `resources`, `resource_types` WHERE pk_resource=? AND fk_resource_type=pk_resource_type';
        $type = $GLOBALS['application']->conn->GetOne($sql, array($pk_resource));

        if($type === false) {
            return null;
        }

        $type = ucfirst( $type );
        try {
            return new $type($pk_resource);
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
