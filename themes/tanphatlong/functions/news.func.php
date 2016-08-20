<?php

if (!function_exists('get_list_records_news')) {
    function get_list_records_news(){
        global $wpdb;
        $per_page = 4;
        $paged = max(1,intval(get_query_var('paged')));
        $offset = get_query_var('paged') ? $per_page * max(0, intval(get_query_var('paged')) - 1) : 0;
        $query_params = array(
            'post_type'		    => 'post',
            'post_status'       => 'publish',
            'orderby'           => "post_date",
            'order'             => "DESC",
            'posts_per_page'    => $per_page,
            'offset'            => $offset,
        );
        $cat = get_category( get_query_var( 'cat' ) );
        if(!empty($cat->term_id)){
            $query_params['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $cat->term_id,
                )
            );
        }
        $wp_query = new WP_Query( $query_params );
        $results = $wp_query->have_posts() ?  $wp_query->get_posts() : '';


        $query_params = array(
            'post_type'		=> 'post',
            'post_status'   => 'publish'
        );
        if(!empty($cat->term_id)){
            $query_params['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $cat->term_id,
                )
            );
        }
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

if (!function_exists('get_list_menu_news')) {
    function get_list_menu_news(){
        $list_menu_news = $categories = get_categories( array(
            'orderby' => 'post_date',
            'parent'  => 0
        ) );
        return $list_menu_news;
    }
}

if (!function_exists('get_records_news_other')) {
    function get_records_news_other($id)
    {
        $terms = wp_get_post_terms($id, 'category', array("fields" => "all"));

        $query_params = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'orderby' => "post_date",
            'order' => "DESC",
            'posts_per_page' => 10,
            'post__not_in' => array($id),
        );

        if ($terms) {
            $arr_terms = array();
            foreach ($terms as $value) {
                $arr_terms[] = $value->term_id;
            }
            $query_params['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $arr_terms,
                )
            );
        }
        $wp_query = new WP_Query($query_params);
        $results = $wp_query->have_posts() ? $wp_query->get_posts() : '';

        return $results;
    }
}