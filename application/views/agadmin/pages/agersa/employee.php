<div class="row-fluid">
  <div class="span12" id="content">
  <div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<form method="get">
			  <div class="control-form">
				<label class="control-label">Search</label>
				<div class="controls">
				 <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>" placeholder="Search ......."/>
				</div>
			  </div>
			  <div class="control-form">
			  	<label class="control-label">&nbsp;</label>
				<div class="controls">
					<input type="submit" value="Filter" />
				</div>
			  </div>
			  <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			  <div class="clearfix"></div>
			 </form>
		</div>
	</div>
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">List of Employee</div>
		<div class="header-btn-wrap">
        <button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>agersa/employee_upload'">
        <i class="icon-plus icon-white"></i> Add or Update Employee</button>
		<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>agersa/employee_details_upload'">
        <i class="icon-upload icon-white"></i> Add or Update Employee Details</button>
      </div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Sl no.</th>
                <th>Employee Id</th>
				<th>Name</th>
                <th>Mobile</th>
				<th>Email</th>
				<th>DOB</th>
				<th>DOR</th>
				<th>DOAPP</th>
				<th>Application</th>
				<th class="action" style="">Action</th>
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
							<td><?php echo $row['nicmail'] .' <br>'.$row['email']?></td>
							<td><?php echo $row['dob']?></td>
							<td><?php echo $row['dor']?></td>
							<td><?php echo $row['doapp']?></td>
							<td>
								<?php 
									$is_applied =  is_employee_applied_form($row['empid']);
									if($is_applied){
										echo '<a href="'.ADMIN_BASE_URL.'agersa/employee_application?id='.$row['empid'].'" target="_blank"><img src="'.base_url().'assets/images/xlsx.png"></a>';
									}else{
										echo 'Not Applied';
									}
								?>
							</td>
							<td><button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['empid'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button></td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="10">No data found!</td></tr>';
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>agersa/employee_edit/'+id;
	}
}
</script>