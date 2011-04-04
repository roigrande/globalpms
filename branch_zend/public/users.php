<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/../application/configs/settings.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/../application/models/users/usersDb.php');

echo "<pre>Post:";
print_r($_POST);
echo "</pre>";

echo "<pre>Get:";
print_r($_GET);
echo "</pre>";

echo "<pre>Files:";
print_r($_FILES);
echo "</pre>";


echo "<pre>Session:";
print_r($_SESSION);
echo "</pre>";

if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';

$data=array(
	'name'=>'',
	'email'=>'',
	'phone'=>'',
	'address'=>'',
	'postalcode'=>'15000',
	'city'=>'',
	'description'=>'',
	'gender'=>'',
	'provinces_id'=>'3',
	'likes'=>array(),
	'languages'=>array()
	);

//$data=NULL;
switch($action)
{
	case 'login':
		if($_POST)
		{
			session_start();			
			if(/*No esta en DB*/)
				$_SESSION['intentoIp']++;
			else
				header('Location: /users.php');
				
			echo "<pre>Session Login:";
			print_r($_SESSION);			
			echo "</pre>";
			
			if($_SESSION['intentoIp']>=5)
			{
				/*bloquearIp*/
				//TODO: bloquear ir
				header('Location: /error.php?action=bloqueadaip');
			}			
			echo "entrando al post del login";
			die;				
		}
		else
		{		
			if(/*Ip en lista negra*/)
				header('Location: /error.php?action=ipestabloqueada');
			else
				include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/users/login.php');
		}
		
		// El formulario
	break;
	case 'logout':
		
	break;
	case 'update':
		if($_POST)
		{
			updateUser($_POST, $_FILES,$privateFirmKey, $database);				
			header('Location: /users.php');	
			break;
		}
		$data=getUser($_GET['id'],$database);
	case 'insert':
		if($_POST)
		{
			insertUser($_POST, $_FILES, $privateFirmKey, $database);				
			header('Location: /users.php');	
		}
		else		
			include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/users/insert.php');
		
		// El formulario
		
	break;
	case 'delete':
		if($_POST)
		{
			if(isset($_POST['delete']))
				deleteUser($_POST['id'], $database);
			header('Location: /users.php');	
		}
		else
		{
			$data=getUser($_GET['id'],$database);
			include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/users/delete.php');
		}
		// El formulario
		
		echo "Estoy en delete";
	break;
	case 'select':	
	default:
		$data=getUsers($database);		
		include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/users/select.php');		
	break;
}