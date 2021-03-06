<?php
/**
Template Name: Recruitment Page
 */

get_header(); ?>

<?php
/*if($post->post_name == 'tuyen-dung' || $post->post_name == 'recruitment'){
    $url = pll_current_language() == 'vi' ? 'vi-tri-tuyen-dung' : 'career-opportunities';
    wp_redirect($url);
    die();
}*/
global $post;
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
                    <?php include_once TEMPLATEPATH . '/includes/left_menu_recruitment.php';?>
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
