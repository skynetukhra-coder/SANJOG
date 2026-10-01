<?php
$leav_id = isset($leaves['leav_id']) ? $leaves['leav_id'] : '';
$empid = isset($leaves['empid']) ? $leaves['empid'] : '';
$name = isset($leaves['name']) ? $leaves['name'] : '';
$desig = isset($leaves['desig']) ? $leaves['desig'] : '';
$leave_basic_pay = isset($profile['leave_basic_pay']) ? $profile['leave_basic_pay'] : '';
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
$last_leave_type = isset($leaves['last_leave_type']) ? $leaves['last_leave_type'] : '';
$last_leave_from = isset($leaves['last_leave_from']) ? $leaves['last_leave_from'] : '';
$last_leave_to = isset($leaves['last_leave_to']) ? $leaves['last_leave_to'] : '';
$last_leave_joined_on = isset($leaves['last_leave_joined_on']) ? $leaves['last_leave_joined_on'] : '';
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

?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_leave'); ?> </div>
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
					<form method="post" enctype="multipart/form-data">
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
									<div class="col-md-4 col-sm-12">
										<label class="name">Leave Account</label>
										<input name="leave_type" type="text" value= "<?php echo $leaves['leave_type'] ?>" class="form-control" readonly>
<!--										<select name="leave_type" class="form-control" readonly >
												<option value="">-----select leave---</option>
												<option data-value="1" value="Earned Leave" <?php echo $leave_type == 'Earned Leave' ? 'selected' : ''?> >Earned Leave</option>
												<option data-value="2" value="Commuted Leave"<?php echo $leave_type == 'Commuted Leave' ? 'selected' : ''?> >Commuted Leave</option>
												<option data-value="3" value="Child Care Leave"<?php echo $leave_type == 'Child Care Leave' ? 'selected' : ''?> >Child Care Leave</option>
												<option data-value="4" value="Extra-Ordinary Leave"<?php echo $leave_type == 'Extra-Ordinary Leave' ? 'selected' : ''?> >Extra-Ordinary Leave</option>
												<option data-value="5" value="Study Leave"<?php echo $leave_type == 'Study Leave' ? 'selected' : ''?> >Study Leave</option>
											</select>
-->
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="leave_from" type="text" value="<?php echo get_datepicker_date($leaves['leave_from']) ?>" class="form-control datepicker" readonly >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="leave_to" type="text" value="<?php echo get_datepicker_date($leaves['leave_to']) ?>"class="form-control datepicker" readonly >
											</div>								
										</div>			
									</div>
								</div>
							</div>	
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-9 col-sm-9 name-mrgbtm">
										<label class="name">Address<span class="star">*</span></label>
										<input name="" type="text" value="<?php echo $profile['address1'] ?>, <?php echo $profile['postoffice'] ?>, <?php echo $profile['district'] ?>, <?php echo $profile['state'] ?>-<?php echo $profile['pin'] ?>" class="form-control"  readonly>
									</div>
									<div class="col-md-3 col-sm-3">
										<label class="name"> MC Varification Status<span class="star">*</span></label>
										<select id = "mc_varified" name="mc_varified" class="form-control"  onchange = "disabledCommuted(); hplCommuted();" required>
												<option value=""> ---- Select leave----</option>
												<option data-value="1" value="Varified" >Varified</option>
												<option data-value="2" value="Pending" >Pending</option>
											</select>
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
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12 apl-mrgbtm">
										<label class="name"></label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Name</label>
											</div>
											<div class="col-sm-10  col-xs-6">
												<input name="mc_varified_nm" type="text" value="<?php echo $profile['empname'] ?>" class="form-control"  readonly>											
											</div>
										</div>			
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name"></label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-5  col-xs-4">
												<input name="mc_varified_desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">DATE</label>
											</div>
											<div class="col-sm-3  col-xs-4">
												<input name="mc_varified_dt" type="text" value="<?php echo date("d-m-Y"); ?>" class="form-control"  readonly>
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
	for ( var i =1; i<=5;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
	
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
