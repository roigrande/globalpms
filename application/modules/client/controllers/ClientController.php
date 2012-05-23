<?php

class Client_ClientController extends Zend_Controller_Action {

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
        $model = new Client_Model_Client();
        $data=$model->fetchEntries();
        
        //paginator
        if ($data){
        $paginator = Zend_Paginator::factory($data);
        $client = Zend_Registry::get('client');
        $paginator->setItemCountPerPage($client->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($client->paginator);
        $this->view->paginator = $paginator;
        
        }else{$this->view->paginator = null;}
        //send information to the view
        $this->view->title = "Clients list";
        
    }

       public function selectAction() {

        $id = $this->_getParam('id', 0);

//      //se comprueba que el usuario tiene permiso para esa produccion
        //se comprueba que el usuario tiene permiso para esa accion hecho
        $model_client = new Client_Model_Client();
        if (!$model_client->isUserAllowedClient($id)) {
            echo "no tiene acceso a este cliente ";
            die();
            return $this->_helper->_redirector->gotoSimple('index', 'client', 'client');
        };
//
//        $model = new Production_Model_Production();
//        $production = $model->fetchEntry($id);
        Zend_Debug::dump($_SESSION);
        $this->client = new Zend_Session_Namespace('client');
        $this->client->id = $id;
       
        return $this->_helper->_redirector->gotoSimple('consult', 'client', 'client');
    }
    
    public function consultAction(){
         $this->client= new Zend_Session_Namespace('client');
        if ($this->client->id==null){
            return $this->_helper->_redirector->gotoSimple('consult', 'client', 'client');
        }
        
        $page = $this->_getParam('page', 1);
        $models = new Client_Model_Contact();
        $paginator = Zend_Paginator::factory($models->fetchClient($this->client->id));
        $contact = Zend_Registry::get('client');
        $paginator->setItemCountPerPage($contact->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($contact->paginator);
        $this->view->paginator = $paginator;
                
        //get the dates for the table
        $model = new Client_Model_Client();
        $select_client= $model->fetchEntry($_SESSION["client"]["id"]);
        //Zend_Debug::dump($select_client);
        $this->view->select_client = $select_client;
        //send information to the view
        $this->view->title = "Production Consult";
    
    }
    /**
     * AddAction for Clients
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Client", 'APPEND');
        $request = $this->getRequest();
        $form = new Client_Form_Client();

        if ($this->getRequest()->isPost()) {
            
            if ($form->isValid($request->getPost())) {
                  //check Ajax
                if ($this->_request->isXmlHttpRequest()) {
                    $this->_helper->layout->disableLayout();
                    $data = $model->fetchEntry($id);
                    $this->_helper->viewRenderer('reloadrow');
                    $this->view->contact = $data;
                    return $data;
                }
                $model = new Client_Model_Client();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            
            $data = $form->getValues();
              if ($this->_request->isXmlHttpRequest()) {
                    $this->_helper->layout->disableLayout();
                    $form->submit->setOptions(array('onClick' => "javascript:getAjaxResponsePost2('client','http://globalpms.es/client/client/add/','iDformcontact'); return false;"));
                    // $this->_helper->viewRenderer->setNoRender(true);
                }
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Clients
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Clients";
        $form = new Client_Form_Client();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Client_Model_Client();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('consult');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {
            $id = $_SESSION["client"]["id"];
            if ($id > 0) {
               $model = new Client_Model_Client();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Clients
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Client_Model_Client();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Client_Model_Client();

                $this->view->client= $model->fetchEntry($id);
            }
        }
    }
    
    /**
     * inlitterAction for Clients
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Client_Model_Client();
                $model->inLitter('id = ' . (int) $id);
            }
          return $this->_helper->_redirector->gotoSimple('consult', 'client', 'client');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Client_Model_Client();

                $this->view->client = $model->fetchEntry($id);
            }
        }
    }

}
