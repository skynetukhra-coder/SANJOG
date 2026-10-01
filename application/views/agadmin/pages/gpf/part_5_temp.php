<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">List of Part V Data</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/part_5_upload'"><i class="icon-upload icon-white"></i> Upload Part V Data</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Series</th>
				<th>Image</th>
                <th>Path</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
							<td><?php echo $sl++ ?></td>
							<td><?php echo $row['series']?></td>
							<td><?php echo $row['img']?></td>
							<td><?php echo $row['path']?></td>
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