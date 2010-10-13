<?php


/**
  * Clase FlashMenu , soporte para dataProvider de las clases Menu, MenuBar,... de Flash
  * @link http://livedocs.macromedia.com/flash/mx2004/main/04_co514.htm
  * @autor Tomás Vilariño Fidalgo <tomasvf@gmail.com>
  * @version 0.0
  * @access public
  * @package HebbCMS
*/
class FlashMenu extends Menu {
    /**
	  * Constructor PHP4
	*/
	function FlashMenu($menu, $fichMenu) {
        $this->Menu = &$menu;
        $this->fichMenu = $fichMenu;
        
		$this->_header_http = 'text/xml';
		
        $xml = $this->load($fichMenu);
        $this->doParse($xml);
	}
	
	/**
	  * Constructor PHP5
	*/ 
	function __contruct($menu, $fichMenu) {
		$this->FlashMenu($menu, $fichMenu);
	}
	
    //--------------- Manejadores de etiquetas ------------------//     
    function handle_menu_open($attrs) {
		$this->contenido = '<?xml version="1.0"?>'."\n";
		$this->contenido .= '<menu>'."\n";
	}
	
	function handle_menu_close() {
		$this->contenido .= '</menu>';
	}
	
	function handle_submenu_open($attrs) {
		$this->contenido .= '<menuitem label="'.$attrs['nombre'].'">'."\n";
	}
	
	function handle_submenu_close() {
		$this->contenido .= '</menuitem>'."\n";
	}
	
	function handle_nodo_open($attrs) {
		$this->contenido .= '<menuitem label="'.$attrs['nombre'].'" />'."\n";		
	}
	
	function printMenu() {
		return( $this->encodeXML($this->contenido) );
	}
}
?>