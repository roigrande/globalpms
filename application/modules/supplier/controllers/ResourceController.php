<?php

class Supplier_ResourceController extends Zend_Controller_Action {

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
        $model = new Supplier_Model_Resource();
        $data=$model->fetchEntries();
        
        //paginator
        if ($data){
        $paginator = Zend_Paginator::factory($data);
        $supplier = Zend_Registry::get('supplier');
        $paginator->setItemCountPerPage($supplier->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($supplier->paginator);
        $this->view->paginator = $paginator;
        
        }else{$this->view->paginator = null;}
        //send information to the view
        $this->view->title = "Resources list";
        
    }

    /**
     * AddAction for Resources
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Resource", 'APPEND');
        $request = $this->getRequest();
        $form = new Supplier_Form_Resource();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Supplier_Model_Resource();
                $data=$form->getValues();
                $data["companies_id"]=$_SESSION["supplier"]["id"];
                $model->save($data);
               return $this->_helper->_redirector->gotoSimple('consult', 'supplier', 'supplier');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Resources
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Resources";
        $form = new Supplier_Form_Resource();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Supplier_Model_Resource();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->_redirector->gotoSimple('consult', 'supplier', 'supplier');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Supplier_Model_Resource();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Resources
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Supplier_Model_Resource();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Supplier_Model_Resource();

                $this->view->resource= $model->fetchEntry($id);
            }
        }
    }
    
    /**
     * inlitterAction for Resources
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Supplier_Model_Resource();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Supplier_Model_Resource();

                $this->view->resource = $model->fetchEntry($id);
            }
        }
    }

}
