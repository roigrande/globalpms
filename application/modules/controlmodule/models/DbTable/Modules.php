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
       // Zend_Debug::dump($row, $label = null, $echo = true);
        if (!$row) {
            throw new Exception("Could not find row $modulename");
        }
        return $row->toArray();
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
  
 
}

