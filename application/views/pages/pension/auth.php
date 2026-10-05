<div class="row">
<style>
.col_1{font-weight:bold;}
.hide_res{display:none;}
.show_res{display:block;}
.return_reason_li{
	border-bottom:1px solid gray;
	padding:5px 5px 5px 5px; 
	font-size:13px;
}
.show_more,.show_less{
	cursor: pointer;
    color: #c25700;
    font-weight: bold;
    font-size: 12px;
}
.show_less{
	display:none;
}
</style>
<div class="row">
	<div class="col-xs-12">
		<div class="right-panel">
			<div class="breadcrumb">
				<a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('pension') ? $this->lang->line('pension') : 'Pension'; ?> &raquo; Pensioner Copy Download
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
				<div class="login-inner-card" style="max-width: 600px; margin: 0 auto; padding-right: 0;">
					<div class="heading">
						<i class="fa fa-shield"></i> <?php echo $this->lang->line('authentication'); ?>
					</div>
					<div class="error text-danger" style="margin-bottom:10px; font-weight:600;">
						<?php if(isset($error) && !empty($error)) echo $error; ?>
					</div>
					<form method="post">
						<div class="form-group row">
							<label class="col-sm-5 control-label"><?php echo $this->lang->line('enter_application_no'); ?>: <span class="required_star">*</span></label>
							<div class="col-sm-7">
								<input id="gpf_ac_no" type="text" name="application_no" class="form-control" value="<?php echo $this->input->post('application_no',true)?>" placeholder="9999999999" autocomplete="off" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-5 control-label"><?php echo $this->lang->line('write_image_code'); ?>: <span class="required_star">*</span></label>
							<div class="col-sm-7">
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
							<div class="col-sm-7 col-sm-offset-5">
								<button type="submit" class="btn btn-primary btn-block btn-login-submit">
									<i class="fa fa-check-circle"></i> <?php echo $this->lang->line('submit'); ?>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function show_all_return(){
 	$('.return_reason_li').each(function(){
		$(this).css('display','block');
	});
 }
</script>