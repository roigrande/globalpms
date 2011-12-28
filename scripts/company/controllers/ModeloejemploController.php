<?php

class Company_CompanyController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Company_Model_Companys();
        $this->view->title = "Companys list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchSql());

        $company = Zend_Registry::get('company');
        $paginator->setItemCountPerPage($company->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($company->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Companys
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Company", 'APPEND');
        $request = $this->getRequest();
        $form = new Company_Form_Company();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Company_Model_Companys();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Companys
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Companys";
        $form = new Company_Form_Company();
        $form->submit->setLabel('Save');
        $form->removeElement('password');
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Company_Model_Companys();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Company_Model_Companys();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Companys
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Company_Model_Companys();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Company_Model_Companys();

                $this->view->company = $model->fetchEntry($id);
            }
        }
    }

}