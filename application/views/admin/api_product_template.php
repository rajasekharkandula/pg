 <div class="col-sm-12">
  <div class="panel panel-default panel-table">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-6">Products List</div>
		</div>
	</div>
	<div class="panel-body">
	  <table id="table1" class="table table-striped table-hover table-fw-widget api_products">
		<thead>
		  <tr>
			<th width="100px" class="text-center">Select</th>
			<th>Name</th>
			<th>Price</th>
			<th>Category</th>
			<th>Navigation</th>
			<th>Min Age</th>
			<th>Max Age</th>
		  </tr>
		</thead>
		<tbody>
			<?php foreach($products as $p){ ?>
			<tr>
				<td class="text-center"><input type="checkbox" class="select_product" data-id="<?php echo $p->id; ?>" value='<?php echo json_encode($p); ?>'></td>
				<td><img src="<?php echo $p->image; ?>"><?php echo $p->name; ?></td>
				<td><?php echo $p->price; ?></td>
				<td>
					<select id="category_<?php echo $p->id; ?>" disabled>
						<option>Select Category</option>
						<?php foreach($categories as $c){ ?>
						<option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
						<?php } ?>
					</select>
				</td>
				<td>
					<select id="navigation_<?php echo $p->id; ?>" disabled>
						<option>Select Navigation</option>
						<optgroup label="Relationship Gifts">
							<option value="1">For Him</option>
							<option value="2">For Her</option>
						</optgroup>
						<optgroup label="Famili Gifts">
							<option value="3">For Mom</option>
							<option value="4">For Dad</option>
							<option value="5">For Sister</option>
							<option value="6">For Brother</option>
							<option value="7">For Daughter/Nice</option>
							<option value="8">For Son/Nephew</option>
						</optgroup>
					</select>
				</td>
				<td><input type="number" placeholder="Min Age" value="5" id="min_age_<?php echo $p->id; ?>" disabled></td>
				<td><input type="number" placeholder="Max Age" value="60" id="max_age_<?php echo $p->id; ?>" disabled></td>
			</tr>	
			<?php } ?>
		</tbody>
	  </table>
	  <br>
	   <div class="col-sm-12 text-center">
			<button class="btn btn-primary btn-lg" type="button" id="submit_btn">Add to database</button>
			<br><br>
	   </div>
	</div>
  </div>
</div>
			