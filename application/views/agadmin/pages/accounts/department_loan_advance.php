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
				<div class="muted pull-left">List of Department's Loans & Advances</div>
				<div class="pull-right block-header-btn">
					<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_loan_advance_upload'"><i class="icon-plus icon-white"></i> Upload Loan & Advance Records</button>
				</div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Fin Year</th>
								<th>TR month</th>
								<th>Grant</th>
								<th>TR Code</th>
								<th>DDO Code</th>
								<th>Classification</th>
								<th>TV TC NO</th>
								<th>Invst Amt</th>
								<th>Terms & Conditions</th>
								<th>Dept's Remark</th>
								<th>Dept's Old Remark</th>
								<th>Name</th>
								<th>Desig</th>
								<th>Phone No</th>
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
								<td><?php echo $row['yr_ta'] ?></td>
								<td><?php echo $row['tr_mn'] ?></td>
								<td><?php echo $row['grnt_cd'] ?></td>
								<td><?php echo $row['tr_cd'] ?></td>
								<td><?php echo $row['ddo'] ?></td>
								<td><?php echo $row['mjh_cd'] ?>-<?php echo $row['smjh_cd'] ?>-<?php echo $row['mih_cd'] ?>-<?php echo $row['sbh_cd'] ?>-<?php echo $row['dtlh_cd'] ?>-<?php echo $row['sdtlh_cd'] ?></td>
								<td><?php echo $row['tv_tc_no'] ?></td>
								<td><?php echo $row['n_amt_schd'] ?></td>
								<td>
								<?php
									if(trim($row['dept_attachment']) != ''){
										echo '<a href="'.base_url().'files/agae/department/'.$row['dept_attachment'].'" target="_blank"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a>';
									}
								?>
								</td>
								<td><?php echo $row['dept_remark'] ?></td>
								<td><?php echo $row['dept_old_remark'] ?></td>
								<td><?php echo $row['dept_official_name'] ?></td>
								<td><?php echo $row['dept_official_desig'] ?></td>
								<td><?php echo $row['dept_official_contact'] ?></td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['la_recd_id'] ?>')"><i class="icon-pencil icon-white"></i> Update</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['la_recd_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="15">No data found!</td></tr>';
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_loan_advance_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_loan_advance_delete/'+id;
		}
		
	}
}

function PgoEdit(id){
	if(id == undefined){
		alert('Wrong input!');
	}
	type = $('#dept_remark'+id).html();
	var html = '<div class="control-form">';
	html += '<div class="controls">';
	html += '<label class="control-label" style="font-weight:bold">Department Old Remark :</label>';
	html += '<label><input type="text" name="dept_remark" value="<?php echo $row['dept_remark'] ?>" style="margin: 0 5px;"></label>';
   	html += '</div>';
	
	html += '<div class="controls">';
	html += '<label class="control-label" style="font-weight:bold">Department Old Remark :</label>';
	html += '<label><input type="text" name="dept_old_remark" value="" style="margin: 0 5px;"></label>';
   	html += '</div>';
	
   	html += '</div>';
	html += '<br/>';
	html += '<div class="control-form">';
	html += '<div class="controls">';
	html += '<input type="submit" value="Update" onclick="updateRecord('+id+')" />';
	html += '</div>';
	html += '</div>';
	$('#row_details').html(html);
	$("#myModal").modal("toggle");
}
function updateRecord(id){
	var dept_remark= $('input[name=dept_remark]').val();
	var dept_old_remark= $('input[name=dept_old_remark]').val();
	$('#dept_remark_'+id).html(dept_remark);
	$("#myModal").modal("toggle");
	$.post('<?php echo base_url()?>admin/accounts/department_loan_advance_update/'+id,{'dept_remark':dept_remark, 'dept_old_remark':dept_old_remark,'<?php echo $csrf['name'];?>':'<?php echo $csrf['hash'];?>'},function(data){
		var obj = $.parseJSON(data);
		alert(obj.msg);
	});
}



</script>