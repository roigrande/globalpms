<?php

class Login_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $this->_helper->layout->setLayout('login');  
        $form = new Login_Form_Login();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                if ($this->_process($form->getValues())) {
                    // We're authenticated! Redirect to the home page
                    $this->_helper->redirector('index', 'index','default');   
                
                    
                }
            }
        }
        $this->view->form = $form;
    }
    
    protected function _process($values)
    {
        $adapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
        $adapter->setTableName('acl_users');
        $adapter->setIdentityColumn('email');
        $adapter->setCredentialColumn('password');
        $adapter->setIdentity($values['email']);
        $adapter->setCredential(hash('SHA256', $values['password']));
        
        // Get our authentication adapter and check credentials
//        $adapter = $this->_getAuthAdapter();
//        $adapter->setIdentity($values['name']); 
//        $adapter->setCredential($values['password']);
//        
        //Zend_Debug::dump($adapter,"adapter");
        //Zend_Debug::dump( sha1(($values['password'])."ce8d96d579d389e783f95b3772785783ea1a9854"), $label="Server variables", $echo=true);        
        //$select = $adapter->getDbSelect();
//        Zend_Debug::dump($select,"select");
//        die();
//         
       
        $auth = Zend_Auth::getInstance();
        
        $result = $auth->authenticate($adapter);
         
        Zend_Debug::dump($result, $label="Server variables", $echo=true);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write($user);
            return true;
        }
         
        return false;
       
    }
           
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index'); // back to login page
    }

}

