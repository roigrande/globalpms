<?php
/**
  * Clase config, permite modificar los parámetros/constantes de la aplicación
  * <code>
  * $config = new config();
  * $config->set_parametro_config("HEBBMENU", "HzMenu");
  * $config->set_parametros_config( array("HEBBMENU" => "HzMenu", "TKNSOAP" => "::SOAP::") );
  * echo('<pre>');
  * print_r( $config );
  * echo('</pre>');
  *</code>
*/
class config {
    var $lineas   = array();
    var $params   = array();
    var $filename = null;
    
    function config($path=null) {
		if(is_null($path)) {
			$this->filename = realpath(dirname(__FILE__).'/../config/config.inc.php');
		} else {
			$this->filename = $path;
		}
    }
    
    function __construct($path=null) {
        $this->config($path);
    }
    
    function load_config() {
        $lineas = array();
        
        // Leer el contenido del fichero  de configuración línea por línea
        $fd = fopen ($this->filename, "r");
        while (!feof($fd)) {
            $cadena = fgets($fd, 4096);
            $lineas[] = $cadena;
        }		
        fclose ($fd);
        
        $this->lineas = $lineas;
        return( $lineas );
    }
    
    function save_config() {
        if( count($this->lineas) == 0 ) {
            $this->load_config();
        }
        
        $fp = fopen ($this->filename, "w");
        for($i=0; $i<count($this->lineas); $i++) {
            fwrite($fp, $this->lineas[$i]);
        }		
        fclose ($fp); 
		$this->load_config();       
    }
    
    function get_lineas_config() {
        if( count($this->lineas) == 0 ) {
            $this->load_config();
        }

        $lineas = array();
        
        for($i=0; $i<count($this->lineas); $i++) {
            $cadena = $this->lineas[$i];
            if(preg_match("/^define\((.*?)\);/", $cadena, $parts)) {
                $vbles = explode(",", $parts[1]);				
				$vbles[0] = str_replace("'", "", $vbles[0]);
				$vbles[1] = str_replace("'", "", $vbles[1]);				
                $lineas[trim($vbles[0])] = trim($vbles[1]);
			}
        }

        $this->params = $lineas;
        return( $lineas );
    }
    
    function set_parametro_config($variable, $valor) {
        if( count($this->lineas) == 0 ) {
            $this->load_config();
        }
        
        $lineas = array();

        for($i=0; $i<count($this->lineas); $i++) {
            $cadena = $this->lineas[$i];
            if(preg_match("/^define\('".$variable."', '?(.*?)'?\);/", $cadena, $parts)) {
                $this->lineas[$i] = str_replace($parts[1], $valor, $this->lineas[$i]);
			}
        }
        
        $this->save_config();
    }
	
	function set_parametros_config($params) {
        if( count($this->lineas) == 0 ) {
            $this->load_config();
        }
        
        $lineas = array();

		foreach($params as $k => $v) {
			for($i=0; $i<count($this->lineas); $i++) {
				$cadena = $this->lineas[$i];
				if(preg_match("/^define\('".$k."', '?(.*?)'?\);/", $cadena, $parts)) {
					$this->lineas[$i] = str_replace($parts[1], $v, $this->lineas[$i]);
				}
			}
		}
        
        $this->save_config();
	}
}
?>