<?php
// Prevent direct access
//if (ereg('application.class.php', $_SERVER['PHP_SELF'])) {
  //  die();
//}

function &MonitorContentStatus($db, $sql, $inputarray) {
    if( preg_match('/content_status/', $sql) && preg_match('/^[ ]*update/i', $sql) ) {
        $GLOBALS['application']->workflow->log( 'SQL content_status - ' .
                $_SESSION['username'] . ' - ' . $sql . ' ' . print_r($inputarray, true), PEAR_LOG_INFO );
    }
    
    $a=null;
    return $a;
}


class Application {    
    var $conn         = null;
    var $logger       = null;
    var $workflow     = null;
    var $errors       = array();
    var $adodb        = null;
    var $activerecord = null;
    var $smarty       = null;
    var $log          = null;
    var $menu         = null;
    var $pager        = null;
    var $template     = null;
    var $sesion       = null;
    var $cache        = null;
    var $image        = null;
    var $events       = array();
    
    /**
     * Semphore to access critic section
     * @var mixed IPC semphore
     */
    public static $sem = null;

    function Application() {        
        $this->adodb        = SITE_LIBS_PATH.'adodb5/adodb.inc.php';
        $this->smarty       = SITE_LIBS_PATH.'smarty/Smarty.class.php';
        $this->log          = SITE_LIBS_PATH.'Log.php';
        $this->pager        = SITE_LIBS_PATH.'Pager/Pager.php';
        $this->template     = SITE_LIBS_PATH.'template.class.php';      
    }

    function __construct() {
        $this->Application();
    }

    /**
     * Static method
    */
    function load() {
        if(!isset($GLOBALS['application']) || $GLOBALS['application']==NULL) {
            
            $GLOBALS['application'] = new Application();
            
            // Database
            $GLOBALS['application']->conn = &ADONewConnection(BD_TYPE);
            $GLOBALS['application']->conn->Connect(BD_HOST, BD_USER, BD_PASS, BD_INST);            
            
            // Check if adodb is log enabled
            if( defined('ADODB_LOG_ENABLE') && (ADODB_LOG_ENABLE == 1) ) {
                $GLOBALS['application']->conn->LogSQL();
            }
            
            //$GLOBALS['application']->conn->fnExecute = 'MonitorContentStatus';
            //$GLOBALS['application']->conn->fnExecute = 'CountExecs';
            
            $conf = array('mode' => 0600,
              'timeFormat' => '%Y%m%d%H%M%S',
              'lineFormat' => '%1$s [%2$s] %4$s');
             $GLOBALS['application']->workflow = Log::factory('file', '/var/lib/opennemas/xornal/log/workflow.log', 'WF', $conf);
            //$GLOBALS['application']->mutex = Log::factory('file', '/var/lib/opennemas/xornal/log/mutex.log', 'MUTEX', $conf);

            
            // Composite Logger (file + mail)
            // http://www.indelible.org/php/Log/guide.html#composite-handlers
            if( defined('LOG_ENABLE') && (LOG_ENABLE == 1)) {                
                $GLOBALS['application']->logger = &Log::singleton('composite');
                
                $conf = array('mode' => 0600,
                              'timeFormat' => '%Y%m%d%H%M%S',
                              'lineFormat' => '%1$s %2$s [%3$s] %4$s %5$s %6$s');
                $fileLogger = &Log::singleton('file', SYS_LOG, 'application', $conf);
                $GLOBALS['application']->logger->addChild($fileLogger);
                
                /* if(defined('SYS_LOG_EMAIL')) {
                    $conf   = array('subject' => '[LOG] OpenNeMas application logger',
                                    'timeFormat' => '%Y%m%d%H%M%S',
                                    'lineFormat' => '%1$s %2$s [%3$s] %4$s %5$s %6$s');
                    $mailLogger = &Log::singleton('mail', SYS_LOG_EMAIL, 'application', $conf);
                    $GLOBALS['application']->logger->addChild($mailLogger);
                } */
            } else {
                $GLOBALS['application']->logger = &Log::singleton('null');
            }
        }
        
        return( $GLOBALS['application'] );
    }
    
    /**
     * Include
     * 
     * @param array $packages Packages to include
     */
    function import_libs($packages=null) {
        $libs = array(  'adodb'    => array(SITE_LIBS_PATH.'adodb5/adodb.inc.php'),
                        'smarty'   => SITE_LIBS_PATH.'/smarty/Smarty.class.php',
                        'log'      => SITE_LIBS_PATH.'/Log.php',
                        'pager'    => SITE_LIBS_PATH.'/Pager/Pager.php',                        
                        'template' => array(SITE_LIBS_PATH.'/smarty/Smarty.class.php',  SITE_LIBS_PATH.'/template.class.php'),
                     );

        if( is_null($packages) || $packages == '*' ) {
            foreach($libs as $lib) {
                if( !is_array($lib) ) {
                    
                    require_once($lib);
                } else {
                    foreach($lib as $dependencia) {
                        
                        require_once($dependencia);
                    }
                }
            }
        } else {
            $pcks = explode(';', $packages);
            foreach($pcks as $p) {
                if( array_key_exists($p, $libs) ) {
                    if( !is_array($libs[$p]) ) {
                        require_once($libs[$p]);
                    } else {
                        foreach($libs[$p] as $dependencia) {
                            require_once($dependencia);
                        }
                    }
                }
            }
        }
    }    

    // Redirección
    function forward($url) {
        header ("Location: ".$url);
        exit(0);
    }
    
    /**
     * getMutex
     *
     * @param string $id, Cache Id to generate sem_id identifier
    */
    public static function getMutex($id)
    {
        if(defined('MUTEX_ENABLE') && MUTEX_ENABLE != 0) {
            $sem_key = crc32($id);
            Application::$sem = sem_get($sem_key, 1, 0666, true);
            
            sem_acquire(Application::$sem);
            // $GLOBALS['application']->mutex->log('< I (' . $id . '): ' . getmypid());
        }
    }
    
    /**
     * releaseMutex
    */
    public static function releaseMutex()
    {
        if(!is_null(Application::$sem)) {
            // $GLOBALS['application']->mutex->log('> O: ' . getmypid());
            
            sem_release(Application::$sem);
        }        
    }
    
    /**
     * Detect a mobile device and redirect to mobile version
     *
     * @param boolean $auto_redirect
     * @return boolean True if it's a mobile device and $auto_redirect is false
    */
    function mobileRouter($auto_redirect=true)
    {
        $isMobileDevice = false;
        
        /*
        
        // Browscap library
        require dirname(__FILE__) . '/../libs/Browscap.php';
        
        // Creates a new Browscap object (loads or creates the cache)
        $bc = new Browscap( dirname(__FILE__) . '/../cache');
        $browser = $bc->getBrowser(); //isBanned
        
        if(!empty($browser->isMobileDevice) && ($browser->isMobileDevice == 1) && !(isset($_COOKIE['confirm_mobile']))) {
            if($auto_redirect) {
                Application::forward('/mobile' . $_SERVER['REQUEST_URI'] );
            } else {
                $isMobileDevice = true;
            }
        }
        
        */
        
        return $isMobileDevice;
    }
    
    /**
     * Check if current request is from backend
     *
     * @return boolean  
    */
    static public function isBackend()
    {
        return strncasecmp($_SERVER['REQUEST_URI'], '/admin/', 7) == 0 ;
    }
    
    /**
     * Perform a permnently redirection (301)
     *
     * @param string $url
    */
    function forward301($url)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        exit(0);
    }

    // Redirección sobre el frame principal
    function forwardTargetParent($url) {
        $html =<<<HTMLCODE
<html>
<head>
  <meta http-equiv="refresh" content="0;url=/admin/login.php" />
</head>
<body>
<script> window.top.location="$url";</script>
</body>
</html>
HTMLCODE;
        echo($html);
        
        exit(0);
    }

    // Devolver HTML para funciones ajax
    function ajax_out($htmlout) {
        header("Cache-Control: no-cache");
        header("Pragma: nocache");
        echo $htmlout;
        exit(0);
    }
    
    /* Events system */
    function register($event, $callback, $args=array()) {
        $this->events[$event][] = array($callback, $args);
    }
    
    function dispatch($eventName, $instance, $args=array()) {        
        if( isset($this->events[$eventName]) ) {
            $events = $this->events[$eventName];
            
            if( is_array($events) ) {
                foreach($events as $i => $event) {
                    $callback = $event[0];
                    $args     = array_merge($args, $event[1]);
                    
                    if(is_object($instance)) {
                        if(method_exists($instance, $callback)) {
                            // Call to the instance
                            call_user_func_array(array(&$instance, $callback), $args);
                        }
                    } else {
                        // Static call 
                        call_user_func_array(array($instance, $callback), $args);
                    }
                }
            }
        }
    }
    
    function setcookie_secure($name, $value, $expires=0, $domain='/') {
        setcookie($name, $value, $expires, $domain,
                  $_SERVER['SERVER_NAME'], isset($_SERVER['HTTPS']), true );
    }
    
    function getRealIP() {
        // REMOTE_ADDR: dirección ip del cliente
        // HTTP_X_FORWARDED_FOR: si no está vacío indica que se ha utilizado un proxy. Al pasar por el proxy lo que hace
        // éste es poner su dirección IP como REMOTE_ADDR y añadir la que estaba como REMOTE_ADDR al final de esta cabecera.
        // En el caso de que la petición pase por varios proxys cada uno repite la operación, por lo que tendremos una lista
        // de direcciones IP que partiendo del REMOTE_ADDR original irá indicando los proxys por los que ha pasado.
        
        if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ) {
            $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ?
                $_SERVER['REMOTE_ADDR']
                :
                ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
                    $_ENV['REMOTE_ADDR']
                    :
                    "unknown" );
            
            // los proxys van añadiendo al final de esta cabecera
            // las direcciones ip que van "ocultando". Para localizar la ip real
            // del usuario se comienza a mirar por el principio hasta encontrar
            // una dirección ip que no sea del rango privado. En caso de no
            // encontrarse ninguna se toma como valor el REMOTE_ADDR
            
            $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
            
            reset($entries);
            while (list(, $entry) = each($entries)) {
                $entry = trim($entry);
                if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) ) {
                    // http://www.faqs.org/rfcs/rfc1918.html
                    $private_ip = array(
                          '/^0\./',
                          '/^127\.0\.0\.1/',
                          '/^192\.168\..*/',
                          '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                          '/^10\..*/');
                    
                    $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
                    
                    if ($client_ip != $found_ip)
                    {
                       $client_ip = $found_ip;
                       break;
                    }
                }
            }
        } else {
            $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ?
                $_SERVER['REMOTE_ADDR']
                :
                ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
                    $_ENV['REMOTE_ADDR']
                    :
                    "unknown" );
        }
        
        return $client_ip;
    }    
}

/* Others commons functions */
if (!function_exists('clearslash')) {
    function clearslash($string) {
        $string = stripslashes($string);
        $string = str_replace("\\", '', $string);
        
        return stripslashes($string);
    }
}
