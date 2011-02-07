<?php
/**
  * Clase YpMenu 
  * @autor Tom�s Vilari�o Fidalgo <tomasvf@gmail.com>
  * @version 0.x
  * @access public
  * @package OpenNeMas
*/
class YpMenu extends Menu
{    
    var $iSub = 1;
    
    var $submenuStr = '';
    var $mainStr = '';
    var $paintSubmenu = false;
    
    var $Menu;
    var $fichMenu;
    var $attrsMenu;
    
    /**
      * Contructor de la clase. Carga el fichero y comienza el parseo del fichero. 
      * @access public
    */        
    public function YpMenu($menu, $fichMenu, $resource_type=0)
    {        
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
	public function __construct($menu, $fichMenu, $resource_type=0)
    {
		$this->YpMenu($menu, $fichMenu, $resource_type);
	}
    
    private function checkAcl($privilege)
    {
        if(isset($privilege) && !is_null($privilege)) {
            $privs = explode(',', $privilege);
            $test = false;
            foreach($privs as $priv) {
                $test = $test || Acl::_($priv);
            }
            
            return $test;
        }
        
        return true;
    }
    
    public function __toString()
    {
        return $this->render();
    }
    
    //--------------- Manejadores de etiquetas ------------------//     
    function _menu_open($attrs)
    {
        $this->mainStr = '<table class="slidemenu" border=0 cellpadding="0" cellspacing="0"><tr>' . PHP_EOL;
        $this->submenuStr = '<div class="submenus">' . PHP_EOL;
    }
    
    function _menu_close()
    {
        $this->mainStr .= '</tr></table>' . PHP_EOL;
        $this->submenuStr .= '</div>' . PHP_EOL;        
        
        $this->contenido = $this->mainStr . "\n" . $this->submenuStr;
    }
    
    function _submenu_open($attrs)
    {
        $link = (isset($attrs['link']))? $attrs['link']: '#';
        $target = (isset($attrs['target']))? ' target="'.$attrs['target'].'"': '';
        
        $this->paintSubmenu = !isset($attrs['privilege']) || $this->checkAcl($attrs['privilege']);        
        
        if($this->paintSubmenu) {
            $this->mainStr .= '<td valign="middle" width="140">';
            $this->mainStr .= '<a href="'.$link.'" rel="sub'.$this->iSub.'" onClick="ypSlideOutMenu.showMenu(\'sub'.$this->iSub.'\')" ';
            $this->mainStr .= 'onmouseover="ypSlideOutMenu.showMenu(\'sub'.$this->iSub.'\')" ';
            $this->mainStr .= 'onmouseout="ypSlideOutMenu.hideMenu(\'sub'.$this->iSub.'\')"'.$target.'>'.$attrs['title'].'</a></td>' . PHP_EOL;
            
            $this->submenuStr .= '<div id="sub'.$this->iSub.'Container"><div id="sub'.$this->iSub.'Content">' . PHP_EOL;
            $this->submenuStr .= '<table border="0" cellpadding="0" cellspacing="0" class="cuadromenu" width="170">' . PHP_EOL;
        }        
    }
    
    function _submenu_close()
    {
        if($this->paintSubmenu) {
            $this->submenuStr .= '</table>' . PHP_EOL;
            $this->submenuStr .= '</div></div>' . PHP_EOL;
        }
        
        $this->iSub++;
    }
    
    function _node_open($attrs)
    {
        if(($this->paintSubmenu) && (!isset($attrs['privilege']) || $this->checkAcl($attrs['privilege']))) {
            $link = (isset($attrs['link']))? $attrs['link']: '#';
            $target = (isset($attrs['target']))? ' target="'.$attrs['target'].'"': '';
            
            $this->submenuStr .= '<tr><td><a href="'.$link.'"'.$target.'>'.$attrs['title'].'</a></td></tr>' . PHP_EOL;
        }
    }
    
    function _node_close()
    {
        // Nada
    }        
}
