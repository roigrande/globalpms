<?php

/**
 * Album module bootstrap
 *
 * @author     Agustín F. Calderón M. <agustincl@gmail.com>
 * @copyright  (c)2009 iPTours
 * @category   Acl.
 * @package    modules
 * @subpackage user
 * @license    All Right Reserved
 * @version    SVN: $Id: Bootstrap.php 
 */
class Controlmodule_Bootstrap extends Zend_Application_Module_Bootstrap {

    protected function _initConfiguration() {
        // Todo
        //Set config in bootstrap as application config
        $configFile = dirname(__FILE__) . '/config.ini';     
        $config = new Zend_Config_Ini($configFile, 'controlmodule');
        Zend_Registry::set("controlmodule", $config);
    }

}
