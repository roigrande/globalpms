<?php

class Managementtype_ResourcetypeController extends Zend_Controller_Action {

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
        $model = new Managementtype_Model_Resourcetype();
        $data=$model->fetchEntries();
        
        //paginator
        $paginator = Zend_Paginator::factory($data);
        $managementtype = Zend_Registry::get('managementtype');
        $paginator->setItemCountPerPage($managementtype->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($managementtype->paginator);
        
        //send information to the view
        $this->view->title = "Resourcetypes list";
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Resourcetypes
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Resourcetype", 'APPEND');
        $request = $this->getRequest();
        $form = new Managementtype_Form_Resourcetype();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Managementtype_Model_Resourcetype();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Resourcetypes
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Resourcetypes";
        $form = new Managementtype_Form_Resourcetype();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Managementtype_Model_Resourcetype();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Managementtype_Model_Resourcetype();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Resourcetypes
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Managementtype_Model_Resourcetype();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Managementtype_Model_Resourcetype();

                $this->view->resourcetype= $model->fetchEntry($id);
            }
        }
    }

}
