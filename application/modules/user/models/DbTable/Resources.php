<?php
class User_Model_DbTable_Resources extends Zend_Db_Table_Abstract
{

    protected $_name = 'acl_resources';

 public function getResource($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addResource($resource_name,$rol_parent,$prefered_uri) {
        
        $this->insert($resource_name,$rol_parent,$prefered_uri);
    }

    public function updateResource($id, $resource) {
        
        $this->update($resource, 'id = ' . (int) $id);
    }

    public function deleteResource($id) {
        
        $Permissions = new User_Model_DbTable_Permissions();
        $Permissions->delete('resource_id =' . (int) $id);
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
     /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntries()
    {        
        return $this->getTable()->fetchAll('1')->toArray();
    }
     
     /**
     * Fetch all resource with module_id
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchResources($module_id)
    {        
        $select=$this->select()->where('module_id =' . (int) $module_id);
        return $this->fetchAll($select)->toArray();
    }
}

