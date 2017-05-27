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
                <div class="panel-heading panel-heading-divider">Product Configuration</span></div>
                <div class="panel-body">
                  <form class="form-horizontal" id="product_form">
                    
					<div class="form-group">
                      <label class="col-md-1" style="padding-right:0px;">Select API <span>*</span></label>
                      <div class="col-md-3">
                       <select class="select2" data-placeholder="Select" id="api">
							<option></option>
							<?php foreach($api as $a){ ?>
							<option value="<?php echo $a->id; ?>"><?php echo $a->name; ?></option>
							<?php } ?>
					   </select>
                      </div>
                      <label class="col-md-1" style="padding-right:0px;">Select URL <span>*</span></label>
                      <div class="col-md-3">
                       <select class="select2" data-placeholder="Select" id="url">
							<option></option>
					   </select>
                      </div>
					  <div class="col-md-2">
                        <button class="btn btn-primary btn-lg" type="button" id="fetch_btn">Fetch</button>
                      </div>
					</div>	
					
					</form>
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="row hide" id="products_list">
          </div>
          
			
		</div>
      </div>
      
	  
    </div>
	<?php echo $footer; ?>
   
    <script type="text/javascript">
      $(document).ready(function(){
		App.init();
		App.formElements();
		App.textEditors();
		//App.dataTables();
      
	  $("#api").on("change",function(){
		var apiID = $("#api").val();
		var html = '<option></option>';
		$("#url").html(html);
		$.ajax({
			url:'<?php echo base_url('admin/get_api');?>',
			type:'POST',
			data:{'id':apiID,'type':'URL_S'},
			dataType:'JSON'
		}).success(function(data){
			for(var i=0;i<data.length;i++){
				html+='<option value="'+data[i]['apiUrl']+'">'+data[i]['name']+'</option>';
			}
			$("#url").html(html);
			$("#url").select2({width:'100%'});
		});
	  });
	  $("#fetch_btn").on("click",function(){
		  $("#products_div").addClass("hide");
		  $(".text-danger").remove();
		  var apiID = $("#api").val();
		  var url = $("#url").val();
		  var error = 0;
		  if(apiID == ''){
			error++;
			$("#api").parent().append('<div class="text-danger">This field is required</div>');
		  }
		  if(url == ''){
			error++;
			$("#url").parent().append('<div class="text-danger">This field is required</div>');
		  }
		  if(error == 0){
			$.ajax({
				url:'<?php echo base_url('admin/get_product_from_api');?>',
				type:'POST',
				data:{'apiID':apiID,'url':url},
				dataType:'HTML'
			}).success(function(data){
				$("#products_list").html(data);
				$("#products_list").removeClass("hide");
			});
		  }
	  });
	  $(document).on("click",".select_product",function(){
		  var id = $(this).data("id");
		  if($(this).is(":checked")){
			  $("#category_"+id).removeAttr("disabled");
			  $("#navigation_"+id).removeAttr("disabled");
			  $("#min_age_"+id).removeAttr("disabled");
			  $("#max_age_"+id).removeAttr("disabled");
		  }else{
			  $("#category_"+id).attr("disabled",true);
			  $("#navigation_"+id).attr("disabled",true);
			  $("#min_age_"+id).attr("disabled",true);
			  $("#max_age_"+id).attr("disabled",true);
		  }
	  });
	  $("#submit_btn").on("click",function(){
		var error=1;$(".text-danger").remove();
		$(".select_product").each(function(){
			if($(this).is(":checked")){
				alert('ok');
				//error++;
				//$(this).parent().append('<div class="text-danger">This field is required</div>');
			}
		});
		var products = [];
		$("#products_list .select_product").each(function(){
		  if($(this).is(":checked"))
			products.push($(this).val());
		});
		if(products.length == 0){
			error++;
			$.notify({ message: 'Please select atleast one product.' },{type: 'danger'}); 
		}
		if(error == 0){
			//$("#submit_btn").attr("disabled",true);
			
			var formData = new FormData($("#product_form")[0]);
			formData.append('type','INSERT_API_PRODUCTS');
			formData.append('products',products);
			$.ajax({
				url:'<?php echo base_url('admin/ins_upd_product');?>',
				type:'POST',
				data:formData,
				dataType:'JSON',
				cache: false,
				contentType: false,
				processData: false
			}).success(function(data){
				
				if(data.status){
					$.notify({ message: data.message },{type: 'success'});
					setTimeout(function(){window.location = '<?php echo base_url(); ?>admin/products';},2000);
				}else{
					$.notify({ message: data.message },{type: 'danger'});
				}
			});
		}
	  });
	  });
    </script>
	
  </body>

</html>