<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Painlessgift</title>

        <!-- Favicon -->
         <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/ico/logo.png">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/logo.ico">

        <!-- CSS Global -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/prettyPhoto.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/owl.theme.default.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/theme-green-1.css" rel="stylesheet" id="theme-config-link">

        <!-- Head Libs -->
        <script src="<?php echo base_url(); ?>assets/js/modernizr.custom.js"></script>

        <!--[if lt IE 9]>
        <script src="assets/plugins/iesupport/html5shiv.js"></script>
        <script src="assets/plugins/iesupport/respond.min.js"></script>
        <![endif]-->
		<style>
		.hgt{width: auto !important;
		 height: 250px !important;}
		.top-rate{height:220px !important;}
		.thumbnail.sm .media{height:150px;}
		.thumbnail.sm img{height:150px !important;}
		</style>
    </head>
    <body id="home" class="wide header-style-1">
       <!-- HEADER -->
			<?php echo $header;?>
		<!-- HEADER -->
            <!-- CONTENT AREA -->
            <div class="content-area">

                <!-- PAGE -->
                <section class="page-section no-padding slider">
                    <div class="container full-width">

                        <div class="main-slider hgt-300">
                            <div class="owl-carousel" id="main-slider">

                                <!-- Slides -->
								<?php foreach($slides as $s) { ?>
                                <div class="item slide1" style="background-image:url('<?php echo base_url($s->image); ?>');">
                                    <div class="caption">
                                        <div class="container">
                                            <div class="div-table">
                                                <div class="div-cell text-center">
                                                    <div class="caption-content">
                                                        <h2 class="caption-title line-hgt">LOOKING FOR GREAT GIFT IDEAS?</h2><br>
														<a class="signup-email" href="<?php echo base_url();?>home/signup"><i class="glyphicon glyphicon-envelope"></i><span>Sign Up with Email</span></a>
														<a class="signin-facebook" href="/users/auth/facebook"><i class="fa fa-facebook"></i><span>Sign In with Facebook</span></a>
                                                        <h3 class="caption-subtitle">LET US HELP!</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php } ?>
                                <!-- /Slides -->
                            </div>
                        </div>

                    </div>
                </section>
                <!-- /PAGE -->

                <!-- PAGE -->
                <section class="page-section">
                    <div class="container">
                        <div class="row">
						<?php foreach($banners as $b) { ?>
                            <div class="col-md-6">
                                <div class="thumbnail thumbnail-banner size-1x3">
                                    <div class="media">
                                        <a class="media-link" href="<?php echo base_url('home/products/'.$b->slideUrl); ?>">
                                            <div class="img-bg" style="background-image: url('<?php echo base_url($b->image); ?>')"></div>
                                            <div class="caption">
                                                <div class="caption-wrapper div-table">
                                                    <div class="caption-inner div-cell">
                                                        <h2 class="caption-title"><span><?php echo $b->title;?></span></h2>
                                                        <span class="btn btn-theme btn-theme-sm">Shop Now</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
							<?php } ?>
                        </div>
                    </div>
                </section>
                <!-- /PAGE -->

                <!-- PAGE -->
                <section class="page-section">
                    <div class="container">

                        <div class="tabs">
                            <ul id="tabs" class="nav nav-justified-off"><!--
                                --><li class=""><a href="#tab-1" data-toggle="tab">Top Sellers</a></li><!--
                                --><li class="active"><a href="#tab-2" data-toggle="tab">Newest</a></li><!--
                                --><li class=""><a href="#tab-3" data-toggle="tab">Featured</a></li>
                            </ul>
                        </div>

                        <div class="tab-content">

                            <!-- tab 1 -->
                            <div class="tab-pane fade" id="tab-1">
                                <div class="row">
								<?php foreach($sellers as $s) { ?>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
								<?php foreach($sellers as $r) { ?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="thumbnail">
                                            <div class="media">
                                                <a href="<?php echo $r->product_link; ?>" target="_blank">
                                                    <img src="<?php echo $r->image; ?>" alt="" class="hgt"/>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="<?php echo $r->product_link; ?>" target="_blank"><?php echo $r->name;?></a></h4>
                                               <div class="price"><ins>$<?php echo $r->price;?></ins></div>
                                            </div>
                                        </div>
										
                                    </div>
								<?php } ?>
                                </div>
                            </div>

                            <!-- tab 2 -->
                            <div class="tab-pane fade active in" id="tab-2">
                                <div class="row">
								<?php foreach($newest as $n) { ?>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
								<?php foreach($newest as $r) { ?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="thumbnail">
                                            <div class="media">
                                                <a href="<?php echo $r->product_link; ?>" target="_blank">
                                                    <img src="<?php echo $r->image; ?>" alt="" class="hgt"/>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="<?php echo $r->product_link; ?>" target="_blank"><?php echo $r->name;?></a></h4>
                                               <div class="price"><ins>$<?php echo $r->price;?></ins></div>
                                            </div>
                                        </div>
                                    </div>
								<?php } ?>
                                </div>
                            </div>

                            <!-- tab 3 -->
                            <div class="tab-pane fade" id="tab-3">
                                <div class="row">
								<?php foreach($featured as $f) { ?>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
								<?php foreach($featured as $r) { ?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="thumbnail">
                                            <div class="media">
                                                <a href="<?php echo $r->product_link; ?>" target="_blank">
                                                    <img src="<?php echo $r->image; ?>" alt="" class="hgt"/>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="<?php echo $r->product_link; ?>" target="_blank"><?php echo $r->name;?></a></h4>
                                               <div class="price"><ins>$<?php echo $r->price;?></ins></div>
                                            </div>
                                        </div>
                                    </div>
									<?php }?>
                                  </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!-- /PAGE -->

                <!-- PAGE -->
                <section class="page-section">
                    <div class="container">
                        <div class="message-box">
                            <div class="message-box-inner">
                                <h2>Free shipping on all orders over $45</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /PAGE -->

                <!-- PAGE -->
                <section class="page-section">
                    <div class="container">
                        <h2 class="section-title"><span>Top Rated Products</span></h2>
                        <div class="top-products-carousel">
                            <div class="owl-carousel" id="top-products-carousel">
							<?php foreach($products as $r) { ?>
                                 <div class="thumbnail sm">
									<div class="media">
										<a href="<?php echo $r->product_link; ?>" target="_blank">
											<img src="<?php echo $r->image; ?>" alt="" class="hgt"/>
										</a>
									</div>
									<div class="caption text-center">
										<h4 class="caption-title"><a href="<?php echo $r->product_link; ?>" target="_blank"><?php echo $r->name;?></a></h4>
									   <div class="price"><ins>$<?php echo $r->price;?></ins></div>
									</div>
								</div>
								<?php } ?>
                               </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /PAGE -->

                <!-- PAGE -->
                <section class="page-section">
                    <div class="container">
                        <a class="btn btn-theme btn-title-more btn-icon-left" href="#"><i class="fa fa-file-text-o"></i>See All Posts</a>
                        <h2 class="block-title"><span>Our Recent posts</span></h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="recent-post">
                                    <div class="media">
                                        <a class="pull-left media-link" href="#">
                                            <img class="media-object" src="<?php echo base_url(); ?>assets/img/preview/blog/recent-post-1.jpg" alt="">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <div class="media-body">
                                            <p class="media-category"><a href="#">Shoes</a> / <a href="#">Dress</a></p>
                                            <h4 class="media-heading"><a href="#">Standard Post Comment Header Here</a></h4>
                                            Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante.
                                            <div class="media-meta">
                                                6th June 2014
                                                <span class="divider">/</span><a href="#"><i class="fa fa-comment"></i>27</a>
                                                <span class="divider">/</span><a href="#"><i class="fa fa-heart"></i>18</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="recent-post">
                                    <div class="media">
                                        <a class="pull-left media-link" href="#">
                                            <img class="media-object" src="<?php echo base_url(); ?>assets/img/preview/blog/recent-post-2.jpg" alt="">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <div class="media-body">
                                            <p class="media-category"><a href="#">Wedding</a> / <a href="#">Meeting</a></p>
                                            <h4 class="media-heading"><a href="#">Standard Post Comment Header Here</a></h4>
                                            Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante.
                                            <div class="media-meta">
                                                6th June 2014
                                                <span class="divider">/</span><a href="#"><i class="fa fa-comment"></i>27</a>
                                                <span class="divider">/</span><a href="#"><i class="fa fa-heart"></i>18</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="recent-post">
                                    <div class="media">
                                        <a class="pull-left media-link" href="#">
                                            <img class="media-object" src="<?php echo base_url(); ?>assets/img/preview/blog/recent-post-3.jpg" alt="">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <div class="media-body">
                                            <p class="media-category"><a href="#">Children</a> / <a href="#">Kids</a></p>
                                            <h4 class="media-heading"><a href="#">Standard Post Comment Header Here</a></h4>
                                            Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante.
                                            <div class="media-meta">
                                                6th June 2014
                                                <span class="divider">/</span><a href="#"><i class="fa fa-comment"></i>27</a>
                                                <span class="divider">/</span><a href="#"><i class="fa fa-heart"></i>18</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="recent-post">
                                    <div class="media">
                                        <a class="pull-left media-link" href="#">
                                            <img class="media-object" src="<?php echo base_url(); ?>assets/img/preview/blog/recent-post-4.jpg" alt="">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <div class="media-body">
                                            <p class="media-category"><a href="#">Man</a> / <a href="#">Accessories</a></p>
                                            <h4 class="media-heading"><a href="#">Standard Post Comment Header Here</a></h4>
                                            Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante.
                                            <div class="media-meta">
                                                6th June 2014
                                                <span class="divider">/</span><a href="#"><i class="fa fa-comment"></i>27</a>
                                                <span class="divider">/</span><a href="#"><i class="fa fa-heart"></i>18</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /PAGE -->

            </div>
            <!-- /CONTENT AREA -->

            <!-- FOOTER -->
            <footer class="footer">
                <div class="footer-widgets">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="widget">
                                    <h4 class="widget-title">About Us</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sollicitudin ultrices suscipit. Sed commodo vel mauris vel dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <ul class="social-icons">
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="widget">
                                    <h4 class="widget-title">News Letter</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <form action="#">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Enter Your Mail and Get $10 Cash"/>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-theme btn-theme-transparent">Subscribe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="widget widget-categories">
                                    <h4 class="widget-title">Information</h4>
                                    <ul>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Delivery Information</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                        <li><a href="#">Terms and Conditions</a></li>
                                        <li><a href="#">Private Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="widget widget-tag-cloud">
                                    <h4 class="widget-title">Item Tags</h4>
                                    <ul>
                                        <li><a href="#">Fashion</a></li>
                                        <li><a href="#">Jeans</a></li>
                                        <li><a href="#">Top Sellers</a></li>
                                        <li><a href="#">E commerce</a></li>
                                        <li><a href="#">Hot Deals</a></li>
                                        <li><a href="#">Supplier</a></li>
                                        <li><a href="#">Shop</a></li>
                                        <li><a href="#">Theme</a></li>
                                        <li><a href="#">Website</a></li>
                                        <li><a href="#">Isamercan</a></li>
                                        <li><a href="#">Themeforest</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="footer-meta">
                    <div class="container">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="copyright">Copyright 2014 BELLA SHOP   |   All Rights Reserved   |   Designed By Jthemes</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="payments">
                                    <ul>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/visa.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/mastercard.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/paypal.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/american-express.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/visa-electron.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/maestro.jpg" alt=""/></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </footer>
            <!-- /FOOTER -->

            <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

        </div>
        <!-- /WRAPPER -->

        <!-- JS Global -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/superfish.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.sticky.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.smoothscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/smooth-scrollbar.min.js"></script>

        <!-- JS Page Level -->
        <script src="<?php echo base_url(); ?>assets/js/theme.js"></script>

        <!--[if (gte IE 9)|!(IE)]><!-->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery.cookie.js"></script>
        <!--<script src="assets/js/theme-config.js"></script>-->
        <!--<![endif]-->

    </body>

<!-- Mirrored from eazzy.me/html/bella-men/index-style-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 May 2017 10:01:55 GMT -->
</html>