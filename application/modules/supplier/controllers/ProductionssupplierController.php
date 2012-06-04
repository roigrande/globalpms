<?php

class Supplier_ProductionssupplierController extends Zend_Controller_Action {

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
        $model = new Supplier_Model_Productionssupplier();
        $data = $model->fetchEntries();

        //paginator
        if ($data) {
            $paginator = Zend_Paginator::factory($data);
            $supplier = Zend_Registry::get('supplier');
            $paginator->setItemCountPerPage($supplier->paginator);
            $paginator->setCurrentPageNumber($page);
            $paginator->setPageRange($supplier->paginator);
            $this->view->paginator = $paginator;
        } else {
            $this->view->paginator = null;
        }
        //send information to the view
        $this->view->title = "Productionssuppliers list";
    }
    
    
     public function selectAction() {

        $id = $this->_getParam('id', 0);
 
        $this->supplier = new Zend_Session_Namespace('supplier');
        $this->supplier->id = $id;

        return $this->_helper->_redirector->gotoSimple('consult', 'productionssupplier', 'supplier');
    }
    
     public function consultAction() {
         
        $this->supplier = new Zend_Session_Namespace('supplier');
        if ($this->supplier->id == null) {
           return $this->_helper->_redirector->gotoSimple('consult', 'productionssupplier', 'supplier');
        }

        //get the contacs of the supplier        
        $page = $this->_getParam('page', 1);
        $models = new Supplier_Model_Contact();

        $paginator = Zend_Paginator::factory($models->fetchSupplier($this->supplier->id));
        $contact = Zend_Registry::get('supplier');
        $paginator->setItemCountPerPage($contact->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($contact->paginator);
        $this->view->paginator = $paginator;

        $model = new Supplier_Model_Resource();
        $data_resource = $model->fetchEntries();

        //data resource of supplier
        if ($data_resource) {
            $paginator_resource = Zend_Paginator::factory($data_resource);
            $supplier = Zend_Registry::get('supplier');
            $paginator_resource->setItemCountPerPage($supplier->paginator);
            $paginator_resource->setCurrentPageNumber($page);
            $paginator_resource->setPageRange($supplier->paginator);
            $this->view->paginator_resource = $paginator_resource;
        } else {
            $this->view->paginator_resource = null;
        }
        //send information to the view
        $this->view->title = "Resources list";

        //get the dates for the table
        $model = new Supplier_Model_Supplier();
        $select_supplier = $model->fetchEntry($_SESSION["supplier"]["id"]);
        //Zend_Debug::dump($select_supplier);
        $this->view->select_supplier = $select_supplier;
        //send information to the view
        $this->view->title = "Supplier Consult";
    }
    

    /**
     * AddAction for Productionssuppliers
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Productionssupplier", 'APPEND');
        $request = $this->getRequest();
        $form = new Supplier_Form_Productionssupplier();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Supplier_Model_Productionssupplier();
                $data = $form->getValues();
                $data["productions_id"] = $_SESSION["production"]["id"];
                $model->save($data);
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

//
//    /**
//     * EditAction for Productionssuppliers
//     *
//     * @return void
//     */
//    public function editAction() {
//        $this->view->title = "Edit Productionssuppliers";
//        $form = new Supplier_Form_Productionssupplier();     
//        if ($this->getRequest()->isPost()) {
//            if ($form->isValid($this->getRequest()->getPost())) {
//                $model = new Supplier_Model_Productionssupplier();
//                $id = $this->getRequest()->getPost('id');
//                $model->update($form->getValues(), 'id = ' . (int) $id);
//                return $this->_helper->redirector('index');
//            } else {
//                $form->populate($this->getRequest()->getPost());
//            }
//        } else {
//
//            $id = $this->_getParam('id', 0);
//            if ($id > 0) {
//
//                $model = new Supplier_Model_Productionssupplier();
//                $form->populate($model->fetchEntry($id));
//            }
//        }
//        $this->view->form = $form;
//    }

    /**
     * deleteAction for Productionssuppliers
     *
     * @return void
     */
    public function deleteAction() {

        $suppliers_id = $this->_getParam('id', 0);
        $model = new Supplier_Model_Productionssupplier();
        $model->delete('suppliers_id = ' . (int) $suppliers_id .' and productions_id = ' .$_SESSION["production"]["id"] );
        return $this->_helper->redirector('index');
    }

//    /**
//     * inlitterAction for Productionssuppliers
//     *
//     * @return void
//     */
//    
//    public function inlitterAction() {
//        if ($this->getRequest()->isPost()) {
//            $del = $this->getRequest()->getPost('del');
//            if ($del == 'Yes') {
//                $id = $this->getRequest()->getPost('id');
//                $model = new Supplier_Model_Productionssupplier();
//                $model->inLitter('id = ' . (int) $id);
//            }
//            return $this->_helper->redirector('index');
//        } else {
//
//            $id = $this->_getParam('id', 0);
//            if ($id > 0) {
//                $model = new Supplier_Model_Productionssupplier();
//
//                $this->view->productionssupplier = $model->fetchEntry($id);
//            }
//        }
//    }
}
