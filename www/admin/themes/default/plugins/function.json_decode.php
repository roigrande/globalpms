<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty json_decode function plugin
 *
 * Type:     function<br>
 * Name:     json_decode<br>
 * Purpose:  json_decode
 * @author   Tomás Vilariño <vifito at gmail dot com>
 * @param string
 * @return string
 */
function smarty_function_json_decode($params, &$smarty)
{
    $output = '';
    
    if(!isset($params['value'])) {
        $smarty->_trigger_fatal_error('[plugin] json_decode needs a "value" param');
        return;
    }
    
    $json  = $params['value'];    
    $assoc = (isset($params['assoc']))? $params['assoc']: false;
    
    $output = json_decode($json, $assoc);
    
    return $output;
}