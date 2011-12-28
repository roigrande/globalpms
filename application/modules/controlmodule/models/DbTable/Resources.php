<?php

/**
 * This is the DbTable class for the Banners table.
 */
class Controlmodule_Model_DbTable_Resources extends Zend_Db_Table_Abstract {

    /** Table name */
    protected $_name = 'acl_resources';
    /** Primary key */
    protected $_primary = 'id';

    /**
     * Insert new row
     *
     * Ensure that a timestamp is set for the created field.
     * 
     * @param  array $data 
     * @return int
     */
    public function insert(array $data) {
        return parent::insert($data);
    }

    /**
     * Update row(s)
     *
     * Do not allow updating of entries
     * 
     * @param  array $data 
     * @param  mixed $where 
     * @return void
     * @throws Exception
     */
    public function update(array $data, $where) {
        return parent::update($data, $where);
    }

    /**
     * delete row(s)         
     * 
     * @param  array $data 
     * @return int
     */
    public function delete($id) {
        //delete permission of the resource
        $permissions = new Controlmodule_Model_DbTable_Permissions();
        $permissions->delete("resource_id=" . (int) $id);
        return parent::delete('id = ' . (int) $id);
    }

    public function fetchResources($module_id) {
        $select = $this->select()->where('module_id =' . (int) $module_id);
        return $this->fetchAll($select)->toArray();
    }

}

?>