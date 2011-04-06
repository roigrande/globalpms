<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/../application/configs/settings.php');

//echo "<pre>Post:";
//print_r($_POST);
//echo "</pre>";
//
//echo "<pre>Get:";
//print_r($_GET);
//echo "</pre>";
//
//echo "<pre>Files:";
//print_r($_FILES);
//echo "</pre>";



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


session_start();
		if(!isset($_SESSION['email']))
			$action='login';
	
//$data=NULL;
switch($action)
{
	case 'login':
		if($_POST)
		{					
			/*No esta en DB*/
			$user = new Acl_Users_User($database);
			$array=$user->authUser($_POST['email'], sha1($_POST['password']));
		
			if($array===NULL)
			{				
				/* Login KO */
				$_SESSION['intentoIp']++;
			}
			else
			{
				/* Login OK */
				$_SESSION['email']=$array['email'];
				header('Location: /?controller=users&action=select');
				break;
			}				
			
			if($_SESSION['intentoIp']>=5)
			{
				/*bloquearIp*/
				$ip = new Acl_Ips_Ip($database, $_SERVER['REMOTE_ADDR']);
				if(!$ip->isBlockedIp())
					$ip->insertIp();
				header('Location: /?controller=errors&action=bloqueadaip');
			}							
			else
			{
				header('Location: /?controller=users&action=login');
			}	
		}
		else
		{	
			$ip = new Acl_Ips_Ip($database, $_SERVER['REMOTE_ADDR']);	
			if($ip->isBlockedIp())
				header('Location: /?controller=errors&action=ipestabloqueada');
			else
				include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/users/login.php');
		}
		
		// El formulario
	break;
	case 'logout':

		session_destroy();
	
		header('Location: /');	
	break;
	case 'update':
		if($_POST)
		{
			$user=new Acl_Users_User($database);
			$user->updateUser($_POST, $_FILES);				
			header('Location: /?controller=users&action=select');	
			break;
		}
		$user=new Acl_Users_User($database);
		$data=$user->getUser($_GET['id']);
	case 'insert':
		if($_POST)
		{
			$user=new Acl_Users_User($database);
			$user->insertUser($_POST, $_FILES);				
			header('Location: /?controller=users&action=select');	
		}
		else		
			include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/users/insert.php');
		
		// El formulario
		
	break;
	case 'delete':
		if($_POST)
		{
			if(isset($_POST['delete']))
			{
				$user=new Acl_Users_User($database);
				$user->deleteUser($_POST['id']);
			}
			header('Location: /?controller=users&action=select');	
		}
		else
		{
			$user=new Acl_Users_User($database);
			$data=$user->getUser($_GET['id']);
			include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/users/delete.php');
		}
		// El formulario
		
		echo "Estoy en delete";
	break;
	case 'select':	
	default:
		$user=new Acl_Users_User($database);
		$data=$user->getUsers();		
		include_once ($_SERVER['DOCUMENT_ROOT'].'/../application/views/scripts/users/select.php');		
	break;
}