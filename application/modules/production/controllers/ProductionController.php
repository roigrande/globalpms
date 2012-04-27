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
        
        $page = $this->_getParam('page', 1);
        $this->gpms = new Zend_Session_Namespace('gpms');
        if($this->gpms->storage->out_production==0){
            $this->gpms->storage->out_production=1;
            $this->gpms->storage->role_id=$this->gpms->role_application;

            $this->production = new Zend_Session_Namespace('production');
            $this->production->id= null;
            $this->production->name= null;
            $this->production->client_company= null;
            $this->production->own_company= null;
            $this->production->activity = null;
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }
        //get the dates for the table
        $model = new Production_Model_Production();
        $data = $model->fetchProductions();
        
        $this->gpms->storage->out_production=1;
        $this->gpms->storage->role_id=$this->gpms->role_application;
       
        $this->production = new Zend_Session_Namespace('production');
        $this->production->id= null;
        $this->production->name= null;
        $this->production->client_company= null;
        $this->production->own_company= null;
        $this->production->activity = null;
//        $_SESSION['gpms']['storage']->role_id = 1;
        //paginator
        if ($data) {
            $paginator = Zend_Paginator::factory($data);
            $production = Zend_Registry::get('production');
            $paginator->setItemCountPerPage($production->paginator);
            $paginator->setCurrentPageNumber($page);
            $paginator->setPageRange($production->paginator);
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
        $this->production->id= $id;
        $this->production->name= $production["name"];
        $this->production->client_company= $production["client_companies_id"];
        $this->production->own_company= $production["own_companies_id"];
        $this->production->activity_users=null;
        $this->production->activity=null;
        return $this->_helper->_redirector->gotoSimple('consult', 'production', 'production');
    }

    function consultAction() {
        //get the page of the table
        $this->production= new Zend_Session_Namespace('production');
        if ($this->production->id==null){
           
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }
        $page = $this->_getParam('page', 1);

        //get the dates for the table
        $model = new Production_Model_Production();
        $data = $model->fetchEntryProduction();
        $this->view->production = $data;
        //send information to the view
        $this->view->title = "Production Consult";
    }

    /**
     * AddAction for Productions
     *
     * @return void
     */
    public function addAction() {
        
        $this->view->headTitle("Add New Production", 'APPEND');
        $request = $this->getRequest();
        $form = new Production_Form_Production();

        if ($this->getRequest()->isPost()) {

            if ($form->isValid($request->getPost())) {

                $model = new Production_Model_Production();
                $data = $form->getValues();

                $_SESSION["production"]["id"]=$model->save($data);
                $data_permission_production["acl_roles_id"]=$_SESSION['gpms']['storage']->role_id;
                $data_permission_production["acl_users_id"]=$_SESSION['gpms']['storage']->id;
                
                $model_permission_production = new Production_Model_Permissionproduction;
                $model_permission_production->save($data_permission_production);
                return $this->_helper->_redirector->gotoSimple('select', 'production', 'production', array('id' => $_SESSION["production"]["id"]));
               
            }
        } else {

            $data = $form->getValues();
            $data["client_company_id"] = $this->_getParam('company_id', 0);
//            //TODO para poner por defecto el status
//            $production = Zend_Registry::get('production');
//            $data["status_id"] = $production->status_default;
//            $data["status_id"] = "26";
            $form->populate($data);
            //  $form->removeElement('status_id');
        }

        $this->view->form = $form;
    }

    /**
     * EditAction for Productions
     *
     * @return void
     */
    public function editAction() {
        
        $this->production= new Zend_Session_Namespace('production');
        if ($this->production->id==null){
           
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }
        
        $this->production= new Zend_Session_Namespace('production');
        //check if its in one production
        if ($this->production->id==null){           
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }
        $this->gpms = new Zend_Session_Namespace('gpms');
        $this->gpms->storage->role_production_name  ;
            Zend_Debug::dump($this->gpms->storage->role_production_name,"name_production");
            echo "adios";
            
//        $model= new User_Model_Permissions();
// 
//        if (!$model->isUserAllowed($this->gpms->storage->role_production, 'production:production', 'edit'))
//        {
//            echo ("no tiene permiso");
//        }
//        
//                die("holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
        $id=$_SESSION['production']['id'];
        $this->view->title = "Edit Productions";
        $form = new Production_Form_Production();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Production_Model_Production();
               
                $data = $form->getValues();
                unset($data["own_companies_id"]);
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
        $form->removeElement('own_companies_id');
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
        $this->production= new Zend_Session_Namespace('production');
        if ($this->production->id==null){          
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }
        $id=$_SESSION['production']['id'];
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                
                $model = new Production_Model_Production();
                $model->delete($id);
            }
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        } else {

            $id=$_SESSION['production']['id'];
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
