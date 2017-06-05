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
				<h2>Profile</h2>
				<div class="box">
					<form id="user_form">
					<div class="row mb-10">
						<label class="col-md-3">First Name <span>*</span></label>
						<div class="col-md-6">	
							<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name..." value="<?php echo $user->first_name; ?>">
						</div>
					</div>
					<div class="row mb-10">
						<label class="col-md-3">Last Name <span>*</span></label>
						<div class="col-md-6">	
							<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name..." value="<?php echo $user->last_name; ?>">
						</div>
					</div>
					<div class="row mb-10">
						<label class="col-md-3">Email <span>*</span></label>
						<div class="col-md-6">	
							<input type="text" class="form-control" name="email" id="email" placeholder="Enter email..." value="<?php echo $user->email; ?>">
						</div>
					</div>
					<div class="row mb-20">
						<label class="col-md-3">Phone <span>*</span></label>
						<div class="col-md-6">	
							<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone..." value="<?php echo $user->phone; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-7 text-center">	
							<button type="button" id="save_btn">Save</button>
						</div>
					</div>
					</form>
				</div>
			</div>			
		</section>
		
		<!-- FOOTER -->
		<?php echo $footer; ?>
		<!-- FOOTER -->
		
		<script>
			$("#save_btn").on("click",function(){
				var error=0;$("#user_form .text-danger,#user_form .text-success").remove();
				
				$("#user_form input").each(function(){
					if($(this).val().trim() == ''){
						error++;
						$(this).parent().append('<div class="text-danger">This field is required</div>');
					}
				});
				
				if(error == 0){
					$("#save_btn").attr("disabled",true);
					$("#save_btn").html("Please wait...");
					$.ajax({
						url:'<?php echo base_url('home/update_user');?>',
						type:'POST',
						data:$("#user_form").serialize(),
						dataType:'JSON'
					}).success(function(data){						
						if(data.status == 1)
							$("#user_form").prepend('<div class="text-success text-center">'+data.message+'</div>');
						else{
							$("#user_form").prepend('<div class="text-danger text-center">'+data.message+'</div>');
						}
						$("#save_btn").removeAttr("disabled");
						$("#save_btn").html("Save");
					});
				}
			});
		</script>
		
			
    </body>

</html>