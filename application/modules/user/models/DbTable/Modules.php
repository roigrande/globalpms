<?php
class User_Model_DbTable_Modules extends Zend_Db_Table_Abstract
{

    protected $_name = 'acl_modules';

    public function getModule($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addModule($module_name,$rol_parent,$prefered_uri) {
        
        $this->insert($module_name,$rol_parent,$prefered_uri);
    }

    public function updateModule($id, $module) {
        
        $this->update($module, 'id = ' . (int) $id);
    }

    public function deleteModule($id) {
        
        $users = new User_Model_DbTable_Users;
        //$users->deleteUsersModule($id);
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

