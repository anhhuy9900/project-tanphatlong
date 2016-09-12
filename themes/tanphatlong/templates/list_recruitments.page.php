<?php
/*
Template Name: List Recruitments Page
*/

get_header(); ?>

<?php global $post; ?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb.php';?>

<!-- portfolio-section
    ================================================== -->
<?php $data = get_list_records_recruitment(); ?>

<section class="portfolio-section">
    <div class="container">
        <div class="col-md-3">
            <!--Include file menu-->
            <?php include_once TEMPLATEPATH . '/includes/left_menu_recruitment.php';?>
        </div>
        <div class="col-md-8">
            <?php if(!empty($data['results'])) : ?>
            <div class="portfolio-box">
                <?php $count = 0;
                foreach($data['results'] as $key => $value) :
                    $description = types_render_field( "description-recruitment", array( "raw" => "true", "id" => $value->ID ));
                    $link_view = types_render_field( "link-view-recruitment", array( "raw" => "true", "id" => $value->ID ));
                    $file_download = types_render_field( "file-download-recruitment", array( "raw" => "true", "id" => $value->ID ));
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 227, 128 , true, true, true);
                ?>

                <div class="list-recruitments clearfix">
                    <div class="col-md-4">
                        <a href="<?php echo esc_url( get_permalink($value->ID) ); ?>" title="<?=$value->post_title;?>"><img src="<?=$image;?>" alt=""></a>
                    </div>
                    <div class="col-md-8">
                        <h2><a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?=$value->post_title;?></a></h2>
                        <span><?=date('d M Y',strtotime($value->post_date))?></span>
                        <p><?=$description;?></p>
                        <a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?php print __('Read More','tanphatlong');?> <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        <?php endif;?>
        </div>
    </div>
</section>
<!-- End portfolio section -->

<?php get_footer(); ?>