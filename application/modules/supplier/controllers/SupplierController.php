<?php

class Supplier_SupplierController extends Zend_Controller_Action {

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
        $model = new Supplier_Model_Supplier();
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
        $this->view->title = "Suppliers list";
        
    }

    /**
     * AddAction for Suppliers
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Supplier", 'APPEND');
        $request = $this->getRequest();
        $form = new Supplier_Form_Supplier();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $data_company=$form->getValues();
                $data_supplier["description"]=$data_company["observation"];
                $data_activity_types["activity_types_id"]=$data_company["activity_types_id"];
                $model_activity_types= new Managementtype_Model_Activitytype;
                
                //add the new company
                $model_company= new Company_Model_Company();
                $data_supplier["companies_id"]=(int) 6;//$model_company->save($data_company);
                
               
                //add this company to supplier table
                $model_supplier = new Supplier_Model_Supplier();
                $data_activity_type["supliers_id"]=$model_supplier->save($data_supplier);
                 Zend_Debug::dump($data_supplier,"sup");
                 Zend_Debug::dump($data_activity_type,"sup_id");
                 
                 die();
                foreach ($data_activity_types["activity_types_id"] as $value) {
                    
                      $db = Zend_Registry::get('db');
                      $data_activity_type["activity_types_id"]=$value;
                      $db->insert(suppliers_has_activity_types,$data_activity_type);
                    echo $value;
                    
                }
                //add the suppliers activities to the table supliers_has_activity_types
                
                
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Suppliers
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Suppliers";
        $form = new Supplier_Form_Supplier();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Supplier_Model_Supplier();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Supplier_Model_Supplier();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Suppliers
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Supplier_Model_Supplier();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Supplier_Model_Supplier();

                $this->view->supplier= $model->fetchEntry($id);
            }
        }
    }
    
    /**
     * inlitterAction for Suppliers
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Supplier_Model_Supplier();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Supplier_Model_Supplier();

                $this->view->supplier = $model->fetchEntry($id);
            }
        }
    }

}
