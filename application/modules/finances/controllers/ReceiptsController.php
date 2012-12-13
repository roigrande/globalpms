<?php

class Finances_ReceiptsController extends Zend_Controller_Action {

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
        $model = new Finances_Model_Receipts();
        $data=$model->fetchEntries();
        
        //paginator
        if ($data){
        $paginator = Zend_Paginator::factory($data);
        $finances = Zend_Registry::get('finances');
        $paginator->setItemCountPerPage($finances->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($finances->paginator);
        $this->view->paginator = $paginator;
        
        }else{$this->view->paginator = null;}
        //send information to the view
        $this->view->title = "Receiptss list";
        
    }

    /**
     * AddAction for Receiptss
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Receipts", 'APPEND');
        $request = $this->getRequest();
        $form = new Finances_Form_Receipts();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Finances_Model_Receipts();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Receiptss
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Receiptss";
        $form = new Finances_Form_Receipts();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Finances_Model_Receipts();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Finances_Model_Receipts();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Receiptss
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Finances_Model_Receipts();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Finances_Model_Receipts();

                $this->view->receipts= $model->fetchEntry($id);
            }
        }
    }
    
    /**
     * inlitterAction for Receiptss
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Finances_Model_Receipts();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Finances_Model_Receipts();

                $this->view->receipts = $model->fetchEntry($id);
            }
        }
    }

}
