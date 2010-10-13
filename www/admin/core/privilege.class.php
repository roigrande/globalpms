<?php
/**
 * Class Privilege
 *
 * Class to manage privileges in OpenNeMas
 * @see Privileges_check
 */
class Privilege
{
    /**#@+
     * @var int
    */ 
    var $id           = null;
    var $pk_privilege = null;
    /**#@-*/
    
    /**#@+
     * @access public
     * @var string
    */    
    var $description = null;
    var $name        = null;
    var $module      = null;
    /**#@-*/
    
    /**
     * Constructor
     *
     * @see Privilege::Privilege
     * @param int $id Privilege Id
    */
    function __construct($id=null)
    {
        $this->Privilege($id);
    }
    
    /**
     * Contructor for PHP4 complaint
     *
     * @see Privilege::__construct
     * @param int $id Privilege Id
    */
    function Privilege($id=null)
    {
        if(!is_null($id)) {
            $this->read($id);
        }
    }

    /**
     * Create a new Privilege
     * 
     * @param array $data Data values to insert into database
     * @return boolean
     */
    function create($data)
    {
        $sql = 'INSERT INTO `privileges` (`name`, `module`, `description`) VALUES (?, ?, ?)';
        $values = array($data['name'], $data['module'], $data['description']);
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return false;
        }
        
        $this->id = $GLOBALS['application']->conn->Insert_ID();
        
        return true;
    }

    /**
     * Read a privilege
     *
     * @param int $id Privilege Id
     * @return 
     */
    function read($id)
    {
        $sql = 'SELECT * FROM `privileges` WHERE `pk_privilege`=?';
        
        // Set fetch method to ADODB_FETCH_ASSOC
        $GLOBALS['application']->conn->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $rs  = $GLOBALS['application']->conn->Execute($sql, array($id));        
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return;
        }
        
        $this->load($rs->fields);
        
        return $this;
    }
    
    /**
     * Load properties in this instance
     *
     * @param array|stdClass $data
     * @return Privilege Return this instance to chaining of methods
     */
    function load($data)
    {
        $properties = $data;
        if(!is_array($data)) {
            $properties = get_object_vars($data);
        }
        
        foreach($properties as $k => $v) {
            $this->{$k} = $v;
        }
        
        // Lazy setting
        $this->id = $this->pk_privilege;
        
        return $this; // chaining methods
    }

    /**
     * Update privilege
     *
     * @param array $data
     * @return boolean|Privilege Return this instance or false if update operation fail
     */
    function update($data)
    {
        $sql = "UPDATE `privileges` SET `name`=?, `module`=?, `description`=? WHERE `pk_privilege`=?";
        
        $values = array($data['name'], $data['module'], $data['description'], $data['id']);
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return false;
        }
        
        $this->load($values);
        
        return $this;
    }

    /**
     * Remove a privilege
     *
     * @param int $id Privilege Id
     * @return boolean
     */
    function delete($id)
    {
        $sql = 'DELETE FROM `privileges` WHERE `pk_privilege`=?';
        
        if($GLOBALS['application']->conn->Execute($sql, array($id))===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return false;
        }
        
        return true;
    }

    /**
     * Get privileges of system
     *
     * @param array Array of Privileges
     */
    function get_privileges($filter=null)
    {
        $privileges = array();
        if(is_null($filter)) {
            $sql = 'SELECT * FROM privileges ORDER BY module';
        } else {
            $sql = 'SELECT * FROM privileges WHERE '.$filter.' ORDER BY module';
        }
        
        // Set fetch method to ADODB_FETCH_ASSOC
        $GLOBALS['application']->conn->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        
        while(!$rs->EOF) {
            $privilege = new Privilege();
            $privilege->load( $rs->fields );
            
            $privileges[]  = $privilege;            
            $rs->MoveNext();
        }
        
        return $privileges;
    }
    
    /**
     * Get modules name
     *
     * @param array Array of string
     */
    function getModuleNames()
    {
        $modules = array();
        $sql = 'SELECT `module` FROM `privileges` WHERE (`module` IS NOT NULL) AND (`module`<> "") GROUP BY `module`';
        
        // Set fetch method to ADODB_FETCH_ASSOC
        $GLOBALS['application']->conn->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        
        while(!$rs->EOF) {            
            $modules[] = $rs->fields['module'];            
            $rs->MoveNext();
        }
        
        return $modules;
    }    

    /**
     * @deprecated 0.5     
    */
    function get_privileges_by_user($id_user){
        $privileges = array();
        $sql = 'select t3.pk_privilege, t3.description, t3.name from users as t1
                    inner join user_groups_privileges as t2 on t2.pk_fk_user_group = t1.fk_user_group
                    inner join privileges as t3 on t3.pk_privilege = t2.pk_fk_privilege
                where t1.pk_user = ' .intval($id_user);
        $rs = $GLOBALS['application']->conn->Execute($sql);
        while(!$rs->EOF) {
            $privileges[] = $rs->fields['name'];
              $rs->MoveNext();
        }
        return( $privileges);
    }
    
}
