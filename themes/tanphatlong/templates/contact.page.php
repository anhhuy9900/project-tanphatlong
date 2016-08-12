<?php
/*
Template Name: Contact Page
*/

get_header(); ?>

<?php
global $post;
$result = func_submit_contact();

//get widget lat vs long for map contact
$widget_map_contact = _get_widget_data_for('Map Contact', '');
?>

<!-- map================================================== -->
<div class="info_map" data-lat="<?=$widget_map_contact->latitude;?>" data-long="<?=$widget_map_contact->longtitude;?>"></div>
<div id="map"></div>
<!-- map -->

<!-- contact section
    ================================================== -->
<section class="contact-section">
    <div class="container">
        <div class="col-md-8">
            <form id="contact-form" action="<?php print home_url().'/'.$post->post_name;?>" method="POST">
                <input type="hidden" name="action" value="submit_contact">
                <h2><?php print __('Send us a message','tanphatlong');?></h2>
                <div class="row">
                    <div class="col-md-4">
                        <input name="name" id="name" type="text" placeholder="Name">
                    </div>
                    <div class="col-md-4">
                        <input name="mail" id="mail" type="text" placeholder="Email">
                    </div>
                    <div class="col-md-4">
                        <input name="phone" id="tel-number" type="text" placeholder="Phone">
                    </div>
                </div>
                <textarea name="message" id="comment" placeholder="Message"></textarea>
                <input type="submit" id="submit_contact" value="<?php print __('Send Message','tanphatlong');?>">
                <div id="msg" class="message"></div>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>