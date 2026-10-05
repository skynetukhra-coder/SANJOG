<div class="row">
	<div class="col-xs-12">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('gpf_status_login'); ?></div>
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
								<i class="fa fa-user-circle"></i> <?php echo $this->lang->line('subscriber_login'); ?>
							</div>
							<div class="login-sub-notice">
								<ul>
									<li><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('generate_password'); ?></li>
									<li><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('generate_password_once'); ?></li>
									<li><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('use_generated_password'); ?></li>
								</ul>
							</div>
							<div class="error text-danger" style="margin-bottom:10px; font-weight:600;"></div>
							<form id="login_form" method="post" onsubmit="return check_validation()">
								<div class="form-group row">
									<label class="col-sm-4 control-label"><?php echo $this->lang->line('series_code'); ?>: <span class="required_star">*</span></label>
									<div class="col-sm-8">
										<select id="series_code" name="series" class="form-control" required>
											<option value="">--- <?php echo $this->lang->line('choose_series_code'); ?> ---</option>
											<?php
												if(isset($series_codes)){
													foreach($series_codes as $code){
														echo '<option value="'.$code['series'].'">'.$code['series'].'</option>';
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 control-label"><?php echo $this->lang->line('gpf_no'); ?>: <span class="required_star">*</span></label>
									<div class="col-sm-8">
										<input id="gpf_no" type="number" name="gpf_account" class="form-control" placeholder="9999 (Numeric part only)" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 control-label"><?php echo $this->lang->line('date_of_birth'); ?>: <span class="required_star">*</span></label>
									<div class="col-sm-8">
										<input id="datepicker" type="text" name="dob" class="form-control" placeholder="dd-mm-yyyy" autocomplete="off" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 control-label"><?php echo $this->lang->line('password'); ?>: <span class="required_star">*</span></label>
									<div class="col-sm-8">
										<input id="password" type="password" name="password" class="form-control" autocomplete="off" placeholder="******" required>
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
							<div class="subheading"><i class="fa fa-info-circle text-primary"></i> <?php echo $this->lang->line('instruction'); ?></div>
							<ol class="instruction-list">
								<li><?php echo $this->lang->line('generate_password_use'); ?></li>
								<li><?php echo $this->lang->line('all_maindatory_fields'); ?></li>
								<li><?php echo $this->lang->line('dob_format_msg'); ?></li>
								<li><strong><?php echo $this->lang->line('email_to_register_msg'); ?><a href="mailto:edpfnd-agae-wb@nic.in">edpfnd-agae-wb@nic.in</a></strong></li>
								<li><?php echo $this->lang->line('mention_gpf_acno'); ?></li>
							</ol>
							<div class="forgot-pass-wrap">
								<a href="<?php echo base_url('subs/forgot_password')?>" class="forgot-pass-link">
									<i class="fa fa-key"></i> <strong><?php echo $this->lang->line('forgot_pass'); ?> ?</strong>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function check_validation(){
	var error = false;
	if($('#series_code').val() == ''){
		error = true;
	}
	if($('#gpf_no').val() == ''){
		error = true;
	}
	if($('#datepicker').val() == ''){
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
