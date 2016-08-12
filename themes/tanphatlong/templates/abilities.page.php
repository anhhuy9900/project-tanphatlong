<?php
/*
Template Name: Abilities Page
*/

get_header(); ?>
<?php
global $post;
?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb.php';?>

    <!-- portfolio-section
        ================================================== -->
<?php $data = get_list_records_abilities(); ?>

<section class="portfolio-section">
    <div class="container">
        <?php if(!empty($data['results'])) :?>
            <div class="portfolio-box">
                <?php
                $count = 0;
                foreach($data['results'] as $key => $value) :
                    $link_view = types_render_field( "link-view-abilities", array( "raw" => "true", "id" => $value->ID ));
                    $file_download = types_render_field( "file-download-abilities", array( "raw" => "true", "id" => $value->ID ));
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 360, 300 , true, true, true);
                ?>
                <?php if($count % 3 == 0) :?>
                <div class="row">
                <?php endif;
                $count++;
                ?>

                    <div class="project-post col-md-4">
                        <div class="project-gallery">
                            <img src="<?=$image;?>" alt="">
                            <div class="hover-box">
                                <div class="inner-hover">
                                    <h2><a href="#"><?=$value->post_title;?></a></h2>
                                <span class="btn-ability">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    <a href="<?=$file_download;?>" class="btn-click"><?php print __('Download','tanphatlong');?></a>
                                </span>
                                <span class="btn-ability">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <a href="<?=$link_view;?>" target="_blank" class="btn-click"><?php print __('View','tanphatlong');?></a>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php if($count % 3 == 0 || $count == count($data['results'])) :?>
                </div>
                <?php endif;?>

                <?php endforeach; ?>

                <?=$data['pagination'];?>

            </div>

        <?php endif;?>

    </div>
</section>
<!-- End portfolio section -->

<?php get_footer(); ?>