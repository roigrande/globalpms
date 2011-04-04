<?php

class Acl_Users_User 
	extends Acl_Users_UserAbstract
{
	public function getUsers()
	{		
		$sql="Select * from users";
		return $this->db->fetchArray($sql);
	}
	
	public function getUser($id)
	{
		$user=array();		
		$sql="SELECT * FROM users WHERE id=".$id;
		$user=$this->db->fetchOneArray($sql);
		
		$sql="SELECT users_has_languages.languages_id 
			  FROM users_has_languages 
			  WHERE users_id=".$id;			
		$userlang=$this->db->fetchArray($sql);
		
		foreach($userlang as $value){
			$value=$value['languages_id'];
			$user['languages'][]=$value;
		}
				
		$sql="SELECT users_has_likes.likes_id 
			  FROM users_has_likes 
			  WHERE users_id=".$id;	
		$userlikes=$this->db->fetchArray($sql);
		
		foreach($userlikes as $value){
			$value=$value['likes_id'];
			$user['likes'][]=$value;
		}
		return $user;
	}
	
	public function insertUser($data,$file)
	{
		if($file['image']['name']!='')
		{
			$nombreFichero=Acl_Images_Image::loadImage();
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
						$data['province'].Acl_Firms_Firm::getPrivateFirm())."'					
		";
		//echo $sql;
		$this->db->execute($sql);	
	
		$lastId=$this->db->lastId();
		if($lastId==0)
			return FALSE;
			
		foreach($data['likes'] as $value)
		{
			$sql="INSERT INTO users_has_likes SET
				users_id=".$lastId.",
				likes_id=".$value;
			$this->db->execute($sql);
		}
		
		foreach($data['languages'] as $value)
		{
			$sql="INSERT INTO users_has_languages SET
				users_id=".$lastId.",
				languages_id=".$value;
			$this->db->execute($sql);
		}
		
		return $lastId;
	}
		
	
	public function updateUser($data,$file)
	{	
		if($data['firm']!=Acl_Firms_Firm::getFirm($data['id']))
		{
			die ("La firma no esta bien");
		}
		
		$user=$this->db->getUser($data['id']);
				
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
						$user['password'].$data['gender'].$data['description'].
						$data['province'].Acl_Firms_Firm::getPrivateFirm())."' 
			WHERE id=".$data['id']."					
		";
		$this->db->execute($sql);	
			
		$sql="DELETE FROM users_has_likes WHERE
				users_id=".$data['id'];
		$this->db->execute($sql);	
				
		foreach($data['likes'] as $value)
		{		
			$sql="INSERT INTO users_has_likes SET
				users_id=".$data['id'].",
				likes_id=".$value;
			$this->db->execute($sql);	
		}
		
		$sql="DELETE FROM users_has_languages WHERE
				users_id=".$data['id'];
		$this->db->execute($sql);	
		
		foreach($data['languages'] as $value)
		{
			$sql="INSERT INTO users_has_languages SET
				users_id=".$data['id'].",
				languages_id=".$value;
			$this->db->execute($sql);	
		}
	
		if($file['image']['name']!='')
		{
			$imagelast=$user['image'];
			unlink($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'.$imagelast);
			$nombreFichero=Acl_Images_Image::loadImage();
			$sql="UPDATE users SET
				image='".$nombreFichero."' 
				WHERE id=".$data['id'];
			$this->db->execute($sql);	
		}
		
		return $data['id'];
	}
	
	
	
	public function deleteUser($id)
	{
		$user=$this->db->getUser($id);
		
		$sql="DELETE FROM users_has_likes WHERE users_id=".$id;
		$this->db->execute($sql);	
		$sql="DELETE FROM users_has_languages WHERE users_id=".$id;
		$this->db->execute($sql);	
		$imagelast=$user['image'];
		unlink($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'.$imagelast);
		$sql="DELETE FROM users WHERE id=".$id;
		$this->db->execute($sql);
		
		return;
	}
}

