<?php

class Invoices_InvoicesController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {
        //get the page of the table 
        $page = $this->_getParam('page', 1);
        
        //get the dates for the table
        $model = new Invoices_Model_Invoices();
        $data=$model->fetchEntries();
        
        //paginator
        if ($data){
        $paginator = Zend_Paginator::factory($data);
        $invoices = Zend_Registry::get('invoices');
        $paginator->setItemCountPerPage($invoices->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($invoices->paginator);
        $this->view->paginator = $paginator;
        
        }else{$this->view->paginator = null;}
        //send information to the view
        $this->view->title = "Invoicess list";
        
    }

    /**
     * AddAction for Invoicess
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Invoices", 'APPEND');
        $request = $this->getRequest();
        $form = new Invoices_Form_Invoices();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Invoices_Model_Invoices();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Invoicess
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Invoicess";
        $form = new Invoices_Form_Invoices();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Invoices_Model_Invoices();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Invoices_Model_Invoices();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Invoicess
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Invoices_Model_Invoices();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Invoices_Model_Invoices();

                $this->view->invoices= $model->fetchEntry($id);
            }
        }
    }
    
    /**
     * inlitterAction for Invoicess
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Invoices_Model_Invoices();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Invoices_Model_Invoices();

                $this->view->invoices = $model->fetchEntry($id);
            }
        }
    }

}
