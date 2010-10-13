<?php
/* {renderplaceholder items=$oddpublished tpl='article_render_fila.tpl' placeholder="placeholder_1_0"} */
function smarty_function_renderarticle($params, &$smarty) {
    $output = '';

    $items   = $params['items'];
    $tpl     = $params['tpl'];
    $placeholder  = $params['placeholder'];
    $odd_rating     =$params['odd_rating'];
    $odd_comment    =$params['odd_comment'];
    $odd_editors    =$params['odd_editors'];
    $odd_publishers =$params['odd_publishers'];

    $category_name = $smarty->get_template_vars('category');
    $property = ($category_name=='home')? 'home_placeholder': 'placeholder';
    $varname = (!isset($params['varname']))? 'item': $params['varname'];
$a=1;
    foreach($items as $i => $item) {                
      if( $item->{$property} == $placeholder ) {
            $smarty->clear_assign($varname);
            $smarty->assign($varname, $items[$i]);
            $smarty->assign('placeholder', $placeholder);
            $smarty->assign('aux', $a);
            $a++;
            $output .= $smarty->fetch( $tpl);
         }
    }
    
  
    return( $output );
}