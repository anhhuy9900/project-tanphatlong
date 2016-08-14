<?php
/*
Template Name: Search Page
*/

get_header(); ?>

<!-- page-banner-section
            ================================================== -->
<section class="page-banner-section">
    <div class="container">
        <ul class="page-depth">
            <li><a href="<?=home_url();?>"><?php print __('Home','tanphatlong');?></a></li>
            <li><a href="#"><?=pll_current_language()=='vi' ? 'Tìm Kiếm Từ Khóa' : 'Search Keyword'?></a></li>
        </ul>
    </div>
</section>
<!-- End page-banner section -->

<!-- portfolio-section  ================================================== -->
<?php $data = func_search_results();?>

<section class="portfolio-section">
    <div class="container">
        <?php if(!empty($data['results'])) :?>
            <div class="portfolio-box">
                <?php
                $count = 0;
                foreach($data['results'] as $key => $value) :
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 360, 300 , true, true, true);
                    ?>
                <?php if($count % 3 == 0) :?>
                <div class="row">
                <?php endif;
                    $count++;
                ?>

                    <div class="project-post col-md-4">
                        <div class="project-gallery">
                            <img src="<?=$image;?>" alt="">
                            <div class="hover-box">
                                <div class="inner-hover">
                                    <h2><a href="#"><?=$value->post_title;?></a></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php if($count % 3 == 0 || $count == count($data['results'])) :?>
                </div>
                <?php endif;?>

                <?php endforeach; ?>

                <?=$data['pagination'];?>

            </div>

        <?php else :?>
        <p><?php print __('Result Not Found','tanphatlong');?></p>
    	<?php endif;?>

    </div>
</section>
<!-- End portfolio section -->

<?php get_footer(); ?>