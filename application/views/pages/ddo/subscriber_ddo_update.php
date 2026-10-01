<?php
$subs_id = isset($records['subs_id']) ? $records['subs_id'] : '';
$fst_nme = isset($records['fst_nme']) ? $records['fst_nme'] : '';
$mid_nme = isset($records['mid_nme']) ? $records['mid_nme'] : '';
$lst_nme = isset($records['lst_nme']) ? $records['lst_nme'] : '';
$dob = isset($records['dob']) ? $records['dob'] : '';
$basic_pay = isset($records['basic_pay']) ? $records['basic_pay'] : '';
$emp_code = isset($records['emp_code']) ? $records['emp_code'] : '';
$series = isset($records['series']) ? $records['series'] : '';
$ac_code = isset($records['ac_code']) ? $records['ac_code'] : '';
$mobile_no = isset($records['mobile_no']) ? $records['mobile_no'] : '';
$email_id = isset($records['email_id']) ? $records['email_id'] : '';
$cur_ddo = isset($records['cur_ddo']) ? $records['cur_ddo'] : '';

$tr_nm = isset($profile['tr_nm']) ? $profile['tr_nm'] : '';
$try_official_name = isset($profile['try_official_name']) ? $profile['try_official_name'] : '';
$try_official_desig = isset($profile['try_official_desig']) ? $profile['try_official_desig'] : '';
$try_official_contact = isset($profile['try_official_contact']) ? $profile['try_official_contact'] : '';

?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/ddo_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('ddo'); ?> &raquo;  <?php echo $this->lang->line('try_report'); ?> Application Upload </div>
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
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata-700001</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" align=center>SUBSCRIBER'S DETAILS</span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
											<input id="" name="" value="<?php echo $records['fst_nme'] ?> <?php echo $records['mid_nme'] ?> <?php echo $records['lst_nme'] ?>" class="form-control" readonly >
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-6  col-xs-4">
												<label class="name">GPF A/c No</label>
												<input id="" name="" value="<?php echo $records['series'] ?> / WB/ <?php echo $records['ac_code'] ?>" class="form-control" readonly >
											</div>
											<div class="col-sm-6  col-xs-4">
												<label class="name ">Basic Pay</label>
												<input id="" name="" value="<?php echo $records['basic_pay'] ?>" class="form-control" readonly >
											</div>
										</div>
									</div>	
								</div>
							</div>
						<div class="col-sm-12">
							<div class="form-group row">
								<div class="col-md-8 col-sm-12 apl-mrgbtm">
									<div class="row">
										<div class="col-sm-6  col-xs-4">
											<label class="name">Mobile No</label>
											<input <?php echo empty($records['mobile_no']) ?'':'readonly' ?>  name="" value="<?php echo $records['mobile_no'] ?>" class="form-control" placeholder = "Mobile No" >
										</div>
										<div class="col-sm-6  col-xs-4">
											<label class="name ">Email ID</label>
											<input <?php echo empty($records['email_id']) ?'':'readonly' ?>  name="" value="<?php echo $records['email_id'] ?>" class="form-control"placeholder = "Email ID" >
										</div>
									</div>
								</div>	
								<div class="col-md-4 col-sm-12">
									<label class="name">Employee ID </label>
										<input <?php echo empty($records['emp_code']) ?'':'readonly' ?> name="emp_code" value="<?php echo $records['emp_code'] ?>" class="form-control" placeholder = "IFMS Employee ID" >
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 " >
							<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<label class="name">Present DDO </label>
											<input id="" name="" value="<?php echo $records['cur_ddo'] ?>" class="form-control" readonly>
									</div>
									<div class="col-md-6 col-sm-12">
										<label class="name">New DDO </label>
											<input id="" name="cur_ddo" value="" class="form-control" >
									</div>
							</div>
						</div>
						<div  >&nbsp;</div>
						<div class="col-sm-12">
							<label class="name ">Reason: </label>
								<textarea id="" type = "text" style = "background-color: #fff; align :left" rows="2" cols="110" > </textarea >
						</div>
						<div style = "background-color: " >&nbsp;</div>
						<div class="col-sm-12 btn-wrap">
							<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input id="try_official_name" name="try_official_name" value="<?php echo $profile['user_name'] ?>"type="text" class="form-control" readonly >	
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name">Designation</label>
												<input id="try_official_desig" name="try_official_desig" value="<?php echo $profile['user_desig'] ?>" type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name ">Contact No</label>
												<input id="try_official_contact" name="try_official_contact" value="<?php echo $profile['mb_no'] ?>"type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name "> Submission Date</label>
												<input id="try_date" name="try_date" type="text" value= "<?php echo  date("d-m-Y");?>" class="form-control " readonly>
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
function show_hide_submit(){
	if($('#1').is(':checked')){
		$('#submit_btn').prop('disabled',false);
		$('#dept_remark').prop('disabled',true);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function show_hide_submit2(){
	if($('#2').is(':checked')){
		$('#submit_btn').prop('disabled',false);
		$('#dept_remark').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function selectcheckbox(id){
	for ( var i =1; i<=2;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
}


function DisplayRule(){
	
	var RuleFor = document.getElementById('report_desc').value;

	rule1_info ='Rule 4.167(4) & (5) of West Bengal Treasury Rules '
	rule2_info ='Rule 4.193(1) of West Bengal Treasury Rules';
	rule3_info ='Rule 4.193(1)] of West Bengal Treasury Rules';
	rule4_info ='Rule 6.34 of West Bengal Treasury Rules read with Finance Department (Audit Branch) Memo no. 2684-F(Y) dt. 06/04/2011 and Rule 6.08(5) of West Bengal Treasury Rules read with Finance Department (Audit Branch) Memo no. 2684-F(Y) dt. 06/04/2011.';

	if (RuleFor == 'Death of Pensioner and Commencement of Family Pension'  ){
			document.getElementById('rule_display').value = rule1_info;
		}else{
			if (RuleFor == 'Failure to draw Pension'){ 
			document.getElementById('rule_display').value = rule2_info;
			}else{
				if(RuleFor == 'Lapse Deposit Statement'){
					document.getElementById('rule_display').value = rule3_info;
				}else{
					if(RuleFor == 'Reconciliation of PD Accounts/Local Fund /PF Deposit'){
						document.getElementById('rule_display').value = rule4_info;
					}else{
						document.getElementById('rule_display').value = '';
					}		
				}
			}
		}
}

</script>
