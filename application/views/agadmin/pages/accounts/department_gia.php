<style>
tr{text-align:center;
   font-size:13px;
}
td{text-align:center;
   font-size:13px;
}
th{text-align:center;
   font-size:13px;
}
button{ background-color:#6FF88E; text-align: center; font-size:10px;}
button:hover{ background-color: #48BBF9; }
</style>
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
		<div class="block-content">
			<form method="post" action="<?php echo ADMIN_BASE_URL ?>accounts/gia_download">
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Demand No </label>
                        <div class="controls">
                            <select id="grnt_cd" name="grnt_cd" class="form-control" >
								<option value=""> -- Select Fin Year--</option>
								<?php
								if(isset($demand_list) && !empty($demand_list)){
									foreach($demand_list as $demand){
										echo '<option value="'.$demand['grnt_cd'].'">'.$demand['grnt_cd'].'</option>';
									}
								}
								?>
							</select>
						</div>
					 </div>
					<div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Financial Year</label>
                        <div class="controls">
                           <select id="fin_yr" name="fin_yr" class="form-control" >
								<option value=""> -- Select Fin Year--</option>
								<?php
								if(isset($fin_yr_list) && !empty($fin_yr_list)){
									foreach($fin_yr_list as $yr_list){
										echo '<option value="'.$yr_list['fin_yr'].'">'.$yr_list['fin_yr'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Treasury Month</label>
                        <div class="controls">
                             <select class="form-control" name="tr_mn" >
								<option value="">-----Select Month----</option>
								<option value="January" >January</option>
								<option value="February" >February</option>
								<option value="March"  >March</option>
								<option value="April"  >April</option>
								<option value="May"  >May</option>
								<option value="June" >June</option>
								<option value="July" >July</option>
								<option value="August"  >August</option>
								<option value="September"  >September</option>
								<option value="October"  >October</option>
								<option value="November" >November</option>
								<option value="December" >December</option>
						  </select>
                        </div>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download GIA List" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
              </form>
		</div>
	</div>
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left">List of GIA</div>
				<div class="pull-right block-header-btn">
					<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_gia_upload'"><i class="icon-plus icon-white"></i>Upload Department GIA</button>
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
								<th>GIA Amt</th>
								<th>Bal Amt</th>
								<th>Utilised</th>
								<th>UC Ref</th>
								<th>Ref Date</th>
								<th>To Bank</th>
								<th>Remark</th>
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
								<td><?php echo $row['fin_yr'] ?></td>
								<td><?php echo $row['tr_mn'] ?></td>
								<td><?php echo $row['grnt_cd'] ?></td>
								<td><?php echo $row['tr_cd'] ?></td>
								<td><?php echo $row['ddo'] ?></td>
								<td><?php echo $row['mjh_cd'] ?>-<?php echo $row['smjh_cd'] ?>-<?php echo $row['mih_cd'] ?>-<?php echo $row['sbh_cd'] ?>-<?php echo $row['dtlh_cd'] ?>-<?php echo $row['sdtlh_cd'] ?></td>
								<td><?php echo $row['tv_tc_no'] ?></td>
								<td><?php echo $row['gia_amt'] ?></td>
								<td><?php echo $row['bal_amt'] ?></td>
								<td><?php echo $row['utilised_amt'] ?></td>
								<td><?php echo $row['uc_ref_no'] ?></td>
								<td><?php echo $row['uc_ref_date'] ?></td>
								<td><?php echo $row['credit_to_bank'] ?></td>
								<td><?php echo $row['dept_remark'] ?></td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['recd_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['recd_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="8">No data found!</td></tr>';
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_gia_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_gia_delete/'+id;
		}
		
	}
}
function PgoEdit(id){
	if(id == undefined){
		alert('Wrong input!');
	}
	type = $('#invst_category_'+id).html();
	var html = '<div class="control-form">';
	html += '<label class="control-label" style="font-weight:bold">Investment Category:</label>';
	html += '<div class="controls">';
	html += '<label><input type="radio" name="visit_for" '+ (type == 'General' ? 'checked' : '') +' value="General" style="margin: 0 5px;">General</label>';
    html += '<label><input type="radio" name="visit_for" '+ (type == 'Administrative' ? 'checked' : '') +' value="Administrative" style="margin: 0 5px;">Administrative</label>';
    html += '<label><input type="radio" name="visit_for" '+ (type == 'Provident Fund' ? 'checked' : '') +' value="Provident Fund" style="margin: 0 5px;">Provident Fund</label>';
    html += '<label><input type="radio" name="visit_for" '+ (type == 'Pension' ? 'checked' : '') +' value="Pension" style="margin: 0 5px;">Pension</label>';
    html += '<label><input type="radio" name="visit_for" '+ (type == 'Accounts' ? 'checked' : '') +' value="Accounts" style="margin: 0 5px;">Accounts</label>';
	html += '</div>';
	html += '<div class="controls">';
	html += '<label class="control-label" style="font-weight:bold">Purpose :</label>';
	html += '<label><input type="text" name="invst_category" value="" style="margin: 0 5px;"></label>';
   	html += '</div>';
	html += '<div class="controls">';
	html += '<label class="control-label" style="font-weight:bold">Visit :</label>';
	html += '<label><input type="text" name="visit_for"  value="" style="margin: 0 5px;"></label>';
   	html += '</div>';
	html += '<div class="controls">';
	html += '<label class="control-label" style="font-weight:bold">OkPPPP :</label>';
	html += '<label><input type="text" name="visit_for" value="" style="margin: 0 5px;"></label>';
   	html += '</div>';
	html += '<div class="controls">';
	
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
	var invst_category = $('input[name=invst_category]').val();
	$('#visit_for_'+id).html(invst_category);
	$("#myModal").modal("toggle");
	$.post('<?php echo base_url()?>admin/accounts/department_investment/'+id,{'invst_category':invst_category,'<?php echo $csrf['name'];?>':'<?php echo $csrf['hash'];?>'},function(data){
		var obj = $.parseJSON(data);
		alert(obj.msg);
	});
}

</script>