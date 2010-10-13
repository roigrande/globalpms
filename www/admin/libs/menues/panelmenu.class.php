<?php
/**
  * Clase PanelMenu , JSCookMenu 
  * @autor Tomás Vilariño Fidalgo <tomasvf@gmail.com>
  * @version 0.1
  * @access public
  * @package HebbCMS
*/
class PanelMenu extends Menu {
    
    var $nivelActual = 0;
    var $Menu;
    var $fichMenu;
    var $attrsMenu;
    var $orientation = 'hbr';
    
    /**
      * Contructor de la clase. Carga el fichero y comienza el parseo del fichero. 
      * @access public
    */        
    function PanelMenu($menu, $fichMenu, $resource_type=0) {
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
		$this->PanelMenu($menu, $fichMenu, $resource_type);
	}    
    
    function setOrientation($orientation) {
        $this->orientation = $orientation;
    }
    
    function getOrientation() {
        return $this->orientation;
    }
    
    //--------------- Manejadores de etiquetas ------------------//     
    function _menu_open($attrs) {
        
        $this->attrsMenu = $attrs;
        $this->Menu->_infoMenu['panelmenu'][] = array('id' => 'panel_'.$attrs['id'],
                                                    'nombre' => $attrs['nombre'],
                                                    'ficheroXML' => $this->fichMenu);
                                            
        $this->contenido = '
                    <script language="JavaScript" src="/admin/themes/default/js/JSCookMenu/JSCookMenu.js" type="text/javascript"></script>
                    <link rel="stylesheet" href="/admin/themes/default/js/JSCookMenu/ThemeOpennemas/theme.css" type="text/css" />
                    <script language="JavaScript" src="/admin/themes/default/js/JSCookMenu/ThemeOpennemas/theme.js" type="text/javascript"></script>
                    <script language="JavaScript"><!--
                    var datos_menu = [';
    }
    
    function _menu_close() {
        $indice = count($this->Menu->_infoMenu['panelmenu'])-1;
        $id_menu = $this->Menu->_infoMenu['panelmenu'][$indice]['id'];
        $this->contenido{strrpos($this->contenido, ',')} = ' ';
        $this->contenido .= '];
            -->
            </script>
            <div id="'.$id_menu.'"></div>
            <script language="JavaScript"><!--
                cmDraw (\''.$id_menu.'\', datos_menu, \''.$this->orientation.'\', cmThemeOpennemas, \'ThemeOpennemas\');
            --></script>';
    }
    
    function _submenu_open($attrs) {
        $this->contenido .= '_cmSplit,';
        $target = (isset($attrs['target']))? $attrs['target']: '_self';
        $this->contenido .= '[null, \''.$attrs['nombre'].'\', \''.$attrs['enlace'].'\', \''.$target.'\', \''.$attrs['nombre'].'\',';
        
        $this->nivelActual++;        
    }
    
    function _submenu_close() {
        $this->contenido{strrpos($this->contenido, ',')} = ' ';
        $this->contenido .= '],';
        $this->nivelActual--;
    }
    
    function _nodo_open($attrs) {
        $target = (isset($attrs['target']))? $attrs['target']: '_self';
        $this->contenido .= '[null, \''.$attrs['nombre'].'\', \''.$attrs['enlace'].'\', \''.$target.'\', \''.$attrs['nombre'].'\'],';
    }
    
    function _nodo_close() {
        // Nada
    }
}
?>