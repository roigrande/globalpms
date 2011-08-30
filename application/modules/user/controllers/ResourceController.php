<?php
class User_ResourceController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    function indexAction()
    {
    	$resources = new User_Model_DbTable_Resources();
        $modules = new User_Model_DbTable_Modules();
    	$this->view->title = "Resources list";
	$this->view->resources = $resources->fetchAll();
    }

    public function addAction()
    {
        $this->view->headTitle("Add New Resource", 'APPEND');
        $request = $this->getRequest();
        
            $form = new User_Form_Resource();
          
        if ($this->getRequest()->isPost()) {
                
            if ($form->isValid($request->getPost())) {
                $model = new User_Model_DbTable_Resources;
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
//                $logger->emerg('alta cancion del artista '.$resource);
//                $logger->debug('alta cancion con titulo '.$title);
                
              
    }

    public function editAction()
    {
        $this->view->title = "Edit resource";

    	$form = new User_Form_Resource;
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                 $model_resource = new User_Model_DbTable_Resources();       
                
                        $model_resource->saveUpdate($form->getValues());
               
              
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $resources = new User_Model_DbTable_Resources();
                $form->populate($resources->getResource($id));
            }
        }
    }
    
    
public function deleteAction()
 {
    if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
            $id = $this->getRequest()->getPost('id');
            $resources = new User_Model_DbTable_Resources();
            $resources->deleteResource($id);
         
        }
        $this->_helper->redirector('index');
    } else {
        $id = $this->_getParam('id', 0);
        $resources = new User_Model_DbTable_Resources();
        $this->view->resource = $resources->getResource($id);
    }
}

}








?>
