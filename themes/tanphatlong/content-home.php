

<?php $widget_slogan_home = _get_widget_data_for('Slogan Home', pll_current_language());?>
<!-- banner-section
    ================================================== -->
<section class="banner-section">
    <div class="container">
        <h2><?=(!empty($widget_slogan_home)) ? $widget_slogan_home->text : '';?> </h2>
    </div>
</section>
<!-- End banner section -->


<!-- portfolio-section
    ================================================== -->
<?php
$projects_highlight = get_list_records_highlight_home(array('post_type'=>'manage-projects'));
    if(!empty($projects_highlight)) :
?>
<section class="portfolio-section">
    <div class="container">
        <div class="portfolio-box owl-wrapper">
            <div class="owl-carousel" data-num="4">
                <?php foreach($projects_highlight as $project) :
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 600, 500 , true, true, true);
                ?>
                <div class="item project-post">
                    <div class="project-gallery">
                        <img src="<?=$image;?>" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="<?php echo esc_url( get_permalink($project->ID) ); ?>"><?=$project->post_title;?></a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>

    </div>
</section>
<?php endif; ?>
<!-- End portfolio section -->


<?php
$widget_about_home = _get_widget_data_for('About Home Page', pll_current_language());
$pages_highlight = get_list_pages_highlight_home();
        if(!empty($pages_highlight)) :
?>
<!-- tabs-section
    ================================================== -->
<section class="tabs-section">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="about-us-box">
                    <h1><?=(!empty($widget_about_home)) ? $widget_about_home->title : '';?></h1>
                    <p><?=(!empty($widget_about_home)) ? $widget_about_home->text : '';?></p>
                    <div class="row">
                    <?php
                    $count = 0;
                    foreach($pages_highlight as $page) :
                        $description = types_render_field( "short-description", array( "raw" => "true", "id" => $page->ID ));
                    ?>
                    <?php if($count % 3 == 0) :?>
                    <div class="col-md-5">
                    <?php endif;
                        $count++;
                    ?>
                        <div class="about-us-post">
                            <a href="<?php echo esc_url( get_permalink($page->ID) ); ?>"><i class="fa fa-building-o"></i></a>
                            <h2><?=$page->post_title;?></h2>
                            <span><?=$description;?></span>
                        </div>
                    <?php if($count % 3 == 0 || $count == count($pages_highlight)) :?>
                    </div>
                    <?php endif;?>

                    <?php endforeach;?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End tabs section -->
<?php endif; ?>


<!-- news-section
    ================================================== -->
<?php
$news_highlight = get_list_records_highlight_home(array('post_type'=>'post'));
    if(!empty($news_highlight)) :
?>
<section class="news-section">
    <div class="container">

        <div class="news-box owl-wrapper">
            <div class="owl-carousel" data-num="4">
                <?php foreach($news_highlight as $news) :
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $news->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 400, 280 , true, true, true);
                    $description = types_render_field( "short-description", array( "raw" => "true", "id" => $news->ID ));
                ?>
                <div class="item news-post">
                    <div class="news-gallery">
                        <img src="<?=$image;?>" alt="">
                        <div class="date-post">
                            <p><?=date('m',strtotime($news->post_date))?> <span><?=date('d',strtotime($news->post_date))?></span></p>
                        </div>
                    </div>
                    <div class="news-content">
                        <h2><a href="<?php echo esc_url( get_permalink($news->ID) ); ?>" title="<?=$news->post_name;?>"><?=$news->post_title;?></a></h2>
                        <p><?=$description;?></p>
                        <a href="<?php echo esc_url( get_permalink($news->ID) ); ?>" title="<?=$news->post_name;?>"><?php print __('Read More','tanphatlong');?><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>

    </div>
</section>
 <?php endif; ?>
<!-- End news section -->

<!-- testimonial-section
    ================================================== -->
<?php
$personnel_highlight = get_list_records_highlight_home(array('post_type'=>'quan-ly-ban-nhan-su'), 0);
    if(!empty($personnel_highlight)) :
?>
<section class="testimonial-section">
    <div class="container">
        <div class="testimonial-box">
            <ul class="bxslider">
            <?php foreach($personnel_highlight as $personnel) :
                $personnel_name = types_render_field( "ten-nhan-su", array( "raw" => "true", "id" => $personnel->ID ));
                $position = types_render_field( "chuc-vu", array( "raw" => "true", "id" => $personnel->ID ));
                $description = types_render_field( "mo-ta-nhan-su", array( "raw" => "true", "id" => $personnel->ID ));
            ?>
                <li>
                    <h2><?=$personnel_name;?></h2>
                    <span><?=$position;?></span>
                    <p><?=$description;?></p>
                </li>
            <?php endforeach;?>
            </ul>
        </div>

    </div>
</section>
<?php endif; ?>
<!-- End testimonial section -->


<!-- portfolio-section
    ================================================== -->
<?php
$clients_highlight = get_list_records_highlight_home(array('post_type'=>'manage-clients'), 0);
    if(!empty($clients_highlight)) :
?>
<section class="portfolio-section">
    <div class="container">
        <div class="portfolio-box owl-wrapper">
            <div class="owl-carousel" data-num="4">
                <?php foreach($clients_highlight as $client) :
                    $attachments = _func_get_value_custom_field('wpcf-client-image', $client->ID);
                    $image = aq_resize( $attachments, 177, 177 , true, true, true);
                ?>
                    <div class="item project-post">
                        <div class="project-gallery">
                            <img src="<?=$image;?>" alt="">

                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>

    </div>
</section>
<?php endif; ?>
<!-- End portfolio section -->