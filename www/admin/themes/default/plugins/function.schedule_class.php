<?php

function smarty_function_schedule_class($params, &$smarty) {    
    if(!isset($params['item'])) {
        $smarty->trigger_error("schedule_class: missing 'item' parameter");
        return;
    }
    
    $item = $params['item'];
    
    if($item->isScheduled() && $item->isInTime()) {
        return ' scheduled_V';
    } elseif($item->isScheduled() && $item->isObsolete()) {
        return ' scheduled_R';
    }elseif($item->isScheduled() && !$item->isObsolete()) {
        return ' scheduled_A';
    }
    
    return '';
}