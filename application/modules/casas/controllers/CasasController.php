<?php

class Casas_CasasController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Casas_Model_Casass();
        $this->view->title = "Casass list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchSql());

        $casas = Zend_Registry::get('casas');
        $paginator->setItemCountPerPage($casas->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($casas->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Casass
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Casas", 'APPEND');
        $request = $this->getRequest();
        $form = new Casas_Form_Casas();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Casas_Model_Casass();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Casass
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Casass";
        $form = new Casas_Form_Casas();
        $form->submit->setLabel('Save');
        $form->removeElement('password');
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Casas_Model_Casass();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Casas_Model_Casass();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Casass
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Casas_Model_Casass();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Casas_Model_Casass();

                $this->view->casas = $model->fetchEntry($id);
            }
        }
    }

}
