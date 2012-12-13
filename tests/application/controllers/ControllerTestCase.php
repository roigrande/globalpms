<?php

abstract class ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase {

    protected $application;

    public function setUp() {
        
        $this->bootstrap = array($this, 'appBootstrap');
        $this->getFrontController()->setDefaultModule('default');
        parent::setUp();
    }

    public function appBootstrap() {
        $this->application = new Zend_Application(APPLICATION_ENV, 
                                                  APPLICATION_PATH . '/configs/application.ini');
        $this->application->bootstrap();
//         Zend_Debug::dump($this->application);
//         die();
    }
    
//    
//    
//    public function doLogin ()
//{
//    // create a fake identity
//    $identity = new stdClass();
//    $identity->Username = 'PHPUnit';
//    Zend_Auth::getInstance()->getStorage()->write($identity);
//
//    // remove the autoloaded plugin
//    $front = Zend_Controller_Front::getInstance();
//    $front->unregisterPlugin('My_Controller_Plugin_Acl');
//
//    // create the stub for the Acl class
//    $mockaAcl = $this->getMock(
//      'My_Controller_Plugin_Acl',
//      array('preDispatch'),
//      array(),
//      'My_Controller_Plugin_AclMock'
//    ); 
//
//    // register the stub acl plugin in its place
//    $front->registerPlugin($mockAcl); 
//}


}