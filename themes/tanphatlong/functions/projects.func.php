<?php

if (!function_exists('get_list_records_projects')) {
    function get_list_records_projects(){
        global $wpdb;
        $per_page = 3;
        $paged = max(1,intval(get_query_var('page')));
        $offset = get_query_var('page') ? $per_page * max(0, intval(get_query_var('page')) - 1) : 0;
        $query_params = array(
            'post_type'		    => 'manage-projects',
            'post_status'       => 'publish',
            'orderby'           => "post_date",
            'order'             => "DESC",
            'posts_per_page'    => $per_page,
            'offset'            => $offset,
        );
        $wp_query = new WP_Query( $query_params );
        $results = $wp_query->have_posts() ?  $wp_query->get_posts() : '';


        $query_params = array(
            'post_type'		=> 'manage-projects',
            'post_status'   => 'publish'
        );
        $wp_query = new WP_Query( $query_params );
        $total_items = $wp_query->found_posts;

        $pagination  = __pagination($total_items, $paged, $per_page);

        $data = array(
            'results' => $results,
            'pagination' => $pagination
        );
        return $data;
    }
}

if (!function_exists('get_list_menu_projects')) {
    function get_list_menu_projects(){
        $list_menu_projects = get_terms( array(
            'taxonomy' => 'manage-menu-projects',
            'hide_empty' => false,
        ) );

        return $list_menu_projects;
    }
}