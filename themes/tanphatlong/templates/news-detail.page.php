<?php
get_header(); ?>

<?php
global $post;
global $current_taxonomy;
$current_taxonomy = 'category';

$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , "size");
$image = aq_resize( $thumbnail_src[0], 900, 500 , true, true, true);
?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb_detail_page.php';?>

<section class="blog-section">
    <div class="container">

        <div class="col-md-8">
            <div class="blog-box">
                <div class="blog-post single-post">
                    <div class="post-content-text">
                        <h1><?=$post->post_title;?></h1>
                        <span><?=date('d M Y',strtotime($post->post_date))?></span>
                        <p><?=$post->post_content;?></p>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-md-4">
            <!--Include file menu-->
            <?php include_once TEMPLATEPATH . '/includes/left_menu_news.php';?>
        </div>

    </div>
</section>

<?php $news_other = get_records_news_other($post->ID);
        if(!empty($news_other)) :
?>
<!-- portfolio-section
    ================================================== -->
<section class="portfolio-section">
    <div class="container">

        <div class="portfolio-box owl-wrapper">
            <div class="owl-carousel" data-num="3">

                <?php foreach($news_other as $value) :
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