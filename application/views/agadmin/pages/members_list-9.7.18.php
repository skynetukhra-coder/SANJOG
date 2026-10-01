<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">List of all members</div>
	  <div class="pull-right block-header-btn"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>members/add'"><i class="icon-plus icon-white"></i> Add</button></div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Sl</th>
              <th>Name</th>
              <th>Username</th>
			  <th>Email</th>
			  <th>Wing</th>
			  <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
		  	<?php
				if(!empty($results)){
					$sl = 1;
					foreach($results as $row){?>
						 <tr>
						  <td><?php echo $sl++ ?></td>
						  <td><?php echo $row['admin_name'] ?></td>
						  <td><?php echo $row['admin_username'] ?></td>
						  <td><?php echo $row['admin_email'] ?></td>
						  <td><?php echo $row['admin_type_name'] ?></td>
						  <td><?php echo ucfirst(strtolower($row['admin_status'])) ?></td>
						  <td>
						  	<button class="btn btn-primary" onclick="goEdit('<?php echo $row['admin_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
							<button class="btn btn-danger" onclick="goDelete('<?php echo $row['admin_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
						  </td>
						</tr>
			<?php	}
				}else{?>
					<tr><td colspan="7">No data found</td></tr>
			<?php
				}
			?>
           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function goEdit(id){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>members/edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>members/delete/'+id;
		}
		
	}
}
</script>