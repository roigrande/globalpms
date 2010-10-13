<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File: resource.widget.php
 * Type: resource
 * Name: widget
 * Purpose: fetches template from a static member array of Template class
 * Version: 1.0 [Sep 28, 2002 boots since Sep 28, 2002 boots]
 * -------------------------------------------------------------
 */

function smarty_resource_widget_source($tpl_name, &$tpl_source, &$smarty)
{
    if(isset(Template::$registry['widget']) && isset(Template::$registry['widget'][$tpl_name])) {
        $tpl_source = Template::$registry['widget'][$tpl_name];
        return true;
    }
    
    $tpl_source = '';
    return false;    
}

function smarty_resource_widget_timestamp($tpl_name, &$tpl_timestamp, &$smarty)
{
    $tpl_timestamp = '';
    return true;
}

function smarty_resource_widget_secure($tpl_name, &$smarty)
{
    return true;
}

function smarty_resource_widget_trusted($tpl_name, &$smarty)
{
    return;
}
