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
        $this->view->title = "Suppliers list";
    }

    public function selectAction() {

        $id = $this->_getParam('id', 0);

//      //se comprueba que el usuario tiene permiso para esa produccion
        //se comprueba que el usuario tiene permiso para esa accion hecho
//        $model_supplier = new Supplier_Model_Supplier();
//        if (!$model_supplier->isUserAllowedClient($id)) {
//            echo "no tiene acceso a este cliente ";
//            die();
//            return $this->_helper->_redirector->gotoSimple('index', 'client', 'client');
//        };
//
//        $model = new Production_Model_Production();
//        $production = $model->fetchEntry($id);
        //  Zend_Debug::dump($_SESSION);
        
        $this->supplier = new Zend_Session_Namespace('supplier');
        $this->supplier->id = $id;

        return $this->_helper->_redirector->gotoSimple('consult', 'supplier', 'supplier');
    }

    public function consultAction() {
        $this->supplier = new Zend_Session_Namespace('supplier');
        if ($this->supplier->id == null) {
            return $this->_helper->_redirector->gotoSimple('consult', 'supplier', 'supplier');
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
                $data_company = $form->getValues();
                $data_supplier["description"] = $data_company["observation"];
                $data_activity_types["activity_types_id"] = $data_company["activity_types_id"];


                //add the new company
                $model_company = new Company_Model_Company();
                $data_supplier["companies_id"] = $model_company->saveSupplier($data_company);

                //add this company to supplier table
                $model_supplier = new Supplier_Model_Supplier();
                $data_activity_type["suppliers_id"] = $model_supplier->save($data_supplier);
                $data_companies_supplier["suppliers_id"] = $data_activity_type["suppliers_id"];

                //add this supplier to the company
                $model_companies_supplier = new Supplier_Model_Companiessupplier();
                $data_companies_supplier["companies_id"] = $_SESSION["company"]["id"];
                $model_companies_supplier->save($data_companies_supplier);
                 $db = Zend_Registry::get('db');
                //add types of activity for the supplier
//                 Zend_Debug::dump($data_activity_types,"tipos a insertar");
                foreach ($data_activity_types["activity_types_id"] as $value) {
                   
                    $data_activity_type["activity_types_id"] = $value;
//                    Zend_Debug::dump($data_activity_type,"inserta bd");
                    $db->insert("suppliers_has_activity_types", $data_activity_type);
                }
 
              return $this->_helper->_redirector->gotoSimple('select', 'supplier', 'supplier', array('id' => $data_supplier["companies_id"]));
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
                $data = $form->getValues();
                
//                Zend_Debug::dump($data);
//                 die();
                //add types of activity for the supplier
                $db = Zend_Registry::get('db');

                $db->delete("suppliers_has_activity_types", "suppliers_id=" . $id);
                $data_activity_type["suppliers_id"] = $data["id"];
                foreach ($data["activity_types_id"] as $value) {

                    $data_activity_type["activity_types_id"] = $value;
                    $db->insert("suppliers_has_activity_types", $data_activity_type);
//                 Zend_Debug::dump($data_activity_type);
                }
//                die();
                $model->update($data, $id);
                return $this->_helper->redirector('consult');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $_SESSION["supplier"]["id"];
            if ($id > 0) {

                $model = new Supplier_Model_Supplier();
                $data = $model->fetchEntry($id);
                $db = Zend_Registry::get('db');
                $sql = "SELECT activity_types_id
                FROM suppliers_has_activity_types
                WHERE suppliers_has_activity_types.suppliers_id=" . $data["id"];
//                Zend_Debug::dump($data);
                $data_type = $db->fetchAll($sql);
                foreach ($data_type as $key => $value) {      
                    $data["activity_types_id"][$key] = $value->activity_types_id;
                }
//                Zend_Debug::dump($data);
                $form->populate($data);
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
                $model->delete($id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $_SESSION["supplier"]["id"];
            if ($id > 0) {
                $model = new Supplier_Model_Supplier();

                $this->view->supplier = $model->fetchEntry($id);
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
               
                $model = new Supplier_Model_Supplier();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->_redirector->gotoSimple('index', 'supplier', 'supplier');
        } else {

            $id =    $id = $this->_getParam('id', 0);
            if ($id > 0) {
                
                $model = new Supplier_Model_Supplier();
                
                $this->view->supplier = $model->fetchEntry($id);
            }
        }
    }
              
    public function outlitterAction() {
        
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {

                $id = $this->getRequest()->getPost('id');
                $model = new Supplier_Model_Supplier();

                $model->outLitter($id);
            }

            return $this->_helper->_redirector->gotoSimple('index', 'supplier', 'supplier');
        } else {
           
            $id =    $id = $this->_getParam('id', 0);

            if ($id > 0) {
                $model = new Supplier_Model_Supplier();

                $this->view->supplier = $model->fetchEntry($id);
            }
        }
    }

}
