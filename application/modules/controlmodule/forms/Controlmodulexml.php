<?php

class Controlmodule_Form_Controlmodulexml extends Zend_Form {

    public function init() {

        $this->setName('upload module');

        // Zend_Debug::dump($this->arrayinfo, '$arrayinfo');
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
                ->setAttrib("class", "inputbox")
;

        $version = new Zend_Form_Element_Text('version');
        $version->setLabel('Version')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
                ->setAttrib("class", "inputbox")
        ;

        $copyright = new Zend_Form_Element_Text('copyright');
        $copyright->setLabel('Copyright')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
                ->setAttrib("class", "inputbox")
        ;

        $developer = new Zend_Form_Element_Text('developer');
        $developer->setLabel('Developer')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
                ->setAttrib("class", "inputbox")
        ;


        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
                ->setAttrib("class", "inputbox")
        ;




        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setValue('Guardar')
                ->setAttrib('name', 'version', 'description' . 'copyright', 'developer', 'submitbutton')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_submit.phtml'))))
                ->setAttrib('class', 'btn')
                ->removeDecorator('label');

        $this->addElements(array($name, $version, $copyright, $description, $developer, $submit));
    }

}

