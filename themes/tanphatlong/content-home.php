<!-- home-section-->
<section id="home-section" class="slider1">

    <!--
    #################################
        - THEMEPUNCH BANNER -
    #################################
    -->
    <div class="tp-banner-container">
        <div class="tp-banner" >
            <?php $list_banners = _func_get_posts_type(array('post_type' => 'manage-banners'));
            if(!empty($list_banners)) :
                ?>
                <ul>	<!-- SLIDE  -->
                    <?php foreach($list_banners as $banner) :
                        $attachments = _func_get_value_custom_field('wpcf-banner-image', $banner->ID);
                        $image = aq_resize( $attachments, 1440, 480 , true, true, true);
                        $link_banner = types_render_field( "link-banner", array( "raw" => "true", "id" => $banner->ID ));
                        $banner_summary = types_render_field( "banner-summary", array( "raw" => "true", "id" => $banner->ID ));
                        ?>
                        <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on"  data-title="<?=$banner->post_title;?>" onclick="redirect_link('<?=$link_banner ? $link_banner : '#';?>');">

                                <!-- MAIN IMAGE -->
                                <img src="<?=$image;?>" alt="<?=$banner->post_title;?>" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <!-- LAYERS -->

                                <!-- LAYER NR. 1 -->
                            <div class="slide-text-box">
                                <a href="http://sigma.net.vn/en/maintenance-services/" target="_parent" class="title-box"><?=$banner->post_title;?></a>
                                <div class="summary">
                                    <p><?=$banner_summary;?></p>
                                    <a href="<?=$link_banner;?>" target="_parent" class="slidde-view-more"><?php print __('Read More','tanphatlong');?>...</a>

                                </div>
                            </div>
                        </li>
                    <?php endforeach;?>
                </ul>
                <div class="tp-bannertimer"></div>
            <?php endif;?>
        </div>
    </div>
</section>
<!-- End home section -->

<?php $widget_slogan_home = _get_widget_data_for('Slogan Home', pll_current_language());?>
<!-- banner-section
    ================================================== -->
<section class="banner-section">
    <div class="container">
        <h2><?=(!empty($widget_slogan_home)) ? $widget_slogan_home->text : '';?> </h2>
    </div>
</section>
<!-- End banner section -->

<?php
$list_products = get_list_products_home_page();
    if(!empty($list_products)) :
?>
<!-- services-products ================================================== -->
<section class="services-section">
    <div class="container">
        <div class="services-box">
            <div class="row">
                <?php foreach($list_products as $value) :
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 263, 158 , true, true, true);
                    $product_description = types_render_field( "product-description", array( "raw" => "true", "id" => $value->ID ));
                    ?>
                <div class="col-md-3">
                    <div class="services-post">
                        <a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><img src="<?=$image;?>" alt=""></a>
                        <div class="services-content">
                            <h2><a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?=$value->post_title;?></a></h2>
                            <p><?=$product_description;?></p>
                            <a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?php print __('Read More','tanphatlong');?> <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>
<!-- End services section -->
<?php endif;?>


<?php
$widget_about_home = _get_widget_data_for('About Home Page', pll_current_language());
$widget_about_content_left = _get_widget_data_for('About Content Left Home Page', pll_current_language());
$widget_img_about_content_left = _get_widget_data_for('About Content Left Home Page', '');
$img_about_left_url = '';
if(!empty($widget_img_about_content_left)){
    $img_about_left_url = $widget_img_about_content_left->imageurl;
}

$pages_highlight = get_list_pages_highlight_home();
        if(!empty($pages_highlight)) :
?>
<!-- tabs-section
    ================================================== -->
<section class="tabs-section">
    <div class="container">
        <div class="row">

            <div class="col-md-7">
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
                    <div class="col-md-6">
                    <?php endif;
                        $count++;
                    ?>
                        <div class="about-us-post">
                            <a href="<?php echo esc_url( get_permalink($page->ID) ); ?>" class="icon-link"><i class="fa <?=$page->post_name =='nhan-su-chu-chot' || $page->post_name =='key-personnel' ? 'fa-users' : 'fa-building-o';?>"></i></a>
                            <h2><a href="<?php echo esc_url( get_permalink($page->ID) ); ?>"><?=$page->post_title;?></a></h2>
                            <span><?=$description;?></span>
                        </div>
                    <?php if($count % 3 == 0 || $count == count($pages_highlight)) :?>
                    </div>
                    <?php endif;?>

                    <?php endforeach;?>
                    </div>
                </div>
            </div>
            <div class="col-md-5">

                <div class="about-box">
                    <img src="<?=$img_about_left_url;?>" alt="">
                    <h2><?=$widget_about_content_left->title;?></h2>
                    <p><?=$widget_about_content_left->text;?></p>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End tabs section -->
<?php endif; ?>


<!-- projects-highlight
    ================================================== -->
<?php
$projects_highlight = get_list_records_highlight_home(array('post_type'=>'manage-projects'));
if(!empty($projects_highlight)) :
?>
    <section class="portfolio-section">
        <div class="container">
            <h3><?php print __('Projects Highlight','tanphatlong');?></h3>
            <div class="portfolio-box owl-wrapper">
                <div class="owl-carousel" data-num="4">
                    <?php foreach($projects_highlight as $project) :
                        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ) , "size");
                        $image = aq_resize( $thumbnail_src[0], 600, 500 , true, true, true);
                        ?>
                        <div class="item project-post">
                            <div class="projects-highlight">
                                <a href="<?php echo esc_url( get_permalink($project->ID) ); ?>"><img src="<?=$image;?>" alt=""></a>
                                <div class="inner-hover">
                                    <h2><a href="<?php echo esc_url( get_permalink($project->ID) ); ?>"><?=$project->post_title;?></a></h2>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>

        </div>
    </section>
<?php endif; ?>
<!-- End projects-highlight -->

<!-- news-section
    ================================================== -->
<?php
$news_highlight = get_list_records_highlight_home(array('post_type'=>'post'));
    if(!empty($news_highlight)) :
?>
<section class="news-section">
    <div class="container">
        <h3><?php print __('Highlight News','tanphatlong');?></h3>
        <div class="news-box owl-wrapper">
            <div class="owl-carousel" data-num="4">
                <?php foreach($news_highlight as $news) :
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $news->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 600, 500 , true, true, true);
                    $description = types_render_field( "short-description", array( "raw" => "true", "id" => $news->ID ));
                ?>
                <div class="item news-post">
                    <div class="news-gallery">
                        <a href="<?php echo esc_url( get_permalink($news->ID) ); ?>"><img src="<?=$image;?>" alt=""></a>
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
<section class="portfolio-section color-w">
    <div class="container">
        <div class="portfolio-box owl-wrapper">
            <div class="owl-carousel" data-num="5">
                <?php foreach($clients_highlight as $client) :
                    $attachments = _func_get_value_custom_field('wpcf-client-image', $client->ID);
                    $image = aq_resize( $attachments, 204, 204 , true, true, true);
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