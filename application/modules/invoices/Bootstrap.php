<?php
 
/**
 * Album module bootstrap
 *
 * @author     Roi Grande Deza 
 * @copyright  (c)2009 iPTours
 * @category   Acl.
 * @package    modules
 * @subpackage invoices
 * @license    All Right Reserved
 * @version    SVN: $Id: Bootstrap.php 
 */
class Invoices_Bootstrap extends Zend_Application_Module_Bootstrap
{   
    
    protected function _initConfiguration() {
    
       $configFile = dirname(__FILE__) . '/config.ini';
       $config = new Zend_Config_Ini($configFile,'invoices');
       Zend_Registry::set("invoices", $config);         
    }
    
    /**
     * Initialize paginator
     *
     *  @return void
     */
    protected function _initViews(){
            Zend_Paginator::setDefaultScrollingStyle('Elastic');
            Zend_View_Helper_PaginationControl::setDefaultViewPartial(
                    array('paginator.phtml','invoices')
                );        
            }
    
}
