<?php

/**
 * This is the Data Mapper class for the Acl_productions table.
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
        $model_activities = new Production_Model_Activity();
         if ($model_activities->fetchHaveActivities($company_id)) {
            die("esta compañia tiene actividades relacionanadas");
        }
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
        $data= $table->fetchRow($select)->toArray();
        
        return $data;
    }
    
      /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntryProduction() {
         
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('s' => 'status'), array('status' =>'name'))
               ->from(array('oc' => 'companies'), array('own_company_name' =>'name'))
               ->from(array('cc' => 'companies'), array('client_company_name' =>'name'))
               ->from(array('pt' => 'production_types'), array('production_type_name' =>'name'))
               
               ->where('status_id = s.id')
               ->where('own_companies_id = oc.id')
               ->where('client_companies_id = cc.id')
               ->where('production_types_id = pt.id')
               ->where('productions.id = '.$_SESSION["production"]["id"])
                
                               
                ;
        
        $data=$table->fetchAll($select);
//         Zend_Debug::dump($data);
//        die();
        return $data[0];
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT productions.id, productions.name, date,
                    email,status, roles.name as role
          FROM productions, roles
          WHERE productions.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Production");
     
        return $table;
    }
    
    public function fetchProductions() {

        
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('s' => 'status'), array('status' =>'name'))
               ->from(array('oc' => 'companies'), array('own_company_name' =>'name'))
               ->from(array('cc' => 'companies'), array('client_company_name' =>'name'))
               ->from(array('pt' => 'production_types'), array('production_type_name' =>'name'))
               ->from(array('permission_production'), array('id_permission_production' =>'id'))
               ->where('status_id = s.id')
               ->where('own_companies_id = oc.id')
               ->where('client_companies_id = cc.id')
               ->where('production_types_id = pt.id')
               ->where('permission_production.productions_id = productions.id') 
               ->where('permission_production.acl_users_id =' .$_SESSION["gpms"]["storage"]->id )               
                ;
        
        $data=$table->fetchAll($select);
//         Zend_Debug::dump($data);
//        die();
        return $data;
    }
    
    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function getProductionName($id_production) {

        $table = $this->getTable();
        $select = $table->select()
                ->where('id =' . (int) $id_production);
        
        $data= $table->fetchAll($select)->toArray();        
        return $data["0"]["name"];
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchOwnCompanyid($id_company) {

        $table = $this->getTable();
        $select = $table->select()
                ->where('id =' . (int) $id_company);
        
        $data= $table->fetchAll($select)->toArray();        
        return $data["0"]["own_companies_id"];
    }

    public function fetchClientCompanyid($id_company) {
        
        $table = $this->getTable();
        $select = $table->select()
                ->where('id =' . (int) $id_company);
        
        $data= $table->fetchAll($select)->toArray();
       return $data["0"]["client_companies_id"];
    }
   

}

