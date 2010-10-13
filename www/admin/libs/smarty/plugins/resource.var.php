<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File: resource.var.php
 * Type: resource
 * Name: var
 * Purpose: fetches template from a global variable
 * Version: 1.0 [Sep 28, 2002 boots since Sep 28, 2002 boots]
 * -------------------------------------------------------------
 */

function smarty_resource_var_source($tpl_name, &$tpl_source, &$smarty)
{
    global $$tpl_name;
    $tpl_source = $$tpl_name;
    
    return true;
}

function smarty_resource_var_timestamp($tpl_name, &$tpl_timestamp, &$smarty)
{
    $tpl_timestamp = '';
    return true;
}

function smarty_resource_var_secure($tpl_name, &$smarty)
{
    return true;
}

function smarty_resource_var_trusted($tpl_name, &$smarty)
{
    return;
}
