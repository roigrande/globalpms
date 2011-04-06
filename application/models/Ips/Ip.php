<?php

class Acl_Ips_Ip
{
	protected $db;
	protected $ip;
	
	
	function __construct($database, $ip)
	{
		$this->db= new Acl_Mysql_Connect($database);
		$this->ip=$ip;	
		//TODO: parametrizar
		$this->time=60; /*en segundos */
	}	
	
	public function isBlockedIp()
	{		
		$sql="SELECT ip, timestamp 
			  FROM blocked_ips 
			  WHERE ip='".$this->ip."'";
		//echo $sql;
		$arrayIp=$this->db->fetchOneArray($sql);
		
		/* La ip esta en la list negra*/
		if(isset($arrayIp['timestamp']))
		{			
			if(time()-strtotime($arrayIp['timestamp'])<$this->time)
			{
				/*	Sigue bloqueada */
				session_start();
				session_destroy();
				return $this->time-(time()-$arrayIp['timestamp']); 
			}
			else 
				/*Si ya no debe estar bloqueada*/
			{
				$this->deleteIp();
				session_start();
				session_destroy();
				return FALSE;	
			}
		}
		else
		{
			/* La ip no esta en la lista negra */
			return FALSE;
		}
	}
	
	public function insertIp()
	{
		$sql="INSERT INTO blocked_ips SET
				ip='".$this->ip."'";
		//echo $sql;
		$this->db->execute($sql);
		return;
	}
	
	public function deleteIp()
	{
		$sql="DELETE FROM blocked_ips WHERE ip='".$this->ip."'";
		//echo $sql;
		$this->db->execute($sql);
		return;	
	}

	
	
	
}