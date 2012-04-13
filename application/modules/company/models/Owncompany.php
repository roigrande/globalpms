<?php

/**
 * This is the Data Mapper class for the Acl_owncompanys table.
 */
class Company_Model_Owncompany {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Company_Model_DbTable_Owncompany();
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
//        Zend_Debug::dump($data, "company");
//        die();
        return $table->insert($data);
    }

    /* Update entry
     * 
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */

    public function update(array $data, $where) {
        $company = $data;
        $company['id'] = $company['company_id'];
        $model_company = new Company_Model_Company;
        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
//        Zend_Debug::dump($data, "owncompany");
//        Zend_Debug::dump($company, "company");
        $model_company->update($company, 'id = ' . (int) $company['id']);
        return $table->update($data, $where);
    }

    /**
     * Delete entries
     * 
     * @param  array|string $where SQL WHERE clause(s)
     * @return int|string
     */
    public function delete($own_company_id,$company_id) {
        
        $model_production = new Production_Model_Production();
        //check the integration TODO the views and resource check
       
        if ($model_production->fetchHaveCompanyOwn($data["company_id"]))
        {die("esta compañia esta trabajando como cliente de una produccion");}       
        //delete company
        $model_company = new Company_Model_Company();
        $model_company->delete('id = ' . (int) $company_id);
        //delete owcompany
        $table = $this->getTable();
        $table->delete('id = ' . (int) $own_company_id);
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
        $data_own_company = $table->fetchRow($select)->toArray();
//        Zend_Debug::dump($data_own_company, "owncompany");
        $company_model = new Company_Model_Company;
        $data_company = $company_model->fetchEntry($data_own_company["company_id"]);
        $data_company["company_id"] = $data_company["id"];
        $data_company["description"] = $data_own_company["description"];
        $data_company["id"] = $data_own_company["id"];
//        Zend_Debug::dump($data_company, "company");
//        die();
        return $data_company;
    }
    public function fetchIsOwnCompany($company_id) {
       
         $table = $this->getTable();
        $select = $table->select()->where('company_id = ?', $company_id);
        $row= $table->fetchRow($select);
        return $row;
    }
    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('c' => 'companies'), array('name', 'email', 'telephone', 'fax', 'direction', 'city', 'country', 'postal_code', 'fiscal_name','in_litter'))
                ->from(array('ct' => 'company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
                ->where('c.in_litter = 0')
                ->where('company_id = c.id')
                ->where('ct.id = c.company_types_id');
                
        $data = $table->fetchAll($select);
//      Zend_Debug::dump($data);
//      die();
        return $data;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchOwncompanys($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }
    public function isOwnCompany($company_id) {

        $table = $this->getTable();
        $select = $table->select()->where('company_id =' . (int) $company_id);

        return $table->fetchAll($select)->toArray();
    }


}

