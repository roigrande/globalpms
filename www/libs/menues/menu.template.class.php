<?php
/**
  * Clase TemplateMenu , Menú de ejemplo
  * @autor Tomás Vilariño Fidalgo <tomasvf@gmail.com>
  * @version 0.1
  * @access public
  * @package HebbCMS
*/
class TemplateMenu extends Menu {
    
    var $nivelActual = 0;
    var $Menu;
    var $fichMenu;
    var $attrsMenu;
    
    /**
      * Contructor de la clase. Carga el fichero y comienza el parseo del fichero. 
      * @access public
    */
    function TemplateMenu($menu, $fichMenu, $resource_type=0) {
        $this->Menu = &$menu;
        $this->fichMenu = $fichMenu;
        
        if($resource_type == 0) {
            $xml = $this->load($fichMenu);
        } else {
            $xml = $fichMenu;
        }
        
        $this->doParse($xml);
    }            
	
	/**
	  * Constructor PHP5
	*/ 
	function __contruct($menu, $fichMenu, $resource_type=0) {
		$this->TemplateMenu($menu, $fichMenu, $resource_type);
	}
    
	
	/************************************************************************************************
	* Editar los manejadores de etiquetas para conseguir el efecto deseado en el menú               *
	*************************************************************************************************/
    //--------------- Manejadores de etiquetas ------------------//    
    function _menu_open($attrs) {
        
    }
    
	function _menu_cdata($cont) {
        
	}
	
    function _menu_close() {
        
    }


    function _submenu_open($attrs) {
        
    }
	
	function _submenu_cdata($cont) {
        
	}
    
    function _submenu_close() {
        
    }
	
    
    function _node_open($attrs) {
        
    }
	
	function _node_cdata($cont) {
        
	}
	
    function _node_close() {
        
    }
}

