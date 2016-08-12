<?php
global $post;
?>
<!-- page-banner-section
            ================================================== -->
<section class="page-banner-section">
    <div class="container">
        <ul class="page-depth">
            <li><a href="<?=home_url();?>"><?php print __('Home','tanphatlong');?></a></li>
            <li><a href="<?php echo esc_url( get_permalink($post->ID) ); ?>"><?=$post->post_title;?></a></li>
        </ul>
    </div>
</section>
<!-- End page-banner section -->