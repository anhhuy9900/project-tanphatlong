<?php
/*
Template Name: Projects Page
*/

get_header(); ?>

<?php global $post; ?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb.php';?>

<!-- services section-->
<?php
$data = get_list_records_projects();
$list_menu = get_list_menu_projects();
?>

<section class="portfolio-section">
    <div class="container">

        <?php if(!empty($data['results'])) : ?>
            <div class="portfolio-box col-md-9">
                <?php $count = 0;
                foreach($data['results'] as $key => $value) :
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ) , "size");
                    $image = aq_resize( $thumbnail_src[0], 398, 239 , true, true, true);
                ?>
                <?php if($count % 2 == 0) :?>
                <div class="row">
                <?php endif;
                    $count++;
                ?>
                    <div class="project-post col-md-6">
                        <div class="projects-highlight">
                            <a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><img src="<?=$image;?>" alt=""></a>
                            <div class="inner-hover">
                                <h2><a href="<?php echo esc_url( get_permalink($value->ID) ); ?>"><?=$value->post_title;?></a></h2>
                            </div>
                        </div>
                    </div>
                <?php if($count % 2 == 0 || $count == count($data['results'])) :?>
                </div>
                <?php endif;?>

                <?php endforeach; ?>

                <?=$data['pagination'];?>

            </div>
        <?php endif;?>

        <div class="col-md-3">
            <!--Include file menu-->
            <?php include_once TEMPLATEPATH . '/includes/left_menu_project.php';?>
        </div>

    </div>
</section>

<?php get_footer(); ?>