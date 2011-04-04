<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/../application/models/Applications/application.php';
$ap = Acl_Applications_Application::loadSettings('settings.ini','production',TRUE);


echo "<pre>";
print_r($ap);
echo "<pre>";

echo $ap["database.server"];
//
//$config = new Acl_Configs_Config ($_SERVER['DOCUMENT_ROOT'].'/../application/configs/settings.php',
//							'production',
//							TRUE);
//
//TRUE
//echo "<pre>";
//print_r($config->database->server);
//echo "<pre>";
//// 83.24.1.56
//
//FALSE
//echo "<pre>";
//print_r($config['database']['server']);
//echo "<pre>";
// 83.24.1.56


