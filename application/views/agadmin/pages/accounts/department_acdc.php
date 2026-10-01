<style>
tr{text-align:center;
   font-size:14px;
}
td{text-align:center;
   font-size:14px;
}
th{text-align:center;
   font-size:14px;
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
	</div>
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left">List of AC Bills</div>
				<div class="pull-right block-header-btn">
					<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_acdc_upload'"><i class="icon-plus icon-white"></i>Upload Department AC Bills</button>
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
								<th>AC Bill Amt</th>
								<th>Balance Amt</th>
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
								<td><?php echo $row['acbl_amt'] ?></td>
								<td><?php echo $row['amt_bal'] ?></td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="PgoEdit('<?php echo $row['recd_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['recd_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="11">No data found!</td></tr>';
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_acdc_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_acdc_delete/'+id;
		}
		
	}
}
function PgoEdit(id){
	if(id == undefined){
		alert('Wrong input!');
	}
	type = $('#acbl_amt_'+id).html();
	var html = '<div class="control-form">';
	html += '<div class="controls">';
	html += '<label class="control-label" style="font-weight:bold">AC Bill Aount :</label>';
	html += '<label><input type="text" name="acbl_amt" value="" style="margin: 0 5px;"></label>';
   	html += '</div>';
	html += '<div class="controls">';
	html += '<label class="control-label" style="font-weight:bold">Balance Amount :</label>';
	html += '<label><input type="text" name="amt_bal"  value="" style="margin: 0 5px;"></label>';
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
	var acbl_amt= $('input[name=acbl_amt]').val();
	var amt_bal= $('input[name=amt_bal]').val();
	$('#acbl_amt_'+id).html(acbl_amt);
	$("#myModal").modal("toggle");
	$.post('<?php echo base_url()?>admin/accounts/department_acdc_update/'+id,{'acbl_amt':acbl_amt, 'amt_bal':amt_bal,'<?php echo $csrf['name'];?>':'<?php echo $csrf['hash'];?>'},function(data){
		var obj = $.parseJSON(data);
		alert(obj.msg);
	});
}

</script>