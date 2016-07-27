<?php

add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

function init_sessions() {
    if (!session_id()) {
        session_start();
    }
}

function func_init() {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: false");
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Allow-Methods: POST');

    header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"');
    header('Set-Cookie: SIDNAME=ronty; path=/; secure');
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
    init_sessions();
    $_GET = stripslashes_deep( $_GET );
    $_POST = stripslashes_deep( $_POST );
    $_REQUEST = stripslashes_deep( $_REQUEST );
}
add_action('init', 'func_init');


function _func_seo_meta_tags() {
    global $post;

    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
        } else {
            $img_src = get_stylesheet_directory_uri() . '/img/opengraph_image.jpg';
        }
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>

        <meta property="og:title" content="<?php echo the_title(); ?>"/>
        <meta property="og:description" content="<?php echo $excerpt; ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
        <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
        <meta property="og:image" content="<?php echo $img_src; ?>"/>

        <?php
    } else {
        return;
    }
}
add_action('wp_head', '_func_seo_meta_tags', 1);


//require files function
require_once("functions/common.func.php");
require_once("functions/aq_resizer.php");


/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
define( 'THEME_URL', get_stylesheet_directory() );


//fix redirect link when click pagination in wordpress
remove_action('template_redirect', 'redirect_canonical');


//add rule rewrite url
add_action('init', 'custom_rewrite_rule', 10, 0);
function custom_rewrite_rule() {


    /*$page_collections_landing = get_page_by_path( 'collection' );
    if($page_collections_landing){
        add_rewrite_rule('^collection/([^/]*)?', 'index.php?page_id='.$page_collections_landing->ID.'&collections-type=$matches[1]', 'top');
    }

    add_rewrite_rule( 'news/([^/]*)?', 'index.php?news_detail_slug=$matches[1]', 'top' );*/

    flush_rewrite_rules();
}

function add_my_var($public_query_vars) {
   // $public_query_vars[] = 'category-product';
    return $public_query_vars;
}

add_filter('query_vars', 'add_my_var');


function prefix_url_rewrite_templates() {

    if ( get_query_var( 'news_detail_slug' ) ) {
        add_filter( 'template_include', function() {
            return get_template_directory() . '/single-news.php';
        });
    }
}

add_action( 'template_redirect', 'prefix_url_rewrite_templates' );


function pnjexport_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Widget Area', 'pnjexport' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'pnjexport' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Image Upload Widget', 'pnjexport' ),
        'id'            => 'widget-banner',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'pnjexport' ),
        'before_widget' => false,
        'after_widget'  => false,
        'before_title'  => false,
        'after_title'   => false,
    ) );

    register_sidebar( array(
        'name'          => __( 'Banner Of About Home Page', 'pnjexport' ),
        'id'            => 'widget-banner-of-about-home-page',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'pnjexport' ),
        'before_widget' => false,
        'after_widget'  => false,
        'before_title'  => false,
        'after_title'   => false,
    ) );

    register_sidebar( array(
        'name'          => __( 'Banner Collections Page', 'pnjexport' ),
        'id'            => 'widget-banner-collections-page',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'pnjexport' ),
        'before_widget' => false,
        'after_widget'  => false,
        'before_title'  => false,
        'after_title'   => false,
    ) );

    register_sidebar( array(
        'name'          => __( 'List Images Promotion News Right', 'pnjexport' ),
        'id'            => 'widget-images-promotion-news',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'pnjexport' ),
        'before_widget' => false,
        'after_widget'  => false,
        'before_title'  => false,
        'after_title'   => false,
    ) );

    register_sidebar( array(
        'name'          => __( 'Banner Product Page', 'pnjexport' ),
        'id'            => 'widget-banner-product-page',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'pnjexport' ),
        'before_widget' => false,
        'after_widget'  => false,
        'before_title'  => false,
        'after_title'   => false,
    ) );
}
add_action( 'widgets_init', 'pnjexport_widgets_init' );



if (!function_exists('_get_widget_data_for')) {
    function _get_widget_data_for($sidebar_name) {
        global $wp_registered_sidebars, $wp_registered_widgets;

        // Holds the final data to return
        $output = array();

        // Loop over all of the registered sidebars looking for the one with the same name as $sidebar_name
        $sibebar_id = false;
        foreach( $wp_registered_sidebars as $sidebar ) {
            if( $sidebar['name'] == $sidebar_name ) {
                // We now have the Sidebar ID, we can stop our loop and continue.
                $sidebar_id = $sidebar['id'];
                break;
            }
        }

        if( !$sidebar_id ) {
            // There is no sidebar registered with the name provided.
            return $output;
        }

        // A nested array in the format $sidebar_id => array( 'widget_id-1', 'widget_id-2' ... );
        $sidebars_widgets = wp_get_sidebars_widgets();
        $widget_ids = $sidebars_widgets[$sidebar_id];

        if( !$widget_ids ) {
            // Without proper widget_ids we can't continue.
            return array();
        }

        // Loop over each widget_id so we can fetch the data out of the wp_options table.
        foreach( $widget_ids as $id ) {
            // The name of the option in the database is the name of the widget class.
            $option_name = $wp_registered_widgets[$id]['callback'][0]->option_name;

            // Widget data is stored as an associative array. To get the right data we need to get the right key which is stored in $wp_registered_widgets
            $key = $wp_registered_widgets[$id]['params'][0]['number'];

            $widget_data = get_option($option_name);

            // Add the widget data on to the end of the output array.
            $output[] = (object) $widget_data[$key];
        }

        return $output;
    }
}

if (!function_exists('_func_get_post_type')) {
    function _func_get_post_type($type = ''){
        $wp_query = null;
        $wp_query = new WP_Query();
        $wp_query->query(array('post_type' => $type,'orderby' => "post_date",'order' => "desc"));
        $result = $wp_query->have_posts() ?  $wp_query->get_posts() : '';
        return $result;
    }
}

if (!function_exists('_filter_element_array_widget')) {
    function _filter_element_array_widget($array_widget = array(), $element = ''){
        $arr_data = NULL;
        if(!empty($array_widget)){
            foreach ($array_widget as $key => $value) {
                if($value->name == $element){
                    $arr_data = $value;
                    break;
                }
            }
        }

        return $arr_data;
    }
}

if(!function_exists('_func_get_all_posts')){
    function _func_get_all_posts($args = array(), $limit = 1, $type =  'row')
    {
        $query_params = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'orderby' => "post_date",
            'order' => "desc"
        );
        if(!empty($args)){
            foreach($args as $key => $value){
                $query_params[$key] = $value;
            }
        }
        $query = new WP_Query($query_params);
        return $query->get_posts() ? $query->get_posts() : array();
    }
}

if(!function_exists('_func_get_value_custom_field')){
    function _func_get_value_custom_field($key_field = '', $post_id = 0)
    {
        $result = get_post_custom_values($key_field, $post_id);
        if(!empty($result)){
            return $result[0];
        }
        return NULL;
    }
}

if(!function_exists('_func_get_menu_products_footer')) {
    function _func_get_menu_products_footer()
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT id,name,slug FROM categories WHERE parent_id = 0 AND status = 1 ORDER BY `order` ASC");
        return $result;
    }
}

if(!function_exists('_func_get_menu_collections_footer')) {
    function _func_get_menu_collections_footer()
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM collections WHERE status = 1 ORDER BY `order` ASC");
        return $result;
    }
}

