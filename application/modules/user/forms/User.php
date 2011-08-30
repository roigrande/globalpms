<?php

class User_Form_User extends Zend_Form {

     
    public function init() {
        $this->setName('user');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('name')
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
        
        $role_id = new Zend_Form_Element_Select('role_id');
        $role_id->setLabel('Role_id')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsRole())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
        ;
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id,
                                $name,
                                $password,
                                $date,
                                $email,
                                $status,
                                $validation_code,
                                $person_id,
                                $phone,
                                $role_id,
                                $submit));
    }
    protected function _selectOptionsRole()
    {                    
            $sql="SELECT id,name
                  FROM acl_roles";
            $db=Zend_Registry::get('db');
            $result = $db->fetchPairs($sql);
            return $result;
    }
    

}

