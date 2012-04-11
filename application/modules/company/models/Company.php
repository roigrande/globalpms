<?php

/**
 * This is the Data Mapper class for the Acl_companys table.
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
        
        $data= $table->fetchRow($select)->toArray();
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
        $sql = "SELECT companies.id, companies.name,fiscal_name,company_types.name as company_types_name,
                       email,telephone,fax,direction,city,country,postal_code
          FROM companies, company_types
          WHERE companies.company_types_id = company_types.id              
          ";
        
//        $sql = "SELECT acl_roles.id, acl_roles.prefered_uri, acl_roles.name, acl_roles_parent.name as parent
//           FROM acl_roles LEFT JOIN acl_roles AS acl_roles_parent ON acl_roles.role_parent = acl_roles_parent.id
//     
//           ORDER BY acl_roles_parent.name ";
        
        $table = $this->getTable()->getAdapter()->fetchAll($sql);
     //   Zend_Debug::dump($table,"table");
        return $table;
        
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchCompanys($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

