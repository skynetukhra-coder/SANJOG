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
$link_file = isset($leaves['link_file']) ? $leaves['link_file'] : '';
$linkmc_file = isset($leaves['linkmc_file']) ? $leaves['linkmc_file'] : '';
$fore_after_noon = isset($leaves['fore_after_noon']) ? $leaves['fore_after_noon'] : '';
$leave_address = isset($leaves['leave_address']) ? $leaves['leave_address'] : '';
$block = isset($leaves['block']) ? $leaves['block'] : '';
$application_dt = isset($leaves['application_dt']) ? $leaves['application_dt'] : '';
$joining_autho = isset($leaves['joining_autho']) ? $leaves['joining_autho'] : '';
$joining_autho_desig = isset($leaves['joining_autho_desig']) ? $leaves['joining_autho_desig'] : '';
$joining_autho_pan = isset($leaves['joining_autho_pan']) ? $leaves['joining_autho_pan'] : '';
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
					<form method="post" enctype="multipart/form-data" >
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" align=center>JOINING  APPLICATIN  FORM</span></label>
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
										<label class="name">Employee ID<span class="star">*</span></label>
										<input value="<?php echo $leaves['empid'] ?>" type="text" class="form-control" readonly>
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
												<input name="group_nm"  type="text" value="<?php echo $leaves['group_nm'] ?>" class="form-control"  readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Block Year</label>
												<input name="block" type="text" value="<?php echo $leaves['block'] ?>" class="form-control"  readonly>
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
										<label class="name">Type of Leave taken<span class="star">*</span></label>
										<input name="leave_type" type="text" value= "<?php echo $leaves['leave_type'] ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-2 col-sm-12">
										<label class="name">No of Days</label>
										<input name="leave_day_no" type="text" value="<?php echo $leaves['leave_day_no'] ?>" class="form-control " readonly >
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="leave_from" type="text" value="<?php echo get_datepicker_date($leaves['leave_from']) ?>" class="form-control " readonly>
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
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Sanctioned Date<span class="star"></span></label>
												<input name="approve_date" type="text" value="<?php echo get_datepicker_date($leaves['approve_date']) ?>" class="form-control " readonly>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Joined On</label>
												<input name="joining_dt" type="text" value="<?php echo get_datepicker_date($leaves['joining_dt']) ?>" class="form-control datepicker" required>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Session</label>
												<select name="fore_after_noon" class="form-control" required>
													<option value=""> --- Select Session ---</option>
													<option data-value="1" value="Forenoon" <?=$leaves['fore_after_noon']=='Forenoon' ? 'selected="selected"': '' ;?>>Forenoon</option>
													<option data-value="2" value="Afternoon" <?=$leaves['fore_after_noon']=='Afternoon' ? 'selected="selected"': '' ;?>>Afternoon</option>
											</select>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Application Date</label>
												<input id="joining_apply_dt" name="joining_apply_dt" type="text" value= "<?php echo  date("d-m-Y");?>" class="form-control " readonly>
											</div>
										</div>
									</div>
								</div>
							</div><div class="col-sm-12" title ="Borwse to upload supporting docuemnts.">
								<div class="form-group row">
									<div class="col-md-9 col-sm-9">
										<label class="control-label">Uploaded file : <span ><?php if($link_file != ''){echo '&nbsp;<a href="'.base_url().'files/agae/leave_documents/'.$link_file.'" target="_blank">'.$link_file.'</a>';} else{ echo 'No file was uploaded earlier';}?></span>
										<br>Upload supporting copies of medical certificates (.pdf)</label>
										
										<input id="attachment" type="file" name="linkmc_file" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
										<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($linkmc_file != ''){echo '&nbsp;<a href="'.base_url().'files/agae/leave_documents/'.$linkmc_file.'" target="_blank">'.$linkmc_file.'</a>';}?></span>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<label class="name"> Choose authority for submitting Joining Report</span></label>
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
							
							
							<div class="control-group">
								<label class="control-label">Choose other authority for submitting Joining Report</label>
								<div class="controls">
								  <div class="filter-area">
									<div class="filter-row">
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
										
									  </div>
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
										<select id="filter-designation"  onchange="filterEmployeeByDesignation(this.value)">
										  <option   value="all">----Select Designation----</option>			 
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
											echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input required type="radio" name="joining_autho_pan" value="'.$emp['empname'].'@@@'.$emp['desig'].'@@@'.$emp['empid'].'" '.(($joining_autho == $emp['empname'] && $joining_autho_pan == $emp['empid'] &&  $joining_autho_desig == $emp['desig']) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
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



</script>
