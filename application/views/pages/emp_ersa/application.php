<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_ersa_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Employee &raquo; My Application </div>
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
									<div class="row">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
												<label class="name">Examination Name<span class="star">*</span></label>
												<select id="exm_nm" name="exm_nm" class="form-control" onchange="exm_index()" required>
													<option data-value="0" value="">Select Examination Name</option>
													<option data-value="1">Incentive Examination for Sr.AO/AO/AAO</option>
													<option data-value="2">Continuous Professional Development (CPD)-I Examination</option>
													<option data-value="3">Continuous Professional Development (CPD)-II Examination</option>
													
													<option data-value="4">Incentive Examination for Sr.AO/AO/AAO (Supplementary)</option>
													<option data-value="5">Continuous Professional Development (CPD)-I Examination(Supplementary)</option>
													<option data-value="6">Continuous Professional Development (CPD)-II Examination(Supplementary)</option>
													<option data-value="7">In-house Test on 'Introduction to IT Audit'</option>
													<option data-value="8">Evolution Test for DEO for promotion from Gr-B to Gr.-A</option>
													
													<option data-value="9">Preliminary Examination for appearing SAS Examination</option>
													<option data-value="10">Incentive Examination for Sr. Accountants</option>
													<option data-value="11">Departmental Examination for Accountants</option>
													<option data-value="12">Departmental Type Test Examination</option>
													<option data-value="13">Departmental Examination for MTS for promotion to Clerks</option>
													<option data-value="14">Others</option>
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-3 padd-lft15">
											<div class="form-group">
												<label class="name">Month<span class="star">*</span></label>
												<select name="exm_month" class="form-control" required>
													<option value="">Select</option>
													<option>January</option>
													<option>February</option>
													<option>March</option>
													<option>April</option>
													<option>May</option>
													<option>June</option>
													<option>July</option>
													<option>August</option>
													<option>September</option>
													<option>October</option>
													<option>November</option>
													<option>December</option>
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-3 padd-lft15">
											<div class="form-group">
												<label class="name">Year<span class="star">*</span></label>
												<input name="exm_year" type="text" class="form-control" required>
											</div>
										</div>
									</div>
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
												<input id="other_exam_name_input" name="other_exam_name" type="text"  class="form-control" placeholder="Examination Name"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Full Name (as per Service Book)<span class="star">*</span></label>
										<input name="full_name" value="<?php echo $profile['empname'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee ID<span class="star">*</span></label>
										<input value="<?php echo $profile['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Fathers Name<span class="star">*</span></label>
										<input name="father_name" value="<?php echo $profile['father_name'] ?>" type="text" class="form-control" required>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input name="desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star">*</span></label>
												<input name="basic_pay" type="text" class="form-control" required>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input name="section_name" value="<?php echo $profile['section'] ?>" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<select name="group_name" class="form-control">
													<option value="">Select</option>
													<option>Administration</option>
													<option>Accounts</option>
													<option>Fund</option>
													<option>Pension</option>
													<option>Divisional Accountant</option>
												</select>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Office Phone Number</label>
												<input name="phone_office" type="text" class="form-control">
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
												<label class="name">E-mail ID</label>
												<input name="email" value="<?php echo $profile['email'] ?>" type="text" class="form-control">
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Mobile No</label>
												<input name="mobile" value="<?php echo $profile['mbno'] ?>" type="text" class="form-control">
											</div>
										</div>
										
										
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Date of Birth<span class="star">*</span></label>
												<input name="dob" value="<?php echo date('d-m-Y',strtotime($profile['dob'])) ?>" type="text" class="form-control" readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Gender</label>
												<input name="gender" value="<?php echo strtoupper($profile['gender']) == 'M' ? 'MAle' : 'Female' ?>" type="text" class="form-control" readonly>
												<?php /*?><select name="gender" class="form-control" readonly>
													<option selected="selected">Select</option>
													<option value="M" <?php echo strtoupper($profile['gender']) == 'M' ? 'selected' : '' ?>>Male</option>
													<option value="F" <?php echo strtoupper($profile['gender']) == 'F' ? 'selected' : '' ?>>Female</option>
												</select><?php */?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Full Residential Address</label>
										<input name="addr" value="<?php echo $profile['address1'] ?>" type="text" class="form-control">
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="name">Community (UR/OBC/SC/ST)</label>
										<input name="category" value="<?php echo $profile['category'] ?>" type="text" class="form-control" >
									</div>
									<div class="col-sm-6 name-mrgbtm">
										<label class="name">Educational Qualification</label>
										<input name="quali" value="<?php echo $profile['qualifi'] ?>" type="text" class="form-control" >
									</div>
								</div>
							</div>
								
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<label class="name">Date of Appointment in this Office<span class="star">*</span></label>
										<input name="doa" value="<?php echo date('d-m-Y',strtotime($profile['doapp'])) ?>" type="text" class="form-control datepicker" readonly>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Gradation List Serial No </label>
												<input name="gr_serial_no" value="<?php echo $profile['grd_slno'] ?>" type="text" class="form-control">
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Gradation List Page  No</label>
												<input name="gr_page_no" value="<?php echo $profile['grd_pageno'] ?>" type="text" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="name">Year of Passing SOG/SAS Examination OR Accountant Examination OR Departmental Competitive Examination for MTS</label>
									<div class="row">
										<div class="col-sm-6">
											<select name="mts_exm_month" class="form-control">
												<option value="">Select Month</option>
												<option>January</option>
												<option>February</option>
												<option>March</option>
												<option>April</option>
												<option>May</option>
												<option>June</option>
												<option>July</option>
												<option>August</option>
												<option>September</option>
												<option>October</option>
												<option>November</option>
												<option>December</option>
											</select>
										</div>
										<div class="col-sm-6 field-mrgbtm">
											<input name="mts_exm_year" type="text" class="form-control" placeholder="Year">
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="name">Index No of SOG/SAS Examination (Passed on after 2001)</label>
										<input id="index_no" name="index_no" type="text" class="form-control">
									</div>
									<div class="col-sm-6 apl-mrgbtm">
										<label class="name">Present Post of the Employee<br />
										<br />
										</label>
										<input name="post_emp" type="text" class="form-control">
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Date of Appointment in present post</label>
										<input name="post_doa" type="text" class="form-control datepicker">
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">Length of Service in the present post<br /><br /></label>
										<div class="row">
											<div class="col-sm-6 col-xs-5">
												<input name="post_length_service" type="text" class="form-control">
											</div>
											<div class="col-sm-2 col-xs-3" style="text-align:center">
												<label class="name1">As on</label>
											</div>
											<div class="col-sm-4 col-xs-4">
												<input name="post_length_service_on" type="text" class="form-control datepicker">
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Break in Service, if any</label>
										<select name="break_service" class="form-control">
											<option value="No">No</option>
											<option value="Yes">Yes</option>
										</select>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">Period of Break in Service</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="break_service_from" type="text" class="form-control datepicker">
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="break_service_to" type="text" class="form-control datepicker">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="name">Whether already appeared in the said examination? (Details of appearances in Type Test for Clerk)</label>
									<input name="is_appeared_in_exam" type="text" class="form-control">
								</div>
							</div>
							<div class="col-sm-12">
                              <div class="table-responsive">
								<table width="100%" border="1" bordercolor="#7399be" class="tbl table-responsive">
									<thead>
										<tr>
											<td>Year & Month</td>
											<td>Index No</td>
											<td>Centre of Examination</td>
											<td>Exemption secured , if any</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input name="yr_month_1" type="text" class="form-control"></td>
											<td><input name="index_1" type="text" class="form-control"></td>
											<td><input name="center_1" type="text" class="form-control"></td>
											<td><input name="expt_1" type="text" class="form-control"></td>
										</tr>
										<tr>
											<td><input name="yr_month_2" type="text" class="form-control"></td>
											<td><input name="index_2" type="text" class="form-control"></td>
											<td><input name="center_2" type="text" class="form-control"></td>
											<td><input name="expt_2" type="text" class="form-control"></td>
										</tr>
										<tr id="more_exam_above">
											<td colspan="4" style="text-align:center"><button type="button" class="btn btn-sm" onclick="addMoreExam()" style="width:auto; padding:5px; font-size:10px"> + Add More</button></td>
										</tr>
									</tbody>
								</table>
                              </div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Mention papers intended to be appeared in Hindi.</label>
										<input name="hindi_apprd" type="text" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Whether the examination will be given in English or Hindi?</label>
										<label class="radio-inline"><input name="hindi_apprd" type="radio" value="Hindi" />Hindi</label>
										<label class="radio-inline"><input name="hindi_apprd" type="radio" value="English" />English</label>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="name">Whether Office training has been completed?</label>
									<label class="radio-inline">
									<input name="training" value="yes" type="radio">
									Yes</label>
									<label class="radio-inline">
									<input name="training" value="no" type="radio">
									No</label>
									<label class="radio-inline">
									<input name="training" value="not_apl" type="radio">
									Not Applicable</label>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="name">Whether completed Pre-examination Computer Training (Theo. & Prac)?</label>
									<label class="radio-inline">
									<input name="computer_training" value="yes" type="radio">
									Yes</label>
									<label class="radio-inline">
									<input name="computer_training" value="no" type="radio">
									No</label>
									<label class="radio-inline">
									<input name="computer_training" value="not_apl" type="radio">
									Not Applicable</label>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<label class="name">Location  of Training </label>
										<input name="location_training" type="text" class="form-control">
									</div>
									<div class="col-md-6 col-sm-12 apl-mrgbtm">
										<label class="name">Period of Training</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4 col-xs-4">
												<input name="training_from" type="text" class="form-control datepicker">
											</div>
											<div class="col-sm-2 col-xs-2">
												<label class="name1 text-center">To</label>
											</div>
											<div class="col-sm-4 col-xs-4">
												<input name="training_to" type="text" class="form-control datepicker">
											</div>
										</div>
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
											<input type="text" name="c_image" class="form-control" placeholder="Write image code" autocomplete="off" required >
										</div>
									</div>
								</div>
							</div>
							
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<input id="i_agree" type="checkbox" name="agree" onclick="show_hide_submit()" required/>&nbsp;&nbsp;I agree that acceptance of the application by the authority is subject to the receipt of recommendation from the Branch Officer concerned.<br /><br />
							</div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6">
										<strong>Date : <?php echo get_date(date('YYYY-mm-dd'))?></strong>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit" disabled />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-primary" onclick="window.location.reload();" value="Reset" />
										</div>
									</div>
								</div>
							</div>
							<?php
							if(isset($application) && !empty($application)){?>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6"> <strong>** Last Applied On : <?php echo get_date($application['applied_on']);?></strong> </div>
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
<script>
function exm_index(){
	var data_val = $('#exm_nm option:selected').attr('data-value');
	if(data_val == 14){
		$('#other_exam_name_input').prop('required',true);
		$('#other_exam_name').show();
	}else{
		$('#other_exam_name_input').prop('required',false);
		$('#other_exam_name').hide();
	}
	if(data_val >= 1 && data_val <= 3){
		$('#index_no').prop('readonly',false);
	}else{
		$('#index_no').val('').prop('readonly',true);
	}
}
var cur_index = 2;
function addMoreExam(){
	var indx = cur_index++;
	var htm = '<tr>';
	htm +='<td><input name="yr_month_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='<td><input name="index_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='<td><input name="center_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='<td><input name="expt_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='</tr>';
	$('#more_exam_above').before(htm);
	if(indx >= 9){
		$('#more_exam_above').remove();
	}
}
function show_hide_submit(){
	if($('#i_agree').is(':checked')){
		$('#submit_btn').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
</script>