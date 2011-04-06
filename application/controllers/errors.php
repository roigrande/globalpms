<?php
if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='noerror';

switch($action)
{
	case 'bloqueadaip':
		include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/errors/bloqueadaip.php');
	break;
	case 'ipestabloqueada':
		include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/errors/ipestabloqueada.php');
	break;		
	case 'noerror':	
	default:
				
	break;
}