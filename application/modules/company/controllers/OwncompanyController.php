<?php

class Company_OwncompanyController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Company_Model_Owncompany();
        $this->view->title = "Own companies list";
        $page = $this->_getParam('page', 1);

        $paginator = Zend_Paginator::factory($models->fetchSql());
        $company = Zend_Registry::get('company');
        $paginator->setItemCountPerPage($company->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($company->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Owncompanies
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Owncompany", 'APPEND');
        $request = $this->getRequest();
        $form = new Company_Form_Owncompany();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Company_Model_Owncompany();
                $model_company = new Company_Model_Company();
                $company = $form->getValues();
                $company['company_id'] = $model_company->save($company);

                $model->save($company);
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Owncompanies
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Own companies";
        $form = new Company_Form_Owncompany();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Company_Model_Owncompany();
                $id = $this->getRequest()->getPost('id');
                $company = $form->getValues();
//                Zend_Debug::dump($company, "company");
//                die($id);
                $model->update($company, 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('own_company_id', 0);


            if ($id > 0) {
                //Get the contacs of the own company
                $page = $this->_getParam('page', 1);
                $models = new Company_Model_Contact();
                $paginator = Zend_Paginator::factory($models->fetchCompany($id));
                $contact = Zend_Registry::get('company');
                $paginator->setItemCountPerPage($contact->paginator);
                $paginator->setCurrentPageNumber($page);
                $paginator->setPageRange($contact->paginator);
                $this->view->paginator = $paginator;
                
                $model = new Company_Model_Owncompany();
                $data_own_company = $model->fetchEntry($id);
                $form->populate($data_own_company);
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Owncompanies
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $company_id = $this->getRequest()->getPost('company_id');
                $model = new Company_Model_Owncompany();
                $model->delete($id,$company_id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('own_company_id', 0);
            if ($id > 0) {
                $model = new Company_Model_Owncompany();
                $data =$model->fetchEntry($id);
                $this->view->owncompany = $data;
                //TODO comprobar si tiene resources
                
            }
        }
    }


}
