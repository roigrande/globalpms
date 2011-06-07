<?php

class User_Form_Role extends Zend_Form {

    public function init() {
        $this->setName('role');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $role_name = new Zend_Form_Element_Text('role_name');
        $role_name->setLabel('Name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $role_parents = new Zend_Form_Element_Text('role_parents');
        $role_parents->setLabel('Role Parents')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $prefered_uri = new Zend_Form_Element_Text('prefered_uri');
        $prefered_uri->setLabel('Prefered Uri')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $role_name, $role_parents,$prefered_uri, $submit));
    }

}

