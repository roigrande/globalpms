<?php
 
/**
 * Login module bootstrap
 *
 * @author     Roi Grande Deza <roigrande@gmail.com>
 * @copyright  (c)2009 iPTours
 * @category   Acl.
 * @package    modules
 * @subpackage login
 * @license    All Right Reserved
 * @version    SVN: $Id: Bootstrap.php 
 */
class Login_Bootstrap extends Zend_Application_Module_Bootstrap
{   
     /**
     * Bootstrap the acl 
     * 
     * @return void
     */
        static protected $_config;
    
    /**
     *
     * @param mixed $key
     * @return Zend_Config
     */
    protected function _initConfiguration() {
      // Todo
      //Set config in bootstrap as application config

       $configFile = dirname(__FILE__) . '/config.ini';
       $config = new Zend_Config_Ini($configFile,'login');
        //self::$_config=$config;
        //return $config;

         Zend_Registry::set("login", $config);
         
         //Zend_Debug::dump('users');
    }
    
        protected function _initAcl()
    {
        $users=Zend_Registry::get('login');
        
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session($users->StorageSession));
        //$acl = new Users_Model_Acl();
        
        $acl = Login_Model_Acl::getInstance();        
        $front = Zend_Controller_Front::getInstance();
        //$front->setParam('auth', $auth);
        //$front->setParam('acl', $acl);
        require_once dirname(__FILE__) . '/controllers/plugin/Acl.php';
//       Zend_Debug::dump($auth);
//      Zend_Debug::dump($acl);
//    
//       die();
        $front->registerPlugin(new Login_Controller_Plugin_Acl($auth, $acl));
        //$front->registerPlugin(new Users_Controller_Plu
    }
}
