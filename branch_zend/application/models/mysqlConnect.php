<?php

function connectDB($database)
{
	$conexion=mysql_connect($database['server'],$database['user'],$database["password"])
		or die ('no se puede conectar a la base de datos');
	return $conexion;
}
function selectDB($database)
{
	mysql_select_db($database['db'])
		or die ('no se puede seleccionar la base de datos');
}
function queryDB($sql,$cnx)
{
	$consulta = mysql_query($sql,$cnx) 
		or die("error en la consulta <br/><br/>".$sql." = <br/><br/>".mysql_error().' - '.mysql_errno());
	return $consulta;
}
/**
 * convierte el resultado de un query en array
 * @param resultado de query
 * @return array asoc con el resultado
 */
function fetchResult($data)
{
	$result=array();
	while($f=mysql_fetch_assoc($data))
	{
//		print_r($f);
		$result[]=$f;
	}
	return $result;
}

function fetchOneResult($data)
{
	$result=array();
	$result=mysql_fetch_assoc($data);
	return $result;
}


function numRows($recordset)
{
	return mysql_num_rows($recordset);
}

function closeDB($cnx)
{
	mysql_close($cnx);
	return;
}

?>
