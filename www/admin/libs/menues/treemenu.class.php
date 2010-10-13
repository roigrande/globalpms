<?php

/**
  * Clase TreeMenu , muestra el men� en forma de arbol. Se pueden personalizar los iconos, enlaces, etc
  * @autor Tom�s Vilari�o Fidalgo <vifito@gmail.com>
  * @version 3.1
  * @access public
  * @package HebbCMS
  * @extends Menu
  * @see Menu
*/
class TreeMenu extends Menu {

    var $nivelActual = 0;
    var $carpetas = array();
    var $idMenu = '';
    var $attrsMenu = array();
    var $Menu;
    var $fichMenu;
    var $RESOURCES_PATH = 'themes/default/';

    /**
      * Contructor de la clase. Carga el fichero y comienza el parseo del fichero.
      * @access public
    */
    function TreeMenu($menu, $resource, $type=MENUFILE) {
        $this->Menu = &$menu;
		//$xml = ($resource_type == MENUFILE)? $this->load($fichMenu): $fichMenu;

		switch( $type ) {
		    case MENUSTRING:
		    	$xml = $resource;
		    break;

		    case MENUFILE:
		    default:
				$this->fichMenu = $resource;
				$xml = $this->load($resource);
		    break;
		}

        $this->doParse($xml);
    }

	/**
	  * Constructor PHP5
	*/
	function __construct($menu, $fichMenu, $type=MENUFILE) {
	    $this->TreeMenu($menu, $fichMenu, $type);
	}

	/**
	  * M�todo de utilidad para construir c�digo javascript que gestione las cookies
      * @access private
	*/
    function implode_with_keys($glue, $array) {
       $output = array();
       foreach( $array as $key => $item )
            $output[] = $key . ':"' . $item .'"';
       return implode($glue, $output);
    }

    //--------------- Manejadores de etiquetas ------------------//
    function _menu_open($attrs) {
        $this->idMenu = $attrs['id'];
        $this->attrsMenu = $attrs;

        $this->Menu->_infoMenu['treemenu'][] = array('id' => $attrs['id'],
                                            /* 'nombre' => $attrs['nombre'], */
                                            'ficheroXML' => $this->fichMenu);

        if(count($this->Menu->_infoMenu['treemenu']) == 1) { // Si es el primer menu incluimos fichero js
            $this->contenido = '<script language="javascript" type="text/javascript" src="'.$this->RESOURCES_PATH.'js/treemenu.js"> </script>';
        }
        $this->contenido .= '<span id="tree_'.$this->idMenu.'" style="white-space: nowrap">'."\n";
    }

    function _menu_close() {
        $this->contenido .= '</span>
                             <script language="javascript" type="text/javascript">'."\n".'
                             var tree_'.$this->idMenu.'_carpetas = [';

        // Para cada submenu realizar la llamada correspondiente.
        for($i=0; $i<count($this->carpetas); $i++) {
            $js_array = $this->implode_with_keys(",", $this->carpetas[$i]);
            if(0 != $i){
                $this->contenido .= ',';
            }
            $this->contenido .= '{'.$js_array.'}';
        }
        $this->contenido .= '];'."\n".'
                             var tree_'.$this->idMenu.' = new Menu(\'tree_'.$this->idMenu.'\'';
		$persistente = (!isset($this->attrsMenu['persistente']))? 'true': $this->attrsMenu['persistente'];
        $this->contenido .= ',\''.$this->attrsMenu['pathImages'].'\','.$persistente;
        $this->contenido .= ',tree_'.$this->idMenu.'_carpetas,\'tree_'.$this->idMenu.'\');'."\n";
        $this->contenido .= 'tree_'.$this->idMenu.'.cargarMenu();'."\n";
        $this->contenido .= '</script>'."\n";
    }

    function _submenu_open($attrs) {
        // Rellenar los datos sobre el submenu. Si no existen iconos para cerrar
        // o abrir el men� se utilizan por defecto los iconos de carpeta.
        $this->carpetas[] = $attrs;
        $signo = (!isset($attrs['signo']))?'plus.gif':$attrs['signo'];
		$icono = (!isset($attrs['icono']))?'tree_close.gif':$attrs['icono'];
		$this->carpetas[count($this->carpetas)-1]['icono'] = $icono;
		$this->carpetas[count($this->carpetas)-1]['signo'] = $signo;
		$this->carpetas[count($this->carpetas)-1]['iconoExpandido'] = (!isset($attrs['iconoExpandido']))? 'tree_open.gif': $this->carpetas['iconoExpandido'];
		$this->carpetas[count($this->carpetas)-1]['signoExpandido'] = (!isset($attrs['signoExpandido']))? 'minus.gif': $this->carpetas['signoExpandido'];
        
        if( isset($attrs['highlight']) ) {
            $this->contenido .= '<div style="background-color: '.$attrs['highlight'].';" class="highlight">';
        }

        $this->contenido .= '<a href="javascript:tree_'.$this->idMenu.'.desplegarMenu(\'tree_'.$this->idMenu.'_'.$attrs['id'].'\');">'."\n";
        $this->contenido .= '<img style="margin-left: '.($this->nivelActual*10).'" id="tree_'.$this->idMenu.'_'.$attrs['id'].'_sign" src="'.$this->attrsMenu['pathImages'].$signo.'" border="0" />'."\n";
        $this->contenido .= '<img id="tree_'.$this->idMenu.'_'.$attrs['id'].'_folder" alt="" src="'.$this->attrsMenu['pathImages'].$icono.'" border="0" /></a>'."\n";

		$enlace_target = '';
		if(isset($attrs['target']) && strlen($attrs['target']) > 0) {
			$enlace_target = 'target="'.$attrs['target'].'"';
		}

        if(isset($attrs['enlace'])&&(strlen($attrs['enlace']))) {
            //$this->contenido .= '<a onMouseOut="javascript:tree_'.$this->idMenu.'.barraEstado(\''.$attrs['nombre'].'\');return true;" onMouseOver="javascript:tree_'.$this->idMenu.'.barraEstado(\''.$attrs['nombre'].'\');return true;" href="'.$attrs['enlace'].'" '.$enlace_target.'>'.$attrs['nombre'].'</a>'."\n";
            $this->contenido .= '<a href="'.$attrs['enlace'].'" '.$enlace_target.'>'.$attrs['nombre'].'</a>'."\n";
        } else {
            //$this->contenido .= '<a href="javascript:tree_'.$this->idMenu.'.desplegarMenu(\'tree_'.$this->idMenu.'_'.$attrs['id'].'\');" onMouseOut="javascript:tree_'.$this->idMenu.'.barraEstado(\''.$attrs['nombre'].'\');return true;" onMouseOver="javascript:tree_'.$this->idMenu.'.barraEstado(\''.$attrs['nombre'].'\');return true;">'.$attrs['nombre'].'</a>'."\n";
            $this->contenido .= '<a href="javascript:tree_'.$this->idMenu.'.desplegarMenu(\'tree_'.$this->idMenu.'_'.$attrs['id'].'\');">'.$attrs['nombre'].'</a>'."\n";
        }

        if( isset($attrs['highlight']) ) {
            $this->contenido .= '</div>';    
        } else {
            $this->contenido .= '<br />';    
        }
        
        $this->contenido .= '<span id="tree_'.$this->idMenu.'_'.$attrs['id'].'" style="display: none">'."\n";
        $this->nivelActual++;
    }

    function _submenu_close() {
        $this->nivelActual--;
        $this->contenido .= '</span>'."\n"."\n";
    }

    function _nodo_open($attrs) {
		$icono = (!isset($attrs['icono']))?'list.gif':$attrs['icono'];
        $this->contenido .= '<img style="margin-left: '.(($this->nivelActual*10)+9).'" alt="'.$attrs['nombre'].'" src="'.$this->attrsMenu['pathImages'].$icono.'">'."\n";

		$enlace_target = '';
		if(isset($attrs['target']) && strlen($attrs['target']) > 0) {
			$enlace_target = 'target="'.$attrs['target'].'"';
		}

        $this->contenido .= '<a href="'.$attrs['enlace'].'" '.$enlace_target.'>'.$attrs['nombre'].'</a><br />'."\n";
    }

    function _nodo_close() {
        $this->contenido .= ''."\n";
    }
}

?>