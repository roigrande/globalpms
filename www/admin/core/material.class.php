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

    public $pkMaterial = null;

    /**
    * @access public
    * @var varchar
    */
    public $fkType = null;

    /**
    * @access public
    * @var varchar
    */

    public $price = null;

    /**
    * @access public
    * @var varchar
    */

    public $num= 0;

    /**
    * @access public
    * @var varchar
    */

    public $numAvailable = 0;

    /**
    * @access public
    * @var varchar
    */

    public $store = null;

    /**
    * @access public
    * @var varchar
    */

    public $invoice = null;

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
         echo "construct";
        if(is_numeric($id)) {
            $this->read($id);
        }


        $this->resourceType = 'material';
        
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
       // echo create;
       // die();
        parent::create($data);
        
        $sql = 'INSERT INTO materials ( `pk_material`,`fk_material_type`,`price`,
                                      `num`,`num_available`,`store`,
                                      `invoice`)
                VALUES ( ?,?,? ,?,?,? ,?)';

        $data['pkMaterial']   = $this->pkResource;  if (( $data['numAvailable']=='0') || ( $data['numAvailable']=='')){
            $data['numAvailable'] = $data['num'];
        }
        if ( $data['numAvailable']=='' ){
            $data['numAvailable'] = $data['num'];
        }
       $values = array($data['pkMaterial'],$data['fkMaterialType'],$data['price'],
                        $data['num'],$data['numAvailable'],$data['store'],
                        $data['invoice']);

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
        echo "read";
        parent::read($id); // Read content of Content

        $sql = 'SELECT * FROM materials WHERE pk_material = '.($id);
       // echo $sql;
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

        $sql = "UPDATE materials SET `fk_material_Type`=?, `price`=?, `num`=?,
                                     `num_available`=?, `store`=?,`invoice`=?
                                 WHERE pk_material=".($data['id']);

        if ( $data['numAvailable']=='' ){
             $data['numAvailable'] = $data['num'];
        }

        $values = array($data['fk_material_type'], $data['price'],$data['num'],
                        $data['numAvailable'], $data['store'], $data['invoice']);

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
