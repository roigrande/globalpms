<?php
 
class Default_IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {
    
    
      public function setUp() {
//      
         $this->request->setMethod('POST')
                ->setPost(array(
                    'email' => "roigd@gmail.com",
                    'password' => "1234",
                ));
        $this->dispatch("/login/");
    }
     
    
     public function testSelectCompany() {
      
        $request = $this->getRequest();
       // Zend_Debug::dump($request);
        $this->request->setMethod('POST')
            ->setPost(array(
                'company' => '1',

            ));
        $this->dispatch('/default/index/changecompany');
        $request = $this->getRequest();
    
       
            $this->dispatch('/production/production');
 
         $this->assertRedirectTo("/");
//         die();
//        $this->assertArrayHasKey('value', $responseHeaders[0]);     
//        $this->assertEquals('/', $responseHeaders[0]['value']);
//            $this->assertModule('default');
//            $this->assertController('index');
//             $this->assertAction('changecompany');
//         echo  $company->id;
//         $this->assertRedirectTo("/production/production/index");
    }
    
//      public function testAccessToUnauthorizedPageRedirectsToLogin() {
//      $this->dispatch('/user');
////      $this->assertModule('user');
////      $this->assertController('index');
////      $this->assertAction('index');
////      $this->assertRedirectTo('/login/');
//    }
//     public function testLoginRealUser() {
//        $this->dispatch('/login/index');
//         $this->request->setMethod('POST')
//        ->setPost(array(
//        'email' => 'roigd@gmail.com',
//        'password' => '1234',
//        ));
//         $this->assertRedirectTo('user/');
//         print_r( $this->getResponse() );
//
//         $this->dispatch();
//         $this->assertModule("user");
//         $this->assertRedirect;      
////        $this->assertTrue(Zend_Auth::getInstance()->hasIdentity());
//       // $this->assertModule("login");
//        
//    }
//    public function testLoginFormShouldContainLoginForms() {
//        $this->dispatch('/login');
//        $this->assertQueryCount('form', 1);
//    }
 
 
}

?>
