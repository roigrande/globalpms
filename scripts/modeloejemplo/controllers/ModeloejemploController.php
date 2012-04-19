<?php

class Modeloejemplo_ModeloejemploController extends Zend_Controller_Action {

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
        $model = new Modeloejemplo_Model_Modeloejemplo();
        $data=$model->fetchEntries();
        
        //paginator
        if ($data){
        $paginator = Zend_Paginator::factory($data);
        $modeloejemplo = Zend_Registry::get('modeloejemplo');
        $paginator->setItemCountPerPage($modeloejemplo->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($modeloejemplo->paginator);
        $this->view->paginator = $paginator;
        
        }else{$this->view->paginator = null;}
        //send information to the view
        $this->view->title = "Modeloejemplos list";
        
    }

    /**
     * AddAction for Modeloejemplos
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Modeloejemplo", 'APPEND');
        $request = $this->getRequest();
        $form = new Modeloejemplo_Form_Modeloejemplo();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Modeloejemplo_Model_Modeloejemplo();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        } else {
            $form->populate($form->getValues());
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Modeloejemplos
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Modeloejemplos";
        $form = new Modeloejemplo_Form_Modeloejemplo();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Modeloejemplo_Model_Modeloejemplo();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Modeloejemplo_Model_Modeloejemplo();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Modeloejemplos
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Modeloejemplo_Model_Modeloejemplo();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Modeloejemplo_Model_Modeloejemplo();

                $this->view->modeloejemploadd= $model->fetchEntry($id);
            }
        }
    }
    
    /**
     * inlitterAction for Modeloejemplos
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Modeloejemplo_Model_Modeloejemplo();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Modeloejemplo_Model_Modeloejemplo();

                $this->view->modeloejemploadd = $model->fetchEntry($id);
            }
        }
    }

}
