<?php

/**
 * This is the Data Mapper class for the Acl_clients table.
 */
class Client_Model_Client {
 
    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Client_Model_DbTable_Client();
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
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('companies_has_productions'))
                ->from(array('permission_production'), array('acl_users_id'))
                
                ->from(array('productions'), array('production_id' => 'id'))
                ->where('company_types_id=company_types.id')
//               ->where('acl_users_has_companies.acl_users_id = '.$_SESSION["gpms"]["storage"]->id)
                ->from(array('company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
                ->where('companies_has_productions.companies_id= ' . $_SESSION["company"]["id"])
                ->where('companies_has_productions.productions_id=productions.id')
                ->where('productions.client_companies_id=companies.id')
                // ->where('in_litter = 0')
                ->where('productions.id=permission_production.productions_id')
                ->where('permission_production.acl_users_id=' . $_SESSION["gpms"]["storage"]->id)
                ->order('name')

        ;
        $data = $table->fetchAll($select)->toarray();
        //TODO la select deberias sustituir este codigo por un distinct en la select para no repetir resultados
        $data=$this->elimina_duplicados($data, "id");
//        Zend_Debug::dump($data);
//        die();
        return $data;
    }
    
    public function isUserAllowedClient($client_id){
        
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('companies_has_productions'))
                ->from(array('permission_production'), array('acl_users_id'))
                //->from(array('own_company' => 'companies'), array('own_company_id' => 'id'))
                ->from(array('productions'), array('production_id' => 'id'))
                ->where('company_types_id=company_types.id')
//               ->where('acl_users_has_companies.acl_users_id = '.$_SESSION["gpms"]["storage"]->id)
                ->from(array('company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
                ->where('companies_has_productions.companies_id= ' . $_SESSION["company"]["id"])
                ->where('companies_has_productions.productions_id=productions.id')
                ->where('productions.client_companies_id=companies.id')
                ->where('productions.client_companies_id='.$client_id)
               
                // ->where('in_litter = 0')
                ->where('productions.id=permission_production.productions_id')
                ->where('permission_production.acl_users_id=' . $_SESSION["gpms"]["storage"]->id)
                ->order('name')

        ;
        $data = $table->fetchAll($select)->toarray();
        //TODO la select deberias sustituir este codigo por un distinct en la select para no repetir resultados
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
        $select->from(array('ct' => 'company_types'), array('company_types_name' => 'name', 'id_company_types' => 'id'))
                ->where('ct.id = company_types_id')
                ->where('companies.id='.$id)
              //  ->where('in_litter = 0')
        ;
        $data = $table->fetchAll($select)->toarray();
      
//        Zend_Debug::dump($data);
//        die();
        return $data["0"];
  }
    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchSql() {
        $sql = "SELECT clients.id, clients.name, date,
                    email,status, roles.name as role
          FROM clients, roles
          WHERE clients.role_id = roles.id              
          ORDER BY roles.id";

        $table = $this->getTable()->getAdapter()->fetchAll($sql);
        //   Zend_Debug::dump($table,"Client");

        return $table;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchTypeClients($type_id) {

        $table = $this->getTable();
        $select = $table->select()->where('client_type_id =' . (int) $type_id);

        return $table->fetchAll($select)->toArray();
    }

    function elimina_duplicados($array, $campo) {
        foreach ($array as $sub) {
            $cmp[] = $sub[$campo];
        }
        $unique = array_unique($cmp);
        foreach ($unique as $k => $campo) {
            $resultado[] = $array[$k];
        }
        return $resultado;
    }

}

