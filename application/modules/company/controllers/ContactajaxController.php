<?php

class Company_ContactajaxController extends Zend_Controller_Action {

    public function init() {
        
        $this->view->dojo()->enable;
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {
        
        $models = new Company_Model_Contact();
        $this->view->title = "Contacts list";
        $page = $this->_getParam('page', 1);   
        $company_id = $this->getRequest()->getParam('company_id');       
        
        $paginator = Zend_Paginator::factory($models->fetchCompany($company_id));

        $contact = Zend_Registry::get('company');
        $paginator->setItemCountPerPage($contact->paginator);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange($contact->paginator);
        $this->view->paginator = $paginator;
    }
    
    
     public function saludoajaxAction() {      }
       public function saludoajax2Action() {  
           //indica que esta accion no usará layout.phtml como plantilla del sistema
            $this->_helper->layout->disableLayout();
            //indica que la accion no usará saludoajax2.phtml
            $this->_helper->viewRenderer->setNoRender();
            //esta es la respuesta a la llamada ajax
    echo "saludos desde el servidor";
}


public function listadoajaxAction()
{
     
 // action body
 $this->_helper->layout->disableLayout();
 $this->_helper->viewRenderer->setNoRender();
 
 $tabla = new Company_Model_Contact;
 $rows = $tabla->fetchEntries();
 //funcion de zend framewrok que me codifica el listado para formato Json
 $json = Zend_Json::encode($rows);
 echo $json;
}

    /**
     * AddAction for Contacts
     *
     * @return void
     */
    public function addAction() {
        //TODO comprobar que se pasa  la compañia a la que se quiere agregar
        $this->view->headTitle("Add New Contact", 'APPEND');
        $request = $this->getRequest();
        $form = new Company_Form_Contact();
            
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Company_Model_Contact();
                $data=$form->getValues();
                $data["company_id"]=$request->getParam('company_id');
             //   Zend_Debug::dump($data);
                $lastid=$model->save($data);
                echo $lastid;
              
                return $this->_helper->_redirector->gotoSimple('edit', 'company', 'company', array('company_id' => $this->_getParam('company_id', 0)));
            }
        } else {
               
            $data=$form->getValues();
            $data["company_id"]=$request->getParam('company_id'); 
           
            $form->populate($data);
            
        }
        $this->view->form = $form;
    }

    
     public function addajaxAction() {
      $this->view->title = "Add Ajax Companys";
      if($this->_request->isXmlHttpRequest())
        { 

        $this->_helper->viewRenderer->setNoRender(true);

        $this->_helper->layout->disableLayout();
        
        $this->view->headScript()->appendFile($this->view->baseUrl('/scripts/axjax_functions.js'));
     //   $rooms=$this->_getParam('rooms',0);

        }



      //$this->_helper->layout->disableLayout();
     // require_once dirname(__FILE__) . '/public/scripts/ajax_functions.php';
      $this->view->headTitle("Add New Contact", 'APPEND');
      $request = $this->getRequest();
        $form = new Company_Form_Contact();
            
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Company_Model_Contact();
                $data=$form->getValues();
                $data["company_id"]=$request->getParam('company_id');
                //Zend_Debug::dump($data);
                $lastid=$model->save($data);
                echo $lastid;
              
                return $this->_helper->_redirector->gotoSimple('edit', 'company', 'company', array('company_id' => $this->_getParam('company_id', 0)));
            }
        } else {
               
            $data=$form->getValues();
            $data["company_id"]=$request->getParam('company_id'); 
           
            $form->populate($data);
            
        }
     }   
        /**
     * EditAction for Contacts
     *
     * @return void
     */
    public function editajaxAction() {
        $this->view->title = "Edit Ajax Contacts";
        
        if($this->_request->isXmlHttpRequest())
{ 

$this->_helper->viewRenderer->setNoRender(true);

$this->_helper->layout->disableLayout();

//$rooms=$this->_getParam('rooms',0);

}
          $this->_helper->layout->disableLayout();
        $form = new Company_Form_Contact();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Company_Model_Contact();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
//                echo $this->getRequest()->getParam('company_id');
//                die();
              return $this->_helper->_redirector->gotoSimple('edit', 'company', 'company', array('company_id' => $this->_getParam('company_id', 0)));
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Company_Model_Contact();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }
    /**
     * EditAction for Contacts
     *
     * @return void
     */
    public function editAction() {
        $this->view->title = "Edit Contacts";
        $form = new Company_Form_Contact();     
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $model = new Company_Model_Contact();
                $id = $this->getRequest()->getPost('id');
                $model->update($form->getValues(), 'id = ' . (int) $id);
//                echo $this->getRequest()->getParam('company_id');
//                die();
              return $this->_helper->_redirector->gotoSimple('edit', 'company', 'company', array('company_id' => $this->_getParam('company_id', 0)));
            } else {
                $form->populate($this->getRequest()->getPost());
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $model = new Company_Model_Contact();
                $form->populate($model->fetchEntry($id));
            }
        }
        $this->view->form = $form;
    }

    /**
     * deleteAction for Contacts
     *
     * @return void
     */
    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $model = new Company_Model_Contact();
                $model->delete('id = ' . (int) $id);
            }
            return $this->_helper->redirector('index','company','company');
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $model = new Company_Model_Contact();

                $this->view->contact = $model->fetchEntry($id);
            }
        }
    }

}
