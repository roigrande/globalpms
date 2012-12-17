<?php

/**
 * This is the Data Mapper class for the Acl_receiptss table.
 */
class Finances_Model_Receipts {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Finances_Model_DbTable_Receipts();
        }
        return $this->_table;
    }

    /* Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */

    public function save($id) {

        $model_company = new Company_Model_Company();
        $data_receipt = $model_company->fetchProductionClientCompany($_SESSION["production"]["id"]);
        $data_receipt["productions_id"] = $_SESSION["production"]["id"];
        $data_receipt["production_name"] = $data_receipt["name"];
        unset($data_receipt["id"]);
        unset($data_receipt["name"]);
        // seguir aqui coger los datos del cliente y devolver los que necesites en un array

        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);

        foreach ($data_receipt as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data_receipt[$field]);
            }
        }
        $table->insert($data_receipt);

        return $table->lastInsertId();
    }

//     /* Save a new entry
//     * 
//     * @param  array $data 
//     * @return int|string
//     */
//
//    public function production_has_open_receipt($production_id) {
//        $table = $this->getTable();
//        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
//                ->setIntegrityCheck(false);
//        $select
//               ->where('productions_id = ?',$production_id)
//               ->where('receipts.invoice = 0');
//           
//    $data = $table->fetchRow($select);
// Zend_Debug::dump();
//        die();
//        return $data;  
//     }
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
    public function fetchReceiptEntry($production_id) {
        $table = $this->getTable();
        $select = $table->select()
                ->where('productions_id = ?', $production_id)

        ;
        return $table->fetchRow($select);
    }

    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchReceiptEntries($id) {
        //group all the elements of the receipt for type of iva
        $sql = "SELECT id,name
                  FROM iva_types
                  ORDER BY name";
        $db = Zend_Registry::get('db');
        $iva_types = $db->fetchPairs($sql);
        
        foreach ($iva_types as $value) {
           
            $receipt[$value]=  $this->fetchReceiptEntriesByIva($id,$value);
//            Zend_Debug::dump($receipt[$value]);
        }
      
        
//        Zend_Debug::dump($receipt, "Receipts");
//        die("ddd");
        return $receipt;
    }
    
     /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchReceiptEntriesByIva($id,$iva_type) {
      
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->where('productions_id = ?', $id)
                 ->joinleft(array("i" => "invoice"), 'receipts.id= i.receipt_id', array('invoice_id' => 'id', 'invoices_status_id'))
                ->where('i.receipt_id IS NULL')
                ->join(array("rahc"=>'resource_activity_has_receipt'), 'receipts.id=rahc.receipts_id',array('resources_activities_has_receipt_id' => 'id','iva_type','receipt_price'=>'price','facturation_types_id','final_price'                                                                                                       ))
                ->where('iva_type='.$iva_type)
                ->join(array("ra"=>'resources_activities'),'ra.id=rahc.resources_activities_id', array('resource_activity_id'=>'ra.id'))
                ->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id','resources_types_id'))
                ->where('ra.resource_id=resources.id')
                ->from(array('resources_types'), array('resources_types_id' => 'id'))
                ->where('resources_types.id=resources_types_id')
                ->from(array('facturation_types'), array('facturation_types_id' => 'id','facturation_types_name' => 'name'))
                ->where('facturation_types.id=facturation_types_id')

//                ->where('facturation_types.id='.$iva_type)
//                ->joinLeft(array("rahc"=>'resource_activity_has_receipt'), 'resources_activities.id=rahc.resources_activities_id',array('resources_activities_has_receipt_id' => 'id','iva_type','receipt_price'=>'price','facturation_types_id','final_price'))
//             
//                ->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id','resources_types_id'))
//                ->where('resources_activities.resource_id=resources.id')
//                ->from(array('activities'), array('id_production_activities' => 'productions_id'
//                                                    , 'activity_name' => 'name'
//                                                    , 'id_activities' => 'id'
//                                                    , 'date_start'
//                                                    , 'date_end'
//                                                    ))
//                ->where('activities.id=resources_activities.activities_id')
//                ->where('activities.productions_id=' . $production_id)

                      
//                ->joinLeft(array('i' => 'invoice'), 'i.receipt_id = r.id',array('invoice_id'=>'id'))
//                ->joinLeft(array('is' => 'invoices_status'), 'is.id=i.invoices_status_id',array('invoice_id'=>'id','invoices_status_name' => 'name'))
//                ->joinLeft(array('ft' => 'facturation_types'), 'rahc.facturation_types_id = ft.id',array('facturation_types_id'=>'id','facturation_types_name'=>'name'))
//                ->order('date_start')
                ->order('iva_type')
        ;
        
        $data = $table->fetchAll($select)->toarray();
        if ($data)
           
//        Zend_Debug::dump($data, "Receipts");
//        die("ddd");
        return $data;
    }
    
    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchProductionHasOpenReceipt($id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->where('productions_id = ?', $id)
//                ->from('invoice',array("invoice_id"=>'id'))
                ->joinleft(array("i" => "invoice"), 'receipts.id= i.receipt_id', array('invoice_id' => 'id', 'invoices_status_id'))
                ->where('i.receipt_id IS NULL')

        ;
        $data = $table->fetchRow($select);
//        $sql = "SELECT receipts.id, receipts.name
//          FROM receipts, roles
//          where not exists (select receipts.id, 
//                  from Contacted_table t2 
//                  where t1.email = t2.email)              
//          ORDER BY roles.id";
//
//        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Receipts");
//        return $table;
        return $data;
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT receiptss.id, receiptss.name, date,
                    email,status, roles.name as role
          FROM receiptss, roles
          WHERE receiptss.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Receipts");

        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypeReceiptss($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('receipts_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

