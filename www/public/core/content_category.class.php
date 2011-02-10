<?php

class ContentCategory {
    var $pk_content_category  = NULL;
    var $fk_content_category  = NULL;   
    var $name  = NULL; //nombre carpeta
    var $title  = NULL; //titulo seccion
   

    function __construct($id=null) {
        // Si existe id, entonces cargamos los datos correspondientes
        if(is_numeric($id)) {
            $this->read($id);
        }
    }

    function create($data) {

        
        //if($data['subcategory']!=0){$sub="-".$data['subcategory'];}
         
         
        $sql = "INSERT INTO content_categories (`name`, `title`, `fk_content_category`) VALUES (?,?,?)";
        $values = array($data['name'], $data['title'], 0);
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return(false);
        }
        
        $this->pk_content_category = $GLOBALS['application']->conn->Insert_ID();
        
        return(true);
    }

    function read($id) {
        $this->pk_content_category = ($id);
        
        $sql = 'SELECT * FROM content_categories WHERE pk_content_category = '.$this->pk_content_category;
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
        
        $sql = "UPDATE content_categories SET `name`=?, `title`=?, `fk_content_category`=?  
                    WHERE pk_content_category=".($data['id']);
        
        $values = array($data['name'], $data['title'], 0 );
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }
        
       
    }

   

    function delete($id) {
        //Eliminar si está vacia.
        if(ContentCategoryManager::is_Empty($id)) {
            $sql = 'DELETE FROM content_categories WHERE pk_content_category='.($id);
            
            if($GLOBALS['application']->conn->Execute($sql)===false) {
                $error_msg = $GLOBALS['application']->conn->ErrorMsg();
                $GLOBALS['application']->logger->debug('Error: '.$error_msg);
                $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
                return("BD");
            }
            
        }
    }
 
    
}

