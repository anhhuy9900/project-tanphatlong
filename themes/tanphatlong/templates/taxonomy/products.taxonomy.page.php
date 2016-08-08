<?php
/*
Template Name: products Page
*/

get_header(); ?>

<?php 
global $taxonomy,$term;
$get_category = get_term_by('slug', $term, 'list-menu-product-services');
?>
<!-- page-banner-section
            ================================================== -->
<section class="page-banner-section">
    <div class="container">
        <h1><?=$get_category->name;?></h1>
        <ul class="page-depth">
            <li><a href="#"><?=$get_category->name;?></a></li>
        </ul>
    </div>
</section>
<!-- End page-banner section -->

<!-- services section-->
<?php
$data = get_list_records_products($term);
$list_menu = get_list_menu_products();
?>

<section class="portfolio-section">
    <div class="container">
        <?php if(!empty($list_menu)) :?>
        <div class="col-md-3">
            <div class="services-tabs">
                <ul>
                    <?php foreach($list_menu as $menu) :?>
                    <li<?=$menu->slug == $term ? ' class="active"' : ''?>>
                        <a href="<?=get_term_link($menu->term_id);?>" ><?=$menu->name;?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif;?>

        <?php if(!empty($data['results'])) : ?>
            <div class="portfolio-box col-md-9">
                <?php $count = 0;
                foreach($data['results'] as $key => $value) :
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 360, 300 , true, true, true);
                ?>
                <?php if($count % 3 == 0) :?>
                <div class="row">
                <?php endif;
                    $count++;
                ?>
                    <div class="project-post col-md-3">
                        <div class="project-gallery">
                            <img src="<?=$image;?>" alt="">
                            <div class="hover-box">
                                <div class="inner-hover">
                                    <h2><a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?=$value->post_title;?></a></h2>
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
        <?php endif;?>
    </div>
</section>

<?php get_footer(); ?>