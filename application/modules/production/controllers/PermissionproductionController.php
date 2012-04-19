<?php

class Production_PermissionproductionController extends Zend_Controller_Action {

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
        $model = new Production_Model_Permissionproduction();
        $data=$model->fetchUserPermissionproductions();
        
        //paginator
        if ($data){
        $paginator = Zend_Paginator::factory($data);
        $production = Zend_Registry::get('production');
        $paginator->setItemCountPerPage($production->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($production->paginator);
        $this->view->paginator = $paginator;
        
        }else{$this->view->paginator = null;}
        //send information to the view
        $this->view->title = "Permissionproductions list";
        
    }

    /**
     * AddAction for Permissionproductions
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Permissionproduction", 'APPEND');
        $request = $this->getRequest();
        $form = new Production_Form_Permissionproduction();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Production_Model_Permissionproduction();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Permissionproductions
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Permissionproductions";
        $form = new Production_Form_Permissionproduction();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Production_Model_Permissionproduction();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
              return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Production_Model_Permissionproduction();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Permissionproductions
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Production_Model_Permissionproduction();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Production_Model_Permissionproduction();

                $this->view->permissionproduction= $model->fetchEntry($id);
            }
        }
    }
    
    /**
     * inlitterAction for Permissionproductions
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Production_Model_Permissionproduction();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Production_Model_Permissionproduction();

                $this->view->permissionproduction = $model->fetchEntry($id);
            }
        }
    }

}
