<?php

class Production_IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Production_Model_Productions();
        $this->view->title = "Production list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchEntries());
        $production = Zend_Registry::get('production');
        $paginator->setItemCountPerPage($production->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($production->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Users
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Production", 'APPEND');
        $request = $this->getRequest();
        $form = new Production_Form_Production();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
               
                $model = new Production_Model_Productions();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Users
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Productions";
        $form = new Production_Form_Production();
//        $form->submit->setLabel('Save');
//        $form->removeElement('password');
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Production_Model_Productions();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Production_Model_Productions();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Users
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Production_Model_Productions();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Production_Model_Productions();

                $this->view->production= $model->fetchEntry($id);
            }
        }
    }

}
