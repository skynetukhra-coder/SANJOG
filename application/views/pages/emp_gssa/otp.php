<div class="col-md-3 col-sm-4">
	<div class="left-panel">
  <?php $this->load->view('layout/left_panel');?>
   </div>
</div>
<div class="col-md-9 col-sm-8">
	<div class="right-panel">
		<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_g_ssa'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('submit'); ?> OTP													
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
							<div class="heading"><?php echo $this->lang->line('submit'); ?> OTP</div>
							<div class="error" style="color:red; margin-bottom:5px;">
								
							</div>
							<form id="login_form" method="post" onsubmit="return check_validation()">
								<div class="form-group row">
									<div class="col-sm-4">
										<label>OTP:</label>
									</div>
									<div class="col-sm-8">
										<input id="otp" type="text" name="otp" class="form-control" placeholder="Enter OTP" >
										<br />
										<span id="resend_otp"><?php echo $this->lang->line('re-send'); ?> OTP</span>
									</div>
									<div class="col-sm-4">
										<?php 
											$otp_time =  $this->session->userdata('count_time');
											$now = time();
											$seconds = $now - $otp_time;
											$min = intval($seconds / 60);
											$sec = ($seconds - (($min) * 60));
											$remaining_min = (2 - $min) >= 0 ? (2 - $min): 0;
											$remaining_sec = (60 - $sec) >= 0 ? (60 - $sec): 0;
										?>
										<div><?php echo $this->lang->line('time_left'); ?>: <span id="timer" style="color:red" data-minute="<?php echo $remaining_min ?>" data-seconds="<?php echo $remaining_sec ?>"><?php echo $remaining_min.':'.$remaining_sec?></span></div>
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
				</div>
			</div>
	</div>
</div>
<script>
function check_validation(){
	var error = false;
	if($.trim($('#otp').val()) == ''){
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