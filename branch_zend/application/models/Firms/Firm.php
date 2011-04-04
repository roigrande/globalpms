<?php

class Acl_Firms_Firm
{
	public static function getFirm($id)
	{
		require_once ($_SERVER['DOCUMENT_ROOT'].
			'/../application/configs/settings.php');
		
		$user = new Acl_Users_User($database);
		$data = $user->getUser($id);
		
		$firm=md5($data['name'].$data['email'].$data['phone'].
						$data['address'].$data['postalcode'].$data['city'].
						$data['password'].$data['gender'].$data['description'].
						$data['provinces_id'].$privateFirmKey);
		return $firm;
	}
	
	public static function getPrivateFirm()
	{
		require_once ($_SERVER['DOCUMENT_ROOT'].
			'/../application/configs/settings.php');
		return $privateFirmKey;
	}
}