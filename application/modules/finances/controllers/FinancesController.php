<?php

class Finances_FinancesController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Production_Model_Production;
        $this->view->title = "Financess list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchSql());

        $finances = Zend_Registry::get('finances');
        $paginator->setItemCountPerPage($finances->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($finances->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Financess
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Finances", 'APPEND');
        $request = $this->getRequest();
        $form = new Finances_Form_Finances();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Finances_Model_Finances();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Financess
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Financess";
        $form = new Finances_Form_Finances();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Finances_Model_Finances();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Finances_Model_Finances();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Financess
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Finances_Model_Finances();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Finances_Model_Finances();

                $this->view->finances = $model->fetchEntry($id);
            }
        }
    }

}
