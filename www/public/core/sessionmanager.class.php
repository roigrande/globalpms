<?php
// TODO: mover a config.inc.php ¿?¿?¿?
//define('OPENNEMAS_BACKEND_SESSIONS',  '/var/lib/opennemas/'.SITE.'/sessions/backend/');
//define('OPENNEMAS_FRONTEND_SESSIONS', '/var/lib/opennemas/'.SITE.'/sessions/frontend/');

// En un .htaccess php_value session.save_path /var/lib/.../

class SessionManager implements ArrayAccess {
    // Directorio por defecto de sesiones de PHP5 por defecto
    protected $dirSess = '/var/lib/php5/';
    
    protected static $singleton = null;
    
    private function __construct($session_save_path) {
        $this->dirSess = $session_save_path;
    }
    
    static public function getInstance($session_save_path) {
        if( is_null(self::$singleton) ) {
            self::$singleton = new SessionManager($session_save_path);
        }
        
        return( self::$singleton );
    }
    
    public function bootstrap($lifetime=null) {
        if(is_null($lifetime) && !isset($_COOKIE['default_expire'])) {
            $lifetime = 15; // 15 minutes by default
        } elseif( isset($_COOKIE['default_expire']) ) {
            $lifetime = intval($_COOKIE['default_expire']);
        }
        
        // Set session_save_path
        session_save_path( $this->dirSess );
        
        // set the cache expire to $lifetime minutes
        session_cache_expire($lifetime);
        
        // public, private, nocache, private_no_expire
        //  http://cz.php.net/manual/en/function.session-cache-limiter.php 
        session_cache_limiter('nocache');
        
        // Now we can call to session_start
        session_start();
    }
    
    function __set($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    function __get($name) {
        if(!isset($_SESSION[$name])) {
            return null;
        }
        
        return($_SESSION[$name]);
    }
    
    
    /** 
    * Defined by ArrayAccess interface 
    * Set a value given it's key e.g. $A['title'] = 'foo'; 
    * @param mixed key (string or integer) 
    * @param mixed value 
    * @return void 
    */ 
    function offsetSet($key, $value) { 
        $_SESSION[$key] = $value; 
    } 
    
    /** 
    * Defined by ArrayAccess interface 
    * Return a value given it's key e.g. echo $A['title']; 
    * @param mixed key (string or integer) 
    * @return mixed value 
    */ 
    function offsetGet($key) { 
        return($_SESSION[$key]);
    } 
    
    /** 
    * Defined by ArrayAccess interface 
    * Unset a value by it's key e.g. unset($A['title']); 
    * @param mixed key (string or integer) 
    * @return void 
    */ 
    function offsetUnset($key) { 
        unset($_SESSION[$key]); 
    } 
    
    /** 
    * Defined by ArrayAccess interface 
    * Check value exists, given it's key e.g. isset($A['title']) 
    * @param mixed key (string or integer) 
    * @return boolean 
    */ 
    function offsetExists($offset) { 
        return isset($_SESSION[$key]); 
    }
    
    
    
    /* Métodos para el control de la sesión y los usuarios activos */        
    public function getSessions() {
        $dirSess = $this->dirSess;
        $sessions = array();            
        
        if (file_exists($dirSess) && is_dir($dirSess)) {
            if ($dh = opendir($dirSess)) {
                while (($file = readdir($dh)) !== false) {
                    if( preg_match('/^sess_/', $file) ) {
                        $contents = file_get_contents($dirSess.$file);
                        if(!empty($contents)) {
                            $session = SessionManager::unserializesession( $contents );
                       
                            if( isset($session['userid']) ) {
                                $sessions[] = array( 'userid'     => $session['userid'],
                                                     'username'   => $session['username'],
                                                     'isAdmin'    => $session['isAdmin'],
                                                     'expire'     => $session['expire'],
                                                     'authMethod' => $session['authMethod'],);
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }
        
        return( $sessions );
    }
    
    public function purgeSession( $userid ) {
        $dirSess = $this->dirSess;
        
        if (file_exists($dirSess) && is_dir($dirSess)) {
            if ($dh = opendir($dirSess)) {
                while (($file = readdir($dh)) !== false) {
                    if( preg_match('/^sess_/', $file) ) {
                        $contents = file_get_contents($dirSess.$file);
                        if(!empty($contents)) {
                            $session = SessionManager::unserializesession( $contents );
                           
                            if( isset($session['userid']) && ($session['userid']==$userid)) {
                                @unlink( $dirSess.$file );
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }                
    }
    
    // http://es2.php.net/manual/en/function.session-decode.php#79244
    public function unserializesession($data) {
        $vars=preg_split('/([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff^|]*)\|/',
                  $data,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        
        $i=0;
        while(isset($vars[$i])) {
            $result[$vars[$i++]]=@unserialize($vars[$i]);
            $i++;
        }
        return $result;
    }
    
}