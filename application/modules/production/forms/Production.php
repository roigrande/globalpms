<?php

class Production_Form_Production extends Zend_Form {

    public function init() {
        $this->setName('production');
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
        
 
        $client_companies_id = new Zend_Form_Element_Select('client_companies_id');
        $client_companies_id->setLabel('Client Company')
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsClientCompanies())
                ->setAttrib('maxlength', 300)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        $production_types_id = new Zend_Form_Element_Select('production_types_id');
        $production_types_id->setLabel('Type')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsProduction_types())
                ->setAttrib('maxlength', 300)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;

        $direction = new Zend_Form_Element_Text('direction');
        $direction->setLabel('Direction')
                ->addValidator('NotEmpty', true)
                ->addfilter('StripTags')
                ->addfilter('StringTrim')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class", "inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
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
        $start_time = new Zend_Form_Element_Text('start_time');
        $start_time->setLabel('Start date')
                   ->setRequired(true)
                   ->addValidator('Date', false, array('yyyy-mm-dd hh:ii:ss'))
                   ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_datapicker.phtml'))))
//                   ->setDecorators($this->decorators)
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

        $budget = new Zend_Form_Element_Text('budget');
        $budget->setLabel('budget')
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
            $client_companies_id,
            $status_id,
            $production_types_id,
            $direction,
            $start_time,
            $date_start,
            $date_end,
            $observation,
            $budget,
            $submit));
    }
 
    protected function _selectOptionsClientCompanies() {
        $sql = "SELECT id,name
                FROM companies
                WHERE companies.in_litter=0
                ORDER by name
               ";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }

    protected function _selectOptionsStatus() {
        $sql = "SELECT id,name
                  FROM status
                ORDER BY id  
                ";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }

    protected function _selectOptionsProduction_types() {
        $sql = "SELECT id,name
                  FROM production_types
                  ORDER BY name";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }

}
