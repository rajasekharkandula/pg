<!DOCTYPE html>
<html lang="en">
  
<?php echo $head; ?>
  
  <body>
    <div class="be-wrapper be-fixed-sidebar">
	
      <?php echo $header; ?>
	  
	  <div class="be-content">
        <div class="main-content container-fluid">
			
			<div class="row">
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">API Configuration</span></div>
                <div class="panel-body">
                  <form class="form-horizontal" id="api_form">
                    <div class="form-group">
                      <label class="col-sm-3">Name <span>*</span></label>
                      <div class="col-sm-6">
                        <input req="true" type="text" class="form-control" name="name" value="<?php if(isset($api->name))echo $api->name; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3">Key <span>*</span></label>
                      <div class="col-sm-6">
                        <input req="true" type="text" class="form-control" name="key" value="<?php if(isset($api->apiKey))echo $api->apiKey; ?>">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="col-sm-3">API Test Url <span>*</span>
						<br>(Product List URL)
					  </label>
                      <div class="col-sm-6">
                        <input req="true" type="text" class="form-control" id="testURL">
                      </div>
					  <div class="4">
						<button class="btn btn-sm" type="button" id="fetch">Fetch</button>
                      </div>
                    </div>
					
					<div class="url_div" id="url_div">
						<?php $i=0;foreach($api_url as $u){ ?>
							<div class="box url" id="urlbox_<?php echo $i; ?>">
								<div class="form-group">
								  <label class="col-sm-3">Name <span>*</span></label>
								  <div class="col-sm-6">
									<input req="true" type="text" class="form-control" name="name_<?php echo $i; ?>" value="<?php echo $u->name; ?>">
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-sm-3">Url <span>*</span></label>
								  <div class="col-sm-6">
									<input req="true" type="text" class="form-control" name="url_<?php echo $i; ?>" value="<?php echo $u->apiUrl; ?>">
								  </div>
								</div>
								<div class="remove" data-count="<?php echo $i; ?>"><i class="mdi mdi-delete"></i> Remove</div>
							</div>
						<?php $i++; } ?>
                    </div>
					<div class="form-group">
                      <label class="col-sm-3">&nbsp;</label>
                      <div class="col-sm-6">
                       <button class="btn btn-primary btn-sm" type="button" id="add_url"><i class="mdi mdi-plus"></i> Add URL</button>
                      </div>
                    </div>
					
					
					<div class="col-sm-12 text-center">
                        <button class="btn btn-primary btn-lg" type="button" id="submit_btn">Submit</button>
                        <a href="<?php echo base_url('admin/api'); ?>" class="btn btn-default btn-lg">Cancel</a>
                    </div>
				  </form>
                </div>
              </div>
            </div>
          </div>
			
		</div>
      </div>
      
	  
    </div>
	<?php echo $footer; ?>
   
    <script type="text/javascript">
      $(document).ready(function(){
		App.init();
      	App.dataTables();
      });
	  $("#fetch").on("click",function(){
		var apiUrl = $("#testURL").val();
		$.ajax({
			url:'<?php echo base_url('admin/validate_url');?>',
			type:'POST',
			data:{'apiUrl':apiUrl},
			dataType:'JSON'
		}).success(function(data){
			
		});
	  });
	  $("#add_url").on("click",function(){
		  var count = $("#url_div .url").length;
		  
		  var html = '<div class="box url" id="urlbox_'+count+'">'+
						'<div class="form-group">'+
						  '<label class="col-sm-3">Name <span>*</span></label>'+
						  '<div class="col-sm-6">'+
							'<input req="true" type="text" class="form-control" name="name_'+count+'">'+
						  '</div>'+
						'</div>'+
						'<div class="form-group">'+
						  '<label class="col-sm-3">Url <span>*</span></label>'+
						  '<div class="col-sm-6">'+
							'<input req="true" type="text" class="form-control" name="url_'+count+'">'+
						  '</div>'+
						'</div>'+
						'<div class="remove" data-count="'+count+'"><i class="mdi mdi-delete"></i> Remove</div>'+
					'</div>';
		$("#url_div").append(html);
		
	  });
	  $(document).on("click",".remove",function(){
		  var count = $(this).data("count");
		  $("#urlbox_"+count).remove();
	  });
	  $("#submit_btn").on("click",function(){
		var error=0;$(".text-danger").remove();
		$("#api_form input").each(function(){
			if($(this).attr("req") == "true" && $(this).val().trim() == ""){
				error++;
				$(this).parent().append('<div class="text-danger">This field is required</div>');
			}
		});
		if(error == 0){
			$("#submit_btn").attr("disabled",true);
			var formData = new FormData($("#api_form")[0]);
			<?php if(isset($api->id)){ ?>
			formData.append('type','UPDATE');
			formData.append('id','<?php echo $api->id;?>');
			<?php }else{ ?>
			formData.append('type','INSERT');
			<?php } ?>
			formData.append('count',$("#url_div .url").length);
			$.ajax({
				url:'<?php echo base_url('admin/ins_upd_api');?>',
				type:'POST',
				data:formData,
				dataType:'JSON',
				cache: false,
				contentType: false,
				processData: false
			}).success(function(data){
				
				if(data.status){
					$.notify({ message: data.message },{type: 'success'});
					setTimeout(function(){window.location = '<?php echo base_url(); ?>admin/api';},2000);
				}else{
					$.notify({ message: data.message },{type: 'danger'});
				}
			});
		}
	  });
	  
    </script>
	
  </body>

</html>