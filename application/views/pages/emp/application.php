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
			<div><h4><strong><font style = "color:red; font-size:14px;"> Please update your information first. </font></strong></h4></div>
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
												<label class="name">Examination Name<span class="star">*</span> <span style="font-size:10px; height:1.2px; color: red; font-weight:bold;">[Consider 'Closing Date' for Month and Year, if not mentioned in Office Order]</span></label>
												<select id="exm_nm" name="exm_nm" class="form-control" onchange="exm_index()" required>
													<option value="">---Select Examination ---</option>
													<?php
													if(isset($exam_list) && !empty($exam_list)){
														foreach($exam_list as $list){
															echo '<option value="'.$list['exam_name'].'">'.$list['exam_name'].'</option>';
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-2 padd-lft15">
											<div class="form-group">
												<label class="name">Month<span class="star">*</span></label>
												<select id="exm_month" name="exm_month" class="form-control" required>
													<option value="">---Month---</option>
													<?php
													if(isset($exam_list) && !empty($exam_list)){
														foreach($exam_list as $list){
															echo '<option value="'.$list['exam_month'].'">'.$list['exam_month'].'</option>';
														}
													}
													?>
												</select>
												
<!--	For current month 					<input name="exm_month" title ="Month for the selected Examination" value="<?php echo date('F');?>" type="text" class="form-control" readonly>		-->
<!--	For Next month						<input name="exm_month" title ="Month for the selected Examination" value="<?php echo date('F',date('m')+1);?>" type="text" class="form-control" readonly>		-->											
											</div>
										</div>
										<div class="col-md-2 col-sm-2 padd-lft15">
											<div class="form-group">
												<label class="name">Year<span class="star">*</span></label>
<!--	For current year 						<input name="exm_year" title ="Year for the selected Examination" value="<?php echo date('Y');?>" type="text" class="form-control" readonly>	
		For Next year							<input name="exm_year" title ="Year for the selected Examination" value="<?php echo date('Y')+1;?>" type="text" class="form-control" readonly>		
-->
												<select id="exm_year" name="exm_year" class="form-control" required>
													<option value="">---Year---</option>
													<?php
													if(isset($exam_list) && !empty($exam_list)){
														foreach($exam_list as $list){
															echo '<option value="'.$list['exam_year'].'">'.$list['exam_year'].'</option>';
														}
													}
													?>
												</select>
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
										<input name="emp_id" value="<?php echo $profile['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Fathers Name<span class="star">*</span></label>
										<input name="father_name" value="<?php echo $profile['father_name'] ?>" type="text" class="form-control" required readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input id = "desig" name="desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control" required readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star">*</span></label>
												<input id = "basic_pay" name="basic_pay" value="<?php echo $profile['basic_pay'] ?>" type="text" class="form-control" required readonly>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input id = "section_name" name="section_name" value="<?php echo $profile['section'] ?>" type="text" class="form-control" required readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
													<input id = "group_name" name="group_name" value="<?php echo $profile['group_name'] ?>" type="text" class="form-control" required readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Gender</label>
												<input name="gender" value="<?php echo $profile['gender'] ?>" type="text" class="form-control" required readonly>
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
												<input name="email" value="<?php echo $profile['nicmail'] ?>" type="text" class="form-control" required readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Mobile No</label>
												<input id = "mobile" name="mobile" value="<?php echo $profile['mbno'] ?>" type="text" class="form-control" required readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Date of Birth<span class="star">*</span></label>
												<input id = "dob" name="dob" value="<?php echo date('d-m-Y',strtotime($profile['dob'])) ?>" type="text" class="form-control" readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">

												<label class="name">Contact Number</label>
												<input id = "phone_office" name="phone_office" type="text" class="form-control" >
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Full Residential Address</label>
										<input name="addr" value="<?php echo $profile['address1'] ?>, <?php echo $profile['postoffice'] ?>, <?php echo $profile['district'] ?>, <?php echo $profile['state'] ?>-<?php echo $profile['pin'] ?>" type="text" class="form-control" required >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="name">Community (UR/OBC/SC/ST)</label>
										<input id = "category" name="category" value="<?php echo $profile['category'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-sm-6 name-mrgbtm">
										<label class="name">Educational Qualification</label>
										<input id = "quali" name="quali" value="<?php echo $profile['qualifi'] ?>" type="text" class="form-control" readonly >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<label class="name">Date of Appointment in this Office<span class="star">*</span></label>
										<input id = "doa" name="doa" value="<?php echo date('d-m-Y',strtotime($profile['doapp'])) ?>" type="text" class="form-control datepicker" readonly>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Gradation List Serial No </label>
												<input id = "gr_serial_no" name="gr_serial_no" value="<?php echo $profile['grd_slno'] ?>" type="text" class="form-control">
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Gradation List Page  No</label>
												<input id = "gr_page_no" name="gr_page_no" value="<?php echo $profile['grd_pageno'] ?>" type="text" class="form-control">
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
												<option value="">---Select Month---</option>
												<option value="NA">Not Applicable</option>
												<option value="January" >January</option>
												<option value="February" >February</option>
												<option value="March"  >March</option>
												<option value="April"  >April</option>
												<option value="May"  >May</option>
												<option value="June" >June</option>
												<option value="July" >July</option>
												<option value="August"  >August</option>
												<option value="September"  >September</option>
												<option value="October"  >October</option>
												<option value="November" >November</option>
												<option value="December" >December</option>
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
										<label class="name">Present Post of the Employee</label>
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
										<label class="name">Length of Service in the present post</label>
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
											<option value="">--- Select ---</option>
											<option value="Yes">Yes</option>
											<option value="No">No</option>
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
									<label class="name">Whether already appeared in the said examination? </label>
									<input name="is_appeared_in_exam" type="text" class="form-control">
<!--										<select name="is_appeared_in_exam" class="form-control">
											<option value="">--- Select ---</option>
											<option value="Yes">Yes</option>
											<option value="No" >No</option>
										</select>												-->
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
									<div class="col-sm-12">
										<label class="name">Speed for Stonographer Test</label>
										<label class="radio-inline"><input name="st_speed" type="radio" value="100 wpm" />100 Words per minute</label>
										<label class="radio-inline"><input name="st_speed" type="radio" value="120 wpm" />120 Words per minute</label>
									</div>
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
							<div class="btn-wrap col-sm-12"></div>
							<div class="control-group" title ="Click the Radio button against the authotity to whom you want to send the applicaiton.">
								<label class="control-label">Choose Section In-Charge for recommendation of your application for the examination.</label>
								<div class="controls">
								  <div class="filter-area">
									<div class="filter-row">
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
										
									  </div>
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
										<select type= "hidden" id="filter-designation" onchange="filterEmployeeByDesignation(this.value)" >
										  <option value="all"></option>		
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
								  <div class="epmloyees-list" style="width:100%; max-height: 150px; overflow: auto;" required >
											 <?php
										  foreach($employees as $emp){
											echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input required type="radio" name="sec_autho_pan" value="'.$emp['empname'].'@@@'.$emp['desig'].'@@@'.$emp['empid'].'" />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
										  }?>
								  </div>
								</div>
							</div>
							<div class="btn-wrap col-sm-12"></div>
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
											<input onclick = "warningApp();InformationCheck();" type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
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
										<strong>Date: <?php echo  date("d-m-Y");?> </strong>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit" disabled />
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
function InformationCheck(){
	var designation = document.getElementById('desig').value;
	var basic = document.getElementById('basic_pay').value;
	var section = document.getElementById('section_name').value;
	var group = document.getElementById('group_name').value;
	if(designation !== ''){    
		if(basic !== '0'){
			if(section !== ''){
				if(group !== ''){
					//
				}else{
					alert("** Update your Group and other information before applying for examination");
				}
			}else{
				alert("** Update your Section and other information before applying for examination");
			}
		}else{
			alert("** Update your Basic Pay and other information before applying for examination");
		}
	}else{
		alert("** Update your Designation and other information before applying for examination");
	}
}
function warningApp(){
	
	alert("NOTICE\n\n **Application once submitted can not be edited.\n\n  **Your will not be able to resubmit your application. \n\n **So, carefully check all the informmatiion before submit. ");
				
}
</script>