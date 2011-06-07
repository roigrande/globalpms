<?php
class User_ModuleController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    function indexAction()
    {
    	$modules = new User_Model_DbTable_Modules();
    	$this->view->title = "Modules list";
		$this->view->modules = $modules->fetchAll();
    }

    public function addAction()
    {
        $this->view->headTitle("Add New Module", 'APPEND');
        $request = $this->getRequest();
        
            $form = new User_Form_Module();
         
        if ($this->getRequest()->isPost()) {
                
            if ($form->isValid($request->getPost())) {
                $model = new User_Model_DbTable_Modules;
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
                
            }
        }
        else {

                    $form->populate($form->getValues());
        }
        $this->view->form = $form;   
//               LOGS
//                               
//                //Inicializamos el log
//                $logger = new Zend_Log();
//                //Aqui ponemos las salida por archivo TODO pasar al application.ini
//                $writer = new Zend_Log_Writer_Stream('../log/zfw.log');
//                $logger->addWriter($writer);
//                //Aqui indicamos que solo se mostraran los mensajes que sean iguales o superiores a criticos
//                $filter = new Zend_Log_Filter_Priority(Zend_Log::INFO);
//                $logger=$logger->addFilter($filter);
                
                //mensajes para log   
//                $logger->emerg('alta cancion del artista '.$module);
//                $logger->debug('alta cancion con titulo '.$title);
                
              
    }

    public function editAction()
    {
        $this->view->title = "Edit module";

    	$form = new User_Form_Module;
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                 $model_module = new User_Model_DbTable_Modules();       
                
                        $model_module->saveUpdate($form->getValues());
               
              
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $modules = new User_Model_DbTable_Modules();
                $form->populate($modules->getModule($id));
            }
        }
    }
    
    
public function deleteAction()
 {
    if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
            $id = $this->getRequest()->getPost('id');
            $modules = new User_Model_DbTable_Modules();
            $modules->deleteModule($id);
         
        }
        $this->_helper->redirector('index');
    } else {
        $id = $this->_getParam('id', 0);
        $modules = new User_Model_DbTable_Modules();
        $this->view->module = $modules->getModule($id);
    }
}

}








?>
