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

    public $pkWorker = null;

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
     * @see Worker::Worker()
     * @param int $id Worker ID
    */
    function __construct($id=null)
    {
         parent::Resource($id);

        if(is_numeric($id)) {
            $this->read($id);
        }
        $this->resourceType = 'worker';
    }

    

    /**
     * Singleton pattern
     *
     * @return Worker, instance of Worker
    */
    static function getInstance()
    {
        if( is_null(self::$instance) ) {
            $instance = new Worker();

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
     * @return Worker
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
    //    var_dump($data);
        $data['pkWorker'] = $this->pkResource;

        $values = array($data['pkWorker'],$data['nif'],$data['nss'],
                        $data['dob'],$data['email1'],$data['email2'],
                        $data['telf1'],$data['telf2'],$data['address'],
                        $data['city']);
       
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
     * Update Worker
     *
     * @param array $data
     * @return Worker Return the instance to chaining method
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
     * @param int $id Workers Id
     * @return bool
    */
    function delete($id)
    {
        parent::delete($id);

        $sql = 'DELETE FROM workers WHERE pk_worker ='.($id);
        if($GLOBALS['application']->conn->Execute($sql)===false) {

            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return false;
        
             }
	return true;
    }

}
