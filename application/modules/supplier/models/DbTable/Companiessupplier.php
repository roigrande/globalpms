<?php
/**
 * This is the DbTable class for the Companiessupplier table.
 */
class Supplier_Model_DbTable_Companiessupplier extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'companies_has_suppliers';
    /** Primary key */
    protected $_primary = array( 'companies_id','suppliers_id');
   
    
     /**
     * Last insertId
     *
     * 
     * @return int
     */
    public function lastInsertId()
    {
        return $this->_db->lastInsertId();
    }
    
    public function insert(array $data)
    {
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
    public function update(array $data, $where)
    {     
        return parent::update($data,$where);            
    }
    
    /**
     * delete row(s)         
     * 
     * @param  array $data 
     * @return int
     */
    public function delete($where)
    {
        return parent::delete($where);
    }
    
}
?>