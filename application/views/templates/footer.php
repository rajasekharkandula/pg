<footer>
	<div class="container">
	   <div class="copyright">Copyright 2017 Painlessgift | All Rights Reserved </div>
	</div>
</footer>

<div class="sticky-sidebar">
	<a href="" > Personal Shopper Assistant</a>
</div>
<div id="modal-questions" tabindex="-1" role="dialog" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">Welcome to the World of Painless gifting.<br> To make the shopping experience
		  seemless, please answer a few questions.
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
				<?php $i=1;foreach($questions as $q){ ?>
					<div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
					<h3><?php echo $q->question; ?></h3>
					<p><textarea rows="4" cols="50"></textarea></p>
					
				<?php $i++; } ?>
              <div class="xs-mt-50">
                <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>
                <button type="button" class="btn btn-space btn-danger" id="delete_btn">Proceed</button>
              </div>
            </div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
<!-- Profile Modal -->
<div class="modal fade" id="gift_modal" role="dialog">
		
</div>
<!--profile Modal -->

<!-- JS Global -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/js/bootstrap-notify.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/fileupload.js"></script>
<!-- JS Page Level -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

<script>
$(document).ready(function(){
$("#modal-questions").modal("show");
      });
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
		