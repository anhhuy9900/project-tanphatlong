<?php
/*
Template Name: Submit CV Page
*/

get_header(); ?>

<?php global $post;
$rec = (!empty($_REQUEST['rec'])) ? $_REQUEST['rec'] : 0;
$result = _func_submit_cv();
$file_cv = wp_get_attachment_url(360);
$file_register_intership = wp_get_attachment_url(360);
?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb.php';?>

<!-- contact section
    ================================================== -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            <!--Include file menu-->
            <?php include_once TEMPLATEPATH . '/includes/left_menu_recruitment.php';?>
            </div>
            <div class="col-md-8">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile;
                endif;
                ?>
                <ul>
                    <li><b><?php print __('Curriculum Vitae','tanphatlong');?></b>: <a href="<?=$file_cv;?>"><?php print __('Download','tanphatlong');?></a></li>
                    <li><strong><?php print __('Registration card practice','tanphatlong');?>: </strong><a href="<?=$file_register_intership;?>"><?php print __('Download','tanphatlong');?></a></li>
                </ul>

                <form id="submit-cd-form" action="" method="POST" class="submit-form" enctype="multipart/form-data">
                    <?php wp_nonce_field('submit_cv_action','submit_cv_field'); ?>
                    <input type="hidden" name="rec_id" value="<?=$rec;?>">
                    <input type="hidden" name="action" value="submit_cv">
                    <input type="hidden" name="access_token" value="<?=create_token_form();?>">
                    <div class="row">
                        <div class="col-md-8">
                            <input name="your_name" id="your_name" type="text" placeholder="<?php print __('Name','tanphatlong');?>">
                        </div>
                        <div class="col-md-8">
                            <input name="email" id="email" type="text" placeholder="Email">
                        </div>
                        <div class="col-md-8">
                            <input name="phone" id="tel-number" type="text" placeholder="<?php print __('Phone','tanphatlong');?>">
                        </div>
                        <div class="col-md-8">
                            <input name="birthday" id="birthday" type="text" placeholder="<?php print __('Birthday','tanphatlong');?>">
                        </div>
                        <div class="col-md-8">
                            <select name="gender" id="gender" class="gfield_select">
                                <option value="0"><?php print __('Gender','tanphatlong');?></option>
                                <option value="1"><?php print __('Male','tanphatlong');?></option>
                                <option value="2"><?php print __('Female','tanphatlong');?></option>
                            </select>
                        </div>

                        <div class="ht-15 clearfix"></div>
                        <div class="col-md-8">
                            <input name="position_apply" id="position_apply" type="text" placeholder="<?php print __('Position Apply','tanphatlong');?>">
                        </div>
                        <div class="col-md-8">
                            <select name="occupational_skills" id="occupational_skills" class="gfield_select">
                                <?php foreach(occupational_skills() as $value => $skill) :?>
                                    <option value="<?=$value;?>"><?=$skill?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="ht-15 clearfix"></div>
                        <div class="col-md-8">
                            <input name="address" id="address" type="text" placeholder="<?php print __('Address','tanphatlong');?>">
                        </div>
                        <div class="col-md-8">
                            <label>File CV</label>
                            <input name="file_cv" id="file_cv" type="file" placeholder="File CV">
                        </div>
                    </div>
                    <div class="mr-t20 clearfix"></div>
                    <input type="submit" id="submit_cv" value="<?php print __('Submit','tanphatlong');?>">
                    <div id="msg" class="message<?=$result['submit'] == 1 ? $result['status']==0 ? ' error' : ' success' : '';?>">
                        <?php if($result['submit'] == 1):
                            print $result['msg'];
                        endif;
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
