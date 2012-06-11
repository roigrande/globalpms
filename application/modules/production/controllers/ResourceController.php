<?php

class Production_ResourceController extends Zend_Controller_Action {

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
        $model = new Production_Model_Resource();
        $data = $model->fetchEntries();

        //paginator
        if ($data) {
            $paginator = Zend_Paginator::factory($data);
            $production = Zend_Registry::get('production');
            $paginator->setItemCountPerPage($production->paginator);
            $paginator->setCurrentPageNumber($page);
            $paginator->setPageRange($production->paginator);
            $this->view->paginator = $paginator;
        } else {
            $this->view->paginator = null;
        }
        //send information to the view
        $this->view->title = "Resources list";
    }

    /**
     * AddAction for Resources
     *
     * @return void
     */
    public function addAction() {

        $this->view->headTitle("Add New Resource", 'APPEND');
        $request = $this->getRequest();
        $form = new Production_Form_Resource();

        if ($this->getRequest()->isPost()) {
//            if ($form->isValid($request->getPost())) {
            if(1){
                $model = new Production_Model_Resource();
//                $data = $form->getValues();
                $data = $request->getPost();
//                Zend_Debug::dump($data);
//                die();
                $data["activities_id"] = $_SESSION["production"]["activity_id"];
                $model->save($data);
                return $this->_helper->_redirector->gotoSimple('consult', 'activity', 'production');
            }
        } else {
//             
            $form->populate($form->getValues());
        }
       
        $this->view->form = $form;
    }

    public function getdataAction() {

        $this->_helper->layout()->disableLayout();
       
        $this->_helper->viewRenderer->setNoRender();
        if ($this->getRequest()->isXmlHttpRequest()) {
             $form = new Production_Form_Resource();
            
          //  Zend_Debug::dump($data);
             $id = $this->_getParam('id', 0);
         //  echo $id;
             $sql = "SELECT id,name
                  FROM contacts WHERE contacts.company_id=".$id."
                AND in_litter =0
                ";
            $db = Zend_Registry::get('db');
            $result = $db->fetchPairs($sql);
             // Zend_Debug::dump($result);
             
            foreach ($result as $key => $value) {
                echo '<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';
            }
            
//        
        }
    }

    public function getdataresourceAction() {
        
        $this->_helper->layout()->disableLayout();
       

        $this->_helper->viewRenderer->setNoRender();
        if ($this->getRequest()->isXmlHttpRequest()) {
             $form = new Production_Form_Resource();
           
          //  Zend_Debug::dump($data);
             $id = $this->_getParam('id', 0);
         //  echo $id;
             $sql = "SELECT resources.id,resources.name
                  FROM resources
                 
                  WHERE resources.companies_id =".$id
                ;
            $db = Zend_Registry::get('db');
            $result = $db->fetchPairs($sql);
             // Zend_Debug::dump($result);
             
            foreach ($result as $key => $value) {
                echo '<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';
            }
            
//        
        }
    }

    /**
     * EditAction for Resources
     *
     * @return void
     */
    public function editAction() {

        $this->view->title = "Edit Resources";
        $form = new Production_Form_Resource();
 
if ($this->getRequest()->isPost()) {
 
    if (1//$form->isValid($this->getRequest()->getPost())
            ) {
        $data=$this->getRequest()->getPost();
        Zend_Debug::dump($data);
        $model = new Production_Model_Resource();
        $id = $this->getRequest()->getPost('id');
       
//        $data=$form->getValues();
//         Zend_Debug::dump($data);
 
        $model->update($data, 'id = ' . (int) $id);
        return $this->_helper->_redirector->gotoSimple('consult', 'activity', 'production');
    } else {
        $form->populate($this->getRequest()->getPost());
    }
} else {

    $id = $this->_getParam('id', 0);
    if ($id > 0) {

        $model = new Production_Model_Resource();
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
                $model = new Production_Model_Resource();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->_redirector->gotoSimple('consult', 'activity', 'production');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Production_Model_Resource();

                $this->view->resource = $model->fetchEntry($id);
            }
        }
    }

    /**
     * inlitterAction for Resources
     *
     * @return void
     */
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Production_Model_Resource();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Production_Model_Resource();

                $this->view->resource = $model->fetchEntry($id);
            }
        }
    }

}
