<?php
class Users_IndexControllerTest extends ControllerTestCase
{
  
	 
	public function testIndexAction()
	{
        $this->dispatch("/index/index");
//        $this->assertModule("login");
//        $this->assertController("index");
//        $this->assertAction("index");	
	$this->assertResponseCode(200);
	}
}
?>
