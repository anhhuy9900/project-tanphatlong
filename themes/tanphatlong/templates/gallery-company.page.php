<?php
/*
Template Name: Gallery Company Page
*/

get_header(); ?>

<?php global $post; ?>

    <!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb.php';?>

<section class="portfolio-section">
    <div class="container">
        <?php echo do_shortcode("[huge_it_gallery id='2']"); ?>
    </div>
</section>

<?php get_footer(); ?>