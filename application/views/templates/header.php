<input type="hidden" id="path" value="<?php echo base_url(); ?>">
<header>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-2 col-xs-4">
					<div class="logo">
						<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo" /></a>
					</div>
				</div>
				<div class="col-md-6 col-sm-7 col-xs-12 m-search text-center">
					<form id="search_form">
						<div class="search">
							<input class="search-input" type="text" name="key" id="key" placeholder="Search for products" value="<?php if(isset($search_key)){if($search_key != NULL)echo $search_key;} ?>">
							<select id="search_type">
								<option value="product" <?php if(isset($search_type))if($search_type == 'product')echo 'selected';?>>Products</option>
								<option value="user" <?php if(isset($search_type))if($search_type == 'user')echo 'selected';?>>Users</option>
							</select>
							<button type="button" id="search">Search</button>
						</div>
					</form>
				</div>
				<div class="col-md-3 col-sm-3 text-right">
					<?php if($this->session->userdata('logged_in') == true){ ?>
						<div class="user-info hidden-xs">
							<img src="<?php echo base_url('assets/images/user.jpg'); ?>">
							<div class="name"><?php echo $this->session->userdata('name'); ?> <i class="fa fa-angle-down"></i></div>
							<ul class="dropdown-list">
								<li><a href="<?php echo base_url();?>home/profiles"><i class="fa fa-users"></i> Profiles</a></li>
								<li><a href="<?php echo base_url();?>home/likes"><i class="fa fa-gift"></i> Liked Gifts</a></li>
								<li><a href="<?php echo base_url();?>home/reset_password"><i class="fa fa-key"></i> Reset Pasword</a></li>
								<li><a href="<?php echo base_url();?>home/profile"><i class="fa fa-cog"></i> Settings</a></li>
								<li><a href="<?php echo base_url();?>home/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
							</ul>
						</div>
					<?php }else{ ?>
					<div class="login-section hidden-xs">
						<a href="<?php echo base_url('home/signup'); ?>">Register</a>
						<a href="<?php echo base_url('home/signin'); ?>">Sign in</a>
					</div>
					<?php } ?>
					<button class="navigation visible-xs" id="mh-view"><i class="fa fa-bars"></i></button>
					<button class="navigation visible-xs" id="ms-view"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="sub-header hidden-xs">
		<div class="container text-center">
			<ul>
				<?php foreach($data as $m){ if($m->parent_id == 0){ ?>
				<li class="dropdown">
					
					<?php if($m->navigation_type == 'page'){ ?>
					<a href="<?php echo base_url('home/page/'.$m->page_id);?>"><?php echo $m->name; ?> </a>
					<?php }else if($m->navigation_type == 'custom'){ ?>
					<a href="<?php echo $m->navigation_link; ?>"><?php echo $m->name; ?> </a>
					<?php }else if($m->navigation_type == 'product'){ ?>
					<a href="<?php echo base_url();?>home/products/<?php echo $m->slug;?>"><?php echo $m->name; ?> <i class="fa fa-angle-down"></i></a>
					<ul class="dropdown-list">
						<?php foreach($data as $cm) { if($cm->parent_id == $m->id){ ?>
						<li><a href="<?php echo base_url();?>home/products/<?php echo $cm->slug;?>"><?php echo $cm->name;?> </a></li>
						<?php } } ?>
					</ul>
					<?php } ?>
				</li>
				<?php } } ?>
			</ul>
		</div>
	</div>
</header>
<div class="m-header hide" id="m-header">
	<div class="m-inner" id="m-inner">
		
		<?php if($this->session->userdata('logged_in') == true){ ?>
		<div class="m-user">
			<img src="<?php echo base_url('assets/images/user.jpg'); ?>">
			<div class="name"><?php echo $this->session->userdata('name'); ?></div>
			<div class="logout"><a href="<?php echo base_url();?>home/logout">Logout <i class="fa fa-sign-out"></i></a></div>
			<ul>
				<li><a href="<?php echo base_url();?>home/profiles"><i class="fa fa-users"></i> Profiles</a></li>
				<li><a href="<?php echo base_url();?>home/likes">| <i class="fa fa-gift"></i> Likes</a></li>
				<li><a href="<?php echo base_url();?>home/profile">| <i class="fa fa-cog"></i> Settings</a></li>
				<li><a href="<?php echo base_url();?>home/reset_password">| <i class="fa fa-key"></i> Reset</a></li>
			</ul>
		</div>
		<?php }else{ ?>
		<div class="login-section">
			<a href="<?php echo base_url('home/signup'); ?>">Register</a>
			<a href="<?php echo base_url('home/signin'); ?>">Sign in</a>
		</div>
		<?php } ?>
		
		<ul class="m-list">
			<?php foreach($data as $m){ if($m->parent_id == 0){ ?>
			<li class="dropdown">
				
				<?php if($m->navigation_type == 'page'){ ?>
				<a href="<?php echo base_url('home/page/'.$m->page_id);?>"><?php echo $m->name; ?> </a>
				<?php }else if($m->navigation_type == 'custom'){ ?>
				<a href="<?php echo $m->navigation_link; ?>"><?php echo $m->name; ?> </a>
				<?php }else if($m->navigation_type == 'product'){ ?>
				<span class="toggle"><i class="fa fa-angle-down"></i></span>
				<a href="<?php echo base_url();?>home/products/<?php echo $m->slug;?>"><?php echo $m->name; ?> </a>
				<ul class="dropdown-list">
					<?php foreach($data as $cm) { if($cm->parent_id == $m->id){ ?>
					<li><a href="<?php echo base_url();?>home/products/<?php echo $cm->slug;?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $cm->name;?> </a></li>
					<?php } } ?>
				</ul>
				<?php } ?>
			</li>
			<?php } } ?>
		</ul>
		
	</div>
</div>










