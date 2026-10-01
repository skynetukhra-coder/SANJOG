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
							<label class="name" align="center"><font color="#1E0BA9"><b>LEAVE ENCASHMENT  APPLICATIN  FORM</b></font></span></label>
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
										<label class="name"> Description of leave encashment<span class="star"></span></label>
										<input name="description" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">LTC or HTC <span class="star"></span></label>
												<select name="ltc_htc" class="form-control" >
												<option value=""> -- Select loan type--</option>
												<option data-value="1" value="LTC" <?php echo $this->input->get('year') == 'Interest Bearing' ? 'selected' : ''?> >LTC</option>
												<option data-value="2" value="HTC" <?php echo $this->input->get('year') == 'Non-Interest Bearing' ? 'selected' : ''?> >HTC</option>
										</Select>									
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">No of Encashment<span class="star"></span></label>
												<input name="encashment_no" type="text" class="form-control " >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Leave </label>
												<input name="leave_type" type="text" value="Earned Leave"class="form-control" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
											<label class="name">From </label>
												<input name="from_date" type="text" class="form-control datepicker" required>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">To</label>
												<input name="to_date" type="text" class="form-control datepicker"  required>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Leave taken for(Days)<span class="star"></span></label>
												<input name="leave_for" type="text" class="form-control " >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Leave at Credit(Days)</label>
												<input name="el_credit" type="text" class="form-control " >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
											<label class="name">Encashment for(Days) </label>
												<input name="no_days_encash" type="text" class="form-control " >
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Application Date</label>
												<input name="application_dt" type="text" value="" class="form-control datepicker" >
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Sanction Order No<span class="star"></span></label>
												<input name="encash_order_no" type="text" class="form-control " >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Order Date</label>
												<input name="encash_order_date" type="text" class="form-control datepicker" >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
											<label class="name">DA Rate</label>
												<input name="da_rate" type="text" class="form-control " >
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Bill No</label>
												<input name="bill_no" type="text" class="form-control" >
												<input name="status" type="hidden" value="Pending" class="form-control" >
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
