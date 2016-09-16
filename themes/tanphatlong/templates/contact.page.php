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
$widget_address = _get_widget_data_for('Map Contact', pll_current_language());
?>

<!-- map================================================== -->
<div class="info_map" data-lat="<?=$widget_map_contact->latitude;?>" data-long="<?=$widget_map_contact->longtitude;?>" data-img="<?php echo esc_url( get_template_directory_uri() ); ?>/images/marker.png" data-address="<?=(!empty($widget_address)) ? $widget_address->text :'';?>"></div>
<div id="map"></div>
<!-- map -->

<!-- contact section
    ================================================== -->
<section class="contact-section">
    <div class="container">
        <div class="col-md-8">
            <form id="contact-form" action="<?php print home_url().'/'.$post->post_name;?>" method="POST" class="submit-form">
                <?php wp_nonce_field('contact_form_action','contact_form_field'); ?>
                <input type="hidden" name="access_token" value="<?=create_token_form();?>">
                <input type="hidden" name="action" value="submit_contact">
                <h2><?php print __('Send us a message','tanphatlong');?></h2>
                <div class="row">
                    <div class="col-md-4">
                        <input name="name" id="name" type="text" placeholder="<?php print __('Name','tanphatlong');?>">
                    </div>
                    <div class="col-md-4">
                        <input name="mail" id="mail" type="text" placeholder="Email">
                    </div>
                    <div class="col-md-4">
                        <input name="phone" id="tel-number" type="text" placeholder="<?php print __('Phone','tanphatlong');?>">
                    </div>
                </div>
                <textarea name="message" id="comment" placeholder="<?php print __('Message','tanphatlong');?>"></textarea>
                <input type="submit" id="submit_contact" value="<?php print __('Send Message','tanphatlong');?>">
                <div id="msg" class="message"></div>
            </form>
        </div>
    </div>
</section>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAY_4YI9C-h66Yhyi3Gtrej6Nm4jxQY4e8">
</script>
<?php get_footer(); ?>