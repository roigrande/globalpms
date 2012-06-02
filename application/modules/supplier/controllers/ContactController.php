<?php

class Supplier_ContactController extends Zend_Controller_Action {

    public function init() {
        
    }

//    /**
//     * IndexAction for Permissions
//     *
//     * @return void
//     */
//    function indexAction() {
//        //get the page of the table 
//        $page = $this->_getParam('page', 1);
//        
//        //get the dates for the table
//        $model = new Supplier_Model_Contact();
//        $data=$model->fetchEntries();
//        
//        //paginator
//        if ($data){
//        $paginator = Zend_Paginator::factory($data);
//        $supplier = Zend_Registry::get('supplier');
//        $paginator->setItemCountPerPage($supplier->paginator);
//        $paginator->setCurrentPageNumber($page);
//        $paginator->setPageRange($supplier->paginator);
//        $this->view->paginator = $paginator;
//        
//        }else{$this->view->paginator = null;}
//        //send information to the view
//        $this->view->title = "Contacts list";
//        
//    }

    /**
     * AddAction for Contacts
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Contact", 'APPEND');
        $request = $this->getRequest();
        $form = new Supplier_Form_Contact();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Supplier_Model_Contact();
                $model->save($form->getValues());
                return $this->_helper->_redirector->gotoSimple('consult', 'supplier', 'supplier');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Contacts
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Contacts";
        $form = new Supplier_Form_Contact();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Supplier_Model_Contact();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                    return $this->_helper->_redirector->gotoSimple('consult', 'supplier', 'supplier');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Supplier_Model_Contact();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Contacts
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Supplier_Model_Contact();
                $model->delete('id = ' . (int) $id);
            }
             return $this->_helper->_redirector->gotoSimple('consult', 'supplier', 'supplier');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Supplier_Model_Contact();

                $this->view->contact= $model->fetchEntry($id);
            }
        }
    }
    
    /**
     * inlitterAction for Contacts
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Supplier_Model_Contact();
                $model->inLitter('id = ' . (int) $id);
            }
                return $this->_helper->_redirector->gotoSimple('consult', 'supplier', 'supplier');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Supplier_Model_Contact();

                $this->view->contact = $model->fetchEntry($id);
            }
        }
    }

}
