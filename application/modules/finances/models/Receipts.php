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
        
        $model_company= new Company_Model_Company();
        $data_receipt=$model_company->fetchProductionClientCompany($_SESSION["production"]["id"]);
        $data_receipt["productions_id"]=$_SESSION["production"]["id"];
        $data_receipt["production_name"]=$data_receipt["name"];
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
    public function fetchProductionHasReceipt($id) {
        $table = $this->getTable();
        
        $select = $table->select()->where('productions_id = ?',$id)
                ->join(array("i"=>"invoice"), 'receipts_id= i.receipt_id');
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
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchProductionHasOpenReceipt($id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->where('productions_id = ?',$id)
//                ->from('invoice',array("invoice_id"=>'id'))
                ->joinleft(array("i"=>"invoice"), 'receipts.id= i.receipt_id',array('invoice_id'=>'id','invoices_status_id'))
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

