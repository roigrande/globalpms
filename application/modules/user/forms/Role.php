<?php

class User_Form_Role extends Zend_Form {

    public function _selectOptionsRoles() {

        $roles = new User_Model_DbTable_Roles();
        $roles = $roles->fetchAll();
        foreach ($roles as $role) {
            $array_role[$role["id"]] = $role["name"];
        }
        return $array_role;
    }

    public function init() {
        $this->setName('role');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->removeDecorator('label');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
                ->setAttrib("class","inputbox");

        $role_parent = new Zend_Form_Element_Select('role_parent');
        $role_parent->setLabel('Role Parent')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsRoles())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
                ->setAttrib("class","toolboxdrop")
        ;

        $prefered_uri = new Zend_Form_Element_Text('prefered_uri');
        $prefered_uri->setLabel('Prefered Uri')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
                ->setAttrib("class","inputbox");

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setValue('Guardar')
                ->setAttrib('id', 'submitbutton')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_submit.phtml'))))
                ->setAttrib('class', 'btn')
                ->removeDecorator('label');
        $this->addElements(array($id, $name, $role_parent, $prefered_uri, $submit));
    }

}

