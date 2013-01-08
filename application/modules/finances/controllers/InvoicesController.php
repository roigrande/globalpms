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
        $data = $model->fetchEntries($_SESSION["production"]["id"]);
//       
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
        $this->view->title = "Invoices list";
    }

    function consultAction() {
 
        $this->_helper->layout->disableLayout();
        //check if the user select a production
        $this->production = new Zend_Session_Namespace('production');
        if ($this->production->id == null) {
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }

        $model = new Finances_Model_Invoices();

        $this->view->title = "Consult Invoice";
        $invoice_id = $this->_getParam('id', 1);
        if (!$model->fetchInvoiceBelongProduction($invoice_id, $_SESSION["production"]["id"])) {
            return $this->_helper->_redirector->gotoSimple('index');
        }
        $production_model= new Company_Model_Company();
        $this->view->company = $production_model->fetchEntry($_SESSION["company"]["id"]);   
        $this->view->client = $model->fetchDatasReceiptEntry($invoice_id);      
        $this->view->invoices = $model->fetchInvoice($invoice_id);
    }

    /**
     * AddAction for Invoices
     *
     * @return void
     */
    public function addAction() {

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $invoice["receipt_id"] = $this->getRequest()->getPost('id');
//                Zend_Debug::dump($invoice); 
//                die();

                $model = new Finances_Model_Invoices();
                $model->save($invoice);
            }
            return $this->_helper->redirector->gotoSimple('consult', 'finances', 'finances');
        } else {
            $id = $_SESSION["production"]["id"];
            if ($id > 0) {
                $model = new Finances_Model_Receipts();

                $this->view->client = $model->fetchReceiptEntry($id);
                $this->view->invoices = $model->fetchReceiptEntries($id);
            }
        }
    }

    /**
     * EditAction for Invoices
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Invoices";
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
     * deleteAction for Invoices
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
     * inlitterAction for Invoices
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
