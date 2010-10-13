<?php
/**
 * Smarty plugin
 * Parse script tags
 *
*/
function smarty_block_scriptsection($params, $content, &$smarty, $open) {
    if( $open ) {
        // NADA
    } else {
        $output = '';
        $matches = array();
        preg_match_all( '@<script .*?src="([^"]+)".*?>.*?</script>@si', $content, $matches );
        
        $section = (!isset($params['name']))? 'head': $params['name'];
        if( !isset( $smarty->js_includes[ $section ] ) ) {
            $smarty->js_includes[ $section ] = array();
        }
        
        $sources = array();
        if( isset($matches[1]) ) {
            foreach($matches[1] as $src) {                
                $source = preg_replace('@'.$smarty->js_dir.'@', '', $src);
                if( !in_array($source, $smarty->js_includes[ $section ]) &&
                    !in_array('@-'.$source, $smarty->js_includes[ $section ]) )
                {                    
                    $sources[] = $source;
                }                
            }
        }
        
        
        foreach($smarty->js_includes[ $section ] as $script) {
            if( !preg_match('/^@\-/', $script) ){
                $output .= '<script language="javascript" type="text/javascript" src="'.$smarty->js_dir.$script.'"></script>'."\n";
            }
        }

        
        foreach($sources as $script) {
            $output .= '<script language="javascript" type="text/javascript" src="'.$smarty->js_dir.$script.'"></script>'."\n";
        }
        
        return( $output );
    }
}