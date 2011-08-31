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
        $roles = new User_Model_DbTable_Roles;
        
        //find the song of rol will delete
        $rol =$roles->fetchRow('role_parent =' . (int) $id);
        
        //find the users with the rol will delete
        $array=$users->fetchUsers($id);
        foreach ($array as $value) {
            $data["role_id"] = $rol["id"];
            $data["id"] = $value["id"];
        
        $users->saveUpdate($data);
        
        }
        
        
        $roles= new User_Model_DbTable_Roles;
        
        // Get the parent_role from the role i will delete
        $role_parent=$roles->getRole($id);   
        //find all the roles with the parent role = the role will delete
        $arrayroles=$roles->fetchParentRoles($id);
        //put new role parent the roles have the rol will delete
        foreach ($arrayroles as $value) {
            $datarole["role_parent"] = $role_parent["role_parent"];
            $datarole["id"] = $value["id"];
        
        $roles->saveUpdate($datarole);
        
        }
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
     public function fetchParentRoles($role_parent)
    {        
        $select=$this->select()->where('role_parent =' . (int) $role_parent);
        return $this->fetchAll($select)->toArray();
    }
    
}

