<?php

class User_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    function indexAction()
    {
    	$users = new User_Model_DbTable_Users();
    	$this->view->title = "Users list";
		$this->view->users = $users->fetchAll();
    }

      public function addAction()
    {
            $this->view->headTitle("Add New User", 'APPEND');
            $request = $this->getRequest();
            $model_role = new User_Model_DbTable_Roles();
                        $model_roles = $model_role->fetchAll();
                       // Zend_Debug::dump($model_roles,"model_role",true);
                        if (empty ($model_roles)){
                           
                            return $this->_helper->redirector('add','role');
                        }
                        
            $form    = new User_Form_User();
            
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model_user = new User_Model_DbTable_Users();       
                
                
                if (1) {
                        $model_user->save($form->getValues());
                        return $this->_helper->redirector('index');
                }
                else{
                        $this->renderScript('/error/error_emailfail.phtml');
                }
            }
        }
            else {
                        $form->populate($form->getValues());
                }

        $this->view->form = $form;
    }
    
    public function editAction()
    {
        $this->view->title = "Edit user";

    	$form = new User_Form_User();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                
                $users = new User_Model_DbTable_Users();
                if (1) {
                        $users->saveUpdate($form->getValues());
                        return $this->_helper->redirector('index');
                }                
                
//                //Inicializamos el log
//                $logger = new Zend_Log();
//                //Aqui ponemos las salida por archivo
//                $writer = new Zend_Log_Writer_Stream('../log/zfw.log');
//                $logger->addWriter($writer);
//                //Aqui indicamos que solo se mostraran los mensajes que sean iguales o superiores al filtro
//                $filter = new Zend_Log_Filter_Priority(Zend_Log::INFO);
//                $logger->addFilter($filter);
//                
//                $logger->alert('actualiza la informacion del title '.$title);
//                              

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $users = new User_Model_DbTable_Users();
                $form->populate($users->getUser($id));
            }
        }
    }
    
    
public function deleteAction()
 {
    if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
            $id = $this->getRequest()->getPost('id');
            $users = new User_Model_DbTable_Users();
            $users->deleteUser($id);
            
//            //Inicializamos el log
//            $logger = new Zend_Log();
//            //Aqui ponemos las salida por archivo
//            $writer = new Zend_Log_Writer_Stream('../log/zfw.log');
//            $logger->addWriter($writer);
//            //Aqui indicamos que solo se mostraran los mensajes que sean iguales o superiores a criticos
//            $filter = new Zend_Log_Filter_Priority(Zend_Log::INFO);
//            $this->logger=$logger->addFilter($filter);
//            
//          
//            $logger->notice('elimnar el user con id '.$id);
//           
        }
        $this->_helper->redirector('index');
    } else {
        $id = $this->_getParam('id', 0);
        $users = new User_Model_DbTable_Users();
        $this->view->user = $users->getUser($id);
    }
}

}







