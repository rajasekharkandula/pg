<!DOCTYPE html>
<html lang="en">
	
	<!-- HEAD -->
	<?php echo $head; ?>
	<!-- HEAD -->
	
    <body>
        
		<!-- HEADER -->
		<?php echo $header;?>
		<!-- HEADER -->
        
		<section class="login">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-5 col-sm-6 text-center">
						<form class="login_form" id="login_form">
							<h3>Login</h3>
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="email" class="form-control" placeholder="Enter email...">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" id="password" class="form-control" placeholder="Enter password...">
							</div>
							<div class="form-group">
								<button type="button" id="login_btn">Login</button>
								<p class="forgot_link">Forgot Password ?</p>
							</div>
						</form>
					</div>
					<div class="col-md-5 col-sm-6 text-center divider">
						<button class="fb"><i class="fa fa-facebook"></i> Sign In with Facebook</button><br>
						<button class="gmail"><i class="fa fa-envelope"></i> Sign Up with Email</button>
					</div>
				</div>
			</div>                        
		</section>
		
		<!-- FOOTER -->
		<?php echo $footer; ?>
		<!-- FOOTER -->
		
		<script>
			$("#login_btn").on("click",function(){
				var error=0;$(".login_form .text-danger").remove();
				if($("#email").val() == ''){
					error++;
					$("#email").parent().append('<div class="text-danger">This field is required</div>');
				}
				if($("#password").val() == ''){
					error++;
					$("#password").parent().append('<div class="text-danger">This field is required</div>');
				}
				if(error == 0){
					$("#login_btn").attr("disabled",true);
					$("#login_btn").html("Please wait...");
					$.ajax({
						url:'<?php echo base_url('home/login');?>',
						type:'POST',
						data:{'email':$("#email").val(),'password':$("#password").val()},
						dataType:'JSON'
					}).success(function(data){						
						if(data.status == 1)
							window.location = data.url;
						else{
							$('<div class="text-danger">'+data.message+'</div>').insertAfter( "#login_form h3" );
							$("#login_btn").removeAttr("disabled");
							$("#login_btn").html("Login");
						}
					});
				}
			});
		</script>
		
    </body>

</html>