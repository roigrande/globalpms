<?php

class Login_Form_Login extends Zend_Form
{
     public function init()
    {
                $refer = new Zend_Form_Element_Hidden('refer');
                $refer->setValue(@$_SERVER['HTTP_REFERER']?@$_SERVER['HTTP_REFERER']:@$_SERVER['REDIRECT_URL']);
                        
                $email = new Zend_Form_Element_Text('email');
                $email->setLabel('Email')
                                ->setRequired(true)
                                ->addFilter('StripTags')
                                ->addFilter('StringTrim')
                                ->addValidator('StringLength', false, array(3,80))
                                ->addValidator('emailAddress')
                                ->setAttrib('size', 30)
                                ->setAttrib('maxlength', 80)
                                ->setDecorators(array(array('ViewScript', array(
                                    'viewScript' => 'forms/_element_normal.phtml'
                                ))))
                                ->setAttrib('class', 'text-input');           
             
                $password = new Zend_Form_Element_Password('password');
                $password->setLabel('Password')
                                ->setRequired(true)
                                ->addFilter('StripTags')
                                ->addFilter('StringTrim')
                                ->addValidator('StringLength', false, array(3,20))
                                ->setAttrib('size', 30)
                                ->setAttrib('maxlength', 80)
                                ->setDecorators(array(array('ViewScript', array(
                                    'viewScript' => 'forms/_element_normal.phtml',
                                ))))
                                ->setAttrib('class', 'text-input');

        $submit = new Zend_Form_Element_Submit('submit');
                $submit->setLabel('Login')
                                ->setValue('Login')
                                ->setDecorators(array(array('ViewScript', array(
                                    'viewScript' => 'forms/_element_submit_alone.phtml'                                   
                                ))))
                                ->setAttrib('class', 'loginsubmit')                       
                                ->removeDecorator('label');
                
        $this->addElements(array($refer,$email,$password,$submit));        
        
    }

}
//    public function init()
//    {
//        $this->setName("login");
//        $this->setMethod('post');
//             
//        $this->addElement('text', 'email', array(
//            'filters'    => array('StringTrim', 'StringToLower'),
//            'validators' => array(
//                array('StringLength', false, array(0, 50)),
//            ),
//            'required'   => true,
//            'label'      => 'Email:',
//        ));
//
//        $this->addElement('password', 'password', array(
//            'filters'    => array('StringTrim'),
//            'validators' => array(
//                array('StringLength', false, array(0, 50)),
//            ),
//            'required'   => true,
//            'label'      => 'Password:',
//        ));
//
//        $this->addElement('submit', 'login', array(
//            'required' => false,
//            'ignore'   => true,
//            'label'    => 'Login',
//        ));        
//    }
