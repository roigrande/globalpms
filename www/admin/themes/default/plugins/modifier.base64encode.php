<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty base64_encode modifier plugin
 *
 * Type:     modifier<br>
 * Name:     base64_encode<br>
 * Purpose:  base64_encode
 * @author   Tomás Vilariño <vifito at gmail dot com>
 * @param string
 * @return string
 */
function smarty_modifier_base64encode($string)
{
    return base64_encode($string);
}

?>