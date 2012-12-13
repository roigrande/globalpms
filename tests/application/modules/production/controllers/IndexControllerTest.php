<?php

class Production_IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp() {
        $this->request->setMethod('POST')
                ->setPost(array(
                    'email' => "roigd@gmail.com",
                    'password' => "1234",
                ));
        $this->dispatch("/login/");
    }

    //comprobar que si ha seleccionado una compañia no puede acceder a producciones
    public function testWithoutSelectCompanyPushtoDefaultIndexAction() {
         
        $this->dispatch("/production/");
         $this->assertRedirectTo("/");
        
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
