<?php
/**
 * tracking, class to manage Tracking
 * 
 * @package OpenNeMas
 * @version 0.1
 * @author David Martinez <macada@openhost.es>
 * @link http://www.openhost.es
 * @copyright Copyright (c) 2009, Openhost S.L.
 */

/**
 * tracking class
 *
 * Class use MethodCacheManager for better performance
 * 
 * @package OpenNeMas
 * @version 0.1 
 */
class Tracking extends Content
{

    /**
     * @access public
     * @var int
     */ 
    public $fk_tracking = null;

     
    /**
     * @access public
     * @var varchar
     */
    public $icon = null;

   
    /**
     * @var MethodCacheManager Instance of MethodCacheManager
    */
    var $cache = NULL;
    
    /**
     * @var tracking instance, singleton pattern
     */
    static private $instance = null;
    
    
    /**
     * Constructor
     *
     * @see tracking::tracking()
     * @param int $id tracking ID
    */
    function __construct($id=null)
    {
        $this->tracking($id);
    }    

    /**
     * Constructor for PHP version 4, this method contain logic
     *
     * @uses MethodCacheManager 
     * @param int $id tracking ID
    */
    function Tracking($id=null)
    {
              
	parent::Content($id);

        if(is_numeric($id)) {
            $this->read($id);
        }
        
        // Use MethodCacheManager
        if( is_null($this->cache) ) {
            $this->cache = new MethodCacheManager($this, array('ttl' => (20)));
        } else {
            $this->cache->set_cache_life(20); // 20 seconds
        }
         $this->content_type = 'tracking';
    }
    
    
    /**
     * Singleton pattern
     * 
     * @return Tracking, instance of Tracking
    */
    static function getInstance()
    {
        if( is_null(self::$instance) ) {
            $instance = new Tracking();
            
            self::$instance = $instance;
            return self::$instance;
        } else {
            return self::$instance;
        }
       // parent property
      
    }     

    /**
     * Create
     *
     * @param array $data
     * @return tracking
     */
    function create($data)
    {
        $data['category']=0;
        $data['metadata']='';
        $data['info']='';
        $data['icon']='1';
        
        parent::create($data);

        $sql = 'INSERT INTO trackings ( `pk_tracking`, `name`, `icon` )
                VALUES ( ?,?,? )';
 
         
        $values = array($this->id, $data['name'],  $data['icon'] );
 
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return false;
        }
        
        return $this;
    }

    /**
     * Read content for a tracking
     *
     * @param int $id Tracking Id
    */
    function read($id)
    {
	parent::read($id);
        
        $sql = 'SELECT * FROM trackings WHERE pk_tracking = '.($id);
        $rs = $GLOBALS['application']->conn->Execute( $sql ); 
        
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return;
        }
        
        $this->load( $rs->fields );
        
        // Return instance to method chaining
        return $this;
    }
    
    
    
    /**
     * Update tracking
     *
     * @param array $data
     * @return tracking Return the instance to chaining method
    */
    function update($data)
    {
        $data['category']=0;
        $data['metadata']='';
        $data['info']='';

        parent::update($data);

        $sql = "UPDATE trackings
                SET   `name`=?
                WHERE pk_tracking=".($data['id']);
        
        $values = array($data['name'] );
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return null;
        }
         
        return $this;
    }

    function remove($id)
    {
        parent::remove($id);
        
        $sql = 'DELETE FROM trackings WHERE pk_tracking ='.($id);
        
        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }
    }
   
}
