<?php

class Default_Form_Languages extends Zend_Form
{

    public function init()
    {
        //$dd=$this->addPrefixPath('Forms_Models', APPLICATION_PATH.'/forms/models/', 'element');
        //Zend_Debug::dump($dd);

        $this->setMethod('post');
        $front = Zend_Controller_Front::getInstance();
        $this->setAction($front->getBaseUrl().'/default/index/changelanguage');

        $refer = new Zend_Form_Element_Hidden('refer');
        $refer->setValue(Zend_Controller_Front::getInstance()->getRequest()->getRequestUri());

        $default = new Zend_Session_Namespace('default');
                
        $language = new Zend_Form_Element_Select('language');
		$language->setRequired(true)
                 ->setValue(@$default->language)
                 ->addValidator('NotEmpty', true)
                 //->setmultiOptions($this->_selectOptions())
                 ->setmultiOptions(array('es'=>'Español',
										'en'=>'English',
										'fr'=>'Français',
										'de'=>'Deutsch',
										'ca'=>'Català',
										'it'=>'Italiano',
										'nl'=>'Nederlands',
										'pl'=>'Polski',
										'ru'=>'Русский'
										))
				 ->setAttrib('onChange', "javascript:submit()")
                 ->setAttrib('maxlength', 200)
                 ->setAttrib('size', 1)
//                 ->setDecorators(array(
//                                    'FormElements',
//                                    array('HtmlTag', array('tag' => 'div'))
//                     ))
                ;
    
	

        $this->addElements(array($language, $refer));
       
    }


  

}