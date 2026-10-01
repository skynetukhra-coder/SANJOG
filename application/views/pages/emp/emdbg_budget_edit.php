<?php
$bsl_no = isset($records['bsl_no']) ? $records['bsl_no'] : '';
$fin_yr = isset($records['fin_yr']) ? $records['fin_yr'] : '';
$budgt_catg = isset($records['budgt_catg']) ? $records['budgt_catg'] : '';
$trans_type = isset($records['trans_type']) ? $records['trans_type'] : '';
$buget_ref_no = isset($records['buget_ref_no']) ? $records['buget_ref_no'] : '';
$buget_ref_dt = isset($records['buget_ref_dt']) ? $records['buget_ref_dt'] : '';
$budgt_amt = isset($records['budgt_amt']) ? $records['budgt_amt'] : '';
$vendor_name = isset($records['vendor_name']) ? $records['vendor_name'] : '';
$vend_add = isset($records['vend_add']) ? $records['vend_add'] : '';
$appr_no = isset($records['appr_no']) ? $records['appr_no'] : '';
$appr_dt = isset($records['appr_dt']) ? $records['appr_dt'] : '';
$allot_no = isset($records['allot_no']) ? $records['allot_no'] : '';
$allot_dt = isset($records['allot_dt']) ? $records['allot_dt'] : '';
$allot_amt = isset($records['allot_amt']) ? $records['allot_amt'] : '';
$descrip = isset($records['descrip']) ? $records['descrip'] : '';

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
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="EmdbgBills()" >ADD Allotment</a></li>
						</ul>
					</div>
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="top-box">
									<div class="row">
										<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>BUDGET ALLOTMENT DETAILS</b></font></span></label>
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
											<td class="col_1">Budget Sl No</td>
											<td class="col_2"><input type="text" id="bsl_no" name="bsl_no" value="<?php echo $records['bsl_no'] ?>" class="form-control" readonly ></td>
										</tr>
										<tr>
											<td class="col_1">Entry Date</td>
											<td class="col_2"><input type="text" id="entry_dt" name="entry_dt" value="<?php echo get_datepicker_date($records['entry_dt']) ?>" class="form-control datepicker" ></td>
										</tr>
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
											<td class="col_1">Budget Category</td>
											<td class="col_2">
												<select id="budgt_catg" name="budgt_catg" class = "form-control" >
													<option data-value="1" value="AMC" <?=$records['budgt_catg']=='AMC' ? 'selected="selected"': '' ;?>>AMC</option>
													<option data-value="2" value="HARDWARE" <?=$records['budgt_catg']=='HARDWARE' ? 'selected="selected"': '' ;?>>HARDWARE</option>
													<option data-value="3" value="CONSUMABLES" <?=$records['budgt_catg']=='CONSUMABLES' ? 'selected="selected"': '' ;?>>CONSUMABLES</option>
													<option data-value="4" value="LAN" <?=$records['budgt_catg']=='LAN' ? 'selected="selected"': '' ;?>>LAN</option>
													<option data-value="5" value="SOFTWARE" <?=$records['budgt_catg']=='SOFTWARE' ? 'selected="selected"': '' ;?>>SOFTWARE</option>	
													<option data-value="6" value="SMS" <?=$records['budgt_catg']=='SMS' ? 'selected="selected"': '' ;?>>SMS</option>													
													<option data-value="7" value="OIOS" <?=$records['budgt_catg']=='OIOS' ? 'selected="selected"': '' ;?>>OIOS</option>
													<option data-value="8" value="ICT" <?=$records['budgt_catg']=='ICT' ? 'selected="selected"': '' ;?>>ICT</option>
													<option data-value="9" value="MACHINERY" <?=$records['budgt_catg']=='MACHINERY' ? 'selected="selected"': '' ;?>>MACHINERY</option>
													<option data-value="10" value="FURNITURE" <?=$records['budgt_catg']=='FURNITURE' ? 'selected="selected"': '' ;?>>FURNITURE</option>
													<option data-value="11" value="OTHER" <?=$records['budgt_catg']=='OTHER' ? 'selected="selected"': '' ;?>>OTHER</option>
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
													<option data-value="14" value="SMS" <?=$records['trans_type']=='SMS' ? 'selected="selected"': '' ;?>>SMS</option>													
													<option data-value="15" value="OIOS" <?=$records['trans_type']=='OIOS' ? 'selected="selected"': '' ;?>>OIOS</option>
													<option data-value="16" value="MACHINERY" <?=$records['trans_type']=='MACHINERY' ? 'selected="selected"': '' ;?>>MACHINERY</option>
													<option data-value="17" value="FURNITURE" <?=$records['trans_type']=='FURNITURE' ? 'selected="selected"': '' ;?>>FURNITURE & FIXTURE</option>
													<option data-value="18" value="OTHER" <?=$records['trans_type']=='OTHER' ? 'selected="selected"': '' ;?>>OTHER</option>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Budget No</td>
											<td class="col_2"><input type="text" id="buget_ref_no" name="buget_ref_no" value="<?php echo $records['buget_ref_no'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Budget Date</td>
											<td class="col_2"><input type="text" id="buget_ref_dt" name="buget_ref_dt" value="<?php echo get_datepicker_date($records['buget_ref_dt']) ?>" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Budget Amount</td>
											<td class="col_2"><input type="text" id="budgt_amt" name="budgt_amt" value="<?php echo $records['budgt_amt'] ?>" class="form-control" ></td>
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
											<td class="col_1">Approval No</td>
											<td class="col_2"><input type="text" id="appr_no" name="appr_no" value="<?php echo $records['appr_no'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Approval Date</td>
											<td class="col_2"><input type="text" id="appr_dt" name="appr_dt" value="<?php echo get_datepicker_date($records['appr_dt']) ?>" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Allotment No</td>
											<td class="col_2"><input type="text" id="allot_no" name="allot_no" value="<?php echo $records['allot_no'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Allotment Date</td>
											<td class="col_2"><input type="text" id="allot_dt" name="allot_dt" value="<?php echo get_datepicker_date($records['allot_dt']) ?>" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Allotment</td>
											<td class="col_2"><input type="text" id="allot_amt" name="allot_amt" value="<?php echo $records['allot_amt'] ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Description</td>
											<td class="col_2"><input type="text" id="descrip" name="descrip" value="<?php echo $records['descrip'] ?>" class="form-control" ></td>
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
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_budget/';
}
function warningApp(){
	
	alert("NOTICE:-\n\n** Add members of the your family as recorded in Service Book. ");
				
}
</script>