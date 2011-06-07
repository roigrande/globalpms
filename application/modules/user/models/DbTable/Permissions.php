<?php
class User_Model_DbTable_Permissions extends Zend_Db_Table_Abstract
{

    protected $_name = 'acl_permissions';

    public function getPermission($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addPermission($permission_name,$rol_parent,$prefered_uri) {
        
        $this->insert($permission_name,$rol_parent,$prefered_uri);
    }

    public function updatePermission($id, $permission) {
        
        $this->update($permission, 'id = ' . (int) $id);
    }

    public function deletePermission($id) {
        
        $users = new User_Model_DbTable_Users;
        //$users->deleteUsersPermission($id);
        $this->delete('id =' . (int) $id);
    }
    public function getTable(){
        
        return $this->_name;
    }
    
   public function save(array $data)
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
    public function saveUpdate(array $data)
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

