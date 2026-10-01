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
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>Hardware under AMC Service</strong></h4>
				<div class="col-md-4 col-sm-12" style = " float: right; text-align:center; font-size: 14px">
					<button type="button" class="btn-warning btn-xm" onclick="HWInv()" style="padding-top: 5px">Inventory</button>
					<button type="button" class="btn-primary btn-xm" onclick="EmdbgAdd()" style="padding-top: 5px">Add Comp</button>
					<button type="button" class="btn-success btn-xm" onclick="EmdbgReg()" style="padding-top: 5px">Out Entry</button>
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
										 <label class="name-label">AMC Year :</label>
										  <select  id="amc_yr" name="amc_yr" class="form-control" >
												<option value="">--- Select Year ---</option>
												<?php
													if(isset($amc_yr)){
														foreach($amc_yr as $amc_yr){
															echo '<option value="'.$amc_yr['fin_year'].'">'.$amc_yr['fin_year'].'</option>';
														}
													}
												?>
											</select>
										</div>
										<div class="col-sm-4">
										 <label class="name-label">Search :</label>
										  <input type="text" id="search" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" Placeholder ="Machine No ..." />
										</div>
										<div class="col-sm-4">
										 <label class="name-label">vendor :</label>
											<select  id="vendor" name="vendor" class="form-control" onchange = "SelectVnd()">
												<option value="">--- Select Vendor ---</option>
												<?php
													if(isset($vendors)){
														foreach($vendors as $vendor){
															echo '<option value="'.$vendor['vend_id'].'">'.$vendor['vendor_nm'].'</option>';
														}
													}
													
												?>
											</select>
										</div>
										<div class="col-sm-2"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
										<div class="col-sm-2"><input type="button" onclick = "PrintGo('<?php $this->input->get('vendor', true) ?>')" class="submit-btn btn-success" value="Print" style = "padding-left: 0px"/></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">SL No</th>
								<th style="text-align:center">COMP No / Out Date</th>
								<th style="text-align:center">DESCRIPTION</th>
								<th style="text-align:center">BRAND /ITEM SL NO/ MACHINE NO</th>
								<th style="text-align:center">SECTION</th>
								<th style="text-align:center">VENDOR / DATE</th>
								<th style="text-align:center">Status</th>
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
											<td><?php echo $record['comp_no'] ?><br><?php echo get_datepicker_date($record['out_date']) ?></br></td>
											<td><?php echo $record['descp'] ?></td>
											<td><?php echo $record['brand'] ?><br><?php echo $record['item'] ?></br><br><?php echo $record['mach_no'] ?></br></td>
											<td><?php echo $record['section'] ?></td>
											<td><?php echo $record['vendor'] ?><br><?php echo get_datepicker_date($record['recpt_date']) ?></br></td>
											<td><?php echo $record['status'] ?>
												<?php 
												if(strtolower($record['status'])=='pending'){
												?>
												<img width="20" height="20" title="Less than 5 days" src="<?php echo base_url()?>assets/images/flag_red.png" alt="">
												<?php } ?>
											</td>										
											<td><?php 
												if(empty($record['status']) || strtolower($record['status'])=='pending' || strtolower($record['status'])=='Standby given'){
												?>
													<button id ="edit" class="btn-mini btn-primary" 
													onclick="goEdit('<?php echo $record['comp_no'] ?>')" ><i 
													class="icon-pencil icon-white"></i> Update </button>
												<?php } ?>
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
function HWInv() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_invtry/';
}
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_ser_edit/' + id;
    }
}
function EmdbgAdd() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_compl_add/';
}
function EmdbgReg() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_out_add/';
}
function PrintGo(vnd, type) {
  var vnd = document.getElementById("vendor").value;
  if (vnd > 0) {
	window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_pdf/' + vnd;
  }else{
	alert ('Vendor not selected');
	window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_ser/';
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