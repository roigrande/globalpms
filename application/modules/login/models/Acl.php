<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_Model_Acl
 *
 * @author chenko
 */
class Login_Model_Acl extends Zend_Acl {

    protected static $_instance = null;
    private $_db;
    public $_UserRoleName = null;
    public $_UserRoleId = null;
    public $_user = null;
    private $_acl = array();
    private $val = array();

    public function __construct() {
        
    }

    private function __clone() {
        
    }

    protected function _initialize() {
        $user = Zend_Auth::getInstance()->getIdentity();
        $this->_user = $user ? $user->name : 'Guest';
        

        $front = Zend_Controller_Front::getInstance();
       
        
        $this->_db = Zend_Registry::get('db');

        self::initRoles();
        self::initResources();
        self::initPermissions();
        
        $getUserRole = $this->_db->fetchRow(
                       $this->_db->select()
                                ->from(array('acl_roles'), array('role_name' => 'name'))
                                ->from('acl_users')
                                ->where('acl_users.name = "' . $this->_user . '"')
                                ->where('acl_users.role_id = acl_roles.id'));

        $login = Zend_Registry::get('login');
         
        $this->_UserRoleId = isset($getUserRole->role_id) ?  $getUserRole->role_id : $login->publicid;
        $this->_UserRoleName = isset($getUserRole->role_name) ? $getUserRole->role_name : 'public';

        $this->addRole(new Zend_Acl_Role($this->_user), $this->_UserRoleName);
    }

    private function getRoots($roles) {
        $roots = array();
        foreach ($roles as $key => $value) {
            if ($value->role_parent == 0) {
                array_push($roots, $value);
            }
        }
        return $roots;
    }

    private function getSons($roles, $parent) {
        $sons = array();
        foreach ($roles as $key => $value) {
            $parents = explode(",", $value->role_parent);
            if (in_array($parent, $parents)) {
                array_push($sons, $value);
            }
        }
        return $sons;
    }

    private function preOrder($roles) {
        if (!$roles)
            return;
        echo "<pre>";
        print_r($roles);
        echo "<pre>";
        $this->preOrder($this->getSons($roles, $roles[0]->id));
    }

    private function postOrder($roles, $fulltree) {
        if (!$roles)
            return;

        $news = $this->getSons($fulltree, $roles[0]->id);
        foreach ($news as $key => $value) {
            $val = array($value);
            $this->postOrder($val, $fulltree);
            if (!in_array($value, $this->val))
                array_push($this->val, $value);
        }
    }

    private function initRoles() {
        $roles = $this->_db->fetchAll(
                        $this->_db->select()
                                ->from('acl_roles')
                                //->order(array('role_id DESC')));
                                ->order(array('role_parent ASC')));


        $root = $this->getRoots($roles);
        foreach ($root as $key => $value) {
            $this->postOrder(array($value), $roles);
            array_push($this->val, $value);
        }
        $roles = array_reverse($this->val);
        //  Zend_Debug::dump($roles); 

        foreach ($roles as $key => $value) {
            $parent = array();
            if ($value->role_parent == 0)
                $this->addRole(new Zend_Acl_Role($value->name));
            else {
                $parents = explode(",", $value->role_parent);
                foreach ($parents as $key2 => $value2) {
                    array_push($parent, $this->getRoleName($value2)->name);
                }
                $this->addRole(new Zend_Acl_Role($value->name), $parent);
            }
        }
    }

    private function initResources() {
        $resources = $this->_db->fetchAll(
                        $this->_db->select()
                                ->from('acl_resources'));

        foreach ($resources as $key => $value) {
            //Returns true if and only if the Resource exists in the ACL
            if (!$this->has($value->resource)) {
                $this->add(new Zend_Acl_Resource($value->resource));
            }
        }
    }

    private function initPermissions() {

        $select = $this->_db->select()
                ->from(array('acl_roles'), array('name_role' => 'name'))
                ->from('acl_resources')
                ->from('acl_permissions')
                ->where('acl_roles.id = acl_permissions.role_id')
                ->where('acl_resources.id = acl_permissions.resource_id')
        ;
        //Zend_Debug::dump($select . "select");
        $acl = $this->_db->fetchAll($select);

        $this->deny();
        $this->allow(null, 'default:index');


        foreach ($acl as $key => $value) {
            //    Zend_Debug::dump($value->name_role."-".$value->resource."-".$value->permission);
            $this->allow($value->name_role, $value->resource, $value->permission);
        }
        //  die();
    }

    public function getRoleId($roleName) {
        return $this->_db->fetchRow(
                $this->_db->select()
                        ->from('acl_roles', 'id')
                        ->where('acl_roles.name = "' . $roleName . '"'));
    }

    public function getRoleName($roleId) {

        return $this->_db->fetchRow(
                $this->_db->select()
                        ->from('acl_roles', 'name')
                        ->where('acl_roles.id = "' . $roleId . '"'));
    }

    /* public function insertAclUser() 
      {
      $data = array(
      'role_id' => $this->_getUserRoleId,
      'user_name' => $this->_user);

      return $this->_db->insert('acl_users',$data);
      } */

    public function listRoles() {
        return $this->_db->fetchAll(
                $this->_db->select()
                        ->from('acl_roles'));
    }

    public function listResources() {
        return $this->_db->fetchAll(
                $this->_db->select()
                        ->from('acl_resources')
                        ->from('acl_permissions')
                        ->where('resource_id = acl_resources.id'));
    }

    public function listResourcesByGroup($group) {
        $result = null;
        $group = $this->_db->fetchAll($this->_db->select()
                                ->from('acl_resources')
                                ->from('acl_permissions')
                                ->where('acl_resources.resource = "' . $group . '"')
                                ->where('uid = resource_uid')
        );
        foreach ($group as $key => $value) {
            if ($this->isAllowed($this->_user, $value->resource, $value->permission)) {
                $result[] = $value->permission;
            }
        }
        return $result;
    }

    public function getArrayResourceNavByUser($role_id=null) {
        $acl = Users_Model_Acl::getInstance();
        $list = array();
        $modules = new Users_Model_Modules();
        if ($role_id == null)
            $role = $this->_UserRoleName;
        else
            $role=$this->getRoleName($role_id)->role_name;

        foreach ($this->listResources() as $key => $r) {
            $module = $modules->fetchEntry($r->module_id);
            $node = array();
            //Zend_Debug::dump($r);
            if ($this->isAllowed($role, $r->resource, $r->permission)) {
                if (!@is_array($list[$module['module_name']])) {
                    $list[$module['module_name']] = array();
                }
                $list[$module['module_name']]['label'] = $module['module_name'];
                $list[$module['module_name']]['uri'] = "/" . $module['module_name'];
                //$list[$r->module_id]["type"] = "uri";
                //$node['uri']=$r->name;3

                if (!@is_array($list[$module['module_name']]['pages'])) {
                    $list[$module['module_name']]['pages'] = array();
                }

                array_push($list[$module['module_name']]['pages'], array('label' => $r->name,
                    'uri' => str_replace(":", "/", "/" . $r->resource . ":" . $r->permission)
                ));
            }
        }
        return $list;
    }

    public function listResourceByUser($role_id=null) {
        //$this->view->role = $this->_getUserRoleName.":".$this->_acl->_user;
    
        if ($role_id == null)
            $list['role'] = $this->_UserRoleName;
        else
            $list['role'] = $this->getRoleName($role_id)->role_name;

        $list['user'] = $this->_user;

        //$this->view->placeholder('user')->set('Welcome'.$this->_UserRoleName.":".$this->_user);

        foreach ($this->listResources() as $key => $r) {
            //Zend_Debug::dump($this->_acl->isUserAllowed($r->resource, $r->permission)." ".$this->_acl->_user." ".$r->resource." ".$r->permission, $label="asdasd", $echo =true);
            try {
                $s[$r->resource . ' - ' . $r->permission] = $this->isAllowed($list['role'], $r->resource, $r->permission) ?
                        'allowed' :
                        'denied';
                $list['allowed'] = $s;
            } catch (Zend_Acl_Exception $e) {
                print_r($e->getMessage());
            }
        }
        return $list;
    }

    public function isUserAllowed($role, $resource, $permission) {
       
        return ($this->isAllowed($role, $resource, $permission));
    }

    public function statusModule($module) {
     

        if ($model = $this->_db->fetchRow(
                        $this->_db->select()
                                ->from('acl_modules')
                                ->where('acl_modules.name = "' . $module . '"')
        )) {
//              Zend_Debug::dump($model);
//              die();
            return $model->active;
        }

        return "uninstall";
    }

    public function isModule($module) {
         echo $module;
        
        $dir = APPLICATION_PATH;
        $dir .= Zend_Registry::get('login')->dir;
        if (is_dir($dir)) {
            return TRUE;
        }
        return FALSE;
    }

    //Singleton Pattern Implementation
    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
            self::$_instance->_initialize();
        }

        return self::$_instance;
    }

}

?>
