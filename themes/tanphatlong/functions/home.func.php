<?php
if (!function_exists('get_list_pages_highlight_home')) {
    function get_list_pages_highlight_home(){
        $args = array(
            'post_type'		=> 'page',
            'posts_per_page' => 4,
            'meta_query'	=> array(
                array(
                    'key'		=> 'wpcf-show-home-page',
                    'value'		=> '1',
                    'compare'	=> '='
                )
            )
        );
        $wp_query = new WP_Query( $args );
        $result = $wp_query->have_posts() ?  $wp_query->get_posts() : '';
        return $result;
    }
}

if (!function_exists('get_list_records_highlight_home')) {
    function get_list_records_highlight_home($args, $meta_query_status = 1){
        if($meta_query_status){
            $meta_query = array(
                array(
                    'key'		=> 'wpcf-show-home-page',
                    'value'		=> '1',
                    'compare'	=> '='
                )
            );
        }

        $query_params = array(
            'post_status'   => 'publish',
            'orderby'       => "post_date",
            'order'         => "DESC",
            'meta_query'	=> $meta_query
        );
        if(!empty($args)){
            foreach($args as $key => $value){
                $query_params[$key] = $value;
            }
        }
        $wp_query = new WP_Query( $query_params );
        $result = $wp_query->have_posts() ?  $wp_query->get_posts() : '';
        return $result;
    }
}