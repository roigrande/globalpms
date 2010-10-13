<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File: resource.string.php
 * Type: resource
 * Name: string
 * Purpose: fetches template from a string
 * Version: 1.0 [Sep 28, 2002 boots since Sep 28, 2002 boots]
 * -------------------------------------------------------------
 */

function smarty_resource_string_source($tpl_name, &$tpl_source, &$smarty)
{
    $tpl_source = $tpl_name;
    
    return true;
}

function smarty_resource_string_timestamp($tpl_name, &$tpl_timestamp, &$smarty)
{
    $tpl_timestamp = '';
    return true;
}

function smarty_resource_string_secure($tpl_name, &$smarty)
{
    return true;
}

function smarty_resource_string_trusted($tpl_name, &$smarty)
{
    return;
}
