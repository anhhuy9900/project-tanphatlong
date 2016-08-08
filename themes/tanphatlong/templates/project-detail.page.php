<?php
get_header(); ?>

<?php
global $post;
?>
<!-- page-banner-section
            ================================================== -->
<section class="page-banner-section">
    <div class="container">
        <h1><?=$post->post_title;?></h1>
    </div>
</section>
<!-- End page-banner section -->

<!-- single-page section
    ================================================== -->
<section class="single-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <img src="upload/portfolio/3.jpg" alt="">

            </div>
            <div class="col-md-5">
                <div class="project-content">
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


<?php $projects_other = get_records_projects_other($post->ID);
        if(!empty($projects_other)) :
?>
<!-- portfolio-section
    ================================================== -->
<section class="portfolio-section">
    <div class="container">

        <div class="portfolio-box owl-wrapper">
            <div class="owl-carousel" data-num="3">

                <?php foreach($projects_other as $value) :
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
