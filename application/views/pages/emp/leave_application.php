<?php
$leav_id = isset($leaves['leav_id']) ? $leaves['leav_id'] : '';
$empid = isset($leaves['empid']) ? $leaves['empid'] : '';
$name = isset($leaves['name']) ? $leaves['name'] : '';
$desig = isset($leaves['desig']) ? $leaves['desig'] : '';
$leave_basic_pay = isset($leaves['leave_basic_pay']) ? $leaves['leave_basic_pay'] : '';
$section = isset($leaves['section']) ? $leaves['section'] : '';
$group_nm = isset($leaves['group_nm']) ? $leaves['group_nm'] : '';
$office_nm = isset($leaves['office_nm']) ? $leaves['office_nm'] : '';
$leave_type = isset($leaves['leave_type']) ? $leaves['leave_type'] : '';
$leave_from = isset($leaves['leave_from']) ? $leaves['leave_from'] : '';
$leave_to = isset($leaves['leave_to']) ? $leaves['leave_to'] : '';
$leave_day_no = isset($leaves['leave_day_no']) ? $leaves['leave_day_no'] : '';
$balance_leave = isset($leaves['balance_leave']) ? $leaves['balance_leave'] : '';
$ground = isset($leaves['ground']) ? $leaves['ground'] : '';
$admissibility = isset($leaves['admissibility']) ? $leaves['admissibility'] : '';
$joining_dt = isset($leaves['joining_dt']) ? $leaves['joining_dt'] : '';
$leave_address = isset($leaves['leave_address']) ? $leaves['leave_address'] : '';
$block = isset($leaves['block']) ? $leaves['block'] : '';
$application_dt = isset($leaves['application_dt']) ? $leaves['application_dt'] : '';
$link_file = isset($leaves['link_file']) ? $leaves['link_file'] : '';
$mc_yes_no = isset($leaves['mc_yes_no']) ? $leaves['mc_yes_no'] : '';
$pre_from = isset($leaves['pre_from']) ? $leaves['pre_from'] : '';
$pre_to = isset($leaves['pre_to']) ? $leaves['pre_to'] : '';
$pre_desc = isset($leaves['pre_desc']) ? $leaves['pre_desc'] : '';
$suff_from = isset($leaves['suff_from']) ? $leaves['suff_from'] : '';
$suff_to = isset($leaves['suff_to']) ? $leaves['suff_to'] : '';
$suff_desc = isset($leaves['suff_desc']) ? $leaves['suff_desc'] : '';
$recom_autho = isset($leaves['recom_autho']) ? $leaves['recom_autho'] : '';
$recom_autho_desig = isset($leaves['recom_autho_desig']) ? $leaves['recom_autho_desig'] : '';
$recom_autho_pan = isset($leaves['recom_autho_pan']) ? $leaves['recom_autho_pan'] : '';
$recommendation = isset($leaves['recommendation']) ? $leaves['recommendation'] : '';
$recom_date = isset($leaves['recom_date']) ? $leaves['recom_date'] : '';
$sanction_autho = isset($leaves['sanction_autho']) ? $leaves['sanction_autho'] : '';
$sanction_autho_desig = isset($leaves['sanction_autho_desig']) ? $leaves['sanction_autho_desig'] : '';
$sanction_autho_pan = isset($leaves['sanction_autho_pan']) ? $leaves['sanction_autho_pan'] : '';
$sanction_desc = isset($leaves['sanction_desc']) ? $leaves['sanction_desc'] : '';
$approve_date = isset($leaves['approve_date']) ? $leaves['approve_date'] : '';
$leave_status = isset($leaves['leave_status']) ? $leaves['leave_status'] : '';
$upload_dt = isset($leaves['upload_dt']) ? $leaves['upload_dt'] : '';

$last_leave_type = isset($leaves['last_leave_type']) ? $leaves['last_leave_type'] : '';
$last_leave_from = isset($leaves['last_leave_from']) ? $leaves['last_leave_from'] : '';
$last_leave_to = isset($leaves['last_leave_to']) ? $leaves['last_leave_to'] : '';
$last_leave_joined_on = isset($leaves['last_leave_joined_on']) ? $leaves['last_leave_joined_on'] : '';

$member_name = isset($members['member_name']) ? $members['member_name'] : '';
$member_dob = isset($members['member_dob']) ? $members['member_dob'] : '';
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
				<form method="get" >
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Leave :</label>
									<select id = "leave_type" name="leave_type" class="form-control" onchange = "MyAlert(); disabledField()" required>
										<option value=""> --- Select leave ---</option>
										<option data-value="1" value="Child Care Leave"<?php echo $this->input->get('leave_type') == 'Child Care Leave' ? 'selected' : ''?> >Child Care Leave</option>
										<option data-value="2" value="Half Pay Leave"<?php echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Half Pay Leave</option>
										<option data-value="8" value="Half Pay Leave"<?php echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Commuted Leave</option>			
										<option data-value="3" value="Earned Leave" <?php echo $this->input->get('leave_type') == 'Earned Leave' ? 'selected' : ''?> >Earned Leave</option>
										<option data-value="4" value="Extra-Ordinary Leave"<?php echo $this->input->get('leave_type') == 'Extra-Ordinary Leave' ? 'selected' : ''?> >Extra-Ordinary Leave</option>
										<option data-value="5" value="Maternity Leave"<?php echo $this->input->get('leave_type') == 'Maternity Leave' ? 'selected' : ''?> > Maternity Leave</option>
										<option data-value="6" value="Paternity Leave"<?php echo $this->input->get('leave_type') == 'Paternity Leave' ? 'selected' : ''?> >Paternity Leave</option>
										<option data-value="7" value="Study Leave"<?php echo $this->input->get('leave_type') == 'Study Leave' ? 'selected' : ''?> >Study Leave</option>
									</select>
								</div>
								<div class="col-sm-3">
									<label id = "child_select" class="name-label">Select Child :</label>
									<select id = "child" name="first_second_child" class="form-control" required>
										<option value=""> --- Select Child ---</option>
										<option data-value="1" value="First Child"<?php echo $this->input->get('first_second_child') == 'First Child' ? 'selected' : ''?> >For First Child</option>
										<option data-value="2" value="Second Child"<?php echo $this->input->get('first_second_child') == 'Second Child' ? 'selected' : ''?> >For Second Child</option>
										<option data-value="2" value="Medical Certificate"<?php echo $this->input->get('first_second_child') == 'Second Child' ? 'selected' : ''?> >On Medical Certificate</option>
									</select>
								</div>
								<div class="col-sm-2">
									<input type="submit" class="submit-btn" value="Select" />
								</div>
								<div class="col-sm-2">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/leave_application'" value="<?php echo $this->lang->line('clear'); ?>" /> 
								</div>
							</div>
						</div>
				</form>
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
							<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>LEAVE  APPLICATION  FORM</b></font></span></label>
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
										<input id="name" name="name" value="<?php echo $profile['empname'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee ID<span class="star">*</span></label>
										<input id="empid" name="empid" value="<?php echo $profile['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name<span class="star">*</span></label>
										<input id="office_nm" name="office_nm" value="<?php echo $profile['office'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input id="desig" name="desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input id="leave_basic_pay" name="leave_basic_pay" type="text"  value="<?php echo $profile['basic_pay'] ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input id="id_section" name="section"  type="text" value="<?php echo $profile['section'] ?>" class="form-control"  required readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input id="group_nm" name="group_nm"  type="text" value="<?php echo $profile['group_name'] ?>" class="form-control" required readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input id="mbno" name="mbno" type="text" value="<?php echo $profile['mbno'] ?>" class="form-control"  required readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Ground of  leave<span class="star">*</span></label>
										<select id="ground" onchange = "InformationCheck(); disabledCommuted(); hplCommuted();" name="ground" class="form-control" required>
												<option value=""> ---- Select leave----</option>
												<option data-value="1" value="Urgent work" >Urgent work</option>
												<option data-value="2" value="Private affairs" >Private affairs</option>
												<option data-value="3" value="Self illness" >Self illness</option>
												<option data-value="29" value="Commuted leave for Self illness" >Commuted leave for Self illness</option>
												<option data-value="4" value="Father's illness" >Father's illness</option>
												<option data-value="5" value="Mother's illness" >Mother's illness</option>
												<option data-value="6" value="Wife's illness" >Wife's illness</option>
												<option data-value="7" value="Son's illness" >Son's illness</option>
												<option data-value="8" value="Daughter's illness" >Daughter's illness</option>
												<option data-value="9" value="Relative's illness" >Relative's illness</option>
												<option data-value="10" value="Child's examination" >Child's examination</option>
												<option data-value="11" value="Son's marriage" >Son's marriage</option>
												<option data-value="12" value="Daughter's marriage" >Daughter's marriage</option>
												<option data-value="13" value="Visit to a place" >Visit to a place</option>
												<option data-value="14" value="Visit to a place on LTC" >Visit to a place on LTC</option>
												<option data-value="15" value="Visit to a place on HTC" >Visit to a place on HTC</option>
												<option data-value="16" value="Leave Encashment" >Leave Encashment</option>
												<option data-value="30" value="Leave preparatory to retirement" >Leave preparatory to retirement</option>
												<option data-value="17" value="Paternity leavedue to birth of a child" >Paternity leavedue to birth of a child</option>
												<option data-value="18" value="Maternity leave on pregnancy" >Maternity leave on pregnancy</option>
												<option data-value="19" value="Maternity leave due to birth of a child" >Maternity leave due to birth of a child</option>
												<option data-value="20" value="Maternity Leave due to abortion" >Maternity Leave due to abortion</option>
												<option data-value="21" value="To attend social ceremony" >To attend social ceremony</option>
												<option data-value="22" value="To attend social rituals" >To attend social rituals</option>
												<option data-value="23" value="Due to death of a family member" >Due to death of a family member</option>
												<option data-value="24" value="Due to death of a relative" >Due to death of a relative</option>
												<option data-value="25" value="Extra-Ordinary leave with medical certificate" >Extra-Ordinary leave with medical certificate</option>
												<option data-value="26" value="Extra-Ordinary leave without medical certificate" >Extra-Ordinary leave without medical certificate</option>
												<option data-value="27" value="Study leave on approval" >Study leave on approval</option>
												<option data-value="28" value="Bad Weather Condition" >Bad Weather Condition</option>
												<option data-value="29" value="Transportation Problem" >Transportation Problem</option>
												<option data-value="30" value="Extension of Leave" >Extension of Leave</option>
												<option data-value="31" value="Other reason" >Other reason</option>
											</select>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Admissibility <span class="star">*</span></label>
										<input id="admissibility" name="admissibility" type="text" value= "As admissible" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Leave Account </label>
										<input id="leave_type_selected" name="leave_type" type="text" value= "<?php echo $this->input->get('leave_type'); ?>" class="form-control" readonly>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="leave_from" onclick = "CheckBalance();" name="leave_from" type="text" value = "<?php echo  date("d-m-Y");?>" class="form-control datepicker" required>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="leave_to" name="leave_to" type="text" value ="00-00-0000" class="form-control datepicker" placeholder = "00-00-0000">
											</div>								
										</div>			
									</div>
								</div>
							</div>							
														
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-3  col-xs-4">
												<label class="name1">Balance Leave </label>
												<input id="balance_leave" name="balance_leave" type="text" value="<?php echo $s1; ?>" class="form-control" readonly>
											</div>
											<div class="col-sm-3  col-xs-4">
												<label class="name1">Days of Commuted Leave</label>
												<input id="leave_commu_days"type="number"  name="leave_commu_days" type="text" onchange = "doubleCommuted();" value = "" class="form-control" placeholder = "0">
											</div>	
											<div class="col-sm-3  col-xs-4">
												<label class="name1">Days to be debited (Numeric)</label>
												<input id="leave_day_no" title ="Insert numerical value only i.e 1, 2, 3 etc. and Double No of days for Commuted Leave" name="leave_day_no" onClick="this.setSelectionRange(0, this.value.length)" value ="0" type="text"  class="form-control " placeholder = "0.0" required >
											</div>
											<div class="col-sm-3  col-xs-4">
												<label class="name1">Proposed joining Date</label>
												<input id="joining_dt" name="joining_dt" type="text" class="form-control datepicker" >
											</div>	
										</div>	
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">Prefixed </label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="pre_from" name="pre_from" type="text" class="form-control datepicker" >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="pre_to" name="pre_to" type="text" class="form-control datepicker" >
											</div>
										</div>
									</div>	
									<div class="col-md-4 col-sm-12">
										<label class="name">Description </label>
										<input id="pre_desc" name="pre_desc" type="text" onClick="this.setSelectionRange(0, this.value.length)" class="form-control " >
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">Suffixed</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="suff_from" name="suff_from" type="text" class="form-control datepicker" >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="suff_to" name="suff_to" type="text" class="form-control datepicker" >
											</div>
										</div>
									</div>	
									<div class="col-md-4 col-sm-12">
										<label class="name">Description</label>
										<input name="suff_desc" type="text" class="form-control " >
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
										<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label id="childname_hospital_desc"class="name">Child's name</label>
												<input id="childname_hospital" name="childname_hospital"  type="text" value="<?php echo $members['member_name'] ?>" class="form-control" >
											</div>
											<div class="col-sm-6">
												<label id="dob_mc_date_desc"class="name">Child DOB /MC date</label>
												<input id="dob_mc_date" onchange = "AvailByCheck();" name="dob_mc_date"  type="text" value="<?php  if (!empty($members['member_dob'])){ echo $members['member_dob'];}else{ echo  date("Y-m-d");} ?>" class="form-control " placeholder = '00-00-0000' >
											</div>											
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label id="avail_from_desc" class="name">Avail from</label>
												<input id="avail_from" name="avail_from" type="text"  class="form-control" placeholder ="00-00-0000" readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label id="avail_by_desc"class="name">Avail before</label>
												<input id="avail_by" name="avail_by" type="text"  class="form-control" placeholder ="00-00-0000" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Type of Last leave taken </label>
											<select <?php //echo empty($last_leave_taken['leave_type']) ?'':'readonly' ?> name="last_leave_type" class="form-control" required>
												<?php if(!empty($last_leave_taken)){ ?>
														<option  value="">----Select Last leave----</option>
														<option data-value="1" value="Earned Leave" <?=$last_leave_taken['leave_type']=='Earned Leave' ? 'selected="selected"': '' ;?>> Earned Leave</option>
														<option data-value="2" value="Half Pay Leave" <?=$last_leave_taken['leave_type']=='Half Pay Leave' ? 'selected="selected"': '' ;?>>Half Pay Leave</option>
														<option data-value="3" value="Commuted Leave"<?php echo $last_leave_type == 'Commuted Leave' ? 'selected' : ''?> >Commuted Leave</option>
														<option data-value="4" value="Child Care Leave" <?=$last_leave_taken['leave_type']=='Child Care Leave' ? 'selected="selected"': '' ;?>>Child Care Leave</option>
														<option data-value="5" value="Extra-Ordinary Leave" <?=$last_leave_taken['leave_type']=='Extra-Ordinary Leave' ? 'selected="selected"': '' ;?>> Extra-Ordinary Leave</option>
														<option data-value="6" value="Study Leave" <?=$last_leave_taken['leave_type']=='Study Leave' ? 'selected="selected"': '' ;?>> Study Leave</option>
												<?php }else{ ?>
														<option  value="">----Select Last leave----</option>
														<option data-value="1" value="Earned Leave" > Earned Leave</option>
														<option data-value="2" value="Half Pay Leave" > Half Pay Leave</option>
														<option data-value="3" value="Child Care Leave" >Child Care Leave</option>
														<option data-value="4" value="Extra-Ordinary Leave"> Extra-Ordinary Leave</option>
														<option data-value="5" value="Study Leave" > Study Leave</option>
												<?php }	?>
											</select>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name">From</label>
												<input id="last_leave_from" <?php //echo empty($last_leave_taken['leave_from']) ?'':'readonly' ?> name="last_leave_from" type="text" value="<?php echo isset($last_leave_taken['leave_from']) ? get_datepicker_date($last_leave_taken['leave_from']): ''?>" class="form-control datepicker" >
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name ">To</label>
												<input id="last_leave_to" <?php //echo empty($last_leave_taken['leave_to']) ?'':'readonly' ?> name="last_leave_to" type="text" value="<?php echo isset($last_leave_taken['leave_to']) ? get_datepicker_date($last_leave_taken['leave_to']): ''?>" class="form-control datepicker"  >
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name ">Joined On</label>
												<input id="last_leave_joined_on" <?php //echo empty($last_leave_taken['joining_dt']) ?'':'readonly' ?> name="last_leave_joined_on" type="text" value="<?php echo isset($last_leave_taken['joining_dt']) ? get_datepicker_date($last_leave_taken['joining_dt']): ''?>" class="form-control datepicker"  >
											</div>
										</div>
									</div>	
								</div>
							</div>
						    <div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-4">
										<label class="name"> LTC/HTC Block </span></label>
										<input id="block" name="block" type="text" onClick="this.setSelectionRange(0, this.value.length)" class="form-control" >
									</div>
									<div class="col-md-6 col-sm-6">
										<label class="name"> Address during leave </span></label>
										<input id="leave_address" name="leave_address" type="text" onClick="this.setSelectionRange(0, this.value.length)" class="form-control" required>
									</div>
									<div class="col-md-3 col-sm-4 name-mrgbtm">
										<label class="name">Aplication Date </span></label>
										
									</div>
									<div class="col-sm-3  col-xs-4">
										<input id="application_dt" name="application_dt" type="text" value= "<?php echo  date("d-m-Y");?>" class="form-control " readonly>
										<input id="leave_status" name="leave_status" type="hidden" value="Pending" class="form-control " >
									</div>
								</div>
							</div>
							<div class="col-sm-12" title ="Borwse to upload supporting docuemnts.">
								<div class="form-group row">
									<div class="col-md-3 col-sm-3">
										<label class="control-label">Medical Certificate required?</label>
										<select id = "mc_yes_no" name="mc_yes_no" class="form-control" required>
											<option value=""> --- Select  ---</option>
											<option data-value="1" value="Yes"<?php echo $this->input->get('mc_yes_no') == 'Yes' ? 'selected' : ''?> >Yes</option>
											<option data-value="2" value="No"<?php echo $this->input->get('mc_yes_no') == 'No' ? 'selected' : ''?> >No</option>
										</select>
									</div>
									<div class="col-md-9 col-sm-9">
										<label class="control-label">Upload supporting copies of medical certificates (.pdf)</label>
										<input id="attachment" type="file" name="link_file" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
										<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($link_file != ''){echo '&nbsp;<a href="'.base_url().'files/agae/leave_documents/'.$link_file.'" target="_blank">'.$link_file.'</a>';}?></span>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12" title ="Find the authotity by clicking the checkbox against the designation.">
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<label class="name"> Choose authority for submitting leave</span></label>
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
							</div>
							
							<div class="control-group" title ="Click the Radio button against the authotity to whom you want to send the applicaiton.">
								<label class="control-label">Choose other authority for submitting leave</label>
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
											echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input required type="radio" name="recom_autho_pan" value="'.$emp['empname'].'@@@'.$emp['desig'].'@@@'.$emp['empid'].'" />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
										  }?>
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
												<input onclick = "InformationCheck(); CheckNumber()" type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
											</div>
										</div>
									</div>
								</div>
							</div>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
										</div>
										<div class="col-sm-6 col-xs-6">
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
	  <P>12. The leaves applied for is listed under Availed Leave in "My Leave" Tab.</P>
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
	for ( var i =1; i<=4;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
}

function InformationCheck(){
	var designation = document.getElementById('desig').value;
	var basic = document.getElementById('leave_basic_pay').value;
	var section = document.getElementById('id_section').value;
	var group = document.getElementById('group_nm').value;
	if(designation !== ''){    
		if(basic >= 18000 ){
			if(section !== ''){
				if(group !== ''){
					//
				}else{
					alert("** Update your Group and other information before applying leave");
					document.getElementById("leave_type").focus();
				}
			}else{
				alert("** Update your Section and other information before applying leave");
				document.getElementById("leave_type").focus();
			}
		}else{
			alert("** Update your Basic Pay and other information before applying leave");
			document.getElementById("leave_type").focus();
		}
	}else{
		alert("** Update your Designation and other information before applying leave");
		document.getElementById("leave_type").focus();
	}
}

function AvailByCheck(){
	var LeaveType = document.getElementById('leave_type_selected').value;
	
	if(LeaveType !== '' ){
		var input = document.getElementById('dob_mc_date').value;
		var vdate = new Date(input);
		var val = document.getElementById('leave_type').value;
		 fy = vdate.getFullYear(); 
		 fm = ''+(vdate.getMonth()+1);
		 fd = ''+vdate.getDate();
		
		if (fm.length < 2){
			fm ='0' + fm;
		}
		if (fd.length < 2){
			fd ='0'+ fd;
		}
		
		var date_from = fd+"-"+fm+"-"+fy;
		
		
		if (val == 'Child Care Leave' ){
			y = vdate.getFullYear() +18;
			m = ''+(vdate.getMonth()+1);
			d = ''+(vdate.getDate());
		}else{
			document.getElementById('avail_from').value = date_from;
		}
		if (val == 'Paternity Leave' ){
			m = ''+(vdate.getMonth()+1+6);
			if (m > 12){
			y = vdate.getFullYear()+1;
			m = m-12;
			}
			d = ''+(vdate.getDate());
		}else{
			document.getElementById('avail_from').value = date_from;
		}
		if (val == 'Maternity Leave' ){
			m = ''+(vdate.getMonth()+1+6);
			if (m > 12){
			y = vdate.getFullYear()+1;
			m = m-12;
			}
			d = ''+(vdate.getDate());
		}else{
			document.getElementById('avail_from').value = date_from;
		}
		
		if (m.length < 2){
				m ='0' + m;
			}
		if (d.length < 2){
			d ='0'+ d;
		}	
		var date_to = d+"-"+m+"-"+y;
			document.getElementById('avail_by').value = date_to;
	}else{
		document.getElementById('dob_mc_date').value = '01-01-2020';
	}
}

function DisplayInformation(){
	
	var LeaveType = document.getElementById('leave_type_selected').value;

	ear_info ='Maximum 60 days can be encashed and minimum of 30 days EL balance must be maintained after encashment.'
	sal_info ='If you are probationer and your Child Care Leave balance is below 365, you will get 80% of our salary.';
	ama_info ='For AMA benificiaries, medical cetificate only from your local AMA or any Govt Hospital will be entertained.';
	pat_info ='Paternity leave can availed within 6 months from birth of the child.';
	mat_info ='Maternity leave can availed before birth of child on Medical Certificate or within 6 months from birth of the child.';
	exol_info ='If the Extra-Ordinary leave is without Medical Certificate, the period will be deduction from your Qualifying Service.';
	sty_info ='Study Leave can be availed only after approval of the Office Administration.';

	if (LeaveType == 'Half Pay Leave'  ){
			document.getElementById('pro_display').value = ama_info;
		}else{
			if (LeaveType == 'Child Care Leave'){     // && LeaveType = 'Child Care Leave' && Lbalance < 300
			document.getElementById('pro_display').value = sal_info;
			}else{
				if(LeaveType == 'Paternity Leave'){
					document.getElementById('pro_display').value = pat_info;
				}else{
					if(LeaveType == 'Extra-Ordinary Leave'){
						document.getElementById('pro_display').value = exol_info;
					}else{
						if(LeaveType == 'Maternity Leave'){
							document.getElementById('pro_display').value = mat_info;
						}else{
							if(LeaveType == 'Earned Leave'){
								document.getElementById('pro_display').value = ear_info;
							}else{
								if(LeaveType == 'Study Leave'){
								document.getElementById('pro_display').value = sty_info;
								}else{
								document.getElementById('pro_display').value = '';
								}
							}
						}
					}
				}
			}
		}
}

function FieldsReadOnly(){
	var input_val = document.getElementById('childname_hospital').value;
	if(input_val !== ''){
		document.getElementById("dob_mc_date").readOnly = true;
		document.getElementById("childname_hospital").readOnly = true;
	}else{
		document.getElementById("childname_hospital").readOnly = false;
		document.getElementById("dob_mc_date").readOnly = false;
	}
}

function LeaveConditions(){
	var LeaveType = document.getElementById('leave_type_selected').value;
	var day_deduction = document.getElementById('leave_day_no').value;

	var ccl_info = "Child Care Leave is to be taken for at least for a period of 15 days."
	if(LeaveType == 'Child Care Leave'){
		if(day_deduction<15){
			alert (ccl_info);
		}else{}
	}else{
		document.getElementById('pro_display').value = '';
	}
}


document.getElementById("leave_day_no").addEventListener("focusout", myFunction);

function CheckNumber() {
	var day_deduction = document.getElementById('leave_day_no').value;
	if(isNaN(day_deduction)){
		alert("Insert number only such as 0.5, 1, 2, 3 etc.");
		document.getElementById("leave_day_no").focus();
	}else{
		if(day_deduction <= 0){
			alert("Insert number of days to be deducted in 'No of Days' column");
			document.getElementById("leave_day_no").focus();
		}
	}
}

function CheckBalance() {
	var day_balance = document.getElementById('balance_leave').value;
	if(day_balance <= 0){
		alert("**Your Balance is 0.\n\**Select the Type of Leave & Year above. \n\** Click on 'Select' to have the Balance. \n\**Otherwise, you may contact ITCS or Administration-III");
	}
}

function MyAlert(){
//	var myText = "Instructions\n\n** Update your inforamation before applying leave.\n\** Select the type of leave that you want to apply.\n\** Click on the Select button.\n\** Check whether the balance is showing under Balance.\n\** Enter 'No of Days' in numerical value i.e. 1, 2, 3 etc. \n\** For Commuted Leave, enter no of days multiplyig by 2. \n\** For example, Enter 20 no of days of  Half Pay Leave for 10 Days Commuted Leave. \n\** Select the Designation of the Leave Sanctioning Authority.\n\** Click the Radio button against the Authoity.\n\** Write the Capta and Submit the leave.";
    myText ='Please Read Intructions before applying leave.'
	alert (myText);
}


function disabledField(){
	var val = document.getElementById('leave_type').value;

if (val == 'Earned Leave' || val == 'Half Pay Leave' || val == 'Extra-Ordinary Leave' || val == 'Study Leave' ) 
    {
		document.getElementById("child_select").style.display = 'none';
		document.getElementById("child").style.display = 'none';
		document.getElementById("child").disabled = true;
		document.getElementById("childname_hospital_desc").style.display = 'none';
		document.getElementById("childname_hospital").style.display = 'none';
		document.getElementById("childname_hospital").disabled = true;
		document.getElementById("dob_mc_date_desc").style.display = 'none';
		document.getElementById("dob_mc_date").style.display = 'none';
		document.getElementById("dob_mc_date").disabled = true;
		document.getElementById("avail_from_desc").style.display = 'none';
		document.getElementById("avail_from").style.display = 'none';
		document.getElementById("avail_from").disabled = true;
		document.getElementById("avail_by_desc").style.display = 'none';
		document.getElementById("avail_by").style.display = 'none';
		document.getElementById("avail_by").disabled = true;
//		document.getElementById("pro_display").style.display = 'none';

    }
    else 
    {
		document.getElementById("child_select").style.display = 'block';
		document.getElementById("child").style.display = 'block';
		document.getElementById("child").disabled = false;
		document.getElementById("childname_hospital_desc").style.display = 'block';
		document.getElementById("childname_hospital").style.display = 'block';
		document.getElementById("childname_hospital").disabled = false;
		document.getElementById("dob_mc_date_desc").style.display = 'block';
		document.getElementById("dob_mc_date").style.display = 'block';
		document.getElementById("dob_mc_date").disabled = false;
		document.getElementById("avail_from_desc").style.display = 'block';
		document.getElementById("avail_from").style.display = 'block';
		document.getElementById("avail_from").disabled = false;
		document.getElementById("avail_by_desc").style.display = 'block';
		document.getElementById("avail_by").style.display = 'block';
		document.getElementById("avail_by").disabled = false;
//		document.getElementById("pro_display").style.display = 'block';
    }
}
function disabledCommuted(){
	var val = document.getElementById('ground').value;

if (val == 'Commuted leave for Self illness' ) 
    {
		document.getElementById("leave_commu_days").style.display = 'block';
		document.getElementById("child").disabled = false;

    }
    else 
    {
		document.getElementById("leave_commu_days").style.display = 'none';
		document.getElementById("child").disabled = true;
    }
}

function doubleCommuted(){
	var val = document.getElementById('leave_commu_days').value;

if (val > 0  ) 
    {
		document.getElementById('leave_day_no').value = val*2;
//		document.getElementById("leave_day_no").disabled = true;
		document.getElementById("leave_day_no").style.display = 'block';
		document.getElementById("leave_commu_days").style.display = 'block';
    }
    else 
    {
		var myText = "Instructions\n\n** Enter No of Commuted Leave.  No of Days x 2 will be deducted from Half Pay Leave A/c.";
		alert (myText);
    }
}
function hplCommuted(){
	var val = document.getElementById('ground').value;
	var leave_val = document.getElementById('leave_type').value;

if (val == 'Commuted leave for Self illness'  ) 
    {
		var myText = "Instructions\n\n** Leave Account should be Half Pay Leave for Commuted Leave.\n\n** Proper Medical Certificate must be uploaded. \n\n** Entry of the leave in Service Book is subject to verification of Medical Certificate by Administration - III Section.";
		alert (myText);
    }
if (val == 'Leave Encashment'  ) 
    {
		var myText = "Instructions\n\n** Leave Account should be Earned Leave for Leave Encashment.";
		alert (myText);
    }
if (val == 'Paternity leavedue to birth of a child' || val == 'Maternity leave on pregnancy' || val == 'Maternity leave due to birth of a child' || val == 'Maternity Leave due to abortion') 
    {
		var myText = "Instructions\n\n** Medical Document must be uploaded. \n\n** Entry of the leave in Service Book is subject to verification of Medical Document by Administration - III Section.";
		alert (myText);
    }
}


</script>
