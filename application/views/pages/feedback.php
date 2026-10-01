<?php
	$empid = isset($user['empid']) ? $user['empid']: '';
	$name = isset($user['name']) ? $user['name']: '';
	$id = isset($user['id']) ? $user['id']: '';
	$deptid = isset($user['deptid']) ? $user['deptid']: '';
	$tryid = isset($user['tryid']) ? $user['tryid']: '';
	$email = isset($user['email']) ? $user['email']: '';
	$mobile = isset($user['mobile']) ? $user['mobile']: '';
?>
<style>
.input-label{line-height:40px;}
</style>
<div class="col-md-2 col-sm-2">
	<div class="left-panel">
  <?php //$this->load->view('layout/left_panel');?>
   </div>
</div>
<div class="col-md-9 col-sm-8">
	<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('feedback'); ?> </div>
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
							<div class="heading"><?php echo $this->lang->line('feedback_title'); ?></div>
							<div class="error" style="color:red; margin-bottom:5px;">
								
							</div>
							<form onsubmit="return check_validation_feed()" action="<?php echo base_url()?>feedback" method="post">
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="input-label"><?php echo $this->lang->line('name'); ?>  <span class="required_star">*</span>:</label>
										<input id="empid" type="hidden" name="empid" class="form-control" value="<?php echo set_value('empid',$empid)?>" readonly />
										<input id="deptid" type="hidden" name="deptid" class="form-control" value="<?php echo set_value('deptid',$deptid)?>" readonly />
										<input id="tryid" type="hidden" name="tryid" class="form-control" value="<?php echo set_value('tryid',$tryid)?>" readonly />
									</div>
									<div class="col-sm-8">
										<input id="name" type="text" name="name" class="form-control" value="<?php echo set_value('name',$name)?>" readonly />
										<span id="name_err" class="error"></span>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="input-label"><?php echo $this->lang->line('mobile_number'); ?>  <span class="required_star">*</span>:</label>
									</div>
									<div class="col-sm-8">
										<input  id="mobile" type="text" name="mobile" class="form-control" value="<?php echo set_value('mobile',$mobile)?>" readonly >
										<span id="mobile_err" class="error"></span>
									</div>
								</div>
                                
                                <div class="form-group row">
									<div class="col-sm-4">
										<label class="input-label"><?php echo $this->lang->line('email'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input id="email" type="text" name="email" class="form-control" value="<?php echo set_value('email',$email)?>" readonly >
									</div>
								</div>
                                
                                 <div class="form-group row">
									<div class="col-sm-4">
										<label class="radio-label"><?php echo $this->lang->line('purpos_visit'); ?>  <span class="required_star">*</span>:</label>
									</div>
									<div class="col-sm-8 feedback-radio">
										<label class="radio-inline"><input type="radio" name="visit_for" data-value="general" value="General" onclick="check_visit()" <?php echo $this->input->post('visit_for') == 'General' ? 'checked': '' ?> ><?php echo $this->lang->line('general'); ?></label>
                                        <label class="radio-inline"><input type="radio" name="visit_for" data-value="administrative" value="Administrative" onclick="check_visit()"  <?php echo $this->input->post('visit_for') == 'Administrative' ? 'checked': '' ?> ><?php echo $this->lang->line('administrative'); ?></label>
                                        <label class="radio-inline"><input type="radio" name="visit_for" data-value="gpf" value="Provident Fund" onclick="check_visit()"  <?php echo $this->input->post('visit_for') == 'Provident Fund' ? 'checked': '' ?> ><?php echo $this->lang->line('providend_fund'); ?></label>
                                        <label class="radio-inline"><input type="radio" name="visit_for" data-value="pension" value="Pension" onclick="check_visit()"  <?php echo $this->input->post('visit_for') == 'Pension' ? 'checked': '' ?> ><?php echo $this->lang->line('pension'); ?></label>
                                        <label class="radio-inline "><input type="radio" name="visit_for" data-value="accounts" value="Accounts" onclick="check_visit()" <?php echo $this->input->post('visit_for') == 'Accounts' ? 'checked': '' ?>  ><?php echo $this->lang->line('accounts'); ?></label>
										<br />
										<span id="visit_for_err" class="error"></span>
									</div>
								</div>
                                
                                <div id="ppo_no_block" class="form-group row visit_for_pension"   <?php echo $this->input->post('visit_for') == 'Pension' ? '': 'style="display:none"' ?>>
									<div class="col-sm-4">
										<label class="input-label"><?php echo $this->lang->line('ppo_no'); ?>/<?php echo $this->lang->line('file_id'); ?>/<?php echo $this->lang->line('application_no'); ?><span class="required_star">*</span></label>
									</div>
									<div class="col-sm-8">
                                        <input  id="ppo_no" type="text" name="ppo_no" value="<?php echo $this->input->post('ppo_no',true)?>" class="form-control">
										<span id="ppo_no_err" class="error"></span>
									</div>
								</div>
                                
                                <div id="gpf_no_block" class="form-group row visit_for_gpf"  <?php echo $this->input->post('visit_for') == 'Provident Fund' ? '': 'style="display:none"' ?> >
									<div class="col-sm-4">
										<label class="input-label"><?php echo $this->lang->line('gpf_ac_no'); ?>  <span class="required_star">*</span>:</label>
									</div>
									<div class="col-sm-8">
<!--                                    <input  id="gpf_no" type="text" name="gpf_no" class="form-control" value="<?php echo $this->input->post('gpf_no',true)?>">		-->
										<input id="gpf_no" type="text" name="gpf_no" class="form-control" value="<?php echo set_value('id',$id)?>" readonly >
										<span id="gpf_no_err" class="error"></span>
									</div>
								</div>
                                
                                <div id="service_block" class="form-group row" style="display:none">
									<div class="col-sm-4">
										<label class="rating-label"><?php echo $this->lang->line('satisfied_service_details'); ?> ? (<?php echo $this->lang->line('please_rate_us'); ?>)</label>
									</div>
									<div class="col-sm-8">
										<div class='rating-widget'>
                                              <div class='rating-stars'>
                                                <ul id='stars' class="stars">
                                                  <li class='star' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                </ul>
												<input type="hidden" class="input_rating" name="service_rating" />
                                              </div> 
                                        </div>
									</div>
								</div>
                                <div id="interact_block" class="form-group row" style="display:none">
									<div class="col-sm-4">
										<label class="radio-label"><?php echo $this->lang->line('interacte_with_office'); ?> ?</label>
									</div>
									<div class="col-sm-8 feedback-radio">
										<label class="radio-inline"><input type="radio" name="is_interected" onclick="check_interected()" value="yes"><?php echo $this->lang->line('yes'); ?></label>
                                        <label class="radio-inline"><input type="radio" name="is_interected" onclick="check_interected()" value="no"><?php echo $this->lang->line('no'); ?></label>
									</div>
								</div>
                                
                                 <div class="form-group row" id="interected_yes" style="display:none">
									<div class="col-sm-4">
										<label  class="rating-label"><?php echo $this->lang->line('mode_interaction'); ?></label>
									</div>
									<div class="col-sm-8 feedback-radio">
                                        <label><?php echo $this->lang->line('rate_exp'); ?></label>	
                                        <div class="row">
                                          <div class="col-sm-5"><label class="checkbox-inline"><input type="checkbox" name="mode_of_interection_email" value="yes"><?php echo $this->lang->line('by_email'); ?></label></div>
                                          <div class="col-sm-7">
                                            <div class='rating-widget'>
                                              <div class='rating-stars'>
                                                <ul id='stars' class="stars">
                                                  <li class='star' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                </ul>
												<input type="hidden" class="input_rating" name="email_rating" />
                                              </div> 
                                        </div>
                                          </div>
                                        </div>	
                                        
                                        <div class="row">
                                          <div class="col-sm-5"><label class="checkbox-inline"><input type="checkbox" name="mode_of_interection_phone" value="yes"><?php echo $this->lang->line('by_telephone'); ?></label></div>
                                          <div class="col-sm-7">
                                            <div class='rating-widget'>
                                              <div class='rating-stars'>
                                                <ul id='stars' class="stars">
                                                  <li class='star' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                </ul>
												<input type="hidden" class="input_rating" name="phone_rating" />
                                              </div> 
                                        </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-5"><label class="checkbox-inline"><input type="checkbox" name="mode_of_interection_direct" value="yes"><?php echo $this->lang->line('direct_visit'); ?></label></div>
                                          <div class="col-sm-7">
                                            <div class='rating-widget'>
                                              <div class='rating-stars'>
                                                <ul id='stars' class="stars">
                                                  <li class='star' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                </ul>
												<input type="hidden" class="input_rating" name="direct_rating" />
                                              </div> 
                                        </div>
                                          </div>
                                        </div>								
									</div>
								</div>
                                <div id="sms_email_receive_block" class="form-group row" style="display:none">
									<div class="col-sm-4">
										<label><?php echo $this->lang->line('receive_sms_email_authorization'); ?> ? <br />(<?php echo $this->lang->line('plase_email_contact'); ?>)</label>
									</div>
									<div class="col-sm-8 feedback-radio">
									  <label class="radio-inline"><input type="radio" class="radio" name="receive_sms_email" value="Yes" ><?php echo $this->lang->line('yes'); ?></label>
                                      <label class="radio-inline"><input type="radio" class="radio" name="receive_sms_email" value="No"><?php echo $this->lang->line('no'); ?></label>	
									</div>
								</div>
                                
                                <div class="form-group row">
									<div class="col-sm-4">
										<label class="rating-label"><?php echo $this->lang->line('how_rate_overall_service'); ?> ?</label>
									</div>
									<div class="col-sm-8">
									  	<div class='rating-widget'>
                                              <div class='rating-stars'>
                                                <ul id='stars' class="stars">
                                                  <li class='star' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                </ul>
												<input type="hidden" class="input_rating" name="overall_rating" />
                                              </div> 
                                        </div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="textbox-label"><?php echo $this->lang->line('comments_suggestion_to_improve'); ?>  <span class="required_star">*</span>:</label>
									</div>
									<div class="col-sm-8">
										<textarea  id="feed" type="text" name="feed" class="form-control" maxlength="250" placeholder="<?php echo $this->lang->line('limit_100_words'); ?>" ><?php echo set_value('feed')?></textarea>
										<span id="feed_err" class="error"></span>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="input-label"><?php echo $this->lang->line('write_image_code'); ?>  <span class="required_star">*</span>:</label>
									</div>
									<div class="col-sm-8"> <?php echo $cap['image'];?>
										<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4"></div>
									<div class="col-sm-8">
										<input id="c_image" type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>"  autocomplete="off" >
										<span id="c_image_err" class="error"></span>
									</div>
								</div>
								<div>
									<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								</div>
								<div class="form-group row">
									<div class="col-sm-4"></div>
									<div class="col-sm-4">
										<input type="button" class="btn btn-warning" Value="<?php echo $this->lang->line('cancel'); ?>" onclick="window.location.href='<?php echo base_url()?>'" />
									</div>
									<div class="col-sm-4">
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

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
function check_visit(){
	var visit_for = $('input[name=visit_for]:checked').val();
	var data_val = $('input[name=visit_for]:checked').attr('data-value');
	if(data_val == 'pension'){
		$('.visit_for_pension').show();
	}else{
		$('.visit_for_pension').hide();
	}
	if(data_val == 'gpf'){
		$('.visit_for_gpf').show();
	}else{
		$('.visit_for_gpf').hide();
	}

	if(data_val == 'pension' || data_val == 'gpf' || data_val == 'accounts'){
		$('.visit_for_office').show();
		$('#service_block').show();
		$('#interact_block').show();
		$('#sms_email_receive_block').show();
		check_interected();
	}else if(data_val == 'general' || data_val == 'administrative'){
		$('#service_block').hide();
		$('#interact_block').hide();
		$('#sms_email_receive_block').hide();
		$('#interected_yes').hide();
	}else{
		$('.visit_for_office').hide();
	}
}
function check_interected(){
	if($('input[name=is_interected]:checked').val() == 'yes'){
		$('#interected_yes').show();
	}else{
		$('#interected_yes').hide();
	}
}
function check_validation_feed(){
	var error = false;
	if($.trim($('#name').val()) == ''){
		$('#name_err').text('<?php echo $this->lang->line('this_field_required'); ?>');
		error = true;
	}else{
		$('#name_err').text('');
	}
	if(!$('input[name=visit_for]').is(':checked') || $('input[name=visit_for]:checked').val() == ''){
		$('#visit_for_err').text('<?php echo $this->lang->line('err_select_purpose_visit'); ?>');
		error = true;
	}else{
		$('#visit_for_err').text('');
		var visit_for = $('input[name=visit_for]:checked').val();
		var data_val = $('input[name=visit_for]:checked').attr('data-value');

		if(data_val == 'pension'){
			if($.trim($('#ppo_no').val()) == ''){
				$('#ppo_no_err').text('<?php echo $this->lang->line('this_field_required'); ?>');
				error = true;
			}else{
				$('#ppo_no_err').text('');
			}
		}else{
			$('#ppo_no_err').text('');
		}
		if(data_val == 'gpf'){
			if($.trim($('#gpf_no').val()) == ''){
				$('#gpf_no_err').text('<?php echo $this->lang->line('this_field_required'); ?>');
				error = true;
			}else{
				$('#gpf_no_err').text('');
			}
		}else{
			$('#gpf_no_err').text('');
		}
	}
	if($.trim($('#feed').val()) == ''){
		$('#feed_err').text('<?php echo $this->lang->line('this_field_required'); ?>');
		error = true;
	}else{
		$('#feed_err').text('');
	}
	if($.trim($('#mobile').val()) == ''){
		$('#mobile_err').text('<?php echo $this->lang->line('this_field_required'); ?>');
		error = true;
	}else{
		$('#mobile_err').text('');
	}
	if($.trim($('#c_image').val()) == ''){
		$('#c_image_err').text('<?php echo $this->lang->line('this_field_required'); ?>');
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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('.stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('.stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    var rating = onStar;
	$(this).parents('.rating-stars').find('.input_rating').val(rating);
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
  });
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
</script>
