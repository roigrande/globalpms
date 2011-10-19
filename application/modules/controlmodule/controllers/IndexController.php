<?php
/* ModulesController.php is the modules controller
 *
 * This module implement acl and auth.
 *
 * @author     Roi Grande <roigrande@gmail.com>
 * @copyright  Copyright 2011 EMPRESA. All Rights Reserved.
 * @license    
 * @category   CATEGORIA
 * @package    Controlmodule
 * @subpackage controllers
 * @version    SVN $Id:$
 *
 */
class Controlmodule_IndexController extends Zend_Controller_Action
{
  public function init()
    {
        
    }

    function indexAction()
    {
    $this->_helper->redirector('index','controlmodule');
    }
    
    //TODO REINSTALL
}
