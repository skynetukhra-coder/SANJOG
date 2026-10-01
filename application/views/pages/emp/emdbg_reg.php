<style>
.table1 td{text-align:center;
	font-size:13px;
}
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('leave_for_recommendati'); ?> EMDs and BGs</div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?> EMDs / BGs / Bills Register</strong></h4>
				<div class="col-md-4 col-sm-12" style = " float: right; text-align:center; font-size: 14px">
					<button type="button" class="btn-success btn-xm" onclick="EmdbgAdd()" style="padding-top: 5px">Add Record</button>
					<button type="button" class="btn-warning btn-xm" onclick="EmdbgDet()" style="padding-top: 5px">EMD BG Details</button>
				</div>
				<hr />
				<div class="msg_cont">
					<div class="success">
						<?php if(isset($success) && !empty($success)){
							echo '<div class="msg">'.$success.'</div>';
						  }else if($this->session->flashdata('success')){
							echo '<div class="msg">'.$this->session->flashdata('success').'</div>';
						  }
					 ?>
					</div>
					<div class="err">
						<?php if(isset($error) && !empty($error)){
							echo '<div class="msg">'.$error.'</div>';
						  }else if($this->session->flashdata('error')){
							echo '<div class="msg">'.$this->session->flashdata('error').'</div>';
						  }
					 ?>
					</div>
				</div>
					<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-4">
											 <label class="name-label"><?php echo $this->lang->line('from_date'); ?> :</label>
											<input type="text" id="date_from" name="date_from" value="<?php echo $this->input->get('date_from',true)?>" class="form-control" placeholder = "dd-mm-yyyy"/>
										</div>
										<div class="col-sm-4">
											 <label class="name-label"><?php echo $this->lang->line('to_date'); ?> :</label>
											<input type="text" id="date_to" name="date_to" value="<?php echo $this->input->get('date_to',true)?>" class="form-control" placeholder = "dd-mm-yyyy"/>
										</div>
										<div class="col-sm-4">
										 <label class="name-label">Type :</label>
											<input type="text" id="emd_bg_no" name="emd_bg_no" value="<?php echo $this->input->get('emd_bg_no',true)?>" class="form-control" Placeholder ="EMD or BG Reg No ..." />
										</div>
										<div class="col-sm-4">
										 <label class="name-label">vendor :</label>
										 <select  id="vendor_nm" name="vendor_nm" class="form-control" >
												<option value="">--- Select Vendor ---</option>
												<?php
													if(isset($vendors)){
														foreach($vendors as $vendor){
															echo '<option value="'.$vendor['vendor_nm'].'">'.$vendor['vendor_nm'].'</option>';
														}
													}
												?>
											</select>
										</div>
										<div class="col-sm-4">
										 <label class="name-label">Search :</label>
										  <input type="text" id="search" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" Placeholder ="Bill No / DD No / Amount ..." />
										</div>
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Fin Year</th>
								<th style="text-align:center">Bill No/ Bill_Date</th>
								<th style="text-align:center">Vendor</th>
								<th style="text-align:center">DD No / DD Date</th>
								<th style="text-align:center">Amount</th>
								<th style="text-align:center">File No/ File Date</th>
								<th style="text-align:center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									foreach($results as $record){
							?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $record['emd_bg_no'] ?><br><?php echo $record['fin_yr'] ?></br></td>
											<td><?php echo $record['bill_no'] ?><br><?php echo get_datepicker_date($record['bill_dt']) ?></br></td>
											<td><?php echo $record['vendor_name'] ?></td>
											<td><?php echo $record['dd_no'] ?><br><?php echo get_datepicker_date($record['dd_dt']) ?></br></td>
											<td><?php echo $record['amount'] ?></td>
											<td style="font-size:11px"><?php echo $record['file_no'] ?><br><?php echo get_datepicker_date($record['file_dt']) ?></br></td>
											<td>
												<button id ="edit" class="btn-mini btn-primary" 
												onclick="goEdit('<?php echo $record['emdbg_rid'] ?>')" ><i 
													class="icon-pencil icon-white"></i> Update </button>
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="8">No records found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
			<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_bill_edit/' + id;
    }
}
function EmdbgAdd() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_bill_add/';
}
function EmdbgDet() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_all/';
}
function EmdbgBills() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_reg/';
}
/*
 function edit_btn(leave_st,edit) 
{
    if (leave_st.value == "draft") 
    {
        document.getElementById("edit").disabled = false;		
    }
    else 
    {       
		document.getElementById("edit").disabled = true;
    }	
*/	
	
</script>