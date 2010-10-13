<?php
function smarty_function_media($params, &$smarty) {
    // Return HTML 
	$html = '';
    $media = $params['file'];
    $path_parts = pathinfo( $media );
    
    $absolute_uri = preg_replace('|^'.$_SERVER['DOCUMENT_ROOT'].'(.*?)|', '$1', $media);
    
    /* $extensions = array('jpg', 'gif', 'swf', 'png', 'flv');
    // Processing file into sandbox
    $params['file'] = realpath(PATH_UPLOAD.'/'.realpath(str_replace('.', '', $params['file'])));
	if( !is_file($params['file']) && preg_match('/\.('.implode('|', $extensions).')$/i', $params['file']) ) {
		$media = $params['file'];
	} else {
        return( $html );
    } */

	/*if(!file_exists($media)) {
		return 'Error fichero no existe: '.$media;
	}*/
    
    // Get resolution of file
    if( !isset($params['width']) ) {
		list($width, $height, $type, $attr) = getimagesize($media);
	} else {
		$width = $params['width'];
		$height = $params['height'];
	}
	
    // Parse depending of media file type
	//$path_parts = pathinfo($media);    	
	switch($path_parts['extension']) {
		case 'swf':
            $id = str_replace('.', '', str_replace('/', '_', $media));
            $html = '<div id="'.$id.'"></div>
                        <script type="text/javascript">
                        var so = new SWFObject("'.$absolute_uri.'", "splash", "'.$width.'", "'.$height.'", "7", "#FFFFFF");
                        so.addParam("wmode", "opaque"); // transparent, window, opaque
                        so.addParam("quality", "high");
                        so.write("'.$id.'");
                        </script>';
        break;
    
        case 'jpg':
        case 'gif':
        case 'png':
            $html  = '<img src="?action=thumbnail&amp;img='.$media.'&amp;w='.$width.'&amp;h='.$height.'" ';
            $html .= 'border="0" onerror="this.style.display=\'none\';" />';                
        break;
    
        default:
            // Uncontrolled mediafile
            return( $html );
        break;
	}

    return $html;
}
?>