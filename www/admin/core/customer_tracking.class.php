<?php
class CustomerTracking {
    var $pk_fk_customer  = NULL;
    var $pk_fk_tracking  = NULL;
    var $text  = NULL;
	
    // FIXME: remove PHP4 constructor
    function CustomerTracking($id=NULL) {
        if(!is_null($id)) {
            $this->read($id);
        }
    }
   
    /**
      * Constructor PHP5
    */  
    function __construct($id=NULL){    	
        $this->CustomerTracking($id);
        
        $this->cache = new MethodCacheManager($this, array('ttl' => 30));
    }

    function create($pk_customer,$pk_tracking,$infor) {
        $date=date('Y-m-d H:i:s');
        $sql = "INSERT INTO customers_trackings (`pk_fk_customer`, `pk_fk_tracking`, `info`,`date`) " .
            " VALUES (?,?,?,?)";
            
 	$values = array($pk_customer, $pk_tracking, $infor, $date); //positions=1       
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return(false);
        }
		
        return(true);
    }
    
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

    function read($id) {
        $sql = 'SELECT * FROM customers_trackings WHERE pk_fk_customer = '.($id);
        $rs = $GLOBALS['application']->conn->Execute( $sql );
        
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return;
        }
        
        $this->load( $rs->fields );

        // Return instance to method chaining
        return $this;
       
    }

    function update($data) {     
        $sql = "UPDATE customers_trackings SET `pk_fk_tracking`=?, `date`=?, `info`=? " .
        		"WHERE pk_fk_customer=".($data['id']);

        $values = array($data['pk_fk_tracking'], $data['date'],  $data['info']);
  
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }
    }

    function delete($id) {
        $sql = 'DELETE FROM customers_trackings WHERE id='.($id);

        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return;
        }
    }

    function delete_all($id) {
        $sql = 'DELETE FROM customers_trackings WHERE pk_fk_customer='.($id).' OR pk_fk_tracking='.($id);

        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return;
        }
    }

  
    function get_trackings($id_content){
        $related = array();
        
        if($id_content) {
	    	$sql = 'select id, pk_fk_tracking, date, info, name from customers_trackings, contents
                    where   pk_fk_customer = ' .($id_content).' AND pk_content = pk_fk_tracking ORDER BY date DESC';

	        $rs  = $GLOBALS['application']->conn->Execute($sql);
            if($rs === false) {
                return( array() );
            } else {
                $i=0;
                while(!$rs->EOF) {
                    $related[$i]->id = $rs->fields['id'];
                    $related[$i]->pk_fk_tracking = $rs->fields['pk_fk_tracking'];
                    $related[$i]->name = $rs->fields['name'];
                    $related[$i]->date = $rs->fields['date'];
                    $related[$i]->info = $rs->fields['info'];
                    $rs->MoveNext();
                    $i++;
                }
            }

        }
 
        return $related;        
    }
    
    function get_tracks($id_content){
         $related = array();
         if($id_content){
                $sql = 'select pk_fk_tracking, name  from customers_trackings, contents
                    where in_litter = 0 AND pk_fk_customer = ' .($id_content).' AND pk_content = pk_fk_tracking ORDER BY pk_fk_tracking DESC';

                $rs = $GLOBALS['application']->conn->Execute($sql);
                if($rs !== false) {
                        while(!$rs->EOF) {
                            $id = $rs->fields['pk_fk_tracking'];
                            $related[$id] = $rs->fields['name'];
                            $rs->MoveNext();
                        }
                }
         }

         return $related;

    }

     function get_customers($id_content,$where="1=1"){
         $related = array();
         if($id_content){
                $sql = 'select pk_fk_customer, name, date  from customers_trackings, contents
                    where in_litter = 0 AND pk_fk_tracking = ' .($id_content).
                    ' AND pk_content = pk_fk_customer AND '.$where.
                    ' ORDER BY pk_fk_customer DESC';
       
                $rs = $GLOBALS['application']->conn->Execute($sql);
                if($rs !== false) {
                        while(!$rs->EOF) {
                            $id = $rs->fields['pk_fk_customer'];
                            $related[$id] = $rs->fields['name'];
                            $rs->MoveNext();
                        }
                }
         }

         return $related;

    }
    

    //Define relacion entre noticias y entre publi y noticias
    function set_relations($id,$relationes){
          $relations->delete($id);
          if($relationes){
                   foreach($relationes as $related) {
                                $relations = new Related_content();
                                $relations->create($id,$related);
                        }
                        return;
           }
    }

    public function saveRelated($customstracks, $id)
    {    
        //Articulos relacionados en portada
        if(isset($customstracks)) {
             foreach($customstracks as $customtrack) {
                 $customtrack = new Related_content();
                 $customtrack->create($id,$t->pk_tracking,$t->infor);
            
             }
        }
    }

     function get_last_trackings() {
       
        $sql = 'SELECT `contents`.`pk_content` AS custom, `trackings`.`name` AS track,
                    `trackings`.`pk_tracking` AS pk_tracking, 
                    `customers_trackings`.`date` AS date, `customers_trackings`.`info` AS info
                   FROM `contents`, `customers_trackings`, `trackings`
                   WHERE `contents`.`pk_content`=`customers_trackings`.`pk_fk_customer`
                    AND `in_litter`=0 AND `trackings`.`pk_tracking`=`customers_trackings`.`pk_fk_tracking`'.
                '  ORDER BY `customers_trackings`.`date` ASC ';

        $rs = $GLOBALS['application']->conn->Execute( $sql );

        $last = array();
 
        if($rs!==false) {
            while(!$rs->EOF) {
                $last[ $rs->fields['custom'] ]['track'] = $rs->fields['track'];
                $last[ $rs->fields['custom'] ]['date'] = $rs->fields['date'];
                $last[ $rs->fields['custom'] ]['info'] = $rs->fields['info'];
                $last[ $rs->fields['custom'] ]['pk_tracking'] = $rs->fields['pk_tracking'];
                $rs->MoveNext();
            }
        }

        return $last;
    }

 
}
