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
require_once("functions/aq_resizer.php");
require_once("functions/common.func.php");
require_once("functions/home.func.php");
require_once("functions/abilities.func.php");
require_once("functions/recruitment.func.php");
require_once("functions/projects.func.php");
require_once("functions/news.func.php");
require_once("functions/products.func.php");
require_once("functions/search.func.php");
require_once("functions/contact.func.php");



/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
define( 'THEME_URL', get_stylesheet_directory() );


//fix redirect link when click pagination in wordpress
remove_action('template_redirect', 'redirect_canonical');


function project_scripts(){

    wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css', array());
    wp_enqueue_style( 'jquery.bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css', array());
    wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css', array());
    wp_enqueue_style( 'owl.theme', get_template_directory_uri() . '/css/owl.theme.css', array());
    wp_enqueue_style( 'ont-awesome', get_template_directory_uri() . '/css/ont-awesome.css', array());
    wp_enqueue_style( 'settings', get_template_directory_uri() . '/css/settings.css', array());
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', array());


    wp_enqueue_script( 'jquery.min', get_template_directory_uri() . '/js/jquery.min.js', array( 'jquery' ), '20131205');
    wp_enqueue_script( 'jquery.migrate', get_template_directory_uri() . '/js/jquery.migrate.js', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'jquery.bxslider.min', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'owl.carousel.min', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'jquery.imagesloaded.min', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'retina-1.1.0.min', get_template_directory_uri() . '/js/retina-1.1.0.min.js', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'jquery.themepunch.tools.min', get_template_directory_uri() . '/js/jquery.themepunch.tools.min.js', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'jquery.themepunch.revolution.min', get_template_directory_uri() . '/js/jquery.themepunch.revolution.min.js', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'gmap3', get_template_directory_uri() . '/js/gmap3.min.js', array( 'jquery' ), '20131205', true);
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20131205', true);

}
add_action( 'wp_enqueue_scripts', 'project_scripts' );

//fix redirect link when click pagination in wordpress
remove_action('template_redirect', 'redirect_canonical');


//add rule rewrite url
add_action('init', 'custom_rewrite_rule', 10, 0);
function custom_rewrite_rule() {

    flush_rewrite_rules();
}

function add_my_var($public_query_vars) {
    //$public_query_vars[] = 'category-product';
    return $public_query_vars;
}
add_filter('query_vars', 'add_my_var');


function prefix_url_rewrite_templates() {

}
add_action( 'template_redirect', 'prefix_url_rewrite_templates' );

//require files widget function
require_once("widgets/map.widget.php");

// Register and load the widget
function wpb_load_widget() {
    register_widget( 'tpl_map_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

function pnjexport_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Slogan Home', 'tanphatlong' ),
        'id'            => 'slogan-home',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'tanphatlong' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'About Home Page', 'tanphatlong' ),
        'id'            => 'about-home-page',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'tanphatlong' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Logo Site', 'tanphatlong' ),
        'id'            => 'logo-site',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'tanphatlong' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Map Contact', 'tanphatlong' ),
        'id'            => 'map-contact',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'tanphatlong' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );


}
add_action( 'widgets_init', 'pnjexport_widgets_init' );

function template_chooser($template)
{
    global $wp_query;
    $post_type = get_query_var('post_type');
    if( isset($_GET['keyword']))
    {
        return locate_template('search.php');  //  redirect to archive-search.php
    }
    return $template;
}
add_filter('template_include', 'template_chooser');


if (!function_exists('_get_widget_data_for')) {
    function _get_widget_data_for($sidebar_name, $language = 'vi') {
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
            $widget_object = (object) $widget_data[$key];

            if($language){
                if($widget_object->pll_lang == $language){
                    $output[] = $widget_object;
                }
            } else{
                $output[] = $widget_object;
            }


        }

        return count($output) > 1 ? $output : $output[0];
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

if(!function_exists('_func_get_posts_type')){
    function _func_get_posts_type($args = array())
    {
        $query_params = array(
            'post_status' => 'publish',
            'orderby' => "post_date",
            'order' => "DESC"
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
            if(count($result) > 1){
                return $result;
            } else{
                return $result[0];
            }

        }
        return NULL;
    }
}

