<?php
/**
 * <IfModule mod_rewrite.c>
 *   RewriteEngine On
 *   RewriteBase /router_url # modificar ao path adecuado
 *   RewriteCond %{REQUEST_FILENAME} !-d
 *   RewriteCond %{REQUEST_FILENAME} !-f
 *   RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
 * </IfModule>
 *
 *
 */

/**
 * 
 * @see http://docs.djangoproject.com/en/dev/topics/http/urls/
 */
class URLDispatcher {
    protected $routes = array();
    protected $url    = NULL;
    
    public function __construct($routes=NULL) {
        // Recuperar la URL, ver fichero htaccess para ver como se hace la reescritura
        $this->url = $_GET['url'];
        
        if(!is_null($routes)) {
            $this->routes = $routes;
        }                
    }
    
    // engadir sempre ao comenzo
    public function addRoute($entry) {
        $routes = array();
        $routes[] = $entry;
        
        foreach($this->routes as $route) {
            $routes[] = $route;
        }
        
        $this->routes = $routes;
    }
    
    public function populateRequest($matches) {
        foreach($matches as $k => $v) {
            if($k != '0') {
                $_GET[ $k ] = $v;
            }
        }
        
        foreach($matches as $k => $v) {
            if($k != '0') {
                $_REQUEST[ $k ] = $v;
            }
        }        
    }
    
    public function run() {                
        
        foreach($this->routes as $route) {
            $matches = array();
            // -------------------------------------------------------------------------------------------------------------
            // OLLO: seria moi interesante eliminar de $this->url caracteres PERIGOSOS (?.:&;, ...) os que non fagan falta -
            // -------------------------------------------------------------------------------------------------------------
            if(!is_array($route['regexp'])) {
                if( preg_match($route['regexp'], $this->url, $matches) ) {
                    $this->populateRequest( $matches );
                    
                    if( isset($route['handler']) ) {
                        $this->_execHandler( $route['handler'] );
                    }
                    
                    break; // xa non parseamos máis
                }
            } else {
                foreach($route['regexp'] as $regexp) {
                    if( preg_match($regexp, $this->url, $matches) ) {
                        $this->populateRequest( $matches );
                        
                        if( isset($route['handler']) ) {
                            $this->_execHandler( $route['handler'] );
                        }
                        
                        break 2; // xa non parseamos máis
                    }
                }
            }
        }                
    }
    
    private function _execHandler($handler) {
        try {
            eval( $handler.'();' );
        } catch(Exception $ex) {
            die( 'Handler undefined: '. $ex->getMessage() );
        }
    }
}

