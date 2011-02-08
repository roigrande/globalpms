<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'bootstrap.php';
//include_once 'login.php';

$_REQUEST['action']="list";



// example smarty and adobd
$tpl = new Template(TEMPLATE_PUBLIC);
$sql = 'SELECT * FROM workers WHERE pk_worker = 2';
        $rs = $GLOBALS['application']->conn->Execute( $sql );

        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;

            return;
        }
        echo $rs;

if (( $_REQUEST['action'] )=="lis"){
    $tpl->display('contact.tpl');

}else{
    $tpl->display('index.tpl');
}

?>
