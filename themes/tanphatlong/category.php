
<?php get_header(); ?>

<?php
$data = get_list_records_news();
$list_menu = get_list_menu_news();
$cat = get_category( get_query_var( 'cat' ) );
?>

<!-- page-banner-section
            ================================================== -->
<?=func_breadcrumb_category($cat);?>
<!-- End page-banner section -->

<section class="blog-section">
    <div class="container">
        <?php if(!empty($list_menu)) :?>
            <div class="col-md-4">
                <div class="services-tabs">
                    <ul>
                        <?php foreach($list_menu as $menu) :?>
                            <li<?=$menu->slug == $cat->slug ? ' class="active"' : ''?>>
                                <a href="<?=get_term_link($menu->term_id);?>" ><?=$menu->name;?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif;?>

        <div class="col-md-8">
            <?php if(!empty($data['results'])) : ?>
                <div class="blog-box">
                    <?php $count = 0;
                    foreach($data['results'] as $key => $value) :
                        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                        $image = aq_resize( $thumbnail_src[0], 600, 500 , true, true, true);
                        $description = types_render_field( "short-description", array( "raw" => "true", "id" => $value->ID ));
                    ?>

                        <div class="blog-post">
                            <img src="<?=$image;?>" alt="">
                            <div class="post-content-text">
                                <h2><a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?=$value->post_title;?></a></h2>
                                <span><?=date('d M Y',strtotime($value->post_date))?></span>
                                <p><?=$description;?></p>
                                <a href="<?php echo esc_url( get_permalink($value->ID) ); ?>">Read More <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>

                    <?php endforeach; ?>

                    <?=$data['pagination'];?>

                </div>
            <?php endif;?>

        </div>

    </div>
</section>

<?php get_footer(); ?>

