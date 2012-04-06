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
            
              //
              //      Zend_Debug::dump($data);
            
             
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
    
//     public function fetchActivitis() {
//
//
//        $table = $this->getTable();
//        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
//                ->setIntegrityCheck(false);
//        $select->from(array('t' => 'activity_types'), array('activity_types' =>'name','activity_types_id'=>'id'))
//               ->where('activity_types_id = t.id')
//               ->order('productions_id')
//               ->from(array('c' => 'contacts'), array('client_name' =>'name','id_client'=>'id'))
//               ->where('client_resp_name = c.id')
//               ->from(array('com' => 'companies'), array('company_name' =>'name','id_company'=>'id'))
//               ->where('client= com.id')
//                ;
//        return $table->fetchAll($select);
//    }
     
     public function fetchActivities($id=0) {

        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('t' => 'activity_types'), array('activity_types' => 'name', 'activity_types_id' => 'id'))
                ->where('activity_types_id = t.id')             
                ->from(array('s' => 'status'), array('status' => 'name', 'id_status' => 'id'))
                ->where('status_id = s.id')
                ->from(array('c' => 'contacts'), array('client_resp_name' => 'name', 'client_resp_phone' => 'telephone'))
                ->where('client_resp_id = c.id')
                ->from(array('c2' => 'contacts'), array('contract_resp_name' => 'name', 'contract_resp_phone' => 'telephone'))
                ->where('contract_resp_id = c2.id')
                ->from(array('c3' => 'contacts'), array('responsible_name' => 'name', 'responsible_phone' => 'telephone'))
                ->where('responsible_id = c3.id') 
                ->from(array('com' => 'companies'), array('contract_company_name' => 'name'))
                ->where('contract_company_id= com.id')
        ;
        if (!$id == "0") {
            $select->where('productions_id =' . $id);
        } else {
            $select->order('productions_id');
        }
        ;
        $data = $table->fetchAll($select);
      Zend_Debug::dump($data);
    //  die();
        return $data;
  
       
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

