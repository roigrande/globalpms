<?php

/**
 * This is the Data Mapper class for the Acl_users table.
 */
class User_Model_Users {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new User_Model_DbTable_Users();
        }
        return $this->_table;
    }

    /* Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */

    public function save(array $data) {
        $data_contact= $data;
        $data_user_company["companies_id"]=$data["company_id"];
      
        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
       
        $data['password'] = hash('SHA256', $data['password']);
        $table->insert($data);
        $last_insert_id=$table->lastInsertId();
        
        Zend_Debug::dump($data_contact);
        //check if the user want have contat
         $data_contact['acl_users_id']=$last_insert_id;
        if($data_contact["add_contact"]){
           $model = new Company_Model_Contact;  
           $model->save($data_contact);
        }
        
        //Add the user in the company
        $data_user_company["acl_users_id"]=$data_contact['acl_users_id'];
        
        $db = Zend_Registry::get('db');
//         Zend_Debug::dump($data_user_company);
//        die();
        $db->insert(acl_users_has_companies,$data_user_company);
        
        return $last_insert_id;
    }

    /* Update entry
     * 
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */

    public function update(array $data, $where) {
        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
         //check if the user want have contat
        $data_contact=$data;
        $data_contact['acl_users_id']=$data["id"];
        unset($data_contact["id"]);
         
        if($data_contact["add_contact"]){
           $model = new Company_Model_Contact;  
           $model->save($data_contact);
        }
       
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
         
        if ($data['password']!=""){
            $data['password'] = hash('SHA256', $data['password']);
        }else{ unset($data['password']);}
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
        return $table->fetchRow($select)->toArray();
    }
    
    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function isUser($contact_id) {
        $table = $this->getTable();
        $select = $table->select()->where('contacts_id = ?', $contact_id);
        $data=$table->fetchRow($select);
        return $data;
    }
      /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntryContact($contact_id) {
        $table = $this->getTable();
        $select = $table->select()->where('contacts_id = ?', $contact_id);
        return $table->fetchRow($select)->toArray();
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT acl_users.id, acl_users.name, date,
                    email,status, person_id,
                    validation_code,phone, acl_roles.name as role
          FROM acl_users, acl_roles
          WHERE acl_users.role_id = acl_roles.id              
          ORDER BY acl_roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchUsersCompany($company_id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select ->from(array('acl_users_has_companies'))
                ->where('acl_users_has_companies.companies_id='.$company_id)
                ->where('acl_users_has_companies.acl_users_id=acl_users.id')
         ;
        $data = $table->fetchAll($select)->toArray();
       
        return $data;
   
    }
    public function haveContact($user_id) {
//        echo $_SESSION["company"]["id"];
//        echo $user_id;
//        
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select ->from(array('contacts'), array('contact_id' =>'id'))
                ->where('contacts.company_id='.$_SESSION["company"]["id"])
                ->where('contacts.acl_users_id='.$user_id)
                ->where('acl_users.id='.$user_id)
                
                
         ;
        $data = $table->fetchAll($select)->toArray();
//        Zend_Debug::dump($data);
//        die();
       
        return $data;
   
    }
    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchUsers($role_id) {

        $table = $this->getTable();
        $select = $table->select()->where('role_id =' . (int) $role_id);

        return $table->fetchAll($select)->toArray();
    }

}

