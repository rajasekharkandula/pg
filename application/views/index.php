<!DOCTYPE html>
<html lang="en">
	
	<!-- HEAD -->
	<?php echo $head; ?>
	<!-- HEAD -->
	
    <body>
        
		<!-- HEADER -->
		<?php echo $header;?>
		<!-- HEADER -->
        
		<section>
			<div class="owl-carousel">
				<?php foreach($slides as $s) { ?>
				<div class="item slide" style="background-image:url('<?php echo base_url($s->image); ?>');">
					<div class="container">
						<div class="caption">
							<h2>LOOKING FOR GREAT GIFT IDEAS?</h2>
							<a class="signup-email" href="<?php echo base_url();?>home/signup">
								<i class="fa fa-envelope"></i> <span>Sign Up with Email</span>
							</a>
							<a class="signin-facebook" href="/users/auth/facebook">
								<i class="fa fa-facebook"></i> <span>Sign In with Facebook</span>
							</a>
							<h2>LET US HELP!</h2>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>                        
		</section>
		
		<section class="home-banners">
			<div class="container">
				<div class="row">
					
					<?php foreach($banners as $b){ ?>
					<div class="col-md-6">
						<div class="thumbnail thumbnail-banner size-1x3">
							<div class="media">
								<a class="media-link" href="<?php echo base_url($b->slideUrl); ?>">
									<div class="img-bg" style="background-image: url('<?php echo base_url($b->image); ?>')"></div>
									<div class="caption">
										<div class="caption-wrapper div-table">
											<div class="caption-inner">
												<h2 class="caption-title"><span><?php echo $b->title; ?></span></h2>
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
		
		<?php foreach($sections as $s){ ?>
		<section class="padding-30">
			<div class="container">
				<h2 class="title"><?php echo $s['name']; ?> <a href="#" class="view-more hide"> View More <i class="fa fa-caret-right"></i></a></h2>
				<div class="row hlist">
					<?php foreach($s['products'] as $p){ ?>
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<button class="like" data-id="<?php echo $p->id; ?>"><?php if($p->liked > 0){?><i class="fa fa-heart"></i><?php }else{ ?><i class="fa fa-heart-o"></i><?php } ?></button>
							<button class="gift" data-id="<?php echo $p->id; ?>"><i class="fa fa-gift"></i></button>
							<a href="<?php echo $p->product_link; ?>">
								<div class="img">
									<img src="<?php echo $p->image; ?>">
								</div>
								<div class="content">
									<div class="title"><?php echo $p->name; ?></div>
									<div class="price"><?php echo $this->config->item('currency'); ?><?php echo $p->price; ?></div>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<?php } ?>
		
		<section class="padding-30">
			<div class="container">
				<h2 class="title">Our Recent Posts</h2>
				<div class="row">
					<div class="col-md-6">
						<div class="recent-post">
							<div class="media">
								<a class="pull-left media-link" href="#">
									<img class="media-object" src="http://edujana.com/painlessgift/assets/img/preview/blog/recent-post-1.jpg" alt="">
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#">Standard Post Comment Header Here</a></h4>
									Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante.Sed non lorem varius, volutpat nisl in, laoreet ante.
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
									<img class="media-object" src="http://edujana.com/painlessgift/assets/img/preview/blog/recent-post-1.jpg" alt="">
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#">Standard Post Comment Header Here</a></h4>
									Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante.Sed non lorem varius, volutpat nisl in, laoreet ante.
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
									<img class="media-object" src="http://edujana.com/painlessgift/assets/img/preview/blog/recent-post-1.jpg" alt="">
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#">Standard Post Comment Header Here</a></h4>
									Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante.Sed non lorem varius, volutpat nisl in, laoreet ante.
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
									<img class="media-object" src="http://edujana.com/painlessgift/assets/img/preview/blog/recent-post-1.jpg" alt="">
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#">Standard Post Comment Header Here</a></h4>
									Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante.Sed non lorem varius, volutpat nisl in, laoreet ante.
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
		
		<!-- FOOTER -->
		<?php echo $footer; ?>
		<!-- FOOTER -->

    </body>

</html>