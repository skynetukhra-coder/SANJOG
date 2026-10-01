<?php
$report_id = isset($records['report_id']) ? $records['report_id'] : '';
$tr_cd = isset($records['tr_cd']) ? $records['tr_cd'] : '';
$report_year = isset($records['report_year']) ? $records['report_year'] : '';
$report_month = isset($records['report_month']) ? $records['report_month'] : '';
$report_type = isset($records['report_type']) ? $records['report_type'] : '';
$report_desc = isset($records['report_desc']) ? $records['report_desc'] : '';
$try_attachment = isset($records['try_attachment']) ? $records['try_attachment'] : '';
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo;  <?php echo $this->lang->line('treasury'); ?> &raquo; <?php echo $this->lang->line('correction_memo'); ?> </div>
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
							<label class="name" align=center>CORRECTION MEMO</span><br><span>Annexure-X</span></br><br><span>[Annexure-10, Rule 4(2) of Part B]</span></br</label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="form-group row" style = "background-color: #ffdd99">
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name of Treasury</label>
											<input <?php echo empty($records['tr_nm']) ?'':'readonly' ?> id="tr_nm" name="tr_nm" value="<?php echo $profile['tr_nm'] ?>"  class="form-control" readonly >									
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-6  col-xs-4">
												<label class="name ">Year</label>
												<input <?php echo empty($records['yr_ta']) ?'':'readonly' ?> id="yr_ta" name="yr_ta" value="<?php echo $records['yr_ta'] ?>"  class="form-control" readonly >
											</div>
											<div class="col-sm-6  col-xs-4">
												<label class="name ">Month</label>
												<input <?php echo empty($records['tr_mn']) ?'':'readonly' ?> id="tr_mn" name="tr_mn" value="<?php echo $records['tr_mn'] ?>"  class="form-control" readonly >
											</div>
										</div>
									</div>	
								</div>
							</div>
							</div>
							<div class="" style = "background-color: #ffb3b3">
							<label class="name" align="left"><font color="#fff">-</font></span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12" style = "background-color: #ffe6b3">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">LOP / CA</label>
											<input <?php echo empty($records['lop_cac']) ?'':'readonly' ?> id="lop_cac" name="lop_cac" value="<?php echo $records['lop_cac'] ?>" class="form-control" >
									</div>
									<div class="col-md-5 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-12  col-xs-12">
												<label class="name" >Head of Account</label>
													<input <?php echo empty($records['mjh_cd']) ?'':'readonly' ?> id="mjh_cd" name="" value="<?php echo $records['mjh_cd'] ?>-<?php echo $records['smjh_cd'] ?>-<?php echo $records['mih_cd'] ?>-<?php echo $records['sbh_cd'] ?>-<?php echo $records['dtlh_cd'] ?>-<?php echo $records['sdtlh_cd'] ?>-<?php echo $records['cv_cd'] ?>" class="form-control"  >
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
								</div>
							</div>
							<div class="col-sm-12" style = "background-color: #ffe6b3">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Amount to be deducted/added</label>
											<input <?php echo empty($records['amt_ded_add']) ?'':'readonly' ?> id="amt_ded_add" name="amt_ded_add" value="<?php echo $records['amt_ded_add'] ?>" class="form-control"  >
									</div>
										<div class="col-md-4 col-sm-12">
										<label class="name">Amount shown in LOP/CA</label>
											<input <?php echo empty($records['lop_cac_amt']) ?'':'readonly' ?> id="lop_cac_amt" name="lop_cac_amt" value="<?php echo $records['lop_cac_amt'] ?>" class="form-control"  >
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Actual Amount (after correction)</label>
											<input <?php echo empty($records['actual_amt']) ?'':'readonly' ?> id="actual_amt" name="actual_amt" value="<?php echo $records['actual_amt'] ?>" class="form-control"  >
									</div>
								</div>
							</div>
							<div class="col-sm-12" style = "background-color:#ffe6b3">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Reasons / Remarks</label>
											<textarea id="reasons" type = "text" name="reasons" align="center" rows="3" cols="105" readonly ><?php echo $records['reasons'] ?>"  </textarea >
									</div>
								</div>
							</div>
							<div class="" style = "background-color: #ffdb4d">
							<label class="name" align="left"><font color="#fff"> - </font></span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12" style = "background-color: #ffff99">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">LOP / CA</label>
											<input <?php echo empty($records['try_lop_cac']) ?'':'readonly' ?> id="lop_cac" name="try_lop_cac" value="<?php echo $records['try_lop_cac'] ?>" class="form-control" >
									</div>
									<div class="col-md-5 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-12  col-xs-12">
												<label class="name" >Head of Account</label>
													<input <?php echo empty($records['mjh_cd_new']) ?'':'readonly' ?> id="mjh_cd_new" name="mjh_cd_new" value="<?php echo $records['mjh_cd_new'] ?>-<?php echo $records['smjh_cd_new'] ?>-<?php echo $records['mih_cd_new'] ?>-<?php echo $records['sbh_cd_new'] ?>-<?php echo $records['dtlh_cd_new'] ?>-<?php echo $records['sdtlh_cd_new'] ?>-<?php echo $records['cv_cd_new'] ?>" class="form-control" >
											</div>
										</div>
									</div>	
									<div class="col-md-3 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-12  col-xs-12">
												<label class="name" >Voucher/ Challan</label>
													<input <?php echo empty($records['try_tv_tc_no']) ?'':'readonly' ?> id="try_tv_tc_no" name="try_tv_tc_no" value="<?php echo $records['try_tv_tc_no'] ?>" class="form-control" >
											</div>
										</div>
									</div>	
								</div>
							</div>
							<div class="col-sm-12" style = "background-color: #ffff99">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Amount to be deducted/added</label>
											<input <?php echo empty($records['try_amt_ded_add']) ?'':'readonly' ?> id="try_amt_ded_add" name="try_amt_ded_add" value="<?php echo $records['try_amt_ded_add'] ?>" class="form-control"  >
									</div>
										<div class="col-md-4 col-sm-12">
										<label class="name">Amount shown in LOP/CA</label>
											<input <?php echo empty($records['try_lop_cac_amt']) ?'':'readonly' ?> id="try_lop_cac_amt" name="try_lop_cac_amt" value="<?php echo $records['try_lop_cac_amt'] ?>" class="form-control"  >
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Actual Amount (after correction)</label>
											<input <?php echo empty($records['try_actual_amt']) ?'':'readonly' ?> id="try_actual_amt" name="try_actual_amt" value="<?php echo $records['try_actual_amt'] ?>" class="form-control"  >
									</div>
								</div>
							</div>
							<div class="col-sm-12" style = "background-color: #ffff99">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Reasons / Remarks</label>
											<textarea <?php echo empty($records['try_remark']) ?'':'readonly' ?> id="try_remark" type = "text" name="try_remark" align="center" rows="3" cols="105" readonly ><?php echo $records['try_remark'] ?> </textarea >
									</div>
								</div>
							</div>
							<div>&nbsp;</div>
							<div class="col-sm-12" >
								<div class="form-group row">
									<div class="col-md-8 col-sm-12">
										<label class="control-label">Uploaded Document(.pdf)</i></label>
										<input id="attachment" type="file" name="try_attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
										<button type="button" class="" onclick=""><i class="icon-arrow-up icon-white"></i> | </button><span id="up_file_display"><?php if($try_attachment != ''){echo '&nbsp;<a href="'.base_url().'files/agae/department/'.$try_attachment.'" target="_blank">'.$try_attachment.'</a>';}?></span>
									</div>
									<div class="form-group row">
									<div class="col-md-4 col-sm-12" >
										<label class="control-label">Month of Incorporation</i></label>
										<input style = "background-color: #b5cbe0" <?php echo empty($records['incorp_month']) ?'':'readonly' ?> id="incorp_month" name="incorp_month" value="<?php echo $records['incorp_month'] ?>, <?php echo $records['incorp_year'] ?> " class="form-control"  >
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
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" disabled />
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
