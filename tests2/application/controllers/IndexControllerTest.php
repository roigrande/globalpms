<?php
class IndexControllerTest extends ControllerTestCase
{
    
     public function testCanGetToIndexPage() {
     $this->dispatch("/");
     echo $this->getResponse()->getBody();
     $this->assertController("index");
     $this->assertAction("index");
     //$this->assertXpathContentContains("id('message')", "default");
     
     
     //$this->assertResponseCode(200);
 }   
 public function testCanGetToAboutPage() {
     $this->dispatch("/index/about");
     echo $this->getResponse()->getBody();
     $this->assertController("index");
     $this->assertAction("about");
     $this->assertResponseCode(200);
     //$this->assertResponseCode(200);
 }   
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
