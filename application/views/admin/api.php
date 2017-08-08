<!DOCTYPE html>
<html lang="en">
  
<?php echo $head; ?>
  
  <body>
    <div class="be-wrapper be-fixed-sidebar">
	
      <?php echo $header; ?>
	  
	  <div class="be-content">
        <div class="main-content container-fluid">
			
			<div class="row">
            <div class="col-md-6">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">API Configuration</span></div>
                <div class="panel-body">
                  <form class="form-horizontal" id="api_form">
                    <div class="form-group">
                      <label class="col-sm-3">Name <span>*</span></label>
                      <div class="col-sm-9">
                        <input req="true" type="text" class="form-control" name="name" value="<?php if(isset($api->name))echo $api->name; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3">Key <span>*</span></label>
                      <div class="col-sm-9">
                        <input req="true" type="text" class="form-control" name="key" value="<?php if(isset($api->apiKey))echo $api->apiKey; ?>">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="col-sm-3">Test URL <span>*</span></label>
                      <div class="col-sm-9">
                        <input req="true" type="text" class="form-control" id="testUrl" name="testURL" value="<?php if(isset($api->testUrl))echo $api->testUrl; ?>">
                      </div>
					</div>
					
					<div class="form-group">
                      <label class="col-sm-3">JSON Root Path <span>*</span></label>
                      <div class="col-sm-9">
                        <input req="true" type="text" class="form-control" id="rootPath" name="rootPath" value="<?php if(isset($api->rootPath))echo $api->rootPath; ?>">
                      </div>
					</div>
					
					<div class="form-group">
                      <label class="col-sm-3">ID<span>*</span></label>
                      <div class="col-sm-9">
                        <input req="true" type="text" class="form-control" placeholder="JSON Product ID depth" id="id_depth" name="id_depth" value="<?php if(isset($api->id_depth))echo $api->id_depth; ?>">
                      </div>
					</div>
					<div class="form-group">
                      <label class="col-sm-3">Name<span>*</span></label>
                      <div class="col-sm-9">
                        <input req="true" type="text" class="form-control" placeholder="JSON Product Name Depth" name="name_depth" id="name_depth" value="<?php if(isset($api->name_depth))echo $api->name_depth; ?>">
                      </div>					  
					</div>
					<div class="form-group">
                      <label class="col-sm-3">Image<span>*</span></label>
                      <div class="col-sm-9">
                        <input req="true" type="text" class="form-control" placeholder="JSON Product Image Depth" name="image_depth" id="image_depth" value="<?php if(isset($api->image_depth))echo $api->image_depth; ?>">
                      </div>
					</div>
					<div class="form-group">
                      <label class="col-sm-3">Product URL<span>*</span></label>
                      <div class="col-sm-9">
                        <input req="true" type="text" class="form-control" placeholder="JSON Product URL Depth" name="url_depth" id="url_depth" value="<?php if(isset($api->url_depth))echo $api->url_depth; ?>">
                      </div>
					</div>
					<div class="form-group">
                      <label class="col-sm-3">Price<span>*</span></label>
                      <div class="col-sm-9">
                        <input req="true" type="text" class="form-control" placeholder="JSON Product Price Depth" name="price_depth" id="price_depth" value="<?php if(isset($api->price_depth))echo $api->price_depth; ?>">
                      </div>
					</div>
					
					<div class="url_div" id="url_div">
						<?php $i=0;foreach($api_url as $u){ ?>
							<div class="box url" id="urlbox_<?php echo $i; ?>">
								<div class="form-group">
								  <label class="col-sm-2">Name <span>*</span></label>
								  <div class="col-sm-9">
									<input req="true" type="text" class="form-control" name="name_<?php echo $i; ?>" value="<?php echo $u->name; ?>">
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-sm-2">Url <span>*</span></label>
								  <div class="col-sm-9">
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
			<div class="col-md-6">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">API Response</span></div>
                <div class="panel-body">
					<pre class="api_response" id="api_response">
						
					</pre>
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
	  $("#testUrl").on("blur",function(){
		$("#api_response").html("");
		$("#api_response").addClass("loading");
		$.ajax({
			url:'<?php echo base_url('admin/get_api_response');?>',
			type:'POST',
			data:{'testURL':$("#testUrl").val()},
			dataType:'JSON'
		}).success(function(data){
			try {
				var data = JSON.stringify(JSON.parse(data),null,2);  
			} catch (e) {
				var data = JSON.stringify(data,null,2);  
			}
			
			$("#api_response").html(data);
			$("#api_response").removeClass("loading");
		});
	  });
	  $("#submit_btn").on("click",function(){
		
		var error=0;$(".text-danger").remove();
		$("#api_form input").each(function(){
			if($(this).attr("req") == "true" && $(this).val().trim() == ""){
				error++;
				$(this).parent().append('<div class="text-danger">This field is required</div>');
			}
		});
		
		var testURL = $("#testUrl").val();
		var rootPath = $("#rootPath").val();
		var id_depth = $("#id_depth").val();
		var name_depth = $("#name_depth").val();
		var image_depth = $("#image_depth").val();
		var url_depth = $("#url_depth").val();
		var price_depth = $("#price_depth").val();
		if(error == 0){
			$("#submit_btn").attr("disabled",true);
			$("#submit_btn").html('<i class="fa fa-refresh fa-spin"></i> Please wait...');
			$.ajax({
				url:'<?php echo base_url('admin/validate_url');?>',
				type:'POST',
				data:{'testURL':testURL,'rootPath':rootPath,'id_depth':id_depth,'name_depth':name_depth,'image_depth':image_depth,'url_depth':url_depth,'price_depth':price_depth},
				dataType:'JSON'
			}).success(function(data){
				
				if(data.status == 1)
					$.notify({ message: data.message },{type: 'success'});				
				else
					$.notify({ message: data.message },{type: 'danger'});					
				
				$("input").removeClass("has-error");
				$("input").removeClass("has-success");					
				
				if(data.product.id == true){
					$("#id_depth").addClass("has-success");
				}else{
					$("#id_depth").addClass("has-error");
					error++;
					$("#id_depth").parent().append('<div class="text-danger">Invalid</div>');
				}
				
				if(data.product.name == true){					
					$("#name_depth").addClass("has-success");
				}else{
					$("#name_depth").addClass("has-error");
					error++;
					$("#name_depth").parent().append('<div class="text-danger">Invalid</div>');
				}
				
				if(data.product.image == true){					
					$("#image_depth").addClass("has-success");
				}else{
					$("#image_depth").addClass("has-error");
					error++;
					$("#image_depth").parent().append('<div class="text-danger">Invalid</div>');
				}
				
				if(data.product.url == true){					
					$("#url_depth").addClass("has-success");
				}else{
					$("#url_depth").addClass("has-error");
					error++;
					$("#url_depth").parent().append('<div class="text-danger">Invalid</div>');
				}
				
				if(data.product.price == true){					
					$("#price_depth").addClass("has-success");
				}else{
					$("#price_depth").addClass("has-error");
					error++;
					$("#price_depth").parent().append('<div class="text-danger">Invalid</div>');
				}
				
				if(data.status == 1){
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
				}else{
					$("#submit_btn").removeAttr("disabled");
					$("#submit_btn").html("Submit");
				}
				
			});
		}
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
	 
	  
    </script>
	
  </body>

</html>