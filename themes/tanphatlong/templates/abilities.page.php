<?php
/*
Template Name: Abilities Page
*/

get_header(); ?>
<?php
global $post;
if($post->post_name == 'nang-luc' || $post->post_name == 'abilities-page'){
    $slug = pll_current_language() == 'vi' ? 'giay-chung-nhan' : 'certificate';
    $page_redirect = get_posts( array(
        'name' => $slug,
        'post_type' => 'abilities',
        'post_status' => 'publish',
        'posts_per_page' => 1
    ));
    $url = get_site_url().'/'.pll_current_language().'/abilities/'.$slug;
    wp_redirect($url);
    die();
}
?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb.php';?>

    <!-- portfolio-section
        ================================================== -->

<section class="services-section">
    <div class="container">
        <div class="services-box">
            <div class="row">
                <div class="col-md-3">
                    <!--Include file menu-->
                    <?php include_once TEMPLATEPATH . '/includes/left_menu_abilities.php';?>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="services-post">
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                <h2><?php the_title();?></h2>
                                <?php the_content(); ?>
                            <?php endwhile; else: ?>
                                <p><?=pll_e('Sorry, no posts matched your criteria.');?></p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End portfolio section -->

<?php get_footer(); ?>