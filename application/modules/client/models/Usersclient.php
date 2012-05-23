<?php

/**
 * This is the Data Mapper class for the Acl_usersclients table.
 */
class Client_Model_Usersclient {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Client_Model_DbTable_Usersclient();
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
    public function delete($user_id,$company_id) {
        $model_contact = new Client_Model_Contact();
        $data["acl_users_id"] = 0;
        $model_contact->update($data, 'acl_users_id = ' . (int) $user_id . ' and company_id =' . $company_id);
        //delete resource
        $table = $this->getTable();
        $table->delete('acl_users_id = ' . (int) $user_id . ' and companies_id =' . $company_id);
    }

    /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntries() {
        return $this->getTable()->fetchAll('1');
    }

    public function fetchEntriesClient($client_id) {

        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('acl_users'))
                ->from(array('acl_roles'), array('role_name' => 'name'))
                ->where('companies_id=' . $client_id)
                ->where('acl_users_id=acl_users.id')
                ->where('acl_users.role_id=acl_roles.id')
        ;
        $data = $table->fetchAll($select)->toArray();
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
        $select = $table->select()->where('id = ?', $id);
        return $table->fetchRow($select)->toArray();
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT usersclients.id, usersclients.name, date,
                    email,status, roles.name as role
          FROM usersclients, roles
          WHERE usersclients.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Usersclient");

        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypeUsersclients($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('usersclient_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

