<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Gallery</div>
		<div class="pull-right block-header-btn"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gallery/add'"><i class="icon-plus icon-white"></i>Add</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
          <div class="table-scroll">
           <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width:10px">#</th>
				<th style="width:200px; text-align:center">Image</th>
				<th>Title</th>
				<th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td style="width:10px"><?php echo $sl++ ?></td>
							<td style="width:200px; text-align:center"><img src="<?php echo base_url().'galleryIMG/thumb/'.$row['image'] ?>"</td>
							<td><?php echo $row['title'] ?></td>
							<td>
								<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['gallery_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['gallery_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
							</td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="4">No data found!</td></tr>';
					}
				?>
            </tbody>
          </table>
          </div>
        </div>
		<div class="pagination"><?php echo $this->pagination->create_links();?></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>gallery/edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>gallery/delete/'+id;
		}
		
	}
}
</script>