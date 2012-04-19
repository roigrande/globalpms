<?php

/**
 * This is the Data Mapper class for the Acl_users table.
 */
class Production_Model_Production {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Production_Model_DbTable_Production();
        }
        return $this->_table;
    }

    /* Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */

    public function save(array $data) {
         
        $production = Zend_Registry::get('production');
        $data["status_id"] = $production->default_status;
        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        //$company = new Production_Model_Company();
        //  Zend_Debug::dump($data);

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
        //Zend_Debug::dump($data);
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
    public function delete($id_production) {


        
        
        $activities = new Production_Model_Activity;
        $activities->getTable();        
        $arrayactivities= $activities->fetchActivities("$id_production");
           
        //Delete of the activitis of one production
        foreach ($arrayactivities as $value) {
                 
           $activities->delete('id='.$value["id"]);
        }
        //Delete production
        $table = $this->getTable();
        $table->delete('id = ' . (int) $id_production);
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
      /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchHaveCompanyOwn($company_id) {
       
        $table = $this->getTable();
        $select = $table->select()->where('own_companies_id = ?', $company_id);
     
        return $table->fetchRow($select);
    }
     public function fetchHaveCompanyClient($company_id) {
       
        $table = $this->getTable();
        $select = $table->select()->where('client_companies_id = ?', $company_id);
        $row= $table->fetchRow($select);
        return $row;
    }
    
    public function fetchProductions() {


        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('s' => 'status'), array('status' =>'name','id_status'=>'id'))
               ->where('status_id = s.id')
            //   ->from(array('c' => 'companies'), array('companies' =>'name','id_companies'=>'id'))
            //   ->where('companies_id = c.id')
                
                ;
        $data=$table->fetchAll($select);
       // Zend_Debug::dump($data);
        return $data;
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
//        $sql2 = "SELECT productions.id, productions.name, productions.direction,date_start,date_end
//                ,status.name as status,
//                companies.name as client
//                   
//          FROM productions, status, companies,clients
//          WHERE status.id = productions.status_id and 
//                productions.clients_id = clients.id and 
//                companies.id=clients.companies_id              
//          ORDER BY status";
        $sql = "SELECT productions.id, productions.name, productions.direction,date_start,date_end,observation,budget
                ,status.name as status
                                 
          FROM productions, status
        
          ORDER BY status";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        return $table;
    }

}

