<?php

if (!function_exists('get_list_records_products')) {
    function get_list_records_products($taxonomy = ''){
        global $wpdb;
        $per_page = 12;
        $paged = max(1,intval(get_query_var('paged')));
        $offset = get_query_var('paged') ? $per_page * max(0, intval(get_query_var('paged')) - 1) : 0;
        $query_params = array(
            'post_type'		    => 'product-services',
            'post_status'       => 'publish',
            'orderby'           => "post_date",
            'order'             => "DESC",
            'posts_per_page'    => $per_page,
            'offset'            => $offset,
        );

        if($taxonomy){
            $terms = get_term_by('slug', $taxonomy, 'list-menu-product-services');
            $query_params['tax_query'] = array(
                array(
                    'taxonomy' => 'list-menu-product-services',
                    'field' => 'id',
                    'terms' => $terms->term_id,
                )
            );
        }
        $wp_query = new WP_Query( $query_params );
        $results = $wp_query->have_posts() ?  $wp_query->get_posts() : '';

        $query_params = array(
            'post_type'		=> 'product-services',
            'post_status'   => 'publish'
        );
        if($taxonomy){
            $terms = get_term_by('slug', $taxonomy, 'list-menu-product-services');
            $query_params['tax_query'] = array(
                array(
                    'taxonomy' => 'list-menu-product-services',
                    'field' => 'id',
                    'terms' => $terms->term_id,
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

if (!function_exists('get_list_menu_products')) {
    function get_list_menu_products(){
        $list_menu_products = get_terms( array(
            'taxonomy' => 'list-menu-product-services',
            'hide_empty' => false,
        ) );

        foreach($list_menu_products as $cat){
            $field_order = get_term_meta( $cat->term_id, 'wpcf-field-order' , true);
            $cat->order = $field_order;
        }
        usort($list_menu_products, "cmp");

        return $list_menu_products;
    }
}


if (!function_exists('get_records_products_other')) {
    function get_records_products_other($id)
    {
        $terms = wp_get_post_terms($id, 'list-menu-product-services', array("fields" => "all"));

        $query_params = array(
            'post_type' => 'product-services',
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
                    'taxonomy' => 'list-menu-product-services',
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