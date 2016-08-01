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
                        <p><span>Tel: </span> <?=$phone;?></p>
                        <p><span>Fax: </span> <?=$fax;?><</p>
                        <p><span>Email: </span> <?=$email;?></p>\
                    </div>
                </div>
                <?php endforeach;
                    endif;
                ?>
                <div class="col-md-3">
                    <div class="widgets">
                        <h2>Flickr widget</h2>
                        <ul class="flickr-list">
                            <li><a href="#"><img src="upload/flickr/1.jpg" alt=""/></a></li>
                            <li><a href="#"><img src="upload/flickr/2.jpg" alt=""/></a></li>
                            <li><a href="#"><img src="upload/flickr/3.jpg" alt=""/></a></li>
                            <li><a href="#"><img src="upload/flickr/4.jpg" alt=""/></a></li>
                            <li><a href="#"><img src="upload/flickr/5.jpg" alt=""/></a></li>
                            <li><a href="#"><img src="upload/flickr/6.jpg" alt=""/></a></li>
                            <li><a href="#"><img src="upload/flickr/1.jpg" alt=""/></a></li>
                            <li><a href="#"><img src="upload/flickr/2.jpg" alt=""/></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="last-line">
        <div class="container">
            <p class="copyright">
                &copy; Copyright 2015. "Construct" by Nunforest. All rights reserved.
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