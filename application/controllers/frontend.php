<?php
if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='home';

switch($action)
{
	case 'home':
	default:
		include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/frontend/home.php');
	break;
}