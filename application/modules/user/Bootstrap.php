<?php
 
/**
 * Album module bootstrap
 *
 * @author     Roi Grande Deza r0
 * @copyright  (c)2009 iPTours
 * @category   Acl.
 * @package    modules
 * @subpackage user
 * @license    All Right Reserved
 * @version    SVN: $Id: Bootstrap.php 
 */
class User_Bootstrap extends Zend_Application_Module_Bootstrap
{   
 /**
     * Initialize paginator
     *
     *  @return void
     */
    protected function _initViews(){
            Zend_Paginator::setDefaultScrollingStyle('Elastic');
            Zend_View_Helper_PaginationControl::setDefaultViewPartial(
                    array('paginator.phtml','user')
                );        
            }    
}
