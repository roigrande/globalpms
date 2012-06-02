<?php

/**
 * This is the Data Mapper class for the Acl_suppliers table.
 */
class Supplier_Model_Supplier {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Supplier_Model_DbTable_Supplier();
        }
        return $this->_table;
    }

    /* Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */

    public function save(array $data) {
        unset($data["id"]);
//        Zend_Debug::dump($data);
//        die();
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
        $model_company= new Company_Model_Company();
        return $model_company->update($data, $where);
//        $table = $this->getTable();
//        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
//        foreach ($data as $field => $value) {
//            if (!in_array($field, $fields)) {
//                unset($data[$field]);
//            }
//        }
//        
//        return $table->update($data, $where);
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
         
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select  ->from(array('companies'))
                ->from(array('companies_has_suppliers'))
               
               ->from(array('company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
               ->where('company_types_id=company_types.id')
               ->where('suppliers.companies_id=companies.id')
               ->where('suppliers.id=companies_has_suppliers.suppliers_id')
               ->where('companies_has_suppliers.companies_id='.$_SESSION["company"]["id"])
 
               ->order('name')

        ;
        $data = $table->fetchAll($select);
        //TODO la select deberias sustituir este codigo por un distinct en la select para no repetir resultados
//        
//        Zend_Debug::dump($data);
//        die();
        return $data;
     }
    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
   public function fetchEntry($id) {
        
         $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('ct' => 'company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
//               ->join(array('suppliers_has_activity_types'),
//                    'suppliers_has_activity_types.suppliers_id = suppliers.id')
                ->from("companies")
                ->where('ct.id = company_types_id')
                ->where('companies.id='.$id)
                ->where('companies.id=suppliers.companies_id')
              //  ->where('in_litter = 0')
        ;
        $data = $table->fetchAll($select)->toarray(); 
        
     $sql = "SELECT id,name
                From suppliers_has_activity_types
                INNER JOIN activity_types ON activity_types.id = suppliers_has_activity_types.activity_types_id
                WHERE suppliers_has_activity_types.suppliers_id = ".$id
            ;
       
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        $result= implode(",", $result);
        $data["0"]["activity_types_name"]=$result;
         
        return $data["0"];
  }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT suppliers.id, suppliers.name, date,
                    email,status, roles.name as role
          FROM suppliers, roles
          WHERE suppliers.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Supplier");
     
        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypeSuppliers($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('supplier_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

