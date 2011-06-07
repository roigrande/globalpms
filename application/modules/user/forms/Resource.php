<?php

class User_Form_Resource extends Zend_Form {
     public function _selectOptions() {
        $modules = new User_Model_DbTable_Modules();
        $modules=$modules->fetchAll();
       // $array_module[]=
        foreach ($modules as $module) {
            $array_module[$module["id"]]=$module["module_name"];          
            
        }
       
        return $array_module;
 
     }
    public function init() {
        $this->setName('resource');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $resource = new Zend_Form_Element_Text('resource');
        $resource->setLabel('resource')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $name_r = new Zend_Form_Element_Text('name_r');
        $name_r->setLabel('Name_r')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        
        
        $module_id = new Zend_Form_Element_Select('module_id');
        $module_id->setLabel('Module_id')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptions())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
        ;
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id,
                                $resource,
                                $name_r,
                                $module_id,
                                $submit));
    }

}

