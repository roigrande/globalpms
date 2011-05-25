<?php
/**
 * Application bootstrap
 *
 * @uses    Zend_Application_Bootstrap_Bootstrap
 * @package Iptours
 * @version SVN $Id: Bootstrap.php 1457 2010-07-06 10:33:27Z agustincl $
 */

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
 {
 	
 	protected function _initAutoload()
    {
    	$autoloader = Zend_Loader_Autoloader::getInstance();        
    }
    
 	protected function _initSession()
    {
		Zend_Session::start();
	}
	
	
 	protected function _initFrontRegistry()
    {
         $front = $this->bootstrap('frontController')->getResource('frontController');
         $front->setParam('registry', $this->getContainer());         
    }
    
 	protected function _initLocale()
    {             	
     	$locale = new Zend_Locale();
     	$config = $this->getOptions();     	
     	$defaultLocale = $config['lang_local'];        
 
        try {
            $locale = new Zend_Locale('auto');
        } catch (Zend_Locale_Exception $e) {
            $locale = new Zend_Locale($defaultLocale);
        }
        
        if(!isset($_SESSION['default']['locale']))
            $_SESSION['default']['locale']=$locale->getRegion();
        if(!isset($_SESSION['default']['language']))
            $_SESSION['default']['language']=$locale->getLanguage();
		Zend_Registry::set('Zend_Locale', $locale);
        
    }
 	
 	protected function _initLang()
	{
		// TODO
		// Set cache for speedup
		//$cache = Zend_Cache::factory('Core','File');
		//Zend_Translate::setCache($cache);
		$translate = new Zend_Translate('tmx', APPLICATION_PATH .'/languages/info.xml', $_SESSION['default']['language']);
		Zend_Registry::set('Zend_Translate', $translate);        
	}
	
 	protected function _initView()
    {
        // Initialize view 
        $this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		
        $view->doctype('XHTML1_TRANSITIONAL');
        $view->headTitle('Globalpms'); 
        $view->headTitle()->setSeparator(' - ');
        
        // Return it, so that it can be stored by the bootstrap
        return $view;
    }
	
}
