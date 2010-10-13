<?php
class User_group {
	/**Id del grupo*/
    var $id = NULL;
    /**Nombre del grupo*/
    var $name = NULL;
    /**Lista de permisos activos para este grupo de usuarios*/
    var $privileges = NULL;

    function User_group($id=NULL) {
        if(!is_null($id)) {
            $this->read($id);
        }
    }

    function __construct($id=NULL){
        $this->User_group($id);
    }

    function create($data) {
    	//Se inserta el grupo
        $sql = "INSERT INTO user_groups (`name`)
                    VALUES (?)";
        $values = array($data['name']);
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return(false);
        }
        $this->id = $GLOBALS['application']->conn->Insert_ID();
        $this->name = $data['name'];
		//Se insertan los privilegios
		if((!is_null($data['privileges'])) && (count($data['privileges'] > 0))){
			return $this->insert_privileges($data['privileges']);
		}
        return(true);
    }

    function read($id) {
        $sql = 'SELECT * FROM user_groups WHERE pk_user_group = '.intval($id);
        $rs = $GLOBALS['application']->conn->Execute( $sql );
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return;
        }
        $this->set_values($rs->fields);
        //Se cargan los privileges asociados
        $sql = 'SELECT pk_fk_privilege FROM user_groups_privileges WHERE pk_fk_user_group = '.intval($id);
        $rs = $GLOBALS['application']->conn->Execute( $sql );
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }
         while(!$rs->EOF) {
        	$this->privileges[] = $rs->fields['pk_fk_privilege'];
          	$rs->MoveNext();
        }
    }

    function update($data) {
    	if(!is_null($data['id'])){
    		$this->id = $data['id'];
    		//print('Antes de update:' . $this->id . ';'.$data['id']);
        	$sql = "UPDATE user_groups SET `name`=?
                    WHERE pk_user_group=".intval($data['id']);
        	$values = array($data['name']);

	        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
	            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
	            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
	            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
	            return;
	        }
	        //Se actualizan los privileges
	        $this->delete_privileges($data['id']);
	        if((!is_null($data['privileges'])) && (count($data['privileges'] > 0))){
	        	//print 'Insertamos los privilegios';
				return $this->insert_privileges($data['privileges']);
			}
    	}
    	return(false);
    }

    function delete($id) {
        $sql = 'DELETE FROM user_groups WHERE pk_user_group='.intval($id);

        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }
        //Se eliminan las referencias de los privileges
        $this->delete_privileges($id);
    }
    
    public static function getGroupName($fk_user_group) {
        $sql = 'SELECT name FROM user_groups WHERE pk_user_group=?';
        $rs  = $GLOBALS['application']->conn->GetOne($sql, $fk_user_group);        
        
        return( $rs );
    }

    function get_user_groups(){

        $types = array();
        $sql = 'SELECT pk_user_group, name FROM user_groups';
        $rs = $GLOBALS['application']->conn->Execute($sql);
        while(!$rs->EOF) {
        	$user_group = new User_Group();
        	$user_group->set_values($rs->fields);
        	$types[] = $user_group;
          	$rs->MoveNext();
        }
        return( $types );
    }

    function contains_privilege($id_privilege){
		if(isset($this->privileges)){
    	return in_array(intval($id_privilege), $this->privileges);
		}
    	return false;
    }

    //Funciones privadas
    private function insert_privileges($data){
		$sql = "INSERT INTO user_groups_privileges (`pk_fk_user_group`, `pk_fk_privilege`)
                    VALUES (?,?)";
        for($i=0;$i<count($data);$i++){
        	$values = array($this->id, $data[$i]);
        	if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            	$error_msg = $GLOBALS['application']->conn->ErrorMsg();
            	$GLOBALS['application']->logger->debug('Error: '.$error_msg);
            	$GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            	return(false);
        	}
        }
        return(true);
    }

     private function delete_privileges($id) {
        $sql = 'DELETE FROM user_groups_privileges WHERE pk_fk_user_group='.intval($id);
        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return;
        }
    }

    private function set_values($data){
    	$this->id		= $data['pk_user_group'];
        $this->name	= $data['name'];
    }
}
