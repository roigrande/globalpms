<?php

class Default_IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    function indexAction() {
    }

    public function changelanguageAction() {
        $this->_helper->viewRenderer->setNoRender(true);

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

}