<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_kiosko_date_format($date)
{
    $format_date = new DateTime($date);
    $day_week = $format_date->format('N');
    $month = $format_date->format('m');

    if ($day_week==1) $d="Domingo";
    elseif ($day_week==2) $d="Lunes";
    elseif ($day_week==3) $d="Martes";
    elseif ($day_week==4) $d="Miércoles";
    elseif ($day_week==5) $d="Jueves";
    elseif ($day_week==6) $d="Viernes";
    elseif ($day_week==7) $d="Sábado";

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

    return $d.', '.$format_date->format('d').' de '.$m;
}

/* vim: set expandtab: */

?>
