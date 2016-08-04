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
                        <div class="col-md-8">
                            <ul class="info-list">
                                <li>
                                    <i class="fa fa-phone"></i>
                                    Call us:
                                    <span>1234 - 5678 - 9012</span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope-o"></i>
                                    Email us:
                                    <span>nunforest@gmail.com</span>
                                </li>
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                    working time:
                                    <span>08:00 - 17:00</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <?php pll_the_languages( array( 'dropdown' => 1 ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt=""></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="active" href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="projects.html">Projects</a></li>
                        <li><a href="services.html">Our Services</a>
                            <ul class="drop-down">
                                <li><a href="buildings.html">Small &amp; Large Buildings</a></li>
                                <li><a href="garden.html">Elegant Garden</a></li>
                                <li><a href="projecting.html">Perfect Projectings</a></li>
                                <li><a href="energy.html">Energy Repair</a></li>
                                <li><a href="roads.html">Roads &amp; Paths</a></li>
                                <li><a href="repairing.html">Repairing &amp; Maintenance</a></li>
                            </ul>
                        </li>
                        <li><a href="blog.html">blog</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li class="search"><a href="#" class="open-search"><i class="fa fa-search"></i></a>
                            <form class="form-search">
                                <input type="search" placeholder="Search:"/>
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
