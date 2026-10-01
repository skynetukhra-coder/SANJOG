<?php
$recd_id = isset($records['recd_id']) ? $records['recd_id'] : '';
$fin_yr = isset($records['fin_yr']) ? $records['fin_yr'] : '';
$tr_mn = isset($records['tr_mn']) ? $records['tr_mn'] : '';
$ddo = isset($records['ddo']) ? $records['ddo'] : '';
$tv_tc_no = isset($records['tv_tc_no']) ? $records['tv_tc_no'] : '';
$gia_amt = isset($records['gia_amt']) ? $records['gia_amt'] : '';


$user_name = isset($profile['user_name']) ? $profile['user_name'] : '';
$user_desig = isset($profile['user_desig']) ? $profile['user_desig'] : '';
$mb_no = isset($profile['mb_no']) ? $profile['mb_no'] : '';

?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/department_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('department'); ?> &raquo; <?php echo $this->lang->line('gia_uc'); ?></div>
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
							<label class="name" align=center>GIA Information</span></label>
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
									<div class="col-md-3 col-sm-12">
										<label class="name">Fin Year</label>
										<input name="fin_yr" value="<?php echo $records['fin_yr'] ?>" type="text" class="form-control" readonly>	
									</div>
									<div class="col-md-9 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-3  col-xs-4">
												<label class="name">Month</label>
												<input name="tr_mn" value="<?php echo $records['tr_mn'] ?>" type="text" class="form-control" readonly>
											</div>
											<div class="col-sm-3  col-xs-4">
												<label class="name ">Try CD</label>
												<input name="tr_cd" value="<?php echo $records['tr_cd'] ?>" type="text" class="form-control"  readonly>
											</div>
											<div class="col-sm-3 col-xs-4">
												<label class="name "> DDO</label>
												<input name="ddo"  value="<?php echo $records['ddo'] ?> "  class="form-control"  readonly >
											</div>
											<div class="col-sm-3 col-xs-4">
												<label class="name "> TV No</label>
												<input name="tv_tc_no"  value="<?php echo $records['tv_tc_no'] ?> "  class="form-control"  readonly >
											</div>
										</div>
									</div>	
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Classification</label>
										<input name="" value="<?php echo $records['mjh_cd'] ?>-<?php echo $records['smjh_cd'] ?>-<?php echo $records['mih_cd'] ?>-<?php echo $records['sbh_cd'] ?>-<?php echo $records['dtlh_cd'] ?>-<?php echo $records['sdtlh_cd'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-sm-4 col-xs-4">
										<label class="name ">Amount</label>
										<input name="gia_amt"  value="<?php echo $records['gia_amt'] ?> "  class="form-control"  readonly >
									</div>
									<div class="col-sm-4 col-xs-4">
										<label class="name ">Balance Amount</label>
										<input name="bal_amt"  value="<?php echo $records['bal_amt'] ?> "  class="form-control"  readonly >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-12">
										<label class="name">Credited to Bank?</label>
										<select class="form-control" name="credit_to_bank" >
												<option value="">-----Select----</option>
												<option data-value="1" value="Yes" <?=$records['credit_to_bank']=='Yes' ? 'selected="selected"': '' ;?>> Yes</option>
												<option data-value="2" value="No" <?=$records['credit_to_bank']=='No' ? 'selected="selected"': '' ;?>> No</option>
										</select>
									</div>
									<div class="col-sm-3 col-xs-4">
										<label class="name ">UC Ref No</label>
										<input name="uc_ref_no"  value="<?php echo isset($records['uc_ref_no']) ? $records['uc_ref_no']: ''?>"  class="form-control" >
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="name">UC Ref Date</label>
										<input name="uc_ref_date" value="<?php echo isset($records['uc_ref_date']) ? $records['uc_ref_date']: ''?>" type="text" class="form-control datepicker" >
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="name">Amout utilised</label>
										<input name="utilised_amt" value="<?php echo isset($records['utilised_amt']) ? $records['utilised_amt']: ''?>" type="text" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Remarks</label>
											<input id="dept_remark" type="text"  name="dept_remark" value="<?php echo isset($records['dept_remark']) ? $records['dept_remark']: ''?>" class="form-control" maxlength="250" placeholder="<?php echo $this->lang->line('limit_200_words'); ?> Write comment within 250 charecters"  >
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input id="dept_official_name" name="dept_official_name" value="<?php echo $profile['user_name'] ?>"type="text" class="form-control" readonly >	
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name">Designation</label>
												<input id="dept_official_desig" name="dept_official_desig" value="<?php echo $profile['user_desig'] ?>" type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name ">Contact No</label>
												<input id="dept_official_contact" name="dept_official_contact" value="<?php echo $profile['mb_no'] ?>"type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name "> Submission Date</label>
												<input id="dept_date" name="dept_date" type="text" value= "<?php echo  date("d-m-Y");?>" class="form-control " readonly>
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


</script>
