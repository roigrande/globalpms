<?php

class Company_UserscompaniesController extends Zend_Controller_Action {

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
        $model = new Company_Model_Userscompanies();
        $data=$model->fetchUsersCompany($_SESSION["company"]["id"]);
        
        //paginator
        if ($data){
        $paginator = Zend_Paginator::factory($data);
        $company = Zend_Registry::get('company');
        $paginator->setItemCountPerPage($company->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($company->paginator);
        $this->view->paginator = $paginator;
        
        }else{$this->view->paginator = null;}
        //send information to the view
        $this->view->title = "Userscompanies list";
        
    }

    /**
     * AddAction for Userscompaniess
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New User", 'APPEND');
        $request = $this->getRequest();
        $form = new Company_Form_Userscompanies();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                //comprobar que el usuario existe
                $data=$form->getValues();
                $model_user = new User_Model_Users();
                
                if ($data_userscompanies["acl_users_id"]=$model_user->fetchUserByEmail($data['email'])){
                    $data_userscompanies["companies_id"]=$_SESSION["company"]["id"];
                    $model = new Company_Model_Userscompanies();                
                    //comprobar si ya existe en esa produccion
                    
//                     Zend_Debug::dump($data_userscompanies);
//                    die();
                    $model->save($data_userscompanies);
                }else{
                    //TODO enviar email
                }
//                 Zend_Debug::dump($data_userscompanies);
//                    die();
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

//    /**
//     * EditAction for Userscompaniess
//     *
//     * @return void
//     */
//    public function editAction() {
//     
//        $this->view->title = "Edit Userscompaniess";
//        $form = new Company_Form_Userscompanies();     
//        if ($this->getRequest()->isPost()) {
//            if ($form->isValid($this->getRequest()->getPost())) {
//                $model = new Company_Model_Userscompanies();
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
//                $model = new Company_Model_Userscompanies();
//                $data=$model->fetchEntry($id);
//                
//                $form->populate($data["0"]);
//                
//                
//            }
//        }
//        
//        $this->view->form = $form;
//    }

    /**
     * deleteAction for Userscompaniess
     *
     * @return void
     */
    public function deleteAction() {
//        if ($this->getRequest()->isPost()) {
//            $del = $this->getRequest()->getPost('del');
//            if ($del == 'Yes') {
                  $id = $this->_getParam('id', 0);
                $model = new Company_Model_Userscompanies();
            
                $model->delete($id,$_SESSION["company"]["id"]);
//            }
            return $this->_helper->redirector('index');
//        } else {
//
//            $id = $this->_getParam('id', 0);
//            if ($id > 0) {
//                $model = new Company_Model_Userscompanies();
//
//                $this->view->userscompanies= $model->fetchEntry($id);
//            }
//        }
    }
    
    /**
     * inlitterAction for Userscompaniess
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Company_Model_Userscompanies();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Company_Model_Userscompanies();

                $this->view->userscompanies = $model->fetchEntry($id);
            }
        }
    }

}
