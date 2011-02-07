<?php 
/**
 * Customer, class to manage Customers
 * 
 * @package OpenNeMas
 * @version 0.1
 * @author David Martinez <macada@openhost.es>
 * @link http://www.openhost.es
 * @copyright Copyright (c) 2009, Openhost S.L.
 */

/**
 * Customer class
 *
 * Class use MethodCacheManager for better performance
 * 
 * @package OpenNeMas
 * @version 0.1 
 */
class Customer extends Content
{

    /**
     * @access public
     * @var int
     */
    public $pk_customer = null;
 
    /**
     * @access public
     * @var varchar
     */
    public $name = null;

    /**
     * @access public
     * @var varchar
     */
    public $metadata = null;

    /**
     * @access public
     * @var varchar
     */
    public $company_name_fiscal = null;

    /**
     * @access public
     * @var varchar
     */
    public $cif = null;

    /**
     * @access public
     * @var varchar
     */
    public $address1 = null;

    /**
     * @access public
     * @var varchar
     */
    public $address2 = null;
    /**
     * @access public
     * @var varchar
     */
    public $city = null;

    /**
     * @access public
     * @var varchar
     */
    public $state = null;

    /**
     * @access public
     * @var varchar
     */
    public $postal_code = null;

    /**
     * @access public
     * @var varchar
     */
    public $telf1 = null;

    /**
     * @access public
     * @var varchar
     */
    public $telf2 = null;

    /**
     * @access public
     * @var varchar
     */
    public $fax = null;

    /**
     * @access public
     * @var varchar
     */
    public $email1 = null;

    /**
     * @access public
     * @var varchar
     */
    public $email2 = null;

    /**
     * @access public
     * @var varchar
     */
    public $contact_name = null;

    /**
     * @access public
     * @var varchar
     */
    public $info = null;

    /**
     * @access public
     * @var varchar
     */
    public $geo_loc = null;
    
    /**
     * @access public
     * @var datetime
     */
    public $next_app_date = null;


    /**
     * @var MethodCacheManager Instance of MethodCacheManager
    */
    var $cache = NULL;
    
    /**
     * @var Customer instance, singleton pattern
     */
    static private $instance = null;
     
    /**
     * Constructor
     *
     * @see Customer::Customer()
     * @param int $id Customer ID
    */
    function __construct($id=null)
    {
        $this->Customer($id);
    }    

    /**
     * Constructor for PHP version 4, this method contain logic
     *
     * @uses MethodCacheManager 
     * @param int $id Customer ID
    */
    function Customer($id=null)
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
        
        // parent property
        $this->content_type = 'customer';
    }
    
    /**
     * Singleton pattern
     * 
     * @return Customer, instance of Customer
    */
    static function getInstance()
    {
        if( is_null(self::$instance) ) {
            $instance = new Customer();
            
            self::$instance = $instance;
            return self::$instance;
        } else {
            return self::$instance;
        }
       
    }     

    /**
     * Create
     *
     * @param array $data
     * @return Customer
     */
    function create($data)
    {
        
        parent::create($data);
        
        $sql = 'INSERT INTO customers ( `pk_customer`, `company_name`,`web_page`,
                                        `company_name_fiscal`, `cif`, `address1`, 
                                        `address2`, `city`, `state`,
                                        `postal_code`, `next_app_date`, `telf1`,
                                        `telf2`, `fax`, `email1`,
                                        `email2`, `contact_name`, `geo_loc` )
                VALUES ( ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?  )';
 
        $data['pk_customer'] = $this->id;
        
        $values = array($data['pk_customer'], $data['name'], $data['web_page'],
                        $data['company_name_fiscal'], $data['cif'], $data['address1'],
                        $data['address2'], $data['city'], $data['state'],
                        $data['postal_code'], $data['next_app_date'], $data['telf1'],
                        $data['telf2'], $data['fax'], $data['email1'],
                        $data['email2'], $data['contact_name'],  $data['geo_loc'] );

        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
      
            return false;
        }
        
        return $this;
    }

    /**
     * Read content for a customer
     *
     * @param int $id Customers Id
    */
    function read($id)
    {
        parent::read($id); // Read content of Content
        
        $sql = 'SELECT * FROM customers WHERE pk_customer = '.($id);
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
     * Update Customer
     *
     * @param array $data
     * @return Customer Return the instance to chaining method
    */
    function update($data)
    {
        parent::update($data);
         
        $sql = "UPDATE customers
                    SET `company_name`=?, `company_name_fiscal`=?, `cif`=?,
                        `address1`=?, `address2`=?, `city`=?,
                        `state`=?, `postal_code`=?, `next_app_date`=?,
                        `telf1`=?, `telf2`=?, `fax`=?, `email1`=?,
                        `web_page`=?, `email2`=?, `contact_name`=?, `geo_loc`=?
                    WHERE pk_customer=".($data['id']);
        
        $values = array($data['name'], $data['company_name_fiscal'], $data['cif'],
                        $data['address1'], $data['address2'],$data['city'],
                        $data['state'], $data['postal_code'], $data['next_app_date'],
                        $data['telf1'],$data['telf2'],$data['fax'],$data['email1'],
                        $data['web_page'], $data['email2'], $data['contact_name'], $data['geo_loc']  );
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return null;
        }
         
        return $this;
    }

    /**
     * Update Customer
     *
     * @param int $id Customers Id
     * @return bool
    */
    function remove($id)
    {
        parent::remove($id);
        
        $sql = 'DELETE FROM customers WHERE pk_customer ='.($id);
        
        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return false;
        }
	return true;
    }
      
}
