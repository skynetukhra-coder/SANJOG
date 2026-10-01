<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; EMD/BG</div>
			
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab1" onclick="FinYr()" >Add Financial Year</a></li>
							<li ><a data-toggle="tab" href="#tab2" onclick="EmdBank()" >Add Bank</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab3" onclick="EmdVend()" >Add Vendor</a></li>
							<li><a data-toggle="tab" href="#tab" onclick="EmdbgDtail()" >ADD EMD/BG Details</a></li>
							<li><a data-toggle="tab" href="#tab" onclick="EmdbgBills()" >ADD EMD/BG Bills</a></li>
						</ul>
					</div>
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="top-box">
									<div class="row">
										<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>VENDOR DETAILS</b></font></span></label>
									</div>								
								</div>
							</div>
							
							<div class="col-sm-12">
								<table class="table1" border="1" style="width:100%">
									<thead>
										<tr style="text-align:center">
											<th style="text-align:center; width:40%;"><strong>Description</strong></th>
											<th style="text-align:center; width:60%;"><strong>Information</strong></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="col_1">Vendor Name</td>
											<td class="col_2"><input type="text" id="vendor_nm" name="vendor_nm" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Wheter for AMC?</td>
											<td class="col_2">
												<select id="amc" name="amc" class="form-control" >
													<option data-value="0" value="">--Select--</option>
													<option data-value="1" value="Yes"> Yes </option>	
													<option data-value="2" value="No"> No </option>
															
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Vendor Address</td>
											<td class="col_2"><input type="text" id="vendor_add" name="vendor_add" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Office Email ID</td>
											<td class="col_2"><input type="text" id="ven_email" name="ven_email" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Office Phone</td>
											<td class="col_2"><input type="text" id="ven_phno" name="ven_phno" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Representative Name</td>
											<td class="col_2"><input type="text" id="rep_nm" name="rep_nm" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Mobile No</td>
											<td class="col_2"><input type="text" id="mbno" name="mbno" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Email ID</td>
											<td class="col_2"><input type="text" id="rep_mail" name="rep_mail" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Representative Name</td>
											<td class="col_2"><input type="text" id="repr_nm" name="repr_nm" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Contact No</td>
											<td class="col_2"><input type="text" id="ph_no" name="ph_no" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Email ID</td>
											<td class="col_2"><input type="text" id="repr_mail" name="repr_mail" value="" class="form-control" ></td>
										</tr>
								</table>
							</div>
							<div>&nbsp;	</div>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="myCanl();" value="Cancel" />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit" />
										</div>
									</div>
								</div>
							</div>
							<?php 
							if(isset($application) && !empty($application)){?>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6"> <strong>** Last applied on: <?php echo get_datepicker_date($application['applied_on']);?></strong> </div>
									</div>
								</div>
							</div>
							<?php
							}?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
function show_hide_submit(){
	if($('#i_agree').is(':checked')){
		$('#submit_btn').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function EmdbgDtail() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_add/';
}
function EmdbgBills() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_bill_add/';
}
function FinYr() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_finyr_add/';
    //}
}
function EmdBank() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_bank_add/';
    //}
}
function EmdVend() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_vendor_add/';
    //}
}
function myCanl() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_all/';
}
function warningApp(){
	
	alert("NOTICE:-\n\n** Add members of the your family as recorded in Service Book. ");
				
}
</script>