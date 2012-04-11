<?php

class Resource_ResourceController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Resource_Model_Resource();
        $this->view->title = "Resources list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchSql());

        $resource = Zend_Registry::get('resource');
        $paginator->setItemCountPerPage($resource->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($resource->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Resources
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Resource", 'APPEND');
        $request = $this->getRequest();
        $form = new Resource_Form_Resource();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Resource_Model_Resource();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Resources
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Resources";
        $form = new Resource_Form_Resource();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Resource_Model_Resource();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Resource_Model_Resource();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Resources
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Resource_Model_Resource();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Resource_Model_Resource();

                $this->view->resource = $model->fetchEntry($id);
            }
        }
    }

}
