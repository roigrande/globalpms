<?php

class Supplier_Form_Resource extends Zend_Form {

    public function init() {
        $this->setName('resource');
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
        
        $resources_types_id = new Zend_Form_Element_Select('resources_types_id');
        $resources_types_id->setLabel('resource type')
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsResource_types())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        
        $num_resources = new Zend_Form_Element_Text('num_resources');
        $num_resources->setLabel('Numero')                
                ->addfilter('StripTags')
                ->addfilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class", "inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ; 
        
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description')                
                ->addfilter('StripTags')
                ->addfilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class", "inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;
        
        $direction = new Zend_Form_Element_Text('direction');
        $direction->setLabel('Direction')                
                ->addfilter('StripTags')
                ->addfilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class", "inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;
        
//        
//        $resource_types_id = new Zend_Form_Element_Select('resource_types_id');
//        $resource_types_id->setLabel('resource types') 
//                ->addValidator('NotEmpty', true)
//                ->setmultiOptions($this->_selectOptions_types())
//                ->setAttrib('maxlength', 200)
//                ->setAttrib('size', 1)
//                ->setAttrib("class", "toolboxdrop")
//                ->setDecorators(array(array('ViewScript', array(
//                            'viewScript' => 'forms/_element_select.phtml'))))
//        ;
//        
//        $resource_types_id = new Zend_Form_Element_Multiselect('$resource_types_id');
//        $resource_types_id->setLabel('resource types')              
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
            $resources_types_id,
            $name,
            $description,
            $num_resources,
            $direction,
           
            $submit));
    }  
    
     public function _selectOptionsResource_Types() {

        $sql = "SELECT id,name
                  FROM resource_types";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }
//   public function _selectOptions_Types() {
//
//     $sql = "SELECT id,name
//                  FROM resource";
//        $db = Zend_Registry::get('db');
//        $result = $db->fetchPairs($sql);
//        //TODO comprobar que no hay roles
//        return $result;
//    }
    
}

