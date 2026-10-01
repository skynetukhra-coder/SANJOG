<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">List of DA Cadre</div>
		<div class="pull-right block-header-btn"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/da_cadre_upload'"><i class="icon-upload icon-white"></i> Upload CSV</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Sl no.</th>
				<th>DA Cadre Code</th>
                <th>DA Cadre Name</th>
				<th>Email</th>
                <th>Mobile</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['dac_code'] ?></td>
							<td><?php echo $row['dac_name'] ?></td>
							<td><?php echo $row['email'] ?></td>
							<td><?php echo $row['mobile'] ?></td>
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
		<div class="pagination"><?php echo $this->pagination->create_links();?></div>
      </div>
    </div>
  </div>
</div>