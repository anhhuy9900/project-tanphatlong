<?php
if(!function_exists('func_search_results')){
    function func_search_results()
    {
        global $wpdb;
        $results = array();
        $pagination = '';
        if(!empty($_GET['keyword'])){
            $key = $wpdb->esc_like($_GET['keyword']);
            //$keyword = '%' . $key . '%';

            $lang = _security_string($_GET['lang']);
            $per_page = 12;
            $paged = max(1,intval(get_query_var('page')));
            $offset = get_query_var('page') ? $per_page * max(0, intval(get_query_var('page')) - 1) : 0;

            $query_params = array(
                'lang'              => $lang,
                's'                 => $key,
                'post_type'         => array('post', 'manage-projects', 'product-services'),
                'post_status'       => 'publish',
                'orderby'           => "post_date",
                'order'             => "DESC",
                'posts_per_page'    => $per_page,
                'offset'            => $offset,
            );
            $wp_query = new WP_Query( $query_params );
            $results = $wp_query->have_posts() ?  $wp_query->get_posts() : '';

            $query_params = array(
                'lang'              => $lang,
                's'                 => $key,
                'post_type'         => array('post', 'manage-projects', 'product-services'),
                'post_status'       => 'publish'
            );
            $wp_query = new WP_Query( $query_params );
            $total_items = $wp_query->found_posts;

            $pagination  = __pagination($total_items, $paged, $per_page);
        }
        
        $data = array(
            'results' => $results,
            'pagination' => $pagination,
        );
        return $data;
    }
}