<?php

/**
 * This is the Data Mapper class for the Acl_resource_activity_has_receipts table.
 */
class Finances_Model_Resourceactivityhasreceipt {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {            
            $this->_table = new Finances_Model_DbTable_Resourceactivityhasreceipt();
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
    public function delete($where) {

        //delete resource
        $table = $this->getTable();
        $table->delete($where);
    }

    /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntries() {
        return $this->getTable()->fetchAll('1');
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
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntryActivityResource($id) {
        $table = $this->getTable();
        $select = $table->select()->where('resources_activities_id = ?', $id);
        $data= $table->fetchRow($select);
        if ($data== null){
            return null;
        }
        
     return $data["id"];
    }
    
    
         /**
     * Calculate the final price of one item
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function calculateFinalPrice( $resources_activities_id,$price,$facturaction_type_id,$quantity) {
        
        //por hora
        //comprobar que es por hora el facturation_type
        //TODO quitar hardcode
        if ($facturaction_type_id=='32') {
        //calcular la diferencia de horas entre las fechas
        //restar las horas que no se trabajaron
        $model_activity = new Production_Model_Activity();
        
        $hours = $model_activity->hours_activity($resources_activities_id);
      
        //multiplicar por el precio de la hora
        $final_price= $hours*(int)$price*$quantity;
        
        //multiplicar por el iva
//        $final_price=$final_price+$final_price/(int)$iva_type;
        return $final_price;
        }
        
         //por hora
        //comprobar que es por hora el facturation_type
        //TODO quitar hardcode
        if ($facturaction_type_id=='33') {
        
        return $price*$quantity;
        }
        
         
        
    }
 
    
         /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntriesProduction($production_id) {
 
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select
                    
 //               ->from(array('contacts'), array('supplier_contact_name' => 'name'))
//               ->from(array('companies'), array('supplier_name' => 'name', 'id_supplier' => 'id'))
 ////            ->from(array('facturation_types'), array('facturation_types_name' => 'name'))
                
//                 ->from(array('ra'=>'resources_activities'), array('resources_activities_id' => 'id','name','unbilled_hours','quantity'))                
                 ->from('resource_activity_has_receipt', array('rssesource_activity_has_receipts_id'=>'id','iva_type'))
                 ->joinRight(array('resources_activities'), 'resource_activity_has_receipt.id=resource_activity_has_receipt.resources_activities_id',array('resources_activities_id'=>'resources_activities.id','name','name','unbilled_hours','quantity','price'))
//               ->where('resources_activities.id=resources_activities_id')
//                ->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id','resources_types_id'))
//                ->where('resources_activities.resource_id=resources.id')
                 ->from(array('activities'), array('id_production_activities' => 'productions_id','activity_name' => 'name', 'id_activities' => 'id','date_start','date_end'))
                 ->where('activities.id=resources_activities.activities_id')               
                 ->where('activities.productions_id='.$production_id)
//              
//                ->from(array('receipts'), array('receipts_id' => 'id'))
//                ->where('receipts_id=receipts.id')
//                ->where('receipts.productions_id=?',$production_id)
//                ->from(array('resources_types'), array('resources_types_id' => 'id'))
//                ->where('resources_types.id=resources_types_id')               
//                ->from(array('iva_types'), array('iva_type_name' => 'name'))
//                ->where('iva_types.id=resources_types.iva_types_id')
//                ->from(array('invoice'), array('invoice_id' => 'id'))
//                ->joinLeft(array('i' => 'invoice'), 'invoice.receipt_id = receipts.id',array('invoice_id'=>'id','invoices_status_id'))
//                
////               ->where('facturation_types.id=facturation_types_id')
//               
//               ->where('resource_id=resources.id')
//               ->where('companies.id=resources.companies_id')
//               ->where('contacts_id=contacts.id')
//              
              
               
            
//               ->order('name')

        ;
        $data = $table->fetchAll($select);
        //TODO la select deberias sustituir este codigo por un distinct en la select para no repetir resultados
       
        return $data;
    }
    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT resource_activity_has_receipts.id, resource_activity_has_receipts.name, date,
                    email,status, roles.name as role
          FROM resource_activity_has_receipts, roles
          WHERE resource_activity_has_receipts.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        
        //   Zend_Debug::dump($table,"Resource_activity_has_receipt");
     
        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypeResource_activity_has_receipts($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('resource_activity_has_receipt_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

