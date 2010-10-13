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
 * Name:     is_clone<br>
 * Purpose:  is_clone
 * @author   Tomás Vilariño <vifito at openhost dot es>
 * @param string
 * @return string
 */
function smarty_function_is_clone($params, &$smarty)
{
    if(!isset($params['item'])) {
        $smarty->_trigger_fatal_error('[plugin] is_clone needs a "item" param');
        return;
    }
    
    $item  = $params['item'];
    
    if($item->isClone()) {
        return '<img src="' . $smarty->_tpl_vars['params']['IMAGE_DIR'] . 'sheep.gif" border="0" align="absmiddle" ' .
               'title="Artículo clon" alt="Artículo clon"/>';
    }
    
    return '';
}