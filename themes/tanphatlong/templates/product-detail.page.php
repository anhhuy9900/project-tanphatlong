<?php
get_header(); ?>

<?php
global $post;
global $current_taxonomy;
$current_taxonomy = 'list-menu-product-services';
?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb_detail_page.php';?>

<!-- single-page section
    ================================================== -->
<section class="single-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <?php
                $product_galleries = get_post_meta( $post->ID, "wpcf-product-galleries");
                if(!empty($product_galleries)) :
                    $show_first_image = aq_resize( $product_galleries[0], 600, 500 , true, true, true);
                    ?>
                    <div class="show-first-image">
                        <?php foreach($product_galleries as $image) :
                            $large_image_url = aq_resize( $image, 600, 500 , true, true, true);
                            ?>
                            <a href="javascript:;" /><image src="<?=$large_image_url;?>" alt=""/></a>
                        <?php endforeach;?>

                    </div>
                    <ul class="gallery-image-bxslider">
                        <?php foreach($product_galleries as $index => $image) :
                            $image_url = aq_resize( $image, 150, 150 , true, true, true);
                            $large_image_url = aq_resize( $image, 600, 500 , true, true, true);
                            ?>
                            <li class="image-thumb-detail" data-index="<?=$index;?>"><a href="javascript:;" data-url="<?=$large_image_url;?>" data-toggle="modal" data-target="#popup_project_gallary"><img src="<?=$image_url?>" /></a></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
            </div>
            <div class="col-md-5">
                <div class="project-content">
                    <h2><?=$post->post_title;?></h2>
                    <?=$post->post_content;?>
                    <div class="project-tags">
                        <ul>
                            <li><i class="fa fa-calendar"></i> <span>Date:</span> <?=date('Y.m.D',strtotime($post->post_date))?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End single-page section -->


<?php $products_other = get_records_products_other($post->ID);
        if(!empty($products_other)) :
?>
<!-- portfolio-section
    ================================================== -->
<section class="portfolio-section">
    <div class="container">

        <div class="portfolio-box owl-wrapper">
            <div class="owl-carousel" data-num="3">

                <?php foreach($products_other as $value) :
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 600, 500 , true, true, true);
                ?>
                    <div class="item project-post">
                        <div class="project-gallery">
                            <img src="<?=$image;?>" alt="">
                            <div class="hover-box">
                                <div class="inner-hover">
                                    <h2><a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?=$value->post_title;?></a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>
        </div>

    </div>
</section>
<!-- End portfolio section -->

<?php endif;?>


<?php get_footer(); ?>
