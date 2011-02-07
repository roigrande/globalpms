<?php

/**
  * Clase HzMenu , menú utilizado para la parte principal 
  * @autor Tomás Vilariño Fidalgo <tomasvf@gmail.com>
  * @version 1.1
  * @access public
  * @package HebbCMS
*/
class HzMenu extends Menu {
    var $id_menu_js = '';
    var $nivel_actual = 0;
    
    var $global_menu = '';
    var $sub_menus = '';
    
    var $num_submenu = 0;
    var $num_enlaces = 0;
    var $Menu;
    var $fichMenu;
    
    function HzMenu($menu, $fichMenu) {
        $this->Menu = &$menu;
        $this->fichMenu = $fichMenu;
        
        $xml = $this->load($fichMenu);
        $this->doParse($xml);
    }
    
    function __construct($menu, $fichMenu) {
        $this->HzMenu($menu, $fichMenu);
    }
    
    //--------------- Manejadores de etiquetas ------------------//
    function handle_menu_open($attrs) {
        $this->Menu->_infoMenu['hzmenu'][] = array('id' => $attrs['id'],
                                            'nombre' => $attrs['nombre'],
                                            'ficheroXML' => $this->fichMenu);
        if(count($this->Menu->_infoMenu['hzmenu']) == 1) {
            $this->global_menu =
                '<script language="javascript" type="text/javascript" src="js/menu.js"></script>';
        } 
        $this->id_menu_js = $attrs['id'];
        $this->global_menu .= '<script language="javascript" type="text/javascript">
                             var '.$attrs['id'].' = new Menu(\''.$attrs['id'].'\', 115, 175);
                             </script>
                                <div id="'.$attrs['id'].'">
                                  <img src="images/barra_menu_izda.gif" border="0" id="menuIz" />
                                  <img src="images/barra_menu_dcha.gif" border="0" id="menuDc" />
                                  <div id="global'.$attrs['id'].'">&nbsp;'."\n";
        
    }
    
    function handle_menu_close() {
        $this->global_menu .= '</div></div>';
        $this->contenido = $this->global_menu . $this->sub_menus;
    }
    
    function handle_submenu_open($attrs) {
        $enlace_target = '';
        $this->nivel_actual++;
        if($this->nivel_actual == 1) {
            $this->num_submenu++;
            
            if($this->num_submenu > 1) {
                $this->global_menu .= ' <img src="images/separador.gif" border="0" align="absbottom" /> ';
            }
            
            if(isset($attrs['target']) && strlen($attrs['target']) > 0) {
                $enlace_target = 'target="'.$attrs['target'].'"';
            }
            $attrs['enlace'] = (isset($attrs['enlace']))?$attrs['enlace']:'#';            
            $this->global_menu .= '<a href="'.$attrs['enlace'].'" class="hzmenu" '.$enlace_target.' onMouseOver="'.
                $this->id_menu_js.'.mostrar(\''.$attrs['id'].'\');">'.$attrs['nombre'].'</a>';
            $this->sub_menus .= '<div id="'.$attrs['id'].'" class="submenu">';
        }
    }
    
    function handle_submenu_close() {
        $this->nivel_actual--;
        if($this->nivel_actual == 0) {
            $this->sub_menus .= '</div>';
            $this->num_enlaces = 0;
        }
    }
    
    function handle_nodo_open($attrs) {

        $enlace_target = '';
        if(isset($attrs['target']) && strlen($attrs['target']) > 0) {
            $enlace_target = 'target="'.$attrs['target'].'"';
        }

        if($this->nivel_actual == 1) {
            $this->num_enlaces++;
            
            if($this->num_enlaces > 1) {
                $this->sub_menus .= ' | ';
            }                        
            
            $this->sub_menus .= '<a href="'.$attrs['enlace'].'" class="hzmenu" '.$enlace_target.'>'.$attrs['nombre'].'</a>';
        } else {
            if($this->nivel_actual == 0) {
                $this->num_submenu++;
                if($this->num_submenu > 1) {
                    $this->global_menu .= ' <img src="images/separador.gif" border="0" align="absbottom" /> ';
                }
                $this->global_menu .= '<a href="'.$attrs['enlace'].'" class="hzmenu" '.$enlace_target.' onMouseOver="'.
                $this->id_menu_js.'.ocultar();">'.
                                        $attrs['nombre'].'</a>';
            }
        }
    }
    
    function handle_nodo_close() {
        // Nada
    }
}

?>