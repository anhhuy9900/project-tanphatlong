<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0">
    <meta name="author" content="TanPhatLong" />

    <link href='http://fonts.googleapis.com/css?family=Montserrat:300,400,700' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/jquery.bxslider.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.carousel.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.theme.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/font-awesome.css" media="screen">
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/settings.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.css" media="screen">

    <?php wp_head(); ?>

    <script type="text/javascript">
        var ajaxurl = "<?php echo admin_url('admin-ajax.php', null); ?>";
        var template_directory_uri = '<?php echo esc_url( get_template_directory_uri() ); ?>';
        var baseurl = '<?php echo get_site_url(); ?>';
    </script>

</head>
<body <?php body_class(); ?>>

<!-- Container -->
<div id="container">

    <!-- Header
        ================================================== -->
    <header class="clearfix">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="top-line">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <?php pll_the_languages( array( 'dropdown' => 1 ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <?php $widget_logo = _get_widget_data_for('Logo Site', '');?>
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=home_url();?>"><img src="<?=$widget_logo->imageurl?>" alt=""></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="active" href="<?=home_url();?>">Home</a></li>
                        <?php
                        $menu_language = pll_current_language() == 'vi' ? 'site-menu-vi' : 'site-menu-en';
                        $nav_menu_items = wp_get_nav_menu_items( $menu_language );
                        $menu_items = func_nav_menu_object_tree( $nav_menu_items );
                        if(!empty($menu_items)) :
                            foreach($menu_items as $item_parent) :
                        ?>
                        <li><a href="<?=$item_parent->url; ?>"><?=$item_parent->title;?></a>
                            <?php if(!empty($item_parent->children)) :?>
                            <ul class="drop-down">
                                <?php foreach($item_parent->children as $item_child) :?>
                                <li><a href="<?=$item_child->url; ?>"><?=$item_child->title;?></a></li>
                                <?php endforeach;?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php
                            endforeach;
                        endif;
                        ?>

                        <li class="search"><a href="#" class="open-search"><i class="fa fa-search"></i></a>
                            <form action="<?php echo home_url().'/'.(pll_current_language() == 'vi'?'tim-kiem':'search'); ?>" method="get" id="searchform" class="form-search">
                                <input type="search" name="keyword" placeholder="Search:"/>
                                <button type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!-- End Header -->


    <!-- home-section-->
    <section id="home-section" class="slider1">

        <!--
        #################################
            - THEMEPUNCH BANNER -
        #################################
        -->
        <div class="tp-banner-container">
            <div class="tp-banner" >
                <?php $list_banners = _func_get_posts_type(array('post_type' => 'manage-banners'));
                if(!empty($list_banners)) :
                    ?>
                    <ul>	<!-- SLIDE  -->
                        <?php foreach($list_banners as $banner) :
                            $attachments = _func_get_value_custom_field('wpcf-banner-image', $banner->ID);
                            $image = aq_resize( $attachments, 1920, 550 , true, true, true);
                            ?>
                            <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on"  data-title="<?=$banner->post_title;?>">
                                <!-- MAIN IMAGE -->
                                <img src="<?=$image;?>" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <!-- LAYERS -->

                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption lft tp-resizeme rs-parallaxlevel-0"
                                     data-x="200"
                                     data-y="190"
                                     data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                     data-speed="1000"
                                     data-start="1000"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     style="z-index: 8; max-width: auto; max-height: auto; white-space: nowrap;"><?//=$banner->post_title;?>
                                </div>

                            </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="tp-bannertimer"></div>
                <?php endif;?>
            </div>
        </div>
    </section>
    <!-- End home section -->