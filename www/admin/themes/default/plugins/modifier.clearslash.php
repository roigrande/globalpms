<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty capitalize modifier plugin
 *
 * Type:     modifier<br>
 * Name:     clearslash<br>
 * Purpose:  clear slashs
 * @author   Tomás Vilariño <vifito at gmail dot com>
 * @param string
 * @return string
 */
function smarty_modifier_clearslash($string)
{
	$string = stripslashes($string);
	$string = str_replace("\\", '', $string);
    return stripslashes($string);
}

?>