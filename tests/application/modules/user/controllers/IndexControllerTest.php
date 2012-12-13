<?php

class Users_IndexControllerTest extends ControllerTestCase {
//
//    public function setUp() {
//          $this->getFrontController()->setDefaultModule('default');
//       
//          $this->request->setMethod('POST')
//                ->setPost(array(
//                    'email' => 'roigrande',
//                    'password' => '1234',
//                ));
//        $this->dispatch('/login/index');
////        $this->assertTrue(Zend_Auth::getInstance()->hasIdentity());
//        parent::setUp();
//    }

    public function testIndexAction() {
        $this->dispatch("/user/");
//        $this->assertModule("user");
//        $this->assertController("index");
//        $this->assertAction("index");	
        $this->assertResponseCode(200);
    }

}

?>
