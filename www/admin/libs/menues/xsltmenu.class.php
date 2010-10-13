<?php

/**
  * Clase XsltMenu , men� formateado a trav�s de XSLT 
  * @autor Tom�s Vilari�o Fidalgo <tomasvf@gmail.com>
  * @version 0.1
  * @access public
  * @package HebbCMS
*/
class XsltMenu extends Menu {

	/**
	  * Constructor de clase XsltMenu que hace uso del fichero menu.xsl
      * �ste fichero debe existir previamente
    */
    function XsltMenu($menu, $fichMenu) {        
        $this->Menu = &$menu;
        $this->fichMenu = $fichMenu;
        
        $this->Menu->_infoMenu['xsltmenu'][] = array('ficheroXML' => $this->fichMenu);

                
        $xml = $this->load($fichMenu);
        $xsl = $this->load( dirname( __FILE__ ).'/menu.xsl');
        
        $arguments = array(
            '/_xml' => $xml,
            '/_xsl' => $xsl
        );
        
        $xh = xslt_create();
        
        $result = xslt_process($xh, 'arg:/_xml', 'arg:/_xsl', NULL, $arguments); 
        if ($result) {
            $this->contenido = utf8_decode($result);
        }
        else {
           die ("ERROR: El fichero: ".$fichMenu.
                " no pudo ser transformado por menu.xsl ".xslt_error($xh). 
                " y c�digo de error: " . xslt_errno($xh));
        }
        xslt_free($xh);
    }
	
	/**
	  * Constructor PHP5
	*/ 
	function __construct($menu, $fichMenu) {
		$this->XsltMenu($menu, $fichMenu);
	}
}

?>