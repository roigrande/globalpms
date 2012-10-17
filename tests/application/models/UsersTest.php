<?php
require_once ('../application/modules/user/models/Users.php');

class User_Model_UsersTest extends ControllerTestCase 
{
	
	/**
	 * @var Model_Stats
	 */
	protected $users;
	
	public function setUp()
	{
		parent::setUp();		
		$this->users = new User_Model_Users();
	}
        
        public function testCanAddCountry()
	{
		$testCountry = "Canada";
		$this->users->AddCountry($testCountry);
		$countries = $this->users->GetCountries();
		foreach ($countries as $country)
		{
			if ($testCountry == $country)
			{
                            $this->assertEquals($country , $testCountry);			
                            break;
			}
				
		}
	}
}