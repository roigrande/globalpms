<?php

class Production_ProductionController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $models = new Production_Model_Production();
        $this->view->title = "Productions list";
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchProductions());
        $production = Zend_Registry::get('production');
        $paginator->setItemCountPerPage($production->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($production->paginator);
        $this->view->paginator = $paginator;
    }

    /**
     * AddAction for Productions
     *
     * @return void
     */
    
    public function addAction() {
        $this->view->headTitle("Add New Production", 'APPEND');
        $request = $this->getRequest();
        $form = new Production_Form_Production();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Production_Model_Production();
                $data= $form->getValues();  
                
                $model->save($data);
                return $this->_helper->redirector('index');
            }
        } else {
            $data=$form->getValues();
            $data["clients_id"]=$request->getParam('clients_id');
           
            $form->populate($data);
        }
        $this->view->form = $form;
    }

    /**
     * EditAction for Productions
     *
     * @return void
     */
    public function editAction() {
         
        $id = $this->_getParam('id', 0);
        $models = new Production_Model_Activity();
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($models->fetchActivities($id));
        $activity = Zend_Registry::get('production');
        $paginator->setItemCountPerPage($activity->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($activity->paginator);
        $this->view->productions_id = $id;
        $this->view->paginator = $paginator;
        $this->view->title = "Edit Productions";
        $form = new Production_Form_Production();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Production_Model_Production();
                $id = $this->getRequest()->getPost('id');
                $data= $form->getValues();
                
                $model->update($data, 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            
            if ($id > 0) {
              
                $model = new Production_Model_Production();
                $data=$model->fetchEntry($id);
//                Zend_Debug::dump($data);
               // die();
                $form->populate($data);
            }
        }
        
        $this->view->form = $form;
        
        
    }

    /**
     * deleteAction for Productions
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Production_Model_Production();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Production_Model_Production();

                $this->view->production = $model->fetchEntry($id);
            }
        }
    }

}
