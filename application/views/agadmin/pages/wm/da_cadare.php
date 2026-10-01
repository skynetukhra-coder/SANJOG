<div class="row-fluid">
  <div class="span12" id="content">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left" style = "color:red; font-size:14px;">***Search employee first before adding into Database.    ***To add PAN No of an existing employee without PAN, contact ITSC.    ***Deactivate employee immediately on transfer, voluntary retirement or death.</div>
		</div>
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
	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			 <form method="post" action="<?php echo ADMIN_BASE_URL ?>administration/employee_download">
                    <div class="control-form">
                        <label class="control-label">Employee DOR from</label>
                        <div class="controls">
                            <input type="text" name="date_from" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">to</label>
                        <div class="controls">
                            <input type="text" name="date_to"  data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label"> Employee (Active) </label>
                        <div class="controls">
                            <select name="da_cadare" style="height:34px;" required>
								<option  value= "1" > DA Cadre Employee</option>
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Employee List" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
               </form>
		</div>
	</div>
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">List of Da Cadre</div>
		<div class="header-btn-wrap">
        <button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>wm/da_cadare_upload'"><i class="icon-plus icon-white"></i> Add /Update DaCadre Employee Info</button>
		<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>wm/da_cadare_details_upload'"><i class="icon-upload icon-white"></i> Add /Update DaCadre Employee Details</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Sl no.</th>
                <th>PAN</th>
				<th>OFFICE ID</th>
				<th>Name</th>
				<th>DESIGNATION</th>
                <th>Mobile</th>
				<th>Email</th>
				<th>DOB</th>
				<th>DOR</th>
				<th>DOAPP</th>
				<th>Status</th>
				<th class="action">Action</th>
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
							<td><?php echo $row['office_id'] ?></td>
							<td><?php echo $row['empname'] ?></td>
							<td><?php echo $row['desig'] ?></td>
							<td><?php echo $row['mbno'] ?></td>
							<td><?php echo $row['nicmail'] .' &nbsp; '.$row['email']?></td>
							<td><?php echo date('d-m-Y',strtotime($row['dob']))?></td>
                            <td><?php echo date('d-m-Y',strtotime($row['dor']))?></td>
                            <td><?php echo date('d-m-Y',strtotime($row['doapp']))?></td>
							<td><?php echo $row['status'] ?></td>
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
        </div>
		<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>wm/da_cadare_edit/'+id;
	}
}
</script>