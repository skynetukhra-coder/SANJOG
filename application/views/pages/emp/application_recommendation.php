<?php
$appl_id = isset($records['appl_id']) ? $records['appl_id'] : '';
$emp_id = isset($records['emp_id']) ? $records['emp_id'] : '';
$full_name = isset($records['full_name']) ? $records['full_name'] : '';
$desig = isset($records['desig']) ? $records['desig'] : '';
$section_name = isset($records['section_name']) ? $records['section_name'] : '';
$group_name	= isset($records['group_name']) ? $records['group_name'] : '';
$phone_office = isset($records['phone_office']) ? $records['phone_office'] : '';
$quali = isset($records['quali']) ? $records['quali'] : '';
$exm_nm = isset($records['exm_nm']) ? $records['exm_nm'] : '';
$exm_month = isset($records['exm_month']) ? $records['exm_month'] : '';
$exm_year = isset($records['exm_year']) ? $records['exm_year'] : '';
$recom_autho_remark = isset($records['recom_autho_remark']) ? $records['recom_autho_remark'] : '';
$recom_autho = isset($records['recom_autho']) ? $records['recom_autho'] : '';
$recom_autho_desig = isset($records['recom_autho_desig']) ? $records['recom_autho_desig'] : '';
$recom_autho_pan = isset($records['recom_autho_pan']) ? $records['recom_autho_pan'] : '';
$recom_date = isset($records['recom_date']) ? $records['recom_date'] : '';
$application_status = isset($records['application_status']) ? $records['application_status'] : '';
$upload_dt = isset($records['upload_dt']) ? $records['upload_dt'] : '';
$sec_autho_nm = isset($records['sec_autho_nm']) ? $records['sec_autho_nm'] : '';
$sec_autho_desig = isset($records['sec_autho_desig']) ? $records['sec_autho_desig'] : '';
$sec_autho_remrk = isset($members['sec_autho_remrk']) ? $members['sec_autho_remrk'] : '';
$sec_autho_dt = isset($members['sec_autho_dt']) ? $members['sec_autho_dt'] : '';
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
					<form method="post" onmouseover = "disabledField();">
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" style="text-align:center" ><font color="#1E0BA9"><b>EXAMINATION  APPLICATION  FOR  RECOMMENDATION</b></font></span></label>
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
										<input value="<?php echo $records['full_name'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee PAN<span class="star">*</span></label>
										<input value="<?php echo $records['emp_id'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name<span class="star">*</span></label>
										<input name="office_nm" value="Pr. Accountant General (A&E), West Bengal" type="text" class="form-control"  readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input name="desig" type="text" value="<?php echo $records['desig'] ?>" class="form-control"  readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Qualification<span class="star"></span></label>
												<input type="text"  value="<?php echo $records['quali'] ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input name="section"  type="text" value="<?php echo $records['section_name'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input name="group_nm" type="text" value="<?php echo $records['group_name'] ?>" class="form-control" readonly >
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input name="mbno" type="text" value="" class="form-control"  readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">	
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Examination</label>
										<input  type="text" value="<?php echo $records['exm_nm'] ?>" class="form-control" readonly >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Scheduled to be held in </label>
										<input  type="text" value="<?php echo $records['exm_month'] ?>-<?php echo $records['exm_year'] ?>" class="form-control" readonly >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Remark of AAO, if any</label>
										<textarea id="sec_autho_remrk" type = "text" name="sec_autho_remrk" align="center" rows="2" cols="117" readonly ><?php echo $records['sec_autho_remrk'] ?></textarea >
									</div>
								</div>
							</div>															
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input name="sec_autho_nm" type="text" value="<?php echo $records['sec_autho_nm'] ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Designation</label>
										<input name="sec_autho_desig" type="text" value="<?php echo $records['sec_autho_desig'] ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Date</label>
										<input name="sec_autho_dt" type="text" value="<?php echo $records['sec_autho_dt'] ?>" class="form-control"  readonly>											
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">	
							<div class="btn-wrap"><p></p></div>
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Recommendation <span class="star">*</span></label>
										<select name="application_status" class="form-control" required>
											<option value=""> ---- Select leave----</option>
											<option data-value="1" value="Recommended" >Recommended</option>
											<option data-value="2" value="Not Recommended" > Not Recommended</option>
											<option data-value="3" value="Withheld" >Withheld</option>
											<option data-value="4" value="Rejected" >Rejected</option>
										</select>
									</div>
									<div class="col-md-8 col-sm-6">
										<label class="name">Remarks, if any.</label>
										<input name="recom_autho_remark" type="text" value="" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input name="recom_autho" type="text" value="<?php echo $records['recom_autho'] ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="name">Designation</label>
										<input name="recom_autho_desig" type="text" value="<?php echo $records['recom_autho_desig'] ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="name">PAN</label>
										<input name="recom_autho_pan"  type="text" value="<?php echo $records['recom_autho_pan'] ?>" class="form-control"  readonly>									
									</div>
									<div class="col-md-2 col-sm-12">
										<label class="name">Date</label>
										<input name="recom_date" type="text" value="<?php echo date("d-m-Y") ?>" class="form-control"  readonly>
																						
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

function MyAlert(){
	var val = document.getElementById('recomendation_select').value;
	var myText = "Instructions\n\n** Check the period of leave applied for.\n\** Check the numbers of days to be deducted under 'No of Days'.\n\** Check the documents by clicing on the documents name.\n\** Ensure that Medical Certificate furnished is from his/her local AMA.\n\** Medical Certificate from any Govt. Hospital is allowed \n\** Ensure double deduction of HPL, whenever necessary.\n\** Click the Radio button against the Authoity to send the leave for sanction.\n\** Write the Capta and Reccomend the leave.";
    if(val == 'Recommended'){
		alert (myText);
	}
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
