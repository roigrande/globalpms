<?php

/**
 * This is the Data Mapper class for the Acl_companies table.
 */
class Company_Model_Company {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Company_Model_DbTable_Company();
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

    
    /* In litter entry
     * 
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */

    public function inLitter($where) {
        $table = $this->getTable();
        $data["in_Litter"]=(int)"1";
        return $table->update($data,$where);
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

        $data = $table->fetchRow($select)->toArray();
//        Zend_Debug::dump($data);
//        die();
        return $data;
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
        $select->from(array('ct' => 'company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
                ->joinLeft('own_companies', 'companies.id = own_companies.company_id', array('own_company_id' => 'id', 'company_id'))
//                ->from(array('oc' => 'own_companies'), array('own_company_company_id' => 'oc.company_id', 'own_company_id' => 'id'))             
//                ->where('oc.company_id = c.id ')
                ->where('ct.id = company_types_id')
                ->where('in_litter = 0')
        ;
        $table = $table->fetchAll($select);
        $i = 0;
        $company_no_own='';
        foreach ($table as $key => $field) {
            //check all the compannies dont have company_id in the table own_companies 
            if ($field["id"] != $field["company_id"]) {
                $i++;
                $company_no_own[$i] = $field;
            }
        }

        return $company_no_own;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function noOwnCompany($arraycompanies) {
        $model_own_company = new Company_Model_Owncompany;
        $arrayowncompanies = $model_own_company->fetchEntries();
        Zend_Debug::dump($arraycompanies, "---------------------------------");
        foreach ($arrayowncompanies as $owncompany => $ownfield) {
            foreach ($arraycompanies as $company => $field) {
                Zend_Debug::dump($field["id"], "---------------------------------");
                Zend_Debug::dump($ownfield, "---------------------------------");

                if ($field['id'] == $ownfield["company_id"])
                    unset($arraycompanies[$company]);
            }
        }
        Zend_Debug::dump($arraycompanies, "---------------------------------");
        die();
        $table = $this->getTable();
        $select = $table->select()->where('type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

