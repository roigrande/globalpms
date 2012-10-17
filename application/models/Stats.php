<?php

class Model_Stats 
{
	protected $countries = array();
	

	public function AddCountry($country)
	{
		if (array_key_exists($country , $this->countries))
			$this->countries[$country]++;

		else
			$this->countries[$country] = 1;
	}
	public function GetCountries()
	{
		return array_keys($this->countries);
	}
}
