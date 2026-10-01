<style>
.center-div {
  margin: auto;
  width: 100%;
  text-align: center;
  padding-left: 5px;
}
</style>

<div class="row" >
	<div class="col-md-1 col-sm-1">
		<div class="left-panel">
			&nbsp;
		</div>
	</div>
	<div class="col-md-10 col-sm-10">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('pension'); ?> &raquo; <?php echo $this->lang->line('application'); ?>application </div>
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
			<div class="login-box" >
				<div class="application-formwrap">
					<form id="info_form" method="post" enctype="multipart/form-data" class="form-horizontal" >
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading light" style="text-align:center;color: white; "> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata - 700 001</div>
							</div>
							<div>&nbsp;</div>
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> Submission of Document for Pension Payment</div>
							</div>
						<div class=" col-sm-10 btn-wrap">&nbsp;</div>
						<div class="center-div"  >
							<div>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">Name (as per PPO) <span class="star">* :</span></label>
										<input name="full_name" value="" type="text" class="form-control" required >
									</div>
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">PPO No <span class="star">* :</span></label>
										<input name="ppo_no" value="" type="text" class="form-control" required >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">Mobile No <span class="star">* :</span></label>
										<input name="mobile" value="" type="text" class="form-control" required >
									</div>
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">Email <span class="star"> :</span></label>
										<input name="email_id" value="" type="text" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">Pension Year <span class="star">* :</span></label>
										<select name="pen_year" class="form-control" required>
										<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
										<?php
										for($i = date('Y'); $i >= date('Y')-1; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('pen_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
									</select>
									</div>
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">Pension Month <span class="star">* :</span></label>
										<select name="pen_month" class="form-control" required>
											<option value="">---Select---</option>
											<option>January</option>
											<option>February</option>
											<option>March</option>
											<option>April</option>
											<option>May</option>
											<option>June</option>
											<option>July</option>
											<option>August</option>
											<option>September</option>
											<option>October</option>
											<option>November</option>
											<option>December</option>		
										</select>					
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">Date <span class="star"></span></label>
										<input name="appl_dt" value="<?php echo  date("d-m-Y") ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">Upload signed Document * :</b></br><span style = "font-size: 13px; weight;bold; color: red">(pdf or jpg or png format only.)</span><span class="star"></span></label>
										<input id="attachment" type="file" name="attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none" required />
										<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"></span>
									</div>
								</div>
							</div>
							<div class=" col-sm-10 btn-wrap">&nbsp;</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-5 col-sm-6">
										<?php echo $cap['image'];?>
											<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
									</div>
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
									</div>
								</div>
							</div>
							<div class=" col-sm-10 btn-wrap">&nbsp;</div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-5 col-xs-8">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
										</div>
										<div class="col-sm-5 col-xs-8">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit"  />
										</div>
									</div>
								</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
function previewImage(file_obj,container_id){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if(ext == 'pdf' || ext == 'jpg' || ext == 'jpeg' || ext == 'png'){
      $('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
    }else{
      $('#attachment').val(''); 
      $('#'+container_id).html('');      
      alert('file type not supported! Supported file types are .jpg, .jpeg ,.png');
    }
	}
}
function previewMultipleImage(file_obj,container_id){
   if (file_obj.files && file_obj.files[0]) {
    for(var i = 0; i< file_obj.files.length; i++){
      var url = file_obj.files[i].name;
      var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();      
      if(ext == 'pdf' || ext == 'jpg' || ext == 'jpeg' || ext == 'png' ){
        $('#'+container_id).append('<br/><em>&nbsp;&nbsp;' + url + '</em>');
      }else{
        $('#attachment').val('');
        $('#'+container_id).html('');      
        alert('file type not supported! Supported file types are : .jpg,.jpeg,.png');
        break;
      }

    }   
  }
}
function browse(){
	$('#attachment').click();
}
</script>