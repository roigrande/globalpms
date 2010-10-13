<?php
include('parserxml.class.php');

define('MENUFILE', 0);
define('MENUSTRING', 1);

/***********************************************************
 **    menu.class.php 28/11/2003 18:57:16
 ***********************************************************/

/**
  * Clase Menu
  * @author Tomás Vilariño Fidalgo <tomasvf@gmail.com>
  * @version 0.4
  * @access public
  * <code>
  * include('menu.class.php');
  *	$menu = new Menu();
  *
  * $treeMenu = $menu->getMenu('TreeMenu','../menu.xml');
  * echo $treeMenu->printMenu();
  *
  * $simpleMenu = $menu->getMenu('SimpleMenu');
  * echo $simpleMenu->printMenu();
  *
  * $domMenu = $menu->getMenu('DomMenu');
  * echo domMenu->printMenu();
  * </code>
*/
class Menu extends ParserXML{
    /**
      * @var $contenido
    */
    var $_header_http = 'text/html';
    var $contenido = ''; // Contenido HTML que se va almacenando q formará el menú
    var $fichMenu = 'menu.xml'; // Fichero XML con la estructura del menú
    var $_infoMenu = array(); // Estructura para llevar cuenta de los menú dentro de una misma página
    var $menues = array();

    function Menu() {
        $filename = SITE_ADMIN_PATH.'libs/'.'menues.conf';
        $xml = $this->load($filename);
        $this->doParse( $xml );
    }

    function __construct() {
        $this->Menu();
    }

	function save($xml, $path) {
		$xml = $this->encodeXML($xml);
		$this->fichMenu = $path;
		$fp = fopen($this->fichMenu, 'w');
		fwrite($fp, $xml);
		fclose($fp);
	}

	function open( $filename ) {
		$this->fichMenu = $filename;
		$fp = fopen($filename, 'r');
		$xml = fread($fp, filesize($filename));
		$xml = $this->decodeXML($xml);
		fclose($fp);

		return($xml);
	}

	function remove($filename) {
		if(!unlink($filename)) {

		}
		// Borrar la caché y esperar un segundo
		@ clearstatcache();
		sleep(1);
	}

    function getMenu($tipoMenu, $fichMenu='./menu.xml', $resource_type=MENUFILE) {
		if(!file_exists(dirname(__FILE__).'/'.'menues/'.$this->menues[$tipoMenu]['clase'])) {
			die('Compruebe que existe y está cargado el plugin de menú: '.dirname(__FILE__).'/'.'menues/'.$this->menues[$tipoMenu]['clase']);
		}

		require_once(dirname(__FILE__).'/'.'menues/'.$this->menues[$tipoMenu]['clase']);
		return new $tipoMenu($this, $fichMenu, $resource_type);
    }

	/**
	  * get_menues,
      * Recuperar todos los tipos de menús disponibles en el fichero de configuración
	*/
	function get_menues() {
		return ($this->menues);
	}

    /* Este metodo se puede llamar desde las clases TreeMenu, SimpleMenu, DomMenu...
       Para la clase FlashMenu a lo mejor es necesario sobreescrbirlo */
    function printMenu() {
        return ($this->contenido);
    }
    
    function render()
    {
        return $this->printMenu();
    }

	// -- Manejadores para el fichero de configuración --------------------------//
	function _menues_open($attrs) {
		$this->menues = array();
	}

	function _menu_open($attrs) {
		$this->menues[$attrs['id']] = $attrs;
	}
}
