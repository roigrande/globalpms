<?php

/**
 * This is the Data Mapper class for the Acl_contacts table.
 */
class Client_Model_Contact {

   /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Client_Model_DbTable_Contact();
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
    public function delete($id) {
        //check the integration TODO the views and resource check

        $model_production = new Production_Model_Activity();
        if ($model_production->fetchHaveContactClient($id)) {
           // die("client company");
           $this->inLitter("id =".$id);  
            return true;
//            die("esta contacto esta usado como contacto cliente de una actividad");
        }

        if ($model_production->fetchHaveContactCompany($id)) {
           // die("own company");
            $this->inLitter("id =".$id);
            return true;   
//            die("esta contacto esta usado como contacto propio de una actividad");
        }
//        echo $id;
//        die("va borrar");
        $table = $this->getTable();
        
        $table->delete('id = ' . (int) $id);
    }
   
    
    public function inLitter($where) {
        $table = $this->getTable();
        $data["in_Litter"] = (int) "1";
        return $table->update($data, $where);
    }
    public function outLitter($where) {
        
        $table = $this->getTable();
        $data["in_Litter"] = (int) "0";
        return $table->update($data, $where);
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
        // Zend_Debug::dump($data);
        return $data;
    }

    public function fetchHaveClientContact($company_id) {

        $table = $this->getTable();
        $select = $table->select()->where('company_id = ?', $company_id);
        $row = $table->fetchRow($select);
        return $row;
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql($company_id) {

        $sql = "SELECT contacts.id,contacts.name, contacts.email,
                       contacts.status, companies.name as company_name,
                       contacts.telephone
          FROM contacts, companies
          WHERE contatcs.company_id='$company_id'
          WHERE contacts.company_id = companies.id              
          ";

        return $table;
    }

    public function fetchClient($id_company) {

        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('c' => 'companies'), array('company' => 'name', 'id_company' => 'id'))
                ->where('company_id = ?', $id_company)
                ->where('company_id = c.id')
             //   ->where('contacts.in_litter = "0"')
        ;
        $data = $table->fetchAll($select)->toarray();
//       
//        Zend_Debug::dump($data);
//        die();
        return $data;
    }
    
    
     
     public function isOwnContact($contact_id) {
         
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select ->where('id = ?', $contact_id)
                ->where('company_id = '.$_SESSION["company"]["id"])
                ->where('contacts.in_litter = "0"')
        ;
        return $data = $table->fetchAll($select)->toarray();
     }
    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchContacts($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }
}