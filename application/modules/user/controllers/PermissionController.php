<?php

class User_PermissionController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new User_Model_Permissions();
        $this->view->title = "Permissions list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchSql());
        $user = Zend_Registry::get('user');
        $paginator->setItemCountPerPage($user->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($user->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Permissions
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Permission", 'APPEND');
        $request = $this->getRequest();
        $form = new User_Form_Permission();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new User_Model_Permissions;
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
        //TODO logs 
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
//                $logger->emerg('alta cancion del artista '.$permission);
//                $logger->debug('alta cancion con titulo '.$title);
    }

    /**
     * EditAction for Permissions
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit permission";
        $form = new User_Form_Permission();
        $form->submit->setLabel('Save');
        $page = $this->_getParam('page', 1);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new User_Model_Permissions();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index','permission','user', array('page' => $page));
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new User_Model_Permissions();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Permissions
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new User_Model_Permissions();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new User_Model_Permissions();
                $this->view->permission = $model->fetchEntry($id);
            }
        }
    }

}

?>
