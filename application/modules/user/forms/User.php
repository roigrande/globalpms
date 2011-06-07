<?php

class User_Form_User extends Zend_Form {
     public function _selectOptions() {
        $roles = new User_Model_DbTable_Roles();
        $roles=$roles->fetchAll();
       // $array_role[]=
        foreach ($roles as $role) {
            $array_role[$role["id"]]=$role["role_name"];          
            
        }
       
        return $array_role;
 
     }
    public function init() {
        $this->setName('user');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $user_name = new Zend_Form_Element_Text('user_name');
        $user_name->setLabel('User_name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $password = new Zend_Form_Element_Text('password');
        $password->setLabel('password')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $date = new Zend_Form_Element_Text('date');
        $date->setLabel('Date')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $status = new Zend_Form_Element_Text('status');
        $status->setLabel('status')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $person_id = new Zend_Form_Element_Text('person_id');
        $person_id->setLabel('person_id')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
                        
        $validation_code = new Zend_Form_Element_Text('validation_code');
        $validation_code->setLabel('validation_code')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Phone')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $roles_id = new Zend_Form_Element_Select('roles_id');
        $roles_id->setLabel('Role_id')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptions())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
        ;
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id,
                                $user_name,
                                $password,
                                $date,
                                $email,
                                $status,
                                $validation_code,
                                $person_id,
                                $phone,
                                $roles_id,
                                $submit));
    }

}

