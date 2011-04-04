<?php
require $_SERVER['DOCUMENT_ROOT'].'/../application/configs/settings.php';

$user = new Acl_Users_User($database);
$array_users=$user->getUsers();

//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>";


require ('Zend/Config/Ini.php');
$config= new Zend_Config_Ini(
			$_SERVER['DOCUMENT_ROOT'].'/../application/configs/settings.ini',
			'production');



echo "<pre>";
print_r($config->database->server);
echo "<pre>";

?>
<a href="/users.php?action=login">Login</a>
Estamos en la calle