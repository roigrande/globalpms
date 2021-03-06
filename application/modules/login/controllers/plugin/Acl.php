<?php

class Login_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {

    protected $_auth = null;
    protected $_acl = null;

    public function __construct() {
        $users = Zend_Registry::get('login');
//        echo "estas en el contruct de acl";
//        Zend_Debug::dump($users);
//        die();

        $this->_auth = Zend_Auth::getInstance();
        $this->_auth->setStorage(new Zend_Auth_Storage_Session($users->StorageSession));
//        Zend_Debug::dump($this->_auth, "account", true);
//        Zend_Debug::dump($_SESSION,"session");

        $this->_acl = Login_Model_Acl::getInstance();
    }

    public function predispatch(Zend_Controller_Request_Abstract $request) {
      
//            $account = Zend_Registry::get('account');  
//            phpinfo();
//            Zend_Debug::dump($_SESSION, "account", true);
//            Zend_Debug::dump($this->_auth->getIdentity(), "account", true);
//            Zend_Debug::dump($request, "account", true);
        $module = $request->getModuleName();
        $resource = $request->getControllerName();
        $permission = $request->getActionName();
//        $module = $request->module;
//        $resource = $request->controller;
//        $permission = $request->action;        
//        $request->setParam('account', $account);
//        $account = $request->account;

        if (!$this->_acl->has($module . ":" . $resource)) {
            //NO Exist Resource
            $resource = null;
        } else {
            //Exist Resource
            $resource = $module . ":" . $resource;
        }
//       //   chance role_production for application role;
//        if ($module != "production") {          
//
////            $session = new Zend_Session_Namespace('gpms');
////            $session->storage->role_id=$session->storage->role_application;
////            Zend_Debug::dump($_SESSION);
////            die();
//           $_SESSION['gpms']['storage']->role_id = $_SESSION['gpms']['role_application'];
////          echo $_SESSION['gpms']['storage']->role_id;
//        }
       
        // Get User Identity
        //Zend_Debug::dump($this->_auth->getIdentity(), "autenticated?", true);
        
        if ($this->_auth->getIdentity()) {
       
            $role = $this->_acl->getRoleName($this->_auth->getIdentity()->role_id);
            $this->_acl->_UserRoleName = $role->name;
            $this->_acl->_UserRoleId = $this->_auth->getIdentity()->role_id;
            //TODO arreglar 
            $session = new Zend_Session_Namespace('gpms');
            $session->role = $this->_acl->_UserRoleName;
        }

//        die();
//        if (!$this->_acl->isModule($module)) {
//            // Error 404
//            die();
//            echo "recurso no instalado";
//            $request->setControllerName('error');
//            $request->setActionName('error');
//            $request->setDispatched(true);
//            //   Zend_Debug::dump("-----", "Error 404", false);
//        } 
  
          //    Zend_Debug::dump($_SESSION);
              
//              if (!isset($_SESSION["production"]["id"])){
//                  echo "no existe"; 
//              }
        //si va añadir produccion se restringe por rol
//        if ($permission != "add") {
//            //compruebo que esta en el modulo de produccion y que no hay seleccionanada ninguna
//            if ($module == "production" and (isset($_SESSION["production"]["id"]))) {
//                if ($_SESSION["production"]["id"]==null) {
//                        
//                    //compruebo que no es la seleccion de producciones o el index
//                    if ((($resource == 'production:production') and (!(($permission == "index") OR ($permission == "select")) ))) {
//                        echo "tienes que seleccionar una produccion";
//                        //echo "tienes que seleccionar una produccion";
//                        $request->setActionName('index');
//                        $request->setControllerName('production');
//                    }
//                    if ($resource != 'production:production' and $permission != "add") {
//                        echo "tienes que seleccionar una produccion 2";
//                        $request->setActionName('index');
//                        $request->setControllerName('production');
//                    }
//                }
//            }
//        }
//        echo "resource :".$resource;
//        echo "<br>";
//        echo "permission :".$permission;
//        echo "<br>";
//        echo "rolename :".$this->_acl->_UserRoleName;
//         echo "<br>";
        if (!$this->_acl->has($resource)) {
            // Error 404
            try {
                throw new Zend_Controller_Action_Exception("This page dont exist", 404);
                //throw new Zend_Exception('This is a sample exception',404);
//           $front = Zend_Controller_Front::getInstance();
//           $front->throwExceptions(true);
            } catch (Zend_Exception $e) {
                
            };
            $request->setModuleName('login');
            $request->setControllerName('error');
            //TODO enviar error no errrorfound
            $request->setActionName('error');
            //   $request->setParam('error_handler',Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
            $request->setParam('error_handler', $e);
            Zend_Debug::dump($e, "e");
            die();
            //$request->setDispatched(true);
        } elseif (!$this->_auth->hasIdentity()) {
//            if ($module=="login" && $resource=="error" && $permission="error"){
//                $request->setModuleName('login');
//                $request->setControllerName('error');
//                $request->setActionName('error');                
//            }
            // dont have authenticated
            $request->setModuleName('login');
            $request->setControllerName('index');
            $request->setActionName('index');
            //echo "si";
        } elseif ($this->_acl->statusModule($module) == "uninstall") {


            $request->setModuleName('login');
            $request->setControllerName('error');
            $request->setActionName('uninstall');
            //    $request->setDispatched(true);
        } elseif ($this->_acl->statusModule($module) == "0") {

            $request->setModuleName('login');
            $request->setControllerName('error');
            $request->setActionName('unactive');
            //     $request->setDispatched(true);
        } elseif (!$this->_acl->isAllowed($this->_acl->_UserRoleName, $resource, $permission)) {
            if ($this->_auth->hasIdentity()) {
                // authenticated, denied access, forward to denied page
//                                echo "is not allowed";
//                Zend_Debug::dump($resource, "resource");
//                Zend_Debug::dump($this->_acl->_UserRoleName, "user role name");
//                Zend_Debug::dump($permission, "permission");
               
                $request->setModuleName('login');
                $request->setControllerName('error');
                $request->setActionName('denied');
                //echo "si";
            } else {
                // not authenticated, forward to login page
                $request->setModuleName('login');
                $request->setControllerName('index');
                $request->setActionName('index');
                //   echo "no";
            }
        }
    }

//        public function preDispatch(Zend_Controller_Request_Abstract $request)  
//        {                  
//                @$module = $request->module;
//                @$resource = $request->controller;
//        @$permission = $request->action;
//        @$account=$request->account;        
//        
//        Zend_Debug::dump($request, "request dispatch", false);
//                
//        $layout = Zend_Layout::getMvcInstance();
//        $view = $layout->getView();                        
//        
//        $model = new Whitelabel_Model_Wlabel();
//        $accountinfo=$model->getWlabelinfoByAccountModRes($account, $module, $module.':'.$resource);        
//        
//        // TODO Force Role
////                $this->_acl->_UserRoleName=$accountinfo->force_role;
//                       
//        
//        Zend_Debug::dump($accountinfo, "accountLayout", false);
//        
//        if(@$accountinfo->layout!=NULL)
//        {
//                $layout->setLayout($accountinfo->layout); 
//        }
//        Zend_Debug::dump($layout->getLayout(), 'layout', false);
//                  
//                return;
//        }                
}