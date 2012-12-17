<?php

class Finances_InvoicesController extends Zend_Controller_Action {

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
        $model = new Finances_Model_Invoices();
        $data = $model->fetchEntries();

        //paginator
        if ($data) {
            $paginator = Zend_Paginator::factory($data);
            $finances = Zend_Registry::get('finances');
            $paginator->setItemCountPerPage($finances->paginator);
            $paginator->setCurrentPageNumber($page);
            $paginator->setPageRange($finances->paginator);
            $this->view->paginator = $paginator;
        } else {
            $this->view->paginator = null;
        }
        //send information to the view
        $this->view->title = "Invoicess list";
    }

    /**
     * AddAction for Invoicess
     *
     * @return void
     */
    public function addAction() {

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $invoice["receipt_id"] = $this->getRequest()->getPost('id');


                $model = new Finances_Model_Invoices();
                $model->save($invoice);
            }
            return $this->_helper->redirector->gotoSimple('consult', 'finances', 'finances');
        } else {
            $id = $_SESSION["production"]["id"];
            if ($id > 0) {
                $model = new Finances_Model_Receipts();
                $this->view->invoices = $model->fetchReceiptEntries($id);
            }
        }
    }

    /**
     * EditAction for Invoicess
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Invoicess";
        $form = new Finances_Form_Invoices();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Finances_Model_Invoices();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Finances_Model_Invoices();
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
                $model = new Finances_Model_Invoices();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Finances_Model_Invoices();

                $this->view->invoices = $model->fetchEntry($id);
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
                $model = new Finances_Model_Invoices();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Finances_Model_Invoices();

                $this->view->invoices = $model->fetchEntry($id);
            }
        }
    }

}
