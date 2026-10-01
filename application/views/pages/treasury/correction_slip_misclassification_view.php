<?php
$report_id = isset($records['report_id']) ? $records['report_id'] : '';
$tr_cd = isset($records['tr_cd']) ? $records['tr_cd'] : '';
$yr_ta = isset($records['yr_ta']) ? $records['yr_ta'] : '';
$tr_mn = isset($records['tr_mn']) ? $records['tr_mn'] : '';
$mjh_cd = isset($records['mjh_cd']) ? $records['mjh_cd'] : '';
$smjh_cd = isset($records['smjh_cd']) ? $records['smjh_cd'] : '';
$mih_cd = isset($records['mih_cd']) ? $records['mih_cd'] : '';
$sbh_cd = isset($records['sbh_cd']) ? $records['sbh_cd'] : '';
$dtlh_cd = isset($records['dtlh_cd']) ? $records['dtlh_cd'] : '';
$cv_cd = isset($records['cv_cd']) ? $records['cv_cd'] : '';
$sdtlh_cd = isset($records['sdtlh_cd']) ? $records['sdtlh_cd'] : '';
$lop_cac = isset($records['lop_cac']) ? $records['lop_cac'] : '';
$tv_tc_no = isset($records['tv_tc_no']) ? $records['tv_tc_no'] : '';
$amt_paid = isset($records['amt_paid']) ? $records['amt_paid'] : '';
$report_desc = isset($records['report_desc']) ? $records['report_desc'] : '';
$attachment = isset($records['attachment']) ? $records['attachment'] : '';
$report_due_date = isset($records['report_due_date']) ? $records['report_due_date'] : '';
$action_status = isset($records['action_status']) ? $records['action_status'] : '';

$tr_nm = isset($profile['tr_nm']) ? $profile['tr_nm'] : '';
$try_official_name = isset($profile['try_official_name']) ? $profile['try_official_name'] : '';
$try_official_desig = isset($profile['try_official_desig']) ? $profile['try_official_desig'] : '';
$try_official_contact = isset($profile['try_official_contact']) ? $profile['try_official_contact'] : '';

?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/treasury_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo;  <?php echo $this->lang->line('treasury'); ?> &raquo;  <?php echo $this->lang->line('accounts_correction'); ?></div>
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
							<label class="name" align="center">Accounts Correction Propossed by O/o the Pr. A.G.(A&E), WB </label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="" style = "background-color: #275e93">
							<label class="name" align="center"><font color="#fff">Details of Transaction</font></span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12" style = "background-color: #ffe6b3" >&nbsp; </div>
							<div class="col-sm-12" style = "background-color: #ffe6b3">
								<div class="form-group row">
									<div class="col-md-3 col-sm-12">
										<label class="name">Name of Treasury</label>
											<input <?php echo empty($records['tr_nm']) ?'':'readonly' ?> id="tr_nm" name="tr_nm" value="<?php echo $profile['tr_nm'] ?>"  class="form-control" readonly >
									</div>
									<div class="col-md-3 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-12  col-xs-12">
												<label class="name" >Year</label>
													<input <?php echo empty($records['yr_ta']) ?'':'readonly' ?> id="yr_ta" name="yr_ta" value="<?php echo $records['yr_ta'] ?>"  class="form-control" readonly >
											</div>
										</div>
									</div>	
									<div class="col-md-3 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-12  col-xs-12">
												<label class="name" >Month</label>
													<input <?php echo empty($records['tr_mn']) ?'':'readonly' ?> id="tr_mn" name="tr_mn" value="<?php echo $records['tr_mn'] ?>"  class="form-control" readonly >
											</div>
										</div>
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="name">LOP / CA</label>
											<input <?php echo empty($records['lop_cac']) ?'':'readonly' ?> id="lop_cac" name="lop_cac" value="<?php echo $records['lop_cac'] ?>" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12" style = "background-color: #ffe6b3">
								<div class="form-group row">
									
									<div class="col-md-5 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-12  col-xs-12">
												<label class="name" >Head of Account</label>
													<input id="" name="" value="<?php echo $records['mjh_cd'] ?>-<?php echo $records['smjh_cd'] ?>-<?php echo $records['mih_cd'] ?>-<?php echo $records['sbh_cd'] ?>-<?php echo $records['dtlh_cd'] ?>-<?php echo $records['sdtlh_cd'] ?>-<?php echo $records['cv_cd'] ?>" class="form-control" readonly >
											</div>
										</div>
									</div>	
									<div class="col-md-3 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-12  col-xs-12">
												<label class="name" >Voucher/ Challan</label>
													<input <?php echo empty($records['tv_tc_no']) ?'':'readonly' ?> id="tv_tc_no" name="tv_tc_no" value="<?php echo $records['tv_tc_no'] ?>" class="form-control" >
											</div>
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Amount shown in LOP/CAC</label>
											<input <?php echo empty($records['amt_paid']) ?'':'readonly' ?> id="amt_paid" name="amt_paid" value="<?php echo $records['amt_paid'] ?>" class="form-control"  >
									</div>
								</div>
							</div>
							<div class="col-sm-12" style = "background-color:#ffe6b3">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Reasons / Remarks</label>
											<textarea id="reasons" type = "text" name="reasons" align="center" rows="3" cols="105" readonly ><?php echo $records['reasons'] ?>  </textarea >
									</div>
								</div>
							</div>
							<div class="" style = "background-color: #3671aa">
							<label class="name" align="center"><font color="#fff">Accounts Correction </font></span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12" style = "background-color: #99e699" >&nbsp; </div>
							<div class="col-sm-12" style = "background-color: #99e699">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<label class="name">Worng Head of Account</label>
											<input id="" name="" value="<?php echo $records['mjh_cd'] ?>-<?php echo $records['smjh_cd'] ?>-<?php echo $records['mih_cd'] ?>-<?php echo $records['sbh_cd'] ?>-<?php echo $records['dtlh_cd'] ?>-<?php echo $records['sdtlh_cd'] ?>-<?php echo $records['cv_cd'] ?>" class="form-control" readonly >
									</div>
									<div class="col-md-6 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-12  col-xs-12">
												<label class="name" >Correct Head of Account</label>
													<input <?php echo empty($records['mjh_cd_new']) ?'':'readonly' ?> id="mjh_cd_new" name="mjh_cd_new" value="<?php echo $records['mjh_cd_new'] ?>-<?php echo $records['smjh_cd_new'] ?>-<?php echo $records['mih_cd_new'] ?>-<?php echo $records['sbh_cd_new'] ?>-<?php echo $records['dtlh_cd_new'] ?>-<?php echo $records['sdtlh_cd_new'] ?>-<?php echo $records['cv_cd_new'] ?>" class="form-control" >
											</div>
										</div>
									</div>	
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="btn-wrap">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input <?php echo empty($records['try_official_name']) ?'':'readonly' ?> id="try_official_name" name="try_official_name" value="<?php echo $records['try_official_name'] ?>"type="text" class="form-control" readonly >	
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name">Designation</label>
												<input <?php echo empty($records['try_official_desig']) ?'':'readonly' ?> id="try_official_desig" name="try_official_desig" value="<?php echo $records['try_official_desig'] ?>" type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name ">Contact No</label>
												<input <?php echo empty($records['try_official_contact']) ?'':'readonly' ?> id="try_official_contact" name="try_official_contact" value="<?php echo $records['try_official_contact'] ?>"type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name "> Submission Date</label>
												<input <?php echo empty($records['try_date']) ?'':'readonly' ?> id="try_date" name="try_date" type="text" value= "<?php echo get_datepicker_date($records['try_date']) ?>" class="form-control " readonly>
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
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset"disabled />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit" disabled />
										</div>
									</div>
								</div>
							</div>
-->
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


</script>
