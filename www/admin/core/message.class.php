<?php
 /**
 * Menssage, class to manage all Opennemas's messages
 *
 * @package OpenNeMas
 * @version 0.1
 * @author Openhost Team
 * @link http://www.openhost.es
 * @copyright Copyright (c) 2009, Openhost S.L.
 */

/**
 * Message class
 *
 * Gestiona una pila de mensajes guardados en una variable de session para visualizar con js
 *
 * Tipo de mensaje corresponde a un color y un texto.
 * {error:Red, info:Blue, warn:Yellow, ok:Green, custom:Gray}

 *
 * @package OpenNeMas
 * @version 0.1
 */
class Message {

    protected $type=null;
    protected $text =null;

    function __construct($text, $type){
        $this->text = $text;
        $this->type = $type;
    }

    /* Limpiar array de menssages */
    static function clear(){
        $_SESSION['messages'] = array();
    }

    /* Devuelve valores de las propiedades, pq son protected. */
    function __get($prop){
        return $this->{$prop};
    }
 
    /*Mete un message en el array de messages
     * Se usa una variable de session por los fordwards.
     */
    function push(){
        $_SESSION['messages'][$this->type][] = $this->text;
    }
    
    /**
     * Helper to simplify add messages to the board
     * 
     * @static
     * @param string $text
     * @param string $type
     */
    static public function add($text, $type='info')
    {
        if(!isset($_SESSION['messages'][$type])) {
            $_SESSION['messages'][$type] = array();
        }
        
        $_SESSION['messages'][$type][] = $text;
    }
    
    /*
     * Desde js genera el html para printarlo en la pagina
     * MessageBoard es la clase js de prototype
     *
     */
    static function render($div, $type="growl", $clear=true){
        $js = "";
        if (!empty($_SESSION['messages'])) {
            $js = '<script type="text/javascript" language="javascript">';
            $js .= 'var MB = new MessageBoard(' . json_encode($_SESSION['messages']) . ',{container:"' . $div . '",type:"' . $type . '"});';
            $js .= 'MB.render();';
            $js .= '</script>';
            
            if($clear) {
                Message::clear();
            }
        }
        return $js;
    }


} //class

/* Notacion JSON
 * Ej:  new Message({type:'info',text:'Mensaje de info'}, ....]);
 * /
 */
