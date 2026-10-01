<?php
$emd_bg_no = isset($records['emd_bg_no']) ? $records['emd_bg_no'] : '';
$budgt_cat = isset($records['budgt_cat']) ? $records['budgt_cat'] : '';
$trans_type = isset($records['trans_type']) ? $records['trans_type'] : '';
$bill_no = isset($records['bill_no']) ? $records['bill_no'] : '';
$bill_dt = isset($records['bill_dt']) ? $records['bill_dt'] : '';
$entry_dt = isset($records['entry_dt']) ? $records['entry_dt'] : '';
$fin_yr = isset($records['fin_yr']) ? $records['fin_yr'] : '';
$vendor_name = isset($records['vendor_name']) ? $records['vendor_name'] : '';
$vend_add = isset($records['vend_add']) ? $records['vend_add'] : '';
$dd_no = isset($records['dd_no']) ? $records['dd_no'] : '';
$dd_dt = isset($records['dd_dt']) ? $records['dd_dt'] : '';
$amount = isset($records['amount']) ? $records['amount'] : '';
$paid_amt = isset($records['paid_amt']) ? $records['paid_amt'] : '';
$authority = isset($records['authority']) ? $records['authority'] : '';
$authority_dt = isset($records['authority_dt']) ? $records['authority_dt'] : '';
$file_no = isset($records['file_no']) ? $records['file_no'] : '';
$file_dt = isset($records['file_dt']) ? $records['file_dt'] : '';
$payment_ref = isset($records['payment_ref']) ? $records['payment_ref'] : '';
$payment_ref_dt = isset($records['payment_ref_dt']) ? $records['payment_ref_dt'] : '';
?>
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
							<li><a data-toggle="tab" href="#tab" onclick="EmdbgDtail()" >ADD EMD/BG Dtails</a></li>
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
												<option value="">--- Select Financial Year ---</option>
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
											<td class="col_1">EMD / BG No</td>
											<td class="col_2"><input type="text" id="emd_bg_no" name="emd_bg_no" value="<?php echo $records['emd_bg_no'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Budget Category</td>
											<td class="col_2">
												<select id="budgt_cat" name="budgt_cat" class = "form-control" >
													<option data-value="1" value="AMC" <?=$records['budgt_cat']=='AMC' ? 'selected="selected"': '' ;?>>AMC</option>
													<option data-value="2" value="HARDWARE" <?=$records['budgt_cat']=='HARDWARE' ? 'selected="selected"': '' ;?>>HARDWARE</option>
													<option data-value="5" value="CONSUMABLES" <?=$records['budgt_cat']=='CONSUMABLES' ? 'selected="selected"': '' ;?>>CONSUMABLES</option>
													<option data-value="7" value="LAN" <?=$records['budgt_cat']=='LAN' ? 'selected="selected"': '' ;?>>LAN</option>
													<option data-value="8" value="SOFTWARE" <?=$records['budgt_cat']=='SOFTWARE' ? 'selected="selected"': '' ;?>>SOFTWARE</option>	
													<option data-value="9" value="SMS" <?=$records['budgt_cat']=='SMS' ? 'selected="selected"': '' ;?>>SMS</option>
													<option data-value="10" value="MACHINERY" <?=$records['budgt_cat']=='MACHINERY' ? 'selected="selected"': '' ;?>>MACHINERY</option>																				
													<option data-value="11" value="OIOS" <?=$records['budgt_cat']=='OIOS' ? 'selected="selected"': '' ;?>>OIOS</option>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Transaction Type</td>
											<td class="col_2">
												<select id="trans_type" name="trans_type" class = "form-control" >
													<option data-value="1" value="AMC HW" <?=$records['trans_type']=='AMC HW' ? 'selected="selected"': '' ;?>>AMC HW</option>
													<option data-value="2" value="AMC UPS" <?=$records['trans_type']=='AMC UPS' ? 'selected="selected"': '' ;?>>AMC UPS</option>
													<option data-value="3" value="AMC LIPI" <?=$records['trans_type']=='AMC LIPI' ? 'selected="selected"': '' ;?>>AMC LIPI</option>
													<option data-value="4" value="HARDWARE" <?=$records['trans_type']=='HARDWARE' ? 'selected="selected"': '' ;?>>HARDWARE</option>
													<option data-value="5" value="DESKTOP" <?=$records['trans_type']=='DESKTOP' ? 'selected="selected"': '' ;?>>DESKTOP</option>
													<option data-value="6" value="LAPTOP" <?=$records['trans_type']=='LAPTOP' ? 'selected="selected"': '' ;?>>LAPTOP</option>
													<option data-value="7" value="CONSUMABLES" <?=$records['trans_type']=='CONSUMABLES' ? 'selected="selected"': '' ;?>>CONSUMABLES</option>
													<option data-value="8" value="BATTERY" <?=$records['trans_type']=='BATTERY' ? 'selected="selected"': '' ;?>>BATTERY</option>
													<option data-value="9" value="LAN" <?=$records['trans_type']=='LAN' ? 'selected="selected"': '' ;?>>LAN</option>
													<option data-value="10" value="SOFTWARE" <?=$records['trans_type']=='SOFTWARE' ? 'selected="selected"': '' ;?>>SOFTWARE</option>	
													<option data-value="11" value="GPF" <?=$records['trans_type']=='GPF' ? 'selected="selected"': '' ;?>>GPF</option>													
													<option data-value="12" value="VLC" <?=$records['trans_type']=='VLC' ? 'selected="selected"': '' ;?>>VLC</option>
													<option data-value="13" value="PSAI" <?=$records['trans_type']=='PSAI' ? 'selected="selected"': '' ;?>>PSAI</option>
													<option data-value="9" value="SMS" <?=$records['trans_type']=='SMS' ? 'selected="selected"': '' ;?>>SMS</option>
													<option data-value="10" value="MACHINERY" <?=$records['trans_type']=='MACHINERY' ? 'selected="selected"': '' ;?>>MACHINERY</option>													
													<option data-value="11" value="OIOS" <?=$records['trans_type']=='OIOS' ? 'selected="selected"': '' ;?>>OIOS</option>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Bill No</td>
											<td class="col_2"><input type="text" id="bill_no" name="bill_no" value="<?php echo $records['bill_no'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Bill Date</td>
											<td class="col_2"><input type="text" id="bill_dt" name="bill_dt" value="<?php echo get_datepicker_date($records['bill_dt']) ?>" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Vendor Name</td>
											<td class="col_2">
											<select  id="vendor_nm" name="vendor_name" class="form-control" required>
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
											<td class="col_2"><input type="text" id="dd_no" name="dd_no" value="<?php echo $records['dd_no'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">DD / Cheque Date</td>
											<td class="col_2"><input type="text" id="dd_dt" name="dd_dt" value="<?php echo get_datepicker_date($records['dd_dt']) ?>" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Amount</td>
											<td class="col_2"><input type="text" id="amount" name="amount" value="<?php echo $records['amount'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Amount Paid</td>
											<td class="col_2"><input type="text" id="paid_amt" name="paid_amt" value="<?php echo $records['paid_amt'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Authority</td>
											<td class="col_2"><input type="text" id="authority" name="authority" value="<?php echo $records['authority'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Authority Date</td>
											<td class="col_2"><input type="text" id="authority_dt" name="authority_dt" value="<?php echo get_datepicker_date($records['authority_dt']) ?>" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">File No</td>
											<td class="col_2"><input type="text" id="file_no" name="file_no" value="<?php echo $records['file_no'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">File Date</td>
											<td class="col_2"><input type="text" id="file_dt" name="file_dt" value="<?php echo get_datepicker_date($records['file_dt']) ?>" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Payment Ref No</td>
											<td class="col_2"><input type="text" id="payment_ref" name="payment_ref" value="<?php echo $records['payment_ref'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Payment Ref Date</td>
											<td class="col_2"><input type="text" id="payment_ref_dt" name="payment_ref_dt" value="<?php echo get_datepicker_date($records['payment_ref_dt']) ?>" class="form-control datepicker" ></td>
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