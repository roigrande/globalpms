<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'bootstrap.php';


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
$tpl->assign('datos', $rs);
$tpl->assign('probando', 'Gesti&oacute;n de Clientes');
$tpl->display('index.tpl');
?>
