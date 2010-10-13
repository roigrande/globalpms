<?php
/* {renderplaceholder items=$oddpublished tpl='article_render_fila.tpl' placeholder="placeholder_1_0"} */
function smarty_function_renderarticlecondition($params, &$smarty) {
    $output = '';

    $items   = $params['items'];
    $tpl     = $params['tpl'];
    $odd_rating     =$params['odd_rating'];
    $odd_comment    =$params['odd_comment'];
    $odd_editors    =$params['odd_editors'];
    $odd_publishers =$params['odd_publishers'];

    $category_name = $smarty->get_template_vars('category');
    $property = ($category_name=='home')? 'home_placeholder': 'placeholder';
    $varname = (!isset($params['varname']))? 'item': $params['varname'];
    $filter  = '$__condition__ = '.$params['condition'].';';
    $condition =$params['condition'];

    foreach($items as $i => $item) {      
        if($condition){
            eval($filter);
        }
        if(!$condition OR $__condition__){                     
            $smarty->clear_assign($varname);
            $smarty->assign($varname, $items[$i]);
            $smarty->assign(odd_rating, $odd_rating[$i]);
            $smarty->assign(odd_comment, $odd_comment[$i]);
            $smarty->assign(odd_editors, $odd_editors[$i]);
            $smarty->assign(odd_publishers, $odd_publishers[$i]);
            $smarty->assign('aux', $i);

            $output .= $smarty->fetch( $tpl);
        }
    }
    
  
    return( $output );
}