<?php
/**
 * worker, class to manage one Worker
 *
 * @package 
 * @version 0.1
 * @author Roi Grande <roi@openhost.es>
 * 
 * @copyright Copyright (c) 2009, ROI S.L.
 */

/**
 * Worker class
 *
 * Class use MethodCacheManager for better performance
 *
 * @package OpenNeMas
 * @version 0.1
 */
class Worker extends Resource
{

    /**
     * @access public
     * @var int
     */

    public $pk_worker = null;

    /**
     * @access public
     * @var varchar
     */

    public $metadata = null;

    /**
     * @access public
     * @var varchar
     */

       
    public $nif= null;

    /**
     * @access public
     * @var varchar
     */

    public $nss = null;

    /**
     * @access public
     * @var varchar
     */

    public $dob= null;

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

    public $address = null;

    /**
     * @access public
     * @var varchar
     */

    public $city = null;

    /**
     * @access public
     * @var varchar
     */
    /**
     * Constructor
     *
     * @see Customer::Customer()
     * @param int $id Customer ID
    */
    function __construct($id=null)
    {
         parent::Resource($id);

        if(is_numeric($id)) {
            $this->read($id);
        }
        $this->resource_type = 'worker';
    }

    

    /**
     * Singleton pattern
     *
     * @return Customer, instance of Customer
    */
    static function getInstance()
    {
        if( is_null(self::$instance) ) {
            $instance = new worker();

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
//pk_worker 	nif 	nss 	dob 	email1 	email2 	telf1 	telf2 	address 	city
        $sql = 'INSERT INTO workers ( `pk_worker`,`nif`,`nss`,
                                      `dob`,`email1`,`email2`,
                                      `telf1`,`telf2`, `address`,
                                      `city` )
                VALUES ( ?,?,? ,?,?,? ,?,?,? ,?)';
//echo $sql;
        $data['pk_worker'] = $this->id;

        $values = array($data['pk_worker'],$data['nif'],$data['nss'],
                        $data['dob'],$data['email1'],$data['email2'],
                        $data['telf1'],$data['telf2'],$data['address'],
                        $data['city']);
        //var_dump($values);
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return false;
        }

        return $this;
    }

    /**
     * Read content for a worker
     *
     * @param int $id Workers Id
    */
    function read($id)
    {
        parent::read($id); // Read content of Content
//echo 'read work';
        $sql = 'SELECT * FROM workers WHERE pk_worker = '.($id);
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

        $sql = "UPDATE workers SET `nif`=?, `nss`=?, `dob`=?,
                                   `email1`=?, `email2`=?,`telf1`=?,
                                   `telf2`=?, `address`=?, `city`=?
                               WHERE pk_worker=".($data['id']);



        $values = array($data['nif'], $data['nss'],$data['dob'], 
                        $data['email1'], $data['email2'], $data['telf1'],
                        $data['telf2'], $data['address'], $data['city']);
        echo $sql;
      //  var_dump($values);
      //  die();
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return null;
        }

        return $this;
    }

    /**
     * Update worker
     *
     * @param int $id Customers Id
     * @return bool
    */
    function delete($id)
    {
        parent::delete($id);

        $sql = 'DELETE FROM workers WHERE pk_worker ='.($id);
echo $sql;
        if($GLOBALS['application']->conn->Execute($sql)===false) {

            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return false;
        
             }
	return true;
    }

}
