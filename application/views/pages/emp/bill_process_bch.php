<?php
$bill_id = isset($records['bill_id']) ? $records['bill_id'] : '';
$empid = isset($records['empid']) ? $records['empid'] : '';
$name = isset($records['name']) ? $records['name'] : '';
$desig = isset($records['desig']) ? $records['desig'] : '';
$emp_section = isset($records['emp_section']) ? $records['emp_section'] : '';
$group_nm = isset($records['group_nm']) ? $records['group_nm'] : '';
$office_nm = isset($records['office_nm']) ? $records['office_nm'] : '';
$basic_pay = isset($records['basic_pay']) ? $records['basic_pay'] : '';
$bill_type = isset($records['bill_type']) ? $records['bill_type'] : '';
$description = isset($records['description']) ? $records['description'] : '';
$bill_no = isset($records['bill_no']) ? $records['bill_no'] : '';
$bill_date = isset($records['bill_date']) ? $records['bill_date'] : '';
$bill_amount = isset($records['bill_amount']) ? $records['bill_amount'] : '';
$advance_bill_no = isset($records['advance_bill_no']) ? $records['advance_bill_no'] : '';
$from_date = isset($records['from_date']) ? $records['from_date'] : '';
$to_date = isset($records['to_date']) ? $records['to_date'] : '';
$block = isset($records['block']) ? $records['block'] : '';
$child_no = isset($records['child_no']) ? $records['child_no'] : '';
$child_name = isset($records['child_name']) ? $records['child_name'] : '';
$location = isset($records['location']) ? $records['location'] : '';
$treatment_type	= isset($records['treatment_type']) ? $records['treatment_type'] : '';
$doctor = isset($records['doctor']) ? $records['doctor'] : '';
$fit_unfit = isset($records['fit_unfit']) ? $records['fit_unfit'] : '';
$reimburse_amt = isset($records['reimburse_amt']) ? $records['reimburse_amt'] : '';
$tax_deduct_amt = isset($records['tax_deduct_amt']) ? $records['tax_deduct_amt'] : '';
$amount_paid = isset($records['amount_paid']) ? $records['amount_paid'] : '';
$payment_date = isset($records['payment_date']) ? $records['payment_date'] : '';
$applied_on = isset($records['applied_on']) ? $records['applied_on'] : '';
$attachment = isset($records['attachment']) ? $records['attachment'] : '';

$aao_name = isset($records['aao_name']) ? $records['aao_name'] : '';
$aao_desig = isset($records['aao_desig']) ? $records['aao_desig'] : '';
$aao_remrk = isset($records['aao_remrk']) ? $records['aao_remrk'] : '';
$aao_dt = isset($records['aao_dt']) ? $records['aao_dt'] : '';
$sao_name = isset($records['sao_name']) ? $records['sao_name'] : '';
$sao_desig = isset($records['sao_desig']) ? $records['sao_desig'] : '';
$sao_remrk = isset($records['sao_remrk']) ? $records['sao_remrk'] : '';
$sao_dt = isset($records['sao_dt']) ? $records['sao_dt'] : '';
$dag_name = isset($records['dag_name']) ? $records['dag_name'] : '';
$dag_desig = isset($records['dag_desig']) ? $records['dag_desig'] : '';
$dag_remrk = isset($records['dag_remrk']) ? $records['dag_remrk'] : '';
$dag_dt = isset($records['dag_dt']) ? $records['dag_dt'] : '';
$pag_name = isset($records['pag_name']) ? $records['pag_name'] : '';
$pag_desig = isset($records['pag_desig']) ? $records['pag_desig'] : '';
$pag_remrk = isset($records['pag_remrk']) ? $records['pag_remrk'] : '';
$pag_dt = isset($records['pag_dt']) ? $records['pag_dt'] : '';
?>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_application'); ?> </div>
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
			<div class="login-box">
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" align="center"><font color="#1E0BA9"><b>BILL PROCESSING </b></font></span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Full Name (as per Service Book)<span class="star">*</span></label>
										<input name="name" value="<?php echo $records['name'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee ID<span class="star">*</span></label>
										<input name="empid" value="<?php echo $records['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name<span class="star">*</span></label>
										<input name="office_nm" value="<?php echo $records['office_nm'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input name="desig" type="text" value="<?php echo $records['desig'] ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input name="basic_pay" type="text"  value="<?php echo $records['basic_pay'] ?>" class="form-control" readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input name="emp_section"  type="text" value="<?php echo $records['emp_section'] ?>" class="form-control" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input name="group_nm"  type="text" value="<?php echo $records['group_nm'] ?>" class="form-control" readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input name="" type="text" value="<?php //echo $records['mbno'] ?>" class="form-control" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Bill Type <span class="star"></span></label>
											<select id="bill_type" name="bill_type" onselect="disable_inputbox()" class="form-control"  disabled="disabled">
												<option value=""> -- Select Bill--</option>
												<option data-value="1" value="Adjustment Bill"<?=$records['bill_type'] == 'Adjustment Bill' ? 'selected' : ''?> >Adjustment Bill</option>
												<option data-value="2" value="Advance Bill"<? =$records['bill_type'] == 'Advance Bill' ? 'selected' : ''?> >Advance Bill</option>
												<option data-value="3" value="Education Allowance Bill"<? =$records['bill_type'] == 'Education Allowance Bill' ? 'selected' : ''?> >Education Allowance Bill</option>
												<option data-value="4" value="Medical Bill"<? =$records['bill_type'] == 'Medical Bill' ? 'selected' : ''?> >Medical Bill</option>
												<option data-value="5" value="News Paper Bill"<?=$records['bill_type'] == 'News Paper Bill' ? 'selected' : ''?> >News Paper Bill</option>
												<option data-value="6" value="LTC Bill"<?=$records['bill_type'] == 'LTC Bill' ? 'selected' : ''?> >LTC Bill</option>
												<option data-value="7" value="TA Bill" <?=$records['bill_type'] == 'TA Bill' ? 'selected' : ''?> >TA Bill</option>
											</select>							
									</div>
									<div class="col-md-8 col-sm-6">
										<label class="name">Description / Purpose <span class="star"></span></label>
										<input name="description" type="text" value="<?php echo $records['description'] ?>" class="form-control" readonly >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Bill SL No</label>
											<input name="bill_no" type="text" value="<?php echo $records['bill_no'] ?>" class="form-control" readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Bill Date</label>
												<input name="bill_date" type="text" value="<?php echo $records['bill_date'] ?>" class="form-control datepicker" readonly >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Bill Amount</label>
												<input name="bill_amount" type="text" value="<?php echo $records['bill_amount'] ?>" class="form-control"  readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Advance Bill No</label>
												<input id="advance_bill_no" name="advance_bill_no" type="text" value="<?php echo $records['advance_bill_no'] ?>" class="form-control" disabled="disabled" >
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Year</label>
												<input id="bill_year"name="bill_year" type="text" value="<?php echo $records['bill_year'] ?>"  class="form-control"  readonly >
											</div>
											<div class="col-sm-6">
												<label class="name">Block Year/ Session</label>
												<input id="block" name="block" type="text" value="<?php echo $records['block'] ?>" class="form-control" disabled="disabled" >
											</div>
											
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name"> From <span class="star"></span></label>
												<input id="from_date" name="from_date" type="text" value="<?php echo $records['from_date'] ?>" class="form-control datepicker" disabled="disabled" >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name"> To </label>
												<input id="to_date"name="to_date" type="text" value="<?php echo $records['to_date'] ?>"class="form-control datepicker" disabled="disabled" >
											</div>
										</div>
									</div>
									
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Destination</label>
												<input id="visit_to" name="visit_to" type="text" value="<?php echo $records['visit_to'] ?>" class="form-control " disabled="disabled"  >
											</div>
											<div class="col-sm-6">
												<label class="name">Journey Mode</label>
												<input id="journey_mode" name="journey_mode" type="text" value="<?php echo $records['journey_mode'] ?>" class="form-control " disabled="disabled"  >
											</div>
										</div>
									</div>
									
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Class</label>
												<select id="edu_class" name="edu_class"onselect="disable_inputbox()"  class="form-control"  disabled="disabled"  >
													<option value=""> ---- Select Class ----</option>
													<option data-value="1" value="Class-I(Pre-I)"<?=$records['edu_class'] == 'Class-I(Pre-I)' ? 'selected' : ''?> >Class-I(Pre-I)</option>
													<option data-value="2" value="Class-1(Pre-II)"<?=$records['edu_class'] == 'Class-1(Pre-II)' ? 'selected' : ''?> >Class-1(Pre-II)</option>
													<option data-value="3" value=">Class-II"<?=$records['edu_class'] == '>Class-II' ? 'selected' : ''?> >Class-II</option>
													<option data-value="4" value="Class-III<?=$records['edu_class'] == 'Class-III' ? 'selected' : ''?> >Class-III</option>
													<option data-value="5" value="Class-IV"<?=$records['edu_class'] == 'Class-IV' ? 'selected' : ''?> >Class-IV</option>
													<option data-value="6" value="Class-V"<?=$records['edu_class'] == 'Class-V' ? 'selected' : ''?> >Class-V</option>
													<option data-value="7" value="Class-VI"<?=$records['edu_class'] == 'Class-VI' ? 'selected' : ''?> >Class-VI</option>
													<option data-value="8" value="Class-VII"<?=$records['edu_class'] == 'Class-VII' ? 'selected' : ''?> >Class-VII</option>
													<option data-value="9" value="Class-VIII<?=$records['edu_class'] == 'Class-VIII' ? 'selected' : ''?> >Class-VIII</option>
													<option data-value="10" value="Class-IX"<?=$records['edu_class'] == 'Class-IX' ? 'selected' : ''?> >Class-IX</option>
													<option data-value="11" value="Class-X"<?=$records['edu_class'] == 'Class-X' ? 'selected' : ''?> >Class-X</option>
													<option data-value="12" value="Class-XI"<?=$records['edu_class'] == 'Class-XI' ? 'selected' : ''?> >Class-XI</option>
													<option data-value="13" value="Class-XII"<?=$records['edu_class'] == 'Class-XII' ? 'selected' : ''?> >Class-XII</option>
												</select>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Child Name</label>
												<select id = "child_name" name="child_name" style="height:40px; width:180px; font-size: 12px;" disabled="disabled" >
													<option value=""> -- Select Child --</option>
													<?php
														if(isset($records) && !empty($records)){
															foreach($records as $memb){
																echo '<option value="'.$memb['member_name'].'">'.$memb['member_name'].'</option>';
															}
														}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>	
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div>
											<label class="name"> Name of Institution / Clinic / Hospital </label>
											<input id="loc_inst_hosp" name="loc_inst_hosp" type="text" value="<?php echo $records['loc_inst_hosp'] ?>" class="form-control"  disabled="disabled" >
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div>
											<label class="name"> Address of Institution / Clinic / Hospital</label>
											<input id="loc_address" name="loc_address" type="text" value="<?php echo $records['loc_address'] ?>" class="form-control"  disabled="disabled" >
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Treatement Type</label>
												<select id="treatment_type" name="treatment_type"onselect="disable_inputbox()" name="year" class="form-control"  disabled="disabled" >
													<option value=""> ---- Select Type ----</option>
													<option data-value="2" value="AMA"<?=$records['treatment_type'] == 'AMA' ? 'selected' : ''?> >AMA</option>
													<option data-value="1" value="CGHS"<?=$records['treatment_type'] == 'CGHS' ? 'selected' : ''?> >CGHS</option>
												</select>
											</div>
											<div class="col-sm-6">
												<label class="name">Doctor's Name</label>
												<input id="doctor" name="doctor" type="text" value="<?php echo $records['doctor'] ?>" class="form-control " disabled="disabled"  >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name1">Fit Certificte submitted</label>
												<select id="fit_unfit" name="fit_unfit" onselect="disable_inputbox()"  class="form-control"  disabled="disabled" >
													<option value=""> ---- Select Type ----</option>
													<option data-value="2" value="Yes"<?=$records['fit_unfit'] == 'Yes' ? 'selected' : ''?> >Yes</option>
													<option data-value="1" value="No"<?=$records['fit_unfit'] == 'No' ? 'selected' : ''?> >No</option>
												</select>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
<!--
												<label class="name"> Tttttt </label>
												<input id="to_date"name="to_date" type="text" class="form-control datepicker" disabled="disabled" >
-->
											</div>
										</div>
									</div>
								</div>
							</div>	
							
							<div class="col-sm-12"title ="Borwse to upload supporting docuemnts.">
								<div class="form-group row">
									<div class="col-md-8 col-sm-8">
										<label class="control-label">Upload supporting documents. (single .pdf only)</label>
										<input id="attachment" type="file" name="attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
									<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($attachment != ''){echo '&nbsp;<a href="'.base_url().'files/agae/leave_documents/'.$attachment.'" target="_blank">'.$attachment.'</a>';}?></span>
									</div>
								</div>
							</div>
<!--  Checker  -->
							<div class="col-sm-12">
								<div class="btn-wrap">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-4 name-mrgbtm">
										<label class="name">Reimbursable Amount</span></label>
										<input name="reimburse_amt" type="text" value="<?php echo $records['reimburse_amt'] ?>" class="form-control" >
									</div>
									<div class="col-md-3 col-sm-4 name-mrgbtm">
										<label class="name">Tax Deduction</span></label>
										<input name="tax_deduct_amt" type="text" value="<?php echo $records['tax_deduct_amt'] ?>" class="form-control" >
									</div>
									<div class="col-md-3 col-sm-4 name-mrgbtm">
										<label class="name">Amount Payable</span></label>
										<input name="amount_paid" type="text" value="<?php echo $records['amount_paid'] ?>" class="form-control" >
									</div>
									<div class="col-md-3 col-sm-4 name-mrgbtm">
										<label class="name">Application Status </span></label>
										<select id="appli_status"  name="appli_status" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Submitted" <?=$records['appli_status']=='Submitted' ? 'selected="selected"': '' ;?>>Submitted</option>
											<option data-value="2" value="Under Varification" <?=$records['appli_status']=='Under Varification' ? 'selected="selected"': '' ;?>>Under Varification</option>
											<option data-value="3" value="Withheld"<?=$records['appli_status']=='Withheld' ? 'selected="selected"': '' ;?> >Withheld </option>
											<option data-value="4" value="Under Process" <?=$records['appli_status']=='Under Process' ? 'selected="selected"': '' ;?>>Under Process</option>
											<option data-value="5" value="Permitted" <?=$records['appli_status']=='Permitted' ? 'selected="selected"': '' ;?>>Permitted</option>
											<option data-value="6" value="Not Permitted" <?=$records['appli_status']=='Not Permitted' ? 'selected="selected"': '' ;?>>Not Permitted </option>
											<option data-value="7" value="Rejected"<?=$records['appli_status']=='Rejected' ? 'selected="selected"': '' ;?> >Rejected </option>
										</select>
									</div>
								</div>
							</div>
<!--  AAO  -->								
							<div class="col-sm-12">
								<div class="btn-wrap">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Remarks of AAO</label>
										<textarea id="aao_remrk" type = "text" name="aao_remrk" align="center" rows="2" cols="117" readonly ><?php echo $records['aao_remrk'] ?></textarea >
									</div>
								</div>
							</div>
<!--  SAO  -->
							<div class="col-sm-12">
								<div class="btn-wrap">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-4 name-mrgbtm">
										<label class="name">Application Status </span></label>
										<select id="appli_status"  name="appli_status" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Submitted" <?=$records['appli_status']=='Submitted' ? 'selected="selected"': '' ;?>>Submitted</option>
											<option data-value="2" value="Under Varification" <?=$records['appli_status']=='Under Varification' ? 'selected="selected"': '' ;?>>Under Varification</option>
											<option data-value="3" value="Withheld"<?=$records['appli_status']=='Withheld' ? 'selected="selected"': '' ;?> >Withheld </option>
											<option data-value="4" value="Under Process" <?=$records['appli_status']=='Under Process' ? 'selected="selected"': '' ;?>>Under Process</option>
											<option data-value="5" value="Permitted" <?=$records['appli_status']=='Permitted' ? 'selected="selected"': '' ;?>>Permitted</option>
											<option data-value="6" value="Not Permitted" <?=$records['appli_status']=='Not Permitted' ? 'selected="selected"': '' ;?>>Not Permitted </option>
											<option data-value="7" value="Rejected"<?=$records['appli_status']=='Rejected' ? 'selected="selected"': '' ;?> >Rejected </option>
										</select>
									</div>
									<div class="col-md-9 col-sm-12">
										<label class="name">Remarks, if any</label>
										<textarea id="sao_remrk" type = "text" name="sao_remrk" align="center" rows="2" cols="87" ><?php echo $records['sao_remrk'] ?></textarea >
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<label class="name"> Choose authority for submitting applicaiton</span></label>
											<div class="col-md-6 col-sm-6">
												<input id="1" type="checkbox" name="check" class="checkbx" value="SUPERVISOR" onchange="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Supervisor
											</div>
											<div class="col-md-7 col-sm-6 name-mrgbtm">
												<input id="2" type="checkbox" name="check" class="checkbx" value="ASSTT. ACCOUNTS OFFICER" onchange="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Asstt. Accounts Officer
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<label class="name">:</span></label>
											<div class="col-md-6 col-sm-6">
												<input id="3" type="checkbox" name="check" class="checkbx" value="SR. ACCOUNTS OFFICER" onclick="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Sr. Accounts Officer
											</div>
											<div class="col-md-7 col-sm-6">
												<input id="4" type="checkbox" name="check" class="checkbx" value="DY. ACCOUNTANT GENERAL" onchange="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Dy. Accountant General
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="control-group" title ="Click the Radio button against the authotity to whom you want to send the applicaiton.">
								<label class="control-label">Choose other authority for submitting application</label>
								<div class="controls">
								  <div class="filter-area">
									<div class="filter-row">
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
										
									  </div>
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
										<select type= "hidden" id="filter-designation" onchange="filterEmployeeByDesignation(this.value)">
										  <option  value="all">----Select Designation----</option>		
										  <?php
											foreach($designation as $value){
											  echo '<option value="'.$value.'">'.$value.'</option>';
											}
										  ?>
										</select>
	 
									  </div>
									  <div class="filter" style="display: inline-block; margin: 0px 0px 0px 10px;">
   
									  </div>
									</div> 
								  </div>
								  <div class="epmloyees-list" style="width:100%; max-height: 300px; overflow: auto;">
											 <?php
										  foreach($employees as $emp){
											echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input required type="radio" name="recom_autho" value="'.$emp['empname'].'@@@'.$emp['desig'].'@@@'.$emp['empid'].'" />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
										  }?>
								  </div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12 apl-mrgbtm">
										<label class="name"></label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Name</label>
											</div>
											<div class="col-sm-10  col-xs-6">
												<input name="sao_name" type="text" value="<?php echo $profile['empname'] ?>" class="form-control"  readonly>											
											</div>
										</div>			
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name"></label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-5  col-xs-4">
												<input name="sao_desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">DATE</label>
											</div>
											<div class="col-sm-3  col-xs-4">
												<input name="sao_dt" type="text" value="<?php echo date("d-m-Y"); ?>" class="form-control"  readonly>
											</div>								
										</div>			
									</div>
								</div>
							</div> 
							
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										
									</div>
								</div>
							</div>							
							<div class="col-sm-12">
								<div class="row">
									<div class="col-md-6 col-sm-7 col-xs-7">
										<div class="form-group"> 
											<?php echo $cap['image'];?>
											<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
										</div>
									</div>
									<div class="col-md-6 col-sm-5 col-xs-5">
										<div class="form-group">
											<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
										</div>
									</div>
								</div>
							</div>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit"  />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script  type="text/javascript">
document.getElementById('bill_type').onchange = function () 
{
	
	if (this.value == 'Adjustment Bill') 
    {
        document.getElementById("advance_bill_no").disabled = false;
    
		document.getElementById("visit_to").disabled = true;
		document.getElementById("journey_mode").disabled = true;
		document.getElementById("loc_inst_hosp").disabled = true;
		document.getElementById("loc_address").disabled = true;
	}
	
	
	if (this.value == 'Advance Bill') 
    {
        document.getElementById("block").disabled = false;
		document.getElementById("visit_to").disabled = false;
		document.getElementById("journey_mode").disabled = false;
		document.getElementById("from_date").disabled = false;
	    document.getElementById("to_date").disabled = false;
		document.getElementById("loc_inst_hosp").disabled = false;
		document.getElementById("loc_address").disabled = false;
		
		document.getElementById("advance_bill_no").disabled = true;
    }
	
	
	
	if (this.value == 'Education Allowance Bill') 
	{
		document.getElementById("block").disabled = false;
		document.getElementById("edu_class").disabled = false;
		document.getElementById("child_no").disabled = false;
        document.getElementById("child_name").disabled = false;
		document.getElementById("loc_inst_hosp").disabled = false;
		document.getElementById("loc_address").disabled = false;
    
		document.getElementById("visit_to").disabled = true;
		document.getElementById("journey_mode").disabled = true;
		document.getElementById("from_date").disabled = true;
	    document.getElementById("to_date").disabled = true;
    }
	
	
	if (this.value == 'Medical Bill') 
    {
        document.getElementById("from_date").disabled = false;
	    document.getElementById("to_date").disabled = false;
	    document.getElementById("loc_inst_hosp").disabled = false;
		document.getElementById("loc_address").disabled = false;
	    document.getElementById("doctor").disabled = false;
	    document.getElementById("treatment_type").disabled = false;
	    document.getElementById("fit_unfit").disabled = false;
		
		document.getElementById("advance_bill_no").disabled = true;
		document.getElementById("block").disabled = true;
		document.getElementById("edu_class").disabled = true;
		document.getElementById("child_no").disabled = true;
        document.getElementById("child_name").disabled = true;
    
	}
	if (this.value == 'News Paper Bill') 
    {
        document.getElementById("from_date").disabled = false;
	    document.getElementById("to_date").disabled = false;
		document.getElementById("edu_class").disabled = true;
	
		document.getElementById("advance_bill_no").disabled = true;
		document.getElementById("block").disabled = true;
		document.getElementById("edu_class").disabled = true;
		document.getElementById("child_no").disabled = true;
        document.getElementById("child_name").disabled = true;
		document.getElementById("loc_inst_hosp").disabled = true;
		document.getElementById("loc_address").disabled = true;
	    document.getElementById("doctor").disabled = true;
	    document.getElementById("treatment_type").disabled = true;
	    document.getElementById("fit_unfit").disabled = true;
	}
	if (this.value == 'LTC Bill') 
    {
        document.getElementById("from_date").disabled = false;
	    document.getElementById("to_date").disabled = false;
		document.getElementById("block").disabled = false;
		document.getElementById("advance_bill_no").disabled = false;
		document.getElementById("loc_inst_hosp").disabled = false;
		document.getElementById("loc_address").disabled = false;
		document.getElementById("visit_to").disabled = false;
		document.getElementById("journey_mode").disabled = false;
    
        document.getElementById("advance_bill_no").disabled = true;
    }
	if (this.value == 'TA Bill') 
    {
        document.getElementById("from_date").disabled = false;
		document.getElementById("to_date").disabled = false;
		document.getElementById("loc_inst_hosp").disabled = false;
		document.getElementById("loc_address").disabled = false;
		document.getElementById("visit_to").disabled = false;
		document.getElementById("journey_mode").disabled = false;
		document.getElementById("block").disabled = false;
   
        document.getElementById("advance_bill_no").disabled = true;
		
    }	
}


$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy',minDate:'today'});

});
function show_hide_submit(){
	if($('#i_agree').is(':checked')){
		$('#submit_btn').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}

function previewImage(file_obj,container_id){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if( ext == 'pdf'){
      $('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
    }else{
      $('#attachment').val(''); 
      $('#'+container_id).html('');      
      alert('file type not supported! Supported file types is .pdf');
    }
	}
}


function browse(){
	$('#attachment').click();
}

function MyAlert(){
//	var myText = "Instructions\n\n** Update your inforamation before applying leave.\n\** Select the type of leave that you want to apply.\n\** Click on the Select button.\n\** Check whether the balance is showing under Balance.\n\** Enter 'No of Days' in numerical value i.e. 1, 2, 3 etc. \n\** For Commuted Leave, enter no of days multiplyig by 2. \n\** For example, Enter 20 no of days of  Half Pay Leave for 10 Days Commuted Leave. \n\** Select the Designation of the Leave Sanctioning Authority.\n\** Click the Radio button against the Authoity.\n\** Write the Capta and Submit the leave.";
    myText ='Please Read Intructions before applying leave.'
	alert (myText);
}



</script>