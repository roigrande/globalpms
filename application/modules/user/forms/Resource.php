<?php

class User_Form_Resource extends Zend_Form {

    public function _selectOptions() {
        $modules = new User_Model_DbTable_Modules();
        $modules = $modules->fetchAll();
        // $array_module[]=
        foreach ($modules as $module) {
            $array_module[$module["id"]] = $module["name"];
        }

        return $array_module;
    }

    public function init() {
        $this->setName('resource');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->removeDecorator('label');
        
        $resource = new Zend_Form_Element_Text('resource');
        $resource->setLabel('Resource')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
                ->setAttrib("class","inputbox");

        $name_r = new Zend_Form_Element_Text('name_r');
        $name_r->setLabel('Name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
                ->setAttrib("class","inputbox");



        $module_id = new Zend_Form_Element_Select('module_id');
        $module_id->setLabel('Module')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptions())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
                ->setAttrib("class","toolboxdrop")
        ;

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setValue('Guardar')
                ->setAttrib('id', 'submitbutton')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_submit.phtml'))))
                ->setAttrib('class', 'btn')
                ->removeDecorator('label')
        ;

        $this->addElements(array($id,
            $resource,
            $name_r,
            $module_id,
            $submit));
    }

}

