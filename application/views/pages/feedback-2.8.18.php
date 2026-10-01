<?php
	$name = isset($user['name']) ? $user['name']: '';
	$id = isset($user['id']) ? $user['id']: '';
	$email = isset($user['email']) ? $user['email']: '';
	$mobile = isset($user['mobile']) ? $user['mobile']: '';
?>
<div class="col-md-3 col-sm-4">
	<div class="left-panel">
  <?php $this->load->view('layout/left_panel');?>
   </div>
</div>
<div class="col-md-9 col-sm-8">
	<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Feedback </div>
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
					<div class="col-sm-12">
						<div class="login">
							<div class="heading">Submit your feedback</div>
							<div class="error" style="color:red; margin-bottom:5px;">
								
							</div>
							<form onsubmit="return check_validation_feed()" method="post">
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Name</label>
									</div>
									<div class="col-sm-8">
										<input id="name" type="text" name="name" class="form-control" value="<?php echo set_value('name',$name)?>" placeholder="" />
										<span id="name_err" class="error"></span>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Email:</label>
									</div>
									<div class="col-sm-8">
										<input id="email" type="text" name="email" class="form-control" value="<?php echo set_value('email',$email)?>" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Mobile:</label>
									</div>
									<div class="col-sm-8">
										<input  id="mobile" type="text" name="mobile" class="form-control" value="<?php echo set_value('mobile',$mobile)?>" placeholder="" >
										<span id="mobile_err" class="error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Category:</label>
									</div>
									<div class="col-sm-8">
										<select id="category" class="form-control"  name="category" onchange="get_related_field()">
											<option value="general">General feedback</option>
											<option value="accounts">Accounts</option>
											<option value="pension">Pension</option>
											<option value="gpf">GPF</option>
											<option value="administrative">Administrative</option>
										</select>
									</div>
								</div>
								<div id="category_gpf_container" class="form-group row" style="display:none">
									<div class="col-sm-4">
										<label>GPF A/c No:</label>
									</div>
									<div class="col-sm-8">
										<input id='category_gpf' type="text" name="gpf_ac_no" class="form-control" value="<?php echo set_value('gpf_ac_no')?>" placeholder="" >
										<span id="category_gpf_err" class="error"></span>
									</div>
								</div>
								<div id="ppo_no_container" class="form-group row" style="display:none">
									<div class="col-sm-4">
										<label>PPO no./File id/Application number:</label>
									</div>
									<div class="col-sm-8">
										<input id='ppo_no' type="text" name="ppo_no" class="form-control" value="<?php echo set_value('ppo_no')?>" placeholder="" >
										<span id="ppo_no_err" class="error"></span>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Feedback details:</label>
									</div>
									<div class="col-sm-8">
										<textarea  id="feed" type="text" name="feed" class="form-control" placeholder="" ><?php echo set_value('feed')?></textarea>
										<span id="feed_err" class="error"></span>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label>Write Image Code:</label>
									</div>
									<div class="col-sm-8"> <?php echo $cap['image'];?>
										<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4"></div>
									<div class="col-sm-8">
										<input id="c_image" type="text" name="c_image" class="form-control" placeholder="Write image code"  autocomplete="off" >
										<span id="c_image_err" class="error"></span>
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
</div>
<script>
function get_related_field(){
	var category = $('#category').val();
	if(category == 'gpf'){
		$('#category_gpf_container').show();
	}else{
		$('#category_gpf_container').hide();
	}
	if(category == 'pension'){
		$('#ppo_no_container').show();
	}else{
		$('#ppo_no_container').hide();
	}
	
}
function check_validation_feed(){
	
	var error = false;
	if($.trim($('#name').val()) == ''){
		$('#name_err').text('This field is required!');
		error = true;
	}else{
		$('#name_err').text('');
	}
	if($('#category').val() == 'gpf'){
		if($.trim($('#category_gpf').val()) == ''){
			$('#category_gpf_err').text('This field is required!');
			error = true;
		}else{
			$('#category_gpf_err').text('');
		}
	}else if($('#category').val() == 'pension'){
		if($.trim($('#ppo_no').val()) == ''){
			$('#ppo_no_err').text('This field is required!');
			error = true;
		}else{
			$('#ppo_no_err').text('');
		}
	}else{
		$('#category_gpf_err').text('');
		$('#ppo_no_err').text('');
	}
	if($.trim($('#feed').val()) == ''){
		$('#feed_err').text('This field is required!');
		error = true;
	}else{
		$('#feed_err').text('');
	}
	if($.trim($('#mobile').val()) == ''){
		$('#mobile_err').text('This field is required!');
		error = true;
	}else{
		$('#mobile_err').text('');
	}
	if($.trim($('#c_image').val()) == ''){
		$('#c_image_err').text('This field is required!');
		error = true;
	}else{
		$('#c_image_err').text('');
	}
	if(!error){
		$('#feedback_form').submit();
		return true;
	}
	return false;
}
</script>