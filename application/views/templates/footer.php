<footer>
	<div class="container">
	   <div class="copyright">Copyright 2017 Painlessgift | All Rights Reserved </div>
	</div>
</footer>

<!-- Profile Modal -->
<div class="modal fade" id="gift_modal" role="dialog">
		
</div>
<!--profile Modal -->

<!-- JS Global -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/js/fileupload.js"></script>
<!-- JS Page Level -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

<script>
	$("#search_form").on("submit",function(e){
		e.preventDefault();
		$("#search").trigger("click");
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
		