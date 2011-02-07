<?php

/**
  * Clase DomMenu, menú que hace uso de la libreria javascript DomMenu
  * @autor Tomás Vilariño Fidalgo <tomasvf@gmail.com>
  * @version 1.1
  * @access public
  * @package HebbCMS
*/
class DomMenu extends Menu {
    var $idMenu = '';
    var $fichMenu;
    var $Menu; // Referencia al Objeto menu
    
    /**
      * Contructor de la clase. Carga el fichero y comienza el parseo del fichero.
      * @access public
    */
    function DomMenu($menu, $fichMenu, $resource_type=0) {
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
	function __construct($menu, $fichMenu, $resource_type=0) {
		$this->DomMenu($menu, $fichMenu, $resource_type);
	}
	
    //--------------- Manejadores de etiquetas ------------------//     
    function _menu_open($attrs) {
        
        // Recuperamos el identificador del menu
        $this->idMenu = $attrs['id'];
        
        $this->Menu->_infoMenu['dommenu'][] = array('id' => $attrs['id'],
                                                    'nombre' => $attrs['nombre'],
                                                    'ficheroXML' => $this->fichMenu);
        // Inicializamos la pila
        $this->push(1);
        
        // Hoja de estilo en cascada y fichero domMenu.js
        if(count($this->Menu->_infoMenu['dommenu']) == 1) { // Si es el primer menu incluimos fichero js
            $this->contenido = '<style type="text/css">
                                    @import url("/admin/themes/default/css/dommenu.css");
                                </style>
                                <script language="javascript" type="text/javascript" src="/admin/themes/default/js/domMenu.js"></script>';
        }
        $this->contenido .= '<script language="javascript" type="text/javascript">'."\n";
        $this->contenido .= 'domMenu_data.setItem(\'domMenu_'.$this->idMenu.'\',new domMenu_Hash('."\n";
    }
    
    function _menu_close() {
        // Borrar la ultima coma
        $this->contenido[strrpos($this->contenido, ',')] = ')';
        
        $this->contenido .= ');'."\n";
        $this->contenido .= "domMenu_settings.setItem('domMenu_{$this->idMenu}', new domMenu_Hash(
                                                      'subMenuWidthCorrection', -1,
                                                      'verticalSubMenuOffsetX', -1,
                                                      'verticalSubMenuOffsetY', -1,
                                                      'openMouseoverMenuDelay', 1,
                                                      'closeMouseoutMenuDelay', 1000 )
                                                      );";
        $this->contenido .= '</script>'."\n";
        $this->contenido .= '<div id="domMenu_'.$this->idMenu.'"></div>'."\n";
        $this->contenido .= '<script type="text/javascript" language="javascript">
                                domMenu_activate(\'domMenu_'.$this->idMenu.'\');
                             </script>';
    }
    
    function _submenu_open($attrs) {
        $i = $this->pop();
        $this->contenido .= $i.", new domMenu_Hash(
                                    'contents', '".$attrs['nombre']."',";
        if(isset($attrs['enlace'])) {
               $this->contenido .= "'uri', '".$attrs['enlace']."',";
        }
        $this->contenido .=        "'target', '_self',
                                    'statusText', '".$attrs['nombre']."',";
        $this->push($i+1);
        $this->push(1);
    }
    
    function _submenu_close() {
        // Borrar la ultima coma
        $this->contenido{strrpos($this->contenido, ',')} = ')';
        $this->contenido .= ',';
        
        // Quitamos el índice de esta carpeta
        $this->pop();
    }
    
    function _nodo_open($attrs) {
        $i = $this->pop();
        
        $this->contenido .= $i.", new domMenu_Hash(
                                    'contents', '".$attrs['nombre']."',";
        if(isset($attrs['enlace'])) {
            $this->contenido .= "'uri', '".$attrs['enlace']."',";
        }
        if(isset($attrs['target'])) {
            $this->contenido .= "'target', '".$attrs['target']."',";
        }
        $this->contenido .=     "'statusText', '".$attrs['nombre']."'
                                    ),";

        $this->push($i+1);
    }
    
    function _nodo_close() {
        // Nada
    }
}
?>