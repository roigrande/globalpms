<?php

class Default_Form_Companies extends Zend_Form {

    public function init() {

        $this->setMethod('post');
        $front = Zend_Controller_Front::getInstance();
        $this->setAction($front->getBaseUrl() . '/default/index/changecompany');


        $company = new Zend_Session_Namespace('company');

        $company_data = new Zend_Form_Element_Select('company');
        $company_data->setRequired(true)
                ->removeDecorator('label')
                ->setValue((int) $_SESSION["company"]["id"])
                ->addValidator('NotEmpty', true)
                 ->setmultiOptions($this->_selectOptionsCompanies())
                   ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib('onChange', "javascript:submit()")
       ;
        
        $this->addElements(array($company_data));
    }

    protected function _selectOptionsCompanies() {
      
         $sql = "SELECT companies.id,companies.name
                  FROM acl_users_has_companies,companies
                  WHERE acl_users_has_companies.companies_id=companies.id
                    AND acl_users_has_companies.acl_users_id=".$_SESSION["gpms"]["storage"]->id
       ;
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        if (!isset($_SESSION["company"]["id"]))
        {$result["0"]="Seleccionar una compañía";}
        ksort($result);
//        Zend_Debug::dump ($result);
        //TODO comprobar que no hay roles
        return $result;
    }

}

