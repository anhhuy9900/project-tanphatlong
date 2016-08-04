<?php
/*
Template Name: Abilities Page
*/

get_header(); ?>

<!-- page-banner-section
			================================================== -->
<section class="page-banner-section">
    <div class="container">
        <h1>Our Projects</h1>
        <ul class="page-depth">
            <li><a href="index.html">Construct</a></li>
            <li><a href="projects.html">Our Projects</a></li>
        </ul>
    </div>
</section>
<!-- End page-banner section -->

<!-- portfolio-section
    ================================================== -->
<section class="portfolio-section">
    <div class="container">

        <div class="portfolio-box">
            <div class="row">
                <div class="project-post col-md-4">
                    <div class="project-gallery">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/upload/portfolio/1.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="#">Single Project Title</a></h2>
                                <span class="btn-ability">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    <a href="#" class="btn-click">Download</a>
                                </span>
                                <span class="btn-ability">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <a href="#" class="btn-click">View</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="project-post col-md-4">
                    <div class="project-gallery">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/upload/portfolio/2.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>building</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="project-post col-md-4">
                    <div class="project-gallery">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/upload/portfolio/3.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>construction</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="project-post col-md-4">
                    <div class="project-gallery">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/upload/portfolio/1.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>interior</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="project-post col-md-4">
                    <div class="project-gallery">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/upload/portfolio/2.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>building</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="project-post col-md-4">
                    <div class="project-gallery">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/upload/portfolio/3.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>construction</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="project-post col-md-4">
                    <div class="project-gallery">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/upload/portfolio/1.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>interior</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="project-post col-md-4">
                    <div class="project-gallery">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/upload/portfolio/2.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>building</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="project-post col-md-4">
                    <div class="project-gallery">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/upload/portfolio/3.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>construction</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- End portfolio section -->

<?php get_footer(); ?>
