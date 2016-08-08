<<<<<<< HEAD
<?php

if (!function_exists('get_list_records_projects')) {
    function get_list_records_projects($taxonomy = ''){
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

        if($taxonomy){
            $terms = get_term_by('slug', $taxonomy, 'manage-menu-projects');
            $query_params['tax_query'] = array(
                array(
                    'taxonomy' => 'manage-menu-projects',
                    'field' => 'id',
                    'terms' => $terms->term_id,
                )
            );
        }
        $wp_query = new WP_Query( $query_params );
        $results = $wp_query->have_posts() ?  $wp_query->get_posts() : '';


        $query_params = array(
            'post_type'		=> 'manage-projects',
            'post_status'   => 'publish'
        );
        if($taxonomy){
            $terms = get_term_by('slug', $taxonomy, 'manage-menu-projects');
            $query_params['tax_query'] = array(
                array(
                    'taxonomy' => 'manage-menu-projects',
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

if (!function_exists('get_list_menu_projects')) {
    function get_list_menu_projects(){
        $list_menu_projects = get_terms( array(
            'taxonomy' => 'manage-menu-projects',
            'hide_empty' => false,
        ) );

        return $list_menu_projects;
    }
}


if (!function_exists('get_records_projects_other')) {
    function get_records_projects_other($id){
        $terms = wp_get_post_terms($id, 'manage-menu-projects', array("fields" => "all"));

        $query_params = array(
            'post_type'		    => 'manage-projects',
            'post_status'       => 'publish',
            'orderby'           => "post_date",
            'order'             => "DESC",
            'posts_per_page'    => 10,
            'post__not_in'      => array($id),
        );

        if($terms){
            $arr_terms = array();
            foreach($terms as $value){
                $arr_terms[] = $value->term_id;
            }
            $query_params['tax_query'] = array(
                array(
                    'taxonomy' => 'manage-menu-projects',
                    'field' => 'id',
                    'terms' => $arr_terms,
                )
            );
        }
        $wp_query = new WP_Query( $query_params );
        $results = $wp_query->have_posts() ?  $wp_query->get_posts() : '';

        return $results;
    }
=======
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
>>>>>>> 5e8b738e7437d36ce4598d8138e1f61019b3a423
}