<?php

/**
 * This is the Data Mapper class for the activitys table.
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
        $row= $table->fetchRow($select)->toArray();
//        Zend_Debug::dump($row);
        return $row;
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT activitys.id, activitys.name, date,
                    email,status, person_id,
                    validation_code,phone, roles.name as role
          FROM activities,
          WHERE activitys.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        return $table;
    }
    
     public function fetchActivities($id) {


        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('t' => 'activity_types'), array('activity_types' =>'name','activity_types_id'=>'id'))
               ->where('activity_types_id = t.id')
               ->where('productions_id ='.$id)
               ->from(array('c' => 'contacts'), array('client_name' =>'name','id_client'=>'id'))
               ->where('client_resp_name = c.id')
                
                ;
        return $table->fetchAll($select);
    }
    
   
    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchActivitys($production_id) {

        $table = $this->getTable();
        $select = $table->select()->where('productions_id =' . (int) $production_id);

        return $table->fetchAll($select);
    }

}

