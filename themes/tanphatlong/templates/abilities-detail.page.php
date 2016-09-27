<?php
/**
 * @package WordPress
 * @subpackage tanphatlong
 */

get_header(); ?>

<?php
global $post;
$file_download_abilities = types_render_field( "file-download-abilities", array( "raw" => "true", "id" => $post->ID ));
?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb.php';?>

<!-- services section ================================================== -->
<section class="services-section">
    <div class="container">
        <div class="services-box">
            <div class="row">
                <div class="col-md-3">
                    <!--Include file menu-->
                    <?php include_once TEMPLATEPATH . '/includes/left_menu_abilities.php';?>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="services-post">
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                <h2><?php the_title();?></h2>
                                <?php the_content(); ?>

                                <a href="<?=$file_download_abilities;?>" class="abilitiy-download"><?php print __('Download','tanphatlong');?></a>
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