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
							<label class="name" align="center"><font color="#1E0BA9"><b>LOAN  APPLICATIN  FORM</b></font></span></label>
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
									<div class="col-md-8 col-sm-6">
										<label class="name">Full Name (as per Service Book)<span class="star">*</span></label>
										<input name="name" type="text" value="<?php echo $profile['empname'] ?>"  class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee PAN<span class="star">*</span></label>
										<input name="empid" type="text" value="<?php echo $profile['empid'] ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name<span class="star">*</span></label>
										<input name="office_nm" type="text" value="<?php echo $profile['office'] ?>"  class="form-control" required readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input name="desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control" required readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input name="basic_pay" type="text"  value="<?php echo $profile['basic_pay'] ?>" class="form-control" required readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input name="emp_section"  type="text" value="<?php echo $profile['section'] ?>" class="form-control" required readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<select name="group_nm" class="form-control">
													<option value="">Select</option>
													<option>Administration</option>
													<option>Accounts</option>
													<option>Fund</option>
													<option>Pension</option>
													<option>Divisional Accountant</option>
												</select>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input name="phone_office" type="text" value="<?php echo $profile['mbno'] ?>" class="form-control" required readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Purpose of loan<span class="star"></span></label>
										<input name="description" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Interest Type <span class="star"></span></label>
												<select name="interest_type" class="form-control" >
												<option value=""> -- Select loan type--</option>
												<option data-value="1" value="Interest Bearing" <?php echo $this->input->get('year') == 'Interest Bearing' ? 'selected' : ''?> >Interest Bearing</option>
												<option data-value="2" value="Non-Interest Bearing" <?php echo $this->input->get('year') == 'Non-Interest Bearing' ? 'selected' : ''?> >Non-Interest Bearing</option>
										</Select>									
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<div>
											<label class="name">Loan Type</label>
											<select name="loan_type" class="form-control" >
												<option value=""> -- Select loan type--</option>
												<option data-value="1" value="GPF Advance" <?php echo $this->input->get('year') == 'GPF Advance' ? 'selected' : ''?> >GPF Advance</option>
												<option data-value="2" value="GPF Withdrawal" <?php echo $this->input->get('year') == 'GPF Withdrawal' ? 'selected' : ''?> >GPF Withdrawal</option>
												<option data-value="3" value="Computer Advance"<?php echo $this->input->get('year') == 'Computer Advance' ? 'selected' : ''?> >Computer Advance</option>
												<option data-value="4" value="House Building Advance"<?php echo $this->input->get('year') == 'House Building Advance' ? 'selected' : ''?> >House Building Advance</option>
											</Select>
										</div>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name1 text-right">Loan Amount</label>
												<input name="loan_amount" type="text" class="form-control" required>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name1 text-right">Installment No</label>
												<input name="installment_no" type="text" class="form-control" >
											</div>								
										</div>			
									</div>
								</div>
							</div>							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<div>
											<label class="name">Sanction Order No</label>
											<input name="loan_order_no" type="text" class="form-control " >
										</div>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name1 text-right">Order Date</label>
												<input name="order_date" type="text" class="form-control datepicker" >
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">	
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name1 text-right">Bill No</label>
												<input name="bill_no" type="text" class="form-control" >
											</div>								
										</div>			
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
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit"  />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
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
