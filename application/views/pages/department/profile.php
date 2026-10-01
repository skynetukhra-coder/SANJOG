<style>
	td{padding:5px 0;padding-left:10px; width:50%}
	.col_1{width:150px;}
	.col_3,.col_4{width:50px;text-align:center}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/department_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('department'); ?> &raquo; <?php echo $this->lang->line('update_profile'); ?> </div>
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
				<h4><strong><?php echo $this->lang->line('my_profile'); ?></strong></h4>
				<hr />
					<form id="login_form" method="post">
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('name'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input id="user_name" type="text" name="user_name" class="form-control" value="<?php echo isset($profile['user_name']) ? $profile['user_name']: '' ?>" placeholder="Enter name here" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('designation'); ?>Designation:</label>
									</div>
									<div class="col-sm-8">
										<input id="user_desig" type="text" name="user_desig" class="form-control" value="<?php echo isset($profile['user_desig']) ? $profile['user_desig']: '' ?>" placeholder="Enter designation here" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('email'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input id="email" type="text" name="email" class="form-control" value="<?php echo isset($profile['emailid']) ? $profile['emailid']: get_value('email')?>" placeholder="Enter email id here" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('phone'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input id="phone" type="text" name="phone" class="form-control" value="<?php echo isset($profile['mb_no']) ? $profile['mb_no']: get_value('phone')?>" placeholder="Enter Mobile No" required> 
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('new_pass'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input type="password" name="password" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('confirm_pass'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input type="password" name="confirm_password" class="form-control">
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
	</div>
</div>