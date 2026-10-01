<?php
$leav_id = isset($leaves['leav_id']) ? $leaves['leav_id'] : '';
$empid = isset($leaves['empid']) ? $leaves['empid'] : '';
$name = isset($leaves['name']) ? $leaves['name'] : '';
$desig = isset($leaves['desig']) ? $leaves['desig'] : '';
$leave_basic_pay = isset($leaves['leave_basic_pay']) ? $leaves['leave_basic_pay'] : '';
$section = isset($leaves['section']) ? $leaves['section'] : '';
$mbno = isset($leaves['mbno']) ? $leaves['mbno'] : '';
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
$last_leave_type = isset($leaves['last_leave_type']) ? $leaves['last_leave_type'] : '';
$last_leave_from = isset($leaves['last_leave_from']) ? $leaves['last_leave_from'] : '';
$last_leave_to = isset($leaves['last_leave_to']) ? $leaves['last_leave_to'] : '';
$last_leave_joined_on = isset($leaves['last_leave_joined_on']) ? $leaves['last_leave_joined_on'] : '';
$childname_hospital = isset($leaves['childname_hospital']) ? $leaves['childname_hospital'] : '';
$dob_mc_date = isset($leaves['dob_mc_date']) ? $leaves['dob_mc_date'] : '';
$avail_from = isset($leaves['avail_from']) ? $leaves['avail_from'] : '';
$avail_by = isset($leaves['avail_by']) ? $leaves['avail_by'] : '';
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
$sect_check_desc = isset($leaves['sect_check_desc']) ? $leaves['sect_check_desc'] : '';
$sect_check_dt = isset($leaves['sect_check_dt']) ? $leaves['sect_check_dt'] : '';
$sect_check_name = isset($leaves['sect_check_name']) ? $leaves['sect_check_name'] : '';
$sect_check_desig = isset($leaves['sect_check_desig']) ? $leaves['sect_check_desig'] : '';
$sect_check_pan = isset($leaves['sect_check_pan']) ? $leaves['sect_check_pan'] : '';
$sanction_autho = isset($leaves['sanction_autho']) ? $leaves['sanction_autho'] : '';
$sanction_autho_desig = isset($leaves['sanction_autho_desig']) ? $leaves['sanction_autho_desig'] : '';
$sanction_autho_pan = isset($leaves['sanction_autho_pan']) ? $leaves['sanction_autho_pan'] : '';
$sanction_desc = isset($leaves['sanction_desc']) ? $leaves['sanction_desc'] : '';
$approve_date = isset($leaves['approve_date']) ? $leaves['approve_date'] : '';
$leave_status = isset($leaves['leave_status']) ? $leaves['leave_status'] : '';
$upload_dt = isset($leaves['upload_dt']) ? $leaves['upload_dt'] : '';

?>


<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('leave_for_sanction'); ?> </div>
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
					<form method="post" onmouseover ="disabledField();">
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" style="text-align:center"><font color="#1E0BA9"><b>LEAVE  APPLICATION  FORM</b></font></span></label>
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
										<input name="name" value="<?php echo $leaves['name'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee PAN<span class="star">*</span></label>
										<input name="empid" value="<?php echo $leaves['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name<span class="star">*</span></label>
										<input name="office_nm" value="<?php echo $leaves['office_nm'] ?>" type="text" class="form-control"  readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input name="desig" type="text" value="<?php echo $leaves['desig'] ?>" class="form-control"  readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input name="leave_basic_pay" type="text"  value="<?php echo $leaves['leave_basic_pay'] ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input name="section"  type="text" value="<?php echo $leaves['section'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input name="group_nm" type="text" value="<?php echo $leaves['group_nm'] ?>" class="form-control" readonly >
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input name="mbno" type="text" value="<?php echo $leaves['mbno'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">	
							<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Ground of  leave<span class="star">*</span></label>
										<input name="ground" type="text" value="<?php echo $leaves['ground'] ?>" class="form-control" readonly >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Admissibility <span class="star">*</span></label>
										<input name="admissibility" type="text" value="<?php echo $leaves['admissibility'] ?>" class="form-control" readonly >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Type of Leave</label>
										<input id = "leave_type" name="leave_type" type="text" value="<?php echo $leaves['leave_type'] ?>" class="form-control" readonly >
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="leave_from" type="text" value="<?php echo get_datepicker_date($leaves['leave_from']) ?>" class="form-control " readonly >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="leave_to" type="text" value="<?php echo get_datepicker_date($leaves['leave_to']) ?>"class="form-control " readonly>
											</div>								
										</div>			
									</div>
								</div>
							</div>	
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<div>
										<label class="name">No of Days</label>
											<input name="leave_day_no" type="text" value="<?php echo $leaves['leave_day_no'] ?>" class="form-control" readonly >
										</div>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name1 text-right">Proposed joining Date</label>
												<input name="joining_dt" type="text" value="<?php echo get_datepicker_date($leaves['joining_dt']) ?>"class="form-control " readonly>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name">Remaining Balance</label>
												<input name="balance_leave" type="text" value="<?php echo $leaves['balance_leave'] ?>" class="form-control " readonly>
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
												<input name="pre_from" type="text" value="<?php echo get_datepicker_date($leaves['pre_from']) ?>"class="form-control " readonly>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="pre_to" type="text" value="<?php echo get_datepicker_date($leaves['pre_to']) ?>"class="form-control " readonly>
											</div>
										</div>
									</div>	
									<div class="col-md-4 col-sm-12">
										<label class="name">Description </label>
										<input name="pre_desc" type="text" value="<?php echo $leaves['pre_desc'] ?>" class="form-control" readonly >
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
												<input name="suff_from" type="text" value="<?php echo get_datepicker_date($leaves['suff_from']) ?>"class="form-control " readonly>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="suff_to" type="text" value="<?php echo get_datepicker_date($leaves['suff_to']) ?>"class="form-control " readonly>
											</div>
										</div>
									</div>	
									<div class="col-md-4 col-sm-12">
										<label class="name">Description</label>
										<input name="suff_desc" type="text" value="<?php echo $leaves['suff_desc'] ?>" class="form-control" readonly >
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
										<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label id="childname_hospital_desc"class="name">Child's name</label>
												<input id="childname_hospital" name="childname_hospital"  type="text" value="<?php echo $leaves['childname_hospital'] ?>" class="form-control" readonly>
											</div>
											<div class="col-sm-6">
												<label id="dob_mc_date_desc"class="name">Child DOB /MC date</label>
												<input id="dob_mc_date" onchange = "AvailByCheck();" name="dob_mc_date"  type="text" value="<?php echo get_datepicker_date($leaves['dob_mc_date']) ?>" class="form-control " readonly >
											</div>											
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label id="avail_from_desc" class="name">Avail from</label>
												<input id="avail_from" name="avail_from" type="text" value="<?php echo get_datepicker_date($leaves['avail_from']) ?>" class="form-control" placeholder ="00-00-0000" readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label id="avail_by_desc"class="name">Avail before</label>
												<input id="avail_by" name="avail_by" type="text" value="<?php echo get_datepicker_date($leaves['avail_by']) ?>" class="form-control" placeholder ="00-00-0000" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Type of Last leave taken </label>
										<input name="last_leave_type" type="text" value="<?php echo $leaves['last_leave_type'] ?>" class="form-control" readonly >
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name1">From</label>
												<input name="last_leave_from" type="text" value="<?php echo get_datepicker_date($leaves['last_leave_from']) ?>" class="form-control datepicker" readonly>
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name1 text-right">To</label>
												<input name="last_leave_to" type="text" value="<?php echo get_datepicker_date($leaves['last_leave_to']) ?>" class="form-control datepicker" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name1 text-right">Joined On</label>
												<input name="last_leave_joined_on" type="text" value="<?php echo get_datepicker_date($leaves['last_leave_joined_on']) ?>" class="form-control datepicker" readonly >
											</div>
										</div>
									</div>	
								</div>	
							</div>

							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-4">
										<label class="name"> LTC/HTC Block </span></label>
										<input name="block" type="text" value="<?php echo $leaves['block'] ?>" class="form-control " readonly>
									</div>
									<div class="col-md-6 col-sm-6">
										<label class="name"> Address during leave </span></label>
										<input name="leave_address" type="text" value="<?php echo $leaves['leave_address'] ?>" class="form-control " readonly>
									</div>
									<div class="col-md-3 col-sm-4 name-mrgbtm">
										<label class="name">Aplication Date </span></label>
										
									</div>
									<div class="col-sm-3  col-xs-4">
										<input name="application_dt" type="text" value="<?php echo get_datepicker_date($leaves['application_dt']) ?>" class="form-control datepicker" readonly>
										<input id="leave_status" name="leave_status" type="hidden" value="Pending" class="form-control " >
									</div>
								</div>
							</div>

							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-8">
										<label class="control-label">View supporting copies of medical certificates</label>
										<input id="attachment" type="file" name="link_file" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
										<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i>:</button><span id="up_file_display"><?php if($link_file != ''){echo '&nbsp;<a href="'.base_url().'files/agae/leave_documents/'.$link_file.'" target="_blank">'.$link_file.'</a>';}?></span>
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
									<div class="col-md-8 col-sm-6">
										<label class="name"> Note of Reccomendation Authority.<span class="star">*</span></label>
										<textarea id="aao_remrk" type = "text" name="aao_remrk" align="center" rows="4" cols="60" readonly><?php echo $leaves['recommendation'] ?></textarea >
							<!--			<input <?php echo empty($leaves['recommendation']) ?'':'readonly' ?> name="recommendation" type="text" value="<?php echo $leaves['recommendation'] ?>" class="form-control" readonly> -->
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Date<span class="star">*</span></label>
										<input  <?php echo empty($leaves['recom_date']) ?'':'' ?> name="recom_date" type="text" value="<?php echo get_datepicker_date($leaves['recom_date']) ?>" class="form-control datepicker" readonly>
									</div>
								</div>
							</div>
													
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input name="recom_autho" type="text" value="<?php echo $leaves['recom_autho'] ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-6  col-xs-6">
												<input name="recom_autho_desig" type="text" value="<?php echo $leaves['recom_autho_desig'] ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
<!--												<label class="name1 text-right">PAN</label>		-->
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="recom_autho_pan" type="hidden" value="<?php echo $leaves['recom_autho_pan'] ?>" class="form-control"  readonly>											</div>								
										</div>			
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Note of Verifying Authority.<span class="star">*</span></label>
										<textarea id="aao_remrk" type = "text" name="aao_remrk" align="center" rows="4" cols="60" readonly><?php echo $leaves['sect_check_desc'] ?></textarea >
							<!--			<input <?php echo empty($leaves['sect_check_desc']) ?'':'readonly' ?> name="sect_check_desc" type="text" value="<?php echo $leaves['sect_check_desc'] ?>" class="form-control" readonly> -->
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Date<span class="star">*</span></label>
										<input  <?php echo empty($leaves['sect_check_dt']) ?'':'' ?> name="sect_check_dt" type="text" value="<?php echo get_datepicker_date($leaves['sect_check_dt']) ?>" class="form-control datepicker" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input name="sect_check_name" type="text" value="<?php echo $leaves['sect_check_name'] ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-6  col-xs-6">
												<input name="sect_check_desig" type="text" value="<?php echo $leaves['sect_check_desig'] ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
<!--												<label class="name1 text-right">PAN</label>		-->
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="sect_check_pan" type="hidden" value="<?php echo $leaves['sect_check_pan'] ?>" class="form-control"  readonly>											</div>								
										</div>			
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
								<div class="form-group row">
									<div class="col-md-6 col-sm-6">
										<label class="name"> Remark of leave Sanctioning Authority<span class="star"></span></label>
										<input <?php //echo empty($leaves['sanction_desc']) ?'':'readonly' ?> name="sanction_desc" type="text" value="<?php echo $leaves['sanction_desc'] ?>" class="form-control" >
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Status <span class="star">*</span></label>
										<select name="leave_status" class="form-control" required>
												<option value=""> ---- Select leave----</option>
												<option data-value="1" value="Returned" >Returned</option>
												<option data-value="2" value="Sanctioned" >Sanctioned</option>
<!--											<option data-value="3" value="Cancelled" >Cancelled</option>		-->
										</select>
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Date <span class="star">*</span></label>
										<input <?php echo empty($leaves['approve_date']) ?'':'' ?> name="approve_date" type="text" value="<?php echo  date("d-m-Y");?>" class="form-control" readonly>
									</div>
									
								</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input name="" type="text" value="<?php echo $sanction_autho ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-6  col-xs-6">
												<input name="" type="text" value="<?php echo $sanction_autho_desig ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
<!--												<label class="name1 text-right">PAN</label>		-->
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="" type="hidden" value="<?php echo $sanction_autho_pan ?>" class="form-control"  readonly>											
											</div>								
										</div>			
									</div>
								</div>
							</div>
<!--							
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
-->							
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset"  />
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

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy',minDate:'today'});
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

function disabledField(){
	var val = document.getElementById('leave_type').value;

if (val == 'Earned Leave' || val == 'Half Pay Leave' || val == 'Extra-Ordinary Leave' || val == 'Study Leave' ) 
    {
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

    }
    else 
    {
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
    }
}


</script>
