<?php
$leav_id = isset($leaves['leav_id']) ? $leaves['leav_id'] : '';
$empid = isset($leaves['empid']) ? $leaves['empid'] : '';
$name = isset($leaves['name']) ? $leaves['name'] : '';
$desig = isset($leaves['desig']) ? $leaves['desig'] : '';
$leave_basic_pay = isset($leaves['leave_basic_pay']) ? $leaves['leave_basic_pay'] : '';
$section = isset($leaves['section']) ? $leaves['section'] : '';
$group_nm = isset($leaves['group_nm']) ? $leaves['group_nm'] : '';
$office_nm = isset($leaves['office_nm']) ? $leaves['office_nm'] : '';
$leave_type = isset($leaves['leave_type']) ? $leaves['leave_type'] : '';
$leave_from = isset($leaves['leave_from']) ? $leaves['leave_from'] : '';
$leave_to = isset($leaves['leave_to']) ? $leaves['leave_to'] : '';
$leave_day_no = isset($leaves['leave_day_no']) ? $leaves['leave_day_no'] : '';
$balance_leave = isset($leaves['balance_leave']) ? $leaves['balance_leave'] : '';
$ground = isset($leaves['ground']) ? $leaves['ground'] : '';
$admissibility = isset($leaves['admissibility']) ? $leaves['admissibility'] : '';
$joining_dt = isset($leaves['joining_dt']) ? $leaves['joining_dt'] : '';
$leave_address = isset($leaves['leave_address']) ? $leaves['leave_address'] : '';
$block = isset($leaves['block']) ? $leaves['block'] : '';
$application_dt = isset($leaves['application_dt']) ? $leaves['application_dt'] : '';
$last_leave_type = isset($leaves['last_leave_type']) ? $leaves['last_leave_type'] : '';
$last_leave_from = isset($leaves['last_leave_from']) ? $leaves['last_leave_from'] : '';
$last_leave_to = isset($leaves['last_leave_to']) ? $leaves['last_leave_to'] : '';
$last_leave_joined_on = isset($leaves['last_leave_joined_on']) ? $leaves['last_leave_joined_on'] : '';
$pre_from = isset($leaves['pre_from']) ? $leaves['pre_from'] : '';
$pre_to = isset($leaves['pre_to']) ? $leaves['pre_to'] : '';
$pre_desc = isset($leaves['pre_desc']) ? $leaves['pre_desc'] : '';
$suff_from = isset($leaves['suff_from']) ? $leaves['suff_from'] : '';
$suff_to = isset($leaves['suff_to']) ? $leaves['suff_to'] : '';
$suff_desc = isset($leaves['suff_desc']) ? $leaves['suff_desc'] : '';
$recom_autho = isset($leaves['recom_autho']) ? $leaves['recom_autho'] : '';
$recom_autho_desig = isset($leaves['recom_autho_desig']) ? $leaves['recom_autho_desig'] : '';
$recom_autho_pan = isset($leaves['recom_autho_pan']) ? $leaves['recom_autho_pan'] : '';
$recommendation = isset($leaves['recommendation']) ? $leaves['recommendation'] : '';
$recom_date = isset($leaves['recom_date']) ? $leaves['recom_date'] : '';
$sanction_autho = isset($leaves['sanction_autho']) ? $leaves['sanction_autho'] : '';
$sanction_autho_desig = isset($leaves['sanction_autho_desig']) ? $leaves['sanction_autho_desig'] : '';
$sanction_autho_pan = isset($leaves['sanction_autho_pan']) ? $leaves['sanction_autho_pan'] : '';
$sanction_desc = isset($leaves['sanction_desc']) ? $leaves['sanction_desc'] : '';
$approve_date = isset($leaves['approve_date']) ? $leaves['approve_date'] : '';
$leave_status = isset($leaves['leave_status']) ? $leaves['leave_status'] : '';
$upload_dt = isset($leaves['upload_dt']) ? $leaves['upload_dt'] : '';

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
							<?php
								if(!empty($leave_balance)){
									$s1=0;
									foreach($leave_balance as $balance){											
											$s1=$balance['leave_cb']; 
									}
								}else{
									$s1=0;
								}?>
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" align="center"> <font color="#1E0BA9"><b>LEAVE  APPLICATIN  FORM (CL AND RH)</b></font></span></label>
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
										<input id="name" name="name" value="<?php echo $profile['empname'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Employee ID<span class="star">*</span></label>
										<input id="empid" name="empid" value="<?php echo $profile['empid'] ?>" type="text" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name<span class="star">*</span></label>
										<input id="office_nm" name="office_nm" value="<?php echo $profile['office'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input id="desig" name="desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input id="leave_basic_pay" name="leave_basic_pay" type="text"  value="<?php echo $profile['basic_pay'] ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input id="section" name="section"  type="text" value="<?php echo $profile['section'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input id="group_nm" name="group_nm"  type="text" value="<?php echo $profile['group_name'] ?>" class="form-control"  readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Phone Number</label>
												<input id="mbno" name="mbno" type="text" value="<?php echo $profile['mbno'] ?>" class="form-control" >
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name"> Reason for taking  leave<span class="star">*</span></label>
												<select id = "d_desc" name="ground" class="form-control" onchange = "disabledField();CheckBalance();" required>
													<option value=""> -- Select Date--</option>
													<option data-value="1" class = "" value="New Years Day">New Years Day (01-01-2024)</option>
													<option data-value="3" class = "optionRedText" value="Lohri" >Lohri (13-01-2024)</option>		
													<option data-value="4" class = "optionRedText" value="Makar Sankranti/Bihu" >Makar Sankranti/Bihu (14-01-2024)</option>
													<option data-value="5" class = "" value="Pongal" >Pongal (15-01-2024)</option>
													<option data-value="2" class = "" value="Gugu Gobind Singh's Birthday" >Gugu Gobind Singh's Birthday (17-01-2024)</option>	
													<option data-value="6" class = "" value="Netaji Subhash Chandra Bose's Birthday" >Netaji Subhash Chandra Bose's Birthday (23-01-2024)
<!--												<option data-value="7" class = "" value="Basant Panchami" >Basant Panchami/ Sri Panchami (26-01-2024)</option>	-->
													<option data-value="8" class = "" value="Hazarat Ali's Birthday" >Hazarat Ali's Birthday(25-01-2024)</option>
<!--												<option data-value="9" class = "" value="Swami Dayananda Saraswati's Birthday" >Swami Dayananda Saraswati's Birthday (15-02-2024)</option>
													<option data-value="10" class = "optionRedText" value="Maha Shivaratri" >Maha Shivaratri (18-02-2024)</option>	-->
													<option data-value="11" class = "" value="Shivaji Jayanti" >Shivaji Jayanti (19-02-2024)</option>
													<option data-value="12" class = "optionRedText" value="Guru Ravi Das's Birthday" >Guru Ravi Das's Birthday(24-02-2024)</option>	
													<option data-value="12" class = "" value="Swami Dayananda Swraswati Jayanti" >Swami Dayananda Swraswati Jayanti (06-03-2024)</option>	
													<option data-value="13" class = "" value="Maha Shivaratri" >Maha Shivaratri (08-03-2024)</option>
													<option data-value="13" class = "optionRedText" value="Holika Dahan" >Holika Dahan  (24-03-2024)</option>	
													<option data-value="14" class = "" value="Dolyatra" >Dolyatra (25-03-2024)</option>		
													<option data-value="17" class = "optionRedText" value="Easter Sunday" >Easter Sunday (31-03-2024)</option>
													<option data-value="21" class = "" value="Jamat-Ul-Vida" >Jamat-Ul-Vida (05-04-2024)</option>
													<option data-value="18" class = "" value="Chaitra Sukladi/Gudi Padava" >Chaitra Sukladi/Gudi Padava/Ugadi/Cheti Chand (09-04-2024)</option>
<!--												<option data-value="18" class = "" value="Vaisakhi / Bishu /Meshadi" >Vaisakhi / Bishu /Meshadi (14-04-2024)</option> -->
													<option data-value="19" class = "optionRedText" value="Vaisakhil Vishu" >Vaisakhil Vishu(13-04-2024)</option>		
													<option data-value="20" class = "optionRedText" value="Baishakhadi /Bahag Bihu" >Tamil New Year's Day / Baishakhadi /Bahag Bihu (14-04-2024)</option>
													<option data-value="16" class = "optionRedText" value="Ram Navami" >Ram Navami (17-04-2024)</option>
													<option data-value="22" class = "" value="Guru Rabindranath's Birthday" >Guru Rabindranath's Birthday (08-05-2024)</option>
													<option data-value="23" class = "optionRedText" value="Rath Yatra" >Rath Yatra (07-07-2024)</option>
													<option data-value="24" class = "optionRedText" value="Parsi New Year's Day" >Parsi New Year's Day (15-08-2024)</option>
													<option data-value="27" class = "" value="Raksha Bandhan" >Raksha Bandhan (19-08-2024)</option>
													<option data-value="28" class = "" value="Janmashtami" >Janmashtami (26-08-2024)</option>
													<option data-value="29" class = "optionRedText" value="Ganesh Chaturthi" >Ganesh Chaturthi (07-09-2024)</option>
													<option data-value="26" class = "optionRedText" value="Onam" >Onam (15-09-2024)</option>
													<option data-value="30" class = "" value="Saptami" >Saptami (10-10-2024)</option>		
<!--												<option data-value="25" class = "optionRedText" value="Vinayaka Chaturthi" >Vinayaka Chaturthi (20-08-2024)</option>-->
													<option data-value="34" class = "" value="Maharshi Valmiki's Birthday" >Maharshi Valmiki's Birthday (17-10-2024)</option>
													<option data-value="35" class = "optionRedText" value="Karaka Chauturthi" >Karaka Chauturthi (20-10-2024)</option>
													<option data-value="36" class = "optionRedText" value="Naraka Chauturthi" >Naraka Chauturthi (31-10-2024)</option>
													<option data-value="37" class = "optionRedText" value="Govardhan Puja" >Govardhan Puja (02-11-2024)</option>
													<option data-value="38" class = "optionRedText" value="Bhai Duj" >Bhai Duj (03-11-2024)</option>
													<option data-value="39" class = "" value="Chhat Puja" >Chhat Puja (07-11-2024)</option>
													
<!--												<option data-value="31" class = "optionRedText" value="Mahaashtami" >Mahaashtami (22-10-2024)</option>
													<option data-value="32" class = "" value="Mahanavmi" >Mahanavmi (04-10-2024)</option>		
													<option data-value="33" class = "" value="Dussehra" >Dussehra (04-10-2024)</option>		-->													
													
													<option data-value="40" class = "" value="Jagaddhatri Puja" >Jagaddhatri Puja (08-11-2024)</option>
													<option data-value="41" class = "optionRedText" value="Guru Teg Bahadur's Martyrdom" >Guru Teg Bahadur's Martyrdom (24-11-2024)</option>
													<option data-value="42" class = "" value="Christmas Eve" >Christmas Eve (24-12-2024)</option>
												</select>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Balance <span class="star">*</span></label>
										<input type="text" name="balance_leave" value="<?php echo $s1 + $leaves['leave_day_no']?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Leave applied for</label>
										<input type="text" name="leave_type" value="<?php echo $leaves['leave_type'] ?>" class="form-control"  readonly>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">From</label>
												
											</div>
											<div class="col-sm-4  col-xs-4">
												<select id ="leave_from_rh" name="leave_from" class="form-control" required>
													<option value=""> -- Select Date--</option>
													<option data-value="1" class = "" value="2024-01-01">01-01-2024</option>
													<option data-value="2" class = "optionRedText" value="2024-01-13" >13-01-2024</option>
													<option data-value="3" class = "optionRedText" value="2024-01-14" >14-01-2024</option>
													<option data-value="4" class = "" value="2024-01-15" >15-01-2024</option>
													<option data-value="5" class = "" value="2024-01-17" >17-01-2024</option>
													<option data-value="5" class = "" value="2024-01-23" >23-01-2024</option>
													<option data-value="5" class = "" value="2024-01-25" >25-01-2024</option>
													<option data-value="6" class = "" value="2024-02-19" >19-02-2024</option>	
													<option data-value="7" class = "optionRedText" value="2024-02-24" >24-02-2024</option>
													<option data-value="8" class = "" value="2024-03-06" >06-03-2024</option>
													<option data-value="9" class = "" value="2024-03-08" >08-03-2024</option>
													<option data-value="10" class = "optionRedText" value="2024-03-24" >24-03-2024</option>
													<option data-value="11" class = "" value="2024-03-25" >25-03-2024</option>
													<option data-value="12" class = "optionRedText" value="2024-03-31" >31-03-2024</option>
													<option data-value="13" class = "" value="2024-04-05" >05-04-2024</option>
													<option data-value="14" class = "" value="2024-04-09" >09-04-2024</option>
													<option data-value="15" class = "optionRedText" value="2024-04-13" >13-04-2024</option>
													<option data-value="16" class = "optionRedText" value="2024-04-14" >14-04-2024</option>
													<option data-value="17" class = "" value="2024-04-17" >17-04-2024</option>
													<option data-value="19" class = "" value="2024-05-08" >08-05-2024</option>
													<option data-value="20" class = "optionRedText" value="2024-07-07" >07-07-2024</option>
													<option data-value="21" class = "optionRedText" value="2024-08-15" >15-08-2024</option>
													<option data-value="22" class = "" value="2024-08-19" >19-08-2024</option>
													<option data-value="23" class = "" value="2024-08-26" >26-08-2024</option>
													<option data-value="25" class = "optionRedText" value="2024-09-07" >07-09-2024</option>
													<option data-value="26" class = "optionRedText" value="2024-09-15" >15-09-2024</option>
													<option data-value="27" class = "" value="2024-10-10" >10-10-2024</option>
													<option data-value="27" class = "" value="2024-10-17" >17-10-2024</option>
													<option data-value="28" class = "optionRedText" value="2024-10-20" >20-10-2024</option>
													<option data-value="29" class = "optionRedText" value="2024-10-31" >31-10-2024</option>
													<option data-value="31" class = "optionRedText" value="2024-11-02" >02-11-2024</option>
													<option data-value="32" class = "optionRedText" value="2024-11-03" >03-11-2024</option>
													<option data-value="33" class = "" value="2024-11-07" >07-11-2024</option>
													<option data-value="35" class = "" value="2024-11-08" >08-11-2024</option>
													<option data-value="36" class = "optionRedText" value="2024-11-24" >24-11-2024</option>
													<option data-value="37" class = "" value="2024-12-24" >24-12-2024</option>
												</select>
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">To</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<select id ="leave_to_rh" name="leave_to"  class="form-control" >
													<option value=""> -- Select Date--</option>
													<option data-value="1" class = "" value="2024-01-01">01-01-2024</option>
													<option data-value="2" class = "optionRedText" value="2024-01-13" >13-01-2024</option>
													<option data-value="3" class = "optionRedText" value="2024-01-14" >14-01-2024</option>
													<option data-value="4" class = "" value="2024-01-15" >15-01-2024</option>
													<option data-value="5" class = "" value="2024-01-17" >17-01-2024</option>
													<option data-value="5" class = "" value="2024-01-23" >23-01-2024</option>
													<option data-value="5" class = "" value="2024-01-25" >25-01-2024</option>
													<option data-value="6" class = "" value="2024-02-19" >19-02-2024</option>	
													<option data-value="7" class = "optionRedText" value="2024-02-24" >24-02-2024</option>
													<option data-value="8" class = "" value="2024-03-06" >06-03-2024</option>
													<option data-value="9" class = "" value="2024-03-08" >08-03-2024</option>
													<option data-value="10" class = "optionRedText" value="2024-03-24" >24-03-2024</option>
													<option data-value="11" class = "" value="2024-03-25" >25-03-2024</option>
													<option data-value="12" class = "optionRedText" value="2024-03-31" >31-03-2024</option>
													<option data-value="13" class = "" value="2024-04-05" >05-04-2024</option>
													<option data-value="14" class = "" value="2024-04-09" >09-04-2024</option>
													<option data-value="15" class = "optionRedText" value="2024-04-13" >13-04-2024</option>
													<option data-value="16" class = "optionRedText" value="2024-04-14" >14-04-2024</option>
													<option data-value="17" class = "" value="2024-04-17" >17-04-2024</option>
													<option data-value="19" class = "" value="2024-05-08" >08-05-2024</option>
													<option data-value="20" class = "optionRedText" value="2024-07-07" >07-07-2024</option>
													<option data-value="21" class = "optionRedText" value="2024-08-15" >15-08-2024</option>
													<option data-value="22" class = "" value="2024-08-19" >19-08-2024</option>
													<option data-value="23" class = "" value="2024-08-26" >26-08-2024</option>
													<option data-value="25" class = "optionRedText" value="2024-09-07" >07-09-2024</option>
													<option data-value="26" class = "optionRedText" value="2024-09-15" >15-09-2024</option>
													<option data-value="27" class = "" value="2024-10-10" >10-10-2024</option>
													<option data-value="27" class = "" value="2024-10-17" >17-10-2024</option>
													<option data-value="28" class = "optionRedText" value="2024-10-20" >20-10-2024</option>
													<option data-value="29" class = "optionRedText" value="2024-10-31" >31-10-2024</option>
													<option data-value="31" class = "optionRedText" value="2024-11-02" >02-11-2024</option>
													<option data-value="32" class = "optionRedText" value="2024-11-03" >03-11-2024</option>
													<option data-value="33" class = "" value="2024-11-07" >07-11-2024</option>
													<option data-value="35" class = "" value="2024-11-08" >08-11-2024</option>
													<option data-value="36" class = "optionRedText" value="2024-11-24" >24-11-2024</option>
													<option data-value="37" class = "" value="2024-12-24" >24-12-2024</option>
												</select>
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
												<label class="name">No of Days<span class="star"></span></label>
												<input type="text" name="leave_day_no" value="<?php echo $leaves['leave_day_no'] ?>" class="form-control" required >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">If half CL</label>
													<select name="half_cl" class="form-control" >
														<option value=""> -- Select Half--</option>
														<option data-value="1" value="First Half">First Half</option>
														<option data-value="2" value="Second Half">Second Half</option>
													</select>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Place</label>
												<input type="text" name="leave_address" value="<?php echo $leaves['leave_address'] ?>" class="form-control" >
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Aplication Date </label>
												<input  name="application_dt" value="<?php echo  date("d-m-Y");?>" class="form-control " readonly >
												<input id="leave_status" name="leave_status" type="hidden" value="Submitted" class="form-control " >
											</div>
										</div>
									</div>
								</div>
							</div>	
							
							<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="form-group row" title ="Find the authotity by clicking the checkbox against the designation.">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<label class="name"> Choose authority for submitting leave</span></label>
											<div class="col-md-6 col-sm-6">
												<input id="1" type="checkbox" name="check" class="checkbx" value="SUPERVISOR" onchange="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Supervisor
											</div>
											<div class="col-md-7 col-sm-6 name-mrgbtm">
												<input id="2" type="checkbox" name="check" class="checkbx" value="ASSTT. ACCOUNTS OFFICER" onchange="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Asstt. Accounts Officer
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<label class="name">:</span></label>
											<div class="col-md-6 col-sm-6">
												<input id="3" type="checkbox" name="check" class="checkbx" value="SR. ACCOUNTS OFFICER" onclick="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Sr. Accounts Officer
											</div>
											<div class="col-md-7 col-sm-6">
												<input id="4" type="checkbox" name="check" class="checkbx" value="DY. ACCOUNTANT GENERAL" onchange="filterEmployeeByDesignation(this.value); selectcheckbox(this.id)"  >Dy. Accountant General
											</div>
										</div>
									</div>
								</div>
							</div>
														
							<div class="control-group">
								<label class="control-label">Choose other authority for submitting leave</label>
								<div class="controls">
								  <div class="filter-area">
									<div class="filter-row">
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
										
									  </div>
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
										<select id="filter-designation" onchange="filterEmployeeByDesignation(this.value)">
										  <option value="all">----Select Designation----</option>			 
										  <?php
											foreach($designation as $value){
											  echo '<option value="'.$value.'">'.$value.'</option>';
											}
										  ?>
										</select>
									  </div>
									  <div class="filter" style="display: inline-block; margin: 0px 0px 0px 10px;">
   
									  </div>
									</div> 
								  </div>
								  <div class="epmloyees-list" style="width:100%; max-height: 300px; overflow: auto;">
											 <?php
										  foreach($employees as $emp){
											echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input required type="radio" name="sanction_autho_pan" value="'.$emp['empname'].'@@@'.$emp['desig'].'@@@'.$emp['empid'].'" '.(($sanction_autho == $emp['empname'] && $sanction_autho_pan == $emp['empid'] &&  $sanction_autho_desig == $emp['desig']) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
										  }?>
								  </div>
								</div>
							</div>
							  
							<div class="col-sm-12">
								<div class="btn-wrap">
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
						</div>	
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$('input.checkbx').on('change',function(){
	$('input.checkbx').not(this).prop('checked', false);
});

function filterEmployeeByDesignation(desig){
  desig = desig.toLowerCase();
   $('.emp-row').each(function(i){
      if(desig != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-designation') == desig){
          $(this).css('display','block');
        }
      }else{
        $(this).css('display','block');
      }
    });
   checkUncheckAll();
}

function checkSelectedOnly(){
  let isChecked = $('#selected-only').is(':checked');
  $('.emp-row').each(function(i){
    if(isChecked){
      if(!$(this).find('input').prop('checked')){
        $(this).css('display','none');
      }
    }else{
      $(this).css('display','block');
    }
  });
}

function checkUncheckAll(){
  var desig = $('#filter-designation').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.emp-row').each(function(i){
    $(this).find('input').prop('checked',false);
    if(isChecked){
      if(desig != 'all'){
        if($(this).attr('data-designation') == desig){
          $(this).find('input').prop('checked',true);
        }
      }else{
        $(this).find('input').prop('checked',true);
      }
    }    
  });
}
function selectcheckbox(id){
	for ( var i =1; i<=4;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
}

function CheckNumber() {
	var day_deduction = document.getElementById('leave_day_no').value;
	if(isNaN(day_deduction)){
		alert("Insert number only such as 0.5, 1, 2, 3 etc.");
	}else{
		if(day_deduction <= 0){
			alert("Insert number of days to be deducted in 'No of Days' column");
		}
	}
}
function CheckBalance() {
	var day_balance = document.getElementById('balance_leave').value;
	if(day_balance <= 0){
		alert("**Your Balance is 0.\n\**Select the Type of Leave & Year above. \n\** Click on 'Select' to have the Balance. \n\**Otherwise, you may contact ITSC.");
	}
}

function disabledField(){
	var val = document.getElementById('leave_type').value;
    if (val == 'Casual Leave') 
    {
		document.getElementById("half_cl_label").style.display = 'block';
		document.getElementById("half_cl").style.display = 'block';
		document.getElementById("d1").style.display = 'block';
		document.getElementById("d3").style.display = 'block';
		document.getElementById("ground").style.display = 'block';
		document.getElementById("d_desc").style.display = 'none';
		document.getElementById("d2").style.display = 'none';
		document.getElementById("d4").style.display = 'none';
		document.getElementById("half_cl_label").disabled = false;
        document.getElementById("half_cl").disabled = false;
		document.getElementById("leave_from_cl").disabled = false;
		document.getElementById("leave_to_cl").disabled = false;
		document.getElementById("ground").disabled = false;
		document.getElementById("leave_from_rh").disabled = true;
		document.getElementById("leave_to_rh").disabled = true;
		document.getElementById("d_desc").disabled = true;
    }
    else 
    {
		document.getElementById("half_cl_label").style.display = 'none';
		document.getElementById("half_cl").style.display = 'none';
		document.getElementById("d1").style.display = 'none';
		document.getElementById("d3").style.display = 'none';
		document.getElementById("ground").style.display = 'none';
		document.getElementById("d_desc").style.display = 'block';
		document.getElementById("d2").style.display = 'block';
		document.getElementById("d4").style.display = 'block';
		document.getElementById("half_cl_label").disabled = true;
		document.getElementById("half_cl").disabled = true;
		document.getElementById("leave_from_rh").disabled = false;
		document.getElementById("leave_to_rh").disabled = false;
		document.getElementById("d_desc").disabled = false;
		document.getElementById("leave_from_cl").disabled = true;
		document.getElementById("leave_to_cl").disabled = true;
		document.getElementById("ground").disabled = false;
    }	
}

</script>
