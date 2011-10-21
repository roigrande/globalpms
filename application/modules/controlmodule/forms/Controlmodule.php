<?php

class Controlmodule_Form_Controlmodule extends Zend_Form {
    public function init() {
 
        $this->setName('upload module');
       
       
        
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('File')
            ->setDestination(APPLICATION_PATH . '/modules/')
            ->setRequired(true)
            ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_file.phtml')),array('File')))      
          ;
              
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setValue('Upload')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_submit.phtml'))))
                ->setAttrib('class', 'btn')
                ->removeDecorator('label');
        
    
        $this->addElements(array( $file, $submit));

    }
}
   

        
        
        
        
        
        



