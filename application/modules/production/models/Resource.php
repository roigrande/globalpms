<?php

/**
 * This is the Data Mapper class for the Acl_resources table.
 */
class Production_Model_Resource {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Production_Model_DbTable_Resource();
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
        unset($data["id"]);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
//        Zend_Debug::dump($data);
//        die();
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
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id'))
                ->from(array('contacts'), array('supplier_contact_name' => 'name'))
                ->from(array('companies'), array('supplier_name' => 'name', 'id_supplier' => 'id'))
                ->where('resource_id=resources.id')
                ->where('companies.id=resources.companies_id')
                ->where('contacts_id=contacts.id')
                ->order('name')

        ;
        $data = $table->fetchAll($select);
        //TODO la select deberias sustituir este codigo por un distinct en la select para no repetir resultados
//        
//        Zend_Debug::dump($data);
//        die();
        return $data;
    }

    /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntriesSupplier() {
        $sql = "SELECT resources.id, resources.name ,description ,direction, num_resources, resources_types.name as resources_types_name, in_litter 
          FROM resources, resources_types
          WHERE resources.companies_id =" . $_SESSION["supplier"]["id"] . "
              AND resources_types.id=resources.resources_types_id  
          ORDER BY name"
        ;

        $data = $this->getTable()->getAdapter()->fetchAll($sql);

        //TODO la select deberias sustituir este codigo por un distinct en la select para no repetir resultados
//        
//        Zend_Debug::dump($data);
//        die();
        return $data;
    }

    /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntriesActivity() {

        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id'))
                ->from(array('contacts'), array('supplier_contact_name' => 'name'))
                ->from(array('companies'), array('supplier_name' => 'name', 'id_supplier' => 'id'))
                ->where('resource_id=resources.id')
                ->where('companies.id=resources.companies_id')
                ->where('contacts_id=contacts.id')
                ->where('activities_id=' . $_SESSION["production"]["activity_id"])
                ->order('name')

        ;
        $data = $table->fetchAll($select);
        //TODO la select deberias sustituir este codigo por un distinct en la select para no repetir resultados

        return $data;
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
       ->joinLeft(array("rahc"=>'resource_activity_has_receipt'), 'resources_activities.id=rahc.resources_activities_id',array('resources_activities_has_receipt_id' => 'id','iva_type','receipt_price'=>'price','facturation_types_id','final_price'))
             
                ->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id','resources_types_id'))
                ->where('resources_activities.resource_id=resources.id')
                ->from(array('activities'), array('id_production_activities' => 'productions_id'
                                                    , 'activity_name' => 'name'
                                                    , 'id_activities' => 'id'
                                                    , 'date_start'
                                                    , 'date_end'
                                                    ))
                ->where('activities.id=resources_activities.activities_id')
                ->where('activities.productions_id=' . $production_id)
                ->joinLeft(array("r"=>'receipts'),'r.id=receipts_id', array('receipts_id'=>'r.id'))
                ->from(array('resources_types'), array('resources_types_id' => 'id'))
                ->where('resources_types.id=resources_types_id')               
                ->from(array('iva_types'), array('iva_type_name' => 'name','iva_type_id' => 'id'))
                ->where('iva_types.id=resources_types.iva_types_id')
                ->joinLeft(array('i' => 'invoice'), 'i.receipt_id = r.id',array('invoice_id'=>'id'))
                ->joinLeft(array('is' => 'invoices_status'), 'is.id=i.invoices_status_id',array('invoice_status_id'=>'id','invoices_status_name' => 'name'))
                ->joinLeft(array('ft' => 'facturation_types'), 'rahc.facturation_types_id = ft.id',array('facturation_types_id'=>'id','facturation_types_name'=>'name'))
                ->order('date_start')
        ;
        $data = $table->fetchAll($select);
       
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
    public function fetchIvaType($id) {
echo $id;
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('resources'), array('id_resource' => 'id'))
               ->where('resource_id=resources.id')
               ->from(array('resources_types'), array('id_resources_type' => 'id'))
               ->where('resources_types.id = resources_types_id')
                ->from(array('iva_types'), array('iva_type' => 'name', 'id_iva_type' => 'id'))
                ->where('iva_types.id = iva_types_id')
                ->where('resources_activities.id= '.$id)
//               ->where('companies.id=resources.companies_id')
//               ->where('contacts_id=contacts.id')
//               ->where('activities_id='.$_SESSION["production"]["activity_id"])
        //->where('resources.id = ?', (int) $id)
        ;
        $data = $table->fetchAll($select)->toarray();
    //        Zend_Debug::dump($data[0]);
    //        die();
        return $data["0"]["iva_type"];
    }

    public function getData($id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('resources'), array('resource_name' => 'name', 'id_resource' => 'id'))
//               ->from(array('contacts'), array('supplier_contact_name' => 'name'))
//               ->from(array('companies'), array('supplier_name' => 'name', 'id_supplier' => 'id'))
                ->where('resource_id=resources.id')
//               ->where('companies.id=resources.companies_id')
//               ->where('contacts_id=contacts.id')
//               ->where('activities_id='.$_SESSION["production"]["activity_id"])
        //->where('resources.id = ?', (int) $id)
        ;
        $data = $table->fetchRow($select)->toarray();
//     Zend_Debug::dump($data,"Resource");
//     die();
        return $data;
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT resources.id, resources.name, date,
                    email,status, roles.name as role
          FROM resources, roles
          WHERE resources.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Resource");

        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypeResources($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('resources_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

