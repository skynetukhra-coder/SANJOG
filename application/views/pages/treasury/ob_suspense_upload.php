<?php
$record_id = isset($records['record_id']) ? $records['record_id'] : '';
$fin_year = isset($records['fin_year']) ? $records['fin_year'] : '';
$month_tr = isset($records['month_tr']) ? $records['month_tr'] : '';
$major_head = isset($records['major_head']) ? $records['major_head'] : '';
$try_remark = isset($records['try_remark']) ? $records['try_remark'] : '';
$try_attachment = isset($records['try_attachment']) ? $records['try_attachment'] : '';
$try_date = isset($records['try_date']) ? $records['try_date'] : '';
$action_status = isset($records['action_status']) ? $records['action_status'] : '';

$user_name = isset($profile['user_name']) ? $profile['user_name'] : '';
$user_desig = isset($profile['user_desig']) ? $profile['user_desig'] : '';
$mb_no = isset($profile['mb_no']) ? $profile['mb_no'] : '';

?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/treasury_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('treasury'); ?> &raquo; <?php echo $this->lang->line('my_applicatn'); ?>Missing Voucher</div>
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
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" align=center>Action for OB Suspense</span></label>
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
									<div class="col-md-4 col-sm-12">
										<label class="name">Type</label>
										<input  value="OB Suspense" type="text" class="form-control" readonly>	
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name">Year</label>
												<input value="<?php echo $records['fin_year'] ?>" type="text" class="form-control" readonly>
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name ">Month</label>
												<input value="<?php echo $records['month_tr'] ?>" type="text" class="form-control"  readonly>
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name ">LOP / CAC </label>
												<input id="major_head" value="<?php echo $records['lop_cac'] ?>"  class="form-control" readonly >
											</div>
										</div>
									</div>	
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Major Head</label>
										<input  value="<?php echo $records['major_head'] ?>" type="text" class="form-control" readonly>	
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name">Voucher / Challan</label>
												<input value="<?php echo $records['voucher_challan'] ?>" type="text" class="form-control" readonly>
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name ">Gross</label>
												<input value="<?php echo $records['gross'] ?>" type="text" class="form-control"  readonly>
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name ">Reason</label>
												<input id="major_head" value="Missing Schedule"  class="form-control" readonly >
											</div>
										</div>
									</div>	
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="btn-wrap">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Remarks</label>
											<input id="try_remark" type="text" name="try_remark" class="form-control" maxlength="250" placeholder="<?php echo $this->lang->line('limit_200_words'); ?> Write comment within 250 charecters" >
									</div>
								</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-8">
										<label class="control-label">Upload supporting document(.pdf)<i style="color:red">[Please upload single pdf]</i></label>
										<input id="attachment" type="file" name="try_attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
										<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($try_attachment != ''){echo '&nbsp;<a href="'.base_url().'files/agae/department/'.$try_attachment.'" target="_blank">'.$try_attachment.'</a>';}?></span>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
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
