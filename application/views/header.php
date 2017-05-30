 <!-- PRELOADER -->
<div id="preloader">
<div id="preloader-status">
	<div class="spinner">
		<div class="rect1"></div>
		<div class="rect2"></div>
		<div class="rect3"></div>
		<div class="rect4"></div>
		<div class="rect5"></div>
	</div>
	<div id="preloader-title">Loading</div>
</div>
</div>
<!-- /PRELOADER -->

<!-- WRAPPER -->
<div class="wrapper">

<!-- Popup: Shopping cart items -->
<div class="modal fade popup-cart" id="popup-cart" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="container">
			<div class="cart-items">
				<div class="cart-items-inner">
					<div class="media">
						<a class="pull-left" href="#"><img class="media-object item-image" src="<?php echo base_url(); ?>assets/img/preview/shop/order-1s.jpg" alt=""></a>
						<p class="pull-right item-price">$450.00</p>
						<div class="media-body">
							<h4 class="media-heading item-title"><a href="#">1x Standard Product</a></h4>
							<p class="item-desc">Lorem ipsum dolor</p>
						</div>
					</div>
					<div class="media">
						<p class="pull-right item-price">$450.00</p>
						<div class="media-body">
							<h4 class="media-heading item-title summary">Subtotal</h4>
						</div>
					</div>
					<div class="media">
						<div class="media-body">
							<div>
								<a href="#" class="btn btn-theme btn-theme-dark" data-dismiss="modal">Close</a><!--
								--><a href="shopping-cart.html" class="btn btn-theme btn-theme-transparent btn-call-checkout">Checkout</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Popup: Shopping cart items -->

 <!-- Header top bar -->
	<div class="top-bar">
		<div class="container">
			<div class="top-bar-left">
				<ul class="list-inline">
				<?php if($this->session->userdata("logged_in") == true) { ?>
					
					<li class="icon-user"><a href="<?php echo base_url(); ?>home/profile"><img src="<?php echo base_url(); ?>assets/img/icon-1.png" alt=""/> <span><?php if($this->session->userdata("firstName")) echo $this->session->userdata("firstName");else echo $this->session->userdata("email");?></span></a></li>
				<?php } else { ?>
				<li class="icon-user"><a href="<?php echo base_url(); ?>home/login"><img src="<?php echo base_url(); ?>assets/img/icon-1.png" alt=""/> <span>Login</span></a></li>
				<?php } ?>
				<?php if($this->session->userdata("logged_in") == true) { ?>
					<li class="icon-user text-right"><a href="<?php echo base_url(); ?>home/logout"><img src="<?php echo base_url(); ?>assets/img/icon-1.png" alt=""/> <span>Logout</span></a></li>
				<?php } else { ?>
					<li class="icon-user text-right hide"><a href="<?php echo base_url(); ?>home/logout"><img src="<?php echo base_url(); ?>assets/img/icon-1.png" alt=""/> <span>Logout</span></a></li>
				<?php } ?>
					<?php if($this->session->userdata("logged_in") == true) { ?>
						<li class="icon-form hide"><a href="<?php echo base_url(); ?>home/signup"><img src="<?php echo base_url(); ?>assets/img/icon-2.png" alt=""/> <span>Not a Member? <span class="colored">Sign Up</span></span></a></li>
					<?php } else { ?>
						<li class="icon-form"><a href="<?php echo base_url(); ?>home/signup"><img src="<?php echo base_url(); ?>assets/img/icon-2.png" alt=""/> <span>Not a Member? <span class="colored">Sign Up</span></span></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
<!-- /Header top bar -->
 <!-- HEADER -->
            <header class="header">
                <div class="header-wrapper">
                    <div class="container">

                        <!-- Logo -->
                        <div class="logo">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="Painlessgift"/></a>
                        </div>
                        <!-- /Logo -->

                        <!-- Header search -->
                        <div class="header-search">
                            <input class="form-control" type="text" placeholder="What are you looking?" id="search"/>
							<div class="dropdown">
								<i onclick="myFunction()" class="fa fa-search dropbtn" id="puser"></i> 
								  <div id="myDropdown" class="dropdown-content">
									<span value="products">Products</span>
									<span value="users">Users</span>
								  </div>
							</div>
                            <!--<button><i class="fa fa-search"></i></button>-->
                        </div>
                        <!-- /Header search -->

                        <!-- Header shopping cart  -->
                        <div class="header-cart">
                            <div class="cart-wrapper">
                                
                                <!-- Mobile menu toggle button  -->
                                <a href="#" class="menu-toggle btn btn-theme-transparent"><i class="fa fa-bars"></i></a>
                                <!-- /Mobile menu toggle button  -->
                            </div>
                        </div>
                        <!-- Header shopping cart -->

                    </div>
                </div>
                <div class="navigation-wrapper">
                    <div class="container">
                        <!-- Navigation -->
                        <nav class="navigation header-nav-1 closed clearfix">
                            <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
							
                            <ul class="nav sf-menu">
								<?php foreach($menu as $m) { 
									if((int)$m->parent_id == 0){
								?>
									<li class=""><a href="<?php echo base_url();?>home/products/<?php echo $m->slug;?>"><?php echo strtoupper($m->name);?></a>
										<ul>
											<?php foreach($menu as $cm) { 
												if($cm->parent_id == $m->id){
												?>
											<li><a href="<?php echo base_url();?>home/products/<?php echo $cm->slug;?>"><?php echo strtoupper($cm->name);?></a></li>
											<?php } } ?>
										</ul>
									</li>
								<?php } } ?>
                                <li><a href="category.html">STORIES & ADVICE</a></li>
                                <li><a href="<?php echo base_url();?>home/contact">CONTACT US</a></li>
                            </ul>
							
                        </nav>
                        <!-- /Navigation -->
                    </div>
                </div>
				<script>
				/* When the user clicks on the button, 
				toggle between hiding and showing the dropdown content */
				function myFunction() {
					document.getElementById("myDropdown").classList.toggle("show");
				}

				// Close the dropdown if the user clicks outside of it
				window.onclick = function(event) {
				  if (!event.target.matches('.dropbtn')) {

					var dropdowns = document.getElementsByClassName("dropdown-content");
					var i;
					for (i = 0; i < dropdowns.length; i++) {
					  var openDropdown = dropdowns[i];
					  if (openDropdown.classList.contains('show')) {
						openDropdown.classList.remove('show');
					  }
					}
				  }
				}
				
				
				</script>
</header>
<!-- /HEADER -->