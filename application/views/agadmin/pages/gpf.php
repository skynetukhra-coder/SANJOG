<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">List of all Contents</div>
		<div class="pull-right block-header-btn"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>pages/add'"><i class="icon-plus icon-white"></i> Add Page</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Page Name</th>
                <th>URL</th>
				<th>Type</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = 1;
						foreach($results as $row){?>
						 <tr>
							<td><?php echo $sl++?></td>
							<td><?php echo $row['page_name']?></td>
							<td><?php echo !empty($row['page_url']) ? '<a href="'.AGAE_BASE_URL.'page/'.$row['page_url'].'" target="_blank">'.AGAE_BASE_URL.'page/'.$row['page_url'].'</a>' : '' ?></td>
							<td><?php echo $row['type']?></td>
							<td><?php echo $row['status']?></td>
							<td>
								<button class="btn btn-primary" onclick="goEdit('<?php echo $row['page_id'] ?>','<?php echo $row['type']?>')"><i class="icon-pencil icon-white"></i> Edit</button>
								<button class="btn btn-danger" onclick="goDelete('<?php echo $row['page_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
							</td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="6">No data found!</td></tr>';
					}
				?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		if(type == 'BLOG'){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>blogs/edit/'+id;
		}else if(type == 'LINK'){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>links/edit/'+id;
		}else{
			window.location.href = '<?php echo ADMIN_BASE_URL ?>pages/edit/'+id;
		}
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>pages/delete/'+id;
		}
		
	}
}
</script>