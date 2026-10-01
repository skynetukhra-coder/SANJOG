<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Whats New</div>
		<div class="pull-right block-header-btn"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>whats_new/agersa_add'"><i class="icon-plus icon-white"></i>Add</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
				<th>Title</th>
				<th>File Name</th>
				<th>Expiry Date</th>
				<th>Display</th>
				<th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = 1;
						foreach($results as $row){?>
						 <tr>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['title'] ?></td>
							<td><a href="<?php echo base_url().'files/ersa/'.$row['link_file'] ?>" target="_blank"><?php echo $row['link_file'] ?></a></td>
							<td><?php echo isset($row['expiry_dt']) && $row['expiry_dt'] != '0000-00-00' ? date('d-m-Y',strtotime($row['expiry_dt'])) : ''; ?></td>
							<td><?php echo  ucwords($row['display'])?></td>
							<td>
								<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['whtn_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['whtn_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
							</td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="5">No data found!</td></tr>';
					}
				?>
            </tbody>
          </table>
         </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>whats_new/agersa_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>whats_new/agersa_delete/'+id;
		}
		
	}
}
</script>