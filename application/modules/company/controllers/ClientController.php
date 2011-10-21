<?php

class Company_ClientController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Company_Model_Client();
        $this->view->title = "Clients list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchSql());

        $company = Zend_Registry::get('company');
        $paginator->setItemCountPerPage($company->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($company->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Clients
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Client", 'APPEND');
        $request = $this->getRequest();
        $form = new Company_Form_Client();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Company_Model_Client();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Clients
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Clients";
        $form = new Company_Form_Client();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Company_Model_Client();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Company_Model_Client();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Clients
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Company_Model_Client();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Company_Model_Client();

                $this->view->company = $model->fetchEntry($id);
            }
        }
    }

}
