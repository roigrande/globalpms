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

//    public function addAction()
//    {
//        $form = new User_Form_User();
//        $form->submit->setLabel('Add');
//        $this->view->form = $form;
//        if ($this->getRequest()->isPost()) {
//            $formData = $this->getRequest()->getPost();
//            if ($form->isValid($formData)) {
//                $user_name = $form->getValue('user_name');
//                $email = $form->getValue('email');
//                $users = new User_Model_DbTable_Users();
//                $users->addUser($user_name,$email);      
//                               
////                //Inicializamos el log
////                $logger = new Zend_Log();
////                //Aqui ponemos las salida por archivo TODO pasar al application.ini
////                $writer = new Zend_Log_Writer_Stream('../log/zfw.log');
////                $logger->addWriter($writer);
////                //Aqui indicamos que solo se mostraran los mensajes que sean iguales o superiores a criticos
////                $filter = new Zend_Log_Filter_Priority(Zend_Log::INFO);
////                $logger=$logger->addFilter($filter);
////                
////                //mensajes para log   
////                $logger->emerg('alta cancion del artista '.$artist);
////                $logger->debug('alta cancion con titulo '.$title);
//                
//                $this->_helper->redirector('index');
//                //Escribimos un simple mensaje 
//
//            } else {
//                $form->populate($formData);
//            }
//        }
//    }
      public function addAction()
    {
            $this->view->headTitle("Add New User", 'APPEND');
            $request = $this->getRequest();
            $form    = new User_Form_User();
            $model_role = new User_Model_DbTable_Roles();
            
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model_user = new User_Model_DbTable_Users();       
                $vals=$request->getPost();
                Zend_Debug::dump($vals, $label = null, $echo = true);
                
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
                        //TODO necesito pasar al formular role_name y role_id
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







