<?php
/**
 * material, class to manage one Material
 *
 * @package
 * @version 0.1
 * @author Roi Grande <roi@openhost.es>
 *
 * @copyright Copyright (c) 2009, ROI S.L.
 */

/**
 * Material class
 *
 * Class use MethodCacheManager for better performance
 *
 * @package OpenNeMas
 * @version 0.1
 */
class Material extends Resource
{
    /**
     * @access public
     * @var int
     */

    public $pk_material = null;

    /**
     * @access public
     * @var varchar
     */

    public $price = null;

    /**
     * @access public
     * @var varchar
     */

    public $type = null;

    /**
     * @access public
     * @var varchar
     */

    public $num= null;

    /**
     * @access public
     * @var varchar
     */

     public $numAvailable = null;

    /**
     * @access public
     * @var varchar
     */

     public $store = null;

    /**
     * @access public
     * @var varchar
     */
     
    public $pk_provider = null;

    /**
     * @access public
     * @var varchar
     */

    public $pk_invoice = null;

    /**
     * @access public
     * @var varchar
     */
     public $dob = null;

    /**
     * @access public
     * @var varchar
     */


    /**
     * Constructor
     *
     * @see Material::Material()
     * @param int $id Material ID
    */
    function __construct($id=null)
    {
         parent::Resource($id);

        if(is_numeric($id)) {
            $this->read($id);
        }
        $this->resource_type = 'material';
    }



    /**
     * Singleton pattern
     *
     * @return Material, instance of Material
    */
    static function getInstance()
    {
        if( is_null(self::$instance) ) {
            $instance = new material();

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
     * @return Material
     */
    function create($data)
    {

        parent::create($data);
        $sql = 'INSERT INTO materials ( `pk_material`,`type`,`price`,
                                      `num`,`numavailable`,`store`,
                                      `pk_provide`,`invoice`, `dob`)
                VALUES ( ?,?,? ,?,?,? ,?,?,?)';

        $data['pk_material'] = $this->id;

        $values = array($data['pk_material'],$data['type'],$data['price'],
                        $data['num'],$data['num_available'],$data['store'],
                        $data['pk_provide'],$data['invoice'],$data['dob']);

        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return false;
        }

        return $this;
    }

    /**
     * Read content for a material
     *
     * @param int $id Materials Id
    */
    function read($id)
    {
        parent::read($id); // Read content of Content

        $sql = 'SELECT * FROM materials WHERE pk_material = '.($id);
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
     * Update Material
     *
     * @param array $data
     * @return Material Return the instance to chaining method
    */
    function update($data)
    {
        parent::update($data);

        $sql = "UPDATE materials SET `nif`=?, `nss`=?, `dob`=?,
                                   `email1`=?, `email2`=?,`telf1`=?,
                                   `telf2`=?, `address`=?, `city`=?
                               WHERE pk_material=".($data['id']);



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
     * Update material
     *
     * @param int $id Materials Id
     * @return bool
    */
    function delete($id)
    {
        parent::delete($id);

        $sql = 'DELETE FROM materials WHERE pk_material ='.($id);
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
