<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; AMC Service</div>
			
			<div class="login-box">
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
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="top-box">
									<div class="row">
										<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>Complaint Details</b></font></span></label>
									</div>								
								</div>
							</div>
							
							<div class="col-sm-12">
								<table class="table1" border="1" style="width:100%">
									<thead>
										<tr style="text-align:center">
											<th style="text-align:center; width:30%;"><strong>Description</strong></th>
											<th style="text-align:center; width:70%;"><strong>Information</strong></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="col_1">COMPLAINT SL NUMBER*</td>
											<td class="col_2"><input type="text" id="yr_sl_no" name="yr_sl_no" value="" class="form-control" placeholder = "Register Serial Number" ></td>
										</tr>
										<tr>
											<td class="col_1">AMC  YEAR</td>
											<td class="col_2">
											   <select  id="amc_yr" name="amc_yr" class="form-control" >
													<option value="">--- Select Year ---</option>
													<?php
														if(isset($amc_yr)){
															foreach($amc_yr as $amc_yr){
																echo '<option value="'.$amc_yr['fin_year'].'">'.$amc_yr['fin_year'].'</option>';
															}
														}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">ITEM SERIAL NO</td>
											<td class="col_2"><input type="text" id="item" name="item" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">BRAND NAME</td>
											<td class="col_2"><input type="text" id="brand" name="brand" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">DETAILED  DESCRIPTION</td>
											<td class="col_2"><input type="text" id="descp" name="descp" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">NAME OF SECTION</td>
											<td class="col_2">
												<select id="section" name="section" class = "form-control" >
													<option value="">--Select--</option>
													<?php
													if(isset($section_list) && !empty($section_list)){
														foreach($section_list as $sections){
															echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">MACHINE NO</td>
											<td class="col_2"><input type="text" id="mach_no" name="mach_no" value="" class="form-control" ></td>
										</tr>
										
										<tr>
											<td class="col_1">REMARKS</td>
											<td class="col_2"><input type="text" id="remk" name="remk" value="" class="form-control" ></td>
										</tr>
								</table>
							</div>
							<div>&nbsp;	</div>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="myCanl();" value="Cancel" />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit" />
										</div>
									</div>
								</div>
							</div>
							<?php 
							if(isset($application) && !empty($application)){?>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6"> <strong>** Date: <?php //echo get_datepicker_date($application['applied_on']);?></strong> </div>
									</div>
								</div>
							</div>
							<?php
							}?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
function show_hide_submit(){
	if($('#i_agree').is(':checked')){
		$('#submit_btn').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}

function myCanl() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_ser/';
}
function warningApp(){
	
	alert("NOTICE:-\n\n** Add members of the your family as recorded in Service Book. ");
				
}
</script>