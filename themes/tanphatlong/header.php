<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0">
    <meta name="author" content="TanPhatLong" />

    <link href='http://fonts.googleapis.com/css?family=Montserrat:300,400,700' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicon.ico" type="image/x-icon">

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
                        <div class="col-md-8">
                            <?php $widget_top_info = _get_widget_data_for('Top Information', '');?>
                            <ul class="info-list">
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <?php print __('Call us','tanphatlong');?>:
                                    <span><?=(!empty($widget_top_info[0]) ? $widget_top_info[0]->text : '')?></span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope-o"></i>
                                    <?php print __('Email us','tanphatlong');?>:
                                    <span><?=(!empty($widget_top_info[1]) ? $widget_top_info[1]->text : '')?></span>
                                </li>
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                    <?php print __('working time','tanphatlong');?>:
                                    <span><?=(!empty($widget_top_info[2]) ? $widget_top_info[2]->text : '')?></span>
                                </li>
                            </ul>

                        </div>
                        <div class="col-md-4">
                            <ul class="widget_polylang">
                                <?php pll_the_languages(
                                    array(
                                        'show_flags' => 1,
                                        'show_names' => 0,
                                    )
                                ); ?>
                            </ul>
                            <ul class="social-icons">
                                <?php $widget_social_icons = _get_widget_data_for('Social Webiste', '');
                                        $arr_social_class = array(
                                            'facebook'=> 'fa-facebook',
                                            'google'=> 'fa-google-plus',
                                            'twitter'=> 'fa-twitter',
                                            'linkedin'=> 'fa-linkedin',
                                            'pinterest'=> 'fa-pinterest',
                                        );
                                        if(!empty($widget_social_icons)) :
                                            foreach($widget_social_icons as $social) :
                                                $key_val = strtolower($social->title);
                                ?>
                                    <li><a class="<?=$key_val;?>" href="<?=$social->text;?>" target="_blank"><i class="fa <?=$arr_social_class[$key_val];?>"></i></a></li>
                                <?php endforeach;
                                    endif;
                                ?>
                                <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                            </ul>
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
                        <li><a class="active" href="<?=home_url();?>"><?php print __('Home','tanphatlong');?></a></li>
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
                            <form action="<?php echo home_url(); ?>" method="get" id="searchform" class="form-search" role="search">
                                <input type="hidden" name="lang" value="<?=pll_current_language();?>">
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
