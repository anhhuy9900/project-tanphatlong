<<<<<<< HEAD
<?php
global $post;
$list_menu = get_list_menu_news();

$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , "size");
$image = aq_resize( $thumbnail_src[0], 900, 500 , true, true, true);
?>

<section class="blog-section">
    <div class="container">
        <?php if(!empty($list_menu)) :?>
            <div class="col-md-4">
                <div class="services-tabs">
                    <ul>
                        <?php foreach($list_menu as $menu) :?>
                            <li>
                                <a href="<?php echo esc_url( get_permalink($menu->ID) ); ?>" ><?=$menu->name;?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif;?>

        <div class="col-md-8">
            <div class="blog-box">
                <div class="blog-post single-post">
                    <div class="post-content-text">
                        <h1><?=$post->post_title;?></h1>
                        <span><?=date('d M Y',strtotime($post->post_date))?></span>
                        <p><?=$post->post_content;?></p>
                    </div>
                </div>

            </div>

        </div>

    </div>
=======
<?php
global $post;
$list_menu = get_list_menu_news();

$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , "size");
$image = aq_resize( $thumbnail_src[0], 900, 500 , true, true, true);
?>

<section class="blog-section">
    <div class="container">
        <?php if(!empty($list_menu)) :?>
            <div class="col-md-4">
                <div class="services-tabs">
                    <ul>
                        <?php foreach($list_menu as $menu) :?>
                            <li>
                                <a href="<?php echo esc_url( get_permalink($menu->ID) ); ?>" ><?=$menu->name;?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif;?>

        <div class="col-md-8">
            <div class="blog-box">
                <div class="blog-post single-post">
                    <div class="post-content-text">
                        <h1><?=$post->post_title;?></h1>
                        <span><?=date('d M Y',strtotime($post->post_date))?></span>
                        <p><?=$post->post_content;?></p>
                    </div>
                </div>

            </div>

        </div>

    </div>
>>>>>>> 5e8b738e7437d36ce4598d8138e1f61019b3a423
</section>