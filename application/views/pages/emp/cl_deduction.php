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
$leave_day_no = isset($leaves['leave_day_no']) ? $leaves['leave_day_no'] : '';
$balance_leave = isset($leaves['balance_leave']) ? $leaves['balance_leave'] : '';
$ground = isset($leaves['ground']) ? $leaves['ground'] : '';
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
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="clSanc()" >CL RH for Sanction</a></li>
							<li  class="active" ><a data-toggle="tab" href="#tab1" onclick="clDeduc()" >CL Deduction</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<div>
					<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Enter PAN:</label>
									<input id="empid" name="empid" type="text" class="form-control" placeholder = "Enter PAN No">
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="Find" />
								</div>
								<div class="col-sm-4">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/leave_application'" value="<?php echo $this->lang->line('clear'); ?>" /> 
								</div>
							</div>
						</div>
					</form>
				</div>
			<div class="login-box">
					
				<div class="application-formwrap">
				
					<form method="post">
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
							<label class="name" align="center"> <font color="#1E0BA9"><b>CASUAL LEAVE DEDUCTION FOR LATE ATTENDANCE</b></font></span></label>
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
												<input id="section" name="section"  type="text" value="<?php echo $profile['section'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input id="group_nm" name="group_nm"  type="text" value="<?php echo $profile['group_name'] ?>" class="form-control"  readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input id="mbno" name="mbno" type="text" value="<?php echo $profile['mbno'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Leave</label>
										<input id = "leave_type" name="leave_type" type="text" value= "Casual Leave" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Reason for deduction</label>
										<input id="sanction_desc" name="sanction_desc" type="text" value="Late Attendance" class="form-control" readonly >
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Present Balance</label>
										<input id="balance_leave" name="balance_leave" type="text" value= "<?php echo $s1; ?>" class="form-control" readonly>
									</div>
								</div>
							</div>			
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Late Attendance for<span class="star">*</span></label>
										<input id="ground" name="ground" value = "" type="text" class="form-control" required >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">No of Days deducted<span class="star">*</span></label>
										<input id="leave_day_no" title = "Put numeric value only i.e. 0.5,1 1.5 etc" name="leave_day_no" type="text" class="form-control " placeholder = "0.0" required >
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
									<div class="col-md-4 col-sm-12">
										<label class="name">Authority Name</label>
										<input id = "sanction_autho" name="sanction_autho" type="text" value= "<?php echo $authority['empname'] ?>" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Designation</label>
										<input id="sanction_autho_desig" name="sanction_autho_desig" type="text" value="<?php echo $authority['desig'] ?>" class="form-control" readonly >
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">PAN</label>
										<input id="sanction_autho_pan" name="sanction_autho_pan" type="text" value= "<?php echo $authority['empid'] ?>" class="form-control" readonly>
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
												<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
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

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
function clSanc() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_pending_clrh/';
}
function clDeduc(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/cl_deduction/';
}
</script>