<?php
/**
  * Clase ListMenu , Menú a base de listas desplegables 
  * @autor Tomás Vilariño Fidalgo <tomasvf@gmail.com>
  * @version 0.1
  * @access public
  * @package HebbCMS
*/
class ListMenu extends Menu {
    
    var $nivelActual = 0;
    var $Menu;
    var $fichMenu;
    var $attrsMenu;
    
    /**
      * Contructor de la clase. Carga el fichero y comienza el parseo del fichero. 
      * @access public
    */
    function ListMenu($menu, $fichMenu) {        
        $this->Menu = &$menu;
        $this->fichMenu = $fichMenu;
        
        $xml = $this->load($fichMenu);
        $this->doParse($xml);
    }
	
	/**
	  * Constructor PHP5
	*/ 
	function __contruct($menu, $fichMenu) {
		$this->ComboMenu($menu, $fichMenu);
	}
    
    //--------------- Manejadores de etiquetas ------------------//     
    function handle_menu_open($attrs) {
        
        $this->attrsMenu = $attrs;
        $this->Menu->_infoMenu['panelmenu'][] = array('id' => 'panel_'.$attrs['id'],
                                                    'nombre' => $attrs['nombre'],
                                                    'ficheroXML' => $this->fichMenu);
                                            
        $this->contenido = '<script language="JavaScript" src="/js/ListMenu/ListMenu.js" type="text/javascript"></script>
                    <link rel="stylesheet" href="/js/ListMenu/ListMenu.css" type="text/css" />';
        $this->contenido .= '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>';
    }
    
    function handle_menu_close() {
        $this->contenido .= '</tr></table>';
    }
    
    function handle_submenu_open($attrs) {
    	if($this->nivelActual == 0) {
    		$this->contenido .= '<td class="ListMenuTd"><a href="'.$attrs['enlace'].
					'" class="ListMenuA">'.$attrs['nombre'].'</a>:';
    		$this->contenido .= '<select class="ListMenuSelect" name="ListMenu_'.$attrs['id'].
						'" onchange="javascript:ir(this);"><option value=""></option>';
    	} else {
    		$this->contenido .= '<optgroup label="'.$attrs['nombre'].'">';
    		$this->contenido .= '<option value="'.$attrs['enlace'].'">'.$attrs['nombre'].'</option>';
    	}
        
        
        $this->nivelActual++;        
    }
    
    function handle_submenu_close() {
    	if($this->nivelActual == 1) {
    		$this->contenido .= '</td>';
    	} else {
    		$this->contenido .= '</optgroup>';
    	}
        	
        $this->nivelActual--;
    }
    
    function handle_nodo_open($attrs) {
		if($this->nivelActual == 0) {
    		$this->contenido .= '<td class="ListMenuTd"><a href="'.$attrs['enlace'].
					'" class="ListMenuA">'.$attrs['nombre'].'</a></td>';
		} else {
			$this->contenido .= '<option value="'.$attrs['enlace'].'">'.$attrs['nombre'].'</option>';
		}
    }
    
    function handle_nodo_close() {
        // Nada
    }
}
?>
