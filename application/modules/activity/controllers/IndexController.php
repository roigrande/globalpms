<?php

class Activity_IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Activity_Model_Activitys();
        $this->view->title = "Activity list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchEntries());
        $activity = Zend_Registry::get('activity');
        $paginator->setItemCountPerPage($activity->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($activity->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Users
     *
     * @return void
     */
    public function addAction() {
        $this->view->headTitle("Add New Activity", 'APPEND');
        $request = $this->getRequest();
        $form = new Activity_Form_Activity();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                
         
                $model = new Activity_Model_Activitys();
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
        $this->view->title = "Edit Activities";
        $form = new Activity_Form_Activity();
//        $form->submit->setLabel('Save');
//        $form->removeElement('password');
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Activity_Model_Activitys();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Activity_Model_Activitys();
                $model2=$model->fetchEntry($id);
                
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
                $model = new Activity_Model_Activitys();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Activity_Model_Activitys();

                $this->view->user = $model->fetchEntry($id);
            }
        }
    }

}
