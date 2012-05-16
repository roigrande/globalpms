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
                   // echo $data["0"]["acl_roles_id"]."roleeeee production";
                        
//                    $this->gpms = new Zend_Session_Namespace('gpms');
//                    $this->gpms->role_application=$this->gpms->storage->role_id;
//                     Zend_Debug::dump($_SESSION,"index");
//                    die();
                    
                   // $_SESSION['gpms']['role_application']=$_SESSION['gpms']['storage']->role_id;
                    //setup $_session
                    $this->production = new Zend_Session_Namespace('production');
                    //begin in production
                    
                    $this->production->id = null;
                    $this->production->name = null;
                    $this->production->activity_id = null;
                    $this->production->activity_name = null;
                    $this->gpms = new Zend_Session_Namespace('gpms');
                    $this->gpms->storage->out_production=0;
                    $this->gpms->role_application=$this->gpms->storage->role_id;
                    $_SESSION["company"]["id"]=null; 
                    $this->_helper->redirector('index', 'index','default');
                    
                }
            }
            else{$this->_helper->redirector( 'error','error','login');}
            
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
        session_start();
        session_unset();
        session_destroy();
        $this->_helper->redirector('index'); // back to login page
    }

}

