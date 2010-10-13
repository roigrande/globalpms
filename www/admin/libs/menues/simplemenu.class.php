<?php
/**
  * Clase SimpleMenu , menú en forma de tabla HTML. Uso para navegadores en modo texto, etc. 
  * @autor Tomás Vilariño Fidalgo <tomasvf@gmail.com>
  * @version 0.1
  * @access public
  * @package HebbCMS
*/
class SimpleMenu extends Menu {
    
    var $nivelActual = 0;
    var $Menu;
    var $fichMenu;
    var $attrsMenu;
    
    /**
      * Contructor de la clase. Carga el fichero y comienza el parseo del fichero. 
      * @access public
    */
    function SimpleMenu($menu, $fichMenu) {        
        $this->Menu = &$menu;
        $this->fichMenu = $fichMenu;
        
        $xml = $this->load($fichMenu);
        $this->doParse($xml);
    }
	
	/**
	  * Constructor PHP5
	*/ 
	function __contruct($menu, $fichMenu) {
		$this->SimpleMenu($menu, $fichMenu);
	}
    
    //--------------- Manejadores de etiquetas ------------------//     
    function handle_menu_open($attrs) {
        
        $this->attrsMenu = $attrs;
        $this->Menu->_infoMenu['simplemenu'][] = array('id' => 'simple_'.$attrs['id'],
                                                    'nombre' => $attrs['nombre'],
                                                    'ficheroXML' => $this->fichMenu);
                                            
        $this->contenido = '<table border="0"><tbody id="simple_'.$attrs['id'].'">';
    }
    
    function handle_menu_close() {
        
        $this->contenido .= '</tbody></table>'."\n";
    }
    
    function handle_submenu_open($attrs) {
		$icono = (!isset($attrs['icono']))?'tree_close.gif':$attrs['icono'];
		
        $this->contenido .= '<tr><td><img style="margin-left: '.(($this->nivelActual*10)+1).'" alt="" src="'.$this->attrsMenu['pathImages'].$icono.'" border="0" />'."\n";
        
        if(isset($attrs['enlace'])&&(strlen($attrs['enlace']))) {
            $this->contenido .= '<a href="'.$attrs['enlace'].'">'.$attrs['nombre'].'</a> <span style="font-size: 10px;">['.$attrs['enlace'].']</span></td></tr>'."\n";
        } else {
            $this->contenido .= '<a href="#">'.$attrs['nombre'].'</a></td></tr>'."\n";
        }
        
        $this->nivelActual++;        
    }
    
    function handle_submenu_close() {
        $this->nivelActual--;
    }
    
    function handle_nodo_open($attrs) {
		$icono = (!isset($attrs['icono']))?'list.gif':$attrs['icono'];
		
        $this->contenido .= '<tr><td><img style="margin-left: '.($this->nivelActual*10).'" alt="'.$attrs['nombre'].'" src="'.$this->attrsMenu['pathImages'].$icono.'">'."\n";
        $this->contenido .= '<a href="'.$attrs['enlace'].'">'.$attrs['nombre'].'</a> <span style="font-size: 10px;">['.$attrs['enlace'].']</span></td></tr>'."\n";
    }
    
    function handle_nodo_close() {
        //$this->contenido .= ''."\n";
    }
}

?>