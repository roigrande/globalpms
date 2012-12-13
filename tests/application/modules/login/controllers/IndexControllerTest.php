<?php

//

class Login_IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp() {
        // $this->getFrontController()->setDefaultModule('default');
    }
    //funcion para loguearse 
    private function loginUser($user, $password) {
        $this->request->setMethod('POST')
                ->setPost(array(
                    'email' => $user,
                    'password' => $password,
                ));

        $this->dispatch('/login/index');
        
        $this->assertTrue(Zend_Auth::getInstance()->hasIdentity());

        $this->request->setPost(array());
    }
        
    //comprueba que se puede acceder a una pagina para loguearse
    public function testIndexAction() {
        $this->dispatch("login/index/index");
        $this->assertModule("login");
        $this->assertController("index");
        $this->assertAction("index");
        $this->assertResponseCode(200);
    }
    //comprueba que si no esta logueado cualquier modulo que intenta acceder lo reenvia a login
    public function testCallWithoutActionShouldPullFromIndexAction() {
        
        $this->assertFalse(Zend_Auth::getInstance()->hasIdentity());
        $this->dispatch('/user');
        $this->assertModule('login');
       
    }
    // comprueba en caso de enviar datos incorrectos de redirige al controlador de errores
    public function testCallWithWrongValidationShouldPullFromErrorAction() {
        $this->request->setMethod('POST')
                ->setPost(array(
                    'email' => "wrong_email",
                    'password' => "wrong_password",
                ));
        $this->dispatch('/login/index');      
        $this->assertRedirectTo("/login/error/error");
        
    }
 
    
    //comprueba que si te logease te dirige a default 
    public function testAuthenticatedUserCanMoveToTheDefaultModule() {

        $this->loginUser('roigd@gmail.com', '1234');
        $this->assertRedirectTo('/');
    }
    
    //comprueba que el usuario se desloguea
    public function testLogOutUserWithAuthentication() {
//      
        $this->loginUser('roigd@gmail.com', '1234');
        $this->request->setMethod('GET');
        
      
//        Zend_Debug::dump(Zend_Auth::getInstance()->hasIdentity());
 
        $this->dispatch("/login/index/logout");
//         Zend_Debug::dump(  $this->request->setMethod('GET'),"dsdsds");
//        Zend_Debug::dump(Zend_Auth::getInstance()->hasIdentity());
//        $this->assertRedirect("/");
//        $responseHeaders = $this->response->getHeaders();
//        $this->assertTrue(count($responseHeaders) != 0);
//         Zend_Debug::dump($this->response->getHeaders());
//         die();
//        $this->assertArrayHasKey('value', $responseHeaders[0]);
//        
//        $this->assertEquals('/', $responseHeaders[0]['value']);
//        Zend_Debug::dump(Zend_Auth::getInstance()->hasIdentity());
//        $this->assertFalse(Zend_Auth::getInstance()->hasIdentity());
//       
    }
//comprueva que hay un formulario
    public function testLoginFormShouldContainLoginForms() {
        $this->dispatch('/login');
        $this->assertQueryCount('form', 1);
    }
 
}

?>
