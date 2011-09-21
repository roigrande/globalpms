<?php

/**
 * This is the Data Mapper class for the Acl_resources table.
 */
class User_Model_Resources {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Resource_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new User_Model_DbTable_Resources;
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
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $table->insert($data);
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
    public function delete($id) {
//        //delete permission of the resource
        $Permissions = new User_Model_Permissions();
        $tablepermissions = $Permissions->getTable();
        
        $where="resource_id=". (int) $id;
        $tablepermissions->delete($where);
        $table = $this->getTable();
        $table->delete('id = '. $id);
        
    }
    
  
    /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntries() {
        return $this->getTable()->fetchAll('1')->toArray();
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
        return $table->fetchRow($select)->toArray();
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    
    //// quedaste aqui
    public function fetchSql() {
        $sql = "SELECT acl_resources.id, resource, acl_resources.name_r, acl_modules.name as module
              FROM acl_resources, acl_modules
              WHERE acl_resources.module_id = acl_modules.id              
              ORDER BY resource";
        
        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        return $table;
    }
     
     /**
     * Fetch all resource with module_id
     * 
     * @return Array of resources from the $module_id
     */
    public function fetchResources($module_id)
    {   
        $table = $this->getTable();
        $select = $table->select()->where('module_id =' . (int) $module_id);       
        return $this->fetchAll($select)->toArray();
    }
}

