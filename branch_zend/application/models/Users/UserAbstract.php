<?php

abstract class Acl_Users_UserAbstract
{
	protected $db;
	protected $privateFirmKey;
	protected $dir;
	protected $name;
	protected $id;
	
	
	function __construct($database)
	{
		$this->db= new Acl_Mysql_Connect($database);	
	}
	
	function __destruct()
	{
	
	}
	
	abstract public function getUsers();
	abstract public function getUser($id);
	abstract public function insertUser($data,$file);
	abstract public function updateUser($data,$file);
	abstract public function deleteUser($id);
	
}

