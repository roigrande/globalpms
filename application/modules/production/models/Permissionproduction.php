<?php

/**
 * This is the Data Mapper class for the Acl_permissionproductions table.
 */
class Production_Model_Permissionproduction {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Production_Model_DbTable_Permissionproduction();
        }
        return $this->_table;
    }

    /* Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */

    public function save(array $data) {
        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        
        $data["productions_id"]=$_SESSION["production"]["id"];
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
       
        $table->insert($data);
        return $table->lastInsertId();
    }

    /* Update entry
     * 
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */

    public function update(array $data, $where) {
        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }

        return $table->update($data, $where);
    }

    /**
     * Delete entries
     * 
     * @param  array|string $where SQL WHERE clause(s)
     * @return int|string
     */
    public function delete($where) {

        //delete resource
        $table = $this->getTable();
        $table->delete($where);
    }
    
      /**
     * Delete entries
     * 
     * @param  array|string $where SQL WHERE clause(s)
     * @return int|string
     */
    public function delete_production($production_id) {

        //delete resource
        $table = $this->getTable();
        $table->delete('productions_id = ' . (int) $production_id);
    }

    /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntries() {
        return $this->getTable()->fetchAll('1');
    }

    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntry($id) {
        $table = $this->getTable();
        $select = $table->select()->where('id = ?', $id);
        $data =$table->fetchRow($select)->toarray();
//        Zend_Debug::dump($data,"Permissionproduction");
//            die();
        return $data;
    }
 
      /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchUserPermissionproductions() {
        
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
       
        $select->from(array('productions'), array('production_name' =>'name'))
               ->from(array('acl_roles'), array('production_role_name' =>'name'))
               ->from(array('acl_users'), array('production_user_name' =>'name','email'))
               ->where('productions_id ='. (int)  $_SESSION['production']['id'])
               ->where('productions.id=permission_production.productions_id')
               ->where('acl_roles.id=permission_production.acl_roles_id')
               ->where('acl_users.id=permission_production.acl_users_id')
              
                ;
                        

        $data=$table->fetchAll($select)->toArray();
//        Zend_Debug::dump($data);
//        die();
        return $data;
        
    }
     public function isUserAllowedProduccition($production_id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->where('permission_production.acl_users_id = ' . $_SESSION["gpms"]["storage"]->id)
               ->where('permission_production.productions_id = ' . $production_id);
       $data=$table->fetchAll($select)->toArray();
        
//        Zend_Debug::dump($data);
//        die();
        
       //Zend_Debug::dump( $_SESSION['gpms'],"antes de cambiar el role");
//       die();
       
        if($data){
        $this->gpms = new Zend_Session_Namespace('gpms');
        $this->gpms->storage->role_id=$data["0"]["acl_roles_id"];
         //   $_SESSION['gpms']['storage']->role_id=$data->acl_roles_id; 
       // Zend_Debug::dump( $_SESSION['gpms'],"despues de cambiar el role");
        
       //     die("traga");
                return true;        
        } 
        //die("no traga");
        return false;
    }
    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypePermissionproductions($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('permissionproduction_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

