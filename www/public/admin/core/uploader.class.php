<?php
// Constants to handle events
define('onAfterUpload',    0x001);
define('onBeforeUpload',   0x002);

// Manejar los comandos para descomprimir los ZIP
define('CMD_UNZIP',  '/usr/bin/unzip');
define('CMD_TAR',    '/bin/tar');
define('CMD_GUNZIP', '/bin/gunzip');

// Valores por defecto al reescalar
define('DEFAULT_WIDTH', 240);
define('DEFAULT_HEIGHT', 130);

// Configuración para YouTube
define('YOUTUBE_USER', "galimundo");
define('YOUTUBE_PASS', "*g4L1mund0*");

class Uploader {
    /**
     * Nombre del campo file en el formulario
    */
    var $name       = NULL;

    /**
     * Nombre base del fichero
    */
    var $basename   = NULL;
    
    /**
     * Path del fichero subido    
    */
    var $path       = NULL;
    
    /**
     * Extensión del fichero
    */
    var $extension  = NULL;
    
    
    // Private attributes
    
    /**
     * Array de eventos
    */    
    var $_events    = array();
    var $_env       = array();
    var $_directives = array('upload_max_filesize',
                             'post_max_size',
                             'file_uploads',
                             'max_execution_time');
    
    function Uploader($name=NULL) {
        // Inicializar eventos
        $this->_initEvents();
        
        // Nombre del campo del formulario
        $this->name = $name;
    }
    
    function __construct($name=NULL) {
        $this->Uploader($name);
    }
    
    function setPathUpload( $path ) {
        $this->path = realpath($path).'/';
    }
    
    function upload() {
        if( !is_null($this->name) && !is_null($this->path)) {
            
            // Disparar evento antes de Upload
            $this->fireEvent( onBeforeUpload );
            
            $uploaddir = $this->path;
            $uploadfile = $uploaddir . basename($_FILES[ $this->name ]['name']);
            
            $GLOBALS['application']->logger->debug('UploadFile: '.$uploadfile);
            if (move_uploaded_file($_FILES[ $this->name ]['tmp_name'], $uploadfile)) {
                $this->basename = basename( $uploadfile );
                $this->path = dirname( $uploadfile ).'/';
                
                // Disparar evento después de Upload
                $this->fireEvent( onAfterUpload );
                
                return( true );
            } else {
                $this->_errors[] = 'Error subiendo el fichero.';
            }
        } else {
            $this->_errors[] = 'No se puede subir el fichero.';
        }
        
        return(false);
    }
    
    function progressStatus($uniqid) {
        $progress_stats = array();
        if(extension_loaded('apc')) {
            $progress_stats = apc_fetch('upload_'.$uniqid);
            /* header('FirePHP-Data: '.json_encode($progress_stats));
            header('FirePHP-Renderer: http://localhost/ServerNetPanelRenderer.js'); */

            $progress_stats['apc'] = (isset($progress_stats['current']));            
        } else {
            $progress_stats['apc'] = false;
        }
        
        return( $progress_stats );
    }
    
    function registerEvent($type, $callback, $params=null) {
        if(is_null($params)) {
            $params = array();
        }
        
        $this->_events[ $type ][] = array($callback, $params);
    }
    
    function fireEvent($type) {
        foreach($this->_events[$type] as $evt) {
            // Comprobar si existe como método
            if( method_exists($this, $evt[0]) ) {
                call_user_method_array ( $evt[0], $this, $evt[1] );
            } else {
                // Comprobar si existe como función
                if( function_exists($evt[0]) ) {
                    call_user_func_array($evt[0], $evt[1]);
                }
            }
        }
    }
    
    
    // Miscelaneous events /////////////////////////////////////////////////////
    
    /**
     * Recargar el formulario principal
    */  
    function reload_form() {
        // Para el script de Ajax y redirige al formulario de nuevo
        echo( '<script language="javascript">parent.finish();location.href="?action=upload-finish&path='.$this->path.'";</script>' );
    }
    
    /**
     * Maneja los ficheros comprimidos para descomprimirlos directamente
    */
    function descompress_file($purge=false) {
        $file = $this->path.$this->basename;
        $process = false;
        
        // Cambiar el directorio para que descomprima en el directorio de $this->path
        $current_dir = getcwd();
        chdir($this->path);
        
        if(preg_match('/\.zip$/i', $this->basename)) {
            system(CMD_UNZIP.' ' . $file);
            $process = true;
        }
        
        if(preg_match('/\.tar$/i', $this->basename)) {    
            system(CMD_TAR . ' -xvf ' . $file);
            $process = true;
        }
    
        if(preg_match('/(\.tar\.gz|\.tgz)$/i', $this->basename)) {
            system(CMD_TAR . ' -xzvf ' . $file);
            $process = true;
        } elseif(preg_match('/\.gz$/i', $this->basename)) {
            system(CMD_GUNZIP . ' ' . $file);
            $process = true;
        }
        
        chdir($current_dir);
        
        if($purge && $process) {
            $this->delete_file();
        }        
    }
    
    /**
     * Reescalar las imágenes a los valores por defecto
    */
    function scale($width=DEFAULT_WIDTH, $height=DEFAULT_HEIGHT) {
        $file = $this->path.$this->basename;
        
        if(preg_match('/(\.png|\.jpg|\.jpeg|\.gif|\.bmp)$/i', $this->basename)) {
            $thumbnail = new Pthumb();
            $thumbnail->use_cache = true;
            $thumbnail->cache_dir = dirname(__FILE__)."/../cache/thumbs/";
            
            // Invertir si es más alto que ancho
            list($w, $h, $type, $attr) = getimagesize($file);
            if($w < $h) {
                $temp = $width;
                $width = $height;
                $height = $temp;
            }
            
            $data = $thumbnail->fit_thumbnail($file, $width, $height, 1, true);
            if(!$data) {
                return(false);
            }
            
            $data = $thumbnail->print_thumbnail($file, $data[0], $data[1], true);            
            if(!$data) {
                return(false);
            }
            
            // Escribir el contenido en el fichero
            file_put_contents($file, $data);
        }
    }
    
    /**
     * Sube el fichero a Youtube
    */
    function post_video() {
        $file = $this->path.$this->basename;
        
        if(preg_match('/(\.avi|\.mpg|\.mpeg|\.3gp|\.flv)$/i', $this->basename)) {
            // Incluir las clases para subir vídeos a youtube
            require_once(dirname(__FILE__).'/../libs/phptube.php');

            $tube = new PHPTube(YOUTUBE_USER, YOUTUBE_PASS);
                // function upload ($video_filename, $video_title, $video_tags,
                //                  $video_description, $video_category, $video_language,
                //                  $public=true, $family=true, $friends=true)
                // 25=News & Politics
            $id = $tube->upload($file, "Cronicas de la emigracion - ".date('d-m-Y'),
                "cronicas news emigracion noticias newspaper", "Cronicas de la emigracion".date('d-m-Y'), 25, "ES");
            
            // Eliminar el fichero una vez subido a youtube
            $this->delete_file();
            
            // Mensaje de que fue posteado en youtube
            Application::forward('?action=posted-youtube&path='.$this->path);            
        }
    }
    
    /**
     * Sube el fichero a Youtube
    */
    function delete_file() {
        $file = $this->path.$this->basename;
        @unlink($file);  
    }    
    
    /**
     * Establece un entorno de ejecución de PHP para poder subir ficheros
    */
    function sanitizeEnv() {
        ini_set('upload_max_filesize', '20M');
        ini_set('post_max_size', '24M');
        ini_set('file_uploads', 'On');
        ini_set('max_execution_time', '0');
    }            
    
    // Private Methods    
    function _initEvents() {
        $this->_events[ onAfterUpload ] = array();
        $this->_events[ onBeforeUpload ] = array();
    }
    
    function _getEnv() {
        $values = array();
        foreach($this->_directives as $d) {
            $values[$d] = ini_get( $d );
        }
        
        return( $values );
    }
}
?>