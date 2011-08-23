<?php
class Controlmodule_Model_DbTable_Modules extends Zend_Db_Table_Abstract
{

    protected $_name = 'acl_modules';
                
    public function getModule($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function getModulename($modulename) {
        $row = $this->fetchRow("module_name =  '$modulename'");
       
        if (!$row) {
            throw new Exception("Could not find row $modulename");
        }
        return $row->toArray();
    }
    
    public function addModule($form) {
       
        $uploadedData = $form->getValues(); 
        $fullFilePath = $form->file->getFileName();
    
        // chance the permission of the file
        chmod ($fullFilePath,0777);
        
        //create object
        $zip = new ZipArchive();   

        // open archive 
        if ($zip->open($fullFilePath) !== TRUE) {
            die ("Could not open archive");
        }
        // extract
        $zip->extractTo(APPLICATION_PATH.'/modules/');

        // close archive
        $zip->close();

        //delete file.zip
        unlink($fullFilePath);
        
        //chance permission for the module
        $file=explode(".", $fullFilePath);
        echo $file[0];
        chmod ($file[0],0777);

//                Zend_Debug::dump($uploadedData, '$uploadedData');
//                Zend_Debug::dump($fullFilePath, '$fullFilePath');
//                    
//                echo "done";
//                exit;
    }

    public function deleteModule($id) {
        
        $this->delete('id =' . (int) $id);
    }
    
    
    
    public function deleteFolderModule($carpeta) {

        $directorio = opendir($carpeta);
        while ($archivo = readdir($directorio)) {
            if ($archivo != '.' && $archivo != '..') { //comprobamos si es un directorio o un archivo
                if (is_dir($carpeta . '/' . $archivo)) {
                //si es un directorio, volvemos a llamar a la función para que elimine el contenido del mismo
                    eliminar_recursivo_contenido_de_directorio($carpeta . '/' . $archivo);
                    rmdir($carpeta . '/' . $archivo); //borrar el directorio cuando esté vacío
                } else { //si no es un directorio, lo borramos
                    unlink($carpeta . '/' . $archivo);
                }
            }
        }
        closedir($directorio);
        rmdir($carpeta);
    }

    public function getTable(){
        
        return $this->_name;
    }
    
   public function install($modulename)
    {
       $data['module_name']=$modulename;
       $data['active']="1";
        
        return $this->insert($data);
    }
   public function desinstall($module) {
        $this->delete("module_name= '$module'");
            
   }
     
   public function save(array $data)
    {
             
        $fields = $this->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $this->insert($data);
    }
    public function saveUpdate(array $data)
    {
        //$table  = $this->getTable();
        $fields = $this->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $this->update($data,'id = ' . (int) $data['id']);
    }
    public function backup($module_name) {
       
       ini_set('max_execution_time', 300);

        // create object
        $zip = new ZipArchive
       ();

        // open archive 
        if ($zip->open(APPLICATION_PATH."/modules/".$module_name.".zip", ZIPARCHIVE::CREATE) !== TRUE) {
            die ("Could not open archive");
        }

        // initialize an iterator
        // pass it the directory to be processed
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(APPLICATION_PATH."/modules/".$module_name));
        
        // iterate over the directory
        // add each file found to the archive
        foreach ($iterator as $key=>$value) {
            $zip->addFile(realpath($key), $key) or die ("ERROR: Could not add file: $key");        
        }
        
        chmod (APPLICATION_PATH."/modules/".$module_name.".zip",777);
                
        // close and save archive
        $zip->close();
        //$this->deleteFolderModule($module_name);
  
            
   }
  
 
}

