<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/../application/models/mysqlConnect.php');


function getUsers($database)
{
	$users=array();
	// Conectarme a la DB
	$cnx=connectDB($database);			
	// Selecccionar la DB
	selectDB($database);				
	// Enviar la consulta
	$sql="Select * from users";
	$consulta=queryDB($sql,$cnx);									
	// Obtener los resultados
	$users=fetchResult($consulta);
	$nfila=numRows($consulta);	
		
	// Desconectarme de la DB
	
	return $users;
}

function getUser($id, $database)
{
	$user=array();
	
	// Conectarme a la DB
	$cnx=connectDB($database);			
	// Selecccionar la DB
	selectDB($database);				
	// Enviar la consulta
	$sql="SELECT * FROM users WHERE id=".$id;
	$consulta=queryDB($sql,$cnx);									
	// Obtener los resultados
	$user=fetchOneResult($consulta);
	
	$sql="SELECT users_has_languages.languages_id 
		  FROM users_has_languages 
		  WHERE users_id=".$id;
	$consulta=queryDB($sql,$cnx);	
	$userlang=fetchResult($consulta);
	foreach($userlang as $value){
		$value=$value['languages_id'];
		$user['languages'][]=$value;
	}
			
	$sql="SELECT users_has_likes.likes_id 
		  FROM users_has_likes 
		  WHERE users_id=".$id;
	$consulta=queryDB($sql,$cnx);	
	$userlikes=fetchResult($consulta);
	foreach($userlikes as $value){
		$value=$value['likes_id'];
		$user['likes'][]=$value;
	}
	

	
	
	return $user;
}

function fileName($dir, $name)
{
	$files=scandir($dir);
	
	$filename=substr($name,0,strrpos($name,'.'));
	$ext=substr($name,strrpos($name,'.'),strlen($name));
	
	$name=$filename;
	$i=0;
	while(in_array($name.$ext,$files))
	{
		$i++;
		$name=$filename."_".$i;		
	}
	
	//echo $filename;
	
	
	return $name.$ext;
}

function loadImage ()
{
	if (is_uploaded_file ($_FILES['image']['tmp_name']))
	{
		$nombreDirectorio = $_SERVER['DOCUMENT_ROOT']."/assets/uploads/";
		$nombreFichero=fileName($nombreDirectorio,$_FILES['image']['name']);
		move_uploaded_file ($_FILES['image']['tmp_name'],
							$nombreDirectorio . $nombreFichero);
	}
	else
		print ("No se ha podido subir el fichero\n");
		
	return $nombreFichero;
}

function insertUser($data,$file,$privateFirmKey,$database)
{
	if($file['image']['name']!='')
	{
		$nombreFichero=loadImage();
		$image="image='".$nombreFichero."', ";
	}
	else
		$image='';

	$lastId=0;
	// Conectarme a la DB
	$cnx=connectDB($database);			
	// Selecccionar la DB
	selectDB($database);				
	// Enviar la consulta
	$sql="INSERT INTO users SET
			name='".$data['name']."',
			email='".$data['email']."',
			phone='".$data['phone']."',
			address='".$data['address']."',
			postalcode='".$data['postalcode']."',
			city='".$data['city']."',
			password='".sha1($data['password'])."',
			gender='".$data['gender']."',
			description='".$data['description']."',					
			provinces_id=".$data['province'].",
			".$image."
			firm='".md5($data['name'].$data['email'].$data['phone'].
					$data['address'].$data['postalcode'].$data['city'].
					sha1($data['password']).$data['gender'].$data['description'].
					$data['province'].$privateFirmKey)."'					
	";
	//echo $sql;
	
	queryDB($sql,$cnx);

	$lastId=mysql_insert_id($cnx);
	if($lastId==0)
		return FALSE;
		
	foreach($data['likes'] as $value)
	{
		$sql="INSERT INTO users_has_likes SET
			users_id=".$lastId.",
			likes_id=".$value;
		queryDB($sql,$cnx);
	}
	
	foreach($data['languages'] as $value)
	{
		$sql="INSERT INTO users_has_languages SET
			users_id=".$lastId.",
			languages_id=".$value;
		queryDB($sql,$cnx);
	}
	
	return $lastId;
}

function getFirm($id, $privateFirmKey,$database)
{
	$data=getUser($id, $database);
	$firm=md5($data['name'].$data['email'].$data['phone'].
					$data['address'].$data['postalcode'].$data['city'].
					$data['password'].$data['gender'].$data['description'].
					$data['provinces_id'].$privateFirmKey);
	return $firm;
}

function getPassword($id, $database)
{
	$data=getUser($id, $database);	
	return $data['password'];
}


function updateUser($data,$file,$privateFirmKey,$database)
{	
	// Conectarme a la DB
	$cnx=connectDB($database);			
	// Selecccionar la DB
	selectDB($database);				
	// Enviar la consulta

	
	if($data['firm']!=getFirm($data['id'],$privateFirmKey,$database))
	{
		die ("La firma no esta bien");
	}
	
	$sql="UPDATE users SET
			name='".$data['name']."',
			email='".$data['email']."',
			phone='".$data['phone']."',
			address='".$data['address']."',
			postalcode='".$data['postalcode']."',
			city='".$data['city']."',
			gender='".$data['gender']."',
			description='".$data['description']."',					
			provinces_id=".$data['province'].",
			firm='".md5($data['name'].$data['email'].$data['phone'].
					$data['address'].$data['postalcode'].$data['city'].
					getPassword($data['id'],$database).$data['gender'].$data['description'].
					$data['province'].$privateFirmKey)."' 
		WHERE id=".$data['id']."					
	";
	queryDB($sql,$cnx);
		
	$sql="DELETE FROM users_has_likes WHERE
			users_id=".$data['id'];
	queryDB($sql,$cnx);
			
	foreach($data['likes'] as $value)
	{		
		$sql="INSERT INTO users_has_likes SET
			users_id=".$data['id'].",
			likes_id=".$value;
		queryDB($sql,$cnx);
	}
	
	$sql="DELETE FROM users_has_languages WHERE
			users_id=".$data['id'];
	queryDB($sql,$cnx);
	
	foreach($data['languages'] as $value)
	{
		$sql="INSERT INTO users_has_languages SET
			users_id=".$data['id'].",
			languages_id=".$value;
		queryDB($sql,$cnx);
	}

	if($file['image']['name']!='')
	{
		$imagelast=getImage($data['id'],$database);
		unlink($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'.$imagelast);
		$nombreFichero=loadImage();
		$sql="UPDATE users SET
			image='".$nombreFichero."' 
			WHERE id=".$data['id'];
		queryDB($sql,$cnx);
	}
	
	return $data['id'];
}

function getImage($id, $database)
{
	$data=getUser($id, $database);	
	return $data['image'];	
}

function deleteUser($id, $database)
{
	$cnx=connectDB($database);			
	selectDB($database);	
	
	$sql="DELETE FROM users_has_likes WHERE users_id=".$id;
	queryDB($sql,$cnx);
	$sql="DELETE FROM users_has_languages WHERE users_id=".$id;
	queryDB($sql,$cnx);
	$imagelast=getImage($id,$database);
	unlink($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'.$imagelast);
	$sql="DELETE FROM users WHERE id=".$id;
	queryDB($sql,$cnx);
	
	return;
}


