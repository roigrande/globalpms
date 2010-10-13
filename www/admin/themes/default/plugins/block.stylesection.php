<?php
/**
 * Smarty plugin
 * Parse link type="text/stylesheet" tags
 *
*/
function smarty_block_stylesection($params, $content, &$smarty, $open) {
    if( $open ) {
        // NADA
    } else {
        $output = '';
        $matches = array();
        preg_match_all( '@<link .*?href="([^"]+)".*?>@si', $content, $matches );
        
        $section = (!isset($params['name']))? 'head': $params['name'];
        if( !isset( $smarty->css_includes[ $section ] ) ) {
            $smarty->css_includes[ $section ] = array();
        }
        
        $sources = array();
        if( isset($matches[1]) ) {
            foreach($matches[1] as $src) {                
                $source = preg_replace('@'.$smarty->css_dir.'@', '', $src);
                if( !in_array($source, $smarty->css_includes[ $section ]) &&
                    !in_array('@-'.$source, $smarty->css_includes[ $section ]) )
                {                    
                    $sources[] = $source;
                }                
            }
        }
        
        
        foreach($smarty->css_includes[ $section ] as $css) {
            if( !preg_match('/^@\-/', $css) ){
                $output .= '<link rel="stylesheet" type="text/css" href="'.$smarty->css_dir.$css.'" />'."\n";
            }
        }

        
        foreach($sources as $css) {
            $output .= '<link rel="stylesheet" type="text/css" href="'.$smarty->css_dir.$css.'" />'."\n";
        }
    
        
        return( $output );
    }
}