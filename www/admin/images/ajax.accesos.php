<?php
require('../../libs/utils.functions.php');
import_libs('*');

// Controlar el role admin
session_admin();

$mes = (isset($_GET['mes']) && ($_GET['mes'] < 13) && ($_GET['mes'] > 0))? $_GET['mes']: date("n");
$mes_actual = date("n");
$anho = ($mes > $mes_actual) ? (date("Y")-1): date("Y");
$mes_nombre = array('',
					'Enero', 'Febrero', 'Marzo',
					'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre',
					'Octubre', 'Noviembre', 'Diciembre');
$fechas = array();

require_once('../../libs/Calendar/Month/Weekdays.php');
$Month = new Calendar_Month($anho, $mes);
$Month->build();
while ($Day = $Month->fetch()) {
    $fechas[$Day->thisDay()] = 0;
}

require_once('../../libs/log.class.php');
$cfg = new hebblog();
$lineas = $cfg->parsear_csv_log('access_log.csv');

foreach ($lineas as $v) {
	$partes = explode('/',$v[0]);
	$anos   = explode(' ',$partes[2]);
	if(($partes[1] == $mes)&&($anos[0] == $anho)) {
		$fechas[(int)$partes[0]] += 1;
	}
}

$ydata = array_values($fechas);

$dataSet = array();
$xTicks  = array();
$max = 0;
foreach($ydata as $k => $v) {
	$dataSet[] = '['.$k.','.$v.']';
	if($k % 2 == 0) {
		$xTicks[] = '{v: '.$k.', label: "'.($k+1).'"}';
	} else {
		$xTicks[] = '{v: '.$k.', label: ""}';
	}
	$max = max($max, $v);
}
$x_json = '{xDataSet: ['.implode(',', $dataSet).'], xTicks: ['.implode(',', $xTicks).'], maxTick: '.$max.'}';
header('X-JSON: '.$x_json);
echo('<table border="0" width="80%" cellspacing="0" style="font-size:10px;">'.
	 '<caption>Mes: <strong>'.$mes_nombre[$mes].'</caption>' );
echo('<tr><th align="center">DIA</th><th align="center">VISITAS</th></tr>');
$i = 0;
foreach($fechas as $dia => $cantidad) {
	if($i % 2 == 0 ) {
		echo('<tr bgcolor="#EEEEEE"><td align="center">'.$dia.'</td><td align="center">'.$cantidad.'</td></tr>');
	} else {
		echo('<tr bgcolor="#FFFFFF"><td align="center">'.$dia.'</td><td align="center">'.$cantidad.'</td></tr>');
	}
	$i++;
}
echo('</table>' .
	 '<br /><span style="font-size: 10px;">Para ver los resultados en una gr&aacute;fica emplee Mozilla Firefox. '.
	 '<a href="http://www.mozilla-europe.org/es/products/firefox/" target="_blank" title="Descargar Firefox">'.
	 'Descargar aqu&iacute;.</a></span>');
?>