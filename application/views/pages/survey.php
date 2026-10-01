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
			<div class="breadcrumb"><?php echo $this->lang->line('feedback'); ?> </div>
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
							<form onsubmit="return check_validation_feed()" method="post">
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="input-label"><?php echo $this->lang->line('name'); ?>  <span class="required_star">*</span>:</label>
									</div>
									<div class="col-sm-8">
										<input id="name" type="text" name="name" class="form-control" value="<?php echo set_value('name')?>" placeholder=""/>
										<span id="name_err" class="error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="input-label"><?php echo $this->lang->line('mobile_number'); ?>  <span class="required_star">*</span>:</label>
									</div>
									<div class="col-sm-8">
										<input  id="mobile" type="text" name="mobile" class="form-control" value="<?php echo set_value('mobile')?>" placeholder="" >
										<span id="mobile_err" class="error"></span>
									</div>
								</div>
                                
                                <div class="form-group row">
									<div class="col-sm-4">
										<label class="input-label"><?php echo $this->lang->line('email'); ?>:</label>
									</div>
									<div class="col-sm-8">
										<input id="email" type="text" name="email" class="form-control" value="<?php echo set_value('email')?>" placeholder="">
									</div>
								</div>
                                
                                <div class="form-group row">
									<div class="col-sm-4">
										<label class="select-label"><?php echo $this->lang->line('office'); ?></label>
									</div>
									<div class="col-sm-8">
                                        <label class="radio-inline"><input type="radio" name="office" <?php echo $this->input->post('visit_for') == 'Pr. AG (A&amp;E)' ? 'checked': '' ?> value="Pr. AG (A&amp;E)" ><?php echo $this->lang->line('agae'); ?></label>
                                        <label class="radio-inline"><input type="radio" name="office" <?php echo $this->input->post('visit_for') == 'Pr. AG (G&amp;SSA)' ? 'checked': '' ?> value="Pr. AG (G&amp;SSA)" ><?php echo $this->lang->line('pr_ag_ssa'); ?></label>
                                        <label class="radio-inline"><input type="radio" name="office"  <?php echo $this->input->post('visit_for') == 'AG (E&amp;RSA)' ? 'checked': '' ?> value="AG (E&amp;RSA)" ><?php echo $this->lang->line('age_rsa'); ?></label>
										<br />
										<span id="office_err" class="error"></span>
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
										<textarea  id="feed" type="text" name="feed" class="form-control" maxlength="100" placeholder="<?php echo $this->lang->line('limit_100_words'); ?>" ><?php echo set_value('feed')?></textarea>
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
										<input type="reset" class="btn btn-warning" Value="<?php echo $this->lang->line('cancel'); ?>" onclick="window.location.href='<?php echo base_url()?>'"/>
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
<script>
function check_validation_feed(){
	var error = false;
	if($.trim($('#name').val()) == ''){
		$('#name_err').text('<?php echo $this->lang->line('this_field_required'); ?>');
		error = true;
	}else{
		$('#name_err').text('');
	}
	if($.trim($('#feed').val()) == ''){
		$('#feed_err').text('<?php echo $this->lang->line('this_field_required'); ?>');
		error = true;
	}else{
		$('#feed_err').text('');
	}
	if($('input[name=office]').is(':checked')){
		$('#office_err').text('');
	}else{
		$('#office_err').text('<?php echo $this->lang->line('this_field_required'); ?>');
		error = true;
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

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
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
