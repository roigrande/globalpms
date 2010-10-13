<?php
/**
 * Smarty plugin
 * Check if this block is allow display your content
 * 
 * {acl isAllowed="PRIVILEGE" hasCategoryAccess="10"}
 *    {* If $_SESSION['userid'] has access then show this content *}
 *    ...smarty content...
 * {/acl}
 *
*/
function smarty_block_acl($params, $content, &$smarty, $open) {
    if( $open ) {
        // NADA
    } else {
        require_once(SITE_ADMIN_PATH . '/core/privileges_check.class.php');
        $check = true;
        
        if(isset($params['isAllowed'])) {
            $isAllowed = $params['isAllowed'];            
            $check = $check && Acl::_($isAllowed);            
        }
        
        if(isset($params['hasCategoryAccess'])) {
            $hasCategoryAccess = $params['hasCategoryAccess'];
            $check = $check && Acl::_C($hasCategoryAccess);
        }        
        
        return $check ? $content: '';
    }
}