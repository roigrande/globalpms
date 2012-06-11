<?php

class Production_Form_Activity extends Zend_Form {


    public function init() {
        $this->setName('activity');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->removeDecorator('label');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addfilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class", "inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;
         
        $activity_types_id = new Zend_Form_Element_Select('activity_types_id');
        $activity_types_id->setLabel('activity type')
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsActivity_types())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;


        $contact_own_company_id = new Zend_Form_Element_Select('contact_own_company_id');
        $contact_own_company_id->setLabel('contact own company')
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsContactOwnCompanies())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttribadd_contact("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
//
        $contact_client_company_id = new Zend_Form_Element_Select('contact_client_company_id');
        $contact_client_company_id->setLabel('contact client company')
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsContactClientCompanies())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        
        $status_id = new Zend_Form_Element_Select('status_id');
        $status_id->setLabel('Status')
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsStatus())
                ->setAttrib('maxlength', 300)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        
        $date_start = new Zend_Form_Element_Text('date_start');
        $date_start->setLabel('Date Start')
                ->setRequired(true)
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
        $date_end = new Zend_Form_Element_Text('date_end');
        $date_end->setLabel('Date End')
                ->setRequired(true)
                ->addfilter('StripTags')
                ->addfilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class", "inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;


        $observation = new Zend_Form_Element_Text('observation');
        $observation->setLabel('Observation')
                ->setRequired(true)
                ->addfilter('StripTags')
                ->addfilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class", "inputbox")
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
            $name,
            $activity_types_id,
            $contact_own_company_id,
            $contact_client_company_id,
            $status_id,
            $date_start,
            $date_end,
            $observation,
            $submit));
    }

    public function _selectOptionsActivity_Types() {

        $sql = "SELECT id,name
                  FROM activity_types";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }

    public function setOwnCompany($v_id) {
        //set the variable  
        $this->_own_company = $v_id;
    }

    public function setClientCompany($v_id) {
        //set the variable  
        $this->_client_company = $v_id;
    }

    public function _selectOptionsStatus() {
        $sql = "SELECT id,name
                  FROM status";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }

    public function _selectOptionsContactOwnCompanies() {

        $sql = "SELECT id,name
                  FROM contacts WHERE contacts.company_id=" . $_SESSION["production"]["own_company"] . "
                AND in_litter =0
                ";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        
        return $result;
    }

    public function _selectOptionsContactClientCompanies() {
      
        $sql = "SELECT id,name
                  FROM contacts WHERE contacts.company_id=" . $_SESSION["production"]["client_company"] . "
                AND in_litter =0
                ";

        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
       
        return $result;
    }

}

