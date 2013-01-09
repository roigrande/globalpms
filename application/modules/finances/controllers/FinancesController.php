<?php

class Finances_FinancesController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {
// 
//        //get the page of the table 
//        if (!isset($_SESSION["company"]["id"])) {
//            
//            return $this->_helper->_redirector->gotoSimple('index', 'index', 'index');
//        };
//            $page = $this->_getParam('page', 1);
//
//            $this->production = new Zend_Session_Namespace('production');
//            $this->production->id = null;
//            $this->production->name = null;
//            $this->production->client_company = null;
//            $this->production->own_company = null;
//            //$this->production->own_company_name = null;
//            $this->production->activity_name = null;
//            $this->production->activity_id = null;
//
//            $this->gpms = new Zend_Session_Namespace('gpms');
//            if ($this->gpms->storage->out_production == 0) {
//                $this->gpms->storage->out_production = 1;
//                $this->gpms->storage->role_id = $this->gpms->role_application;
//                return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
//            }
//
//            //get the dates for the table of Productions
//            $model = new Production_Model_Production();
//            $data = $model->fetchProductions();
//
////        $_SESSION['gpms']['storage']->role_id = 1;
//            //paginator
//            if ($data) {
//                $paginator = Zend_Paginator::factory($data);
//                $production = Zend_Registry::get('production');
//                $paginator->setItemCountPerPage($production->paginator);
//                $paginator->setCurrentPageNumber($page);
//                $paginator->setPageRange($production->paginator);
////            Zend_Debug::dump($_SESSION);
////            die();
//                $this->view->paginator = $paginator;
//            } else {
//                $this->view->paginator = null;
//            }
//            //send information to the view
//            $this->view->title = "Productions list";
    }

    /**
     * deleteAction for Productions
     *
     * @return void
     */
    public function selectAction() {


        $id = $this->_getParam('id', 0);

//      //se comprueba que el usuario tiene permiso para esa produccion
        //se comprueba que el usuario tiene permiso para esa accion hecho
        $model_permission_production = new Production_Model_Permissionproduction();
        if (!$model_permission_production->isUserAllowedProduccition($id)) {
            echo "no tiene acceso a la produccion " . $production["name"];

            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        };

        $model = new Production_Model_Production();
        $production = $model->fetchEntry($id);

        $this->production = new Zend_Session_Namespace('production');
        $this->production->id = $id;

        $this->production->name = $production["name"];
        $this->production->activity_users = null;
        $this->production->activity = null;
        return $this->_helper->_redirector->gotoSimple('consult', 'finances', 'finances');
    }

    function consultAction() {
        //get the page of the table

        $this->production = new Zend_Session_Namespace('production');
        if ($this->production->id == null) {
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }
        $page = $this->_getParam('page', 1);
//        $model_resource_activities = new Finances_Model_Resourceactivityhasreceipt();
        $model_resource_activities = new Production_Model_Resource();

        $model_receipts = new Finances_Model_Receipts();
        $data = $model_receipts->fetchProductionHasOpenReceipt($this->production->id);
        //        Zend_Debug::dump($data,"receipt");
        $sql = "SELECT id,name
                  FROM facturation_types";
        $db = Zend_Registry::get('db');
        $ec= $db->fetchPairs($sql);
        
        $this->view->iva_type = $db->fetchPairs($sql);
        
        $data_resource_activities = $model_resource_activities->fetchEntriesProduction($this->production->id);
//       Zend_Debug::dump($data_resource_activities);
//       die();
        if ($data_resource_activities) {
            $paginator = Zend_Paginator::factory($data_resource_activities);
            $finances = Zend_Registry::get('finances');
            $paginator->setItemCountPerPage($finances->paginator);
            $paginator->setCurrentPageNumber($page);
            $paginator->setPageRange($finances->paginator);
            $this->view->paginator = $paginator;
        } else {
            $this->view->paginator = null;
        }

        //get the dates for permission
        $page = $this->_getParam('page', 1);
    }

    /**
     * AddAction for Receipt
     *
     * @return void
     */
    public function addreceiptAction() {
        
        if ($this->_request->isXmlHttpRequest()) {

            $this->_helper->viewRenderer->setNoRender(true);

            $this->_helper->layout->disableLayout();
        }
       
        $id = $this->_getParam('id', 10);
        $price = $this->_getParam('price', 0);
        $facturation_type = $this->_getParam('facturation_type', 32);
        
//        Zend_Debug::dump($price,"facturation_type");
//        Zend_Debug::dump($facturation_type,"facturation_type");
//        die();
        if ($id==0) {
            return $this->_helper->_redirector->gotoSimple('consult', 'finances', 'finances');
        }
       
        $model_resource_activity_has_receipt = new Finances_Model_Resourceactivityhasreceipt();
        // Comprobar que no esta añadido en el recibo
        $receipt_id = $model_resource_activity_has_receipt->fetchEntryActivityResource($id);
        
        
        if ($receipt_id != null) {
            return $this->_helper->_redirector->gotoSimple('consult', 'finances', 'finances');
        }
        
        // Comprobar que los campos de : tipo de facturación, precio estan rellenados

        $model_receipt = new Finances_Model_Receipts();

        
        $data_receipt = $model_receipt->fetchProductionHasOpenReceipt($_SESSION["production"]["id"]);
        
        $receipt_id = $data_receipt["id"];
        // Comprobar que no hay ningun recibo abierto en la produccion
        if (!$receipt_id) {
            // Si no lo hay introducir crear un recibo
            $receipt_id = $model_receipt->save($id);
        }

        $model_activity_resource = new Production_Model_Resource();
        $data_activity_resource["iva_type"] = $model_activity_resource->fetchIvaType($id);
        $data_activity_resource["receipts_id"] = $receipt_id;
        $data_activity_resource["resources_activities_id"] = $id;
        $data_activity_resource["price"] = (int)$price;
        $data_activity_resource["facturation_types_id"] = (int)$facturation_type;
        $data_activity_resource["quantity"] = $model_activity_resource->fetchQuantity($id);

        $data_activity_resource["final_price"]=$model_resource_activity_has_receipt->calculateFinalPrice($data_activity_resource["resources_activities_id"],$data_activity_resource["price"],$data_activity_resource["facturation_types_id"],$data_activity_resource["quantity"]);
        $data_actitity_resource["id"]=$model_resource_activity_has_receipt->save($data_activity_resource);
         
        $json = Zend_Json::encode($model_resource_activity_has_receipt->fetchEntry( $data_actitity_resource["id"]));
         echo $json;
//        return $this->_helper->_redirector->gotoSimple('consult', 'finances', 'finances');
    }

    /**
     * AddAction for Financess
     *
     * @return void
     */
    public function addFacturationAjaxAction() {

        $id = $this->_getParam('id', 0);

        $model_resource_activity_has_receipt = new Finances_Model_Resource_activity_has_receipt();
        die($id);
        $model_resource_activity_has_receipt->fetch();

        $model_resource_activity_has_receipt->save();
//        $this->view->headTitle("Add New Finances", 'APPEND');
//        $request = $this->getRequest();
//        $form = new Finances_Form_Finances();
//
//        if ($this->getRequest()->isPost()) {
//            if ($form->isValid($request->getPost())) {
//                $model = new Finances_Model_Finances();
//                $model->save($form->getValues());
//                return $this->_helper->redirector('index');
//            }
//        } else {
//            $form->populate($form->getValues());
//        }
        $form->submit->setOptions(array('onChange' => "javascript:getAjaxResponsePost('contact','http://globalpms.es/company/contact/edit/company_id/$company_id','iDformcontact'); return false;"));
        $this->view->form = $form;
    }

    /**
     * AddAction for Financess
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Finances", 'APPEND');
        $request = $this->getRequest();
        $form = new Finances_Form_Finances();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Finances_Model_Finances();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Financess
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Financess";
        $form = new Finances_Form_Finances();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Finances_Model_Finances();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Finances_Model_Finances();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Financess
     *
     * @return void
     */
    public function deleteAction() {
    
          $id = $this->_getParam('id', 0);
       if ($id > 0) {
            
          $model_resource_activity_has_receipt = new Finances_Model_Resourceactivityhasreceipt();
//           $data_activity_resource["final_price"]=$model_resource_activity_has_receipt->calculateFinalPrice($data_activity_resource["resources_activities_id"],$data_activity_resource["price"],$data_activity_resource["iva_type"],$data_activity_resource["facturation_types_id"]);
        $model_resource_activity_has_receipt->delete('id= '.$id);
        }
        return $this->_helper->redirector->gotoSimple('consult', 'finances', 'finances');
    
    }

    /**
     * deleteAction for Financess
     *
     * @return void
     */
    
    public function deletereceiptAction() {
       die();
       $id = $this->_getParam('id', 0);
       if ($id > 0) {
            
          $model_resource_activity_has_receipt = new Finances_Model_Resourceactivityhasreceipt();
//           $data_activity_resource["final_price"]=$model_resource_activity_has_receipt->calculateFinalPrice($data_activity_resource["resources_activities_id"],$data_activity_resource["price"],$data_activity_resource["iva_type"],$data_activity_resource["facturation_types_id"]);
        $model_resource_activity_has_receipt->delete('resources_activities_id= '.$id);
        }
        return $this->_helper->redirector->gotoSimple('consult', 'finances', 'finances');
    }

}
