<?php

class User_UserController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new User_Model_Users();
        $this->view->title = "Users list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchSql());

        $user = Zend_Registry::get('user');
        $paginator->setItemCountPerPage($user->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($user->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * deleteAction for Productions
     *
     * @return void
     */
    public function selectAction() {

        $this->gpms = new Zend_Session_Namespace('gpms');
//        echo $this->gpms->storage->role_id;
//        echo $this->gpms->role_application;
//        Zend_Debug::dump($this->gpms->storage);
//        die();
        $this->gpms->storage->out_production = 1;
        $this->gpms->storage->role_id = $this->gpms->role_application;
//       

        return $this->_helper->_redirector->gotoSimple('index', 'user', 'user');
    }

    /**
     * AddAction for Users
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New User", 'APPEND');
        $request = $this->getRequest();
        $form = new User_Form_User();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new User_Model_Users();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Users
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Users";
        $form = new User_Form_User();
        $form->submit->setLabel('Save');
        $form->removeElement('password');
        $form->removeElement('company_id');
        $id = $this->_getParam('id', 0);
        $this->gpms = new Zend_Session_Namespace('gpms');
         
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new User_Model_Users();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                //TODO pasar el role implementador y administrador sin hardcode               
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {


            if ($id > 0) {

                
                $model = new User_Model_Users();
                $data = $model->fetchEntry($id);
                if ($model->haveContact($id)){
                   
                    $form->removeElement('add_contact');
                }
               
                $form->populate($data);
            }
        }
        $this->view->form = $form;
    }
    /**
     * EditAction for Users
     *
     * @return void
     */
    public function editownuserAction() {
        $this->view->title = "Edit Users";
        $form = new User_Form_User();
        $form->submit->setLabel('Save');
        $form->removeElement('password');
        $form->removeElement('company_id');
        $id =  $_SESSION["gpms"]["storage"]->id;
        $this->gpms = new Zend_Session_Namespace('gpms');
        //TODO pasar el role implementador y administrador sin hardcode
        //si es un usuario sin permiso solo puede editar su usuario y no su role_id
        
            $form->removeElement('role_id');
            $id = $this->gpms->storage->id;
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new User_Model_Users();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                
                $this->_helper->redirector('index', 'company', 'company');
               
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {


            if ($id > 0) {

                
                $model = new User_Model_Users();
                $data = $model->fetchEntry($id);
                if ($model->haveContact($id)){
                   
                    $form->removeElement('add_contact');
                }
               
                $form->populate($data);
            }
        }
        $this->view->form = $form;
    }
    /**
     * deleteAction for Users
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new User_Model_Users();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new User_Model_Users();

                $this->view->user = $model->fetchEntry($id);
            }
        }
    }

}
