<?php
class User_RoleController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    function indexAction()
    {
    	$roles = new User_Model_DbTable_Roles();
    	$this->view->title = "Roles list";
		$this->view->roles = $roles->fetchAll();
    }

    public function addAction()
    {
        $this->view->headTitle("Add New Role", 'APPEND');
        $request = $this->getRequest();
        
            $form    = new User_Form_Role();
         
        if ($this->getRequest()->isPost()) {
                
            if ($form->isValid($request->getPost())) {
                $model = new User_Model_DbTable_Roles;
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
//                $logger->emerg('alta cancion del artista '.$role);
//                $logger->debug('alta cancion con titulo '.$title);
                
              
    }

    public function editAction()
    {
        $this->view->title = "Edit role";

    	$form = new User_Form_Role;
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                 $model_role = new User_Model_DbTable_Roles();       
                
                        $model_role->saveUpdate($form->getValues());
               
              
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $roles = new User_Model_DbTable_Roles();
                $form->populate($roles->getRole($id));
            }
        }
    }
    
    
public function deleteAction()
 {
    if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
            $id = $this->getRequest()->getPost('id');
            $roles = new User_Model_DbTable_Roles();
            $roles->deleteRole($id);
         
        }
        $this->_helper->redirector('index');
    } else {
        $id = $this->_getParam('id', 0);
        $roles = new User_Model_DbTable_Roles();
        $this->view->role = $roles->getRole($id);
    }
}

}








?>
