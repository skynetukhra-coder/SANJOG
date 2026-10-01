<!--
<div class="col-md-3 col-sm-4">
	<div class="left-panel">
  <?php //$this->load->view('layout/left_panel');?>
   </div>
</div>
<div class="col-md-9 col-sm-8">
-->
<div align= "center" >
	<div class="right-panel">
		<div class="breadcrumb" align= "left"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Treasury &raquo; Forgot Password													
		</div>
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
				<div class="row">
					<div class="col-sm-9">
						<div class="login">
							<div class="heading">Forgot Password</div>
							<div class="error" style="color:red; margin-bottom:5px;">
								
							</div>
							<form id="login_form" method="post" onsubmit="return check_validation()">
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Treasury User Id :</label>
									</div>
									<div class="col-sm-8">
										<input id="users" type="text" name="users" class="form-control" placeholder="Enter Treasury User Id" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Registered Mobile :</label>
									</div>
									<div class="col-sm-8">
										<input id="mobile" type="tel" name="mobile" placeholder="xxxxxxxxxx" pattern="[0-9]{10}" class="form-control" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Write Image Code:</label>
									</div>
									<div class="col-sm-8"> <?php echo $cap['image'];?>
										<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4"></div>
									<div class="col-sm-8">
										<input type="text" name="c_image" class="form-control" placeholder="Write image code" autocomplete="off" required >
									</div>
								</div>
								<div>
									<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								</div>
								<div class="form-group row">
									<div class="col-sm-4"></div>
									<div class="col-sm-8">
										<input type="submit" class="btn btn-primary" Value="Submit" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<p><b><u>Note:</u></b> Please submit your <strong>"Email and Mobile"</strong> to <a href="mailto:edpacc-agae-wb@nic.in">edpacc-agae-wb@nic.in</a>. Please ignore if you already submited.</p>
			</div>
	</div>
</div>
<script>
function check_validation(){
	var error = false;
	if($.trim($('#users').val()) == ''){
		error = true;
	}
	if($.trim($('#mobile').val()) == ''){
		error = true;
	}
	if(error){
		$('.error').text('All fields are maindatory.');
		return false;
	}else{
		$('.error').text('');
		return true;
	}
	return false;
}
</script>