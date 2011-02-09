<?php

$configFile = dirname(__FILE__).DIRECTORY_SEPARATOR
           .'..'.DIRECTORY_SEPARATOR.'config'
           .DIRECTORY_SEPARATOR. 'config.inc.php';


if (file_exists($configFile)) {
   
   require($configFile);
   require_once(SITE_ADMIN_CORE_PATH.'application.class.php');
   require_once(SITE_ADMIN_PATH.'controllers/session_bootstrap.php');
   class_exists('Application');
   Application::import_libs('*');
   $app = Application::load();

} else {

   $errorPage =  file_get_contents(dirname(__FILE__).DIRECTORY_SEPARATOR.'500.html');
   echo $errorPage;
   die();
}

?>