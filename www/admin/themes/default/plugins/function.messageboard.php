<?php
/**
 * function.messageboard.php, Smarty plugin for render message board
 *
 * @package  OpenNeMas
 * @author Toni Martínez <toni@openhost.es>
 */

/**
 * smarty_function_messageboard, Smarty plugin for render message board
 * <code>
 * {messageboard type="growl" clear="true"}
 * </code>
 *
 * @author Toni Martínez <toni@openhost.es>
 * @param array $params  Parameters of smarty function
 * @param Smarty $smarty Object reference to Smarty class
 * @return string Return a HTML code of the message board
 */
function smarty_function_messageboard($params, &$smarty=NULL) {
    
    require_once SITE_ADMIN_PATH.'/core/message.class.php';

    if (!isset($params['type']) || empty($params['type'])) {
        $params['type'] = 'growl';
    }
    if (!isset($params['clear']) || empty($params['clear'])) {
        $params['clear'] = true;
    }        

    $out = '<div id="msgBox" class="' . $params['type'] . '"></div>';
    $out .= Message::render('msgBox', $params['type'], $params['clear']);

    return $out;
}