<?php

class Production_ProductionsuppliersController extends Zend_Controller_Action {

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
        $model = new Production_Model_Productionsuppliers();
        $data=$model->fetchEntries();
        
        //paginator
        if ($data){
        $paginator = Zend_Paginator::factory($data);
        $production = Zend_Registry::get('production');
        $paginator->setItemCountPerPage($production->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($production->paginator);
        $this->view->paginator = $paginator;
        
        }else{$this->view->paginator = null;}
        //send information to the view
        $this->view->title = "Productionsupplierss list";
        
    }
    public function selectAction() {

        $id = $this->_getParam('id', 0);
        $model = new Production_Model_Productionsuppliers();
        if(!$model->isSupplierInProduction($id))
        {
             return $this->_helper->_redirector->gotoSimple('index', 'productionsuppliers', 'production');
        }
            ;
         
        $this->supplier = new Zend_Session_Namespace('supplier');
        $this->supplier->id = $id;
//        Zend_Debug::dump($_SESSION);
//         die();
        return $this->_helper->_redirector->gotoSimple('consult', 'productionsuppliers', 'production');
    }
    
    
     public function consultAction() {
         
        $this->supplier = new Zend_Session_Namespace('supplier');
        if ($this->supplier->id == null) {
            return $this->_helper->_redirector->gotoSimple('consult', 'production', 'production');
        }

        //get the contacs of the supplier        
        $page = $this->_getParam('page', 1);
        $models = new Production_Model_Contactresource();

        $paginator = Zend_Paginator::factory($models->fetchSupplier($this->supplier->id));
        $contact = Zend_Registry::get('supplier');
        $paginator->setItemCountPerPage($contact->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($contact->paginator);
        $this->view->paginator = $paginator;

        $model = new Production_Model_Resource();
        $data_resource = $model->fetchEntriesSupplier();

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
        $model = new Production_Model_Productionsuppliers();
        $select_supplier = $model->fetchEntry($_SESSION["supplier"]["id"]);
        //Zend_Debug::dump($select_supplier);
        $this->view->select_supplier = $select_supplier;
        //send information to the view
        $this->view->title = "Supplier Consult";
    }
    
    /**
     * AddAction for Productionsupplierss
     *
     * @return void
     */
    public function addAction() {
        
        $this->view->headTitle("Add New Supplier", 'APPEND');
        $request = $this->getRequest();
        $form = new Production_Form_Productionsuppliers();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                
                $data_company = $form->getValues();
                $data_supplier["description"] = $data_company["observation"];
                $data_activity_types["activity_types_id"] = $data_company["activity_types_id"];
 
                //add the new company
                $model_company = new Company_Model_Company();
                  
               
                $data_supplier["companies_id"] = $model_company->saveSupplier($data_company);

                //add this company to supplier table
                $model_supplier = new Production_Model_Productionsuppliers();
                $data_activity_type["suppliers_id"] = $model_supplier->save($data_supplier);
                $data_companies_supplier["suppliers_id"] = $data_activity_type["suppliers_id"];

                //add this supplier to the company
                $model_companies_supplier = new Supplier_Model_Companiessupplier();
                $data_companies_supplier["companies_id"] = $_SESSION["company"]["id"];
//                    Zend_Debug::dump($data_companies_supplier,"data_companies_supplier");
//                      Zend_Debug::dump($data_activity_types,"data_activity_types");
//                    Zend_Debug::dump($data_activity_type,"data_activity_type");
//                      die();
                $model_companies_supplier->save($data_companies_supplier);
                $db = Zend_Registry::get('db');
                 
                 foreach ($data_activity_types["activity_types_id"] as $value) {
                   
                    $data_activity_type["activity_types_id"] = $value;
//                    Zend_Debug::dump($data_activity_type,"inserta bd");
                    $db->insert("suppliers_has_activity_types", $data_activity_type);
                }
 
              return $this->_helper->_redirector->gotoSimple('select', 'productionsuppliers', 'production', array('id' => $data_supplier["companies_id"]));
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

        

    /**
     * EditAction for Productionsupplierss
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Suppliers";
        $form = new Production_Form_Productionsuppliers();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Production_Model_Productionsuppliers();
                $id = $this->getRequest()->getPost('id');
                $data = $form->getValues();
              
                $model->update($data, $id);
                return $this->_helper->redirector('consult');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $_SESSION["supplier"]["id"];
            if ($id > 0) {
                $model = new Production_Model_Productionsuppliers();
         
                $data = $model->fetchEntry($id);
                
//                Zend_Debug::dump($data);
                $form->populate($data);
            }
        }
        $this->view->form = $form;
    }

//    /**
//     * deleteAction for Productionsupplierss
//     *
//     * @return void
//     */
//    public function deleteAction() {
//        if ($this->getRequest()->isPost()) {
//            $del = $this->getRequest()->getPost('del');
//            if ($del == 'Yes') {
//                $id = $this->getRequest()->getPost('id');
//                $model = new Production_Model_Productionsuppliers();
//                $model->delete('id = ' . (int) $id);
//            }
//            return $this->_helper->redirector('index');
//        } else {
//
//            $id = $this->_getParam('id', 0);
//            if ($id > 0) {
//                $model = new Production_Model_Productionsuppliers();
//
//                $this->view->productionsuppliers= $model->fetchEntry($id);
//            }
//        }
//    }
    
     

}
