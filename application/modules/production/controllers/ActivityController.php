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
        $data = $models->fetchActivities("0");
        //  Zend_Debug::dump($data);
        //  die();
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
                $data = $form->getValues();
                $data["productions_id"] = $this->_getParam('id', 0);
//                  Zend_Debug::dump($data);
//                die();
                $model->save($data);

                //return $this->_helper->redirector('edit');

                return $this->_helper->_redirector->gotoSimple('edit', 'production', 'production', array('id' => $this->_getParam('id', 0)));
            }
        } else {
            $data = $form->getValues();
            $data["productions_id"] = $this->_getParam('id', 0);
//            var_dump($data);
//             die();
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
                $data = $form->getValues();
//                 Zend_Debug::dump($data);
//                die();
                $model->update($data, 'id = ' . (int) $id);
                return $this->_helper->_redirector->gotoSimple('edit', 'production', 'production', array('id' => $this->_getParam('production_id', 0)
                                )
                );
                //  return $this->_helper->redirector('index','activity','production');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Production_Model_Activity();
                $data = $model->fetchEntry($id);
                
                Zend_Debug::dump($data);
                //die();
                $form->contract_company_id->$data["id"];
                $form->populate($data);
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
            return $this->_helper->_redirector->gotoSimple('edit', 'production', 'production', array('id' => $this->_getParam('production_id', 0)));
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Production_Model_Activity();
                $data = $model->fetchEntry($id);
                Zend_Debug::dump($data);

                $this->view->activity = $data;
            }
        }
    }

}
