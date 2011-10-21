<?php

/**
 * This is the Data Mapper class for the Acl_modules table.
 */
class Controlmodule_Model_Modules {

    /** Model_Module_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Module_Table
     */
    public function getTable() {
        if (null === $this->_table) {
            $this->_table = new Controlmodule_Model_DbTable_Modules();
        }
        return $this->_table;
    }
    
      /* Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */

    public function save(array $data) {
        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
        return $table->insert($data);
    }

    /* Update entry
     * 
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */

    public function update(array $data, $where) {
        $table = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }
    
        return $table->update($data, $where);
    }

    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntry($where) {
        $table = $this->getTable();
        $select = $table->select()->where($where);
        return $table->fetchRow($select);
    }

   
    /**
     *  Fetch all sql entries for the $role_id
     * 
     * @return array
     */
    public function fetchEntrys($where) {

        $table = $this->getTable();
        $select = $table->select()->where($where);

        return $table->fetchAll($select)->toArray();
    }


    public function getModules() {

        $dir = APPLICATION_PATH;
        $dir .= Zend_Registry::get('controlmodule')->dir;
        $i=0;
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ((filetype($dir . $file) == "dir") AND ($file != ".") AND ($file != "..")) {
                        $modules[$file]["name"] = $file;
                        $modules[$file]["install"] = false;
                        $modules[$file]["id"] = "0";
                        $modules[$file]["active"] = false;                      
                        $moduledb=$this->fetchEntry('name = "' . $file . '"');
                        if ($moduledb) {                
                            $modules[$file]["id"] = $moduledb["id"];
                            $modules[$file]["active"] = $moduledb["active"];
                            $modules[$file]["install"] = true;
                            
                        }
                    }
                }
            }
            closedir($dh);
            
            return $modules;
        }
    }

    public function getModule($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
   
    public function addModule($data) {

        $uploadedData = $data->getValues();
        $fullFilePath = $data->file->getFileName();

        // chance the permission of the file
        chmod($fullFilePath, 0777);
        Zend_Debug::dump($uploadedData, "uploadedData");
        Zend_Debug::dump($fullFilePath, "fullfile");

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
        chmod($file[0], 0777);

    }

    public function deleteFolderModule($folder) {

        $directorio = opendir($folder);
        

        while ($archivo = readdir($directorio)) {
            if ($archivo != '.' && $archivo != '..') { //comprobamos si es un directorio o un archivo
                if (is_dir($folder . '/' . $archivo)) {
                    // Zend_Debug::dump($foler . '/' . $archivo,"foler");            
                    //si es un directorio, volvemos a llamar a la función para que elimine el contenido del mismo
                    $this->deleteFolderModule($foler . '/' . $archivo);

                    rmdir($folder . '/' . $archivo); //borrar el directorio cuando esté vacío
                } else { //si no es un directorio, lo borramos
                    //          Zend_Debug::dump($foler . '/' . $archivo,"fichero");            
                    unlink($folder . '/' . $archivo);
                }
            }
        }
        
        closedir($directorio);
        rmdir($folder);
    }

    public function install($modulename) {
        //add the module in the db
        $datamodule['name'] = $modulename;
        $datamodule['active'] = "1";
        $this->getTable()->insert($datamodule);
        //add the resources of the module in the db       
        $dir = APPLICATION_PATH . "/modules/" . $modulename . "/controllers/";
        //TODO use config to define $dir
        echo $modulename;
        $bdmodule = $this->fetchEntry("name =  '$modulename'");
         Zend_Debug::dump($bdmodule["id"], '$uploadedData');
      
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {

                while (($file = readdir($dh)) !== false) {

                    if (is_file($dir . $file) AND ($file != ".") AND ($file != "..")) {
                        //take the name of the controller
                        $resource = explode("Controller.php", $file);
                        $dataresource["module_id"] = $bdmodule["id"];

                        $dataresource["name_r"] = ucwords($bdmodule["name"]) . ucwords($resource["0"]);
                        $dataresource["resource"] = $bdmodule["name"] . ":" . strtolower($resource["0"]);
                        Zend_Debug::dump($dataresource, '$uploadedData');
                        $resourcedb = new Controlmodule_Model_DbTable_Resources();                                       
                        $idresource = $resourcedb->insert($dataresource);
                        //add the permission of the resources
                        $classname = ucwords($bdmodule["name"] . "_" . $resource["0"] . "Controller");


                        include_once $dir . $resource["0"] . 'Controller.php';
                        echo $dir . $resource["0"] . 'Controller.php';
                        $arr = get_class_methods($classname);
                        Zend_Debug::dump($arr, "atapermission");

                        foreach ($arr as $method) {
                            if (strpos($method, 'Action') != false) {

                                //method without the word Action
                                $method = explode("Action", $method);

                                //TODO hardcode para indicar que es el administrador
                                $datapermission["role_id"] = "2";
                                $datapermission["resource_id"] = $idresource;
                                //TODO guardar en el fichero config el role por defecto del permiso
                                $datapermission["role_id"] = "1";
                                $datapermission["permission"] = $method["0"];
                                $datapermission["name"] = $method["0"] . " " . $resource["0"];
                                $datapermission["menu"] = "0";
                                $permission = new Controlmodule_Model_DbTable_Permissions;
                               
                                $permission->insert($datapermission);
                            }
                        }
                    }
                }
            }

            closedir($dh);
            return $modules;
        }
    }

    public function uninstall($id) {

        // find all the resource have this module
        $resource = new Controlmodule_Model_DbTable_Resources();
        $array = $resource->fetchResources($id);
   //     Zend_Debug::dump($array);
        $permission = new Controlmodule_Model_DbTable_Permissions();
        foreach ($array as $value) {
            // delete all the resources have this module      
            $resource->delete($value['id']);
        }

        //delete the module
        $this->getTable()->delete('id = ' . $id);
    }

    public function backup($name) {

        // create object
        $zip = new ZipArchive();

        // open archive 
        if ($zip->open(APPLICATION_PATH . "/modules/" . $name . ".zip", ZIPARCHIVE::CREATE) !== TRUE) {
            die("Could not open archive");
        }

        // initialize an iterator
        // pass it the directory to be processed
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(APPLICATION_PATH . "/modules/" . $name));

        // iterate over the directory
        // add each file found to the archive
        foreach ($iterator as $key => $value) {
            $path = explode(APPLICATION_PATH . "/modules/", $key);
            $zip->addFile(realpath($key), $path["1"]) or die("ERROR: Could not add file: $key");
        }

        //TODO cambiar permisos de foler via config
        //TODO hacer Download -->streaming         
        // close and save archive
        $zip->close();

        //$this->deleteFolderModule($name);
    }

    
}
?>
