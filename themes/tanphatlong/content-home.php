<?php

$menu_name = 'primary'; //menu slug
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

pr($menuitems);

?>

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
                    $image = aq_resize( $attachments, 1920, 550 , true, true, true);
                 ?>
                <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on"  data-title="<?=$banner->post_title;?>">
                    <!-- MAIN IMAGE -->
                    <img src="<?=$image;?>" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <!-- LAYERS -->

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption lft tp-resizeme rs-parallaxlevel-0"
                         data-x="200"
                         data-y="190"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="1000"
                         data-start="1000"
                         data-easing="Power3.easeInOut"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         style="z-index: 8; max-width: auto; max-height: auto; white-space: nowrap;"><span class="left-top corner-border"></span>
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

<!-- banner-section
    ================================================== -->
<section class="banner-section">
    <div class="container">
        <h2>Construct is made with greatest page builder &amp; most sold in codecanyon </h2>
    </div>
</section>
<!-- End banner section -->

<!-- services-section
    ================================================== -->
<?php $pages_highlight = get_list_pages_highlight_home();
        if(!empty($pages_highlight)) :
?>
<section class="services-section">
    <div class="container">
        <div class="services-box">
            <div class="row">
                <?php
                    foreach($pages_highlight as $page) :
                ?>
                <div class="col-md-3">
                    <div class="services-post">
                        <!--<img src="upload/others/5.jpg" alt="">-->
                        <div class="services-content">
                            <h2><?=$page->post_title;?></h2>
                            <p>Aenean sed justo tincidunt, vulputate nisi sit amet, rutrum ligula. Pellentesque dictum aliquam ornare. Sed elit lectus.</p>
                            <a href="<?php echo esc_url( get_permalink($page->ID) ); ?>" title="<?=$page->post_title;?>">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <?php endforeach;?>
            </div>
        </div>

    </div>
</section>
<?php endif; ?>
<!-- End services section -->

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
                                <h2><a href="<?=$project->post_name;?>"><?=$project->post_title;?></a></h2>
                                <span>interior</span>
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

<!-- tabs-section
    ================================================== -->
<section class="tabs-section">
    <div class="container">
        <div class="row">

            <div class="col-md-7">
                <div class="about-us-box">
                    <h1>about us and our priorities</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="about-us-post">
                                <a href="#"><i class="fa fa-building-o"></i></a>
                                <h2>Construction</h2>
                                <span>build homes</span>
                            </div>
                            <div class="about-us-post">
                                <a href="#"><i class="fa fa-cogs"></i></a>
                                <h2>Maintanance</h2>
                                <span>energy repair</span>
                            </div>
                            <div class="about-us-post">
                                <a href="#"><i class="fa fa-desktop"></i></a>
                                <h2>Good Planning</h2>
                                <span>architecture</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about-us-post">
                                <a href="#"><i class="fa fa-desktop"></i></a>
                                <h2>Good Planning</h2>
                                <span>architecture</span>
                            </div>
                            <div class="about-us-post">
                                <a href="#"><i class="fa fa-users"></i></a>
                                <h2>Awesome Stuff</h2>
                                <span>1000+ workers</span>
                            </div>
                            <div class="about-us-post">
                                <a href="#"><i class="fa fa-building-o"></i></a>
                                <h2>Construction</h2>
                                <span>build homes</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">

                <div class="about-box">
                    <img src="upload/others/about.jpg" alt="">
                    <h2>Who we are</h2>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</p>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- End tabs section -->

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
                        <h2><a href="<?=$news->post_name;?>" title="<?=$news->post_name;?>"><?=$news->post_title;?></a></h2>
                        <p><?=$description;?></p>
                        <a href="<?=$news->post_name;?>" title="<?=$news->post_name;?>">Read More <i class="fa fa-angle-right"></i></a>
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