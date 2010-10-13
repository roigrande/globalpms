<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty base64decode modifier plugin
 *
 * Type:     modifier<br>
 * Name:     base64decode<br>
 * Purpose:  base64decode
 * @author   Tomás Vilariño <vifito at gmail dot com>
 * @param string
 * @return string
 */
function smarty_modifier_base64decode($string)
{
    return base64_decode($string);
}

?>