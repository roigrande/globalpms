<?php

class Acl_Images_Image
{
	
	public static function loadImage ()
	{
		if (is_uploaded_file ($_FILES['image']['tmp_name']))
		{
			$nombreDirectorio = $_SERVER['DOCUMENT_ROOT']."/assets/uploads/";
			$nombreFichero=self::fileName($nombreDirectorio,$_FILES['image']['name']);
			move_uploaded_file ($_FILES['image']['tmp_name'],
								$nombreDirectorio . $nombreFichero);
		}
		else
			print ("No se ha podido subir el fichero\n");
			
		return $nombreFichero;
	}
	
	public static function fileName($dir, $name)
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
		return $name.$ext;
	}
}