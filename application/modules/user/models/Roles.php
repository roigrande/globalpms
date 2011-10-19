<?php

/**
 * This is the Data Mapper class for the Acl_resources table.
 */
class User_Model_Roles {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new User_Model_DbTable_Roles();
        }
        return $this->_table;
    }

    /* Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */

    public function save(array $data) {
        $data["role_parent"] = implode(",", $data["role_parent"]);
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
        $data["role_parent"] = implode(",", $data["role_parent"]);

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


        $table = $this->getTable();
        // Get the parent_role from the role will delete
        $role = $this->fetchEntry($id);

        Zend_Debug::dump($role["role_parent"], "rol que eliminamos");
        //find the roles have the parent role of the role will delete
        $rolsongs = $this->fetchParentRoles($id);
        Zend_Debug::dump($rolsongs["0"]["id"], "el hijo del rol que eliminaremos");

        //chance the parent_role of the songs
        foreach ($rolsongs as $value) {
            $data["role_parent"] = (int) $role["role_parent"];
            $data["id"] = $value["id"];
            $this->update($data, 'id =' . (int) $value["id"]);
        }

        //find the users with the role will delete
        $users = new User_Model_Users;
        $users->getTable();
        $arrayusers = $users->fetchUsers($id);
        //Zend_Debug::dump($arrayusers,"users with role will delete");
        // chance the role to the users
        foreach ($arrayusers as $value) {
            $data["role_id"] = (int) $rolsongs["0"]["id"];
            $data["id"] = $value["id"];
            Zend_Debug::dump($data, "data1");
            $users->update($data, 'id =' . (int) $value["id"]);
        }

        $table->delete('id =' . (int) $id);
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
        $tablebd = $table->fetchRow($select)->toArray();

        $tablebd["role_parent"] = explode(",", $tablebd["role_parent"]);
        return $tablebd;
    }

    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|string name
     */
    public function fetchName($id) {
        $table = $this->getTable();
        $select = $table->select()->where('id = ?', $id);
        $tablebd = $table->fetchRow($select);
        return $tablebd["name"];
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
     
        $model = $this->fetchEntries();
        foreach ($model as $key => $value) {
            $value["role_parent"] = explode(",", $value["role_parent"]);
            foreach ($value["role_parent"] as $key2 => $value2) {

                $model[$key]["parents_name"][$key2] = $this->fetchName($value2);
            }
            $model[$key]["parents_name"] = implode(", ", $model[$key]["parents_name"]);
            
            
        }
       
      
        return $model;
    }

    /**
     * Fetch all roles with $role_parent
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchParentRoles($role_parent) {
        $table = $this->getTable();
        $select = $table->select()->where('role_parent =' . (int) $role_parent);
        return $table->fetchAll($select)->toArray();
    }

}

