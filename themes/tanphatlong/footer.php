
<!-- footer
    ================================================== -->
<footer>
    <div class="container">
        <div class="footer-widgets">
            <div class="row">
                <?php
                $list_contacts = get_list_records_highlight_home(array('post_type'=>'manage-contacts','posts_per_page' => 2), 0);
                    if(!empty($list_contacts)) :
                        foreach($list_contacts as $contact) :
                            $address = types_render_field( "contact-address", array( "raw" => "true", "id" => $contact->ID ));
                            $phone = types_render_field( "contact-phone", array( "raw" => "true", "id" => $contact->ID ));
                            $fax = types_render_field( "contact-fax", array( "raw" => "true", "id" => $contact->ID ));
                            $email = types_render_field( "contact-email", array( "raw" => "true", "id" => $contact->ID ));
                ?>
                <div class="col-md-3">
                    <div class="widgets info-widget">
                        <h2><?=$contact->post_title;?></h2>
                        <p class="first-par"><?=$address;?></p>
                        <p><span><?php print __('Tel','tanphatlong');?>: </span> <?=$phone;?></p>
                        <p><span><?php print __('Fax','tanphatlong');?>: </span> <?=$fax;?></p>
                        <p><span><?php print __('Email','tanphatlong');?>: </span> <?=$email;?></p>
                    </div>
                </div>
                <?php endforeach;
                    endif;
                ?>

                <?php $gallery_images = func_showGalleryFooter(2);
                        if(!empty($gallery_images)) :
                ?>
                <div class="col-md-3">
                    <div class="widgets">
                        <h2><?php print __('Images Company','tanphatlong');?></h2>
                        <ul class="flickr-list">
                            <?php foreach($gallery_images as $image) :
                                $image_url = aq_resize( $image->image_url, 80, 80 , true, true, true);
                                if(pll_current_language() == 'vi'){
                                    $url = home_url().'/hinh-anh-cong-ty';
                                }else{
                                    $url = home_url().'/gallery-company';
                                }
                            ?>
                            <li><a href="<?=$url;?>"><img src="<?=$image_url;?>" alt=""/></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <?php endif;?>

                <div class="col-md-3">
                    <?php $widget_top_info = _get_widget_data_for('Top Information', '');?>
                    <div class="widgets info-widget">
                        <h2><?php print __('Working Hours','tanphatlong');?></h2>
                        <p class="first-par"><?php print __('You can contact or visit us during working time.','tanphatlong');?></p>
                        <p><span><?php print __('Call us','tanphatlong');?>: </span> <?=(!empty($widget_top_info[0]) ? $widget_top_info[0]->text : '')?></p>
                        <p><span><?php print __('Email us','tanphatlong');?>: </span> <?=(!empty($widget_top_info[1]) ? $widget_top_info[1]->text : '')?></p>
                        <p><span><?php print __('working time','tanphatlong');?>: </span> <?=(!empty($widget_top_info[2]) ? $widget_top_info[2]->text : '')?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="last-line">
        <div class="container">
            <p class="copyright">
                &copy; <?php print __('Coppyright © 2016 tanphatlong. All rights reserved.','tanphatlong');?>
            </p>
        </div>
    </div>
</footer>
<!-- End footer -->

</div>
<!-- End Container -->

<?php wp_footer(); ?>


<!-- Revolution slider -->
<script type="text/javascript">

    jQuery(document).ready(function() {

        jQuery('.tp-banner').show().revolution(
            {
                dottedOverlay:"none",
                delay:10000,
                startwidth:1140,
                startheight:570,
                hideThumbs:200,

                thumbWidth:100,
                thumbHeight:50,
                thumbAmount:5,

                navigationType:"none",
                navigationArrows:"",

                touchenabled:"on",
                onHoverStop:"off",

                swipe_velocity: 0.7,
                swipe_min_touches: 1,
                swipe_max_touches: 1,
                drag_block_vertical: false,

                parallax:"mouse",
                parallaxBgFreeze:"on",
                parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

                keyboardNavigation:"off",

                navigationHAlign:"center",
                navigationVAlign:"bottom",
                navigationHOffset:0,
                navigationVOffset:60,

                shadow:0,

                spinner:"spinner4",

                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,

                shuffle:"off",

                autoHeight:"off",
                forceFullWidth:"off",



                hideThumbsOnMobile:"off",
                hideNavDelayOnMobile:1500,
                hideBulletsOnMobile:"off",
                hideArrowsOnMobile:"off",
                hideThumbsUnderResolution:0,

                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                startWithSlide:0,
                fullScreenOffsetContainer: ".header"
            });

    });

</script>
</body>
</html>