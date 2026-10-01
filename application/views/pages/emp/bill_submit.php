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
							<label class="name" align="center"><font color="#1E0BA9"><b>BILL SUBMISSION  FORM </b></font></span></label>
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
										<input name="name" value="<?php echo $profile['empname'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee ID<span class="star">*</span></label>
										<input name="empid" value="<?php echo $profile['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name<span class="star">*</span></label>
										<input name="office_nm" value="<?php echo $profile['office'] ?>" type="text" class="form-control" required readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input name="desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control" required readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input name="basic_pay" type="text"  value="<?php echo $profile['basic_pay'] ?>" class="form-control" required readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input name="emp_section"  type="text" value="<?php echo $profile['section'] ?>" class="form-control" required readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input name="group_nm"  type="text" value="<?php echo $profile['group_name'] ?>" class="form-control" required readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input name="" type="text" value="<?php echo $profile['mbno'] ?>" class="form-control" required readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Bill Type <span class="star"></span></label>
											<select id="bill_type" name="bill_type" onselect="disable_inputbox()" name="year" class="form-control" required>
												<option value=""> -- Select Bill--</option>
												<option data-value="1" value="Adjustment Bill"<?php echo $this->input->get('year') == 'Adjustment Bill' ? 'selected' : ''?> >Adjustment Bill</option>
												<option data-value="2" value="Advance Bill"<?php echo $this->input->get('year') == 'Advance Bill' ? 'selected' : ''?> >Advance Bill</option>
												<option data-value="3" value="Education Allowance Bill"<?php echo $this->input->get('year') == 'Education Allowance Bill' ? 'selected' : ''?> >Education Allowance Bill</option>
												<option data-value="4" value="Medical Bill"<?php echo $this->input->get('year') == 'Medical Bill' ? 'selected' : ''?> >Medical Bill</option>
												<option data-value="5" value="News Paper Bill"<?php echo $this->input->get('year') == 'News Paper Bill' ? 'selected' : ''?> >News Paper Bill</option>
												<option data-value="6" value="LTC Bill"<?php echo $this->input->get('year') == 'LTC Bill' ? 'selected' : ''?> >LTC Bill</option>
												<option data-value="7" value="HTC Bill"<?php echo $this->input->get('year') == 'HTC Bill' ? 'selected' : ''?> >HTC Bill (LTC Converted to HTC)</option>
												<option data-value="8" value="TA Bill" <?php echo $this->input->get('year') == 'TA Bill' ? 'selected' : ''?> >TA Bill</option>
											</select>							
									</div>
									<div class="col-md-8 col-sm-6">
										<label class="name">Description / Purpose <span class="star"></span></label>
										<input name="description" type="text" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Bill Sl No</label>
											<input name="bill_no" type="text" value="<?php echo  date("Y").'/'.((int)$bill_tot['bill_tot']+1) ?>" class="form-control" readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Bill Date</label>
												<input name="bill_date" type="text" value ="<?php echo  date("d-m-Y");?>" class="form-control datepicker" readonly >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Bill Amount</label>
												<input name="bill_amount" type="text" class="form-control" >
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Advance Bill No</label>
												<input id="advance_bill_no" name="advance_bill_no" type="text" class="form-control" disabled="disabled" >
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
												<input id="bill_year"name="bill_year" type="text" value ="<?php echo  date("Y");?>" class="form-control"  readonly >
											</div>
											<div class="col-sm-6">
												<label class="name">Block Year/ Session</label>
												<input id="block" name="block" type="text" class="form-control" disabled="disabled" >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name"> From <span class="star"></span></label>
												<input id="from_date" name="from_date" type="text" class="form-control datepicker" disabled="disabled" >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name"> To </label>
												<input id="to_date"name="to_date" type="text" class="form-control datepicker" disabled="disabled" >
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
												<input id="visit_to" name="visit_to" type="text" class="form-control " disabled="disabled"  >
											</div>
											<div class="col-sm-6">
												<label class="name">Journey Mode</label>
												<input id="journey_mode" name="journey_mode" type="text" class="form-control " disabled="disabled"  >
											</div>
										</div>
									</div>
									
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Class</label>
												<select id="edu_class" name="edu_class"onselect="disable_inputbox()" name="year" class="form-control"  required disabled="disabled" >
													<option value=""> ---- Select Class ----</option>
													<option data-value="1" value="Class-I(Pre-I)"<?php echo $this->input->get('year') == 'Class-I(Pre-I)' ? 'selected' : ''?> >Class-I(Pre-I)</option>
													<option data-value="2" value="Class-1(Pre-II)"<?php echo $this->input->get('year') == 'Class-1(Pre-II)' ? 'selected' : ''?> >Class-1(Pre-II)</option>
													<option data-value="3" value=">Class-II"<?php echo $this->input->get('year') == '>Class-II' ? 'selected' : ''?> >Class-II</option>
													<option data-value="4" value="Class-III"<?php echo $this->input->get('year') == 'Class-III' ? 'selected' : ''?> >Class-III</option>
													<option data-value="5" value="Class-IV"<?php echo $this->input->get('year') == 'Class-IV' ? 'selected' : ''?> >Class-IV</option>
													<option data-value="6" value="Class-V"<?php echo $this->input->get('year') == 'Class-V' ? 'selected' : ''?> >Class-V</option>
													<option data-value="7" value="Class-VI"<?php echo $this->input->get('year') == 'Class-VI' ? 'selected' : ''?> >Class-VI</option>
													<option data-value="8" value="Class-VII"<?php echo $this->input->get('year') == 'Class-VII' ? 'selected' : ''?> >Class-VII</option>
													<option data-value="9" value="Class-VIII"<?php echo $this->input->get('year') == 'Class-VIII' ? 'selected' : ''?> >Class-VIII</option>
													<option data-value="10" value="Class-IX"<?php echo $this->input->get('year') == 'Class-IX' ? 'selected' : ''?> >Class-IX</option>
													<option data-value="11" value="Class-X"<?php echo $this->input->get('year') == 'Class-X' ? 'selected' : ''?> >Class-X</option>
													<option data-value="12" value="Class-XI"<?php echo $this->input->get('year') == 'Class-XI' ? 'selected' : ''?> >Class-XI</option>
													<option data-value="13" value="Class-XII"<?php echo $this->input->get('year') == 'Class-XII' ? 'selected' : ''?> >Class-XII</option>
												</select>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Select Child</label>
												<select id = "child_name" name="child_name" style="height:40px; width:180px; font-size: 12px;" disabled="disabled" >
													<option value=""> -- Select Child --</option>
													<?php
														if(isset($members) && !empty($members)){
															foreach($members as $memb){
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
											<input id="loc_inst_hosp" name="loc_inst_hosp" type="text" class="form-control"  disabled="disabled" >
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div>
											<label class="name"> Address of Institution / Clinic / Hospital</label>
											<input id="loc_address" name="loc_address" type="text" class="form-control"  disabled="disabled" >
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
												<select id="treatment_type" name="treatment_type"onselect="disable_inputbox()" name="year" class="form-control"  required disabled="disabled" >
													<option value=""> ---- Select Type ----</option>
													<option data-value="2" value="AMA"<?php echo $this->input->get('year') == 'AMA' ? 'selected' : ''?> >AMA</option>
													<option data-value="1" value="CGHS"<?php echo $this->input->get('year') == 'CGHS' ? 'selected' : ''?> >CGHS</option>
												</select>
											</div>
											<div class="col-sm-6">
												<label class="name">Doctor's Name</label>
												<input id="doctor" name="doctor" type="text" class="form-control " disabled="disabled"  >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name1">Fit Certificte submitted</label>
												<select id="fit_unfit" name="fit_unfit" onselect="disable_inputbox()" name="year" class="form-control"  required disabled="disabled" >
													<option value=""> ---- Select Type ----</option>
													<option data-value="2" value="Yes"<?php echo $this->input->get('year') == 'Yes' ? 'selected' : ''?> >Yes</option>
													<option data-value="1" value="No"<?php echo $this->input->get('year') == 'No' ? 'selected' : ''?> >No</option>
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
							
							<div class="col-sm-12">
								<input id="i_agree" type="checkbox" name="agree" onclick="show_hide_submit()" required/>&nbsp;&nbsp;I declare that the information furnished is true. Unless I submit original bill to Admin-II / Record Library Section within 5 working days from the date of application, whereever necessary, the reimbursement bill may not be treated as pending item.  <br /><br />
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
		document.getElementById("visit_to").disabled = true;
		document.getElementById("journey_mode").disabled = true;
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