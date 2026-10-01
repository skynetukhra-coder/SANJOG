<div class="col-md-3 col-sm-4">
	<div class="left-panel">
  <?php //$this->load->view('layout/left_panel');?>
   </div>
</div>
<div class="col-md-9 col-sm-8">
	<div class="right-panel">
		<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Treasury &raquo; Reset Password													
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
							<div class="heading">Reset Password</div>
							<div class="error" style="color:red; margin-bottom:5px;">
								
							</div>
							<form id="login_form" method="post" onsubmit="return check_validation()">
								<div class="form-group row">
									<div class="col-sm-4">
										<label>New Password :</label>
									</div>
									<div class="col-sm-8">
										<input id="password" type="password" name="pass" class="form-control" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Confirm Password :</label>
									</div>
									<div class="col-sm-8">
										<input id="confirm_password" type="password" name="confirm_password" class="form-control" required>
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
			</div>
	</div>
</div>
<script>
function check_validation(){
	var error = false;
	if($.trim($('#password').val()) == ''){
		error = true;
	}
	if($.trim($('#confirm_password').val()) == ''){
		error = true;
	}
	if($.trim($('#password').val()) != $.trim($('#confirm_password').val())){
		$('.error').text('Password and confirm password field not matched.');
		return false;
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