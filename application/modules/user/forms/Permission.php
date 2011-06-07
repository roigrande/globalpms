<?php

class User_Form_Permission extends Zend_Form {
     public function _selectOptionsRoles() {
        $roles = new User_Model_DbTable_Roles();
        $roles=$roles->fetchAll();
       
        foreach ($roles as $role) {
            $array_role[$role["id"]]=$role["role_name"];          
            
        }
       
        return $array_role;
 
     }
     
     public function _selectOptionsResources() {
        $resources = new User_Model_DbTable_Resources();
        $resources=$resources->fetchAll();
        foreach ($resources as $resource) {
            
            $array_resource[$resource["id"]]=$resource["resource"];                      
            
        }       
        
        return $array_resource;
     }

    public function init() {
        $this->setName('permission');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $permission = new Zend_Form_Element_Text('permission');
        $permission->setLabel('permission')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $menu = new Zend_Form_Element_Text('menu');
        $menu->setLabel('Menu')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $role_id = new Zend_Form_Element_Select('role_id');
        $role_id->setLabel('Role_id')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsRoles())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
        ;
        
        $resource_id = new Zend_Form_Element_Select('resource_id');
        $resource_id->setLabel('Resource_id')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsResources())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
        ;
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id,
                                $permission,
                                $name,
                                $menu,
                                $role_id,
                                $resource_id,
                                $submit));
    }

}

