<?php

class Production_Form_Resource extends Zend_Form {

    public $_supplier_id;

    public function __construct() {
        $sql = "SELECT companies.id,companies.name
                  FROM companies
                   
                  INNER JOIN suppliers ON companies.id = suppliers.companies_id
                  INNER JOIN productions_has_suppliers ON suppliers.id = productions_has_suppliers.suppliers_id
                  WHERE productions_has_suppliers.productions_id =" . $_SESSION["production"]["id"]
        ;

        $db = Zend_Registry::get('db');
        $result = $db->fetchAll($sql);
        $this->_supplier_id = $result[0]->id;

        parent::__construct();
    }

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
                ->setAttrib("class", "inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;

        $suppliers_id = new Zend_Form_Element_Select('suppliers_id');
        $suppliers_id->setLabel('suppliers')
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsSuppliers())
                ->setOptions(array('onChange' => 'javascript:getAjaxResponse("http://globalpms.es/production/resource/getdataresource/id/"+this.value,"resource_id");javascript:getAjaxResponse("http://globalpms.es/production/resource/getdata/id/"+this.value,"contacts_id");'))
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;

        $contacts_id = new Zend_Form_Element_Select('contacts_id');
        $contacts_id->setLabel('supplier contact ')
                //  ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsContactSuppliers())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;

        $resource_id = new Zend_Form_Element_Select('resource_id');
        $resource_id->setLabel('resource')
                //->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsResources())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        $unbilled_hours = new Zend_Form_Element_Text('unbilled_hours');
        $unbilled_hours->setLabel('Unbilled hours')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class", "inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;

        $facturation_types_id = new Zend_Form_Element_Select('facturation_types_id');
        $facturation_types_id->setLabel('Facturation type')
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptionsFacturation_types())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;


        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('Price')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('size', 30)
                ->setAttrib('maxlength', 80)
                ->setAttrib("class", "inputbox")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_text.phtml'))))
        ;

        $observation = new Zend_Form_Element_Text('observation');
        $observation->setLabel('observation')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
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
            $suppliers_id,
            $resource_id,
            $contacts_id,
            $unbilled_hours,
            $facturation_types_id,
            $price,
            $observation,
            $submit));
    }

    public function _selectOptionsFacturation_Types() {

        $sql = "SELECT id,name
                  FROM facturation_types";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }

    public function _selectOptionsResources() {

        $sql = "SELECT resources.id,resources.name
                  FROM resources
                  WHERE resources.companies_id =" . $this->_supplier_id;
        ;

        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        //TODO comprobar que no hay roles
        return $result;
    }

    public function _selectOptionsSuppliers() {

        $sql = "SELECT companies.id,companies.name
                  FROM companies
                   
                  INNER JOIN suppliers ON companies.id = suppliers.companies_id
                  INNER JOIN productions_has_suppliers ON suppliers.id = productions_has_suppliers.suppliers_id
                  WHERE productions_has_suppliers.productions_id =" . $_SESSION["production"]["id"]
        ;

        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);

//        $this->_supplier_id= key($result);
        //TODO comprobar que no hay roles
        return $result;
    }

    public function setSupplier($s_id) {
        //set the variable  
        $this->_supplier_id = $s_id;
    }

    public function _selectOptionsContactSuppliers() {

        $sql = "SELECT id,name
                  FROM contacts WHERE contacts.company_id=" . $this->_supplier_id . "
                AND in_litter =0
                ";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);

        return $result;
    }

}

