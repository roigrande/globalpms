<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_month_spanish($month)
{
    if ($month==1) $m="Enero";
    elseif ($month==2) $m="Febrero";
    elseif ($month==3) $m="Marzo";
    elseif ($month==4) $m="Abril";
    elseif ($month==5) $m="Mayo";
    elseif ($month==6) $m="Junio";
    elseif ($month==7) $m="Julio";
    elseif ($month==8) $m="Agosto";
    elseif ($month==9) $m="Septiembre";
    elseif ($month==10) $m="Octubre";
    elseif ($month==11) $m="Noviembre";
    elseif ($month==12) $m="Diciembre";

    return $m;
}

/* vim: set expandtab: */

?>
