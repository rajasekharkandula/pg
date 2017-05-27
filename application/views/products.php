<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from eazzy.me/html/bella-men/category.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 May 2017 10:01:05 GMT -->
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
        <link href="<?php echo base_url(); ?>assets/css/jquery.countdown.css" rel="stylesheet">

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
		.hgt{height:360px !important;}
		.product-hgt{height:235px !important;}
		.top-rate{height:220px !important;}
		</style>
    </head>
    <body id="home" class="wide header-style-1">
        
			<!-- HEADER -->
			<?php echo $header;?>
			<!-- HEADER -->
            <!-- CONTENT AREA -->
            <div class="content-area">

                <!-- BREADCRUMBS -->
                <section class="page-section breadcrumbs">
                    <div class="container">
                        <div class="page-header">
                            <h1><?php if(isset($categoryName->name))echo $categoryName->name;?></h1>
                        </div>
                    </div>
                </section>
                <!-- /BREADCRUMBS -->

                <!-- PAGE WITH SIDEBAR -->
                <section class="page-section with-sidebar">
                    <div class="container">
                        <div class="row">
                            <!-- SIDEBAR -->
                            <aside class="col-md-3 sidebar" id="sidebar">
                                <!-- widget search -->
                                <div class="widget">
                                    <div class="widget-search">
                                        <input class="form-control" type="text" placeholder="Search">
                                        <button><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <!-- /widget search -->
                                <!-- widget shop categories -->
                                <div class="widget shop-categories">
                                    <h4 class="widget-title">Filters</h4>
                                    <div class="widget-content">
                                        <ul>
											<?php foreach($filterKey as $ck) { ?>
												<li>
													<span class="arrow"><i class="fa fa-angle-down"></i></span>
													<a href="#"><?php echo $ck->filterKey;?></a>
													<ul class="children">
														<?php foreach($filters as $c) { 
															if($ck->filterKey == $c->filterKey) {
														?>
														<li>
															<?php $url = base_url('home/products'); 
															if($categorySlug != '' && $categorySlug != NULL)
																$url.='/'.$categorySlug;
															if($filterIDs != '' && $filterIDs != NULL)
																$url.='?fid='.$filterIDs.','.$c->id;
															else
																$url.='?fid='.$c->id;
															?>
															<a href="<?php echo $url;?>"><?php echo $c->name;?>
															</a>
														</li>
														<?php } } ?>
													</ul>
												</li>
											<?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /widget shop categories -->
                            </aside>
                            <!-- /SIDEBAR -->
                            <!-- CONTENT -->
                            <div class="col-md-9 content" id="content">
                                <!-- Products grid -->
                                <div class="row products grid">
								<?php foreach($products as $fhp) { ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="thumbnail no-border no-padding">
                                            <div class="media">
                                                <a class="media-link products-border" href="#">
                                                    <img src="<?php echo base_url($fhp->image); ?>" alt="" class="product-hgt"/>
                                                </a>
												<a class="btn-like like btn-like-not-loggedin cboxElement" href="#login-modal">
													<i class="fa fa-heart"></i>
												</a>
												<a class="btn-profile cboxElement" href="#login-modal">
													<i class="fa fa-gift"></i>
												</a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><?php echo $fhp->name;?></h4>
                                                 <div class="price"><ins>$<?php echo $fhp->price;?></div>
                                            </div>
                                        </div>
                                    </div>
									<?php } ?>
                                </div>
                                <!-- /Products grid -->
                            </div>
                            <!-- /CONTENT -->

                        </div>
                    </div>
                </section>
                <!-- /PAGE WITH SIDEBAR -->

               

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
        <script src="<?php echo base_url(); ?>assets/js/jquery.plugin.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.countdown.min.js"></script>
        <!-- JS Page Level -->
        <script src="<?php echo base_url(); ?>assets/js/theme.js"></script>

        <!--[if (gte IE 9)|!(IE)]><!-->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery.cookie.js"></script>
        <!--<![endif]-->

    </body>

<!-- Mirrored from eazzy.me/html/bella-men/category.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 May 2017 10:01:34 GMT -->
</html>