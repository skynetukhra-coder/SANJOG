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
										<input id="name" name="name" value="<?php echo $profile['empname'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Office ID<span class="star"></span></label>
										<input id="office_id" name="office_id" value="<?php echo $profile['office_id'] ?>" type="text" class="form-control" readonly>
										<input id="empid" type = "hidden" name="empid" value="<?php echo $profile['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name <span class="star"></span></label>
										<input id="office_nm" name="office_nm" value="<?php echo $profile['office'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star"></span></label>
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
												<input id="basic_pay" name="basic_pay" type="text"  value="<?php echo $profile['basic_pay'] ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input id="emp_section" name="emp_section"  type="text" value="<?php echo $profile['section'] ?>" class="form-control"  required readonly>
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
												<label class="name">Mobile Number</label>
												<input id="mbno" name="mbno" type="text" value="<?php echo $profile['mbno'] ?>" class="form-control"  required readonly>
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
												<input id="emp_qualifi" name="emp_qualifi"  type="text" value="<?php echo $profile['qualifi'] ?>" class="form-control" required readonly>
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Date of Birth<span class="star"></span></label>
												<input id="dob" name="dob" type="text"  value="<?php echo get_datepicker_date($profile['dob']) ?>" class="form-control"  readonly >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Age as on (<?php echo get_datepicker_date(date("d-m-Y")) ?>)  </label>
												<input id="" name="" type="text" value="<?php echo getAgeFull($profile['dob']) ?>" class="form-control"  required readonly>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name"> Service Type<span class="star">*</span></label>
												<input id="emp_type" name="emp_type"  type="text" value="<?php echo $profile['service_type'] ?>" class="form-control" required readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Date of Retirement</label>
												<input id="dor" name="dor"  type="text" value="<?php echo get_datepicker_date($profile['dor']) ?>" class="form-control"  required readonly>
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Date of Joining<span class="star"></span></label>
												<input id="doj" name="doj" type="text"  value="<?php echo get_datepicker_date($profile['doapp']) ?>" class="form-control"  readonly >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Service as on (<?php echo get_datepicker_date(date("d-m-Y")) ?>)  </label>
												<input id="" name="" type="text" value="<?php echo getAgeFull($profile['doapp']) ?>" class="form-control"  required readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Whether SC / ST / OBC ? </label>
												<input id="emp_category" name="emp_category"  type="text" value="<?php echo $profile['category'] ?>" class="form-control" required readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Age On (As per Notification)</label>
										<input id="age_as_on" name="age_as_on"  type="text" value="" class="form-control datepicker"  required >
									</div>
									<div class="col-md-4 col-sm-6">
										<label class="name">Service On (As per Notification)  </label>
										<input id="service_as_on" name="service_as_on"  type="text" value="" class="form-control datepicker"  required >
									</div>
<!--
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Age as on<span class="star">*</span></label>
										<input id="ser_bk_age" name="ser_bk_age" type="text" value= "" class="form-control datepicker" required readonly>
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Total Service as on<span class="star">*</span></label>
										<input id="service_period" name="service_period" type="text" value= "" class="form-control datepicker" required readonly >
									</div>
-->
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<label class="name">Examination Name / Recruitment. </label>
										<input id="exam_name" name="exam_name" type="text"  class="form-control " required>
									</div>
									
									<div class="col-md-6 col-sm-12">
										<label class="name">Conducted By </label>
										<input id="conducted_by" name="conducted_by" type="text"  class="form-control " required>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Post Applied for </label>
										<input id="post_applied" name="post_applied" type="text"  class="form-control " required>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Pay level of the post </label>
										<input id="post_pay_level"  name="post_pay_level" type="text"  class="form-control " required>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Advertiser </label>
										<input id="advtiser" name="advtiser" type="text"  class="form-control " required>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<label class="name">Whether Foreign Service or another Govt. /Dept. </label>
										<select id="govt_foreign"  name="govt_foreign" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Central Govt Service" >Central Govt </option>
											<option data-value="2" value="State Govt Service" >State Govt </option>
											<option data-value="3" value="Autonomous Body Service" >Autonomous Body </option>
											<option data-value="4" value="Central PSU Service" >Central PSU </option>
											<option data-value="5" value="State PSU Service"  >State PSU </option>
											<option data-value="6" value="Banking/Insurance Service" >Banking / Insurance </option>
										</select>
									</div>
									
									<div class="col-md-6 col-sm-12">
										<label class="name">Qualification required </label>
										<input id="quali_for_post" name="quali_for_post" type="text"  class="form-control " required>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Experience, if any</label>
										<textarea id="expri_for_post" type = "text" name="expri_for_post" align="center" rows="2" cols="112"  ><?php //echo $records['reasons'] ?>  </textarea >
									</div>
								</div>
							</div>	
						    <div class="col-sm-12">
								<div class="form-group row">
									
									<div class="col-md-4 col-sm-12">
										<label class="name"> Other Qualification, if any  </label>
										<input id="other_qualifi" name="other_qualifi" type="text"  class="form-control " >
									</div>
									<div class="col-md-4 col-sm-6">
										<label class="name"> Eligibiligy </span></label>
										<select id="eligibility" name="eligibility" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Yes" >Fulfills</option>
											<option data-value="2" value="No" >Does not Fulfill</option>
										</select>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Undertaking to resign </label>
										<select id="emp_undertking" name="emp_undertking" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Yes" >Yes</option>
											<option data-value="2" value="No" >No</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12"title ="Borwse to upload supporting docuemnts.">
								<div><span style="color:red" >Documents :--1.  Permission Form for Appearing in Competitive Examination <a href = https://agwb.cag.gov.in/userfiles/files/agaewb/Forms/Admin/Competitive_Exam.pdf>(Click to download)</a>, <br>2. Application Form of the Examination and <br>3. Copy of Notification of the Examination</br></span></div>
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="control-label">Upload duly filled in supporting documents in single .pdf only. </label>
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
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
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
      <p>2. Fill up the Form carefully.</p>
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
    myText ='Please Read Intructions before applying leave.'
	alert (myText);
}

</script>
