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
		<div class="breadcrumb" align= "left">
			<a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo;  <?php echo $this->lang->line('login'); ?>												
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
				<div style="width:350px; height:180px;">
					<img  width="100%" height="180" src="<?php echo base_url()?>assets/images/sanjog3.png" alt="not_loaded.png">
				</div>
				<div class="row">&nbsp;</div>
				<div class="row">
					<div class="col-sm-7">
						<div class="login">
<!--						<div class="heading"><?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('login'); ?></div>	-->
							<div class="error" style="color:red"></div>
							<form id="login_form" method="post" onsubmit="return check_validation()">
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('employee_pan'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input id="emp_id" type="text" name="emp_id" class="form-control"  placeholder="ABCDE9999F">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('password'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input id="password" type="password" name="password" autocomplete="off" class="form-control">
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
										<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
									</div>
								</div>
								<div>
									<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								</div>
								<div class="form-group row">
									<div class="col-sm-4"></div>
									<div class="col-sm-8">
										<input type="submit" class="btn btn-primary" Value="<?php echo $this->lang->line('submit'); ?>" />
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="instruction-box">
							<div class="subheading"></div>
							<ul>
								<li>&nbsp;</li>
								<li><a href="<?php echo base_url()?>emp/forgot_password"><b><?php echo $this->lang->line('forgot_pass'); ?> ?</b></a></li>
								<li><a href="<?php echo base_url()?>emp/registration"><b><?php echo $this->lang->line('first_time_login'); ?> ? <?php echo $this->lang->line('click_here'); ?>-</b></a></li>
							</ul>
							<!--<a href="#" class="btn btn-default">Create</a>-->
						</div>
					</div>
				</div>
				<div>
				<p><b><u><?php echo $this->lang->line('note'); ?>:</u></b> <?php echo $this->lang->line('submit_your'); ?> <strong>"<?php echo $this->lang->line('email_and_mobile'); ?>"</strong> to <a href="mailto:sao1admn.wbl.ae@cag.gov.in">sao1admn.wbl.ae@cag.gov.in</a>. <?php echo $this->lang->line('ignore_already_submited'); ?>.</p>
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