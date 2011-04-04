<?php

$modelPath=$_SERVER['DOCUMENT_ROOT'].'/../application/models';

$database_dev=array(
				'server'=>'localhost',
				'user'=>'root',
				'password'=>'hola',
				'db'=>'proyecto3'				
);

$database_prod=array(
				'server'=>'83.25.234.1',
				'user'=>'algunuser',
				'password'=>'algunpass',
				'db'=>'proyecto3'				
);

$privateFirmKey='8j3hfdy57sdusjnrh4614djt859dfnh32';

$database=$database_dev;

function __autoload($class)
{
	$modelPath=$_SERVER['DOCUMENT_ROOT'].'/../application/models';
	//echo ":".$class;
	$array=explode('_',$class);
	switch($array[0])
	{
		case 'Acl':
			$path=$modelPath;
		break;
		default:
			$path=$modelPath;
		break;
	}
	unset($array[0]);
	$path.='/'.implode('/',$array);
	$path.='.php';
	include $path;
}





