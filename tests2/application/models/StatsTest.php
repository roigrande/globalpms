<?php
require_once ('../application/models/Stats.php');

class Model_StatsTest extends ControllerTestCase 
{	
//   
	/**
	 * @var Model_Stats
	 */
	protected $stats;
	
	public function setUp()
	{
		parent::setUp();		
		$this->stats = new Model_Stats();
	}
	
	public function testCanAddCountry()
	{
		$testCountry = "Canada";
                $this->assertEquals( 0 , count($this->stats->GetCountries()));
		$this->stats->AddCountry($testCountry);
//		$countries = $this->stats->GetCountries();
		foreach ($this->stats->GetCountries() as $country)
		{
			if ($testCountry == $country)
			{
				$this->assertEquals($country , $testCountry);			
				
			}
                        $this->assertEquals(1, count($this->stats->GetCountries()));
		}
	}
	


}