<?php

function smarty_function_schedule_info($params, &$smarty) {    
    if(!isset($params['item'])) {
        $smarty->trigger_error("schedule_class: missing 'item' parameter");
        return;
    }
    
    $item = $params['item'];
    
    if($item->isScheduled()) {
        $output = '';
        
        if(!empty($item->starttime) && !preg_match('/0000\-00\-00 00:00:00/', $item->starttime)) {
            $output .= '<strong>Inicio pub.:</strong> ' . date('H:i d/m/Y', strtotime($item->starttime));
        }
        
        if(!empty($item->endtime) && !preg_match('/0000\-00\-00 00:00:00/', $item->endtime)) {
            if($output != '') {
                $output .= '<br />';
            }
            $output .= '<strong>Fin pub.:</strong> ' . date('H:i d/m/Y', strtotime($item->endtime));
        }
        
        return $output;
    }
    
    return '';
}