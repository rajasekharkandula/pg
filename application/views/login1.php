<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<title>Painlessgift</title>
		
	</head>
	<body>
		<form id="login-form">
			<div class="form-group">
				<input type="text" name="email" id="email" placeholder="Email">
			</div>
			<div class="form-group">
				<input type="password" name="password" id="password" placeholder="Password">
			</div>
			<button type="button" id="signin">Signin</button>
			<a href="signup"><button type="button" id="signin">Signup</button></a>
		</form>
		<script src="../assets/js/jquery-1.9.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#signin").on("click", function(){
				//alert("ok");
				var email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				var email = $("#email").val();
				//alert(email);exit();
				var password = $("#password").val();
				var error=0;
				if(email == ''){
					error++;
					$("#email").parent().append('<div style="color:blue;">This field is required</div>');
				}
				if(!email_regex.test($("#email").val()) && $("#email").val() != ''){
					error++;
					$("#email").parent().append('<div style="color:blue;">Invalid Email.</div>');
				}
				if(password == ''){
					error++;
					$("#password").parent().append('<div style="color:blue;">This field is rquired</div>');
				}
							
				if(error == 0){
					//var formdata = new FormData($("#login-form")[0]);
					$.ajax({
						url:'loginCheck',
						type:'POST',
						dataType:'JSON',
						data:{'email':email,'password':password}
					}).success(function(data){
						if(data.message == 'Success')
							alert("Login Successfully");
							window.location.reload();
					});
				}
				
			});
		});
	</script>
	</body>
</html>