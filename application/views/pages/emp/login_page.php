<div class="row">
	<style>
	label{margin-top:10px;}
	.button_div{max-width:300px;text-align:center; margin:25px auto;}
	</style>
<!-- <div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">		-->
	<div align= "center" >
		<div class="right-panel">
			<div class="breadcrumb" align= "left"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('sanjog'); ?> </div>
			<div class="login-box">
<!--			
				<div class="row light-green-bg" style="font-size:24px; font-weight:bold; font-family:arial;letter-spacing:2.5px;">
					<span>SANJOG</span><span>&nbsp&nbsp::&nbsp&nbsp संयोग </span>&nbsp&nbsp::&nbsp&nbsp<span>সংযোগ</span>
				</div>
-->
				<div style="width:350px; height:180px;">
				<img  width="100%" height="180" src="<?php echo base_url()?>assets/images/sanjog3.png" alt="not_loaded.png">
			</div>	

				<div class="row">
						<div class="login">
							<div class="button_div">
								<a class="click-white" href="<?php echo base_url()?>emp/login">
									<div class="payment-case dark div-anchor"> 
										<?php echo $this->lang->line('department_logi'); ?> A & E Employee Login
									</div>
								</a> 
							</div>
							<div class="button_div">
								<a class="click-white" href="<?php echo base_url()?>emp_dacadre/login"> 
									<div class="pension-case saffron-bg  div-anchor"> 
										<?php echo $this->lang->line('treasury_logi'); ?> DA Cadre Employee Login
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