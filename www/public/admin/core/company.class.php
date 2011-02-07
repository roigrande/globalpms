<?php
class Company
{
    var $pkCompany;
    var $name;
    var $companyName;
    var $companyNameFiscal;
    var $cif;
    var $address;
    var $state;
    var $postalCode;
    var $telf1;
    var $telf2;
    var $email1;
    var $email2;
    var $id;

    /**
     * _Construct Company
     *
     * @param int $pkCompany Id
     * @return object Company
    */
    function __construct($pkCompany=null)
    {
        if (!is_null($pkCompany)) {
            $this->read($pkCompany);
        }
    }

    /**
     * Create Company
     *
     * @param array $data
     * @return $company
    */
    function create($data)
    {
        $sql = "INSERT INTO companies (`name`, `company_name`, `company_name_fiscal`,
                                       `cif`, `state`, `postal_code`,`telf1`,
                                       `telf2`, `email1`, `email2`,`address`)".
               "VALUES (?,?,?, ?,?,?,?, ?,?,?);";
        echo $sql;
        $values = array($data['name'], $data['companyName'], $data['companyNameFiscal'],
                        $data['cif'], $data['state'], $data['postalCode'], $data['telf1'],
                        $data['telf2'], $data['email1'], $data['email2'], $data['address']);

         if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return false;
        }
        $this->pkCompany=$GLOBALS['application']->con->Insert_Id();
         // Special properties
         $this->id = $this->pkCompany;

        return true;
    }

    // FIXME: check funcionality
    function load($properties)
    {
        if (is_array($properties)) {
            foreach ($properties as $k => $v) {
                if (!is_numeric($k)) {
                    $cc = String_Utils::to_camel_case($k);
                    $this->{$cc} = $v;
                }
            }
        } elseif (is_object($properties)) {
            $properties = get_object_vars($properties);
            foreach ($properties as $k => $v) {
                if (!is_numeric($k)) {
                    $cc = String_Utils::to_camel_case($k);
                    $this->{$cc} = $v;
                }
            }
          }
     }

    /**
     * Read Company
     *
     * @param int $id
     * @return $Company
    */
    function read($id)
    {
        $sql = 'SELECT * FROM companies WHERE pk_company ='.$id.' ';
        $rs = $GLOBALS['application']->conn->Execute($sql);
        if (!$rs) {

            $error_msg=$GLOBALS['application']->con->ErrorMsg;
            $GLOBALS['application']->con->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->con->errors[] = 'Error: ' .$error_msg;
            return false;
        }

        $this->load( $rs->fields );
        return $this;
    }
    /**
     * Update Company
     *
     * @param array $data 
     * @return $company
    */
    function update($data)
    {
           
        $sql = "UPDATE companies SET $name=?, $company_name=?, $company_name_fiscal=?,
                                     $cif=?, $state=?, $postal_code=?, $telf1=?,
                                     $tel2=?, $email1=?, $email2=?, $address=?;
                where pk_company=".$data[id];
        
        $values = array($data['name'], $data['companyName'],$data['companyNameFiscal'], 
                        $data['cif'], $data['state'], $data['postalCode'], $data['telf1'],
                        $data['telf2'], $data['email1'], $data['email2'], $data['address']);
                
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return null;
        }
        
        return $this;
    }   

        /**
     * Delete company
     *
     * @param int $pkCompany Id
     * @return bool
    */
    function delete($id)
    {

        $sql = 'DELETE FROM companies WHERE pk_company ='.($id);
        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return false;

             }
	return true;
    }

}

?>
