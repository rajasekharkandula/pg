<!DOCTYPE html>
<html lang="en">
	
	<!-- HEAD -->
	<?php echo $head; ?>
	<!-- HEAD -->
	
    <body>
        
		<!-- HEADER -->
		<?php echo $header;?>
		<!-- HEADER -->
        
		<section class="profile mbh">
			<div class="container">
				<h2 class="page-tittle">Personal Shopper Assistant Requests</h2>
				<div class="box">
				<table class="table table-bordered table-striped datatable">
				<thead>
					<tr>
						<th>Request ID</th>
						<th>Title</th>
						<th>Shopper</th>
						<th>Date</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($requests as $r){ ?>
					<tr>
						<td><?php echo $r->id; ?></td>
						<td><?php echo $r->title; ?></td>
						<td><?php if($r->shopperName)echo $r->shopperName;else echo 'No Shopper Assigned'; ?></td>
						<td><?php echo date('d M,y h:i A',strtotime($r->created_date)); ?></td>
						<td><?php echo $r->status; ?> </td>
						<td>
							<a href="<?php echo base_url('home/request_details/'.$r->id); ?>" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> View</a> 
						</td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				</table>
				</div>
			</div>			
		</section>
		
		
		<!-- FOOTER -->
		<?php echo $footer; ?>
		<!-- FOOTER -->
		
		<script>
			
		</script>
		
			
    </body>

</html>