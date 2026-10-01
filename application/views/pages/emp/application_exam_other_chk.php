<?php
$exam_odr_id = isset($records['exam_odr_id']) ? $records['exam_odr_id'] : '';
$empid = isset($records['empid']) ? $records['empid'] : '';
$office_id = isset($records['office_id']) ? $records['office_id'] : '';
$name = isset($records['name']) ? $records['name'] : '';
$desig = isset($records['desig']) ? $records['desig'] : '';
$emp_section = isset($records['emp_section']) ? $records['emp_section'] : '';
$group_nm = isset($records['group_nm']) ? $records['group_nm'] : '';
$office_nm = isset($records['office_nm']) ? $records['office_nm'] : '';
$emp_type = isset($records['emp_type']) ? $records['emp_type'] : '';
$emp_category = isset($records['emp_category']) ? $records['emp_category'] : '';
$basic_pay = isset($records['basic_pay']) ? $records['basic_pay'] : '';
$emp_qualifi = isset($records['emp_qualifi']) ? $records['emp_qualifi'] : '';
$dob = isset($records['dob']) ? $records['dob'] : '';
$doj = isset($records['doj']) ? $records['doj'] : '';
$service_as_on = isset($records['service_as_on']) ? $records['service_as_on'] : '';
$service_period = isset($records['service_period']) ? $records['service_period'] : '';
$ser_bk_age = isset($records['ser_bk_age']) ? $records['ser_bk_age'] : '';
$exam_sl_no = isset($records['exam_sl_no']) ? $records['exam_sl_no'] : '';
$exam_appli_yr = isset($records['exam_appli_yr']) ? $records['exam_appli_yr'] : '';
$exam_name = isset($records['exam_name']) ? $records['exam_name'] : '';
$conducted_by = isset($records['conducted_by']) ? $records['conducted_by'] : '';
$post_applied = isset($records['post_applied']) ? $records['post_applied'] : '';
$post_pay_level = isset($records['post_pay_level']) ? $records['post_pay_level'] : '';
$advtiser = isset($records['advtiser']) ? $records['advtiser'] : '';
$govt_foreign = isset($records['govt_foreign']) ? $records['govt_foreign'] : '';
$emp_undertking = isset($records['emp_undertking']) ? $records['emp_undertking'] : '';
$quali_for_post = isset($records['quali_for_post']) ? $records['quali_for_post'] : '';
$expri_for_post = isset($records['expri_for_post']) ? $records['expri_for_post'] : '';
$age_as_on = isset($records['age_as_on']) ? $records['age_as_on'] : '';
$other_qualifi = isset($records['other_qualifi']) ? $records['other_qualifi'] : '';
$service_bk_qualifi = isset($records['service_bk_qualifi']) ? $records['service_bk_qualifi'] : '';
$recom_experi = isset($records['recom_experi']) ? $records['recom_experi'] : '';
$ser_bk_age_on = isset($records['ser_bk_age_on']) ? $records['ser_bk_age_on'] : '';
$sbk_other_qualifi = isset($records['sbk_other_qualifi']) ? $records['sbk_other_qualifi'] : '';
$eligibility = isset($records['eligibility']) ? $records['eligibility'] : '';
$attachment = isset($records['attachment']) ? $records['attachment'] : '';
$appli_date = isset($records['appli_date']) ? $records['appli_date'] : '';
$reccomendation = isset($records['reccomendation']) ? $records['reccomendation'] : '';
$reason_recco = isset($records['reason_recco']) ? $records['reason_recco'] : '';
$aao_name = isset($records['aao_name']) ? $records['aao_name'] : '';
$aao_desig = isset($records['aao_desig']) ? $records['aao_desig'] : '';
$aao_remrk = isset($members['aao_remrk']) ? $members['aao_remrk'] : '';
$aao_dt = isset($members['aao_dt']) ? $members['aao_dt'] : '';
$sao_name = isset($records['sao_name']) ? $records['sao_name'] : '';
$sao_desig = isset($records['sao_desig']) ? $records['sao_desig'] : '';
$sao_remrk = isset($members['sao_remrk']) ? $members['sao_remrk'] : '';
$sao_dt = isset($members['sao_dt']) ? $members['sao_dt'] : '';
$dag_name = isset($records['dag_name']) ? $records['dag_name'] : '';
$dag_desig = isset($records['dag_desig']) ? $records['dag_desig'] : '';
$dag_remrk = isset($members['dag_remrk']) ? $members['dag_remrk'] : '';
$dag_dt = isset($members['dag_dt']) ? $members['dag_dt'] : '';
$pag_name = isset($records['pag_name']) ? $records['pag_name'] : '';
$pag_desig = isset($records['pag_desig']) ? $records['pag_desig'] : '';
$pag_remrk = isset($members['pag_remrk']) ? $members['pag_remrk'] : '';
$pag_dt = isset($members['pag_dt']) ? $members['pag_dt'] : '';
$appli_status = isset($records['appli_status']) ? $records['appli_status'] : '';
$update_dt = isset($records['update_dt']) ? $records['update_dt'] : '';
$upload_dt = isset($records['upload_dt']) ? $records['upload_dt'] : '';
$currently_with = isset($records['currently_with']) ? $records['currently_with'] : '';

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
			<div class="form-group row">
				<div class="col-sm-12" style = "text-align: right">
					<!-- Trigger/Open The Modal -->
					<button  id="myBtn" class="btn btn-warning"> INSTRUCTIONS</button>
				</div>
			</div>
				
				
			<div class="login-box">
				<div class="application-formwrap">
					<form method="post" onmouseover ="disabledField(); AvailByCheck(); FieldsReadOnly();"enctype="multipart/form-data" >
						<?php
								if(!empty($leave_balance)){
									$s1=0;
									foreach($leave_balance as $balance){											
											$s1=$balance['leave_cb']; 
									}
								}else{
									$s1=0;
								}?>
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>APPLICATION FOR  PERMISSION (NON-DEPARTMENTAL EXAMININATION) </b></font></span></label>
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
										<label class="name">Full Name<span class="star"></span></label>
										<input id="name" name="name" value="<?php echo $records['name'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Office ID<span class="star"></span></label>
										<input id="office_id" name="office_id" value="<?php echo $records['office_id'] ?>" type="text" class="form-control" readonly>
										<input id="empid" type = "hidden" name="empid" value="<?php echo $records['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name <span class="star"></span></label>
										<input id="office_nm" name="office_nm" value="<?php echo $records['office_nm'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star"></span></label>
										<input id="desig" name="desig" type="text" value="<?php echo $records['desig'] ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input id="basic_pay" name="basic_pay" type="text"  value="<?php echo $records['basic_pay'] ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input id="id_section" name="emp_section"  type="text" value="<?php echo $records['emp_section'] ?>" class="form-control"  required readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input id="group_nm" name="group_nm"  type="text" value="<?php echo $records['group_nm'] ?>" class="form-control" required readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Mobile Number</label>
												<input id="mbno" name="mbno" type="text" value="<?php echo $records['mbno'] ?>" class="form-control"  required readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-sm-6">
												<label class="name">Qualification </label>
												<input id="emp_qualifi" name="emp_qualifi"  type="text" value="<?php echo $records['emp_qualifi'] ?>" class="form-control" required readonly>
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Date of Birth<span class="star"></span></label>
												<input id="dob" name="dob" type="text"  value="<?php echo $records['dob'] ?>" class="form-control"  readonly >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Age on (Notification) </label>
												<input id="" name="" type="text" value="<?php echo $records['age_as_on'] ?>" class="form-control"  required readonly>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Age</label>
												<input id="ser_bk_age" name="ser_bk_age"  type="text" value="<?php echo getAgeOn($records['dob'],$records['age_as_on']) ?>" class="form-control"  required readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Service as on<span class="star">*</span></label>
										<input id="" name="doj" type="hidden"  value="<?php echo $records['doj'] ?>" class="form-control"  readonly >
										<input id="" name="" type="text" value= "<?php echo $records['service_as_on'] ?>" class="form-control " required  readonly>
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Service<span class="star">*</span></label>
										<input id="service_period" name="service_period" type="text" value= "<?php echo getAgeOn($records['doj'],$records['service_as_on']) ?>" class="form-control datepicker" required readonly >
									</div>
									<div class="col-md-3 col-sm-6">
										<label class="name"> Service Type<span class="star">*</span></label>
										<input id="emp_type" name="emp_type" type="text" value= "<?php echo $records['emp_type'] ?>" class="form-control" required readonly >
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="name">Whether SC / ST ? </label>
										<input id="emp_category" name="emp_category" type="text" value= "<?php echo $records['emp_category'] ?>" class="form-control" required readonly >
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Post Applied for </label>
										<input id="post_applied"  name="post_applied" type="text" value= "<?php echo $records['post_applied'] ?>" class="form-control " required  >
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Pay level of the post </label>
										<input id="post_pay_level"  name="post_pay_level" type="text" value= "<?php echo $records['post_pay_level'] ?>" class="form-control " required  >
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Advertiser </label>
										<input id="advtiser"  name="advtiser" type="text" value= "<?php echo $records['advtiser'] ?>" class="form-control " required  >
									</div>
								</div>
							</div>							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<label class="name">Whether Foreign Service or another Govt. /Dept. </label>
										<select id="govt_foreign"  name="govt_foreign" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Central Govt Service" <?=$records['govt_foreign']=='Central Govt Service' ? 'selected="selected"': '' ;?> >Central Govt Service</option>
											<option data-value="2" value="State Govt Service" <?=$records['govt_foreign']=='State Govt Service' ? 'selected="selected"': '' ;?> >State Govt Service</option>
											<option data-value="3" value="Autonomous Body Service" <?=$records['govt_foreign']=='Autonomous Body Service' ? 'selected="selected"': '' ;?> >Autonomous Body Service</option>
											<option data-value="4" value="Central PSU Service" <?=$records['govt_foreign']=='Central PSU Service' ? 'selected="selected"': '' ;?> >Central PSU Service</option>
											<option data-value="5" value="State PSU Service" <?=$records['govt_foreign']=='State PSU Service' ? 'selected="selected"': '' ;?> >State PSU Service</option>
											<option data-value="6" value="Banking/Insurance Service" <?=$records['govt_foreign']=='Banking/Insurance Service' ? 'selected="selected"': '' ;?> >Banking / Insurance Service</option>
										</select>
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="name">Undertaking to resign </label>
										<select id="emp_undertking" name="emp_undertking" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Yes" <?=$records['emp_undertking']=='Yes' ? 'selected="selected"': '' ;?> >Yes</option>
											<option data-value="2" value="No" <?=$records['emp_undertking']=='No' ? 'selected="selected"': '' ;?> >No</option>
										</select>
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="name">Qualification required </label>
										<input id="quali_for_post"  name="quali_for_post" type="text" value= "<?php echo $records['quali_for_post'] ?>" class="form-control " required  >
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Experience </label>
										<input id="expri_for_post"  name="expri_for_post" type="text" value= "<?php echo $records['expri_for_post'] ?>" class="form-control " required  >
									</div>
									
								</div>
							</div>	
						    <div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name"> Other Qualification, if any  </label>
										<input id="other_qualifi"  name="other_qualifi" type="text" value= "<?php echo $records['other_qualifi'] ?>" class="form-control " required >
									</div>
									<div class="col-md-4 col-sm-6">
										<label class="name"> Eligibiligy </span></label>
										<input id="eligibility"  name="eligibility" type="text" value= "<?php echo $records['eligibility'] ?>" class="form-control " required readonly>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Application Date  </label>
										<input id="appli_date"  name="appli_date" type="text" value= "<?php echo $records['appli_date'] ?>" class="form-control " required readonly >
									</div>
								</div>
							</div>
							<div class="col-sm-12"title ="Borwse to upload supporting docuemnts.">
								<div class="form-group row">
									<div class="col-md-8 col-sm-8">
										<label class="control-label">Supporting Documents</label>
										<input id="attachment" type="file" name="attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
									<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i>||</button><span id="up_file_display"><?php if($attachment != ''){echo '&nbsp;<a href="'.base_url().'files/agae/results/'.$attachment.'" target="_blank">'.$attachment.'</a>';}?></span>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										
									</div>
								</div>
							</div>
<!-- checking -->

							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name"> Qualification </label>
										<input id="emp_qualifi" name="emp_qualifi"  type="text" value="<?php echo $records['emp_qualifi'] ?>" class="form-control" required >
									</div>
									<div class="col-md-8 col-sm-12">
										<label class="name">Recommended Experience </label>
										<input id="recom_experi"  name="recom_experi" type="text" value= "<?php echo $records['recom_experi'] ?>" class="form-control " required>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-12">
										<label class="name"> Age as on  </label>
										<input id="age_as_on" name="age_as_on" type="text" value= "<?php echo $records['age_as_on'] ?>" class="form-control datepicker" required >
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="name"> Sevice as on  </label>
										<input id="service_as_on" name="service_as_on" type="text" value= "<?php echo $records['service_as_on'] ?>" class="form-control datepicker" required >
									</div>
									<div class="col-md-3 col-sm-6">
										<label class="name"> Eligibiligy </span></label>
										<select id="eligibility"  name="eligibility" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Yes" <?=$records['eligibility']=='Yes' ? 'selected="selected"': '' ;?> >Fulfills</option>
											<option data-value="2" value="No" <?=$records['eligibility']=='No' ? 'selected="selected"': '' ;?> >Does not Fulfill</option>
										</select>
										</div>
									<div class="col-md-3 col-sm-12">
										<label class="name">Other Qualification, if any </label>
										<input id="other_qualifi" name="other_qualifi" type="text" value= "<?php echo $records['other_qualifi'] ?>" class="form-control " required>
									</div>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-4 name-mrgbtm">
										<label class="name">Action on Application </span></label>
										<select id="reccomendation"  name="reccomendation" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="may be forwarded" <?=$records['reccomendation']=='may be forwarded' ? 'selected="selected"': '' ;?>>Forwarded</option>
											<option data-value="2" value="may not be forwarded" <?=$records['reccomendation']=='may not be forwarded' ? 'selected="selected"': '' ;?>>Not Forwarded</option>
											<option data-value="3" value="may be withheld" <?=$records['reccomendation']=='may be withheld' ? 'selected="selected"': '' ;?>>Withheld </option>
										</select>
									</div>
									<div class="col-md-4 col-sm-4 name-mrgbtm">
										<label class="name">Action taken for  </span></label>
										<select id="reason_rec_seclt"  name="reason_rec_seclt" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Forwarding" <?=$records['reason_rec_seclt']=='Forwarding' ? 'selected="selected"': '' ;?>>Forwarding</option>
											<option data-value="2" value="not forwarding" <?=$records['reason_rec_seclt']=='not forwarding' ? 'selected="selected"': '' ;?>>Not forwarding</option>
											<option data-value="3" value="withholding" <?=$records['reason_rec_seclt']=='withholding' ? 'selected="selected"': '' ;?>>Withholding</option>
											
										</select>
									</div>
									<div class="col-md-4 col-sm-4 name-mrgbtm">
										<label class="name">Application Status </span></label>
										<select id="appli_status"  name="appli_status" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Under Process" <?=$records['appli_status']=='Under Process' ? 'selected="selected"': '' ;?>>Forward File [Under Process]</option>
											<option data-value="2" value="Under Varification" <?=$records['appli_status']=='Under Varification' ? 'selected="selected"': '' ;?>>Under Varification</option>
											<option data-value="3" value="Withheld" <?=$records['appli_status']=='Withheld' ? 'selected="selected"': '' ;?>>Withheld </option>
										</select>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Recommendation of the Dealing Assistant </label>
										<textarea id="reason_recco" type = "text" name="reason_recco" align="center" rows="4" cols="117" ><?php echo $records['reason_recco'] ?></textarea >
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
											<div class="col-md-7 col-sm-6">
												<input id="5" type="checkbox" name="check" class="checkbx" value="SR.DY. ACCOUNTANT GENERAL" onclick="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Sr. Dy. Accountant General
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
											<div class="col-md-6 col-sm-6">
												<input id="6" type="checkbox" name="check" class="checkbx" value="PR. ACCOUNTANT GENERAL" onchange="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Pr. Accountant General
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
											echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input type="radio" name="recom_autho" value="'.$emp['empname'].'@@@'.$emp['desig'].'@@@'.$emp['empid'].'" />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
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
												<input name="checker_nm" type="text" value="<?php echo $profile['empname'] ?>" class="form-control"  readonly>											
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
												<input name="checker_desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">DATE</label>
											</div>
											<div class="col-sm-3  col-xs-4">
												<input name="checker_dt" type="text" value="<?php echo date("d-m-Y"); ?>" class="form-control"  readonly>
											</div>								
										</div>			
									</div>
								</div>
							</div> 
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-md-6 col-sm-7 col-xs-7">
											<div class="form-group"> 
												<?php echo $cap['image'];?>
												<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
											</div>
										</div>
										<div class="col-md-6 col-sm-5 col-xs-5">
											<div class="form-group">
												<input  type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
											</div>
										</div>
									</div>
								</div>
							</div>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-4 col-xs-6">
											<input type="button" class="btn btn-warning" onclick="window.location.reload();" value="Reset" />
										</div>
										<div class="col-sm-4 col-xs-6">
											<button id ="edit" class="btn btn-success" 
												onclick="goSave('<?php echo $records['exam_odr_id'] ?>')" ><i 
												class="icon-pencil icon-white"></i>Save
											</button>
										</div>		
										<div class="col-sm-4 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit"  />
										</div>
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


<!-- The Modal -->
<div id="myModal" class="modal-small">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Instructions</h2>
    </div>
    <div class="modal-body">
      <p>1. Check whether all your inforamation is updated before applying leave. </p>
      <p>2. Select the type of leave that you want to apply.</p>
	  <p>3. Click on the Select button to have your Leave Balance in the Application Form.</p>
	  <p>4. Check whether the Leave Balance is showing under Balance.</p>
	  <p>5. For Earned Leave having balance over 300 days, Please keep application period ending on 30th June or 31st December.</p>
	  <p>6. Enter 'No of Days' in numeric value i.e. 1, 2, 3 etc.</p>
	  <p>7. For Commuted Leave, Select "Commuted leave for Self illness" only as ground for leave.</p>
	  <p>8. Upload proper Medical Certificate for the leave, for which it is necessary as per CCS Leave Rules.</p>
	  <p>9. Select the Designation of the Leave Recommending / Sanctioning Authority to filter the list.</p>
	  <p>10. Click the Radio button properly against the Authoity to whom you want to send the leave.</p>
	  <P>11. Write the Capta and Submit the leave.</P>
	  <P>12. The records applied for is listed under Availed Leave in "My Leave" Tab.</P>
    </div>
    <div class="modal-footer">
      <h3>Thanks</h3>
    </div>
  </div>

</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


<script type="text/javascript">

$(document).ready(function(){
//	$('.datepicker').datepicker({dateFormat:'dd-mm-yy',minDate:'today'});
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});

});

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
$('input.checkbx').on('change',function(){
	$('input.checkbx').not(this).prop('checked', false);
});

function filterEmployeeByDesignation(desig){
  desig = desig.toLowerCase();
   $('.emp-row').each(function(i){
      if(desig != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-designation') == desig){
          $(this).css('display','block');
        }
      }else{
        $(this).css('display','block');
      }
    });
   checkUncheckAll();
}

function checkSelectedOnly(){
  let isChecked = $('#selected-only').is(':checked');
  $('.emp-row').each(function(i){
    if(isChecked){
      if(!$(this).find('input').prop('checked')){
        $(this).css('display','none');
      }
    }else{
      $(this).css('display','block');
    }
  });
}

function checkUncheckAll(){
  var desig = $('#filter-designation').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.emp-row').each(function(i){
    $(this).find('input').prop('checked',false);
    if(isChecked){
      if(desig != 'all'){
        if($(this).attr('data-designation') == desig){
          $(this).find('input').prop('checked',true);
        }
      }else{
        $(this).find('input').prop('checked',true);
      }
    }    
  });
}
function selectcheckbox(id){
	for ( var i =1; i<=6;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
}

function MyAlert(){
//	var myText = "Instructions\n\n** Update your inforamation before applying leave.\n\** Select the type of leave that you want to apply.\n\** Click on the Select button.\n\** Check whether the balance is showing under Balance.\n\** Enter 'No of Days' in numerical value i.e. 1, 2, 3 etc. \n\** For Commuted Leave, enter no of days multiplyig by 2. \n\** For example, Enter 20 no of days of  Half Pay Leave for 10 Days Commuted Leave. \n\** Select the Designation of the Leave Sanctioning Authority.\n\** Click the Radio button against the Authoity.\n\** Write the Capta and Submit the leave.";
    myText ='Please Read Intructions before applying leave.'
	alert (myText);
}

function goSave(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/feedback_filt_close/' + id;
    }
}


</script>
