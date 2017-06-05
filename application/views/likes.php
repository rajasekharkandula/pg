<!DOCTYPE html>
<html lang="en">
	
	<!-- HEAD -->
	<?php echo $head; ?>
	<!-- HEAD -->
	
    <body>
        
		<!-- HEADER -->
		<?php echo $header;?>
		<!-- HEADER -->
        
		<section class="profile">
			<div class="container">
				<h2>Liked Gifts <button class="pull-right" id="create_btn">Add Gift</button></h2>
				<div class="row">
						
					<?php foreach($products as $p){ ?>
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<button class="like" data-id="<?php echo $p->id; ?>"><i class="fa fa-heart"></i></button>
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
					
					<?php foreach($gifts as $g){ ?>
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<button class="gift" data-type="USER_GIFT" data-id="<?php echo $g->id; ?>"><i class="fa fa-gift"></i></button>
							<a href="<?php echo $g->link; ?>" target="_blank">
								<div class="img">
									<img src="<?php echo $g->image; ?>">
								</div>
								<div class="content">
									<div class="title"><?php echo $g->name; ?></div>
									<div class="price"><?php echo $this->config->item('currency'); ?><?php echo $g->price; ?></div>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
					
				</div>
					
			</div>			
		</section>
		
		<!-- Profile Modal -->
			<div class="modal fade" id="gift_modal" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-body">
					<div class="row">
					  <div class="col-sm-12">
						<form id="gift_form">
							<input type="hidden" name="id" id="gid" value="0">
							<input type="hidden" name="type" id="gtype" value="INSERT">
							<div class="form-group">
								<label>Gift Name:</label>
								<input class="form-control" placeholder="Gift Name" type="text" name="name" id="gname">
							</div>
							<div class="form-group">
								<label>Gift Price:</label>
								<input class="form-control" placeholder="Gift Price" type="text" name="price" id="gprice">
							</div>
							<div class="form-group">
								<label>Gift Link:</label>
								<input class="form-control" placeholder="Gift Link" type="text" name="link" id="glink">
							</div>
							<div class="form-group">
								<label>Image</label>
								<input type="file" name="image" id="gimage">
							</div>
						 
							<button type="button" id="submit_btn">Submit</button>
							<button type="button" data-dismiss="modal">Cancel</button>
						</form>
						</div>
					</div>
					</div>
				</div>
				  
				</div>
			  </div>
			<!--profile Modal -->
			
		
		<!-- FOOTER -->
		<?php echo $footer; ?>
		<!-- FOOTER -->
		
		<script>
			$("#create_btn").on("click",function(){
				$("#gift_form")[0].reset();
				$("#gtype").val('INSERT');
				$("#gift_modal").modal("show");
			});
			$("#submit_btn").on("click",function(){
				var error=0;$("#gift_form .text-danger,#gift_form .text-success").remove();
				
				$("#gift_form input").each(function(){
					if($(this).val().trim() == ''){
						error++;
						$(this).parent().append('<div class="text-danger">This field is required</div>');
					}
				});
				
				
				if(error == 0){
					$("#submit_btn").attr("disabled",true);
					$("#submit_btn").html("Please wait...");
					var formData = new FormData($("#gift_form")[0]);
					$.ajax({
						url:'<?php echo base_url('home/ins_upd_user_gift');?>',
						type:'POST',
						data:formData,
						dataType:'JSON',
						cache : false,
						contentType : false,
						processData : false
					}).done(function(data){					
						if(data.status == 1){
							$("#gift_form").prepend('<div class="text-success text-center">'+data.message+'</div>');
							window.location.reload();
						}else{
							$("#gift_form").prepend('<div class="text-danger text-center">'+data.message+'</div>');
							$("#submit_btn").removeAttr("disabled");
							$("#submit_btn").html("Submit");
						}
						
					});
				}
			});
		</script>
		
			
    </body>

</html>