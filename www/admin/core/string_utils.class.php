<?php
class String_Utils {

    var $stringTest = NULL;

    function String_Utils($string=NULL) {
      //echo $stringTest." si<br>";
        if(!is_null($string))
            {$this->stringTest=$string;}
        else {$this->stringTest="";}
    }

    function __construct($string=NULL){
        $this->String_Utils($string);
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
                        '<'=>'', '>'=>'', '?'=>'-', ','=>'-', 'ç'=>'c', 'Ç'=>'C', '·'=>'',
                        '.'=>'', ';'=>'-', '['=>'-', ']'=>'-','ñ'=>'n','Ñ'=>'n');
        $name = strtr($name, $trade);
        return $name;
    }
    
    
    function setString($string)
    {
        $this->stringTest=$string;
    }

    function getString()
    {
        return $this->stringTest;
    }
    
    /**
     * 
    */
    function clearSpecialChars($str) {
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        $str = mb_strtolower($str, 'UTF-8');
        $str = mb_ereg_replace('[^a-z0-9áéíóúñüç_\,\- ]', ' ', $str);
        
        return $str;
    }
    
    /**
     *
    */
    function setSeparator($str, $separator='-') {
        $str = trim($str);
        $str = preg_replace('/[ ]+/', $separator, $str);
        
        return $str;
    }

    /**
     * Generate a valid permalink
     *
     * @param string $title
     * @param boolean $useStopList
     * @return string
     */
    function get_title($title, $useStopList=true) {
        $title = String_Utils::clearSpecialChars($title);
        $title = String_Utils::normalize_name($title);
        $title = mb_ereg_replace('[^a-z0-9\- ]', '', $title);
        
        if($useStopList) {
            // Remove stop list
            $titule = String_Utils::remove_shorts($title);
        }
    
        if(empty($titule) || $titule ==" "){ //Si se queda vacio, no quitar shorts.
            $titule=$title;       
         }
 
        $titule = String_Utils::setSeparator($titule, '-');
        $titule = preg_replace('/[\-]+/', '-', $titule);

        return $titule;
    }
    
    /**
     * Prevent duplicate metadata
     * 
     * @param string $metadata
     * @param string $separator By default ','
     * @return string
     */
    public function normalize_metadata($metadata, $separator=',')
    {
        $items = explode(',', $metadata);
        
        foreach($items as $k => $item) {
            $items[$k] = trim($item);
        }
        
        $items = array_flip($items);
        $items = array_keys($items);
        
        $metadata = implode(',', $items);
        return $metadata; 
    }
    
        
    /**
     * Generate a string of key words separated by semicolon
     *
     * @param string $title
     * @return string
     */
    function get_tags($title) {
        $tags = String_Utils::clearSpecialChars($title);

        // Remove stop list
        $tags = String_Utils::remove_shorts($tags);
        $tags = String_Utils::setSeparator($tags, ',');
        $tags = preg_replace('|-|', ',', $tags);
        $tags = preg_replace('/[\,]+/', ',', $tags);

        // Remove duplicates
        $tags = array_unique(explode(',', $tags));
        $tags = implode(', ', $tags);

        return $tags;
    }        
   
    /**
      * Modified from Meneame:
      * @link http://svn.meneame.net/index.cgi/branches/version3/www/libs/uri.php
    */
    function remove_shorts($string) {
        $shorts = file( dirname(__FILE__).'/string_utils_stoplist.txt');
        
        $size = count($shorts);
        
        for($i=0; $i<$size; $i++) {            
            $short  = preg_replace('/\n/', '', $shorts[$i]);
            $string = preg_replace('/^'.$short.'[\.\, ]/', ' ', $string);
            $string = preg_replace('/[\.\, ]'.$short.'[\.\, ]/', ' ', $string);
            $string = preg_replace("/[\.\, ]$short$/", ' ', $string);
        }
        
        return $string;
    }
    
    function str_stop($string, $max_length=30, $suffix='...'){
        if (strlen($string) > $max_length) {
            $string = substr($string, 0, $max_length);
            $pos = strrpos($string, " ");
            if ($pos === false) {
                return substr($string, 0, $max_length).$suffix;
            }
            return substr($string, 0, $pos).$suffix;
        } else {
            return $string;
        }
    }
    
    function unhtmlentities($string) {
        // replace numeric entities
        $string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
        $string = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $string);
        // replace literal entities
        $trans_tbl = get_html_translation_table(HTML_ENTITIES);
        $trans_tbl = array_flip($trans_tbl);
        return utf8_encode(strtr($string, $trans_tbl));
    }

    /**
     *
     * @param array $data
     */
    function disabled_magic_quotes( &$data=NULL ) {    
        if( get_magic_quotes_gpc() ) {
            function stripslashes_deep($value) {
                $value = is_array($value) ?
                            array_map('stripslashes_deep', $value) :
                            stripslashes($value);
                return $value;
            }
            
            if( !is_null($data) ) {
                $data = array_map('stripslashes_deep', $data);
            } else {
                $_POST = array_map('stripslashes_deep', $_POST);
                $_GET = array_map('stripslashes_deep', $_GET);
                $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
                $_REQUEST = array_map('stripslashes_deep', $_REQUEST);                
            }
        }
    }
    
    
    function clearBadChars($string)
    {
        $string = preg_replace('/'.chr(226).chr(128).chr(169).'/', '', $string);        
        return $string;
    }
    
    //Coge "n" primeras palabras de un texto.
    function get_num_words($text,$num_words) {
        $no_html = strip_tags($text ); //Quita etiquetas html.
        $description = explode(" ",$no_html,$num_words);
        $sobra = array_pop($description);
        $words = implode(" ",$description).'...';
    		
    	return $words;
    }

    public function loadBadWords()
    {
        $entries = file(dirname(__FILE__).'/string_utils_badwords.txt');
        $words = array();
        foreach($entries as $entry) {
            if(preg_match('/^(\d+)\,(.*?)$/', $entry, $matches)) {
                
                $words[] = array('weight' => $matches[1],
                                 'text'   => trim($matches[2])
                                );
            }
        }
        
        return $words;
    }
    
    /**
     * filterBadWords
     *
    */
    public function filterBadWords($text, $weight=0, $replaceStr=' ')
    {
        $words = String_Utils::loadBadWords();
        $text = ' ' . $text . ' ';
        
        foreach($words as $word) {
            if($word['weight'] > $weight) {
                $text = preg_replace('/\W' . $word['text'] . '\W/si', $replaceStr, $text);
            }
        }
        
        $text = trim($text);
        
        return $text;
    }
    
    /**
     * getWeightBadWords
     *
    */
    public function getWeightBadWords($text)
    {
        $words = String_Utils::loadBadWords();
        $text = ' ' . $text . ' ';
        
        $weight = 0;
        
        foreach($words as $word) {
            if(preg_match_all('/' . $word['text'] . '/si', $text, $matches)) {
                $weight += ($word['weight'] * count($matches[0]));
            }            
        }
        
        return $weight;
    }    
}