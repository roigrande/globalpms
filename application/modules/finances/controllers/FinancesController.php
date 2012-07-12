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

//        //get the dates for the table
//        $model = new Production_Model_Production();
//        $data = $model->fetchEntryProduction();
//        $this->production->client_company = $data["client_companies_id"];
//        $this->production->own_company = $data["companies_id"];
//        $this->production->own_company_name = $data["own_company_name"];
//        $this->production->client_company_name = $data["client_company_name"];
//        $this->view->production = $data;
//
//        //send information to the view
//        $this->view->title = "Production Consult";
//
//        //get the dates for the table Activity
//        $model = new Production_Model_Activity();
//
////        Zend_Debug::dump($_SESSION);
////               die();
//        //TODO cambiar hardcode por roles que pueden verse
//        if ($_SESSION['gpms']['role'] == "Encargado Actividad" OR $_SESSION['gpms']['role'] == "public") {
//
//            $data_activities = $model->fetchOwnActivities();
//        } else {
//
//            $data_activities = $model->fetchActivities();
//        }
//
//        if ($data_activities) {
//            $paginator = Zend_Paginator::factory($data_activities);
//            $production = Zend_Registry::get('production');
//            $paginator->setItemCountPerPage($production->paginator);
//            $paginator->setCurrentPageNumber($page);
//            $paginator->setPageRange($production->paginator);
//
//            $this->view->paginator = $paginator;
//        } else {
//            $this->view->paginator = null;
//        }
//
//        //get the dates for permission
//        $page = $this->_getParam('page', 1);
//
//        //get the dates for the table
//        $model_permission = new Production_Model_Permissionproduction();
//        $data_permission = $model_permission->fetchUserPermissionproductions();
//
//        //paginator
//        if ($data) {
//            $paginator2 = Zend_Paginator::factory($data_permission);
//            $production = Zend_Registry::get('production');
//            $paginator2->setItemCountPerPage($production->paginator);
//            $paginator2->setCurrentPageNumber($page);
//            $paginator2->setPageRange($production->paginator);
//
//
//            $this->view->paginator2 = $paginator2;
//        } else {
//            $this->view->paginator = null;
//        }
        //send information to the view
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
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Finances_Model_Finances();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Finances_Model_Finances();

                $this->view->finances = $model->fetchEntry($id);
            }
        }
    }

}
