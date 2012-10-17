<?php

 
class Default_IndexControllerTest extends ControllerTestCase
{
    
     public function testCanGetToIndexPage() {
     $this->dispatch("/");
     echo $this->getResponse()->getBody();
     $this->assertController("index");
     $this->assertAction("index");
     //$this->assertXpathContentContains("id('message')", "default");
     
     
     //$this->assertResponseCode(200);
 }   
 
}

 