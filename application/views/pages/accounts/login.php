<div class="row">
	<style>
	label{margin-top:10px;}
	.button_div{max-width:300px;text-align:center; margin:25px auto;}
	</style>
<!--	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">	-->
	<div align= "center" >
		<div class="right-panel">
			<div class="breadcrumb" align= "left"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('user_login'); ?> </div>
			<div class="login-box">
				<div class="row">
						<div class="login">
							<div class="button_div">
								<a class="click-white" href="<?php echo base_url()?>department/login">
									<div class="payment-case saffron-bg div-anchor"> 
										<?php echo $this->lang->line('department_login'); ?>
									</div>
								</a> 
							</div>
							<div class="button_div">
								<a class="click-white" href="<?php echo base_url()?>treasury/login">
									<div class="pension-case dark div-anchor"> 
										<?php echo $this->lang->line('treasury_login'); ?>
									</div>
								</a> 
							</div>
							<div class="button_div">
								<a class="click-white" href="<?php //echo base_url()?>ddo/login">
									<div class="pension-case green-bg div-anchor"> 
										<?php //echo $this->lang->line('ddo_login'); ?>
									</div>
								</a> 
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