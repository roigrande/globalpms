<?php
class Controlmodule_Model_Modules extends Zend_Db_Table_Abstract
{
    
    public function getModules() {
        //TODO Hardcode la direccion de modules
        $dir = APPLICATION_PATH."/modules/";
        if (is_dir($dir)) {
            if ($dh = opendir($dir) ) {
                while (($file = readdir($dh)) !== false) {
                    if ((filetype($dir . $file)=="dir") AND ($file!=".") AND ($file!="..")){
                        $module = new User_Model_DbTable_Modules();
                        $modules[$file]["name"]=$file;
                        $modules[$file]["install"]=false;
                        $modules[$file]["id"] = "0";
                        $modules[$file]["active"] = false;
                        if ($module->fetchRow('module_name = "'.$file.'"')) {
                            $moduledb=$module->getModulename($file);
                            $modules[$file]["id"] = $moduledb["id"];
                            $modules[$file]["active"] = $moduledb["active"];
                            $modules[$file]["install"]=true;

                        }    

                    }
                }
            }
            closedir($dh);
            Zend_Debug::dump($modules);
           // die();
            return $modules;
        }
    }

}
?>
