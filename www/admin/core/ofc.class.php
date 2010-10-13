<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ofc
 *
 * @author toni
 */
class OFC {

    static function graphicViewed($data) {

        $bar = new bar_outline( 50, '#87ADD0', '#014687' );
        $bar->key('Visitas', 10);

        foreach($data as $item) {
            if(strlen($item['title'])<50) {
                $title = $item['title'];
            } else {
                $title = substr($item['title'], 0, 47).'...';
            }
            $tip = $title.'<br>Visitas: '.$item['views'];
            $bar->add_data_tip($item['views'], $tip);
        }

        $g = new graph();
        $g->set_bg_colour('#ffffff');

        $g->set_base('/admin/libs/ofc1/');
        $g->set_swf_path('/admin/libs/ofc1/');

        $g->data_sets[] = $bar;
        $g->set_tool_tip( '#tip#' );
        $g->x_axis_colour('#002B53','#E0E0E0');
        $g->y_axis_colour('#002B53','#E0E0E0');

        $top = max($bar->data);
        $g->set_y_max($top);
        $g->y_label_steps(10);

        
        $g->set_width('100%');
        $g->set_height(250);

        $g->set_output_type('js');

        return $g->render();

    }

    static function graphicComented($data) {

        $bar = new bar_outline(50,'#87ADD0','#014687');
        $bar->key('Comentarios', 10);

        foreach($data as $item) {
            if(strlen($item['title'])<50) {
                $title = $item['title'];
            } else {
                $title = substr($item['title'], 0, 47).'...';
            }
            $tip = $title.'<br>Comentarios: '.$item['num'];
            $bar->add_data_tip($item['num'], $tip);
        }

        $g = new graph();
        $g->set_bg_colour('#ffffff');
        $g->set_base('/admin/libs/ofc1/');
        $g->set_swf_path('/admin/libs/ofc1/');

        $g->data_sets[] = $bar;
        $g->set_tool_tip( '#tip#' );
        $g->x_axis_colour('#002B53','#E0E0E0');
        $top = max($bar->data);
        $g->set_y_max($top);
        $g->y_label_steps(10);
        $g->y_axis_colour('#002B53','#E0E0E0');

        $g->set_width('100%');
        $g->set_height(250);

        $g->set_output_type('js');

        return $g->render();

    }

    static function graphicVoted($data) {

        $bar = new bar_outline(50,'#87ADD0','#014687');
        $bar->key('Valoración', 10);

        foreach($data as $item) {
            if(strlen($item['title'])<50) {
                $title = $item['title'];
            } else {
                $title = substr($item['title'], 0, 47).'...';
            }
            $tip = $title.'<br>Votos: '.$item['total_votes'].'<br>Valoración: '.$item['rate'];
            $bar->add_data_tip($item['rate'], $tip);
        }

        $g = new graph();
        $g->set_bg_colour('#ffffff');
        $g->set_base('/admin/libs/ofc1/');
        $g->set_swf_path('/admin/libs/ofc1/');

        $g->data_sets[] = $bar;
        $g->set_tool_tip( '#tip#' );
        $g->x_axis_colour('#002B53','#E0E0E0');
        $top = max($bar->data);
        $g->set_y_max($top);
        $g->y_label_steps(10);
        $g->y_axis_colour('#002B53','#E0E0E0');

        $g->set_width('100%');
        $g->set_height(250);

        $g->set_output_type('js');

        return $g->render();

    }

}

