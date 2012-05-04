<?php

/**
 * This is the Data Mapper class for the Acl_companies table.
 */
class Company_Model_Company {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Company_Model_DbTable_Company();
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
        $data2["acl_users_id"]=$_SESSION["gpms"]["storage"]->id;
        $data2["companies_id"]=$table->lastInsertId();
        $db = Zend_Registry::get('db');
        $db->insert(acl_users_has_companies,$data2);
          
        return $table->lastInsertId();
    }

    /* Update entry
     * 
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */

    public function update(array $data, $where) {
        
          $table = $this->getTable();
         $data["activity_types_id"] = implode(",", $data["activity_types_id"]);
          if ($data["activity_types_id"]==0){
              $data["activity_types_id"]=1;
        }
        
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
    public function delete($id) {
        //check the integration TODO the views and resource check
        $model_production = new Production_Model_Production();
        if ($model_production->fetchHaveCompanyClient($id)!=null) {
            die("esta compañia esta trabajando como cliente de una produccion");
        }
         $model_contact = new Company_Model_Contact();
        if ($model_contact->fetchHaveCompanyContact($id)) {
            die("esta compañia tiene contactos asociaodos");
        }
        //delete resource
        $table = $this->getTable();
        $table->delete('id = ' . (int) $id);
    }

    /* In litter entry
     * 
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */

    public function inLitter($where) {
        $table = $this->getTable();
        $data["in_Litter"] = (int) "1";
       
        return $table->update($data, $where);
    }
    
    public function outLitter($where) {
  
        $table = $this->getTable();
        $data["in_Litter"] = (int) "0";
         //die("outlitter");
        return $table->update($data, $where);
    }
    /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntries() {
        return $this->getTable()->fetchAll('1')->toArray();
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

        $data = $table->fetchRow($select)->toArray();
        
//        Zend_Debug::dump($data);
//        die();
        return $data;
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {

        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('ct' => 'company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
                ->where('ct.id = company_types_id')
              //  ->where('in_litter = 0')
        ;
        $data = $table->fetchAll($select)->toArray();

//        $i = 0;
//        $company_no_own = '';
//        foreach ($table as $key => $field) {
//            //check all the compannies dont have company_id in the table own_companies 
//            if ($field["id"] != $field["company_id"]) {
//                $i++;
//
//                $company_no_own[$i] = $field;
//                $company_no_own[$i]["activity_types_id"] = explode(",", $company_no_own[$i]["activity_types_id"]);
//            }
//        }
        return $data;
    }
    
    
    
    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchClientCompanies() {
//            Zend_Debug::dump($_SESSION);
//        echo "go";
//        die();
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('ct' => 'company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
               ->from(array('companies_has_productions'))
                ->from(array('permission_production'),array('acl_users_id', 'productions_id'))
            //   ->from(array('own_company' => 'companies'), array('own_company_id' => 'id'))
               ->from(array('productions'),array('production_id' => 'id'))
               ->where('ct.id=companies.company_types_id') 
//               ->where('acl_users_has_companies.acl_users_id = '.$_SESSION["gpms"]["storage"]->id)
               
               ->where('companies_has_productions.productions_id=productions.id')
               ->where('companies_has_productions.companies_id= '.$_SESSION["company"]["id"])
               ->where('productions.client_companies_id=companies.id')
               // ->where('in_litter = 0')
               ->where('productions.id=permission_production.productions_id')
               ->where('permission_production.acl_users_id='.$_SESSION["gpms"]["storage"]->id)
              
                
        ;
        $data = $table->fetchAll($select)->toArray();
//        Zend_Debug::dump($data);
//        die();  
         
        
//        $i = 0;
//        $company_no_own = '';
//        foreach ($table as $key => $field) {
//            //check all the compannies dont have company_id in the table own_companies 
//            if ($field["id"] != $field["company_id"]) {
//                $i++;
//
//                $company_no_own[$i] = $field;
//                $company_no_own[$i]["activity_types_id"] = explode(",", $company_no_own[$i]["activity_types_id"]);
//            }
//        }
        return $data;
    }
    
    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function noOwnCompany($id) {
        $model_own_company = new Company_Model_Owncompany;
        $arrayowncompanies = $model_own_company->fetchEntries();
        Zend_Debug::dump($arraycompanies, "---------------------------------");
        foreach ($arrayowncompanies as $owncompany => $ownfield) {
            foreach ($arraycompanies as $company => $field) {
                Zend_Debug::dump($field["id"], "---------------------------------");
                Zend_Debug::dump($ownfield, "---------------------------------");

                if ($field['id'] == $ownfield["company_id"])
                    unset($arraycompanies[$company]);
            }
        }
        Zend_Debug::dump($arraycompanies, "---------------------------------");
        die();
        $table = $this->getTable();
        $select = $table->select()->where('type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

}

