<?php

class User_Form_Module extends Zend_Form {
    public function init() {
        $this->setName('module');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $module_name = new Zend_Form_Element_Text('module_name');
        $module_name->setLabel('Name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $module_name, $submit));
    }

}

