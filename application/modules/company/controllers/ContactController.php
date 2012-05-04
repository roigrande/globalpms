<?php

class Company_ContactController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Company_Model_Contact();
        $this->view->title = "Contacts list";
        $page = $this->_getParam('page', 1);
        $company_id = $this->getRequest()->getParam('company_id');

        $paginator = Zend_Paginator::factory($models->fetchCompany($company_id));

        $contact = Zend_Registry::get('company');
        $paginator->setItemCountPerPage($contact->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($contact->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Contacts
     *
     * @return void
     */
    public function addAction() {
        if ($this->_request->isXmlHttpRequest()) {

            $this->_helper->viewRenderer->setNoRender(true);

            $this->_helper->layout->disableLayout();
        }
        //TODO comprobar que se pasa  la compañia a la que se quiere agregar
        $this->view->headTitle("Add New Contact", 'APPEND');
        $request = $this->getRequest();
        $form = new Company_Form_Contact();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Company_Model_Contact();
                $data = $form->getValues();
                $data["company_id"] = $request->getParam('company_id');
                // Zend_Debug::dump($data);
                $model->save($data);
                $model = new Company_Model_Owncompany();
                 
                    return $this->_helper->_redirector->gotoSimple('index', 'company', 'company');
             
                
            }
        } else {

            $data = $form->getValues();
            $data["company_id"] = $request->getParam('company_id');

            $form->populate($data);
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Contacts
     *
     * @return void
     */
    public function editAction() {


        $form = new Company_Form_Contact();
        // if isPost try to update the information of the form
        if ($this->getRequest()->isPost()) {

            //Check the validation of the form
            if ($form->isValid($this->getRequest()->getPost())) {

                //update  the datas of form
                $model = new Company_Model_Contact();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);

                //check Ajax
                if ($this->_request->isXmlHttpRequest()) {
                    $this->_helper->layout->disableLayout();
                    $data = $model->fetchEntry($id);
                    $this->_helper->viewRenderer('reloadrow');
                    $this->view->contact = $data;
                    return $data;
                } else {
                    //check if its ownCompany
                    $id = $this->_getParam('company_id', 0);
                    $model = new Company_Model_Owncompany();
                     return $this->_helper->_redirector->gotoSimple('index', 'company', 'company');
                }
            } else {
                //check if dont pass the validation of the form and its Ajax
                if ($this->_request->isXmlHttpRequest()) {

                    $this->_helper->layout->disableLayout();
                    $form->populate($this->getRequest()->getPost());
                    $form->submit->setOptions(array('onChange' => "javascript:getAjaxResponsePost('contact','http://globalpms.es/company/contact/edit/company_id/$company_id','iDformcontact'); return false;"));
                }

                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            $company_id = $this->_getParam('company_id', 0);

            if ($id > 0) {
                //check si es una peticion ajax
                if ($this->_request->isXmlHttpRequest()) {

                    $this->_helper->layout->disableLayout();
                    $form->submit->setOptions(array('onClick' => "javascript:getAjaxResponsePost('contact','http://globalpms.es/company/contact/edit/company_id/$company_id','iDformcontact'); return false;"));
                    // $this->_helper->viewRenderer->setNoRender(true);
                }
                $model = new Company_Model_Contact();
                $form->populate($model->fetchEntry($id));
            }
        }
        //$this->view->title = "Edit Contacts";
        $this->view->form = $form;
    }

    /**
     * deleteAction for Contacts
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $company_id = $this->getRequest()->getPost('company_id');
                $model = new Company_Model_Contact();
                $model->delete($id);
                
                $model = new Company_Model_Owncompany();
                
                if ($own_company = $model->fetchIsOwnCompany($company_id)) {
                   die("own");
                    return $this->_helper->_redirector->gotoSimple('edit', 'owncompany', 'company', array('own_company_id' => $own_company['id']));
                } else {
              
                    return $this->_helper->_redirector->gotoSimple('edit', 'company', 'company', array('company_id' => $company_id));
                }
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Company_Model_Contact();


                $this->view->contact = $model->fetchEntry($id);
            }
        }
    }

    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Company_Model_Contact();

                $model->inLitter('id = ' . (int) $id);
            }
            $company_id = $this->getRequest()->getPost('company_id');

            //check if its ownCompany
            $model = new Company_Model_Owncompany();
            if ($own_company = $model->fetchIsOwnCompany($company_id)) {

                return $this->_helper->_redirector->gotoSimple('edit', 'owncompany', 'company', array('own_company_id' => $own_company['id']));
            } else {
                return $this->_helper->_redirector->gotoSimple('edit', 'company', 'company', array('company_id' => $company_id));
            }
        } else {

            $id = $this->_getParam('id', 0);


            if ($id > 0) {
                $model = new Company_Model_Contact();

                $this->view->contact = $model->fetchEntry($id);
            }
        }
    }

}
