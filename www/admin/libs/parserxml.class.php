<?php
/**
 * Clase PaserXML, clase abstracta ParserXML, parser xml sax
 * @author Tomas Vilariño Fidalgo <tomasvf@gmail.com>
 * @version 1.2
 * @access private
 * @package HebbCMS
*/
class ParserXML {

    var $xmlparser; // Variable miembro del Parser XML
    var $pila = array();
    var $etiqueta_actual = '';

	/**
	  * Constructor de Clase ParserXML
	*/
    function ParserXML() {
        /* Mirar q puede hacer
        $xml = $this->load($fich);
        $this->doParse($xml);*/
    }

	/**
	  * Constructor de Clase ParserXML v.PHP5
	*/
	function __construct() {
		$this->ParserXML();
	}

    //------------------ Manejadores de la pila --------------//
	/**
	  * push
      * @param mixed $data
    */
    function push($data) {
        array_push($this->pila,$data);
    }

	/**
	  * pop
      * @return mixed
    */
    function pop() {
        if(count($this->pila)==0) {
            die("Error: Buffer Underflow!");
        }
        return array_pop($this->pila);
    }

	/**
	  * esVacia
      * @return boolean, Comprueba si la pila está vacía
	*/
    function esVacia() {
        return (0 == count($this->pila));
    }

    //--------------- Utilidades ------------------------------//
	function decodeXML($xml) {
		$eltos = array( 'Á' => '&#193;', 'á' => '&#225;',
						'É' => '&#201;', 'é' => '&#233;',
						'Í' => '&#205;', 'í' => '&#237;',
						'Ó' => '&#211;', 'ó' => '&#243;',
						'Ú' => '&#218;', 'ú' => '&#250;',
						'Ü' => '&#220;', 'ü' => '&#252;',
						'Ñ' => '&#209;', 'ñ' => '&#241;' );
		foreach($eltos as $k => $v) {
			$xml = str_replace($v, $k, $xml);
		}

		$xml = str_replace("\n","", $xml);
		$xml = str_replace("\r","", $xml);
		//$xml = str_replace("\"","\\\"", $xml);

		return $xml;
	}

	function encodeXML($xml) {
		$eltos = array( 'Á' => '&#193;', 'á' => '&#225;',
						'É' => '&#201;', 'é' => '&#233;',
						'Í' => '&#205;', 'í' => '&#237;',
						'Ó' => '&#211;', 'ó' => '&#243;',
						'Ú' => '&#218;', 'ú' => '&#250;',
						'Ü' => '&#220;', 'ü' => '&#252;',
						'Ñ' => '&#209;', 'ñ' => '&#241;',
						'\"' => '"' );
		foreach($eltos as $k => $v) {
			$xml = str_replace($k, $v, $xml);
		}

		return $xml;
	}

    /**
	  * Conversor a tag XML
      * @param string $name, nombre de la etiqueta
      * @param array $attrs, atributos de la etiqueta
      * @param string $contents, contenido de la etiqueta
    */
    function create_xml_tag($name,$attrs, $contents) {
        //devuelve una etiqueta XML valida
        $buffer="<$name";
        $attributestring="";
        foreach($attrs as $attr=>$value) {
            $buffer.=' '.$attr.'="'.$value.'"';
        }

        // Es esta etiqueta vacia?
        if(strlen($contents)==0) {
            $buffer.=' />';
        }
        else {
            $buffer.='>'.$contents.'</'.$name.'>';
        }
        return $buffer;
    }

    /**
      * load($filename), carga el fichero y lo devuelve como cadena.
      * @param string $filename Carga el fichero $filename
      * @access public
    */
    function load($filename) {
        $xml = '';
        if (!($fp = fopen($filename, "r"))) {
            die("Error al abrir el fichero: ".$filename);
        }

        while ($data = fread($fp, 4096)) {
            //Cargamos todo el fichero en $xml
            $xml .= $data;
        }
        //$xml = file_get_contents($filename);

		// if( version_compare(phpversion(), "5.0.0", ">=") ) {
		//	$xml = utf8_encode($xml);
		//} 

        return ($xml);
    }
    /* function load($filename)
    {
        $xml = '';
        
        // Prevent problem with short_open_tag and xml prolog declaration
        $previous_directive = ini_set('short_open_tag', 0);
        
        ob_start();
        include($filename);
        $xml = ob_get_contents();
        ob_end_clean();
        
        ini_set('short_open_tag', $previous_directive);
        
        return $xml;
    } */
    

	/**
	  * doParse
      * Comenzar el parseo
      * @param string $xml, cadena con el contenido XML
    */
    function doParse($xml, $encode=true) {
    	/* if( $encode ) {
			$xml = utf8_encode( $this->decodeXML($xml) );
    	} */

        // Inicializar SAX parser
        $this->xmlparser = xml_parser_create();

        // Asignar funciones para manejar los elementos
        xml_set_object($this->xmlparser, $this);
        xml_parser_set_option ( $this->xmlparser, XML_OPTION_CASE_FOLDING, 0);
        xml_set_element_handler($this->xmlparser,"tag_open","tag_close");
        xml_set_character_data_handler($this->xmlparser,"cdata");
        xml_set_default_handler($this->xmlparser,"cdata");

        // Comienzo del parseo del fichero $xml
        if (!xml_parse($this->xmlparser,$xml)) {
			echo('<pre>');
			var_dump( debug_backtrace() );
			die("</pre><b>Error:</b> ".xml_error_string(xml_get_error_code($this->xmlparser)) );
        }

        // Destruir el parser
        xml_parser_free($this->xmlparser);

        // Podemos devolver como resultado el contenido de las plantillas al final
        // return ;
    }

    // Manejadores de las etiquetas
    function tag_open($parser, $name, $attrs) {
        $this->etiqueta_actual = $name;

        // Manejador para cada etiqueta de apertura
        $function = "_".strtolower($name)."_open";

        if(method_exists($this, $function)) {
            // Ejecutamos la función correspondiente
            call_user_func(array(&$this,$function), $attrs);
            /* Otra forma de realizar la llamada:
                    $buffer = $this->{$function}($attrs); */
        }
        else {
            //die("Etiqueta de apertura: \"$name\" sin manejador.");
        }
    }

    function cdata($parser,$data) {
        // De momento no hace falta
        // Manejador para cada etiqueta de apertura
        $function = "_".strtolower($this->etiqueta_actual)."_cdata";

        if(method_exists($this, $function)) {
            // Ejecutamos la función correspondiente
            call_user_func(array(&$this,$function), $data);
            /* Otra forma de realizar la llamada:
                    $buffer = $this->{$function}($data); */
        }
        else {
            //die("Etiqueta de apertura: \"{$this->etiqueta_actual}\" sin manejador.");
        }
    }

    function tag_close($parser,$name) {

        // El nombre del manejador para la etiqueta de cierre
        $function = "_".strtolower($name)."_close";

        if(method_exists($this, $function)) {
            // Si existe el manejador de la etiqueta existe se ejecuta.
            call_user_func(array(&$this,$function));
            /* Otra forma de realizar la llamada:
                    $buffer = $this->{$function}(); */
        }
        else {
            //die("Etiqueta de cierre: \"$name\" sin manejador.");
        }
    }

}// Fin clase ParserXML
