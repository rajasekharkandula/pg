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
			<div class="container">
				<h2><?php if(isset($navigation->name))echo $navigation->name;else echo 'Products'; ?></h2>
				<div class="row">
					<div class="col-md-3">
						<div class="search-box">
							<div class="title">Categories</div>
							<ul>
								<?php foreach($categories as $c){ ?>
								<?php 
									$url = base_url('home/products/'.$navigationSlug);
									$data = array(
										'key' => $key,
										'category' => $c->id,
										'age' => $age,
										'price' => $price
									);
									$url.='?'.http_build_query($data). "\n";
									$url = str_replace('%2C', ',', $url);
								?>
								
								<li><a <?php if($c->id == $category)echo 'class="active"';?> href="<?php echo $url; ?>"><?php echo $c->name; ?></a></li>
								<?php } ?>
							</ul>
							<?php foreach($filterKey as $k){ ?>
							<div class="title"><?php echo $k->filterKey; ?></div>
							<ul>
								<?php foreach($filters as $f){ if($k->filterKey == $f->filterKey){ ?>
								
								<?php 
									$url = base_url('home/products/'.$navigationSlug);
									
									if($k->filterKey == 'age'){
										$data = array(
											'key' => $key,
											'category' => $category,
											'age' => $f->id,
											'price' => $price
										);
									}
									
									if($k->filterKey == 'price'){
										$data = array(
											'key' => $key,
											'category' => $category,
											'age' => $age,
											'price' => $f->id
										);
									}
									
									$url.='?'.http_build_query($data). "\n";
									$url = str_replace('%2C', ',', $url);
								?>
								
								<li><a <?php if($f->id == $price || $f->id == $age)echo 'class="active"';  ?> href="<?php echo $url; ?>"><?php echo $f->name; ?></a></li>
								<?php } } ?>
							</ul>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-9">
						<div class="search-labels">
							
							<?php if($key != NULL){ ?>
								<?php 
									$url = base_url('home/products/'.$navigationSlug);
									$data = array(
										'category' => $category,
										'age' => $age,
										'price' => $price
									);
									$url.='?'.http_build_query($data). "\n";
									$url = str_replace('%2C', ',', $url);
								?>
								<a href="<?php echo $url; ?>">Search key(<?php echo $key; ?>) <i class="fa fa-times"></i></a>
							<?php } ?>
							<?php foreach($categories as $c){ if($c->id == $category){ ?> 
								<?php 
									$url = base_url('home/products/'.$navigationSlug);
									$data = array(
										'age' => $age,
										'price' => $price
									);
									$url.='?'.http_build_query($data). "\n";
									$url = str_replace('%2C', ',', $url);
								?>
								<a href="<?php echo $url; ?>"><?php echo $c->name; ?> <i class="fa fa-times"></i></a>
							<?php } } ?>
							<?php foreach($filters as $f){ if($f->id == $age || $f->id == $price){ ?>
								
								<?php 
									$url = base_url('home/products/'.$navigationSlug);
									
									if($f->filterKey == 'age'){
										$data = array(
											'category' => $category,
											'price' => $price
										);
									}
									
									if($f->filterKey == 'price'){
										$data = array(
											'category' => $category,
											'age' => $age
										);
									}
									
									$url.='?'.http_build_query($data). "\n";
									$url = str_replace('%2C', ',', $url);
								?>
								
								<a href="<?php echo $url; ?>"><?php echo $f->filterKey.'('.$f->name.')'; ?> <i class="fa fa-times"></i></a>
							<?php } } ?>
						</div>
						<?php if(count($products) > 0){ ?>
						<div class="row plist">
							<?php foreach($products as $p){ ?>
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<button class="like" data-id="<?php echo $p->id; ?>"><?php if($p->liked > 0){?><i class="fa fa-heart"></i><?php }else{ ?><i class="fa fa-heart-o"></i><?php } ?></button>
									<button class="gift" data-id="<?php echo $p->id; ?>"><i class="fa fa-gift"></i></button>
									<a href="<?php echo $p->product_link; ?>" target="_blank">
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
						<?php }else{ ?>
						<h4>No products found</h4>
						<?php } ?>
					</div>
				</div>
			</div>			
		</section>
		
		<!-- FOOTER -->
		<?php echo $footer; ?>
		<!-- FOOTER -->
		
		
    </body>

</html>