<?php
if (!function_exists('get_list_records_recruitment')) {
    function get_list_records_recruitment(){
        $query_params = array(
            'post_type'		    => 'manage-recruitment',
            'post_status'       => 'publish',
            'orderby'           => "post_date",
            'order'             => "DESC"
        );
        $wp_query = new WP_Query( $query_params );
        $results = $wp_query->have_posts() ?  $wp_query->get_posts() : '';

        $data = array(
            'results' => $results
        );
        return $data;
    }
}