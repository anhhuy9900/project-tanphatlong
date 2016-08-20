<?php
/*
Template Name: products Page
*/

get_header(); ?>

<?php 
global $taxonomy,$term;
$get_category = get_term_by('slug', $term, 'list-menu-product-services');
?>
<!-- page-banner-section
            ================================================== -->
<?=func_breadcrumb_category($get_category);?>
<!-- End page-banner section -->

<!-- services section-->
<?php
$data = get_list_records_products($term);
?>

<section class="portfolio-section">
    <div class="container">

        <?php if(!empty($data['results'])) : ?>
            <div class="portfolio-box col-md-9">
                <?php $count = 0;
                foreach($data['results'] as $key => $value) :
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 398, 239 , true, true, true);
                ?>
                <?php if($count % 2 == 0) :?>
                <div class="row">
                <?php endif;
                    $count++;
                ?>
                    <div class="project-post col-md-6">
                        <div class="project-gallery">
                            <img src="<?=$image;?>" alt="">
                            <div class="hover-box">
                                <div class="inner-hover">
                                    <h2><a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?=$value->post_title;?></a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php if($count % 2 == 0 || $count == count($data['results'])) :?>
                </div>
                <?php endif;?>

                <?php endforeach; ?>

                <?=$data['pagination'];?>

            </div>
        <?php endif;?>

        <div class="col-md-3">
            <!--Include file menu-->
            <?php include_once TEMPLATEPATH . '/includes/left_menu_product.php';?>
        </div>

    </div>
</section>

<?php get_footer(); ?>