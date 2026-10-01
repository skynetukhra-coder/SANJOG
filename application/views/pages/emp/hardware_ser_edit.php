<?php
$yr_sl_no = isset($records['yr_sl_no']) ? $records['yr_sl_no'] : '';
$item = isset($records['item']) ? $records['item'] : '';
$brand = isset($records['brand']) ? $records['brand'] : '';
$descp = isset($records['descp']) ? $records['descp'] : '';
$section = isset($records['section']) ? $records['section'] : '';
$mach_no = isset($records['mach_no']) ? $records['mach_no'] : '';
//$amc_yr = isset($records['amc_yr']) ? $records['amc_yr'] : '';
$remk = isset($records['remk']) ? $records['remk'] : '';

$compt_no = isset($details['compt_no']) ? $details['compt_no'] : '';
$out_date = isset($details['out_date']) ? $details['out_date'] : '';
$vendor = isset($details['vendor']) ? $details['vendor'] : '';
$vendor_rep_nm = isset($details['vendor_rep_nm']) ? $details['vendor_rep_nm'] : '';
$recpt_date = isset($details['recpt_date']) ? $details['recpt_date'] : '';
$status = isset($details['status']) ? $details['status'] : '';
$standby_info = isset($details['standby_info']) ? $details['standby_info'] : '';
?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; AMC Service</div>
			
			<div class="login-box">
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
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="top-box">
									<div class="row">
										<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>Record Update</b></font></span></label>
									</div>								
								</div>
							</div>
							
							<div class="col-sm-12">
								<table class="table1" border="1" style="width:100%">
									<thead>
										<tr style="text-align:center">
											<th style="text-align:center; width:30%;"><strong>Description</strong></th>
											<th style="text-align:center; width:70%;"><strong>Information</strong></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="col_1">COMPLAINT SL NUMBER*</td>
											<td class="col_2"><input type="text" id="yr_sl_no" name="yr_sl_no" value="<?php if (!empty($records['yr_sl_no'])){echo $records['yr_sl_no'];}else{echo $records['comp_no'];} ?>" class="form-control" readonly ></td>
										</tr>
										<tr>
											<td class="col_1">AMC  YEAR</td>
											<!--
											<td class="col_2">
											   <select  id="amc_yr" name="amc_yr" class="form-control" required >
													<option value="">--- Select Year ---</option>
													<?php
														if(isset($amc_yr)){
															foreach($amc_yr as $amc_yr){
																echo '<option value="'.$amc_yr['fin_year'].'">'.$amc_yr['fin_year'].'</option>';
															}
														}
													?>
												</select>
											</td>
											-->
											<td class="col_2"><input type="text" id="amc_yr" name="amc_yr" value="<?php echo $records['amc_yr']; ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">ITEM SERIAL NO</td>
											<td class="col_2"><input type="text" id="item" name="item" value="<?php echo $records['item']; ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">BRAND NAME</td>
											<td class="col_2"><input type="text" id="brand" name="brand" value="<?php echo $records['brand']; ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">DETAILED  DESCRIPTION</td>
											<td class="col_2"><input type="text" id="descp" name="descp" value="<?php echo $records['descp']; ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">NAME OF SECTION</td>
											<!--
											<td class="col_2">
												<select id="section" name="section" class = "form-control" required >
													<option value="">--Select--</option>
													<?php
													if(isset($section_list) && !empty($section_list)){
														foreach($section_list as $sections){
															echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
														}
													}
													?>
												</select>
											</td>
											-->
											<td class="col_2"><input type="text" id="section" name="section" value="<?php echo $records['section']; ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">MACHINE NO</td>
											<td class="col_2"><input type="text" id="mach_no" name="mach_no" value="<?php echo $records['mach_no']; ?>" class="form-control" ></td>
										</tr>
										
										<tr>
											<td class="col_1">REMARKS</td>
											<td class="col_2"><input type="text" id="remk" name="remk" value="<?php echo $records['remk']; ?>" class="form-control" ></td>
										</tr>
										
										<tr>
											<td class="col_1">OUTWARD DATE:</td>
											<td class="col_2"><input type="text" id="out_date" name="out_date" value="<?php echo get_datepicker_date($details['out_date']); ?>" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">VENDOR's NAME:</td>
										<!--
											<td class="col_2">
												<select id="vendor" name="vendor" class = "form-control" required >
													<option value="">--Select--</option>
													<?php
													if(isset($vendors) && !empty($vendors)){
														foreach($vendors as $vendor){
															echo '<option value="'.$vendor['vendor_nm'].'">'.$vendor['vendor_nm'].'</option>';
														}
													}
													?>
												</select>
											</td>
										-->
												<td class="col_2"><input type="text" id="vendor" name="vendor" value="<?php echo $details['vendor']; ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">NAME OF REPRESENTATIVE:</td>
											<td class="col_2"><input type="text" id="vendor_rep_nm" name="vendor_rep_nm" value="<?php echo $details['vendor_rep_nm']; ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">RECEIPT DATE:</td>
											<td class="col_2"><input type="text" id="recpt_date" name="recpt_date" value="<?php echo get_datepicker_date($details['recpt_date']); ?>" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">REPLACEMENT OR STANDBY</td>
											<td class="col_2"><input type="text" id="standby_info" name="standby_info" value="<?php echo $details['standby_info']; ?>" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">STATUS:</td>
											<td class="col_2">
												<select id="status" name="status" class="form-control" required >
													<option data-value="0" value="">--Select--</option>
													<option data-value="1" value="Pending"> Pending </option>
													<option data-value="2" value="Resolved"> Resolved </option>	
													<option data-value="3" value="Replacement Given"> Replacement Given </option>
													<option data-value="3" value="Stand by Given"> Stand by Given </option>		
												</select>
											</td>
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
										<div class="col-sm-6"> <strong>** Date: <?php //echo get_datepicker_date($application['applied_on']);?></strong> </div>
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

function myCanl() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_ser/';
}
function warningApp(){
	
	alert("NOTICE:-\n\n** Add members of the your family as recorded in Service Book. ");
				
}
</script>