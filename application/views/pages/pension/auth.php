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
<!--	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">		-->
<div align= "center" >
		<div class="right-panel">
			<div class="breadcrumb" align= "left"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Pension &raquo; Pensioner Copy Download</div>
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
			<div>
				<h1 class="title"><?php echo $this->lang->line('authentication'); ?></h1>
				<div class="page-details">
					<div class="error" style="color:red; margin-bottom:5px;">
						
					</div>
					<form method="post">
						<div class="filter-form">
							<div class="form-group row">
								<div class="col-md-4 col-sm-6">
									<label class="name-label"><?php echo $this->lang->line('enter_application_no'); ?>:</label>
								</div>
								<div class="col-md-4 col-sm-6">
									<input id="gpf_ac_no" type="text" name="application_no" class="form-control" value="<?php echo $this->input->post('application_no',true)?>" placeholder="9999999999" autocomplete="off">
								</div>
							</div>
							<div>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							</div>
							<br />
							<div class="form-group row">
								<div class="col-md-4 col-sm-6">
									<label class="name-label"></label>
								</div>
								<div class="col-md-4 col-sm-6">
									<?php echo $cap['image'];?>
									<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group row">
								<div class="col-md-4 col-sm-6">
								<label class="name-label"><?php echo $this->lang->line('write_image_code'); ?>:</label>
								</div>
								<div class="col-md-4 col-sm-6">
									<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required>
								</div>
								<div class="clearfix"></div>
							</div>
							<br>
							<div class="form-group row">
								<div class="col-md-4 col-sm-6">
								</div>
								<div class="col-md-4 col-sm-6">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('submit'); ?>" />
								</div>
								<div class="clearfix"></div>
							</div>
							<?php /*?><br />
							<p><b><u>Note:</u></b> Please submit your <strong>"Email and Mobile"</strong> to <a href="mailto:edppen-agae-wb@nic.in">edppen-agae-wb@nic.in</a>. Please ignore if you already submited.</p><?php */?>
							<div class="clearfix"></div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
<!--
	<div class="col-md-3 col-sm-4  col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php //$this->load->view('layout/left_panel');?>
		</div>
	</div>
-->
</div>
<script>
function show_all_return(){
 	$('.return_reason_li').each(function(){
		$(this).css('display','block');
	});
 }
</script>