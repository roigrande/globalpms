<?php

class Controlmodule_Model_DbTable_Modules extends Zend_Db_Table_Abstract {

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
        chmod($fullFilePath, 0777);
        Zend_Debug::dump($uploadedData,"uploadedData");
        Zend_Debug::dump($fullFilePath,"fullfile");
        
        //create object
        $zip = new ZipArchive();

        // open archive 
        if ($zip->open($fullFilePath) !== TRUE) {
            die("Could not open archive");
        }
        // extract
       echo $zip->extractTo(APPLICATION_PATH . '/modules/');

        
        // close archive
        $zip->close();

        //delete file.zip
        unlink($fullFilePath);

        //chance permission for the module
        $file = explode(".", $fullFilePath);
        echo $file[0];
        chmod($file[0], 0777);

//                Zend_Debug::dump($uploadedData, '$uploadedData');
//                Zend_Debug::dump($fullFilePath, '$fullFilePath');
//                    
//                echo "done";
//                exit;
    }

    public function deleteFolderModule($carpeta) {

        $directorio = opendir($carpeta);
        
        while ($archivo = readdir($directorio)) {
            if ($archivo != '.' && $archivo != '..') { //comprobamos si es un directorio o un archivo
                if (is_dir($carpeta . '/' . $archivo)) {
                   // Zend_Debug::dump($carpeta . '/' . $archivo,"carpeta");            
                    //si es un directorio, volvemos a llamar a la función para que elimine el contenido del mismo
                    $this->deleteFolderModule($carpeta . '/' . $archivo);
             
                    rmdir($carpeta . '/' . $archivo); //borrar el directorio cuando esté vacío
                } else { //si no es un directorio, lo borramos
          //          Zend_Debug::dump($carpeta . '/' . $archivo,"fichero");            
                    unlink($carpeta . '/' . $archivo);
                    
                }
            }
        }
        
        closedir($directorio);
        
        rmdir($carpeta);
    }

    public function getTable() {

        return $this->_name;
    }

    public function install($modulename) {
        //add the module in the db
        $datamodule['module_name'] = $modulename;
        $datamodule['active'] = "1";
        $this->insert($datamodule);
        //TODO comprobar que no esta en la base de datos antes de installar si no dara error
        
        //add the resources of the module in the db       
        $dir = APPLICATION_PATH . "/modules/" . $modulename . "/controllers/";
        //TODO use config to define $dir
        $bdmodule = $this->getModulename($modulename);
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {

                while (($file = readdir($dh)) !== false) {

                    if (is_file($dir . $file) AND ($file != ".") AND ($file != "..")) {
                        //take the name of the controller
                        $resource = explode("Controller.php", $file);
                        $dataresource["module_id"] = $bdmodule["id"];
                        $dataresource["name_r"] = ucwords($bdmodule["module_name"]) . ucwords($resource["0"]);
                        $dataresource["resource"] = $bdmodule["module_name"] . ":" . $resource["0"];
                        Zend_Debug::dump($dataresource, '$uploadedData');
                        $resourcedb = new Controlmodule_Model_DbTable_Resources;
                        $idresource=$resourcedb->save($dataresource);
                        
                        //$idresource2=$resource->lastInsertId();
                        
                        Zend_Debug::dump($idresource, 'idresource');                
                  
                        //add the permission of the resources
                        $classname = ucwords($bdmodule["module_name"] . "_" . $resource["0"] . "Controller");

                      
                        include_once $dir . $resource["0"].'Controller.php';
                        echo $dir . $resource["0"].'Controller.php';
                        $arr = get_class_methods($classname);
                                Zend_Debug::dump($arr, atapermission);
                      
                        foreach ($arr as $method) {
                            if (strpos($method, 'Action') != false) {

                                //method without the word Action
                                $method = explode("Action", $method);

                                $permission = new Controlmodule_Model_DbTable_Permissions;
                                //TODO hardcode para indicar que es el administrador
                                $datapermission["role_id"] = "2";
                                $datapermission["resource_id"] = $idresource;
                                //TODO guardar en el fichero config el role por defecto del permiso
                                $datapermission["role_id"] = "1";
                                $datapermission["permission"] = $method["0"];
                                $datapermission["name"] = $method["0"] . " " . $resource["0"];
                                $datapermission["menu"] = "0";
                                Zend_Debug::dump($datapermission, $datapermission);
                            
                                $permission->save($datapermission);
                            }
                        }
                      
                    }
                }
            }

            closedir($dh);
            return $modules;
        }
    }

    public function desinstall($id) {

        // find all the resource have this module
        $resource = new Controlmodule_Model_DbTable_Resources;
        $array=$resource->fetchResources($id);
        $permission = new Controlmodule_Model_DbTable_Permissions;
        foreach ($array as $value) {
            // delete all the permmission have this resources      
     
            $permission->delete('resource_id = ' . (int) $value['id']);
            // delete the resources of the module
            $resource->deleteResource($value['id']);
        }

        //delete the module
        $this->delete('id =' . (int) $id);
    }

    public function save(array $data) {

        $fields = $this->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $this->insert($data);
    }

    public function saveUpdate(array $data) {
        //$table  = $this->getTable();
        $fields = $this->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $this->update($data, 'id = ' . (int) $data['id']);
    }

    public function backup($module_name) {

        // create object
        $zip = new ZipArchive();

        // open archive 
        if ($zip->open(APPLICATION_PATH . "/modules/" . $module_name . ".zip", ZIPARCHIVE::CREATE) !== TRUE) {
            die("Could not open archive");
        }

        // initialize an iterator
        // pass it the directory to be processed
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(APPLICATION_PATH . "/modules/" . $module_name));

        // iterate over the directory
        // add each file found to the archive
        foreach ($iterator as $key => $value) {
            $path=explode(APPLICATION_PATH."/modules/" , $key);
            $zip->addFile(realpath($key), $path["1"]) or die("ERROR: Could not add file: $key");
        }
        
        chmod(APPLICATION_PATH . "/modules/" . $module_name . ".zip", 777);
        //TODO cambiar permisos de carpeta via config
        //TODO hacer Download -->streaming         
        // close and save archive
        $zip->close();
        //$this->deleteFolderModule($module_name);
    }

}

