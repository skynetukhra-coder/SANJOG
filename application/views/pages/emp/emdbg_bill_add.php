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
							<li><a data-toggle="tab" href="#tab3" onclick="EmdVend()" >Add Vendor</a></li>
							<li><a data-toggle="tab" href="#tab" onclick="EmdbgDtail()" >ADD EMD/BG Details</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="EmdbgBills()" >ADD EMD/BG Bills</a></li>
						</ul>
					</div>
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="top-box">
									<div class="row">
										<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>EMD / BG / BILL DETAILS</b></font></span></label>
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
											<td class="col_1">Financial Year</td>
											<td class="col_2">
												<select  id="fin_yr" name="fin_yr" class="form-control" required>
												<option value="">---- Select ----</option>
												<?php
													if(isset($years)){
														foreach($years as $year){
															echo '<option value="'.$year['fin_year'].'">'.$year['fin_year'].'</option>';
														}
													}
												?>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">EMD / BG  No</td>
											<td class="col_2">
												<select id="emd_bg_no" name="emd_bg_no" class = "form-control" required >
												<option value="">---- Select ----</option>
													<?php
													if(isset($emdbg_slno) && !empty($emdbg_slno)){
														foreach($emdbg_slno as $slno){
															echo '<option value="'.$slno['sl_no'].'">'.$slno['sl_no'].'</option>';
														}
													}
													?>
											</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Budget Category</td>
											<td class="col_2">
												<select id="budg_cat" name="budg_cat" class = "form-control" >
													<option data-value="0" value="AMC HW" >--- select ---</option>
													<option data-value="1" value="AMC" >AMC</option>
													<option data-value="2" value="HARDWARE" >HARDWARE</option>
													<option data-value="2" value="CONSUMABLES" >CONSUMABLES</option>
													<option data-value="4" value="LAN" >LAN</option>
													<option data-value="5" value="SOFTWARE" >SOFTWARE</option>										
													<option data-value="6" value="SMS" >SMS</option>
													<option data-value="7" value="MACHINERY" >MACHINERY</option>
													<option data-value="8" value="OIOS" >OIOS</option>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Transaction Type</td>
											<td class="col_2">
												<select id="trans_type" name="trans_type" class = "form-control" >
													<option data-value="0" value="AMC" >---- Select ----</option>
													<option data-value="1" value="AMC HW" >AMC HW</option>
													<option data-value="2" value="AMC UPS" >AMC UPS</option>
													<option data-value="3" value="AMC LIPI" >AMC LIPI</option>
													<option data-value="4" value="HARDWARE" >HARDWARE</option>
													<option data-value="5" value="DESKTOP" >DESKTOP</option>
													<option data-value="6" value="LAPTOP" >LAPTOP</option>
													<option data-value="7" value="CONSUMABLES" >CONSUMABLES</option>
													<option data-value="8" value="BATTERY" >BATTERY</option>
													<option data-value="9" value="LAN" >LAN</option>
													<option data-value="10" value="SOFTWARE" >SOFTWARE</option>	
													<option data-value="11" value="GPF" >GPF</option>													
													<option data-value="12" value="VLC" >VLC</option>
													<option data-value="13" value="PSAI" >PSAI</option>
													<option data-value="14" value="SMS" >SMS</option>
													<option data-value="15" value="MACHINERY" >MACHINERY</option>
													<option data-value="16" value="OIOS" >OIOS</option>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Bill No</td>
											<td class="col_2"><input type="text" id="bill_no" name="bill_no" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Bill Date</td>
											<td class="col_2"><input type="text" id="bill_dt" name="bill_dt" value="" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Vendor Name</td>
											<td class="col_2">
											<select  id="vendor_nm" name="vendor_name" class="form-control" >
												<option value="">--- Select Vendor ---</option>
												<?php
													if(isset($vendors)){
														foreach($vendors as $vendor){
															echo '<option value="'.$vendor['vendor_nm'].'">'.$vendor['vendor_nm'].'</option>';
														}
													}
												?>
											</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">DD / Cheque No</td>
											<td class="col_2"><input type="text" id="dd_no" name="dd_no" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">DD / Cheque Date</td>
											<td class="col_2"><input type="text" id="dd_dt" name="dd_dt" value="" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Amount</td>
											<td class="col_2"><input type="text" id="amount" name="amount" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Amount Payable</td>
											<td class="col_2"><input type="text" id="paid_amt" name="paid_amt" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Authority</td>
											<td class="col_2"><input type="text" id="authority" name="authority" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Authority Date</td>
											<td class="col_2"><input type="text" id="authority_dt" name="authority_dt" value="" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">File No</td>
											<td class="col_2"><input type="text" id="file_no" name="file_no" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">File Date</td>
											<td class="col_2"><input type="text" id="file_dt" name="file_dt" value="" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Payment Ref No</td>
											<td class="col_2"><input type="text" id="payment_ref" name="payment_ref" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Payment Ref Date</td>
											<td class="col_2"><input type="text" id="payment_ref_dt" name="payment_ref_dt" value="" class="form-control datepicker" ></td>
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
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_reg/';
}
function warningApp(){
	
	alert("NOTICE:-\n\n** Add members of the your family as recorded in Service Book. ");
				
}
</script>