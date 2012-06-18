<?php

/**
 * This is the Data Mapper class for the Acl_productionsupplierss table.
 */
class Production_Model_Productionsuppliers {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Production_Model_DbTable_Productionsuppliers();
        }
        return $this->_table;
    }

    /* Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */

    public function save(array $data) {
        unset($data["id"]);
//        Zend_Debug::dump($data);
//        die();
        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }

        $table->insert($data);
        $db = Zend_Registry::get('db');
        $production_suppliers["productions_id"] = $_SESSION["production"]["id"];
        $production_suppliers["suppliers_id"] = $table->lastInsertId();
//                    Zend_Debug::dump($data_activity_type,"inserta bd");
        $db->insert("productions_has_suppliers", $production_suppliers);
        return $production_suppliers["suppliers_id"];
    }

    /* Update entry
     * 
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */

    public function update(array $data, $id) {
        $model_company = new Company_Model_Company();
        if ($model_company->existSupplierCompany($data["fiscal_name"], $id)) {
            //TODO ENVIAR UN MENSAJE
            die("supplier existe");
        }
        //add types of activity for the supplier
        $db = Zend_Registry::get('db');

        $db->delete("suppliers_has_activity_types", "suppliers_id=" . $id);
        $data_activity_type["suppliers_id"] = $data["id"];
        foreach ($data["activity_types_id"] as $value) {

            $data_activity_type["activity_types_id"] = $value;
            $db->insert("suppliers_has_activity_types", $data_activity_type);
//                 Zend_Debug::dump($data_activity_type);
        }
//                die();

        $model_company = new Company_Model_Company();
        $data_company = $data;
        $data_company["id"] = $data_company["companies_id"];
        $model_company->update($data_company, 'id = ' . (int) $data["companies_id"]);

        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }

        return $table->update($data, 'id = ' . (int) $id);
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
        $select->from(array('companies'))
                ->from(array('productions_has_suppliers'))
                ->from(array('company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
                ->where('company_types_id=company_types.id')
                ->where('suppliers.companies_id=companies.id')
                ->where('suppliers.id=productions_has_suppliers.suppliers_id')
                ->where('productions_has_suppliers.productions_id=' . $_SESSION["production"]["id"])
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
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntry($id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('ct' => 'company_types'), array('company_types_name' => 'name', 'company_types_id' => 'id'))
//               ->join(array('suppliers_has_activity_types'),
//                    'suppliers_has_activity_types.suppliers_id = suppliers.id')
                ->from("companies", array('companies_id' => 'id', 'name', 'fiscal_name', 'email'
                    , 'direction', 'postal_code', 'city', 'country', 'telephone', 'fax', 'observation'))
                ->where('ct.id = company_types_id')
                ->where('companies.id=' . $id)
                ->where('companies.id=suppliers.companies_id')
        //  ->where('in_litter = 0')
        ;
        $data = $table->fetchAll($select)->toarray();
//          Zend_Debug::dump($data);
//          die();
        $sql = "SELECT id,name
                From suppliers_has_activity_types
                INNER JOIN activity_types ON activity_types.id = suppliers_has_activity_types.activity_types_id
                WHERE suppliers_has_activity_types.suppliers_id = " . $data["0"]["id"];
        ;

        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        $result = implode(",", $result);
        $data["0"]["activity_types_name"] = $result;
        $db = Zend_Registry::get('db');
        $sql = "SELECT activity_types_id
                FROM suppliers_has_activity_types
                WHERE suppliers_has_activity_types.suppliers_id=" . $data["0"]["id"];
//                Zend_Debug::dump($data);
        $data_type = $db->fetchAll($sql);
        foreach ($data_type as $key => $value) {
            $data["0"]["activity_types_id"][$key] = $value->activity_types_id;
        }
//          Zend_Debug::dump($data);
//        die();
        return $data["0"];
    }

    public function isSupplierInProduction($id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from("companies", array('companies_id' => 'id', 'name', 'fiscal_name', 'email'
                    , 'direction', 'postal_code', 'city', 'country', 'telephone', 'fax', 'observation'))
                ->from("productions_has_suppliers")
                ->where("productions_has_suppliers.productions_id=" . $_SESSION["production"]["id"])
                ->where("productions_has_suppliers.suppliers_id=suppliers.id")
                ->where('companies.id=' . $id)
                ->where('companies.id=suppliers.companies_id')
                ->where('in_litter = 0')
        ;
        $data = $table->fetchAll($select)->toarray();

//        Zend_Debug::dump($data);
//        die();
        return $data["0"];
    }

}

