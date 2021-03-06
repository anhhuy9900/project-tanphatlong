<?php

if (!function_exists('get_list_records_abilities')) {
    function get_list_records_abilities()
    {
        global $wpdb;
        $per_page = 12;
        $paged = max(1, intval(get_query_var('paged')));
        $offset = get_query_var('paged') ? $per_page * max(0, intval(get_query_var('paged')) - 1) : 0;
        $query_params = array(
            'post_type' => 'abilities',
            'post_status' => 'publish',
            'orderby' => "post_date",
            'order' => "DESC",
            'posts_per_page' => $per_page,
            'offset' => $offset,
        );
        $wp_query = new WP_Query($query_params);
        $results = $wp_query->have_posts() ? $wp_query->get_posts() : '';


        $query_params = array(
            'post_type' => 'abilities',
            'post_status' => 'publish'
        );
        $wp_query = new WP_Query($query_params);
        $total_items = $wp_query->found_posts;

        $pagination = __pagination($total_items, $paged, $per_page);

        $data = array(
            'results' => $results,
            'pagination' => $pagination
        );
        return $data;
    }
}

if (!function_exists('get_list_menu_abilities')) {
    function get_list_menu_abilities()
    {
        global $wpdb;
        $query_params = array(
            'post_type' => 'abilities',
            'post_status' => 'publish',
            'orderby' => "post_date",
            'order' => "DESC",
        );
        $wp_query = new WP_Query($query_params);
        $results = $wp_query->have_posts() ? $wp_query->get_posts() : '';

        return $results;
    }
}