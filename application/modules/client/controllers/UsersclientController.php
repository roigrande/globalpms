<?php

class Client_UsersclientController extends Zend_Controller_Action {

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
        $model = new Client_Model_Usersclient();
        $data=$model->fetchEntriesClient($_SESSION["client"]["id"]);
        
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
        $this->view->title = "Usersclients list";
        
    }

    /**
     * AddAction for Usersclients
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Usersclient", 'APPEND');
        $request = $this->getRequest();
        $form = new Client_Form_Usersclient();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
            
               
                $data=$form->getValues();
                $model_user = new User_Model_Users();
                if ($data_usersclients["acl_users_id"]=$model_user->fetchUserByEmail($data['email'])){
                    $data_usersclients["companies_id"]=$_SESSION["client"]["id"];
                  $model = new Client_Model_Usersclient();             
                    //comprobar si ya existe en esa produccion

    //                     Zend_Debug::dump($data_userscompanies);
    //                    die();
                    $model->save($data_usersclients);
                }else{
                    //TODO enviar email
                }
                
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

//    /**
//     * EditAction for Usersclients
//     *
//     * @return void
//     */
//    public function editAction() {
//        $this->view->title = "Edit Usersclients";
//        $form = new Client_Form_Usersclient();     
//        if ($this->getRequest()->isPost()) {
//            if ($form->isValid($this->getRequest()->getPost())) {
//                $model = new Client_Model_Usersclient();
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
//                $model = new Client_Model_Usersclient();
//                $form->populate($model->fetchEntry($id));
//            }
//        }
//        $this->view->form = $form;
//    }

    /**
     * deleteAction for Usersclients
     *
     * @return void
     */
    public function deleteAction() {
               $id = $this->_getParam('id', 0);
                $model = new Client_Model_Usersclient();
            
                $model->delete($id,$_SESSION['client']["id"]);
//            }
            return $this->_helper->redirector('index');
    }
    
//    /**
//     * inlitterAction for Usersclients
//     *
//     * @return void
//     */
//    
//    public function inlitterAction() {
//        if ($this->getRequest()->isPost()) {
//            $del = $this->getRequest()->getPost('del');
//            if ($del == 'Yes') {
//                $id = $this->getRequest()->getPost('id');
//                $model = new Client_Model_Usersclient();
//                $model->inLitter('id = ' . (int) $id);
//            }
//            return $this->_helper->redirector('index');
//        } else {
//
//            $id = $this->_getParam('id', 0);
//            if ($id > 0) {
//                $model = new Client_Model_Usersclient();
//
//                $this->view->usersclient = $model->fetchEntry($id);
//            }
//        }
//     }

}
