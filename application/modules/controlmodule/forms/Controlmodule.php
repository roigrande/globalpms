<?php

class Controlmodule_Form_Controlmodule extends Zend_Form {
    public function init() {
 
        $this->setName('upload module');
       
       

        $file = new Zend_Form_Element_File('file');
        $file->setLabel('File')
            ->setDestination(APPLICATION_PATH . '/modules/')
            ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Upload');

        $this->addElements(array( $file, $submit));

    }
}

        
        
        
        
        
        



