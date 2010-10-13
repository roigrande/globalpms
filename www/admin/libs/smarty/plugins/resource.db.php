<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File: resource.db.php
 * Type: resource
 * Name: db
 * Purpose: Smarty integration database
 * Version: 1.0 
 * Syntax: $tpl->display('db:table[smarty_get_db_templatedb_field_key=resource_name]/db_field_tpl_source');
 * -------------------------------------------------------------
 */

function smarty_get_db_template ($tpl_name, &$tpl_source, &$smarty_obj) {
	//Syntax: $tpl->display('db:table[smarty_get_db_templatedb_field_key=resource_name]/db_field_tpl_source');
	$pattern = '/(.*?)\[(.*?)=(.*?)\]\/(.*?)$/';
	$matches = array();
	preg_match($pattern, $tpl_name, $matches);

	if(count($matches)!= 5) {
		return(false);
	}

	$table  = $matches[1];
	$field  = $matches[2];
	$key    = $matches[3];
	$source = $matches[4];

    $sql = 'SELECT '.$source.' FROM '.$table.' WHERE '.$field.'="'.$key.'"';
    $rs = $GLOBALS['application']->conn->Execute($sql);
    if (!$rs->EOF) {
        $tpl_source = $rs->fields[$source];
        return true;
    } else {
        return false;
    }
}

function smarty_get_db_timestamp($tpl_name, &$tpl_timestamp, &$smarty_obj) {
	$pattern = '|(.*?)\[(.*?)=(.*?)\]|i';
	$matches = array();
	preg_match($pattern, $tpl_name, $matches);

	if(count($matches)!= 4) {
		return(false);
	}

	$table = $matches[1];
	$field = $matches[2];
	$key = $matches[3];
	$timestamp = 'tpl_timestamp';

	$sql = 'SELECT '.$timestamp.' FROM '.$table.' WHERE '.$field.'="'.$key.'"';

    $rs = $GLOBALS['application']->conn->Execute($sql);
    if (!$rs->EOF) {
    	$tpl_timestamp = $rs->fields[ $timestamp ];

    	if(preg_match('/\:/', $tpl_timestamp)) {
    		$_d = strptime($tpl_timestamp, "%Y-%m-%d %H:%M:%S");
    		$tpl_timestamp = mktime( $_d['tm_hour'], $_d['tm_min'], $_d['tm_sec'],
    			$_d['tm_mon'], $_d['tm_mday'],  $_d['tm_year']);
    	}

        return true;
    } else {
        return false;
    }
}

function smarty_get_db_secure($tpl_name, &$smarty_obj) {
    return true;
}

function smarty_get_db_trusted($tpl_name, &$smarty_obj) {
    // empty
}
