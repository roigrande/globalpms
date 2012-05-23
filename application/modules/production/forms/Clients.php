<?php //

class Production_Form_Clients extends Zend_Form {

//    public function init() {
//        $this->setName('production');
//        $id = new Zend_Form_Element_Hidden('id');
//        $id->addFilter('Int');
//        $id->removeDecorator('label');
// 
// 
//        $client_companies_id = new Zend_Form_Element_Select('client_companies_id');
//        $client_companies_id->setLabel('Client')
//                ->addValidator('NotEmpty', true)
//                ->setmultiOptions($this->_selectOptionsClientCompanies())
//                ->setAttrib('maxlength', 300)
//                ->setAttrib('size', 1)
//                ->setAttrib("class", "toolboxdrop")
//                ->setDecorators(array(array('ViewScript', array(
//                            'viewScript' => 'forms/_element_select.phtml'))))
//        ;
//         
//
//        $submit = new Zend_Form_Element_Submit('submit');
//        $submit->setValue('Selecionar')
//                ->setAttrib('id', 'submitbutton')
//                ->setDecorators(array(array('ViewScript', array(
//                            'viewScript' => 'forms/_element_submit.phtml'))))
//                ->setAttrib('class', 'btn')
//                ->removeDecorator('label')
//        ;
//        $this->addElements(array($id,           
//            $client_companies_id,            
//            $submit));
//    }
// 
//    protected function _selectOptionsClientCompanies() {
//        $sql = "SELECT id,name
//                FROM companies
//                WHERE companies.in_litter=0
//                ORDER by name
//               ";
//        $db = Zend_Registry::get('db');
//        $result = $db->fetchPairs($sql);
//        //TODO comprobar que no hay roles
//        return $result;
//    }
//
//    protected function _selectOptionsStatus() {
//        $sql = "SELECT id,name
//                  FROM status
//                ORDER BY id  
//                ";
//        $db = Zend_Registry::get('db');
//        $result = $db->fetchPairs($sql);
//        //TODO comprobar que no hay roles
//        return $result;
//    }
//
//    protected function _selectOptionsProduction_types() {
//        $sql = "SELECT id,name
//                  FROM production_types
//                  ORDER BY name";
//        $db = Zend_Registry::get('db');
//        $result = $db->fetchPairs($sql);
//        //TODO comprobar que no hay roles
//        return $result;
//    }

}
