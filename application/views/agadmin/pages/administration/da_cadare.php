<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">List of Da Cadre</div>
		<div class="pull-right block-header-btn"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/da_cadare_upload'"><i class="icon-plus icon-white"></i> Add Da Cadre</button>
		<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/da_cadare_details_upload'"><i class="icon-upload icon-white"></i> Update Da Cadre</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Sl no.</th>
                <th>Id</th>
				<th>Name</th>
                <th>Mobile</th>
				<th>Email</th>
				<th>DOB</th>
				<th>DOR</th>
				<th>DOAPP</th>
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['empid'] ?></td>
							<td><?php echo $row['empname'] ?></td>
							<td><?php echo $row['mbno'] ?></td>
							<td><?php echo $row['nicmail'] .' &nbsp; '.$row['email']?></td>
							<td><?php echo $row['dob']?></td>
							<td><?php echo $row['dor']?></td>
							<td><?php echo $row['doapp']?></td>
							<td><button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['empid'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button></td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="9">No data found!</td></tr>';
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
<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/da_cadare_edit/'+id;
	}
}
</script>