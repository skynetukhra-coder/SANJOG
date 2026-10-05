<div class="row">
	<div class="col-xs-12">
		<div class="right-panel">
			<div class="breadcrumb">
				<a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('login'); ?>												
			</div>
			<div class="msg_cont">
				<div class="success">
					<?php if(isset($success) && !empty($success)){
							echo '<div class="msg alert alert-success">'.$success.'</div>';
						  }else if($this->session->flashdata('success')){
							echo '<div class="msg alert alert-success">'.$this->session->flashdata('success').'</div>';
						  }
					 ?>
				</div>
				<div class="err">
					<?php if(isset($error) && !empty($error)){
							echo '<div class="msg alert alert-danger">'.$error.'</div>';
						  }else if($this->session->flashdata('error')){
							echo '<div class="msg alert alert-danger">'.$this->session->flashdata('error').'</div>';
						  }
					 ?>
				</div>
			</div>
			<div class="login-box">
				<div class="emp-hero-banner">
					<img src="<?php echo base_url()?>assets/images/sanjog3.png" alt="SANJOG Portal" class="img-responsive center-block">
				</div>
				<div class="row">
					<div class="col-md-7 col-sm-12">
						<div class="login-inner-card">
							<div class="heading">
								<i class="fa fa-id-card"></i> DA Cadre Employee Login
							</div>
							<div class="error text-danger" style="margin-bottom:10px; font-weight:600;"></div>
							<form id="login_form" method="post" onsubmit="return check_validation()">
								<div class="form-group row">
									<label class="col-sm-4 control-label"><?php echo $this->lang->line('employee_pan'); ?>: <span class="required_star">*</span></label>
									<div class="col-sm-8">
										<input id="emp_id" type="text" name="emp_id" class="form-control" placeholder="ABCDE9999F" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 control-label"><?php echo $this->lang->line('password'); ?>: <span class="required_star">*</span></label>
									<div class="col-sm-8">
										<input id="password" type="password" name="password" autocomplete="off" class="form-control" placeholder="******" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 control-label"><?php echo $this->lang->line('write_image_code'); ?>: <span class="required_star">*</span></label>
									<div class="col-sm-8">
										<div class="captcha-control-wrap">
											<div class="captcha-img-holder">
												<?php echo $cap['image'];?>
											</div>
											<button type="button" class="btn btn-default btn-refresh-captcha" onclick="reload_captcha()" title="Re-Generate Captcha" aria-label="Reload Captcha">
												<i class="fa fa-refresh" aria-hidden="true"></i>
											</button>
										</div>
										<input type="text" name="c_image" class="form-control captcha-input" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required>
									</div>
								</div>
								<div>
									<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								</div>
								<div class="form-group row">
									<div class="col-sm-8 col-sm-offset-4">
										<button type="submit" class="btn btn-primary btn-block btn-login-submit">
											<i class="fa fa-sign-in"></i> <?php echo $this->lang->line('submit'); ?>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-5 col-sm-12">
						<div class="instruction-box">
							<div class="subheading"><i class="fa fa-link text-primary"></i> Quick Actions</div>
							<div class="action-links-list">
								<a href="<?php echo base_url()?>emp_dacadre/forgot_password" class="action-link-item">
									<i class="fa fa-key"></i> <strong><?php echo $this->lang->line('forgot_pass'); ?> ?</strong>
								</a>
								<a href="<?php echo base_url()?>emp_dacadre/registration" class="action-link-item">
									<i class="fa fa-user-plus"></i> <strong><?php echo $this->lang->line('first_time_login'); ?> ? <?php echo $this->lang->line('click_here'); ?></strong>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="login-note-card">
					<i class="fa fa-info-circle text-info"></i> <strong><u><?php echo $this->lang->line('note'); ?>:</u></strong> <?php echo $this->lang->line('submit_your'); ?> <strong>"<?php echo $this->lang->line('email_and_mobile'); ?>"</strong> to <a href="mailto:itsc-agae-wb@nic.in">itsc-agae-wb@nic.in</a>. <?php echo $this->lang->line('ignore_already_submited'); ?>.
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
function check_validation(){
	var error = false;
	if($.trim($('#emp_id').val()) == ''){
		error = true;
	}
	if($.trim($('#password').val()) == ''){
		error = true;
	}
	if(error){
		$('.error').text('<?php echo $this->lang->line('all_maindatory_fields'); ?>');
		return false;
	}else{
		$('.error').text('');
		return true;
	}
	return false;
}
</script>