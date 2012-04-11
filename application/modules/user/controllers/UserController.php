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
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new User_Model_Users();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new User_Model_Users();
                $form->populate($model->fetchEntry($id));
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
