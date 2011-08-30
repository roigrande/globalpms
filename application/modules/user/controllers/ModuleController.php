<?php
class User_ModuleController extends Zend_Controller_Action//extends Zend_Controller_Action
{
 public function init()
    {
        
    }

    function indexAction()
    {
    	$modules = new User_Model_Modules();
    	$this->view->title = "Modules list";
        $this->view->modules = $modules->getModules();

    }
    
   

    public function editAction()
    {
        $this->view->title = "Edit module";

    	$form = new User_Form_Controlmodulexml;
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
            $modules = new User_Model_DbTable_Modules();
            $modules->deleteFolderModule(APPLICATION_PATH."/modules/".$module_name."/");
                
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
                
                $module = new User_Model_DbTable_Modules;
                $module->install($request->module_name);
                
                return $this->_helper->redirector('index');
                
            
        }               
    }
    
    public function desinstallAction() {
        $this->view->headTitle("Install Module", 'APPEND');
        $request = $this->getRequest();

        if ($request->isGet()) {

            $module = new User_Model_DbTable_Modules;
            $module->desinstall($request->id);

            return $this->_helper->redirector('index');
        }
    }
    
    public function backupAction() {
        $this->view->headTitle("Backup Module", 'APPEND');
        $request = $this->getRequest();
            
        if ($request->isGet()) {

            $module = new User_Model_DbTable_Modules;
            $module->backup($request->module_name);

            return $this->_helper->redirector('index');
        }
    }
    
    public function activateAction() {
        $module= new User_Model_DbTable_Modules;
        $request = $this->getRequest();
        $data['id']=$request->id;
        $data['active']='1';
        $module->saveUpdate($data);
        return $this->_helper->redirector('index');
        
    }
    
    public function deactivateAction() {
        $module= new User_Model_DbTable_Modules;
        $request = $this->getRequest();
        $data['id']=$request->id;
        $data['active']='0';
        $module->saveUpdate($data);        
        return $this->_helper->redirector('index');
    }
}
?>
