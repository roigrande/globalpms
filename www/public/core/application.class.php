<?php


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

 
    function __construct() {
        $this->adodb        = SITE_LIBS_PATH.'/adodb5/adodb.inc.php';
        $this->smarty       = SITE_LIBS_PATH.'/smarty/Smarty.class.php';
        $this->log          = SITE_LIBS_PATH.'/Log.php';
        $this->pager        = SITE_LIBS_PATH.'/Pager/Pager.php';
        $this->template     = SITE_LIBS_PATH.'/template.class.php';
    }

    /**
     * Static method
    */
    static function load() {
        if(!isset($GLOBALS['application']) || $GLOBALS['application']==NULL) {
            
            $GLOBALS['application'] = new Application();
            
            // Database
            $GLOBALS['application']->conn = ADONewConnection(BD_TYPE);
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
    static function import_libs($packages=null) {
        $libs = array(  'adodb'    => array(SITE_LIBS_PATH.'/adodb5/adodb.inc.php'),
                        'smarty'   => SITE_LIBS_PATH.'/smarty/Smarty.class.php',
                        'log'      => SITE_LIBS_PATH.'/Log/Log.php',
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

   
    // Devolver HTML para funciones ajax
    static public function ajax_out($htmlout) {
        header("Cache-Control: no-cache");
        header("Pragma: nocache");
        header("Content-type: text/x-json");
        echo $htmlout;
        exit(0);
    }
    
    /* Events system */
    function register($event, $callback, $args=array()) {
        $this->events[$event][] = array($callback, $args);
    }
    
   
    
    function setcookie_secure($name, $value, $expires=0, $domain='/') {
        setcookie($name, $value, $expires, $domain,
                  $_SERVER['SERVER_NAME'], isset($_SERVER['HTTPS']), true );
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
