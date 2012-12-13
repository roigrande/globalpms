<?php //
 
class Company_IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {
    
    
      public function setUp() {
          
//        $this->getFrontController()->setDefaultModule('company');
         
        
       
    }
    public function testWithoutSelectCompanyPushtoDefaultIndexAction() {
         
        $this->dispatch("/production/");
         $this->assertRedirectTo("/");
        
    }
 
//    
//     public function testSelectCompany() {
//// 
//          $this->request->setMethod('POST')
//                ->setPost(array(
//                    'email' => "roigd@gmail.com",
//                    'password' => "1234",
//                ));
//
//        $this->dispatch('/login/index');
//        $request = $this->getRequest();
//      //  Zend_Debug::dump($request);
//        $this->request->setMethod('POST')
//            ->setPost(array(
//                'company' => '1',
//
//            ));
//        $this->dispatch('/default/index/changecompany');
//        $request = $this->getRequest();
//    
//       
//            $this->dispatch('/company/company');
//            $request = $this->getRequest();
////        Zend_Debug::dump($request);
////        die() ;
//            $this->assertRedirect();
//            $this->assertModule('company');
//            $this->assertController('company');
//             $this->assertAction('index');
////         echo  $company->id;
////         $this->assertRedirectTo("/production/production/index");
//    }
//    

 
}

?>
