<?php
$empid = isset($leaves['empid']) ? $leaves['empid'] : '';
$name = isset($leaves['name']) ? $leaves['name'] : '';
$office = isset($leaves['office']) ? $leaves['office'] : '';
$desig = isset($leaves['desig']) ? $leaves['desig'] : '';
$leave_type = isset($leaves['leave_type']) ? $leaves['leave_type'] : '';
$leave_from = isset($leaves['leave_from']) ? $leaves['leave_from'] : '';
$leave_to = isset($leaves['leave_to']) ? $leaves['leave_to'] : '';
$desig = isset($leaves['desig']) ? $leaves['desig'] : '';


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
							<label class="name" align=center>LEAVE  APPLICATIN  FORM</span></label>
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
										<input name="full_name" value="<?php echo $leaves['name'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee ID<span class="star">*</span></label>
										<input value="<?php echo $leaves['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name<span class="star">*</span></label>
										<input name="office" value="<?php echo $leaves['office_nm'] ?>" type="text" class="form-control"  readonly>
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
												<input name="basic_pay" type="text"  value="<?php echo $leaves['leave_basic_pay'] ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input name="section_name"  type="text" value="<?php echo $leaves['section'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input name="break_service_from" type="text" class="form-control " readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input name="phone_office" type="text" value="<?php echo $leaves['leav_id'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">	
							<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Ground of  leave<span class="star">*</span></label>
										<input type="text" class="form-control"  readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Admissibility <span class="star">*</span></label>
										<input name="hindi_apprd" type="text" value= "As admissible" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Type of Leave</label>
										<input name="break_service_from" type="text" class="form-control " readonly>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="break_service_from" type="text" value="<?php echo date('d-m-Y',strtotime($leaves['leave_from'])) ?>" class="form-control " readonly >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="break_service_to" type="text" value="<?php echo date('d-m-Y',strtotime($leaves['leave_to'])) ?>"class="form-control " readonly>
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
											<input name="break_service_to" type="text" class="form-control " readonly>
										</div>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name1 text-right">Proposed joining Date</label>
												<input name="break_service_from" type="text" class="form-control " readonly >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name1 text-right">Return from last leave</label>
												<input name="break_service_to" type="text" class="form-control " readonly>
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
												<input name="break_service_from" type="text" class="form-control " readonly>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="break_service_to" type="text" class="form-control " readonly >
											</div>
										</div>
									</div>	
									<div class="col-md-4 col-sm-12">
										<label class="name">Description </label>
										<input name="break_service_to" type="text" class="form-control " readonly>
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
												<input name="break_service_from" type="text" class="form-control " readonly>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="break_service_to" type="text" class="form-control " readonly>
											</div>
										</div>
									</div>	
									<div class="col-md-4 col-sm-12">
										<label class="name">Description</label>
										<input name="break_service_to" type="text" class="form-control " readonly >
									</div>
									
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Type of Last leave taken </label>
										<input name="break_service_from" type="text" class="form-control " readonly>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">Last leave taken</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="break_service_from" type="text" class="form-control " readonly>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="break_service_to" type="text" class="form-control " readonly>
											</div>
										</div>
									</div>	
								</div>
							</div>
						<div class="col-sm-12">
								
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Address during leave </span></label>
										<input name="hindi_apprd" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Aplication Date </span></label>
										
									</div>
									<div class="col-sm-4  col-xs-4">
												<input name="break_service_to" type="text" class="form-control " readonly>
									</div>
								</div>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<label class="name"> Choose authority for submitting leave</span></label>
											<div class="col-md-6 col-sm-6">
												
												<input id="1" type="checkbox" name="check" class="checkbx" value="ASSTT. ACCOUNTS OFFICER" onclick="selectcheckbox(this.id)" onclick="show_hide_submit()" >Asstt. Accounts Officer

											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<input id="2" type="checkbox" name="check" class="checkbx" value="ACCOUNTS OFFICER" onclick="selectcheckbox(this.id)" onclick="show_hide_submit()" >Accounts Officer
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<label class="name">:</span></label>
											<div class="col-sm-6">
												<input id="3" type="checkbox" name="check" class="checkbx" value="SR. ACCOUNTS OFFICER" onclick="selectcheckbox(this.id)" onclick="show_hide_submit()" >Sr. Accounts Officer
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<input id="4" type="checkbox" name="check" class="checkbx" value="DAG" onclick="selectcheckbox(this.id)" onclick="show_hide_submit()" >Dy Accountant General
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
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Reccomendation of the authority concerned.<span class="star">*</span></label>
										<input <?php echo empty($leaves['empid']) ?'':'readonly' ?> name="hindi_apprd" type="text" value="<?php echo $leaves['empid'] ?>" class="form-control" required>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Date<span class="star">*</span></label>
										<input <?php echo empty($leaves['group_nm']) ?'':'readonly' ?> name="hindi_apprd" type="text" value="<?php echo $leaves['group_nm'] ?>" class="form-control datepicker" required>
									</div>
								</div>
							</div>
													
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input name="phone_office" type="text" value="<?php echo $leaves['name'] ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="phone_office" type="text" value="<?php echo $leaves['desig'] ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">PAN</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="phone_office" type="text" value="<?php echo $leaves['forward_autho'] ?>" class="form-control"  readonly>											</div>								
										</div>			
									</div>
								</div>
							</div>
							<div class="col-sm-12">								
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Leave Sanctioning Authority<span class="star">*</span></label>
										<input <?php echo empty($leaves['group_nm']) ?'':'readonly' ?> name="hindi_apprd" type="text" value="<?php echo $leaves['group_nm'] ?>" class="form-control" required>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Date <span class="star">*</span></label>
										<input name="hindi_apprd" type="text" value= "" class="form-control datepicker" required>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input name="group_nm" type="text" value="<?php echo $leaves['empid'] ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="phone_office" type="text" value="<?php echo $leaves['desig'] ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">PAN</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="phone_office" type="text" value="<?php echo $leaves['forward_autho'] ?>" class="form-control"  readonly>											
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
											<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-4 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit"  />
										</div>
										<div class="col-sm-4 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset"  />
										</div>
										<div class="col-sm-4 col-xs-6">
											<input id="send_btn" type="button" class="btn btn-primary" onclick="window.location.href = '<?php echo SITE_BASE_URL ?>emp/authority'" value="Send" />
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
$('input.checkbx').on('change',function(){
	$('input.checkbx').not(this).prop('checked', false);
});
/*

// THE FOLLOWING CODE IS WORKING 

function selectcheckbox(id){
	for ( var i =1; i<=4;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
//	document.getElementById(send_btn).disabled = false;	
}
*/
</script>
