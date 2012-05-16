<?php

class Managementtype_ManagementtypeController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {
        
        $models = new Managementtype_Model_Managementtype();
        $this->view->title = "Managementtypes list";
        $page = $this->_getParam('page', 1);
        $data_managementtype=$models->getTypes();
        
        $paginator = Zend_Paginator::factory($data_managementtype);
        
        $managementtype = Zend_Registry::get('managementtype');
        $paginator->setItemCountPerPage($managementtype->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($managementtype->paginator);
        $this->view->paginator = $paginator;
    }
    
     /**
     * selectAction for Productions
     *
     * @return void
     */
    public function selectAction() {

        $this->gpms = new Zend_Session_Namespace('gpms');
//        echo $this->gpms->storage->role_id;
//        echo $this->gpms->role_application;
//        Zend_Debug::dump($this->gpms->storage);
//        die();
        $this->gpms->storage->out_production = 1;
        $this->gpms->storage->role_id = $this->gpms->role_application;
//       

        return $this->_helper->_redirector->gotoSimple('index', 'managementtype', 'managementtype');
    }
    
    /**
     * AddAction for Managementtypes
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Managementtype", 'APPEND');
        $request = $this->getRequest();
        $form = new Managementtype_Form_Managementtype();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Managementtype_Model_Managementtype();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Managementtypes
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Managementtypes";
        $form = new Managementtype_Form_Managementtype();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Managementtype_Model_Managementtype();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Managementtype_Model_Managementtype();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Managementtypes
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Managementtype_Model_Managementtype();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Managementtype_Model_Managementtype();

                $this->view->managementtype = $model->fetchEntry($id);
            }
        }
    }

}
