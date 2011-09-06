<?php

/**
 * This is the Data Mapper class for the Acl_permission table.
 */
class User_Model_Permissions {

    /** Model_Permission_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Permission_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new User_Model_DbTable_Permissions;
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
    public function delete($where) {
        $table = $this->getTable();
        return $table->delete($where);
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
    public function fetchSql() {
        $sql = "SELECT acl_permissions.id, permission, acl_permissions.name, menu, acl_roles.name as role, acl_resources.name_r as resource
              FROM acl_permissions, acl_roles, acl_resources
              WHERE acl_permissions.role_id = acl_roles.id AND
                    acl_permissions.resource_id = acl_resources.id
              ORDER BY resource"
        ;
        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        return $table;
    }
}

