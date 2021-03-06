<?php

class User_RoleController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Roles
     *
     * @return void
     */
    function indexAction() {

        $models = new User_Model_Roles();
        $this->view->title = "Resources list";

        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchSql());
        //TODO usuario configure paginator
        $user = Zend_Registry::get('user');
        $paginator->setItemCountPerPage($user->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($user->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Resources
     *
     * @return void
     */
    public function addAction() {

        $this->view->headTitle("Add New Role", 'APPEND');
        $request = $this->getRequest();
        $form = new User_Form_Role();
        
        if ($this->getRequest()->isPost()) {
            
            if ($form->isValid($request->getPost())) {
                $model = new User_Model_Roles;
                $data=$form->getValues();
                if ($data["name"]=="implementor"){
                    echo "pantalla de error de no se puede crear implementor";
                    die();
             
                }
                
                $model->save($data);
                return $this->_helper->redirector('index');
            }
        } else {
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

    /**
     * EditAction for Roles
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit roles";

        $form = new User_Form_Role;
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new User_Model_Roles();
                $id = $this->getRequest()->getPost('id');
                $data=$form->getValues();
                if ($data["name"]=="implementor"){
                    echo "pantalla de error de no se puede crear implementor";
                    die();
             
                }
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new User_Model_Roles();
                $form->populate($model->fetchEntry($id));
            }
        }
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
                $model = new User_Model_Roles();
                $model->delete($id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new User_Model_Roles();
                $this->view->role = $model->fetchEntry($id);
            }
        }
    }

}

?>
