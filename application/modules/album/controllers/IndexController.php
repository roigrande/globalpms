<?php

class Album_IndexController extends Zend_Controller_Action
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

        $albums = new Album_Model_DbTable_Albums();
        
//        var_dump ($albums);
        $this->view->albums = $albums->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Album();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->addAlbum($artist, $title);      
                               
                //Inicializamos el log
                $logger = new Zend_Log();
                //Aqui ponemos las salida por archivo TODO pasar al application.ini
                $writer = new Zend_Log_Writer_Stream('../log/zfw.log');
                $logger->addWriter($writer);
                //Aqui indicamos que solo se mostraran los mensajes que sean iguales o superiores a criticos
                $filter = new Zend_Log_Filter_Priority(Zend_Log::INFO);
                $logger=$logger->addFilter($filter);
                
                //mensajes para log   
                $logger->emerg('alta cancion del artista '.$artist);
                $logger->debug('alta cancion con titulo '.$title);
                
                $this->_helper->redirector('index');
                //Escribimos un simple mensaje 

            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        $form = new Application_Form_Album();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int) $form->getValue('id');
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->updateAlbum($id, $artist, $title);
                
                //Inicializamos el log
                $logger = new Zend_Log();
                //Aqui ponemos las salida por archivo
                $writer = new Zend_Log_Writer_Stream('../log/zfw.log');
                $logger->addWriter($writer);
                //Aqui indicamos que solo se mostraran los mensajes que sean iguales o superiores al filtro
                $filter = new Zend_Log_Filter_Priority(Zend_Log::INFO);
                $logger->addFilter($filter);
                
                $logger->alert('actualiza la informacion del title '.$title);
                              

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $albums = new Application_Model_DbTable_Albums();
                $form->populate($albums->getAlbum($id));
            }
        }
    }
    
    
public function deleteAction()
 {
    if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
            $id = $this->getRequest()->getPost('id');
            $albums = new Application_Model_DbTable_Albums();
            $albums->deleteAlbum($id);
            
            //Inicializamos el log
            $logger = new Zend_Log();
            //Aqui ponemos las salida por archivo
            $writer = new Zend_Log_Writer_Stream('../log/zfw.log');
            $logger->addWriter($writer);
            //Aqui indicamos que solo se mostraran los mensajes que sean iguales o superiores a criticos
            $filter = new Zend_Log_Filter_Priority(Zend_Log::INFO);
            $this->logger=$logger->addFilter($filter);
            
          
            $logger->notice('elimnar el album con id '.$id);
           
        }
        $this->_helper->redirector('index');
    } else {
        $id = $this->_getParam('id', 0);
        $albums = new Application_Model_DbTable_Albums();
        $this->view->album = $albums->getAlbum($id);
    }
}

}







