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

//require_once ($modelPath.'/Mysql/ConnectInterface.php');

abstract class Acl_Mysql_ConnectAbstract
	implements Acl_Mysql_ConnectInterface
{	
	protected $database;
	protected $cnx;
	
	function __construct($database)
	{
		$this->database=$database;
		$this->cnx=$this->connectDB();
		$this->selectDB();		
	}
	
	function __destruct()
	{
//		$this->closeDB();
	}
		
	abstract protected function queryDB($sql);
	abstract protected function fetchResult($data);
	abstract protected function fetchOneResult($data);
	
	abstract public function fetchArray($sql);
	abstract public function fetchOneArray($sql);	
	abstract protected function numRows($recordset);
	
	public function connectDB()
	{
		$conexion=mysql_connect($this->database['server'],
								$this->database['user'],
								$this->database["password"])
			or die ('no se puede conectar a la base de datos');
		return $conexion;
	}
	
	private function selectDB()
	{
		mysql_select_db($this->database['db'])
			or die ('no se puede seleccionar la base de datos');
	}
	
	public function closeDB()
	{
		@mysql_close($this->cnx);
		return;
	}
	
	
}