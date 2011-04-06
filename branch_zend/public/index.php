<?php
require $_SERVER['DOCUMENT_ROOT'].'/../application/configs/settings.php';

//require ('Zend/Config/Ini.php');
//$config= new Zend_Config_Ini(
//			$_SERVER['DOCUMENT_ROOT'].'/../application/configs/settings.ini',
//			'production');
//echo "<pre>";
//print_r($config->database->server);
//echo "<pre>";


if(isset($_GET['controller']))
{
	$controller=$_GET['controller'];	
}
else
{
	$controller='frontend';
	$_GET['action']='';
}
	
switch ($controller)
{
	case 'users':
		ob_start();			
			include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/controllers/users.php');
			$column3=ob_get_contents();
		ob_end_clean();
		include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/layouts/layout_admin.php');
	break;
	case 'errors':
		include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/controllers/errors.php');
	break;
	case 'frontend':
	default:
		ob_start();	
		include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/controllers/frontend.php');
		$column3=ob_get_contents();
		ob_end_clean();
		include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/layouts/layout.php');
	break;
}
/* Llamada al Layout */



