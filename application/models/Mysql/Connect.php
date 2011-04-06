<?php
/**
 * MySQL Connection Class
 * 
 * MySQL Connection Manager class
 *
 * @copyright Copyright (c) 2011, Agustín F. Calderón M. <br/>
 * Creative Commons: Attribution-Noncommercial-Share Alike 3.0 Unported 
 * @version 1.0
 * @author Agustín F. Calderón M. <agustincl@gmail.com>
 * @package MySQL
 */

//require_once ($modelPath.'/Mysql/ConnectAbstract.php');

class Acl_Mysql_Connect 
	extends Acl_Mysql_ConnectAbstract 
{	
	
	protected function queryDB($sql)
	{
		$consulta = mysql_query($sql,$this->cnx) 
			or die("error en la consulta <br/><br/>".$sql." = <br/><br/>".mysql_error().' - '.mysql_errno());
		return $consulta;
	}
	/**
	 * convierte el resultado de un query en array
	 * @param resultado de query
	 * @return array asoc con el resultado
	 */
	protected function fetchResult($data)
	{
		$result=array();
		while($f=mysql_fetch_assoc($data))
		{
	//		print_r($f);
			$result[]=$f;
		}
		return $result;
	}
	
	public function fetchArray($sql)
	{
		$result=$this->queryDB($sql);
		return $this->fetchResult($result);		
	}
	
	public function fetchOneArray($sql)
	{
		$result=$this->queryDB($sql);
		return $this->fetchOneResult($result);		
	}
	
	public function execute($sql)
	{
		$result=$this->queryDB($sql);
		return $this->numRows($result);
	}
	
	protected function fetchOneResult($data)
	{
		$result=array();
		$result=mysql_fetch_assoc($data);
		return $result;
	}
	
	
	protected function numRows($recordset)
	{
		if ($recordset)
			return mysql_affected_rows($recordset);
		else
			return false;
	}
	
	public function lastId()
	{
		return mysql_insert_id($this->cnx);
	}
	
	
	
	
}