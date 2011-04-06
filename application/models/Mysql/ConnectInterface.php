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


interface Acl_Mysql_ConnectInterface
{	
	public function connectDB();
	public function closeDB();
	
}