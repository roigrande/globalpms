<?php

/**
 * Application bootstrap
 *
 * @uses    Zend_Application_Bootstrap_Bootstrap
 * @package GlobalPms
 * @version SVN $Id: Bootstrap.php 1457 2010-07-06 10:33:27Z agustincl $
 */
 //    require_once('/usr/local/zend/gui/library/Zend/Application/Bootstrap/Bootstrap.php');
class Bootstrap 
    extends Zend_Application_Bootstrap_Bootstrap
    {
     
//    protected function _initAutoload() {
//        $autoloader = Zend_Loader_Autoloader::getInstance();
//    }
//
//    protected function _initSession() {
//        Zend_Session::start();
//    }
//
//    protected function _initFrontRegistry() {
//        $front = $this->bootstrap('frontController')->getResource('frontController');
//        $front->setParam('registry', $this->getContainer());
//    }
//
//    protected function _initLocale() {
//        $locale = new Zend_Locale();
//        $config = $this->getOptions();
//        $defaultLocale = $config['lang_local'];
//
//        try {
//            $locale = new Zend_Locale('auto');
//        } catch (Zend_Locale_Exception $e) {
//            $locale = new Zend_Locale($defaultLocale);
//        }
//
//        if (!isset($_SESSION['default']['locale']))
//            $_SESSION['default']['locale'] = $locale->getRegion();
//        if (!isset($_SESSION['default']['language']))
//            $_SESSION['default']['language'] = $locale->getLanguage();
//        Zend_Registry::set('Zend_Locale', $locale);
//    }
// 
//   
//    protected function _initDatabase() {
//        $this->bootstrapDb();
//        $db = $this->getResource('db');
//        $db->setFetchMode(Zend_Db::FETCH_OBJ);
//        $db->query("SET NAMES 'utf8'");
//        $db->query("SET CHARACTER SET 'utf8'");
//        Zend_Registry::set("db", $db);
//        return $db;
//    }
//    

}
