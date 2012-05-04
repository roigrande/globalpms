<?php

class Default_IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    function indexAction() {
    }

    public function changelanguageAction() {
        $this->_helper->viewRenderer->setNoRender(true);
//        die("language");
        $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {
            $locale = new Zend_Locale($request->getPost('language'));
            $default = new Zend_Session_Namespace('default');
            $default->language = $locale->getLanguage();
            $default->locale = $locale->getRegion();
            $this->_redirect($request->getPost('refer'));
        } else {
            return;
        }
        return;
    }
    
    public function changecompanyAction() {
        $this->_helper->viewRenderer->setNoRender(true);
      
        $request = $this->getRequest();
        
        if ($this->getRequest()->isPost()) {
   
           // $locale = new Zend_Locale($request->getPost('language'));
            $select_company = $request->getPost('company');
            $company = new Zend_Session_Namespace('company');
            $company->id = $select_company;
            
            $this->production = new Zend_Session_Namespace('production');
            $this->production->id= null;
            $this->production->name= null;
            $this->production->client_company= null;
            $this->production->activity_id = null;
            $this->production->activity_name = null;
            if($this->gpms->storage->out_production==0){
                $this->gpms->storage->out_production=1;
                $this->gpms->storage->role_id=$this->gpms->role_application;
            return $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        }
            $this->_helper->_redirector->gotoSimple('index', 'production', 'production');
        } else {
            return;
        }
        return;
    }

}