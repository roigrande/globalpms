<?php
function smarty_function_get_category($params, &$smarty) {
	$sql = 'SELECT pk_fk_content_category FROM contents_categories WHERE pk_fk_content = '.intval($params['id']);
    $rs = $GLOBALS['application']->conn->Execute( $sql );

    if (!$rs) {
        return 0;
    }

    return($rs->fields['pk_fk_content_category']);
}
?>