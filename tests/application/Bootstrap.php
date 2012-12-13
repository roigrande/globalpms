<?php
error_reporting(E_ALL | E_STRICT);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
//TODO comentario
require_once 'Zend/Application.php';

//TODO comentario
require_once 'Zend/Test/PHPUnit/ControllerTestCase.php';
require_once('PHP/Token/Stream/Autoload.php');
//TODO comentario
require_once 'controllers/ControllerTestCase.php';


 