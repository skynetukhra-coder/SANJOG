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
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>All EMDs and Bank Guarantees</strong></h4>
				<div class="col-md-5 col-sm-12" style = " float: right; text-align:center; font-size: 14px">
					<button type="button" class="btn-success btn-xm" onclick="EmdbgAdd()" style="padding-top: 5px">Add Record</button>
					<button type="button" class="btn-primary btn-xm" onclick="EmdbgReg()" style="padding-top: 5px">Bill Register</button>
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
											<div class="col-sm-3">
												 <label class="name-label"><?php echo $this->lang->line('from_date'); ?> :</label>
												<input type="text" id="date_from" name="date_from" value="<?php echo $this->input->get('date_from',true)?>" class="form-control" placeholder = "dd-mm-yyyy"/>
											</div>
											<div class="col-sm-3">
												 <label class="name-label"><?php echo $this->lang->line('to_date'); ?> :</label>
												<input type="text" id="date_to" name="date_to" value="<?php echo $this->input->get('date_to',true)?>" class="form-control" placeholder = "dd-mm-yyyy"/>
											</div>
											<div class="col-sm-4">
											 <label class="name-label">Type :</label>
											  <select name="emdbg_type" class="form-control">
												<option value="">---- Select Type -----</option>
												<option value="Earnest Money" <?php echo $this->input->get('emdbg_type') == 'Earnest Money' ? 'selected' : ''?> >Earnest Money</option>
												<option value="Bank Guarantee" <?php echo $this->input->get('emdbg_type') == 'Bank Guarantee' ? 'selected' : ''?> >Bank Guarantee</option>
												<option value="Security Deposit" <?php echo $this->input->get('emdbg_type') == 'Security Deposit' ? 'selected' : ''?> >Security Deposit</option>
												<option value="Performance Guarantee" <?php echo $this->input->get('emdbg_type') == 'Performance Guarantee' ? 'selected' : ''?> >Performance Guarantee</option>
											 </select>
											</div>
											<div class="col-sm-2">
											 <label class="name-label">Reg SL No :</label>
											  <input type="text" id="sl_no" name="sl_no" value="<?php echo $this->input->get('sl_no',true)?>" class="form-control" Placeholder ="Reg SL No" />
											</div>
											<div class="col-sm-3">
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
											<div class="col-sm-3">
											 <label class="name-label">Search :</label>
											  <input type="text" id="search" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" Placeholder ="Bank Name / DD No ..." />
											</div>
											<div class="col-sm-3"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
											<div class="col-sm-3"><input type="button" class="submit-btn btn-success" onclick = "PrintGo('<?php $this->input->get('vendor_nm', true) ?>')"  value="Print" style = "padding-left: 0px"/></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">REG No/ Entry_Date</th>
								<th style="text-align:center">Vendor</th>
								<th style="text-align:center">Bank</th>
								<th style="text-align:center">DD / Cheque No</th>
								<th style="text-align:center">Amount</th>
								<th style="text-align:center">NIQ/ NIQ Date</th>
								<th style="text-align:center">Status / Valid Upto</th>
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
											<td><?php echo $record['sl_no'] ?><br><?php echo get_datepicker_date($record['entry_dt']) ?></br></td>
											<td><?php echo $record['vend_nm'] ?></td>
											<td><?php echo $record['bank_nm'] ?></td>
											<td><?php echo $record['emdbg_type'] ?><br><?php echo $record['dd_cq_no'] ?><br><?php echo get_datepicker_date($record['dd_cq_dt']) ?></br></td>
											<td><?php echo $record['amt'] ?></td>
											<td style="font-size:11px"><?php echo $record['niq_no'] ?><br><?php echo get_datepicker_date($record['niq_dt']) ?></br></td>
											<td><?php
												if($record['status']=='Received'){
												?>
												<img width="10" height="10" title="Less than 5 days" src="<?php echo base_url()?>assets/images/star_icon.png" alt="">
												<?php } ?>
												<?php echo $record['status'] ?><br><?php if($record['status']=='Deposited'){echo get_datepicker_date($record['valid_to']);} else {echo get_datepicker_date($record['refund_dt']);} ?></br>
												<?php 
												$date1=date('Y-m-d',strtotime($record['valid_to']));
												$date2 = date('Y-m-d');
												if($date1 < $date2 && $record['status']=='Deposited'){
												?>
												<img width="20" height="20" title="Less than 5 days" src="<?php echo base_url()?>assets/images/flag_red.png" alt="">
												<?php } ?>
											</td>											
											<td>
												<button id ="edit" class="btn-mini btn-primary" 
												onclick="goEdit('<?php echo $record['emdbg_id'] ?>')" ><i 
													class="icon-pencil icon-white"></i> Update </button>
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="9">No records found!</td></tr>';
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
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_edit/' + id;
    }
}
function EmdbgAdd() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_add/';
}
function EmdbgReg() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_reg/';
}

function PrintGo(vendor, type) {
  var vendor = document.getElementById("vendor_nm").value;
  if (vendor === "") {
	alert ('Vendor not selected');
	window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_all/';
  }else{
	window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_pending_pdf/' + vendor;
  }
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