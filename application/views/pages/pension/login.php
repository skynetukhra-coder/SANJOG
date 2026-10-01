<div class="row">
	<style>
	label{margin-top:10px;}
	</style>
<!--	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">		-->
		<div align= "center" >
		<div class="right-panel">
			<div class="breadcrumb" align= "left">
				<a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('ddo'); ?> &raquo;  <?php echo $this->lang->line('login'); ?>												
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
					<div class="col-sm-7">
						<div class="login">
							<div class="heading"><?php echo $this->lang->line('pen_login'); ?>Pension Login</div>
							<div class="error" style="color:red; margin-bottom:5px;">
								
							</div>
							<form id="login_form" method="post">
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('pen_user_id'); ?>:Pension User ID</label>
									</div>
									<div class="col-sm-8">
										<input id="ddo_code" type="text" name="ddo_code" class="form-control" placeholder="Enter ID">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('password'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input type="password" name="password" autocomplete="off" class="form-control">
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
								<li><a href="<?php echo base_url()?>ddo/forgot_password"><b><?php echo $this->lang->line('forgot_pass'); ?> ?</b></a></li>
								<li><a href="<?php echo base_url()?>ddo/registration"><b><?php echo $this->lang->line('first_time_login'); ?> ? <?php echo $this->lang->line('click_here'); ?></b></a></li>
							</ul>
							<!--<a href="#" class="btn btn-default">Create</a>-->
						</div>
					</div>
				</div>
				<p><b><u><?php echo $this->lang->line('note'); ?>:</u></b> <?php echo $this->lang->line('submit_your'); ?> <strong>"<?php echo $this->lang->line('email_and_mobile'); ?>"</strong> to <a href="mailto:edpfnd-agae-wb@nic.in">edpfnd-agae-wb@nic.in</a>. <?php echo $this->lang->line('ignore_already_submited'); ?>.</p>
			</div>
		</div>
	</div>
<!--
	<div class="col-md-3 col-sm-4 col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php //$this->load->view('layout/left_panel'); ?>
		</div>
	</div>
-->
</div>