<?php

class User_Form_Controlmodulexml extends Zend_Form {
    public function init() {
        
        $this->setName('upload module');
             
               // Zend_Debug::dump($this->arrayinfo, '$arrayinfo');
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
                
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $version = new Zend_Form_Element_Text('version');
        $version->setLabel('Version')
                
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
    
        $copyright = new Zend_Form_Element_Text('copyright');
        $copyright->setLabel('Copyright')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $developer = new Zend_Form_Element_Text('developer');
        $developer->setLabel('Developer')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        

        
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('name','version','description'.'copyright','developer', 'submitbutton');

        $this->addElements(array($name,$version,$copyright,$description,$developer,$submit));
    }

}

        