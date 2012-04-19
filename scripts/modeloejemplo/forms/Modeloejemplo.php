<?php

class Modeloejemplo_Form_Modeloejemplo extends Zend_Form {

    public function init() {
        $this->setName('modeloejemplo');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->removeDecorator('label');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class","inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;
//        
//        $modeloejemplo_types_id = new Zend_Form_Element_Select('modeloejemplo_types_id');
//        $modeloejemplo_types_id->setLabel('modeloejemplo types') 
//                ->addValidator('NotEmpty', true)
//                ->setmultiOptions($this->_selectOptions_types())
//                ->setAttrib('maxlength', 200)
//                ->setAttrib('size', 1)
//                ->setAttrib("class", "toolboxdrop")
//                ->setDecorators(array(array('ViewScript', array(
//                            'viewScript' => 'forms/_element_select.phtml'))))
//        ;
//        
//        $modeloejemplo_types_id = new Zend_Form_Element_Multiselect('$modeloejemplo_types_id');
//        $modeloejemplo_types_id->setLabel('modeloejemplo types')              
//                ->setmultiOptions($this->_selectOptions_types())
//                ->setAttrib('maxlength', 200)
//                ->setAttrib('size', 5)
//                ->setDecorators(array(array('ViewScript', array(
//                            'viewScript' => 'forms/_element_select.phtml'))))
//                ->setAttrib("class","toolboxdrop")
//        ;
//        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setValue('Guardar')
                ->setAttrib('id', 'submitbutton')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_submit.phtml'))))
                ->setAttrib('class', 'btn')
                ->removeDecorator('label')
        ;
        $this->addElements(array($id,
            $name,
           
            $submit));
    }              
//   public function _selectOptions_Types() {
//
//     $sql = "SELECT id,name
//                  FROM modeloejemplo";
//        $db = Zend_Registry::get('db');
//        $result = $db->fetchPairs($sql);
//        //TODO comprobar que no hay roles
//        return $result;
//    }
    
}

