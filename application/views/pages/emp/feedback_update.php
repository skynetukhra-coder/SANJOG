<?php
$feed_id = isset($row['feed_id']) ? $row['feed_id'] : '';
$visit_for = isset($row['visit_for']) ? $row['visit_for'] : '';
$gpf_no = isset($row['gpf_no']) ? $row['gpf_no'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$overall_service_rating = isset($row['overall_service_rating']) ? $row['overall_service_rating'] : '';
$details = isset($row['details']) ? $row['details'] : '';
$administration = isset($row['administration']) ? $row['administration'] : '';
$administration_action_required = isset($row['administration_action_required']) ? $row['administration_action_required'] : '';
$administration_action_taken = isset($row['administration_action_taken']) ? $row['administration_action_taken'] : '';
$accounts = isset($row['accounts']) ? $row['accounts'] : '';
$accounts_action_required = isset($row['accounts_action_required']) ? $row['accounts_action_required'] : '';
$accounts_action_taken = isset($row['accounts_action_taken']) ? $row['accounts_action_taken'] : '';
$fund = isset($row['fund']) ? $row['fund'] : '';
$fund_action_required = isset($row['fund_action_required']) ? $row['fund_action_required'] : '';
$fund_action_taken = isset($row['fund_action_taken']) ? $row['fund_action_taken'] : '';
$pension = isset($row['pension']) ? $row['pension'] : '';
$pension_action_required = isset($row['pension_action_required']) ? $row['pension_action_required'] : '';
$pension_action_taken = isset($row['pension_action_taken']) ? $row['pension_action_taken'] : '';
$status = isset($row['status']) ? $row['status'] : '';
?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_application'); ?> </div>
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
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" align=center>FEEDBACK MONITORING</span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Name<span class="star">*</span></label>
										<input name="" type="text" value="<?php echo $row['name'] ?>" class="form-control" readonly>
									</div>
									<div class="col-md-8 col-sm-6">
										<label class="name">Mobile No / Email ID<span class="star">*</span></label>
										<input name="" type="text" value="<?php echo $row['mobile'] ?> / <?php echo $row['email'] ?>"  class="form-control"  readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">GPF Ac No / Pension Case ID<span class="star">*</span></label>
										<input name="" type="text" value="<?php echo $row['gpf_no'] ?><?php echo $row['ppo_no_file_id_application_no'] ?>"  class="form-control"  readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Visit For<span class="star">*</span></label>
										<input name="" type="text" value="<?php echo $row['visit_for'] ?>" class="form-control"  readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Description</label>
										<textarea id="" type = "text" name="" align="center" rows="3" cols="115" readonly ><?php echo $row['details'] ?></textarea >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Administration <span class="star"></span></label>
										<input align = "left" name="administration" value = "Yes" type="checkbox" class="form-control"  readonly>
									</div>
									<div class="col-md-8 col-sm-6 name-mrgbtm">
										<label class="name">Action To be taken by Administration<span class="star"></span></label>
										<textarea id="administration_action_required" type = "text" name="administration_action_required" align="center" rows="3" cols="75" ><?php echo $row['administration_action_required'] ?></textarea >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Action Taken by Administration</label>
										<textarea id="administration_action_taken" type = "text" name="administration_action_taken" align="center" rows="3" cols="115" ><?php echo $row['administration_action_taken'] ?></textarea >
									</div>
								</div>
							</div>		
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Accounts <span class="star"></span></label>
										<input align = "left" name="accounts" value = "Yes" type="checkbox" class="form-control"  readonly>
									</div>
									<div class="col-md-8 col-sm-6 name-mrgbtm">
										<label class="name">Action To be taken by Accounts<span class="star"></span></label>
										<textarea id="accounts_action_required" type = "text" name="accounts_action_required" align="center" rows="3" cols="75" ><?php echo $row['accounts_action_required'] ?></textarea >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Action Taken by Accounts</label>
										<textarea id="accounts_action_taken" type = "text" name="accounts_action_taken" align="center" rows="3" cols="115" ><?php echo $row['accounts_action_taken'] ?></textarea >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Fund <span class="star"></span></label>
										<input align = "left" name="fund" value = "Yes" type="checkbox" class="form-control"  readonly>
									</div>
									<div class="col-md-8 col-sm-6 name-mrgbtm">
										<label class="name">Action To be taken by Fund<span class="star"></span></label>
										<textarea id="fund_action_required" type = "text" name="fund_action_required" align="center" rows="3" cols="75" ><?php echo $row['fund_action_required'] ?></textarea >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Action Taken by Fund</label>
										<textarea id="fund_action_taken" type = "text" name="fund_action_taken" align="center" rows="3" cols="115" ><?php echo $row['fund_action_taken'] ?></textarea >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Pension <span class="star"></span></label>
										<input align = "left" name="pension" value = "Yes" type="checkbox" class="form-control"  readonly>
									</div>
									<div class="col-md-8 col-sm-6 name-mrgbtm">
										<label class="name">Action To be taken by Pension<span class="star"></span></label>
										<textarea id="pension_action_required" type = "text" name="pension_action_required" align="center" rows="3" cols="75" ><?php echo $row['pension_action_required'] ?></textarea >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Action Taken by Pension</label>
										<textarea id="pension_action_taken" type = "text" name="pension_action_taken" align="center" rows="3" cols="115" ><?php echo $row['pension_action_taken'] ?></textarea >
									</div>
								</div>
							</div>		
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Feedback Status<span class="star">*</span></label>
										<select id="status" name="status" class="form-control" required >
											<option data-value="0" value="">--Select--</option>
											<option data-value="1" value="Process"> Process </option>	
											<option data-value="2" value="Close"> Close </option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12 apl-mrgbtm">
										<label class="name"></label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Name</label>
											</div>
											<div class="col-sm-10  col-xs-6">
												<input name="dag_name" type="text" value="<?php echo $profile['empname'] ?>" class="form-control"  readonly>											
											</div>
										</div>			
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name"></label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-5  col-xs-4">
												<input name="dag_desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">DATE</label>
											</div>
											<div class="col-sm-3  col-xs-4">
												<input name="dag_dt" type="text" value="<?php echo date("d-m-Y"); ?>" class="form-control"  readonly>
											</div>								
										</div>			
									</div>
								</div>
							</div> 
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6">
										<strong>Place: Kolkata </strong>
										<input id="decl_place" name="decl_place" type="hidden" value="Kolkata" />
									</div>
									<div class="col-sm-6">
										<strong>Date: <?php echo  date("d-m-Y");?> </strong>
										<input id="decl_date" name="decl_date" type="hidden" value="<?php echo  date("d-m-Y");?>" />
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-md-6 col-sm-7 col-xs-7">
										<div class="form-group"> 
											<?php echo $cap['image'];?>
											<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
										</div>
									</div>
									<div class="col-md-6 col-sm-5 col-xs-5">
										<div class="form-group">
											<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
										</div>
									</div>
								</div>
							</div>
							
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit"  />
										</div>
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
