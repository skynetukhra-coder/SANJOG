<div class="row">
	<style>
	label{margin-top:10px;}
	.button_div{max-width:300px;text-align:center; margin:25px auto;}
	</style>
<!--	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">		-->
<div align= "center" >
		<div class="right-panel">
			<div class="breadcrumb" align= "left"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('gpf_status_login'); ?> </div>
			<div class="login-box">
				<div class="row">
						<div class="login">
							<div class="button_div">
								<div class="payment-case green-bg div-anchor"> 
									<a class="click-white" href="<?php //echo base_url()?>ddo/login" style="text-transform:uppercase"><?php //echo $this->lang->line('ddo_login'); ?></a> 
								</div>
							</div>
							<div class="button_div">
								<div class="pension-case dark div-anchor"> 
									<a class="click-white" href="<?php echo base_url()?>subs/login" style="text-transform:uppercase"><?php echo $this->lang->line('subscriber_login'); ?></a> 
								</div>
							</div>							
						</div>
				</div>
			</div>
		</div>
	</div>
<!--
	<div class="col-md-3 col-sm-4 col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php //$this->load->view('layout/left_panel');?>
		</div>
	</div>
-->
</div>