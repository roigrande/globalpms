<?php
class User_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected $_name = 'acl_users';

    public function getUser($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function deleteUser($id) {
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
        $data['password']=hash('SHA256', $data['password']);
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
        $data['password']=hash('SHA256', $data['password']);
        return $this->update($data,'id = ' . (int) $data['id']);
    }
}

