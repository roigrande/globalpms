<?php

/**
 * This is the Data Mapper class for the Acl_invoices table.
 */
class Finances_Model_Invoices {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Finances_Model_DbTable_Invoices();
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
    public function fetchEntries($production_id) {

        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select
                ->join(array("r" => "receipts"), 'r.id= invoice.receipt_id', array('receipts_id' => 'id', 'productions_id'))
                ->where('r.productions_id = ?', $production_id);
        ;
        $data = $table->fetchAll($select);
//Zend_Debug::dump($data);
//die();
        return $data;
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
    public function fetchInvoiceBelongProduction($invoice_id, $production_id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select
                ->join(array("r" => "receipts"), 'r.id= invoice.receipt_id', array('receipts_id' => 'id', 'productions_id'))
                ->where('r.productions_id = ?', $production_id)
                ->where('invoice.id = ?', $invoice_id)
        ;
        $data = $table->fetchRow($select);

        return $data;
    }

    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntriesByIva($invoice_id, $iva_type) {

        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->where('invoice.id = ?', $invoice_id)
                ->join(array("r" => "receipts"), 'r.id= invoice.receipt_id', array('receipts_id' => 'id'))
                ->join(array("rahc" => 'resource_activity_has_receipt'), 'r.id=rahc.receipts_id', array('resources_activities_has_receipt_id' => 'id', 'iva_type', 'receipt_price' => 'price', 'facturation_types_id', 'final_price','quantity'))
                ->where('iva_type=' . $iva_type)
                ->join(array("ra" => 'resources_activities'), 'ra.id=rahc.resources_activities_id', array('resource_activity_id' => 'ra.id', 'observation'))
                ->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id', 'resources_types_id'))
                ->where('ra.resource_id=resources.id')
                ->from(array('resources_types'), array('resources_types_id' => 'id'))
                ->where('resources_types.id=resources_types_id')
                ->from(array('facturation_types'), array('facturation_types_id' => 'id', 'facturation_types_name' => 'name'))
                ->where('facturation_types.id=facturation_types_id')
                ->order('iva_type')
        ;

        $data = $table->fetchAll($select)->toarray();
//          Zend_Debug::dump($data, "Receipts");
//        die("ddd");
//       
        if ($data)
            return $data;

        return null;
    }

    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchInvoice($id) {
        //group all the elements of the receipt for type of iva
        $sql = "SELECT id,name
                  FROM iva_types
                  ORDER BY name";
        $db = Zend_Registry::get('db');
        $iva_types = $db->fetchPairs($sql);

        foreach ($iva_types as $value) {

            $receipt[$value] = $this->fetchEntriesByIva($id, $value);
//            Zend_Debug::dump($receipt[$value]);
        }


//        Zend_Debug::dump($receipt, "Receipts");
//        die("dffffd");
        return $receipt;
    }

    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchDatasReceiptEntry($invoice_id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select
                ->joinleft(array("r" => "receipts"), 'r.id= invoice.receipt_id')
                ->where('invoice.id=' . $invoice_id);

        $data = $table->fetchAll($select)->toarray();
//       
//        Zend_Debug::dump($data[0], "Receipts");
//        die("ddd");
        return $data[0];
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT invoicess.id, invoicess.name, date,
                    email,status, roles.name as role
          FROM invoicess, roles
          WHERE invoicess.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Invoices");

        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypeInvoicess($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('invoices_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

