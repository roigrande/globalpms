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

    public function editajaxAction() {
        $this->view->title = "Edit ajax Contacts";

         // action body
 $this->_helper->layout->disableLayout();
 $this->_helper->viewRenderer->setNoRender();
 

 
        $this->_helper->layout->disableLayout();
        $form = new Company_Form_Contact();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Company_Model_Contact();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
//                echo $this->getRequest()->getParam('company_id');
//                die(); 
                $data= $model->fetchEntry($id);  
                Zend_Debug::dump($data);
              return $data;  
//                return $this->getAjaxResponse($form, 'http://globalpms.es/company/company/company_id/' . $this->_getParam('company_id', 0), 'strcontainer');
//                return $this->_helper->_redirector->gotoSimple('edit', 'company', 'company', array('company_id' => $this->_getParam('company_id', 0)));
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Company_Model_Contact();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
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
                 Zend_Debug::dump($data);
                $lastid = $model->save($data);
                echo $lastid;

                return $this->_helper->_redirector->gotoSimple('edit', 'company', 'company', array('company_id' => $this->_getParam('company_id', 0)));
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
        
//        die(caca);
//          if ($this->_request->isXmlHttpRequest()) {
//
//            $this->_helper->viewRenderer->setNoRender(true);
//
//            $this->_helper->layout->disableLayout();
//            //die ("caca");
//        }
        $this->view->title = "Edit Contacts";

        if ($this->_getParam('ajaxwindow', 0)) {

//$this->_helper->viewRenderer->setNoRender(true);
            $this->_helper->layout->disableLayout();
        }
         
        $form = new Company_Form_Contact();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Company_Model_Contact();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                if ($this->_getParam('ajaxwindow', 0)) {
//                    getAjaxResponsePost("contact", strurl, )
                    return $this->_helper->_redirector->gotoSimple('confirm', 'contact', 'company', array('company_id' => $this->_getParam('company_id', 0)));
                }
                return $this->_helper->_redirector->gotoSimple('edit', 'company', 'company', array('company_id' => $this->_getParam('company_id', 0)));
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Company_Model_Contact();
                $form->populate($model->fetchEntry($id));
 
//              $form->removeElement('submit');
//                $b = new Zend_Form_Element_Button('submitcontact');
//                $b->setValue('foo');
//                $form->addElement($b);
//                $form->submitcontact->setOptions(array('onClick'=>'javascript:getAjaxResponsePost("contact","http://globalpms.es/company/contact/editajax/company_id/25","rowcontact3"); return false;'));
                $form->submit->setOptions(array('onClick'=>'javascript:getAjaxResponsePost("contact","http://globalpms.es/company/contact/editajax/company_id/25","rowcontact3"); return false;'));
            
            //      $form->submit->setOptions(array('onChange'=>'javascript:getAjaxResponsePost("contact","http://globalpms.es/company/company/edit/company_id/25","rowcontact"); return false;'));
                //$form->submit->setOptions(array('onChange'=>'javascript:getAjaxResponse("/hotels/index/search/rooms/"+this.value,"roomy");'));
            }
        }
        $this->view->form = $form;
    }

    public function confirmAction() {
        $this->view->title = "Confirm Contacts";
        $this->_helper->layout->disableLayout();
        $form = new Company_Form_Contact();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $this->view->headScript()->appendFile($this->view->baseUrl('/scripts/ajax_functions.js'));
            }
        }
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
                $model = new Company_Model_Contact();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index', 'company', 'company');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Company_Model_Contact();

                $this->view->contact = $model->fetchEntry($id);
            }
        }
    }

}
