<?php

/**
 * This is the Data Mapper class for the Acl_activitys table.
 */
class Production_Model_Activity {

    /** Model_Resource_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Roles_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Production_Model_DbTable_Activity();
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

        if ($data["contact_client_company_id"] == null) {
            unset($data["contact_client_company_id"]);
        }
        if ($data["contact_own_company_id"] == null) {
            unset($data["contact_own_company_id"]);
        }
//         Zend_Debug::dump($data);
//         die();
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
//         Zend_Debug::dump($data);
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

        $table->update($data, $where);
        //change the name of the activy in Session
        if ($_SESSION["production"]["activity_name"] != $data["name"]) {
            $_SESSION["production"]["activity_name"] = $data["name"];
        }
        return true;
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

    public function fetchActivityName($id) {
        $table = $this->getTable();
        $select = $table->select()->where('id = ?', $id);
        $data = $table->fetchRow($select)->toArray();
        return $data["name"];
    }

    public function fetchEntryActivity() {

        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('s' => 'status'), array('status' => 'name'))
                ->from(array('oc' => 'contacts'), array('contact_own_company_name' => 'name'))
                ->from(array('cc' => 'contacts'), array('contact_client_company_name' => 'name'))
                ->from(array('at' => 'activity_types'), array('activity_type_name' => 'name'))
                ->from(array('permission_production'), array('id_permission_production' => 'id'))
                ->where('status_id = s.id')
                ->where('oc.company_id =' . $_SESSION["production"]["own_company"])
                ->where('oc.id=contact_own_company_id')
//                ->where('cc.company_id=' . $_SESSION["production"]["client_company"])
//                ->where('cc.id=contact_client_company_id')
                ->where('activity_types_id = at.id')
                ->where("activities.id=" . $_SESSION["production"]["activity_id"])
                ->where('permission_production.productions_id = activities.productions_id')
                ->where('permission_production.acl_users_id =' . $_SESSION["gpms"]["storage"]->id)
        ;

        $data = $table->fetchAll($select)->toarray();
//         Zend_Debug::dump($data);
//        die();
        return $data[0];
    }

    /**
     * Devuelve la diferencia entre 2 fechas según los parámetros ingresados
     * @author Gerber Pacheco
     * @param string $fecha_principal Fecha Principal o Mayor
     * @param string $fecha_secundaria Fecha Secundaria o Menor
     * @param string $obtener Tipo de resultado a obtener, puede ser SEGUNDOS, MINUTOS, HORAS, DIAS, SEMANAS
     * @param boolean $redondear TRUE retorna el valor entero, FALSE retorna con decimales
     * @return int Diferencia entre fechas
     */
    function diferenciaEntreFechas($fecha_principal, $fecha_secundaria, $obtener = 'SEGUNDOS', $redondear = false) {
        $f0 = strtotime($fecha_principal);
        $f1 = strtotime($fecha_secundaria);
        if ($f0 < $f1) {
            $tmp = $f1;
            $f1 = $f0;
            $f0 = $tmp;
        }
        $resultado = ($f0 - $f1);
        echo $f1;
        echo $f0;
        echo $resultado;
//        die();
        switch ($obtener) {
            default: break;
            case "MINUTOS" : $resultado = $resultado / 60;
                break;
            case "HORAS" : $resultado = $resultado / 60 / 60;
                break;
            case "DIAS" : $resultado = $resultado / 60 / 60 / 24;
                break;
            case "SEMANAS" : $resultado = $resultado / 60 / 60 / 24 / 7;
                break;
        }
        if ($redondear)
            $resultado = round($resultado);
        return $resultado;
    }

    public function hours_activity($resources_activities_id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->join(array("ra" => 'resources_activities'), 'activities.id=ra.activities_id and ra.id=' . $resources_activities_id, array('receipts_id' => 'ra.id','unbilled_hours'));
        $data = $table->fetchAll($select)->toarray();
         
        $date_start = DateTime::createFromFormat('Y-m-d H:i:s',$data[0]["date_start"]);
        $date_end = DateTime::createFromFormat('Y-m-d H:i:s',$data[0]["date_end"]);
        $intervalo = date_diff($date_start, $date_end);
        $hours = (int)$intervalo->format('%h')-(int)$data[0]["unbilled_hours"];
  
        return $hours;
    }

    public function fetchHaveContactClient($contact_id) {

        $table = $this->getTable();
        $select = $table->select()->where('contact_client_company_id = ?', $contact_id);
        $row = $table->fetchRow($select);
        return $row;
    }

    public function fetchHaveContactCompany($contact_id) {

        $table = $this->getTable();
        $select = $table->select()->where('contact_own_company_id = ?', $contact_id);
        $row = $table->fetchRow($select);
//          Zend_Debug::dump($row);
//        die();
        return $row;
    }

    public function fetchHaveActivities($production_id) {

        $table = $this->getTable();
        $select = $table->select()->where('productions_id = ?', $production_id);

        return $table->fetchRow($select);
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchActivities() {

        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('s' => 'status'), array('status' => 'name'))
                ->from(array('oc' => 'contacts'), array('contact_own_company_name' => 'name'))
                ->from(array('cc' => 'contacts'), array('contact_client_company_name' => 'name'))
                ->from(array('pt' => 'activity_types'), array('activity_type_name' => 'name'))
                ->where('status_id = s.id')
                //->where('oc.company_id =' . $_SESSION["production"]["own_company"])
                ->where('oc.id=contact_own_company_id ')
                //    ->where('cc.company_id=' . $_SESSION["production"]["client_company"])
                ->where('cc.id=contact_client_company_id ')
                ->where('activity_types_id = pt.id')
                ->where('activities.productions_id = ' . $_SESSION["production"]["id"])
                ->order('date_start')
                ->order('status_id')


        ;

        $data = $table->fetchAll($select)->toarray();
//         Zend_Debug::dump($data);
//        die("");
        return $data;
    }

    /**
     *  Fetch all sql entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchOwnActivities() {



        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('s' => 'status'), array('status' => 'name'))
                ->from(array('oc' => 'contacts'), array('contact_own_company_name' => 'name'))
                ->from(array('cc' => 'contacts'), array('contact_client_company_name' => 'name'))
                ->from(array('pt' => 'activity_types'), array('activity_type_name' => 'name'))
                // ->from(array('permission_production'), array('id_permission_production' =>'id'))
                ->where('status_id = s.id')
                ->where('oc.company_id =' . $_SESSION["company"]["id"])
                ->where('oc.acl_users_id=' . $_SESSION["gpms"]["storage"]->id)
                ->where('oc.id=contact_own_company_id')
                ->where('cc.company_id=' . $_SESSION["production"]["client_company"])
                ->where('cc.id=contact_client_company_id')
                ->where('activity_types_id = pt.id')
                ->order('date_start')
                ->order('status_id')
        ;

        $data = $table->fetchAll($select)->toarray();
//         Zend_Debug::dump($data);
//        die();
        return $data;
    }

    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchUsersActivity($array_id_users) {
        $model = new User_Model_Users;

        foreach ($array_id_users as $key => $value) {
            $array_user[$key] = $model->fetchEntry($array_id_users[$key]);
        }


        return $array_user;
    }

    public function IsUserInActivity($id) {
        $table = $this->getTable();
        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $select->from(array('oc' => 'contacts'), array('contact_own_company_name' => 'name'))
                ->where('oc.acl_users_id=' . $_SESSION["gpms"]["storage"]->id)
                ->where('oc.id=contact_own_company_id')
                ->where('activities.id=' . $id)
        ;

        $data = $table->fetchAll($select)->toarray();
//        Zend_Debug::dump($data);
//        die();
        return $data;
    }

}

