<?php
/*
Template Name: Gallery Company Page
*/

get_header(); ?>

<?php global $post; ?>
<!-- page-banner-section
            ================================================== -->
<section class="page-banner-section">
    <div class="container">
        <h1><?=$post->post_title;?></h1>
    </div>
</section>
<!-- End page-banner section -->

<section class="portfolio-section">
    <div class="container">
        <?php echo do_shortcode("[huge_it_gallery id='2']"); ?>
    </div>
</section>

<?php get_footer(); ?>