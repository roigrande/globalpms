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
        //get the page of the table 
        $page = $this->_getParam('page', 1);
        
        //get the dates for the table
        $model = new Production_Model_Activity();
        
        if ($_SESSION['gpms']['storage']->role_id=="6" OR $_SESSION['gpms']['storage']->role_id=="19")
             $data=$model->fetchOwnActivities();
        else{
        $data=$model->fetchActivities();
        }
        //paginator
        if ($data){
            
        $paginator = Zend_Paginator::factory($data);
        $production = Zend_Registry::get('production');
        $paginator->setItemCountPerPage($production->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($production->paginator);
        $this->view->paginator = $paginator;
        
        }else{$this->view->paginator = null;}
        //send information to the view
        $this->view->title = "Activitys list";
         $this->production = new Zend_Session_Namespace('production');
        $this->production->activity=null;
    }
    
     public function selectAction() {
        
      
             $id = $this->_getParam('id', 0);
      
//      //se comprueba que el usuario tiene permiso para esta actividad
        //se comprueba que el usuario tiene permiso para esta actividad
//        $model_permission_production = new Production_Model_Permissionproduction();
//        if (!$model_permission_production->isUserAllowedProduccition($id)) {
//            echo "no tiene acceso a la produccion " . $production["name"];
//            
//            return $this->_helper->_redirector->gotoSimple('consult', 'production', 'production');
//        };
//        
//           $this->prodcution = new Zend_Session_Namespace('production');
//        $this->production->id=$id;
//        $this->production->name=$name;
        $this->production = new Zend_Session_Namespace('production');  
       
        $this->production->activity= $id;
    
         
        
        return $this->_helper->_redirector->gotoSimple('consult', 'activity', 'production');
    }
    
     function consultAction() {
        
        //get the dates for the table
        $model = new Production_Model_Activity();
        $data = $model->fetchEntryActivity();
        $this->production = new Zend_Session_Namespace('production'); 
        $this->production->activity_users=$data["users_activity_id"];
        $this->view->activity = $data;
        //send information to the view
        $this->view->title = "Production Consult";
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
                $data=$form->getValues();
                
                $data["productions_id"] = $_SESSION["production"]["id"];
//                Zend_Debug::dump($data);
//                die("es valido");
                $model->save($data);
               return $this->_helper->_redirector->gotoSimple('index', 'activity', 'production');
            }
           // die("no es valido again");
        } else {
//             $data["production_id"] = $this->_getParam('id', 0);
//            $model= new Production_Model_Production();
//            $form->setOwnCompany($model->fetchOwnCompanyid( $data["production_id"]));
//            $form->setClientCompany($model->fetchClientCompanyid( $data["production_id"]));
////            
////            die();e
//            $form->init();
          
            $form->populate($form->getValues());
        
            
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
                $id = $_SESSION["production"]["activity"];
                $model->update($form->getValues(), 'id = ' . (int) $id);
                return $this->_helper->redirector('index');
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $_SESSION["production"]["activity"];
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
                
                $this->view->activity= $model->fetchEntry($id);
            }
        }
    }
    
    /**
     * inlitterAction for Activitys
     *
     * @return void
     */
    
    public function inlitterAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Production_Model_Activity();
                $model->inLitter('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Production_Model_Activity();
                $this->view->activity = $model->fetchEntry($id);
            }
        }
    }
    public function permissionAction() {
        $users_activity=explode(",", $_SESSION["production"]["activity_users"]);
        $model= new Production_Model_Activity();
         $this->view->activity_users = $model->fetchUsersActivities($users_activity);
    }
}
