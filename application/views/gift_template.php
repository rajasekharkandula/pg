<div class="modal-dialog gift_modal">
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-body">
			<div class="row">
			   <div class="col-sm-6">
					<div class="box">
						<img src="<?php echo $product->image; ?>" id="pdimage" style="width:100%;">
						<h4 id="pdname" class="pdname"><?php echo $product->name; ?></h4>
						<div id="pdprice" class="pdprice">$<?php echo $product->price; ?></div>
					</div>
			   </div>
			   <div class="col-sm-6">
				
				<h3 class="title">Pick a Profile <button class="pclose pull-right" data-dismiss="modal"><i class="fa fa-times"></i></button></h3>
				<ul class="cp">
					<?php foreach($profiles as $p){ ?>
					<li <?php if($p->selected > 0)echo 'class="active"'; ?> data-id="<?php echo $p->id; ?>" data-pid="<?php echo $product->id; ?>"> <?php echo $p->name; ?> <i class="fa fa-times"></i></li>
					<?php } ?>
				</ul>
			   </div>
			</div>
		</div>
	</div>
</div>