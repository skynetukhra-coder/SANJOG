<style>
	td{padding:5px 0;padding-left:10px; width:50%}
	.col_1{width:150px;}
	.col_3,.col_4{width:50px;text-align:center}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/subscribers_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb">
				<a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Subscriber &raquo;  Login												
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
				<div class="heading">Update Profile:</div>
				<div class="error" style="color:red; margin-bottom:5px;">
					
				</div>
				<br />
				<div class="row">
					<form id="login_form" method="post">
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Subscriber's Name:</label>
									</div>
									<div class="col-sm-8">
										<input id="user_name" type="text" name="user_name" class="form-control" value="<?php echo isset($profile['fst_nme']) ? $profile['fst_nme']: '' ?> <?php echo isset($profile['mid_nme']) ? $profile['mid_nme']: '' ?> <?php echo isset($profile['lst_nme']) ? $profile['lst_nme']: '' ?>" placeholder="Enter name here" readonly>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Date of Birth:</label>
									</div>
									<div class="col-sm-8">
										<input id="dob" type="text" name="dob" class="form-control" value="<?php echo get_datepicker_date(isset($profile['dob']) ? $profile['dob']: '') ?>"  readonly>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>GPF Account No :</label>
									</div>
									<div class="col-sm-8">
										<input id="series" type="text" name="series" class="form-control" value="<?php echo isset($profile['series']) ? $profile['series']: '' ?> / WB / <?php echo isset($profile['ac_code']) ? $profile['ac_code']: '' ?>"  readonly> 
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Mobile No:</label>
									</div>
									<div class="col-sm-8">
										<input id="mobile_no" type="text" name="mobile_no" class="form-control" value="<?php echo isset($profile['mobile_no']) ? $profile['mobile_no']: '' ?>" readonly> 
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Present DDO :</label>
									</div>
									<div class="col-sm-8">
										<input id="cur_ddo" type="text" name="cur_ddo" class="form-control" value="<?php echo isset($profile['cur_ddo']) ? $profile['cur_ddo']: '' ?>"  readonly> 
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Email:</label>
									</div>
									<div class="col-sm-8">
										<input id="email_id" type="text" name="email_id" class="form-control" value="<?php echo isset($profile['email_id']) ? $profile['email_id']: '' ?>" placeholder="Send your Email ID to update" readonly>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Employee ID:</label>
									</div>
									<div class="col-sm-8">
										<input id="emp_code" type="text" name="emp_code" class="form-control" value="<?php echo isset($profile['emp_code']) ? $profile['emp_code']: '' ?>" placeholder="Send your IFMS ID to update" readonly>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>New Password:</label>
									</div>
									<div class="col-sm-8">
										<input type="password" name="password" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Confirm Password:</label>
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
										<input type="submit" class="btn btn-primary" Value="Submit" />
									</div>
								</div>
							</form>
				</div>
			</div>
		</div>
	</div>
</div>