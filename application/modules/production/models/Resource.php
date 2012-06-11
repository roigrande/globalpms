<?php

/**
 * This is the Data Mapper class for the Acl_resources table.
 */
class Production_Model_Resource {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Production_Model_DbTable_Resource();
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
        unset($data["id"]);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
//        Zend_Debug::dump($data);
//        die();
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
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id'))
               ->from(array('contacts'), array('supplier_contact_name' => 'name'))
               ->from(array('companies'), array('supplier_name' => 'name', 'id_supplier' => 'id'))
               ->where('resource_id=resources.id')
               ->where('companies.id=resources.companies_id')
               ->where('contacts_id=contacts.id')
              
               
            
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
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntriesActivity() {
       
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id'))
               ->from(array('contacts'), array('supplier_contact_name' => 'name'))
               ->from(array('companies'), array('supplier_name' => 'name', 'id_supplier' => 'id'))
               ->where('resource_id=resources.id')
               ->where('companies.id=resources.companies_id')
               ->where('contacts_id=contacts.id')
               ->where('activities_id='.$_SESSION["production"]["activity_id"])
              
               
            
               ->order('name')

        ;
        $data = $table->fetchAll($select);
        //TODO la select deberias sustituir este codigo por un distinct en la select para no repetir resultados
       
        return $data;
    }

    
    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntry($id) {
        echo $id;
        $table = $this->getTable();
        $select = $table->select()->where('id = ?', $id);
        return $table->fetchRow($select)->toArray();
    }
    
    public function getData($id)
    {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
         $select->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id'))
//               ->from(array('contacts'), array('supplier_contact_name' => 'name'))
//               ->from(array('companies'), array('supplier_name' => 'name', 'id_supplier' => 'id'))
               ->where('resource_id=resources.id')
//               ->where('companies.id=resources.companies_id')
//               ->where('contacts_id=contacts.id')
//               ->where('activities_id='.$_SESSION["production"]["activity_id"])
               //->where('resources.id = ?', (int) $id)
               ;
        $data= $table->fetchRow($select)->toarray();
//     Zend_Debug::dump($data,"Resource");
//     die();
     return $data;
    }
    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT resources.id, resources.name, date,
                    email,status, roles.name as role
          FROM resources, roles
          WHERE resources.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Resource");

        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypeResources($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('resource_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

