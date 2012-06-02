<?php

class Supplier_Form_Productionssupplier extends Zend_Form {

    public function init() {
      

//        $name = new Zend_Form_Element_Text('name');
//        $name->setLabel('name')
//                ->setRequired(true)
//                ->addFilter('StripTags')
//                ->addFilter('StringTrim')
//                ->addValidator('NotEmpty')
//                ->setAttrib('size', 30)
//                ->setAttrib('maxlength', 80)
//                ->setAttrib("class","inputbox")
//                ->setDecorators(array(array('ViewScript', array(
//                            'viewScript' => 'forms/_element_text.phtml'))))
//        ;
//        
        $suppliers_id = new Zend_Form_Element_Select('suppliers_id');
        $suppliers_id->setLabel('Supplier') 
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptions_types())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
//        
//        $productionssupplier_types_id = new Zend_Form_Element_Multiselect('$productionssupplier_types_id');
//        $productionssupplier_types_id->setLabel('productionssupplier types')              
//                ->setmultiOptions($this->_selectOptions_types())
//                ->setAttrib('maxlength', 200)
//                ->setAttrib('size', 5)
//                ->setDecorators(array(array('ViewScript', array(
//                            'viewScript' => 'forms/_element_select.phtml'))))
//                ->setAttrib("class","toolboxdrop")
//        ;
//        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setValue('ADD')
                ->setAttrib('id', 'submitbutton')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_submit.phtml'))))
                ->setAttrib('class', 'btn')
                ->removeDecorator('label')
        ;
        $this->addElements(array(
            $suppliers_id,          
            $submit));
    }              
   public function _selectOptions_Types() {

     $sql = "SELECT suppliers.id,companies.name
                  FROM suppliers 
                  INNER JOIN companies ON companies.id = suppliers.companies_id
                  INNER JOIN companies_has_suppliers ON suppliers.id = companies_has_suppliers.suppliers_id
                  WHERE companies_has_suppliers.companies_id =".$_SESSION["company"]["id"];
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
        
    }
    
}

