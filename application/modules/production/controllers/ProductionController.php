<?php

class Production_ProductionController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {
        //get the page of the table 
        if (!isset($_SESSION["company"]["id"])) {
            
            return $this->_helper->_redirector->gotoSimple('index', 'index', 'index');
        };
            $page = $this->_getParam('page', 1);

            $this->production = new Zend_Session_Namespace('production');
            $this->production->id = null;
            $this->production->name = null;
            $this->production->client_company = null;
            $this->production->own_company = null;
            //$this->production->own_company_name = null;
            $this->production->activity_name = null;
            $this->production->activity_id = null;

            $this->gpms = new Zend_Session_Namespace('gpms');
            if ($this->gpms->storage->out_production == 0) {
                $this->gpms->storage->out_production = 1;
                $this->gpms->storage->role_id = $this->gpms->role_application;
                return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
            }

            //get the dates for the table of Productions
            $model = new Production_Model_Production();
            $data = $model->fetchProductions();

//        $_SESSION['gpms']['storage']->role_id = 1;
            //paginator
            if ($data) {
                $paginator = Zend_Paginator::factory($data);
                $production = Zend_Registry::get('production');
                $paginator->setItemCountPerPage($production->paginator);
                $paginator->setCurrentPageNumber($page);
                $paginator->setPageRange($production->paginator);
//            Zend_Debug::dump($_SESSION);
//            die();
                $this->view->paginator = $paginator;
            } else {
                $this->view->paginator = null;
            }
            //send information to the view
            $this->view->title = "Productions list";
       
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
        return $this->_helper->_redirector->gotoSimple('consult', 'production', 'production');
    }

    function consultAction() {
        //get the page of the table

        $this->production = new Zend_Session_Namespace('production');
        if ($this->production->id == null) {
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }
        $page = $this->_getParam('page', 1);

        //get the dates for the table
        $model = new Production_Model_Production();
        $data = $model->fetchEntryProduction();
        $this->production->client_company = $data["client_companies_id"];
        $this->production->own_company = $data["companies_id"];
        $this->production->own_company_name = $data["own_company_name"];
        $this->production->client_company_name = $data["client_company_name"];
        $this->view->production = $data;

        //send information to the view
        $this->view->title = "Production Consult";

        //get the dates for the table Activity
        $model = new Production_Model_Activity();

//        Zend_Debug::dump($_SESSION);
//               die();
        //TODO cambiar hardcode por roles que pueden verse
        if ($_SESSION['gpms']['role'] == "Encargado Actividad" OR $_SESSION['gpms']['role'] == "public") {

            $data_activities = $model->fetchOwnActivities();
        } else {

            $data_activities = $model->fetchActivities();
        }

        if ($data_activities) {
            $paginator = Zend_Paginator::factory($data_activities);
            $production = Zend_Registry::get('production');
            $paginator->setItemCountPerPage($production->paginator);
            $paginator->setCurrentPageNumber($page);
            $paginator->setPageRange($production->paginator);

            $this->view->paginator = $paginator;
        } else {
            $this->view->paginator = null;
        }

        //get the dates for permission
        $page = $this->_getParam('page', 1);

        //get the dates for the table
        $model_permission = new Production_Model_Permissionproduction();
        $data_permission = $model_permission->fetchUserPermissionproductions();

        //paginator
        if ($data) {
            $paginator2 = Zend_Paginator::factory($data_permission);
            $production = Zend_Registry::get('production');
            $paginator2->setItemCountPerPage($production->paginator);
            $paginator2->setCurrentPageNumber($page);
            $paginator2->setPageRange($production->paginator);


            $this->view->paginator2 = $paginator2;
        } else {
            $this->view->paginator = null;
        }
        //send information to the view
    }

    /**
     * AddAction for Productions
     *
     * @return void
     */
    public function addAction() {

        $this->view->headTitle("Add New Production", 'APPEND');
        $request = $this->getRequest();
        //form for a new production
        $production_form = new Production_Form_Production();

        //form for a new client
        $company_form = new Company_Form_Company();
        // check if there is a selection client
        $data_clients['client_companies_id'] = $this->_getParam('client_companies_id');
        $production_form->populate($data_clients);
 
        if ($this->getRequest()->isPost()) {
            $data_post = $request->getPost();
            if (isset($data_post["status_id"])) {
                if ($production_form->isValid($request->getPost())) {
                    $data_production = $production_form->getValues();
                    $model_production = new Production_Model_Production();
                    $id_production=$model_production->save($data_production); 
                    return $this->_helper->_redirector->gotoSimple('select', 'production', 'production', array('id' => $id_production));
                } else {
                    $production_form->populate($production_form->getValues());
                }
            } elseif ($company_form->isValid($request->getPost())) {
                $data_clients = $company_form->getValues();
              
                $model_company = new Company_Model_Company();
                $client_companies_id = $model_company->saveClient($data_clients);

                return $this->_helper->_redirector->gotoSimple('add', 'production', 'production', array('client_companies_id' => $client_companies_id));
            } else {
                $company_form->populate($company_form->getValues());
            }
        }
        
        $this->view->production_form = $production_form;

        $this->view->company_form = $company_form;
 
    }

    /**
     * EditAction for Productions
     *
     * @return void
     */
    public function editAction() {

        $this->production = new Zend_Session_Namespace('production');
        //check if its in one production
        if ($this->production->id == null) {
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }


//        $model= new User_Model_Permissions();
// 
//        if (!$model->isUserAllowed($this->gpms->storage->role_production, 'production:production', 'edit'))
//        {
//            echo ("no tiene permiso");
//        }
//        
//                die("holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
        $id = $_SESSION['production']['id'];
        $this->view->title = "Edit Productions";
        $form = new Production_Form_Production();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Production_Model_Production();
                $data = $form->getValues();

                unset($data["client_companies_id"]);
                $model->update($data, 'id = ' . (int) $id);
                return $this->_helper->_redirector->gotoSimple('consult', 'production', 'production');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {


            if ($id > 0) {

                $model = new Production_Model_Production();
                $data = $model->fetchEntry($id);
//                Zend_Debug::dump($data);
//                die();
                $form->populate($data);
            }
        }

        $form->removeElement('client_companies_id');

        $this->view->form = $form;
    }

    /**
     * deleteAction for Productions
     *
     * @return void
     */
    public function deleteAction() {
        //check if the user select a production
        $this->production = new Zend_Session_Namespace('production');
        if ($this->production->id == null) {
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }
        $id = $_SESSION['production']['id'];
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {

                $model = new Production_Model_Production();
                $model->delete($id);
                  return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
            }
            return $this->_helper->_redirector->gotoSimple('consult', 'production', 'production');
        } else {

            $id = $_SESSION['production']['id'];
            if ($id > 0) {
                $model = new Production_Model_Production();
                $this->view->production = $model->fetchEntry($id);
            }
        }
    }

    /**
     * inlitterAction for Productions
     *
     * @return void
     */
    public function inlitterAction() {

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {

                $model = new Production_Model_Production();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {


            if ($id > 0) {
                $model = new Production_Model_Production();

                $this->view->production = $model->fetchEntry($id);
            }
        }
    }

}
