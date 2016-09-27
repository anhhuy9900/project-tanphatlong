<?php
global $post;

$current_category = get_the_terms($post->ID, $current_taxonomy,  array("fields" => "term_id"));
$list_categories = func_recursive_breadcrumb_post_detail($current_category[0]->term_id, $current_category[0]->taxonomy);
?>
<!-- page-banner-section
            ================================================== -->
<section class="page-banner-section clearfix">
    <div class="container">
        <h1><?=$post->post_title;?></h1>
        <!--<ul class="page-depth">
            <li><a href="<?=home_url();?>"><?php print __('Home','tanphatlong');?></a></li>
            <?php if(!empty($list_categories)) :
                    foreach($list_categories as $key => $category) :
            ?>
            <li><a href="<?=get_term_link($key);?>"><?=$category;?></a></li>

            <?php endforeach;
                endif;
            ?>
            <li><a href="#"><?=$post->post_title;?></a></li>
        </ul>-->
    </div>
</section>
<!-- End page-banner section -->