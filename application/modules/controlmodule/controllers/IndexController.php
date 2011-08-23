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
    	$modules = new Controlmodule_Model_DbTable_Modules();
    	$this->view->title = "Modules list";
        $this->view->modules = $modules->fetchAll();
//        Zend_Debug::dump($modules,"model_role",true);
//        die();
    }
    
    public function addAction()
    {
        $this->view->headTitle("Add New Module", 'APPEND');
        $request = $this->getRequest();
        $form = new Controlmodule_Form_Controlmodule();
                   
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                
                $model_module = new Controlmodule_Model_DbTable_Modules();       
                $model_module->addModule($form);
               
                return $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }

  
        $this->view->form = $form;   
              
    }
    

    public function editAction()
    {
        $this->view->title = "Edit module";

    	$form = new Controlmodule_Form_Controlmodulexml;
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                //si cambiamos name hay que cambiar la carpeta
                Zend_Debug::dump($formData,"model_role",true);
                $path = APPLICATION_PATH."/modules/".$formData["name"]."/info.xml";            
                $config = new Zend_Config_Ini($path,
                              null,
                              array('skipExtends'        => true,
                                   'allowModifications' => true));
                $config->name=$formData[name];
                $config->description=$formData["description"];
                $config->version=$formData["version"];
                $config->copyright=$formData["copyright"];
                $config->developer=$formData["developer"];
                $config->config->modules->codepool=$formData["codepool"];
          
                $writer = new Zend_Config_Writer_Xml();
                $writer->write($path, $config);
           
               
                 
                 $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $request = $this->getRequest();
            $path = APPLICATION_PATH."/modules/".$request->module_name."/info.xml";
            echo $path;
        
            $config = new Zend_Config_Ini($path);
            Zend_Debug::dump($config, '$arrayinfo');
            
            
            $arrayinfo["name"]=$config->name;
            $arrayinfo["version"]=$config->version;
            $arrayinfo["description"]=$config->description;      
            $arrayinfo["copyright"]=$config->copyright;
            $arrayinfo["developer"]=$config->developer;     
            $arrayinfo["codepool"]=$config->config->modules->codepool;
            Zend_Debug::dump($arrayinfo, '$arrayinfo');
            
            $this->view->form->populate($arrayinfo);
                 
        }
    }
    
    
public function deleteAction()
 {
    if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
            $module_name = $this->getRequest()->getPost('module_name');
            $modules = new Controlmodule_Model_DbTable_Modules();
            $modules->deleteFolderModule(APPLICATION_PATH."/modules/".$module_name."/");
                
        }
        $this->_helper->redirector('index');
    } else {
        $module_name = $this->_getParam('module_name', 0);
        $this->view->module = $module_name;
    }
}
public function installAction()
    {
        $this->view->headTitle("Install Module", 'APPEND');
        $request = $this->getRequest();
     
        if ($request->isGet()) {
                
                $module = new Controlmodule_Model_DbTable_Modules;
                $module->install($request->module_name);
                
                return $this->_helper->redirector('index');
                
            
        }               
    }
    public function desinstallAction() {
        $this->view->headTitle("Install Module", 'APPEND');
        $request = $this->getRequest();



        if ($request->isGet()) {

            $module = new Controlmodule_Model_DbTable_Modules;
            $module->desinstall($request->module_name);

            return $this->_helper->redirector('index');
        }
    }
    public function backupAction() {
        $this->view->headTitle("Backup Module", 'APPEND');
        $request = $this->getRequest();
            
        if ($request->isGet()) {

            $module = new Controlmodule_Model_DbTable_Modules;
            $module->backup($request->module_name);

            return $this->_helper->redirector('index');
        }
    }
    
    public function activateAction() {
        $module= new Controlmodule_Model_DbTable_Modules;
        $request = $this->getRequest();
        $data['id']=$request->id;
        $data['active']='1';
        $module->saveUpdate($data);
        return $this->_helper->redirector('index');
        
    }
    
    public function deactivateAction() {
        $module= new Controlmodule_Model_DbTable_Modules;
        $request = $this->getRequest();
        $data['id']=$request->id;
        $data['active']='0';
        $module->saveUpdate($data);        
        return $this->_helper->redirector('index');
    }

}
