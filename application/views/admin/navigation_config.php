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
                <div class="panel-heading panel-heading-divider">Navigation Configuration</span></div>
                <div class="panel-body">
                  <form class="form-horizontal" id="navigation_form">
                    
					<div class="form-group">
                      <label class="col-sm-3">Name <span>*</span></label>
                      <div class="col-sm-6">
                        <input req="true" type="text" class="form-control" name="name" value="<?php if(isset($navigation->name))echo $navigation->name; ?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-3">Slug <span>*</span></label>
                      <div class="col-sm-6">
                        <input req="true" type="text" class="form-control" name="slug" value="<?php if(isset($navigation->slug))echo $navigation->slug; ?>">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="col-sm-3">Parent(If child) </label>
                      <div class="col-sm-6">
                        <select class="select2" data-placeholder="Select parent navigation" name="parent_id">
							<option></option>
							<?php foreach($navigations as $n){ ?>
							<option value="<?php echo $n->id; ?>" <?php if(isset($navigation->parent_id))if($n->id == $navigation->parent_id)echo 'selected'; ?>><?php echo $n->name; ?></option>
							<?php } ?>
						</select>
                      </div>
                    </div>
                    		
					<div class="col-sm-12 text-center">
                        <button class="btn btn-primary btn-lg" type="button" id="submit_btn">Submit</button>
                        <a href="<?php echo base_url('admin/navigations'); ?>" class="btn btn-default btn-lg">Cancel</a>
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
		App.formElements();
		App.textEditors();
      });
	  $("#submit_btn").on("click",function(){
		var error=0;$(".text-danger").remove();
		$("#navigation_form input").each(function(){
			if($(this).attr("req") == "true" && $(this).val().trim() == ""){
				error++;
				$(this).parent().append('<div class="text-danger">This field is required</div>');
			}
		});
		if(error == 0){
			//$("#submit_btn").attr("disabled",true);
			
			var formData = new FormData($("#navigation_form")[0]);
			<?php if(isset($navigation->id)){ ?>
			formData.append('type','UPDATE');
			formData.append('id','<?php echo $navigation->id;?>');
			<?php }else{ ?>
			formData.append('type','INSERT');
			<?php } ?>
			
			$.ajax({
				url:'<?php echo base_url('admin/ins_upd_navigation');?>',
				type:'POST',
				data:formData,
				dataType:'JSON',
				cache: false,
				contentType: false,
				processData: false
			}).success(function(data){
				
				if(data.status){
					$.notify({ message: data.message },{type: 'success'});
					setTimeout(function(){window.location = '<?php echo base_url(); ?>admin/navigations';},2000);
				}else{
					$.notify({ message: data.message },{type: 'danger'});
				}
			});
		}
	  });
	  
    </script>
	
  </body>

</html>