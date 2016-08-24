<?php
/*
Template Name: Submit CV Page
*/

get_header(); ?>

<?php global $post;
$rec = (!empty($_REQUEST['rec'])) ? $_REQUEST['rec'] : 0;
$result = _func_submit_cv();
?>

<!--Include file breadcumb-->
<?php include_once TEMPLATEPATH . '/includes/breadcumb.php';?>

<!-- contact section
    ================================================== -->
<section class="contact-section">
    <div class="container">
        <div class="col-md-8">
            <form id="submit-cd-form" action="<?php print home_url().'/'.$post->post_name.'/?rec='.$rec;?>" method="POST" class="submit-form" enctype="multipart/form-data">
                <?php wp_nonce_field('submit_cv_action','submit_cv_field'); ?>
                <input type="hidden" name="rec_id" value="<?=$rec;?>">
                <input type="hidden" name="action" value="submit_cv">
                <input type="hidden" name="access_token" value="<?=create_token_form();?>">
                <h2><?php print __('TAN PHAT LONG ENGINEERING CORPORATION','tanphatlong');?></h2>
                <div class="row">
                    <h6><?php print __('NOTE','tanphatlong');?></h6>
                    <p>
                        - <?php print __('Documents are stored within 3 weeks','tanphatlong');?></p>
                    <p>
                        - <?php print __('All information will be kept confidential and only absolute is used as a basis for screening candidates company','tanphatlong');?></p>
                    <p>
                        - <?php print __('Please fill in the information below','tanphatlong');?></p>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input name="your_name" id="your_name" type="text" placeholder="<?php print __('Name','tanphatlong');?>">
                    </div>
                    <div class="col-md-8">
                        <input name="address" id="address" type="text" placeholder="<?php print __('Address','tanphatlong');?>">
                    </div>
                    <div class="col-md-8">
                        <input name="email" id="email" type="text" placeholder="Email">
                    </div>
                    <div class="col-md-8">
                        <input name="phone" id="tel-number" type="text" placeholder="<?php print __('Phone','tanphatlong');?>">
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
</section>

<?php get_footer(); ?>
