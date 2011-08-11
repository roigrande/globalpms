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
    }
    
    public function addAction()
    {
        $this->view->headTitle("Add New Module", 'APPEND');
        $request = $this->getRequest();
        $form = new Controlmodule_Form_Controlmodule();
             

        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                   
                // success - do something with the uploaded file
                $uploadedData = $form->getValues(); 
                $fullFilePath = $form->file->getFileName();
                
                // chance the permission of the file
                chmod ($fullFilePath,0777);
                //
                //        //create object
                $zip = new ZipArchive();   

                // open archive 
                if ($zip->open($fullFilePath) !== TRUE) {
                    die ("Could not open archive");
                }
                // extract
                $zip->extractTo(APPLICATION_PATH.'/modules/');
                               
                // close archive
                $zip->close();
                
                //delete file.zip
                unlink($fullFilePath);
                //chance permission for the module
                $file=explode(".", $fullFilePath);
                echo $file[0];
                chmod ($file[0],0777);
                
//                Zend_Debug::dump($uploadedData, '$uploadedData');
//                Zend_Debug::dump($fullFilePath, '$fullFilePath');
//                    
//                echo "done";
//                exit;
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

    	$form = new Controlmodule_Form_Module;
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                 $model_module = new Controlmodule_Model_DbTable();       
                
                        $model_module->saveUpdate($form->getValues());
               
              
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $modules = new Controlmodule_Model_DbTable_Modules();
                $form->populate($modules->getModule($id));
            }
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
                
                $model = new Controlmodule_Model_DbTable_Modules;
                $model->install($request->module_name);
                
                return $this->_helper->redirector('index');
                
            
        }               
    }
    public function desinstallAction() {
        $this->view->headTitle("Install Module", 'APPEND');
        $request = $this->getRequest();



        if ($request->isGet()) {

            $model = new Controlmodule_Model_DbTable_Modules;
            $model->desinstall($request->module_name);

            return $this->_helper->redirector('index');
        
        
    }
    

}
