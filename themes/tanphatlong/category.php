<<<<<<< HEAD
<?php get_header(); ?>

<?php
$data = get_list_records_news();
$list_menu = get_list_menu_news();

//get current category
$cat = get_category( get_query_var( 'cat' ) );
?>

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
                        ?>

                        <div class="blog-post">
                            <img src="<?=$image;?>" alt="">
                            <div class="post-content-text">
                                <h2><a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?=$value->post_title;?></a></h2>
                                <span>22 Jannuary 2015</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</p>
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

=======
<?php get_header(); ?>

<?php //include_once TEMPLATEPATH . '/templates/news.page.php';?>

>>>>>>> 5e8b738e7437d36ce4598d8138e1f61019b3a423
<?php get_footer(); ?>