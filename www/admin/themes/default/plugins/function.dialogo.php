<?php
function smarty_function_dialogo($params, &$smarty) {
    $html = '';
        
    if( isset($params['script']) && $params['script']=='print' ) {
    // Amosar únicamente o javascript
        $html = <<<EOT
<script language="javascript" type="text/javascript">
var dialogo = null;
function abrirDialogo(nombre_campo, cat) {

	var w = 480;
	var h = 380;
	var left = (screen.width-w)/2;
	var top = (screen.height-h)/2;

	dialogo = window.open('file.explorer.php?campo_retorno='+nombre_campo+'&category='+cat,
		'dialogo', 'toolbar=no, location=no, directories=no, status=no, menub ar=no, scrollbar=no, resizable=no, copyhistory=yes,' +
			'width='+w+', height='+h+', left='+left+', top='+top+', screenX='+left+', screenY='+top);
	if(parseInt(navigator.appVersion) >= 4) {
		dialogo.window.focus();
	}
}

var MAX_XY = 300;
function scale(img) {

	if((img.clientWidth > img.clientHeight) && (img.clientWidth > MAX_XY)) {
        img.style.height = Math.round( (img.clientHeight * MAX_XY) /img.clientWidth ) + 'px';
        img.style.width = MAX_XY + 'px';
    } else {
	    if((img.clientHeight > img.clientWidth) && (img.clientHeight > MAX_XY)) {
	    	img.style.width = Math.round( (img.clientWidth * MAX_XY) /img.clientHeight ) + 'px';
	        img.style.height = MAX_XY + 'px';
	    }
	}
	
}

</script>
EOT;
        return( $html );
    } 
    
    if(isset($params['field'])) {
        $field = $params['field'];
        $value = (isset($params['value']))? $params['value']: '';
         $cat = $params['category'];
        $html = '<input type="hidden" id="'.$field.'" name="'.$field.'" value="'.$value.'" />';
        $html .= '<input type="hidden" id="cat" name="cat" value="'.$cat.'" />';
        $html .= '<a href="#" onclick="javascript:abrirDialogo(\''.$field.'\',\''.$cat.'\');">'.
                    '<img src="themes/default/images/edit_image.png" border="0" align="absmiddle" /> </a>'.
                 '	</td></tr><tr><td nowrap><div id="preview_'.$field.'" class="preview">';
        if(!empty($value)) {
            $html .= '<img src="'.$value.'" onload="javascript:scale(this);" onerror="this.style.display=\'none\';" border="0" />';
        }
        $html .= '</div>';
    }
    

    return $html;
}
?>
