<?php
if (preg_match('%utils.functions.php%', $_SERVER['PHP_SELF'])) {	die(); }

function import_libs($packages=null) {

    $libs = array(  /*'config'    => array('/adodb/adodb.inc.php', '/../config/config.inc.php'),
                    'ado'       => array('/adodb/adodb.inc.php', '/activerecord.class.php'),
                    'smarty'    => '/smarty/Smarty.class.php',
                    'log'       => '/Log.php',
                    'menu'      => array('/menu.class.php', '/nestedmenu.class.php'),
                    'pager'     => '/Pager/Pager.php',
                    'template'  => array('/smarty/Smarty.class.php', '/template.class.php'),
                    'sesion'    => '/session.class.php',
                    'cache'		=> '/Cache/Lite.php',
                    'image'     => '/pthumb.class.php'*/);

    if( is_null($packages) || $packages == '*' ) {
        foreach($libs as $lib) {
            if( !is_array($lib) ) {
                require_once(dirname(__FILE__).$lib);
            } else {
                foreach($lib as $dependencia) {
                    require_once(dirname(__FILE__).$dependencia);
                }
            }
        }
    } else {
        $pcks = explode(';', $packages);
        foreach($pcks as $p) {
            if( array_key_exists($p, $libs) ) {
                if( !is_array($libs[$p]) ) {
                    require_once(dirname(__FILE__).$libs[$p]);
                } else {
                    foreach($libs[$p] as $dependencia) {
                        require_once(dirname(__FILE__).$dependencia);
                    }
                }
            }
        }
    }

    //$GLOBALS['conn'] = NewADOConnection( BD_DSN );
}

// Redirect with a HTTP Header
function forward($url) {
    header("Location: ".$url);
    exit(0);
}

function normalize_name($name) {
    $name = strtolower($name);
    $trade = array( 'á'=>'a', 'à'=>'a', 'ã'=>'a', 'ä'=>'a', 'â'=>'a', 'Á'=>'A', 'À'=>'A', 'Ã'=>'A',
                    'Ä'=>'A', 'Â'=>'A', 'é'=>'e', 'è'=>'e', 'ë'=>'e', 'ê'=>'e', 'É'=>'E', 'È'=>'E',
                    'Ë'=>'E', 'Ê'=>'E', 'í'=>'i', 'ì'=>'i', 'ï'=>'i', 'î'=>'i', 'Í'=>'I', 'Ì'=>'I',
                    'Ï'=>'I', 'Î'=>'I', 'ó'=>'o', 'ò'=>'o', 'õ'=>'o', 'ö'=>'o', 'ô'=>'o', 'Ó'=>'O',
                    'Ò'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ô'=>'O', 'ú'=>'u', 'ù'=>'u', 'ü'=>'u', 'û'=>'u',
                    'Ú'=>'U', 'Ù'=>'U', 'Ü'=>'U', 'Û'=>'U', '$'=>'', '@'=>'', '!'=>'', '#'=>'_',
                    '%'=>'', '^'=>'', '&'=>'', '*'=>'', '('=>'-', ')'=>'-', '-'=>'-', '+'=>'',
                    '='=>'', '\\'=>'-', '|'=>'-','`'=>'', '~'=>'', '/'=>'-', '\"'=>'-','\''=>'',
                    '<'=>'', '>'=>'', '?'=>'-', ','=>'-', 'ç'=>'c', 'Ç'=>'C', ' '=>'-' , '·'=>'',
                    '.'=>'', ';'=>'-', '['=>'-', ']'=>'-','ñ'=>'n','Ñ'=>'n');
    $name = strtr($name, $trade);

    /*   if(is_numeric($name{0})) {
        $name{0} = '-';
    }
*/
    return $name;
}

/* Crear la miniatura de la imagen */
function miniatura($image, $width, $height) {
    $image = realpath($image);

	if(!file_exists($image)) {
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		exit(0);
	}

	$dir_cache = dirname(__FILE__)."/../cache/thumbs/";
	$file_info = pathinfo($image);

	if( !file_exists($dir_cache.$file_info['basename']) ) {
		$thumbnail = new PThumb();
		$thumbnail->use_cache = true;
		$thumbnail->cache_dir = $dir_cache;
		$thumbnail->error_mode = 2;

		$data = $thumbnail->fit_thumbnail($image, $width, $height,1,true);
		if(!$data) {
			//$thumbnail->display_x();
			header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
			exit(0);
		}

		$data = $thumbnail->print_thumbnail($image, $data[0], $data[1], true);
		if(!$data) {
			//$thumbnail->display_x();
			header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
			exit(0);
		}

		$fp = fopen($dir_cache.$file_info['basename'], 'wb');
		fwrite($fp, $data);
		fclose($fp);
	} else {
		$data = file_get_contents($dir_cache.$file_info['basename']);
	}

    header('Content-Type: image/'.$file_info['extension']);
    echo($data);
}

// Check if $url is available, only HTTP protocol
function check_url($url) {
	$url = trim($url);
	$url = preg_replace('|^http://|is', '', $url);
	if(strlen($url) <= 0) {
		return(false);
	}

	$url = 'http://'.$url;
    $url = parse_url($url);
    $port = (isset($url['port']) && is_numeric($url['port']))? $url['port']: 80;
    $out = '';

    $fp = @fsockopen($url['host'], $port, $errno, $errstr, 30);

    if (!$fp) {
       return(false);
    } else {
        $resource = $url['path'];
        $resource = (isset($url['query']) && strlen($url['query'])>0)? $resource.'?'.$url['query'] : $resource;
        $resource = (isset($url['fragment']) && strlen($url['fragment'])>0)? $resource.'#'.$url['fragment'] : $resource;
        $resource = ($resource=='')? '/': $resource;

        $cmd = 'HEAD '.$resource." HTTP/1.1\r\n";
        $cmd .= 'Host: '.$url['host']."\r\n";
        $cmd .= "Connection: Close\r\n\r\n";

        fwrite($fp, $cmd);

        while (!feof($fp)) {
            $out .= fgets($fp, 128);
        }
        fclose($fp);

        preg_match("/HTTP\/1.\d (\d{1,3}) (.*?)\n/", $out, $code);
        $code = (isset($code[1]))? $code[1]: 500; // Status code
        return( (($code >= 100) && ($code < 400)) );
    }
}

if(!function_exists('str_stop')){
    function str_stop($string, $max_length, $ended="..."){
        if (strlen($string) > $max_length){
            $string = substr($string, 0, $max_length);
            $pos = strrpos($string, " ");
            if($pos === false) {
                return substr($string, 0, $max_length).$ended;
            }
            return substr($string, 0, $pos).$ended;
        }else{
            return $string;
        }
    }
}

function realurl($url, $preffix='') {
    if(! preg_match('/^http:\/\//i', $url)) {
        $url = URL.$preffix.$url;
    }

    $partes = parse_url($url);
    $document_root = realpath($_SERVER['DOCUMENT_ROOT']);
    $path = str_replace("\\", '/', realpath($document_root.$partes['path']));
    $path_server = str_replace("\\", '/', $document_root).'/';

    $partes['query'] = (isset($partes['query']))?'?'.$partes['query']:$partes['query'];
    $url = 'http://'.$_SERVER['SERVER_NAME'].'/'.preg_replace('|^'.$path_server.'|i', '', $path).$partes['query'].$partes['fragment'];

    return( $url );
}
?>