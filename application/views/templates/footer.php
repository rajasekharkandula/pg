<footer>
	<div class="container">
	   <div class="copyright">Copyright 2017 Painlessgift | All Rights Reserved </div>
	</div>
</footer>

<div class="sticky-sidebar">
	<?php if($this->session->userdata('logged_in')){ ?>
	<a href="#" data-toggle="modal" data-target="#modal-questions"> Personal Shopper Assistant</a>
	<?php }else{ ?>
	<a href="<?php echo base_url('home/signin'); ?>"> Personal Shopper Assistant</a>
	<?php } ?>
</div>
<div id="modal-questions" tabindex="-1" role="dialog" class="modal fade saq" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div id="questions">
			  <div class="modal-header">
				<div class="hc">Welcome to the World of Painless gifting. To make the shopping experience seemless, please answer a few questions.</div>            
			  </div>
			  <div class="modal-body">
				<?php $i=1;foreach($data['questions'] as $q){ ?>
					<div class="sa">
						<div class="qt"><?php echo $i.'. '.$q->question; ?></div>
						<textarea name="answers" data-qid="<?php echo $q->id; ?>"></textarea>
					</div>
				<?php $i++; } ?>
			  </div>
		  
			  <div class="mt-10 text-center">
				<hr>
				<button type="button" class="btn btn-space btn-success" id="next_btn">Next</button>
				<button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>
			  </div>
		  </div>
		  <div id="payment" class="hide">
			  <div class="modal-header">
				<div class="hc">Payment</div>            
			  </div>
			  <div class="modal-body">
				<!-- CREDIT CARD FORM STARTS HERE -->
				<div class="panel panel-default credit-card-box">
					<div class="panel-heading display-table" >
					<div class="row display-tr" >
					<h3 class="panel-title display-td" >Payment Details</h3>
					<div class="display-td" >                            
					<img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
					</div>
					</div>                    
					</div>
					<div class="panel-body">
					<form role="form" id="payment-form">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label for="cardNumber">CARD NUMBER</label>
								<div class="input-group">
									<input type="tel" class="form-control" name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number" required autofocus />
									<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
								</div>
							</div>                            
						</div>
					</div>
					<div class="row">
						<div class="col-xs-7 col-md-7">
						<div class="form-group">
						<label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
						<input 
						type="tel" 
						class="form-control" 
						name="cardExpiry"
						placeholder="MM / YY"
						autocomplete="cc-exp"
						required 
						/>
						</div>
						</div>
						<div class="col-xs-5 col-md-5 pull-right">
							<div class="form-group">
								<label for="cardCVC">CV CODE</label>
								<input type="tel" class="form-control" name="cardCVC" placeholder="CVC" autocomplete="cc-csc"
								required />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label for="couponCode">COUPON CODE</label>
								<input type="text" class="form-control" name="couponCode" />
							</div>
						</div>                        
					</div>
					<div class="row">
						<div class="col-xs-12">
							<button class="btn btn-success btn-lg btn-block" type="button" id="proceed_btn">Proceed Free</button>			
						</div>
					</div>
					<div class="row" style="display:none;">
						<div class="col-xs-12">
							<p class="payment-errors"></p>
						</div>
					</div>
					</form>
					</div>
				</div>            
				<!-- CREDIT CARD FORM ENDS HERE -->
				<div class="text-center"><button class="btn btn-default" type="button" data-dismiss="modal">Close</button></div>
			  </div>
		  
		</div>
		  <br>
        </div>
      </div>
    </div>
<!-- Profile Modal -->
<div class="modal fade" id="gift_modal" role="dialog">
		
</div>
<!--profile Modal -->

<!-- JS Global -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/js/bootstrap-notify.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/admin/lib/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/lib/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $this->config->item('node_server_url').'/socket.io/socket.io.js'; ?>"></script>
<!-- JS Page Level -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

<script>
	var socket = io.connect('<?php echo $this->config->item('node_server_url'); ?>');
	socket.on('new_message', function (data) {
		$.notify({ message: 'ok' },{type: 'success'});
	});
</script>

<script>
	$(document).ready(function(){
		//$("#modal-questions").modal("show");
		$(".datatable").dataTable({
			
		});
	});
	$("#search_form").on("submit",function(e){
		e.preventDefault();
		$("#search").trigger("click");
	});
	$("#next_btn").on("click",function(){
		var error = 0;var answers = [];
		$(".text-danger").remove();
		$("#modal-questions textarea").each(function(){
			var obj = $(this);
			if(obj.val().trim() == ""){
				error++;
				obj.parent().append('<div class="text-danger">This field is required</div>');
			}
		});
		if(error == 0){
			$("#questions").addClass("hide");
			$("#payment").removeClass("hide");
		}
	});
	$("#proceed_btn").on("click",function(){
		var error = 0;var answers = [];
		$(".text-danger").remove();
		$("#modal-questions textarea").each(function(){
			var obj = $(this);
			if(obj.val().trim() == ""){
				error++;
				obj.parent().append('<div class="text-danger">This field is required</div>');
			}else{
				var answer = [];
				answer[0] = obj.data('qid');
				answer[1] = obj.val().trim();
				answers.push(answer);
			}
		});
		if(error == 0){
			$("#proceed_btn").attr('disabled',true);
			$("#proceed_btn").html('<i class="fa fa-spinner fa-spin"></i>');
			$.ajax({
				url:'<?php echo base_url('home/ins_upd_user_answers');?>',
				type:'POST',
				data:{'answers':answers},
				dataType:'JSON'
			}).done(function(data){
				if(data.status == 1){
					$("#modal-questions .modal-content").html('<div class="text-center" style="padding:20px;"><p class="text-success">Your request has been submitted successsfully. Our shopping assistent will contact you soon. </p> <button class="btn" type="button" data-dismiss="modal" >Close</button></div>');
					
					//Sending notification
					socket.emit('server_new_request', { image:data.image, message:data.message});
				}else{
					$("#modal-questions .modal-content").html('<div class="text-center" style="padding:20px;"><p class="text-danger">There were some error while submitting your request. Please try again later or contact admin </p> <button class="btn" type="button" data-dismiss="modal" >Close</button></div>');
				}
				
			});
		}
	});
	$("#search").on("click",function(){
		var key = $("#key").val();
		var search_type = $("#search_type").val();
		var url = '<?php echo base_url('home'); ?>';
		if(search_type == 'product')
			url+='/products?key='+key;
		else if(search_type == 'user')
			url+='/users?key='+key;
		window.location = url;
	});
</script>
<script>
	$(".like").on("click",function(){
		var obj = $(this);
		var id = obj.data("id");
		<?php if($this->session->userdata('logged_in') == true){ ?>
		$.ajax({
			url:'<?php echo base_url('home/ins_upd_like');?>',
			type:'POST',
			data:{'id':id},
			dataType:'JSON'
		}).done(function(data){	
			if(data)
				obj.html('<i class="fa fa-heart"></i>');
			else
				obj.html('<i class="fa fa-heart-o"></i>');
			window.location.reload();
		});
		<?php }else{ ?>
		window.location = '<?php echo base_url('home/signin'); ?>';
		<?php } ?>
	});
	$(".gift").on("click",function(){
		var obj = $(this);
		var id = obj.data("id");
		<?php if($this->session->userdata('logged_in') == true){ ?>
		$.ajax({
			url:'<?php echo base_url('home/get_gift_modal');?>',
			type:'POST',
			data:{'id':id,'type':'GIFT'},
			dataType:'HTML'
		}).done(function(data){	
			$("#gift_modal").html(data);
			$("#gift_modal").modal("show");
		});
		<?php }else{ ?>
		window.location = '<?php echo base_url('home/signin'); ?>';
		<?php } ?>
	});
	$(document).on("click",".cp li",function(){
		var obj = $(this);
		var id = obj.data("id");
		var productID = obj.data("pid");
		$.ajax({
			url:'<?php echo base_url('home/ins_upd_gift');?>',
			type:'POST',
			data:{'id':id,'productID':productID},
			dataType:'JSON'
		}).success(function(data){
			if(data){
				obj.addClass('active');
			}else{
				window.location.reload();
				obj.removeClass('active');
			}
		});
	});
</script>
		