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
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>All Procurement Bills</strong></h4>
				<div class="col-md-5 col-sm-12" style = " float: right; text-align:center; font-size: 14px">
					<button type="button" class="btn-success btn-xm" onclick="ProcAdd()" style="padding-top: 5px">Add Invoice</button>
					<button type="button" class="btn-warning btn-xm" onclick="EmdbgReg()" style="padding-top: 5px">Bill Register</button>
					<button type="button" class="btn-primary btn-xm" onclick="EmdbgBedt()" style="padding-top: 5px">Budget</button>
					<button type="button" class="btn-warning btn-xm" onclick="EmdbgBugRept()" style="padding-top: 5px">Report</button>
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
											 <label class="name-label">Year :</label>
												  <select  id="fin_year" name="fin_year" class="form-control" >
													<option value="">--- Select ---</option>
													<?php
														if(isset($years)){
															foreach($years as $year){
																echo '<option value="'.$year['fin_year'].'">'.$year['fin_year'].'</option>';
															}
														}
													?>
												</select>
											</div>
											<div class="col-sm-4">
											 <label class="name-label">Category :</label>
												<select id="budget_cat" name="budget_cat" class = "form-control" >
													<option data-value="0" value="" >--- select ---</option>
													<option data-value="1" value="AMC" >AMC</option>
													<option data-value="2" value="HARDWARE" >HARDWARE</option>
													<option data-value="2" value="CONSUMABLES" >CONSUMABLES</option>
													<option data-value="4" value="LAN" >LAN</option>
													<option data-value="5" value="SOFTWARE" >SOFTWARE</option>										
													<option data-value="6" value="SMS" >SMS</option>
													<option data-value="7" value="OIOS" >OIOS</option>
													<option data-value="8" value="MACHINERY" >MACHINERY</option>
													<option data-value="9" value="OTHER" >OTHER</option>
												</select>
											</div>
											<div class="col-sm-4">
											 <label class="name-label">Search :</label>
											  <input type="text" id="search" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" Placeholder ="Invoice No / Amount ..." />
											</div>
											<div class="col-sm-2">
											 <label class="name-label">Reg SL No :</label>
											  <input type="text" id="invsl_no" name="invsl_no" value="<?php echo $this->input->get('invsl_no',true)?>" class="form-control" Placeholder ="Inv SL No" />
											</div>
											<div class="col-sm-2"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Sl No/ Fin Year</th>
								<th style="text-align:center">Vendor</th>
								<th style="text-align:center">NIQ/ NIQ Date</th>
								<th style="text-align:center">Invoice No & Date</th>
								<th style="text-align:center">Category / Purpose</th>
								<th style="text-align:center">PO No & Date</th>
								<th style="text-align:center">Bill Amount</th>
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
											<td><?php echo $record['invsl_no'] ?><br><?php echo $record['fin_yr'] ?></br></td>
											<td><?php echo $record['vend_nm'] ?></td>
											<td><?php echo $record['niq_no'] ?><br><?php echo get_datepicker_date($record['niq_dt']) ?></br></td>
											<td><?php echo $record['inv_no'] ?><br><?php echo get_datepicker_date($record['inv_dt']) ?></br></td>
											<td><?php echo $record['budg_cat'] ?> -- <br><?php echo $record['purpos'] ?></br></td>
											<td><?php echo $record['po_letter_no'] ?><br><?php echo get_datepicker_date($record['po_letter_dt']) ?></br></td>
											<td style="font-size:11px"><?php echo $record['bill_amt'] ?><br><?php if ($record['invoc_amt'] != $record['bill_amt']){echo '/ Invoice-'.$record['invoc_amt'];} ?></br></td>											
											<td>
												<button id ="edit" class="btn-mini btn-primary" 
												onclick="goEdit('<?php echo $record['invoice_id'] ?>')" ><i 
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
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_proc_edit/' + id;
    }
}
function ProcAdd() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_proc_add/';
}
function EmdbgReg() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_invoice_reg/';
}
function EmdbgBedt() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_budget/';
}
function EmdbgBugRept() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_budget_rept/';
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