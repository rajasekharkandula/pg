<?php $pageTitle = isset($pageTitle)?$pageTitle:''; ?>
<?php $page = isset($page)?$page:''; ?>
<nav class="navbar navbar-default navbar-fixed-top be-top-header">
	<div class="container-fluid">
	  <div class="navbar-header"><a href="<?php echo base_url('shopper'); ?>" class="navbar-brand"></a>
	  </div>
	  <div class="be-right-navbar">
		<ul class="nav navbar-nav navbar-right be-user-nav">
		  
		  
		  <li class="dropdown">
			<a href="#" data-toggle="dropdown">
			<i class="icon mdi mdi-notifications"></i>
			</a>
			<ul class="dropdown-menu nt">
						
				<li>No messages</li>
			</ul>
		 
		 </li>
		  
		  <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="<?php echo base_url(); ?>/assets/admin/img/avatar.png" alt="Avatar"><span class="user-name">Shopper</span></a>
			<ul role="menu" class="dropdown-menu">
			  <li>
				<div class="user-info">
				  <div class="user-name">Shopper</div>
				</div>
			  </li>
			  <li><a href="<?php echo base_url('home/logout'); ?>"><span class="icon mdi mdi-power"></span> Logout</a></li>
			</ul>
		  </li>
		</ul>
		<div class="page-title hide"><span><?php echo $pageTitle; ?></span></div>
	  
	  </div>
	</div>
</nav>
<div class="be-left-sidebar">
	<div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
	  <div class="left-sidebar-spacer">
		<div class="left-sidebar-scroll">
		  <div class="left-sidebar-content">
			<ul class="sidebar-elements">
			  
			  <li <?php if($page == 'DASHBOARD')echo 'class="active"';?>><a href="<?php echo base_url('shopper'); ?>"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
			  </li>
			  <li <?php if($page == 'NEW')echo 'class="active"';?>><a href="<?php echo base_url('shopper/requests'); ?>"><i class="icon mdi mdi-home"></i><span>New Requests</span> <span class="label"><?php echo $reports['new']; ?></span></a>
			  </li>
			  <li <?php if($page == 'ONGOING')echo 'class="active"';?>><a href="<?php echo base_url('shopper/ongoing'); ?>"><i class="icon mdi mdi-home"></i><span>Ongoing Requests</span> <span class="label"><?php echo $reports['ongoing']; ?></span></a>
			  </li>
			  <li <?php if($page == 'COMPLETED')echo 'class="active"';?>><a href="<?php echo base_url('shopper/completed'); ?>"><i class="icon mdi mdi-home"></i><span>Completed Requests</span> <span class="label"><?php echo $reports['completed']; ?></span></a>
			  </li>
			  
			</ul>
		  </div>
		</div>
	  </div>
	</div>
</div>
