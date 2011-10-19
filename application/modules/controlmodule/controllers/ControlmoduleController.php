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

class Controlmodule_ControlmoduleController extends Zend_Controller_Action
{
  public function init()
    {
        
    }

    function indexAction()
    {
      	$models = new Controlmodule_Model_Modules();
    	$this->view->title = "Modules list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->getModules());      
        $controlmodule = Zend_Registry::get('controlmodule');
        $paginator->setItemCountPerPage($controlmodule->paginator);        
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($controlmodule->paginator);
        $this->view->paginator = $paginator;

    }
    
    public function addAction() {
        $this->view->headTitle("Add New Module", 'APPEND');
        $request = $this->getRequest();
        $form = new Controlmodule_Form_Controlmodule();
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
              
                $module = new Controlmodule_Model_Modules;
                $module->addModule($form);

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
                
                $config = new Zend_Config(array(), true);
                $config->info    = array();
                $config->info->name=$formData["name"];
                $config->info->description=$formData["description"];
                $config->info->version=$formData["version"];
                $config->info->copyright=$formData["copyright"];
                $config->info->developer=$formData["developer"];
               
                
                $writer = new Zend_Config_Writer_Xml(array('config'   => $config,
                'skipExtends' => true,'filename' => $path));
                $writer->write();                               
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $request = $this->getRequest();
            $path = APPLICATION_PATH."/modules/".$request->module_name."/info.xml";        
            $config = new Zend_Config_Xml($path,'info');          
            $arrayinfo["name"]=$config->name;
            $arrayinfo["version"]=$config->version;
            $arrayinfo["description"]=$config->description;      
            $arrayinfo["copyright"]=$config->copyright;
            $arrayinfo["developer"]=$config->developer;               
            
            $this->view->form->populate($arrayinfo);
                 
        }
    }
    
    
public function deleteAction()
 {
    if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
            $module_name = $this->getRequest()->getPost('module_name');
            $modules = new Controlmodule_Model_Modules();
            $modules->deleteFolderModule(APPLICATION_PATH."/modules/".$module_name);
              
        }
        $this->_helper->redirector('index');
    } else {
        $module_name = $this->_getParam('module_name', 0);
        $this->view->module = $module_name;
    }
}
public function installAction() {
        $request = $this->getRequest();     
        if ($request->isGet()) {
                
                $module = new Controlmodule_Model_Modules;
                $module->install($request->module_name);
                
                return $this->_helper->redirector('index');
                
            
        }               
    }
    
    public function uninstallAction() {
        $this->view->headTitle("Install Module", 'APPEND');
        $request = $this->getRequest();

        if ($request->isGet()) {

            $module = new Controlmodule_Model_Modules;
            $module->Uninstall($request->id);

            return $this->_helper->redirector('index');
        }
    }
    
    public function backupAction() {
        $this->view->headTitle("Backup Module", 'APPEND');
        $request = $this->getRequest();
            
        if ($request->isGet()) {

            $module = new Controlmodule_Model_Modules;
            $module->backup($request->module_name);
          
            return $this->_helper->redirector('index');
        }
    }
    
    public function activateAction() {
        $module= new Controlmodule_Model_Modules;
        $request = $this->getRequest();
        $data['id']=$request->id;
        $data['active']='1';
        $module->update($data,'id =' . (int) $data["id"]);
        return $this->_helper->redirector('index');
        
    }
    
    public function deactivateAction() {
        $module= new Controlmodule_Model_Modules;
        $request = $this->getRequest();
        $data['id']=$request->id;
        $data['active']='0';
        $module->update($data,'id =' . (int) $data["id"]);
        return $this->_helper->redirector('index');
    }

    //TODO REINSTALL
}
