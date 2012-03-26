<?php

class Production_Form_Activity extends Zend_Form {

    public function init() {
        $this->setName('production');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->removeDecorator('label');
       

               
        $activity_types_id = new Zend_Form_Element_Select('activity_types_id');
        $activity_types_id->setLabel('Type')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptions_activity_types())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class","toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        
        $this->setName('productions_id');
        $productions_id = new Zend_Form_Element_Hidden('productions_id');
        $id->addFilter('Int');
        $id->removeDecorator('label');
        
        $status_id = new Zend_Form_Element_Select('status_id');
        $status_id->setLabel('Status')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsStatus())
                ->setAttrib('maxlength', 300)
                ->setAttrib('size', 1)
                ->setAttrib("class","toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        
        
        $responsible = new Zend_Form_Element_Text('responsible');
        $responsible->setLabel('Responsible')
                
                ->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('StringLength', false, array(3, 20))
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class","inputbox")              
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;
        
        
        $responsible_phone = new Zend_Form_Element_Text('responsible_phone');
        $responsible_phone->setLabel('responsible phone')
                
                ->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('StringLength', false, array(3, 20))
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class","inputbox")              
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;
        
        
        $companies_id = new Zend_Form_Element_Select('companies_id');
        $companies_id->setLabel('Companies')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptions_company())
                ->setAttrib('maxlength', 300)
                ->setAttrib('size', 1)
                ->setAttrib("class","toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        
        $client_resp_name = new Zend_Form_Element_Select('client_resp_name');
        $client_resp_name->setLabel('client name')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptions_Contact())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class","toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        
        $client_resp_phone = new Zend_Form_Element_Text('client_resp_phone');
        $client_resp_phone->setLabel('Phone client')
                
                ->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('StringLength', false, array(3, 20))
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class","inputbox")              
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;
                
              
       
        $date_start = new Zend_Form_Element_Text('date_start');
        $date_start->setLabel('Date Start')
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
        
        $date_end = new Zend_Form_Element_Text('date_end');
        $date_end->setLabel('Date End')
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
          
           
            $activity_types_id,
            $status_id,
            $responsible,
            $responsible_phone,
            $companies_id,
            $client_resp_name,
            $client_resp_phone,
            $date_start,
            $date_end,
            $observation,
            
            $submit));
    }
    protected function _selectOptionsStatus() {
        $sql = "SELECT id,name
                  FROM status";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }
    
    protected function _selectOptions() {
        $sql = "SELECT id,name
                  FROM productions";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }

    protected function _selectOptions_activity_types() {
        $sql = "SELECT id,name 
                  FROM activity_types";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }
    
    protected function _selectOptions_company() {
      //todo contacts where id_company= id:_clients
        $sql = "SELECT id,name 
                  FROM companies";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }
    
    protected function _selectOptions_contact() {
      //todo contacts where id_company= id:_clients
        $sql = "SELECT id,name 
                  FROM contacts";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }
}

