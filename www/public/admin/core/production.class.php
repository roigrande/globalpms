<?php

class Production {

        
    var $pk_production  = NULL; //code of the production
    var $name  = NULL;  //name of the production
    var $direction  = NULL; //place of the production
    var $date_start  = NULL; //date start of the production
    var $date_end  = NULL; //date end of the production
    var $observation  = NULL; //observation about the production
    var $budget  = NULL; //budget of the production


    function Production($id=null) {
        // Si existe id, entonces cargamos los datos correspondientes
        if(is_numeric($id)) {
            $this->read($id);
        }
    }

    function __construct($id=null) {
        $this->Production($id);
    }

    function create($data) {



        $sql = "INSERT INTO production (`name`, `direction`, `date_start`, `date_end`, `observation`, `budget`) VALUES (?,?,?,?,?,?,?)";
        $values = array($data['name'], $data['direction'], $data['date_start'], $data['date_end'], $data['observation'], $data['budget']);

        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
          $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return(false);
        }

        $this->pk_production = $GLOBALS['application']->conn->Insert_ID();

        return(true);
    }

    function read($id) {
        $this->pk_production = ($id);

        $sql = 'SELECT * FROM production WHERE pk_production = '.$this->pk_production;
        $rs = $GLOBALS['application']->conn->Execute( $sql );

        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }

        $this->load($rs->fields);
    }

    /**
     * Load database fields in object
     *
     * @param object/array properties, database fields
     * @todo Load database fields in object
     */

    function load($properties) {
        if(is_array($properties)) {
            foreach($properties as $k => $v) {
                if( !is_numeric($k) ) {
                    $this->{$k} = $v;
                }
            }
        } elseif(is_object($properties)) {
            $properties = get_object_vars($properties);
            foreach($properties as $k => $v) {
                if( !is_numeric($k) ) {
                    $this->{$k} = $v;
                }
            }
        }
    }

    function update($data) {
        $sql = "UPDATE content_categories SET `name`=?, `direction`=?, `date_start`=?, `date_end`=?, `observation`=? , `budget`=?
                    WHERE pk_production=".($data['id']);

        $values = array($data['name'], $data['direction'], $data['date_start'], $data['date_end'], $data['observation'], $data['budget']);

        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }


    }



    function delete($id) {
        //Eliminar si está vacia.
     //   if(ContentCategoryManager::is_Empty($id)) {
     //       $sql = 'DELETE FROM content_categories WHERE pk_content_category='.($id);

            if($GLOBALS['application']->conn->Execute($sql)===false) {
                $error_msg = $GLOBALS['application']->conn->ErrorMsg();
                $GLOBALS['application']->logger->debug('Error: '.$error_msg);
                $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
                return("BD");
            }

        }



}
