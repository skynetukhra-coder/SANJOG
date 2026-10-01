<?php
$recd_id = isset($records['recd_id']) ? $records['recd_id'] : '';
$yr_ta = isset($records['yr_ta']) ? $records['yr_ta'] : '';
$tr_mn = isset($records['tr_mn']) ? $records['tr_mn'] : '';
$ddo = isset($records['ddo']) ? $records['ddo'] : '';
$invst_category = isset($records['invst_category']) ? $records['invst_category'] : '';
$g_paymt = isset($records['g_paymt']) ? $records['g_paymt'] : '';
$tv_tc_no = isset($records['tv_tc_no']) ? $records['tv_tc_no'] : '';
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('department'); ?> &raquo; <?php echo $this->lang->line('investment'); ?> </div>
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
							<label class="name" align=center>Investment Information</span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-12">
										<label class="name">Fin Year</label>
										<input name="yr_ta" value="<?php echo $records['yr_ta'] ?>" type="text" class="form-control" readonly>	
									</div>
									<div class="col-md-9 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-3  col-xs-4">
												<label class="name">Month</label>
												<input name='tr_mn' value="<?php echo $records['tr_mn'] ?>" type="text" class="form-control" readonly>
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
									<div class="col-md-6 col-sm-12">
										<label class="name">Classification</label>
										<input name="" value="<?php echo $records['mjh_cd'] ?>-<?php echo $records['smjh_cd'] ?>-<?php echo $records['mih_cd'] ?>-<?php echo $records['sbh_cd'] ?>-<?php echo $records['dtlh_cd'] ?>-<?php echo $records['sdtlh_cd'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-sm-6 col-xs-4">
										<label class="name ">Amount</label>
										<input name="g_paymt"  value="<?php echo $records['g_paymt'] ?> "  class="form-control"  readonly >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-5 col-sm-12">
										<label class="name">Category of Investment</label>
										<select id="invst_category" name="invst_category" class="form-control" required>
											<option data-value="0" value=""> ---- Select Category----</option>
											<option data-value="1" value="Equity" <?=$records['invst_category']=='Equity' ? 'selected="selected"': '' ;?>> Equity </option>
											<option data-value="2" value="Preference" <?=$records['invst_category']=='Preference' ? 'selected="selected"': '' ;?>> Preference </option>
											<option data-value="3" value="Debenture" <?=$records['invst_category']=='Debenture' ? 'selected="selected"': '' ;?>> Debenture </option>
											<option data-value="4" value="Commodity" <?=$records['invst_category']=='Commodity' ? 'selected="selected"': '' ;?>> Commodity </option>
											<option data-value="5" value="Others" <?=$records['invst_category']=='Others' ? 'selected="selected"': '' ;?>> Others </option>
										</select>
									</div>
									<div class="col-sm-3 col-xs-4">
										<label class="name ">No of Share</label>
										<input name="share_no"  value="<?php echo isset($records['share_no']) ? $records['share_no']: ''?>"  class="form-control" >
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Face Value of each share</label>
										<input name="share_face_val" value="<?php echo isset($records['share_face_val']) ? $records['share_face_val']: ''?>" type="text" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-4 col-xs-4">
										<label class="name ">Percentage of Govt. Investment</label>
										<input name="govt_percentagee"  value="<?php echo isset($records['govt_percentagee']) ? $records['govt_percentagee']: ''?>"  class="form-control" >
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Devident Received</label>
										<input name="dividend_recpt" value="<?php echo isset($records['dividend_recpt']) ? $records['dividend_recpt']: ''?>" type="text" class="form-control" >
									</div>
									<div class="col-sm-4 col-xs-4">
										<label class="name ">Interest Received</label>
										<input name="interest_recpt"  value="<?php echo isset($records['interest_recpt']) ? $records['interest_recpt']: ''?>"  class="form-control"   >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Remarks</label>
											<input id="dept_remark" type="text" name="dept_remark" value="<?php echo isset($records['dept_remark']) ? $records['dept_remark']: ''?>" class="form-control" maxlength="250" placeholder="<?php echo $this->lang->line('limit_200_words'); ?> Write comment within 250 charecters"  >
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
