<div class="row">
<style>
</style>
<!--	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">			-->
<div align= "center" >
		<div class="right-panel">
			<div class="breadcrumb" align= "left"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a>  &raquo; <?php echo $this->lang->line('status_for_pension_cases'); ?></div>
			<div>
				<h1 class="title"><?php echo $this->lang->line('status_for_pension_cases'); ?></h1>
				<div class="page-details">
					<h3><?php echo $this->lang->line('search_to_know_cse_status'); ?>:</h3>
					<div class="error" style="color:red; margin-bottom:5px;">
						<?php
						if(isset($error) && !empty($error)){
							echo $error;
						}else if($this->input->post('c_image')){
							if(isset($results) && empty($results[0])){
								echo '<p>Sorry, please check whether all the data you entered is correct or not and re-try.</p>';
							}
						}
						?>
						
					</div>
					<div>
					<form action="<?php echo base_url()?>pension/final_payment_cases" method="post">
						<div class="filter-form">
							<div class="form-group row">
								<div class="col-md-6 col-sm-6">
									<label class="name-label"><?php echo $this->lang->line('enter_application_no'); ?> :</label>
								</div>
								<div class="col-md-6 col-sm-6">
									<input id="" type="number" name="application_no" class="form-control" value="<?php echo $this->input->post('application_no',true)?>" placeholder="9999999999" maxlength = "10" autocomplete="off">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-sm-12">
									<label class="name-label"><?php echo $this->lang->line('or_option'); ?> </label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6 col-sm-6">
									<label class="name-label"><?php echo $this->lang->line('enter_mobile_no'); ?> :</label>
								</div>
								<div class="col-md-6 col-sm-6">
									<input type="number" name="mobile" class="form-control" value="<?php echo $this->input->post('mobile',true)?>" placeholder="9999999999" autocomplete="off" maxlength = "10">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-sm-12">
									<label class="name-label"><?php echo $this->lang->line('or_option'); ?></label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-sm-12">
									<label class="name-label"><?php echo $this->lang->line('enter_your'); ?>.</label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6 col-sm-6">
									<label class="name-label"><?php echo $this->lang->line('first_name'); ?> : <br /> <span style="color:gray; font-size:11px"><?php echo $this->lang->line('first_name_eg'); ?></span></label>
								</div>
								<div class="col-md-6 col-sm-6">
									<input id="inp_name" type="text" name="fname" class="form-control" value="<?php echo $this->input->post('fname',true)?>" onkeypress="allowAlpha(this)" autocomplete="off">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6 col-sm-6">
									<label class="name-label"><?php echo $this->lang->line('date_appointment'); ?> :  <br /> <span style="color:gray; font-size:11px"><?php echo $this->lang->line('date_format'); ?></span></label>
								</div>
								<div class="col-md-6 col-sm-6">
									<input type="text" name="doa" class="datepicker_slash form-control" value="<?php echo $this->input->post('doa',true)?>" placeholder="dd-mm-yyyy"  autocomplete="off">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6 col-sm-6">
									<label class="name-label"><?php echo $this->lang->line('date_birth'); ?> : <br /> <span style="color:gray; font-size:11px"><?php echo $this->lang->line('date_format'); ?></span></label>
								</div>
								<div class="col-md-6 col-sm-6">
									<input  type="text" name="dob" class="datepicker_slash form-control" value="<?php echo $this->input->post('dob',true)?>" placeholder="dd-mm-yyyy"  autocomplete="off">
								</div>
							</div>
							<div>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							</div>
							<div class="form-group row">
								<div class="col-md-6 col-sm-6">
									<label class="name-label"></label>
								</div>
								<div class="col-md-6 col-sm-6">
									<?php echo $cap['image'];?>
									<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
								</div>
								<div class="clearfix"></div>
							</div>
							<br>
							<div class="form-group row">
								<div class="col-md-6 col-sm-6">
								<label class="name-label"></label>
								</div>
								<div class="col-md-6 col-sm-6">
									<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required>
								</div>
								<div class="clearfix"></div>
							</div>
							<br>
							<div class="form-group row">
								<div class="col-md-6 col-sm-6">
								</div>
								<div class="col-md-3 col-sm-6">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('submit'); ?>" />
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
					</form>
				</div>
					<div>
						<span>
							<?php
							if(isset($results) && !empty($results[0])){
								foreach($results as $row){
									$inout_dispatch_artical_no = '';
							?>
							
							<table id="results" border="1" style="width:100%">
									<tbody>
										<tr><td class="col_1">Name:</td><td class="col_2"><?php echo $row['pnsr_name'] ?></td></tr>	
										<tr><td class="col_1">Application No:</td><td class="col_2"><?php echo $row['application_no'] ?></td></tr>			
										<tr><td class="col_1">Your Case File No:</td><td class="col_2"><?php echo $row['file_no'] ?></td></tr>	
										<tr><td class="col_1">Designation:</td><td class="col_2"><?php echo $row['designation'] ?></td></tr>	
										<tr><td class="col_1">Office where last worked:</td><td class="col_2"><?php echo $row['psa_name'] ?></td></tr>	
										<tr><td class="col_1">Status:</td><td class="col_2"><?php echo $row['status_des'] ?></td></tr>	
										<tr><td class="col_1">Treasury for Pension:</td><td class="col_2"><?php echo $row['treasury_pension'] ?></td></tr>	
										<tr><td class="col_1">Treasury for Gratuity Commutation:</td><td class="col_2"><?php echo $row['treasury_gratuity'] ?></td></tr>	
										<?php
										if(strtolower($row['status_des']) == 'pending for clarification'){
											if(!empty($row['dispatched'])){
												foreach($row['dispatched'] as $dispatched){
													if(trim(strtoupper($dispatched['inout_out_type'])) == 'A'){?>
														<tr><td class="col_1">Return memo no:</td><td class="col_2"><?php echo $dispatched['inout_no'] ?></td></tr>
														<tr><td class="col_1">Return memo dispatch no. & date:</td><td class="col_2"><?php echo $dispatched['inout_dispatch_artical_no'] .' - '.get_date($dispatched['inout_dspch_date'])?></td></tr>
											<?php
													}
												}
											}?>
												<tr><td class="col_1">Return Reasons:</td>
												<td class="col_2">
												<ul>
												<?php
												$fl = 0;
												$tot_return = count($row['return']);
												foreach($row['return'] as $return){?>
													<li class="return_reason_li <?php echo ($tot_return - 1 > $fl++) ? 'hide_res': 'show_res' ?>"><?php echo $return['apr_rem'] ?></li>
										<?php 
												}?>
												</ul>
												<?php if(count($row['return']) > 1){
													echo '<span class="show_more"> + Show More</span><span class="show_less"> - Show Less</span>';
												}?>
												</td></tr>
										<?php
										}else if(strtolower($row['status_des']) == 'finalized'){?>
												<tr><td class="col_1">Your PPO No:</td><td class="col_2"><?php echo $row['ppo_no'] != '' ? $row['ppo_no']:'' ?></td></tr>
												<?php
												if(!empty($row['dispatched'])){
													foreach($row['dispatched'] as $dispatched){
														$inout_dispatch_artical_no = $dispatched['f_get_lov_name_inout_dispatch_mode'];
														if(trim(strtoupper($dispatched['inout_out_type'])) == 'X'){?>
															<tr><td class="col_1">PPO dispatch no. & date:</td><td class="col_2"><?php echo $dispatched['inout_dispatch_artical_no'].' - ' .get_date($dispatched['inout_dspch_date']) ?></td></tr>
												<?php
														}
														if(trim(strtoupper($dispatched['inout_out_type'])) == 'A'){?>
															<tr><td class="col_1">PSA dispatch no. & date:</td><td class="col_2"><?php echo $dispatched['inout_dispatch_artical_no'].' - ' .get_date($dispatched['inout_dspch_date'])  ?></td></tr>
												<?php
														}
													}
												}else{?>
													<tr><td class="col_1">PPO dispatch no. & date:</td><td class="col_2">Not yet despatched</td></tr>
													<tr><td class="col_1">PSA dispatch no. & date:</td><td class="col_2">Not yet despatched</td></tr>
											<?php	
												}
										} ?>	
									</tbody>
								</table>
								<?php
								if($inout_dispatch_artical_no != ''){
									if(strtolower($row['status_des']) == 'pending for clarification'){?>
										<p>Please contact the Office from where your Application of Pension was sent to Pr. AG office for re-submission of the case after compliance of the observations of AG office.</p>
									<?php }else if(strtolower($row['status_des']) == 'finalized'){?>
										<p>Please contact the Office from where your Application of Pension was sent to Pr. AG office for getting your Pensionary Benefits.</p>
									<?php } ?>
								<?php
								}
								if(count($results) > 1){
									echo '<br><hr><br>';
								}
							}
						}
							
					?>
					</span>
				</div>
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
/*
function valid(f) {
  !(/^[A-z&#209;&#241;0-9 ]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z&#209;&#241;0-9 ]/ig,''):null;
} 
*/
function allowAlpha(thisInput) {
  thisInput.value = thisInput.value.split(/[^a-zA-Z ]/).join('');
}
function show_all_return(){
 	$('.return_reason_li').each(function(){
		$(this).css('display','block');
	});
 }
window.onload = function() {
    $('#results').scrollTop(0);
}
    // or to execute some function
    //window.onload = myFunction; //notice no parenthesis
</script>