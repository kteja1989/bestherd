<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="Meissa-BEST" content="BEST is a top of the line Breeding Experimentation and Systems Tracking software. ">
    <meta name="author" content="Meissa Software Solutions Pvt Ltd.">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="Meissa-BEST" />
    <!-- website name -->
    <meta property="og:site" content="" />
    <!-- website link -->
    <meta property="og:title" content="" />
    <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" />
    <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" />
    <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" />
    <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>Meissa - BEST</title>
    
    <link rel="stylesheet" href="{{ asset('lcss/bootstrap.css') }} ">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <!--
    <link href="{{ asset('lcss/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('lcss/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('lcss/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('lcss/styles.css') }}" rel="stylesheet">
    -->
    <link href="{{ asset('lcss/fontawesome-all.css') }} " rel="stylesheet">
    <link href="{{ asset('lcss/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('lcss/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('lcss/styles.css') }}" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="limages/favicon.png">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <a class="navbar-brand logo-text page-scroll" href="#">B E S T - User: </a>

            <!-- Image Logo -->
            <!-- <a class="navbar-brand logo-image" href="index.html"><img src="{{ asset('limages/best.svg') }}" alt="alternative"></a> -->

            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <!-- end of mobile menu toggle button -->

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#header"> HOME <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="{{ route('login') }}">LOG IN</a>
                </span>
            </div>
        </div>
        <!-- end of container -->
    </nav>
    <!-- end of navbar -->
    <!-- end of navigation -->

    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="text-container">
                            <h1>Meissa - B E S T </h1>
                            <p class="p-large">Welcomes user "".  Use B E S T to manage your laboratory/facility's animal protocols, projects and Infrastructure to next level of effciency. </p>
                            <a class="btn-solid-lg page-scroll" href="#message">Send message!</a>
                        </div>
                        <!-- end of text-container -->
                    </div>
                    <!-- end of col -->

                    <div class="col-lg-6 col-xl-7">
                        <div class="image-container">
                            <div class="img-wrapper ">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                      <div class="carousel-inner">
                                        <div class="carousel-item active">
                                          <img src="{{ asset('limages/abc.png') }}" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                          <img src="{{ asset('limages/abc.png') }}" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                          <img src="{{ asset('limages/abc.png') }}" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                          <img src="{{ asset('limages/abc.png') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                      </a>
                                      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </div>
                                
                                
                            </div>
                            <!-- end of img-wrapper -->
                        </div>
                        <!-- end of image-container -->
                    </div>
                    <!-- end of col -->


                </div>
                <!-- end of row -->
            </div>
            <!-- end of container -->
        </div>
        <!-- end of header-content -->
    </header>
    <!-- end of header -->
    <svg class="header-frame" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 310"><defs><style>.cls-1{fill:#5f4def;}</style></defs><title>header-frame</title><path class="cls-1" d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z"/></svg>
    <!-- end of header -->

    <!-- Newsletter -->
    <div id="message" class="form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <div class="above-heading">Message Admin</div>
                        <h2>Leave message for issues</h2>

                        <!-- Newsletter Form -->
                        <form id="newsletterForm" data-toggle="validator" data-focus="false">
                            <div class="form-group">

								<input type="name" class="form-control-input" id="name" placeholder="Name" required>
                               <p></p>
                                <input type="email" class="form-control-input" id="email" placeholder="Email" required>
																<p></p>
                                <input type="textarea" class="form-control-input" id="msg" placeholder="Message" required>

                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="nterms" value="Agreed-to-Terms" required>I've read and agree to Meissa's <a href="privacy-policy.html">Privacy Policy</a> and <a href="terms-conditions.html">Terms Conditions</a>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">POST MESSAGE</button>
                            </div>
                            <div class="form-message">
                                <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                            </div>
                        </form>
                        <!-- end of newsletter form -->

                    </div>
                    <!-- end of text-container -->
                </div>
                <!-- end of col -->
            </div>
            <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="icon-container">

                    </div>
                    <!-- end of col -->
                </div>
                <!-- end of col -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container -->
    </div>
    <!-- end of form -->
    <!-- end of newsletter -->
    <!-- Footer -->
    <svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 79"><defs><style>.cls-2{fill:#5f4def;}</style></defs><title>footer-frame</title><path class="cls-2" d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z" transform="translate(0 -0.188)"/></svg>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>About Meissa</h4>
                        <p class="p-small">We're passionate about designing and developing best affordable web applications for all</p>
                    </div>
                </div>
                <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>What We Are</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Hosting <a class="white" href="#your-link">Data-Policy</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Read our <a class="white" href="/tanc">Terms & Conditions</a>, <a class="white" href="privacy-policy.html">Privacy Policy</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contact</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <!--<li class="media">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">RH24, Lake Paradise, Opp.CRPF, Talegaon Dabhade, Old Pune - Mumbai Highway, Pune - 410507, Maharashtra.</div>
                            </li>-->
                            <li class="media">
                                <i class="fas fa-envelope"></i>
                                <div class="media-body">
                                    <a class="white" href="mailto:best-service@meissabest.in">best-service@meissabest.in</a>
								</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end of col -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container -->
    </div>
    <!-- end of footer -->
    <!-- end of footer -->

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2021 Meissa Software Solutions Pvt. Ltd. <a href="#">Template by Inovatik</a></p>
                </div>
                <!-- end of col -->
            </div>
            <!-- enf of row -->
        </div>
        <!-- end of container -->
    </div>
    <!-- end of copyright -->
    <!-- end of copyright -->

    <!-- Scripts -->
    <script src="../ljs/jquery.min.js"></script>
    <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../ljs/popper.min.js"></script>
    <!-- Popper tooltip liblrary for Bootstrap -->
    <script src="../ljs/bootstrap.min.js"></script>
    <!-- Bootstrap framework -->
    <script src="../ljs/jquery.easing.min.js"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../ljs/swiper.min.js"></script>
    <!-- Swiper for image and text sliders -->
    <script src="../ljs/jquery.magnific-popup.js"></script>
    <!-- Magnific Popup for lightboxes -->
    <script src="../ljs/validator.min.js"></script>
    <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="../ljs/scripts.js"></script>
    <!-- Custom scripts -->
</body>

</html>
