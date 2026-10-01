<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Employee &raquo; My Application </div>
			<div class="login-box">
				<div class="application-formwrap">
					<div class="row">
						<div class="col-sm-12">
							<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
								Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
						</div>
						<div class="col-sm-12">
							<div class="top-box">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="name">Select Examination Name*</label>
											<select class="form-control">
												<option selected="selected">Select Month</option>
												<option>Incentive Examination for Sr.AO/AO/AAO)</option>
												<option>Continuous Professional Development (CPD)-I Examination</option>
												<option>Continuous Professional Development (CPD)-II Examination</option>
												<option>Preliminary Examination for appearing SAS Examination</option>
												<option>Incentive Examination for Sr. Accountant</option>
												<option>Departmental Examination for Accountant</option>
												<option>Departmental Examination for MTS for promotion to Clerks</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="name">Select Month</label>
											<select class="form-control">
												<option selected="selected">Select Month</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="name">Select Year</label>
											<select class="form-control">
												<option selected="selected">Select Year</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Employee ID</label>
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Full Name (as per Service Book)</label>
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Designation</label>
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Date of Appointment in this Office</label>
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Basic Pay</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Section Name</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Group Name</label>
								<select class="form-control">
									<option selected="selected">Select</option>
									<option>Administration</option>
									<option>Accounts</option>
									<option>Fund</option>
									<option>Pension</option>
									<option>Divisional Accountant</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Office Phone Number</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Fathers Name</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Date of Birth</label>
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Gender</label>
								<select class="form-control">
									<option selected="selected">Select</option>
									<option>Male</option>
									<option>Female</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Educational Qualification</label>
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Community (UR/OBC/SC/ST)</label>
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Gradation List Serial No </label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Gradation List Page  No</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Year of Passing SOG/SAS Examination OR Accountant Examination OR Departmental Competitive Examination for MTS</label>
								<div class="row">
									<div class="col-sm-6">
										<select class="form-control">
											<option selected="selected">Select Month</option>
										</select>
									</div>
									<div class="col-sm-6">
										<select class="form-control">
											<option selected="selected">Select Year</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Index No of SOG/SAS Examination (Passed on after 2001)</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Present Post of the Employee</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Present Post of the Employee</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Date of Appointment in present post</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
                              <div class="col-sm-6">
								<label class="name">Length of Service in the present post</label>
								<div class="row">
									<div class="col-sm-6">
										<input type="text" class="form-control">
									</div>
									<div class="col-sm-1">
										<label class="name1">As on</label>
									</div>
									<div class="col-sm-5">
										<input type="text" class="form-control">
									</div>
								</div>
                                </div>
                                
                                <div class="col-sm-6">
								  <label class="name">Break in Service, if any</label>
								  <input type="text" class="form-control">
						       </div>
							</div>
						    </div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Period of Break in Service</label>
								<div class="row">
									<div class="col-sm-1">
										<label class="name1">From</label>
									</div>
									<div class="col-sm-5">
										<input type="text" class="form-control">
									</div>
									<div class="col-sm-1">
										<label class="name1 text-right">To</label>
									</div>
									<div class="col-sm-5">
										<input type="text" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Whether already appeared in the said examination? (Details of appearances in Type Test for Clerk)</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<table width="100%" border="1" bordercolor="#7399be" class="tbl">
								<thead>
									<tr>
										<td>Year & Month</td>
										<td>Index No</td>
										<td>Centre of Examination</td>
										<td>Exemption secured , if any</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="text" class="form-control"></td>
										<td><input type="text" class="form-control"></td>
										<td><input type="text" class="form-control"></td>
										<td><input type="text" class="form-control"></td>
									</tr>
									<tr>
										<td><input type="text" class="form-control"></td>
										<td><input type="text" class="form-control"></td>
										<td><input type="text" class="form-control"></td>
										<td><input type="text" class="form-control"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Full Residential Address</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">E-mail ID</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Mobile No</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Whether the Examination will be given in English or Hindi</label>
								<label class="radio-inline">
								<input type="radio" name="optradio">
								English</label>
								<label class="radio-inline">
								<input type="radio" name="optradio">
								Hindi</label>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Mention papers intended to be appeared in Hindi.</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Whether Office training has been completed?</label>
								<label class="radio-inline">
								<input type="radio" name="optradio">
								Yes</label>
								<label class="radio-inline">
								<input type="radio" name="optradio">
								No</label>
								<label class="radio-inline">
								<input type="radio" name="optradio">
								Not Applicable</label>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Whether completed Pre-examination Computer Training (Theo. & Prac)?</label>
								<label class="radio-inline">
								<input type="radio" name="optradio">
								Yes</label>
								<label class="radio-inline">
								<input type="radio" name="optradio">
								No</label>
								<label class="radio-inline">
								<input type="radio" name="optradio">
								Not Applicable</label>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Location  of Training </label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Period of Training </label>
								<div class="row">
									<div class="col-sm-1">
										<label class="name1">From</label>
									</div>
									<div class="col-sm-5">
										<input type="text" class="form-control">
									</div>
									<div class="col-sm-1">
										<label class="name1 text-center">To</label>
									</div>
									<div class="col-sm-5">
										<input type="text" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="name">Date of Application</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="btn-wrap">
								<div class="row">
									<div class="col-sm-6">
										<input type="submit" class="btn btn-primary" value="Submit" />
									</div>
									<div class="col-sm-6">
										<input type="submit" class="btn btn-primary" value="Reset" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
