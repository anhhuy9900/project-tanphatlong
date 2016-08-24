<?php
get_header(); ?>

<?php
global $post;
?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb_detail_page.php';?>

<!-- single-page section
    ================================================== -->
<section class="single-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7 tpl-gallery-detail">
                <?php 
                $project_galleries = get_post_meta( $post->ID, "wpcf-project-galleries");
                if(!empty($project_galleries)) :
                    $show_first_image = aq_resize( $project_galleries[0], 600, 500 , true, true, true);
                ?>
                    <image src="<?=$show_first_image;?>" class="show-first-image" />
                    <ul class="gallery-image-bxslider">
                        <?php foreach($project_galleries as $image) :
                                $image_url = aq_resize( $image, 150, 150 , true, true, true);
                                $large_image_url = aq_resize( $image, 600, 500 , true, true, true);
                        ?>
                        <li class="image-thumb-detail"><a href="javascript:;" data-url="<?=$large_image_url;?>" data-toggle="modal" data-target="#myModal"><img src="<?=$image_url?>" /></a></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>        
            </div>
            <div class="col-md-5">
                <div class="project-content">
                    <h2><?=$post->post_title;?></h2>
                    <?=$post->post_content;?>
                    <div class="project-tags">
                        <?php
                        $project_location = types_render_field( "project-location", array( "raw" => "true", "id" => $post->ID ));
                        $project_investor = types_render_field( "project-investor", array( "raw" => "true", "id" => $post->ID ));
                        $project_scale = types_render_field( "project-scale", array( "raw" => "true", "id" => $post->ID ));
                        $project_scope_of_work = types_render_field( "project-scope-of-work", array( "raw" => "true", "id" => $post->ID ));
                        $project_completion_time = types_render_field( "project-completion-time", array( "raw" => "true", "id" => $post->ID ));
                        ?>
                        <ul>
                            <li><i class="fa fa-map-marker"></i> <span><?php print __('Location','tanphatlong');?>:</span> <?=$project_location;?></li>
                            <li><i class="fa fa-user"></i> <span><?php print __('Investor','tanphatlong');?>:</span> <?=$project_investor;?></li>
                            <li><i class="fa fa-usd"></i> <span><?php print __('Project Scale','tanphatlong');?>:</span> <?=$project_scale;?></li>
                            <li><i class="fa fa-tag"></i> <span><?php print __('Scope of work','tanphatlong');?>:</span> <?=$project_scope_of_work;?></li>
                            <li><i class="fa fa-calendar"></i> <span><?php print __('Completion time','tanphatlong');?>:</span> <?=$project_completion_time;?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End single-page section -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


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
