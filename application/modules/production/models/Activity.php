<?php

/**
 * This is the Data Mapper class for the Acl_activitys table.
 */
class Production_Model_Activity {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Production_Model_DbTable_Activity();
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
        return $table->fetchRow($select)->toArray();
    }
    
    public function fetchHaveContactCompanyClient($contact_id) {
       
        $table = $this->getTable();
        $select = $table->select()->where('contact_company_client_id = ?', $contact_id);
        $row= $table->fetchRow($select);
        return $row;
    }
    
     
    public function fetchHaveContactOwnCompany($contact_id) {
       
        $table = $this->getTable();
        $select = $table->select()->where('contact_own_company_id = ?', $contact_id);
        $row= $table->fetchRow($select);
        return $row;
    }
    public function fetchHaveActivities($company_id) {
       
        $table = $this->getTable();
        $select = $table->select()->where('company_id = ?', $company_id);
     
        return $table->fetchRow($select);
    }
    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT activitys.id, activitys.name, date,
                    email,status, roles.name as role
          FROM activitys, roles
          WHERE activitys.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Activity");
     
        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypeActivitys($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('activity_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

