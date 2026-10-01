<?php
$sanction_autho = isset($leaves['sanction_autho']) ? $leaves['sanction_autho'] : '';
$sanction_autho_desig = isset($leaves['sanction_autho_desig']) ? $leaves['sanction_autho_desig'] : '';
$sanction_autho_pan = isset($leaves['sanction_autho_pan']) ? $leaves['sanction_autho_pan'] : '';
$sanction_desc = isset($leaves['sanction_desc']) ? $leaves['sanction_desc'] : '';
$approve_date = isset($leaves['approve_date']) ? $leaves['approve_date'] : '';
$leave_status = isset($leaves['leave_status']) ? $leaves['leave_status'] : '';

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
					<form method="post" >
						<?php
								if(!empty($leave_credit)){
									$s1=0;
									foreach($leave_credit as $credit){
										$s1 += $credit['no_days']; 
									}
								}else{
										$s1=0;
								}
							?>
						<?php
								if(!empty($leave_debits)){
									$s2=0;
									foreach($leave_debits as $debit){
										$s2 += $debit['leave_day_no']; 
									}
								}else{
										$s2=0;
								}
							?>
						<?php
								if(!empty($leave_balance)){
									$s3=0;
									foreach($leave_balance as $balance){											
											$s3=$balance['leave_cb']; 
									}
								}else{
									$s3=0;
								}?>
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" align="center"> <font color="#1E0BA9"><b>LEAVE  APPLICATIN  FORM (CL AND RH)</b></font></span></label>
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
										<input value="<?php echo $leaves['name'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee ID<span class="star">*</span></label>
										<input name="empid" value="<?php echo $leaves['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name<span class="star">*</span></label>
										<input value="<?php echo $leaves['office_nm'] ?>" type="text" class="form-control"  readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input type="text" value="<?php echo $leaves['desig'] ?>" class="form-control"  readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input type="text"  value="<?php echo $leaves['leave_basic_pay'] ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input type="text" value="<?php echo $leaves['section'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input type="text" value="<?php echo $leaves['group_nm'] ?>"class="form-control " readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input type="text" value="<?php echo $leaves['mbno'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Reason for taking  leave<span class="star">*</span></label>
										<input type="text" value="<?php echo $leaves['ground'] ?>" class="form-control"  readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Remaining Balance<span class="star">*</span></label>
										<input id="balance_leave" type="text" value= "<?php echo $leaves['balance_leave'] ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-2 col-sm-12">
										<label class="name">Leave Type</label>
										<input name="leave_type" type="text" value="<?php echo $leaves['leave_type'] ?>" class="form-control"  readonly>
									</div>
									<div class="col-md-2 col-sm-12">
										<label class="name">Leave Year</label>
										<input name="leave_dr_year" type="text" value="<?php echo $leaves['leave_dr_year'] ?>" class="form-control"  readonly>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input type="text" value="<?php echo get_datepicker_date($leaves['leave_from']) ?>" class="form-control"  readonly>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input type="text" value="<?php echo get_datepicker_date($leaves['leave_to']) ?>" class="form-control"  readonly>
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
												<label class="name">No of Days<span class="star"></span></label>
												<input name="leave_day_no" type="text" value="<?php echo $leaves['leave_day_no'] ?>" class="form-control"  readonly>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
											<label class="name">Half of Day<span class="star"></span></label>
												<input type="text" value="<?php echo $leaves['half_cl'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Address during leave</label>
												<input type="text" value="<?php echo $leaves['leave_address'] ?>" class="form-control"  readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Aplication Date </label>
												<input type="text" value="<?php echo get_datepicker_date($leaves['application_dt']) ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
								</div>
							</div>		
							<div class="col-sm-12" style = "color: red" >
								<div class="btn-wrap">* Recommended to return the leave, if the leave is not in order.</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-6">
										<label class="name"> Remark of leave Sanctioning Authority<span class="star">*</span></label>
										<input  <?php echo empty($leaves['sanction_desc']) ?'':'readonly' ?> name="sanction_desc" type="text" value="<?php echo $leaves['sanction_desc'] ?>" class="form-control" >
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Status <span class="star">*</span></label>
										<select id ="sanction_select" onchange = "MyAlert()" name="leave_status" class="form-control" required>
												<option  value=""> ---- Select leave----</option>
												<option  value="Sanctioned"  >Sanctioned</option>
												<option  value="Allowed" >Allowed</option>
												<option  value="Returned"  >Returned</option>
<!--												<option  value="Recommended"  >Recommended</option>		-->
										</select>
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Date <span class="star">*</span></label>
										<input <?php echo empty($leaves['approve_date']) ?'':'' ?> name="approve_date" type="text" value="<?php echo  date("d-m-Y");?>" class="form-control " readonly>
									</div>
								</div>
							</div> 
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input name="sanction_autho" type="text" value="<?php echo $sanction_autho ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-6  col-xs-6">
												<input name="sanction_autho_desig" type="text" value="<?php echo $sanction_autho_desig ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
<!--												<label class="name1 text-right">PAN</label>		-->
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="sanction_autho_pan" type="hidden" value="<?php echo $sanction_autho_pan ?>" class="form-control"  readonly>											
											</div>								
										</div>			
									</div>
								</div>
							</div>
<!--							
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
-->							
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
	for ( var i =1; i<=8;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
}
function MyAlert(){
	var val = document.getElementById('sanction_select').value;
	var myText = "Instructions\n\n**Check the type of leave applied for.\n\**Check the available balance.\n\**Check the number of days with the period applied for.\n\**No of Days should be a numerical value only.\n\**Ensure the entry of Casual Leave(s) in the Attendance Register.";
		if(val == 'Sanctioned'){
		alert (myText);
		}
}


</script>
