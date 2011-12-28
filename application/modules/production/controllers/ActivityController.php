<?php

class Production_ActivityController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Production_Model_Activity();
        $this->view->title = "Activitys list";
        $page = $this->_getParam('page', 1);
       
        $paginator = Zend_Paginator::factory($models->fetchActivities("0"));

        $production = Zend_Registry::get('production');
        $paginator->setItemCountPerPage($production->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($production->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Activitys
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Activity", 'APPEND');
        $request = $this->getRequest();
        $form = new Production_Form_Activity();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Production_Model_Activity();
                $model->save($form->getValues());
               
                return $this->_helper->redirector('edit');
                
                return $this->_helper->redirector($this->_getParam('id', 0),'id','edit','production','production');
            }
        } else {
            $data=$form->getValues();
            $data["productions_id"]=$this->_getParam('id', 0);    
            var_dump($data);
           // die();
            $form->populate($data);            
        }
        $this->view->form = $form;
        
    }

    /**
     * EditAction for Activitys
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Activitys";
        $form = new Production_Form_Activity();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Production_Model_Activity();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                 return $this->_helper->redirector('index','activity','production');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Production_Model_Activity();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Activitys
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Production_Model_Activity();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Production_Model_Activity();

                $this->view->production = $model->fetchEntry($id);
            }
        }
    }

}