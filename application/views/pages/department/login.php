<div class="row">
	<div class="col-xs-12">
		<div class="right-panel">
			<div class="breadcrumb">
				<a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('department'); ?> &raquo; <?php echo $this->lang->line('login'); ?> 
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
				<div class="row">
					<div class="col-md-7 col-sm-12">
						<div class="login-inner-card">
							<div class="heading">
								<i class="fa fa-building"></i> <?php echo $this->lang->line('department_login'); ?>
							</div>
							<div class="error text-danger" style="margin-bottom:10px; font-weight:600;"></div>
							<form id="login_form" method="post" onsubmit="return check_validation()">
								<div class="form-group row">
									<label class="col-sm-4 control-label"><?php echo $this->lang->line('department_user_id'); ?>: <span class="required_star">*</span></label>
									<div class="col-sm-8">
										<input id="users" type="text" name="users" class="form-control" placeholder="<?php echo $this->lang->line('enter_department_user_id'); ?>" required>
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
										<input type="text" name="c_image" class="form-control captcha-input" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
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
								<a href="<?php echo base_url()?>department/forgot_password" class="action-link-item">
									<i class="fa fa-key"></i> <strong><?php echo $this->lang->line('forgot_pass'); ?> ?</strong>
								</a>
								<a href="<?php echo base_url()?>department/registration" class="action-link-item">
									<i class="fa fa-user-plus"></i> <strong><?php echo $this->lang->line('first_time_login'); ?> ? <?php echo $this->lang->line('click_here'); ?></strong>
								</a>
								<a href="<?php echo base_url()?>files/agae/circular_order/User_Manual_Dept_Login.pdf" target="_blank" class="action-link-item manual-download-link" rel="noopener noreferrer">
									<i class="fa fa-file-pdf-o text-danger"></i> <strong>Download User Manual for Department</strong>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="login-note-card">
					<i class="fa fa-info-circle text-info"></i> <strong><u><?php echo $this->lang->line('note'); ?>:</u></strong> <?php echo $this->lang->line('submit_your'); ?> <strong>"<?php echo $this->lang->line('email_and_mobile'); ?>"</strong> to <a href="mailto:aoam.wbl.ae@cag.gov.in">aoam.wbl.ae@cag.gov.in</a>. <?php echo $this->lang->line('ignore_already_submited'); ?>.
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function check_validation(){
	var error = false;
	if($.trim($('#users').val()) == ''){
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