<?php
class User_Model_DbTable_Roles extends Zend_Db_Table_Abstract
{

    protected $_name = 'acl_roles';

    public function getRole($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    
    public function deleteRole($id) {
        
        $users = new User_Model_DbTable_Users;
        $users->delete('roles_id =' . (int) $id);;
        $this->delete('id =' . (int) $id);
    }
    public function getTable(){
        
        return $this->_name;
    }
    
    public function addRole(array $data)
    {
        //$table  = $this->getTable();
        $fields = $this->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $this->insert($data);
    }
    public function updateRole(array $data)
    {
        //$table  = $this->getTable();
        $fields = $this->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $this->update($data,'id = ' . (int) $data['id']);
    }
    
}

