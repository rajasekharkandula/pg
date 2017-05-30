<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from eazzy.me/html/bella-men/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 May 2017 09:59:50 GMT -->
<head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Painlessgift</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/ico/logo.png">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/logo.ico">

        <!-- CSS Global -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/prettyPhoto.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/owl.theme.default.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/theme-green-1.css" rel="stylesheet" id="theme-config-link">

        <!-- Head Libs -->
        <script src="<?php echo base_url(); ?>assets/plugins/modernizr.custom.js"></script>

        <!--[if lt IE 9]>
        <script src="assets/plugins/iesupport/html5shiv.js"></script>
        <script src="assets/plugins/iesupport/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="home" class="wide header-style-1">
        
            <!-- /HEADER -->
			<?php echo $header;?>
            <!-- /HEADER -->

            <!-- CONTENT AREA -->
            <div class="content-area">
                <section class="page-section">
                    <div class="wrap container">
                        <div class="row">
                            <!--start main contain of page-->
                            <div class="col-lg-9 col-md-9 col-sm-8 tab-content mt-0">
								<div class="tab-pane fade active in" id="tab-1">
									<div class="information-title">Your Account Information</div>
									<div class="details-wrap">
										<div class="block-title alt "> <i class="fa fa-angle-down"></i> Change Your Personal Details</div>
										<div class="details-box">
											<form class="form-delivery" action="#" id="profileDetails">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<div class="form-group"><input required type="text" name="firstName" placeholder="First Name" class="form-control" value="<?php if(isset($account->first_name)) echo $account->first_name;?>"></div>
													</div>
													<div class="col-md-6 col-sm-6">
														<div class="form-group"><input required type="text" name="lastName" placeholder="Last Name" class="form-control" value="<?php if(isset($account->last_name))echo $account->last_name;?>"></div>
													</div>                                                                                                 
													<div class="col-md-6 col-sm-6">
														<div class="form-group"><input required type="text" name="email" placeholder="Email" class="form-control" value="<?php if(isset($account->email)) echo $account->email;?>"></div>
													</div>
													<div class="col-md-6 col-sm-6">
														<div class="form-group"><input required type="text" name="phone" placeholder="Phone Number" class="form-control" value="<?php if(isset($account->phone)) echo $account->phone;?>"></div>
													</div>  
													<div class="col-md-12 col-sm-12">
														<button class="btn btn-theme btn-theme-dark" type="submit" id="update"> Update </button>
													</div>
												</div>
											</form>
										</div>
									</div>  
								</div>
								<div class="tab-pane fade" id="tab-2">
									<div class="information-title">Your Password</div>
									<div class="details-wrap">
										<div class="block-title alt"> <i class="fa fa-angle-down"></i> Change your password </div>
										<div class="details-box">
											<form class="form-delivery" action="#" id="passwordDet">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<div class="form-group"><input required type="password" name="psw" placeholder="Old Password" class="form-control"></div>
													</div>
													<div class="col-md-6 col-sm-6">
														<div class="form-group"><input required type="password" name="newPsw" id="newpsw" placeholder="New Password" class="form-control"></div>
													</div>
													<div class="col-md-12 col-sm-12">
														<button class="btn btn-theme btn-theme-dark" type="submit" id="changePsw"> Update </button>
													</div>
												</div>
											</form>
										</div>
									</div>    
								</div>
								<div class="tab-pane fade" id="tab-3">
									<div class="information-title">Your Profile and Gifts</div>
									<div class="details-wrap">
										<div class="block-title alt"> <i class="fa fa-angle-down"></i> User Liked Gifts </div>
										<div class="details-box p-20">
											<div class="row">
												<?php foreach($gifts as $g) { ?>
													<div class="col-md-3 media">
														<a href="<?php if(isset($g->link)) echo $g->link;?>" class="" target="_blank"><img src="<?php if(isset($g->image)) echo $g->image;?>" class="gift-img "></a>
														<a class="btn-profile cboxElement gift-like" href="#login-modal">
															<i class="fa fa-gift"></i>
														</a>
														<div class="title">
															<a target="_blank" href="ZXC"><?php if(isset($g->name)) echo $g->name;?></a>
														</div>
														<div class="price">
															$<?php if(isset($g->price)) echo $g->price;?>
														</div>
													</div>
												<?php } ?>
											</div>
											<?php foreach($profile as $p) { ?>
											<div class="profile-title">
												<?php if(isset($p->name)) echo "Gifts for &nbsp;". $p->name;?>
												<span style="font-size: 18px; font-weight: normal;">
												&nbsp;&nbsp;
												<?php if(isset($p->reason)) echo "Reason for Gift:&nbsp;". $p->reason;?>
												&nbsp;&nbsp;
												<?php if(isset($p->date_for_gift)) echo "Date for Gift:&nbsp;".$p->date_for_gift;?>
												&nbsp;&nbsp;
												<?php if(isset($p->relation)) echo "Relation To You:&nbsp;". $p->relation;?>
												</span>
													<div class="row" style="margin-top:0px;">
													<?php foreach($profileGifts as $pg) { if($pg->custom_profile_id == $p->id){ ?>
														<div class="col-md-3 media">
															<a href="<?php if(isset($pg->link)) echo $pg->link;?>" class="" target="_blank"><img src="<?php if(isset($pg->image)) echo $pg->image;?>" class="gift-img "></a>
															<a class="btn-profile cboxElement gift-like" href="#login-modal">
																<i class="fa fa-gift"></i>
															</a>
															<div class="title">
																<a target="_blank" href="ZXC" style="font-size: 14px;"><?php if(isset($pg->name)) echo $pg->name;?></a>
															</div>
															<div class="price" style="font-size: 14px;">
																$<?php if(isset($pg->price)) echo $pg->price;?>
															</div>
														</div>
													<?php } } ?>
													</div>
												  <div>
													<a class="update-profile btn btn-primary cboxElement" id=<?php echo $p->id;?>>Edit</a>
													<button class="remove-profile btn btn-danger" remove_url="/accounts/39/custom_profiles/15/remove_all_product" id=<?php echo $p->id;?>>Remove</button>
												  </div>
											  </div>
											 <?php } ?>
											<a class="create-gift btn btn-primary cboxElement" href="#new_gift" data-toggle="modal" data-target="#new_gift">Add Gift</a>
											<a class="create-gift btn btn-primary cboxElement" href="#new_profile" data-toggle="modal" data-target="#new_profile">Create Profile</a>
										</div>
									</div>    
								</div>
                            </div>
                            <!--end main contain of page-->

                            <!--start sidebar-->
                            <div class="col-lg-3 col-md-3 col-sm-4">
                                <div class="widget account-details">
                                    <h2 class="widget-title">Account</h2>
                                    <ul>
                                        <li class="active"><a href="#tab-1" data-toggle="tab"> Account Information </a></li>   
                                        <li><a href="#tab-2" data-toggle="tab">Change Password</a></li>
                                        <li><a href="#tab-3" data-toggle="tab">Profile & Gifts</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--end sidebar-->
                        </div>

                    </div>
                </section>
            </div>
            <!-- /CONTENT AREA -->
			 <!-- Gift Modal -->
			  <div class="modal fade" id="new_gift" role="dialog" style="padding-top: 60px;">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-body" style="padding-top:0px;">
					  <div class="col-sm-12 form-group" style="margin-top: 23px;">
					  <button type="button" id="cboxClose" data-dismiss="modal" style="top:-15px;">close</button>
					  <form id="giftinfo">
						  <div class="form-group">
							<label style="font-weight: bold;" for="gift_name">Gift Name:</label>
							<input class="form-control" placeholder="Gift Name" required="required" type="text" name="giftname" id="gift_name">
						  </div>
						  <div class="form-group">
							<label style="font-weight: bold;" for="gift_price">Gift Price:</label>
							<input class="form-control" placeholder="Gift Price" type="number" required="required" name="giftprice" id="gift_price">
						  </div>
						  <div class="form-group">
							<label style="font-weight: bold;" for="gift_link">Gift Link:</label>
							<input class="form-control" placeholder="Gift Link" required="required" type="text" name="giftlink" id="gift_link">
						  </div>
						  <div class="form-group">
							<label style="font-weight: bold;" for="gift_image">Gift Image:</label>
							<input required="required" type="file" name="giftimage" id="gift_image">
						  </div>
						  <input type="submit" name="commit" value="Create" class="btn btn-primary" id="createGift" style="margin-bottom: 3px;">
						 </form>
						</div>
					</div>
					<div class="modal-footer" style="border:0px;"></div>
				  </div>
				  
				</div>
			  </div>
			  <!--Gift Modal -->
			  <!-- Profile Modal -->
			  <div class="modal fade" id="new_profile" role="dialog" style="padding-top: 60px;">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-body" style="padding-top:0px;">
					  <div class="col-sm-12 form-group" style="margin-top: 23px;">
					  <button type="button" id="cboxClose" data-dismiss="modal" style="top:-15px;">close</button>
						 <form id="create_profile">
						  <div class="form-group">
							<label style="font-weight: bold;" for="custom_profile_name">Profile Name:</label>
							<input class="form-control" placeholder="Profile Name" type="text" name="name" id="name" value="<?php if(isset($updateprofile['name'])) echo $updateprofile['name'];?>"reuired>
						  </div>
						  
						  <div class="form-group">
							<label style="font-weight: bold;" for="custom_profile_reason">Reason for Gift:</label>
							<select class="form-control" name="reason" id="reason" style="width: 160px;">
							  <option value="birthday">Birthday</option>
							  <option value="anniversary">Anniversary</option>
							  <option value="valentines_day">Valentines Day</option>
							</select>
						  </div>
						  <div class="form-group">
							<label style="font-weight: bold;" for="custom_profile_name">Date For Gift:</label>
							<input class="col-md-3 form-control" placeholder="Profile Name" type="date"  name="datetime" id="datetimepicker">
						  </div>
						  <div class="form-group">
							<label style="font-weight: bold;" for="custom_profile_relation">Relation To You:</label>
							<select class="form-control" name="relation" id="relation" style="width: 160px;">
								<option value="friend">Friend</option>
									<option value="significant">Significant Other</option>
									<option value="mom">Mom</option>
									<option value="dad">Dad</option>
									<option value="brother">Brother</option>
									<option value="sister">Sister</option>
									<option value="niece">Daughter/Niece</option>
									<option value="nephew">Son/Nephew</option>
									<option value="other">Other</option>
							</select>
						  </div>
						  <input type="submit" name="commit" value="Create" class="btn btn-primary" id="createProfile" style="margin-bottom: 3px;">
						  </form>
						</div>
					</div>
					<div class="modal-footer" style="border:0px;"></div>
				  </div>
				  
				</div>
			  </div>
			  <!--profile Modal -->
            <!-- FOOTER -->
            <footer class="footer">
                <div class="footer-widgets">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="widget">
                                    <h4 class="widget-title">About Us</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sollicitudin ultrices suscipit. Sed commodo vel mauris vel dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <ul class="social-icons">
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="widget">
                                    <h4 class="widget-title">News Letter</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <form action="#">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Enter Your Mail and Get $10 Cash"/>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-theme btn-theme-transparent">Subscribe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="widget widget-categories">
                                    <h4 class="widget-title">Information</h4>
                                    <ul>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Delivery Information</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                        <li><a href="#">Terms and Conditions</a></li>
                                        <li><a href="#">Private Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="widget widget-tag-cloud">
                                    <h4 class="widget-title">Item Tags</h4>
                                    <ul>
                                        <li><a href="#">Fashion</a></li>
                                        <li><a href="#">Jeans</a></li>
                                        <li><a href="#">Top Sellers</a></li>
                                        <li><a href="#">E commerce</a></li>
                                        <li><a href="#">Hot Deals</a></li>
                                        <li><a href="#">Supplier</a></li>
                                        <li><a href="#">Shop</a></li>
                                        <li><a href="#">Theme</a></li>
                                        <li><a href="#">Website</a></li>
                                        <li><a href="#">Isamercan</a></li>
                                        <li><a href="#">Themeforest</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="footer-meta">
                    <div class="container">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="copyright">Copyright 2014 BELLA SHOP   |   All Rights Reserved   |   Designed By Jthemes</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="payments">
                                    <ul>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/visa.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/mastercard.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/paypal.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/american-express.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/visa-electron.jpg" alt=""/></li>
                                        <li><img src="<?php echo base_url(); ?>assets/img/preview/payments/maestro.jpg" alt=""/></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </footer>
            <!-- /FOOTER -->

            <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

        </div>
        <!-- /WRAPPER -->

        <!-- JS Global -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/superfish.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.sticky.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.smoothscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/smooth-scrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>

        <!-- JS Page Level -->
        <script src="<?php echo base_url(); ?>assets/js/theme.js"></script>

        <!--[if (gte IE 9)|!(IE)]><!-->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery.cookie.js"></script>
       <!--  <script src="assets/js/theme-config.js"></script> -->
        <!--<![endif]-->
		<script>
		 
			$(document).ready(function(){
				$("#update").click(function(e){
					e.preventDefault();
					var formdata = new FormData($("#profileDetails")[0]);
					$.ajax({
						url :'<?php echo base_url();?>home/updMyAccountDet',
						type :'POST',
						dataType :'JSON',
						data :formdata,
						async :false,
						contentType :false,
						processData :false
					}).done(function(data){
						if(data == true){
							alert("Updated Successfully.");
							window.location.reload();
						}else{
							alert("Updated Fail.");
						}
					});
				});
			});
			$("#changePsw").click(function(){
				var newpsw = $("#newpsw").val();
				$.ajax({
					url :'<?php echo base_url();?>home/updatePassword',
					type :'POST',
					dataType :'JSON',
					data :{'password':newpsw}
				}).done(function(data){
					if(data == true){
						alert("Password Updated Successfully.");
					}else{
						alert("Password Updated Fail.");
					}
					
				});
			});
			$("#createGift").on("click", function(e){
				e.preventDefault();
				var error=0;
				if($("#gift_name").val() == ''){
					error++;
					$("#gift_name").parent().append('<div style="color:blue;">This field is rquired</div>');
				}
				if($("#gift_price").val() == ''){
					error++;
					$("#gift_price").parent().append('<div style="color:blue;">This field is rquired</div>');
				}
				if($("#gift_link").val() == ''){
					error++;
					$("#gift_link").parent().append('<div style="color:blue;">This field is rquired</div>');
				}
				if($("#gift_image").val() == ''){
					error++;
					$("#gift_image").parent().append('<div style="color:blue;">This field is rquired</div>');
				}
				if(error == 0){
					var formdata = new FormData($("#giftinfo")[0]);
					$.ajax({
						url :'<?php echo base_url();?>home/insGiftDet',
						type :'POST',
						dataType :'JSON',
						data :formdata,
						cahe :false,
						contentType :false,
						processData :false
					}).done(function(data){
						if(data == true){
							alert("Created Successfully.");
							window.location.reload();
						}else{
							alert("Creating Fail.");
						}
					});
				}
			});
			$("#createProfile").on("click",function(e){
				e.preventDefault();
				var error = 0;
				if($("#name").val() == ''){
					error++;
					$("#name").parent().append('<div style="color:blue;">This field is rquired</div>');
				}
				if($("#reason").val() == ''){
					error++;
					$("#reason").parent().append('<div style="color:blue;">This field is rquired</div>');
				}
				if($("#datetimepicker").val() == '' || $("#birth_month").val() == 0){
					error++;
					$("#datetimepicker").parent().append('<div style="color:blue;">This field is rquired</div>');
				}
				
				if($("#relation").val() == ''){
					error++;
					$("#relation").parent().append('<div style="color:blue;">This field is rquired</div>');
				}
				if(error == 0){
					var formdata = new FormData($("#create_profile")[0]);
					$.ajax({
						url : '<?php echo base_url();?>home/insProfile',
						type : 'POST',
						dataType : 'JSON',
						data : formdata,
						cache : false,
						contentType : false,
						processData : false
					}).done(function(data){
						if(data == true)
							alert("Profile Created Successfully");
							window.location.reload();
					});
				}
			});
		$(".update-profile").on("click", function(e){
			e.preventDefault();
			var id = $(this).attr("id");
			$.ajax({
				url :'<?php echo base_url();?>home/updateProfile',
				type :'POST',
				dataType :'JSON',
				data :{"id":id}
			}).done(function(data){
				html='';
				if(data){
					html+= '<div class="modal-dialog">'+
								  '<div class="modal-content">'+
									'<div class="modal-body" style="padding-top:0px;">'+
									  '<div class="col-sm-12 form-group" style="margin-top: 23px;">'+
									  '<button type="button" id="cboxClose" data-dismiss="modal" style="top:-15px;">close</button>'+
									 '<form id="edit_profile">'+
									  '<div class="form-group">'+
										'<label style="font-weight: bold;" for="custom_profile_name">Profile Name:</label>'+
										'<input class="form-control" placeholder="Profile Name" type="text" name="name" id="name" value="'+data.name+'">'+
									  '</div>'+
									  '<div class="form-group">'+
										'<label style="font-weight: bold;" for="custom_profile_reason">Reason for Gift:</label>'+
										'<select class="form-control" name="reason" id="reason" style="width: 160px;">';
										  html+='<option value="birthday" ';
										  if(data.reason == "birthday") { html+='selected';}
										  html+='>Birthday</option>';
										 html+='<option value="anniversary"';
										 if(data.reason == "anniversary") { html+='selected';}
										 html+='>Anniversary</option>';
										  html+='<option value="valentines_day"';
										  if(data.reason == "valentines_day") { html+='selected';}
										  html+='>Valentines Day</option>';
										html+='</select>'+
									  '</div>'+
									 '<div class="form-group">'+
										'<label style="font-weight: bold;" for="custom_profile_name">Date For Gift:</label>'+
										'<input class="col-md-3 form-control" placeholder="Date For Gift" type="date"  name="datetime" id="datetimepicker" value="'+data.date_for_gift+'">'+
									  '</div>'+
									'<div class="form-group">'+
										'<label style="font-weight: bold;" for="custom_profile_relation">Relation To You:</label>'+
										'<select class="form-control" name="relation" id="relation" style="width: 160px;">'+
											'<option value="friend">Friend</option>';
												html+='<option value="significant"';
												if(data.relation == "significant"){html+='selected';}
												html+='>Significant Other</option>';
												html+='<option value="mom"';
												if(data.relation == "mom"){html+='selected';}
												html+='>Mom</option>';
												html+='<option value="dad"';
												if(data.relation == "dad"){html+='selected';}
												html+='>Dad</option>';
												html+='<option value="brother"';
												if(data.relation == "brother"){html+='selected';}
												html+='>Brother</option>';
												html+='<option value="sister"';
												if(data.relation == "sister"){html+='selected';}
												html+='>Sister</option>';
												html+='<option value="niece"';
												if(data.relation == "niece"){html+='selected';}
												html+='>Daughter/Niece</option>';
												html+='<option value="nephew"';
												if(data.relation == "nephew"){html+='selected';}
												html+='>Son/Nephew</option>';
												html+='<option value="other"';
												if(data.relation == "other"){html+='selected';}
												html+='>Other</option>';
										html+='</select>'+
									  '</div>'+
									  '<input type="button" name="commit" value="Update" class="btn btn-primary" id="editProfile" pid="'+data.id+'" style="margin-bottom: 3px;">'+
									  '</form>'+
									'</div>'+
								'</div>'+
								'<div class="modal-footer" style="border:0px;"></div>'+
							  '</div>'+
							  '</div>';
						  $("#new_profile").html(html);
						  $('#new_profile').modal('show');
				}
			});
		});
		$(".remove-profile").on("click", function(e){
			e.preventDefault();
			var id = $(this).attr("id");
			$.ajax({
				url :'<?php echo base_url();?>home/removeProfile',
				type :'POST',
				dataType :'JSON',
				data :{"id":id}
			}).done(function(data){
				if(data == true)
					window.location.reload();
			});
		});
		$(document).on("click", "#editProfile", function(e){
			e.preventDefault();
			var formdata = new FormData($("#edit_profile")[0]);
			var id = $(this).attr("pid");
			$.ajax({
				url :'<?php echo base_url();?>home/editProfile/'+id,
				type :'POST',
				dataType :'JSON',
				data :formdata,
				cache : false,
				contentType : false,
				processData : false
			}).done(function(data){
				alert("profile Updated Successfully.");
				window.location.reload();
			});
		});
		/* $(document).ready(function(){
			$( "#datetimepicker" ).datetimepicker();
		  }); */
		</script>

    </body>

<!-- Mirrored from eazzy.me/html/bella-men/accountinformation.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 May 2017 10:00:22 GMT -->
</html>