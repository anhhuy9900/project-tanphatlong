<?php
/**
* @package WordPress
* @subpackage tanphatlong
*/

get_header(); ?>

<?php
global $post;
$list_pages_menu = func_get_list_menu_pages();

$parent_slug = pll_current_language() == 'vi' ? 'gioi-thieu' : 'about-us';
$page_about = get_page_by_path( $parent_slug );
?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb.php';?>

<!-- services section ================================================== -->
<section class="services-section">
    <div class="container">

        <div class="services-box">
            <div class="row">
                <div class="col-md-3">
                    <?php if(!empty($list_pages_menu)) :?>
                    <div class="services-tabs">
                        <ul>
                            <li<?=$post->post_name == 'gioi-thieu' || $post->post_name == 'about-us' ? ' class="active"' : '';?>>
                                <a href="<?php echo esc_url( get_permalink($page_about->ID) ); ?>" title="<?=$page_about->post_title;?>"><?=$page_about->post_title;?></a>
                            </li>
                            <?php foreach($list_pages_menu as $menu) :?>
                            <li<?=$menu->ID == $post->ID ? ' class="active"' : '';?>>
                                <a href="<?php echo esc_url( get_permalink($menu->ID) ); ?>" title="<?=$menu->post_title;?>"><?=$menu->post_title;?></a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <?php endif;?>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="services-post">
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                <h2><?php the_title();?></h2>
                                <?php the_content(); ?>
                            <?php endwhile; else: ?>
                                <p><?=pll_e('Sorry, no posts matched your criteria.');?></p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </div>
</section>
<!-- End services section -->

<?php get_footer(); ?>