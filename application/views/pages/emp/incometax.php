<?php
$leav_id = isset($taxamounts['leav_id']) ? $taxamounts['leav_id'] : '';
$empid = isset($taxamounts['empid']) ? $taxamounts['empid'] : '';
$name = isset($taxamounts['name']) ? $taxamounts['name'] : '';
$desig = isset($taxamounts['desig']) ? $taxamounts['desig'] : '';
$leave_basic_pay = isset($taxamounts['leave_basic_pay']) ? $taxamounts['leave_basic_pay'] : '';
$section = isset($taxamounts['section']) ? $taxamounts['section'] : '';
$group_nm = isset($taxamounts['group_nm']) ? $taxamounts['group_nm'] : '';
$office_nm = isset($taxamounts['office_nm']) ? $taxamounts['office_nm'] : '';


$applied_on = isset($taxamounts['applied_on']) ? $taxamounts['applied_on'] : '';
$upload_dt = isset($taxamounts['upload_dt']) ? $taxamounts['upload_dt'] : '';

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
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-6">
									<label class="name-label">Select Assessment Year :</label>
									<select name="leave_type" class="form-control" required>
										<option value=""> -- Select Assessment Year--</option>
										<option data-value="1" value="Child Care Leave"<?php echo $this->input->get('leave_type') == 'Child Care Leave' ? 'selected' : ''?> >2019-20</option>
										
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" class="submit-btn" value="Select" />
								</div>
								<div class="col-sm-3">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/incometax'" value="<?php echo $this->lang->line('clear'); ?>" /> 
								</div>
							</div>
						</div>
				</form>
			<div class="login-box">
				<div class="application-formwrap">
					<form method="post">
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
							<label class="name" align="center"> <font color="#1E0BA9"><b> STATEMENT OF PARTICULARS FOR INCOME TAX CALCULATION </b></font></span></label>
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
									<div class="col-md-8 col-sm-6">
										<label class="name"> Ground of  leave<span class="star">*</span></label>
										<input id="ground" name="ground" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Admissibility <span class="star">*</span></label>
										<input id="admissibility" name="admissibility" type="text" value= "" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Leave applied for</label>
										<input id="leave_type" name="leave_type" type="text" value= "<?php echo $this->input->get('leave_type'); ?>" class="form-control" readonly>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="leave_from" name="leave_from" type="text"  class="form-control datepicker" >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="leave_to" name="leave_to" type="text" class="form-control datepicker" >
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
											<input id="leave_day_no" name="leave_day_no" type="text" class="form-control " >
										</div>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name1">Proposed joining Date</label>
												<input id="joining_dt" name="joining_dt" type="text" class="form-control datepicker" >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name1">Balance Leave</label>
												<input id="balance_leave" name="balance_leave" type="text" value="<?php echo $s3+ $s1- $s2; ?>" class="form-control" readonly>
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
												<input id="pre_from" name="pre_from" type="text" class="form-control datepicker" >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="pre_to" name="pre_to" type="text" class="form-control datepicker" >
											</div>
										</div>
									</div>	
									<div class="col-md-4 col-sm-12">
										<label class="name">Description </label>
										<input id="pre_desc" name="pre_desc" type="text" class="form-control " >
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
												<input id="suff_from" name="suff_from" type="text" class="form-control datepicker" >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input id="suff_to" name="suff_to" type="text" class="form-control datepicker" >
											</div>
										</div>
									</div>	
									<div class="col-md-4 col-sm-12">
										<label class="name">Description</label>
										<input name="suff_desc" type="text" class="form-control " >
									</div>
									
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Type of Last leave taken </label>
											<select name="last_leave_type" class="form-control" required>
												<option value=""> ---- Select leave----</option>
												<option data-value="1" value="Earned Leave" <?php echo $this->input->get('year') == 'Earned Leave' ? 'selected' : ''?> >Earned Leave</option>
												<option data-value="2" value="Commutted Leave"<?php echo $this->input->get('year') == 'Commutted Leave' ? 'selected' : ''?> >Commutted Leave</option>
												<option data-value="3" value="Child Care Leave"<?php echo $this->input->get('year') == 'Child Care Leave' ? 'selected' : ''?> >Child Care Leave</option>
												<option data-value="4" value="Extra-Ordinary Leave"<?php echo $this->input->get('year') == 'Extra-Ordinary Leave' ? 'selected' : ''?> >Extra-Ordinary Leave</option>
												<option data-value="5" value="Study Leave"<?php echo $this->input->get('year') == 'Study Leave' ? 'selected' : ''?> >Study Leave</option>
											</select>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name1">From</label>
												<input id="last_leave_from" name="last_leave_from" type="text" class="form-control datepicker" >
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name1 text-right">To</label>
												<input id="last_leave_to" name="last_leave_to" type="text" class="form-control datepicker" >
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name1 text-right">Joined On</label>
												<input id="last_leave_joined_on" name="last_leave_joined_on" type="text" class="form-control datepicker" >
											</div>
										</div>
									</div>	
								</div>
							</div>
						<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-4">
										<label class="name"> LTC/HTC Block </span></label>
										<input id="block" name="block" type="text" class="form-control" >
									</div>
									<div class="col-md-6 col-sm-6">
										<label class="name"> Address during leave </span></label>
										<input id="leave_address" name="leave_address" type="text" class="form-control" >
									</div>
									<div class="col-md-3 col-sm-4 name-mrgbtm">
										<label class="name">Aplication Date </span></label>
										
									</div>
									<div class="col-sm-3  col-xs-4">
										<input id="applied_on" name="applied_on" type="text" class="form-control datepicker" >
										<input id="leave_status" name="leave_status" type="hidden" value="Pending" class="form-control " >
									</div>
								</div>
							</div>
							
							<div class="top-box">
							<label class="name" > <font color="#C70039"> I certified that the particular furnished above are correct.The Income Tax due on my salary income for the financial year <?php echo $this->input->get('assessment_yr'); ?> may be calculated on the basis of the above particulars and recovered from my salary. </font></span></label>
								<div class="row">
									<label class="name" align="center" > <font color="#3F33FF"> Note: Xorox copies of the receipts and other requisite documents must be submitted as and when asked for. </font></span></label>
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">

											</div>
										</div>
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
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit"  />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
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

</script>
