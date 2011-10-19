<?php

class User_IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    /**
     * IndexAction for Permissions
     *
     * @return void
     */
    function indexAction() {

        $this->_helper->redirector('index','user');
    }

}
