<?php
if( !function_exists('smarty_function_cssimagescale') ) {
    function smarty_function_cssimagescale($params, &$smarty=NULL) {
        // Return HTML 	
        $resolution = $params['resolution'];
        
        $filename = realpath( MEDIA_IMG_PATH. $params['photo']->path_file. $params['photo']->name );
            
        list($width, $height, $type, $attr) = getimagesize( $filename );
        if($height>0 and $width>0){        //No divide by 0
	        if( $width > $height) {
	            $w = $resolution;        
	            $h = floor( ($height*$w) / $width );
	        } else {
	            $h = $resolution - 4;
	            $w = floor( ($width*$h) / $height );
	        }
        }else{
        	$w=0;
        	$h=0;
        }
        if( isset($params['getwidth']) ) {
            return( $w );
        }
        return( 'width: '.$w.'px; height: '.$h.'px;' );
    }
}