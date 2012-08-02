<?php

class Company_CompanyController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {
        $this->company= new Zend_Session_Namespace('company');
        if ($this->company->id==null){
            return $this->_helper->_redirector->gotoSimple('index', 'index', 'default');
        }
         $this->gpms = new Zend_Session_Namespace('gpms');
//        echo $this->gpms->storage->role_id;
//        echo $this->gpms->role_application;
//        Zend_Debug::dump($this->gpms->storage);
//        die();
        $this->gpms->storage->out_production = 1;
        $this->gpms->storage->role_id = $this->gpms->role_application;
//       

        return $this->_helper->_redirector->gotoSimple('consult', 'company', 'company');
        
    }

//    /**
//     * selectAction for Productions
//     *
//     * @return void
//     */
//    public function selectAction() {
//
//        $this->gpms = new Zend_Session_Namespace('gpms');
////        echo $this->gpms->storage->role_id;
////        echo $this->gpms->role_application;
////        Zend_Debug::dump($this->gpms->storage);
////        die();
//        $this->gpms->storage->out_production = 1;
//        $this->gpms->storage->role_id = $this->gpms->role_application;
////       
//
//        return $this->_helper->_redirector->gotoSimple('index', 'company', 'company');
//    }
    
    function consultAction() {
      
        //get the page of the table
      
       $this->gpms= new Zend_Session_Namespace('gpms');
        if($this->gpms->storage->out_production ==0){
              return $this->_helper->_redirector->gotoSimple('index', 'company', 'company');
        }
//         die();  
        $this->company= new Zend_Session_Namespace('company');
        $page = $this->_getParam('page', 1);
        $models = new Company_Model_Contact();
        $paginator = Zend_Paginator::factory($models->fetchCompany($this->company->id));
        $contact = Zend_Registry::get('company');
        $paginator->setItemCountPerPage($contact->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($contact->paginator);
        $this->view->paginator = $paginator;
                
        //get the dates for the table
        $model = new Company_Model_Company();
        $select_company= $model->fetchEntry($_SESSION["company"]["id"]);
        $this->view->select_company = $select_company;
        //send information to the view
        $this->view->title = "Production Consult";
    }

    /**
     * AddAction for Companys
     *
     * @return void
     */
    public function addAction() {
        $this->gpms = new Zend_Session_Namespace('gpms');
        
        if ($this->gpms->storage->out_production == 0) {
            return $this->_helper->_redirector->gotoSimple('index', 'company', 'company');
        }
//        
//        echo $this->gpms->storage->out_production;
//        die();
        $this->view->headTitle("Add New Company", 'APPEND');
        $request = $this->getRequest();
        $form = new Company_Form_Company();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Company_Model_Company();
                $model->save($form->getValues());
                return $this->_helper->redirector('index','company','company');
            }
        } else {

            //    Zend_Debug::dump($form->getValues(),"datos por get");
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Companys
     *
     * @return void
     */
    public function editAction() {
        
        if ($this->gpms->storage->out_production == 0) {
            return $this->_helper->_redirector->gotoSimple('index', 'company', 'company');
        }
        $this->view->title = "Edit Company";
        $form = new Company_Form_Company();
        //get the dates for the table
        $model = new Company_Model_Company();
        $select_company= $model->fetchEntry($_SESSION["company"]["id"]);
        $this->view->select_company = $select_company;
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Company_Model_Company();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $_SESSION["company"]["id"];
            if ($id > 0) {
                
                $model = new Company_Model_Company();
                $form->populate($model->fetchEntry($id));
            }
        }

        $this->view->form = $form;
    }
    
//    public function editclientAction() {
//        $this->view->title = "Edit Companies";
//        //
//        $form = new Company_Form_Company();
// 
//        if ($this->getRequest()->isPost()) {
//            if ($form->isValid($this->getRequest()->getPost())) {
//                $model = new Company_Model_Company();
//                $id = $this->getRequest()->getPost('id');
//                $model->update($form->getValues(), 'id = ' . (int) $id);
//                return $this->_helper->redirector('index');
//            } else {
//                $form->populate($this->getRequest()->getPost());
//            }
//        } else {
//
//            $id = $this->_getParam('company_id', 0);
//            if ($id > 0) {
//                $page = $this->_getParam('page', 1);
//                $models = new Company_Model_Contact();
//                $paginator = Zend_Paginator::factory($models->fetchCompany($id));
//                $contact = Zend_Registry::get('company');
//                $paginator->setItemCountPerPage($contact->paginator);
//                $paginator->setCurrentPageNumber($page);
//                $paginator->setPageRange($contact->paginator);
//                $this->view->paginator = $paginator;
//                $model = new Company_Model_Company();
//                $form->populate($model->fetchEntry($id));
//            }
//        }
//
//        $this->view->form = $form;
//    }
    /**
     * deleteAction for Companys
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Company_Model_Company();
                $model->delete($id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('company_id', 0);
            if ($id > 0) {
                $model = new Company_Model_Company();
                $data = $model->fetchEntry($id);
                $model_production = new Production_Model_Production();
                $this->view->company = $data;
                //TODO comprobar si tiene resources
                //TODO comprobar si tiene contacts
            }
        }
    }

    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {

            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {

                $id = $this->getRequest()->getPost('id');
                $model = new Company_Model_Company();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);

            if ($id > 0) {
                $model = new Company_Model_Company();

                $this->view->company = $model->fetchEntry($id);
            }
        }
    }

    public function outlitterAction() {

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {

                $id = $this->getRequest()->getPost('id');
                $model = new Company_Model_Company();

                $model->outLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);

            if ($id > 0) {
                $model = new Company_Model_Company();

                $this->view->company = $model->fetchEntry($id);
            }
        }
    }

}
