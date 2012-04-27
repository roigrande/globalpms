<?php

class Production_Form_Permissionproduction extends Zend_Form {

    public function init() {
        $this->setName('permissionproduction');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->removeDecorator('label');

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
        $acl_roles_id = new Zend_Form_Element_Select('acl_roles_id');
        $acl_roles_id->setLabel('Role') 
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptions_types())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
        $acl_users_id = new Zend_Form_Element_Select('acl_users_id');
        $acl_users_id->setLabel('User') 
                ->addValidator('NotEmpty', true)
                ->setmultiOptions($this->_selectOptions_Users())
                ->setAttrib('maxlength', 200)
                ->setAttrib('size', 1)
                ->setAttrib("class", "toolboxdrop")
                ->setDecorators(array(array('ViewScript', array(
                            'viewScript' => 'forms/_element_select.phtml'))))
        ;
//        
//        $permissionproduction_types_id = new Zend_Form_Element_Multiselect('$permissionproduction_types_id');
//        $permissionproduction_types_id->setLabel('permissionproduction types')              
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
            $acl_roles_id,
            $acl_users_id,
           
            $submit));
    }              
    
    public function _selectOptions_Types() {
     
     $sql = "SELECT id,name
                  FROM acl_roles";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        foreach ($result as $key => $value) {
            if ($key<=$_SESSION['gpms']['storage']->role_id) {
                unset($result[$key]);
                }
        }
//        Zend_Debug::dump($result);
//        die();
//        
        return $result;
    }
    
    public function _selectOptions_Users() {

        $sql = "SELECT acl_users.id,contacts.name
                  FROM acl_users,contacts,permission_production
                  WHERE contacts.id=acl_users.contacts_id 
                                      AND (contacts.company_id=".$_SESSION['production']['own_company']."
                       OR contacts.company_id=". $_SESSION['production']['client_company'].
                            ")"
 
                    ;
 
         $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        
         $model = new Production_Model_Permissionproduction();
         
         foreach ($result as $key => $value) {
             
             if ($model->fetchisEntry($key,$_SESSION['production']['id'])){            
             unset($result[$key]);
            }
         }
//         Zend_Debug::dump($result,"resultado final");
//        die();
        if ($result==null){
            echo "no quedan usuarios para añadir";
            //$this->url(array('controller' => 'permissionproduction', 'action' => 'index' ));
           
        }
        
        return $result;
    }
    
}

