<div class="row">
	<style>
	label{margin-top:10px;}
	</style>
<!--	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">			-->
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('gpf_status_login'); ?></div>
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
					<div class="col-sm-7">
						<div class="login">
							<div class="heading"><?php echo $this->lang->line('subscriber_login'); ?> <br><span  style="color:red; font-size: 12px">* <?php echo $this->lang->line('generate_password'); ?><br>* <?php echo $this->lang->line('generate_password_once'); ?></br>* <?php echo $this->lang->line('use_generated_password'); ?></span></br></div>
							<div class="error" style="color:red; margin-bottom:5px;">
								
							</div>
							<form id="login_form" method="post" onsubmit="return check_validation()">
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('series_code'); ?></label>
									</div>
									<div class="col-sm-8">
										<select  id="series_code" name="series" class="form-control" placeholder="dd-mm-yyyy">
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
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('gpf_no'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input id="gpf_no" type="number" name="gpf_account" class="form-control" placeholder="9999 (Numeric part only)">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('date_of_birth'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input  id='datepicker' type="text" name="dob" class="form-control" placeholder="dd-mm-yyyy"  autocomplete="off">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('password'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input id="gpf_no" type="password" name="password" class="form-control" autocomplete="off" placeholder="******">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('write_image_code'); ?>:</label>
									</div>
									<div class="col-sm-8"> <?php echo $cap['image'];?>
										<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4"></div>
									<div class="col-sm-8">
										<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>"  autocomplete="off" required>
									</div>
								</div>
								<div>
									<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								</div>
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="submit" class="btn btn-primary" Value="<?php echo $this->lang->line('submit'); ?>" />
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="instruction-box">
							<div class="subheading"><?php echo $this->lang->line('instruction'); ?></div>
							<ol type="1">
								<li><?php echo $this->lang->line('generate_password_use'); ?></li>
								<li><?php echo $this->lang->line('all_maindatory_fields'); ?></li>
								<li><?php echo $this->lang->line('dob_format_msg'); ?></li>
								<li><b><?php echo $this->lang->line('email_to_register_msg'); ?><a href="mailto:edpfnd-agae-wb@nic.in">edpfnd-agae-wb@nic.in</a></b><?php //echo $this->lang->line('or_leave_whatsapp_msg'); ?></li>
								<li><?php echo $this->lang->line('mention_gpf_acno'); ?></li>
							</ol>
							<ul>
								<li>&nbsp;</li>
								<li><a href="<?php echo base_url()?>subs/forgot_password"><b><?php echo $this->lang->line('forgot_pass'); ?> ?</b></a></li>
							</ul>
							<!--<a href="#" class="btn btn-default">Create</a>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
<!--
	<div class="col-md-3 col-sm-4 col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php  //$this->load->view('layout/left_panel');   ?>
		</div>
	</div>
-->
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
