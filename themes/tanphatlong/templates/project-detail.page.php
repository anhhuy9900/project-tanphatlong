<?php
global $post;
?>
<!-- page-banner-section
            ================================================== -->
<section class="page-banner-section">
    <div class="container">
        <h1><?=$post->post_title;?></h1>
    </div>
</section>
<!-- End page-banner section -->

<!-- single-page section
    ================================================== -->
<section class="single-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <img src="upload/portfolio/3.jpg" alt="">

            </div>
            <div class="col-md-5">
                <div class="project-content">
                    <?=$post->post_content;?>
                    <div class="project-tags">
                        <ul>
                            <li><i class="fa fa-calendar"></i> <span>Date:</span> <?=date('Y.m.D',strtotime($post->post_date))?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End single-page section -->

<!-- portfolio-section
    ================================================== -->
<section class="portfolio-section">
    <div class="container">

        <div class="portfolio-box owl-wrapper">
            <div class="owl-carousel" data-num="3">

                <div class="item project-post">
                    <div class="project-gallery">
                        <img src="upload/portfolio/1.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>interior</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item project-post">
                    <div class="project-gallery">
                        <img src="upload/portfolio/2.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>building</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item project-post">
                    <div class="project-gallery">
                        <img src="upload/portfolio/3.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>construction</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item project-post">
                    <div class="project-gallery">
                        <img src="upload/portfolio/4.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>house</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item project-post">
                    <div class="project-gallery">
                        <img src="upload/portfolio/5.jpg" alt="">
                        <div class="hover-box">
                            <div class="inner-hover">
                                <h2><a href="single-project.html">Single Project Title</a></h2>
                                <span>architecture</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
<!-- End portfolio section -->