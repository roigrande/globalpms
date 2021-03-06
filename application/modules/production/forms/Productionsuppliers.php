<?php

class Production_Form_Productionsuppliers extends Zend_Form {

   public function init() {
        $this->setName('supplier');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->removeDecorator('label');
        
        $companies_id = new Zend_Form_Element_Hidden('companies_id');
        $companies_id->addFilter('Int');
        $companies_id->removeDecorator('label');

        
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
 
        
        $activity_types_id = new Zend_Form_Element_Multiselect('$activity_types_id');
        $activity_types_id->setLabel('Activity types')              
                ->setmultiOptions($this->_selectOptions_types())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 5)
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
                ->setAttrib("class","toolboxdrop")
        ;
        
        
        $fiscal_name = new Zend_Form_Element_Text('fiscal_name');
        $fiscal_name->setLabel('Fiscal name')
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
        
        
        $company_types_id = new Zend_Form_Element_Select('company_types_id');
        $company_types_id->setLabel('Type')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsCompanyTypes())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class","toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('emailAddress', TRUE)
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class","inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;

        $telephone = new Zend_Form_Element_Text('telephone');
        $telephone->setLabel('Telephone')
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

        $fax = new Zend_Form_Element_Text('fax');
        $fax->setLabel('fax')
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

        $direction = new Zend_Form_Element_Text('direction');
        $direction->setLabel('Direction')
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
        
        $city = new Zend_Form_Element_Text('city');
        $city->setLabel('City')
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
        $country = new Zend_Form_Element_Text('country');
        $country->setLabel('Country')
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
        
        $postal_code = new Zend_Form_Element_Text('postal_code');
        $postal_code->setLabel('Postal code')
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

        $observation = new Zend_Form_Element_Text('observation');
        $observation->setLabel('Observation')
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
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setValue('Guardar')
                ->setAttrib('id', 'submitbutton')
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_submit.phtml'))))
                ->setAttrib('class', 'btn')
                ->removeDecorator('label')
        ;
        $this->addElements(array($id,
            $companies_id,
            $name,
            $activity_types_id,
            $fiscal_name,
            $company_types_id,
            $email,
            $telephone,
            $fax,
            $direction,
            $city,
            $country,
            $postal_code,
            $observation,
            $submit));
    }              
   public function _selectOptions_Types() {
       
     $sql = "SELECT id,name
                  FROM activity_types";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }
    
     protected function _selectOptionsCompanyTypes() {
        $sql = "SELECT id,name
                  FROM company_types
                  ORDER BY name";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }
    
}
