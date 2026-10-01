<?php
$attachment = isset($records['attachment']) ? $records['attachment'] : '';
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
					<button  id="myBtn" class="btn btn-warning">INSTRUCTIONS</button>
				</div>
			</div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab1" onclick="myVisit()" >Add Past Visit Records</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myFamily()" >Add Family Records</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="AppForm()" >Application Form</a></li>
						</ul>
					</div>
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
							<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>Application seeking ‘NO OBJECTION CERTIFICATE/IDENTITY CERTIFICATE’ for obtaining VISA/PASSPORT/REISSUE OF PASSPORT</b></font></span></label>
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
									<div class="col-md-5 col-sm-6">
										<label class="name">Full Name<span class="star"></span></label>
										<input id="name" name="name" value="<?php echo $profile['empname'] ?>" type="text" class="form-control" required readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star"></span></label>
										<input id="desig" name="desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control" required readonly>
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Date Of Birth<span class="star"></span></label>
										<input id="dob" name="dob" type="text" value="<?php echo get_datepicker_date($profile['dob']) ?>" class="form-control" required readonly>
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Office Name <span class="star"></span></label>
										<input id="office_nm" name="office_nm" value="<?php echo $profile['office'] ?>" type="text" class="form-control" style="text-align: left; font-size:9.5px;"required readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Father's Name</label>
										<input id="f_name" name="f_name" type="text" value="<?php echo $profile['father_name'] ?>" class="form-control"  required readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Mother's Name</label>
										<input id="m_name" name="m_name" type="text" value="<?php echo $profile['mother_name'] ?>" class="form-control"  required readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">PAN No<span class="star"></span></label>
										<input id="empid" name="empid" value="<?php echo $profile['empid'] ?>" type="text" class="form-control" required readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Voter Card No<span class="star"></span></label>
										<input id="v_card_no" name="v_card_no" value="<?php echo $profile['voter_cardno'] ?>" type="text" class="form-control" required readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Aadhar No<span class="star"></span></label>
										<input id="adh_card_no" name="adh_card_no" value="<?php echo $profile['aadhaar_cardno'] ?>" type="text" class="form-control" required readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Date of appointment (in this office)<span class="star"></span></label>
										<input id="doj" name="doj" type="text"  value="<?php echo get_datepicker_date($profile['doj_off']) ?>" class="form-control datepicker" required readonly >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Type of Service<span class="star"></span></label>
											<input id="emp_type" name="emp_type" type="text"  value="<?php echo $profile['service_type'] ?>" class="form-control" required readonly >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Identity Card No</label>
										<input id="id_card_no" name="id_card_no"  type="text" value="<?php echo $profile['id_cardno'] ?>" class="form-control"  required readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input id="basic_pay" name="basic_pay" type="text"  value="<?php echo $profile['basic_pay'] ?>" class="form-control"  required readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input style = "font-size: 12px" id="emp_section" name="emp_section"  type="text" value="<?php echo $profile['section'] ?>" class="form-control"  required readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input id="group_nm" name="group_nm"  type="text" value="<?php echo $profile['group_name'] ?>" class="form-control" required readonly>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Mobile No<span class="star"></span></label>
												<input id="mbno" name="mbno" type="text" value="<?php echo $profile['mbno'] ?>" class="form-control"  required readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-9 col-sm-9">
										<label class="name">Residencial Address </label>
										<textarea id="res_address" type = "text" name="res_address" align="center" rows="2" cols="70" required  ><?php //echo $records['res_address'] ?>  </textarea >
									</div>
									<div class="col-md-3 col-sm-3">
										<label class="name">Passport / Visa</label>
										<select id="pass_ren_visa" name="pass_ren_visa" class="form-control" onchange = "PassVisa_1();" required>
											<option data-value="0" value="">--Select--</option>
											<option data-value="1" value="Passport">New Passport for Self</option>	
											<option data-value="2" value="Passport">New Passport for Self & Dependent</option>	
											<option data-value="3" value="Passport">New Passport for Dependent</option>	
											<option data-value="4" value="Passport Renewal">Reissue of Passport for Self</option>
											<option data-value="5" value="Passport Renewal">Reissue of Passport for Self & Dependent</option>
											<option data-value="6" value="Passport Renewal">Reissue of Passport for Self & Fresh Passport for Dependent</option>
											<option data-value="7" value="Passport Renewal">Reissue of Passport for Dependent & Fresh Passport for Self</option>
											<option data-value="8" value="Passport Renewal">Change of personal particulars</option>
											<option data-value="9" value="Passport Renewal">Damage of Passport</option>
											<option data-value="10" value="Passport Renewal">Passport Booklet Exhausted</option>
											<option data-value="11" value="VISA">VISA</option>
										</select>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-9 col-sm-9">
										<label class="name">Reasons for which he / she intends to obtain Passport / Visa</label>
										<textarea id="reason_pp" type = "text" name="reason_pp" align="center" rows="2" cols="70" required ><?php //echo $records['reasons'] ?>  </textarea >
									</div>
<!--    									
									<div id="visa_for" class="col-md-3 col-sm-3">
										<label class="name">Passport / Visa For</label>
										<input name="pass_visa_for" type="text" value="Self" class="form-control"   readonly>
									</div>
-->									
									<div id ="pass_for" class="col-md-3 col-sm-3">
										<label class="name">Passport For</label>
										<select id="" name="pass_visa_for" class="form-control" >
											<option data-value="0" value="">--Select--</option>
											<option data-value="1" value="Self">Self</option>	
											<option data-value="2" value="Dependent">Dependent</option>
											<option data-value="3" value="Self and Dependent">Self and Dependent</option>
										</select>
									</div>
								</div>
							</div>	


							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-sm-6">
												<label class="name">Probable stay abroad  </label>
												<input id="period_visit" name="period_visit"  type="text" value="" class="form-control" required>
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Probable Date of Visit<span class="star"></span></label>
												<input id="visit_dt" name="visit_dt" type="text"   class="form-control datepicker" required>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Passport No</label>
												<input id="passport_no" name="passport_no" type="text" value="<?php echo $profile['passport_no'] ?>" class="form-control" >
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Date of Expiry<span class="star"></span></label>
												<input id="pexpiry_dt" name="pexpiry_dt" type="text"   class="form-control datepicker" >
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Period of Leave (in Days)</label>
												<input id="days_leave" name="days_leave" type="text" value="" class="form-control" >
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Leave From<span class="star"></span></label>
												<input id="leave_from" name="leave_from" type="text"   class="form-control datepicker" >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-md-6 col-sm-6">
												<label class="name">Leave Upto<span class="star"></span></label>
												<input id="leave_to" name="leave_to" type="text"  class="form-control datepicker" >
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Source of Fund<span class="star"></span></label>
												<input id="source_fund" name="source_fund" type="text"  value="" class="form-control " required >
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Country to Visit (full address, if any) </label>
										<input id="visit_addr" name="visit_addr" type="text"  value="" class="form-control " required>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Whether handles cash or secret documents ?</label>
										<label class="radio-inline"><input name="cash_doc" type="radio" value="Yes" />Yes</label>
										<label class="radio-inline"><input name="cash_doc" type="radio" value="No" />No</label>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Whether there is any disciplinary proceedings/Court Case/Vigilance Case pending against him/her?</label>
										<label class="radio-inline"><input name="discipl_action" type="radio" value="Yes" />Yes</label>
										<label class="radio-inline"><input name="discipl_action" type="radio" value="No" />No</label>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Whether visited any foreign country previously?  </label>
										<label class="radio-inline"><input name="pre_visit" type="radio" value="Yes" />Yes</label>
										<label class="radio-inline"><input name="pre_visit" type="radio" value="No" />No</label>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name"><span style = "color: red; ">** Add your past and also future foreign visit.</span>  </label>
									</div>
								</div>
							</div>
							<div class="control-group" title ="Click the Radio button against the authotity to whom you want to send the applicaiton.">
								<label class="control-label">Choose minor dependent for Passport / VISA</label>
								<div class="controls">
								  <div class="filter-area">
									<div class="filter-row">
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
										
									  </div>
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
										<select type= "hidden" id="filter-designation" onchange="filterEmployeeByDesignation(this.value)">
										  <option  value="all">*</option>		
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
								  <div class="epmloyees-list" style="width:100%; max-height: 75px; overflow: auto;">
											 <?php
										  foreach($minors as $minor){
										       echo '<div class="minor-row"><input type="checkbox" name="minor_name['.$minor['family_member_id'].']" value="'.$minor['member_name'].'" />&nbsp; '.$minor['member_name'].'  [ '.get_datepicker_date($minor['member_dob']).' ]</div>';
											  //echo '<div class="minor-row"><input type="checkbox" name="minor_name" value="'.$minor['member_name'].'@@@'.$minor['family_member_id'].'" />&nbsp; '.$minor['member_name'].'  ['.$minor['family_member_id'].' ]</div>';
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
							<div class="col-sm-12"title ="Borwse to upload supporting docuemnts.">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<P style = "color: red;">* Copy of Aadhar Card / Voter Card must be uploaded while applying for Passport of Dependent Family Member</P>
										<P style = "color: red;">* Copy of Passport must be uploaded while applying for renewal of Passport / VISA</P>
										<label class="control-label">Upload supporting documents. <span style = "color: red; ">(in single .pdf only)</span></label>
										<input id="attachment" type="file" name="attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
									<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($attachment != ''){echo '&nbsp;<a href="'.base_url().'files/agae/leave_documents/'.$attachment.'" target="_blank">'.$attachment.'</a>';}?></span>
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
											<div class="col-md-6 col-sm-6">
												<input id="3" type="checkbox" name="check" class="checkbx" value="SR. ACCOUNTS OFFICER" onclick="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Sr. Accounts Officer
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<label class="name">:</span></label>
											<div class="col-md-6 col-sm-6">
												<input id="4" type="checkbox" name="check" class="checkbx" value="DY. ACCOUNTANT GENERAL" onchange="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Dy. Accountant General
											</div>
											<div class="col-md-7 col-sm-6">
												<input id="5" type="checkbox" name="check" class="checkbx" value="SR.DY. ACCOUNTANT GENERAL" onchange="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Sr. Dy. Accountant General
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
										  <option  value="all">*</option>		
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
											echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input required type="radio" name="sec_off_nm" value="'.$emp['empname'].'@@@'.$emp['desig'].'@@@'.$emp['empid'].'" />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
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
								<input id="i_agree" type="checkbox" name="agree" onclick="show_hide_submit()" required/>&nbsp;&nbsp;I declare that the information furnished is true. In case of false / wrong infomation, the application may be rejected and administrative action may be initiated against me.  <br /><br />
							</div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6">
										<strong>Place: Kolkata </strong>
										<input id="decl_place" name="decl_place" type="hidden" value="Kolkata" />
									</div>
									<div class="col-sm-6">
										<strong>Date: <?php echo  date("d-m-Y");?> </strong>
										<input id="decl_date" name="decl_date" type="hidden" value="<?php echo  date("d-m-Y");?>" />
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
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
						</div>	
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>

<!--

<div id="myModal" class="modal-small">

  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Instructions</h2>
    </div>
    <div class="modal-body">
      <p>1. Check whether all your inforamation is updated before application. </p>
      <p>2. Fill up the Form carefully.</p>
    </div>
    <div class="modal-footer">
      <h3>Thanks</h3>
    </div>
  </div>

</div>
-->

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
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
//	document.getElementById("pass_for").style.display = 'none';
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

function browse(){
	$('#attachment').click();
}

function MyAlert(){
//	var myText = "Instructions\n\n** Update your inforamation before applying leave.\n\** Select the type of leave that you want to apply.\n\** Click on the Select button.\n\** Check whether the balance is showing under Balance.\n\** Enter 'No of Days' in numerical value i.e. 1, 2, 3 etc. \n\** For Commuted Leave, enter no of days multiplyig by 2. \n\** For example, Enter 20 no of days of  Half Pay Leave for 10 Days Commuted Leave. \n\** Select the Designation of the Leave Sanctioning Authority.\n\** Click the Radio button against the Authoity.\n\** Write the Capta and Submit the leave.";
    myText ='Please Read Intructions before application.'
	alert (myText);
}
function AppForm() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_passport/';
}
function myVisit() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/foreign_visits/';
    //}
}
function myFamily() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/family/';
    //}
}
function PassVisa(){
	var val = document.getElementById('pass_ren_visa').value;
	
if (val == 'Passport' || val == 'Passport Renewal'  ) 
    {
		document.getElementById("pass_for").disabled = true;
		document.getElementById("pass_for").style.display = 'block';
		document.getElementById("visa_for").disabled = false;
		document.getElementById("visa_for").style.display = 'none';
		
    }
	else{
		document.getElementById("visa_for").disabled = true;
		document.getElementById("visa_for").style.display = 'block';
		document.getElementById("pass_for").disabled = false;
		document.getElementById("pass_for").style.display = 'none';
	}
}

</script>
