<?php
$file_id = isset($records['file_id']) ? $records['file_id'] : '';
$dyear = isset($records['dyear']) ? $records['dyear'] : '';
$dmonth = isset($records['dmonth']) ? $records['dmonth'] : '';
$title = isset($records['title']) ? $records['title'] : '';
$dept_remark = isset($records['dept_remark']) ? $records['dept_remark'] : '';
$dept_attachment = isset($records['dept_attachment']) ? $records['dept_attachment'] : '';
$dept_date = isset($records['dept_date']) ? $records['dept_date'] : '';
$action_status = isset($records['action_status']) ? $records['action_status'] : '';

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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('department'); ?> &raquo; <?php echo $this->lang->line('warning'); ?> </div>
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
							<label class="name" align=center>Action on Warning Slip</span></label>
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
										<label class="name">Work Type</label>
										<input name="order_type" value="<?php echo $records['order_type'] ?>" type="text" class="form-control" readonly>	
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name">Year</label>
												<input value="<?php echo $records['dyear'] ?>" type="text" class="form-control" readonly>
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name ">Month</label>
												<input name="office_nm" value="<?php echo $records['dmonth'] ?>" type="text" class="form-control"  readonly>
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name "> AG Office Order Date</label>
												<input id="order_date" <?php //echo empty($records['order_date']) ?'':'readonly' ?> name="order_date" type="text" value="<?php echo isset($records['order_date']) ? get_datepicker_date($records['order_date']): ''?>" class="form-control" readonly >
											</div>
										</div>
									</div>	
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Description</label>
										<input name="title" value="<?php echo $records['title'] ?>" type="text" class="form-control" readonly>
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Remarks</label>
											<input id="1" type="checkbox" class="checkbx" name="agree"  onclick="show_hide_submit();selectcheckbox(this.id)" /><font color="#C70039">&nbsp;&nbsp;Warning Slip issued by the O/o of the Pr.Accountant General is found in order.</font><br /><br />
											<input id="2" type="checkbox" class="checkbx" name="not_agree"  onclick="show_hide_submit2();selectcheckbox(this.id)" /><font color="#C70039">&nbsp;&nbsp;Warning Slip issued by the O/o of the Pr.Accountant General is not in order and the document (.pdf format) in support is uploaded:-</font><br /><br />
											<input id="dept_remark" type="text" name="dept_remark" class="form-control" maxlength="250" placeholder="<?php echo $this->lang->line('limit_200_words'); ?>Write comment within 250 charecters" disabled >
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-8">
										<label class="control-label">Upload supporting document(.pdf)<i style="color:red">[Please upload single pdf]</i></label>
										<input id="attachment" type="file" name="dept_attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
										<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($dept_attachment != ''){echo '&nbsp;<a href="'.base_url().'files/agae/leave_documents/'.$dept_attachment.'" target="_blank">'.$dept_attachment.'</a>';}?></span>
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
												<input id="dept_official_contact" name="dept_official_contact" type="text" value= "<?php echo $profile['mb_no'] ?>" class="form-control " readonly>
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
