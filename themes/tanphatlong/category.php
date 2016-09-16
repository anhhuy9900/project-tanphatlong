
<?php get_header(); ?>

<?php
$data = get_list_records_news();
$cat = get_category( get_query_var( 'cat' ) );
?>

<!-- page-banner-section
            ================================================== -->
<?=func_breadcrumb_category($cat);?>
<!-- End page-banner section -->

<section class="blog-section">
    <div class="container">

        <div class="col-md-8">
            <?php if(!empty($data['results'])) : ?>
                <div class="blog-box">
                    <?php $count = 0;
                    foreach($data['results'] as $key => $value) :
                        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                        $image = aq_resize( $thumbnail_src[0], 600, 500 , true, true, true);
                        $description = types_render_field( "short-description", array( "raw" => "true", "id" => $value->ID ));
                    ?>

                        <div class="blog-post">
                            <img src="<?=$image;?>" alt="" class="images">
                            <div class="post-content-text">
                                <h2><a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?=$value->post_title;?></a></h2>
                                <span><?=date('d M Y',strtotime($value->post_date))?></span>
                                <p><?=$description;?></p>
                                <a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?php print __('Read More','tanphatlong');?> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>

                    <?php endforeach; ?>

                    <?=$data['pagination'];?>

                </div>
            <?php endif;?>

        </div>

        <div class="col-md-4">
            <!--Include file menu-->
            <?php include_once TEMPLATEPATH . '/includes/left_menu_news.php';?>
        </div>

    </div>
</section>

<?php get_footer(); ?>

