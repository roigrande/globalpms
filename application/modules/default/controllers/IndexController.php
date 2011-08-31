<?php

class Default_IndexController extends Zend_Controller_Action
{
//    function __construct()
//	{
//		
//        parent::_construct();
//         //Inicializamos el log
//        $logger = new Zend_Log();
//        //Aqui ponemos las salida por archivo
//        $writer = new Zend_Log_Writer_Stream('../log/zfw.log');
//        $logger->addWriter($writer);
//        //Aqui indicamos que solo se mostraran los mensajes que sean iguales o superiores a criticos
//        $filter = new Zend_Log_Filter_Priority(Zend_Log::CRIT);
//        $this->logger=$logger->addFilter($filter);
//	}
    public function init()
    {
        
    }

    function indexAction()
    {

    }
    
	public function changelanguageAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);

        $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {                        	
            	$locale = new Zend_Locale($request->getPost('language'));            	
                $default = new Zend_Session_Namespace('default');
                $default->language = $locale->getLanguage();
                $default->locale = $locale->getRegion();
                $this->_redirect($request->getPost('refer'));            
        }
    	else {
			return;
		}
        return;       
    }

   

}







