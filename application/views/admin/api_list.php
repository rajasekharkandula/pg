<!DOCTYPE html>
<html lang="en">
  
<?php echo $head; ?>
  
  <body>
    <div class="be-wrapper be-fixed-sidebar">
	
      <?php echo $header; ?>
	  
	  <div class="be-content">
        <div class="main-content container-fluid">
			
			<div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">API List
                  <a href="<?php echo base_url('admin/api_config'); ?>" class="btn btn-primary pull-right"><i class="mdi mdi-plus"></i> Add</a>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Api Key</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1;foreach($api as $a){?>
					  <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $a->name; ?></td>
                        <td><?php echo $a->apiKey; ?></td>
                        <td>
							<a href="<?php echo base_url('admin/api_config/'.$a->id); ?>" class="btn btn-primary"><i class="mdi mdi-edit"></i></a>
							<button data-id="<?php echo $a->id; ?>" class="btn btn-danger remove"><i class="mdi mdi-delete"></i></button>
						</td>
                      </tr>
					 <?php $i++; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
			
		</div>
      </div>
      
	  
    </div>
	
	<div id="modal-remove" tabindex="-1" role="dialog" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
              <h3>Danger!</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
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
	
	<?php echo $footer; ?>
   
    <script type="text/javascript">
      $(document).ready(function(){
		App.init();
      	App.dataTables();
      });
	  $(".remove").on("click",function(){
		var id = $(this).data("id");
		$("#delete_btn").data("id",id);
		$("#modal-remove").modal("show");
	  });
	  $("#delete_btn").on("click",function(){
		var obj = $(this);
		var id = obj.data("id");
		obj.attr('disabled',true);
		obj.html('<i class="mdi mdi-spinner"></i>');
		$.ajax({
			url:'<?php echo base_url('admin/ins_upd_api');?>',
			type:'POST',
			data:{'id':id,'type':'DELETE'},
			dataType:'JSON'
		}).success(function(data){
			$("#modal-remove").modal("hide");
			if(data.status){
				$.notify({ message: data.message },{type: 'success'});
				setTimeout(function(){window.location.reload();},2000);
			}else{
				$.notify({ message: data.message },{type: 'danger'});
			}
		});
	  });
    </script>
  </body>

</html>