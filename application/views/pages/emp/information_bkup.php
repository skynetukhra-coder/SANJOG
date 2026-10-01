<?php
$picture = isset($profile['picture']) ? $profile['picture'] : '';
?>

<style>
.table1 td{	padding:5px; font-size:14px;}
.table1 tr{	height: 30px;}

</style>

<div  class="row" >
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php  $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_information'); ?> </div>
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
				<h4>
					<span>
						<?php if($profile['picture']!==''){ ?>
							<span><img width="100" height="100"  style = "border-radius:50%;" src="<?php echo base_url()?>/files/agae/picture/<?php echo $profile['picture']?>" alt=""></span>		<!-- https://agwb.cag.gov.in/files/agae/picture/<?php echo $profile['picture']?>      <?php echo base_url()?>assets/images/logo.png"			-->
							<?php }else{
									if($profile['gender']=='MALE'){ ?>
										<span><img width="100" height="100" style = "border-radius:50%;" src="<?php echo base_url()?>assets/images/dummy-profile-pic-male.jpg" alt=""></span>
									<?php }else{ ?>
										<span><img width="100" height="100"  style = "border-radius:50%;" src="<?php echo base_url()?>assets/images/dummy-female.png" alt=""></span>
									<?php }
							} ?>
					</span>
					<span><strong>&nbsp;&nbsp;&nbsp; Welcome,<br>&nbsp;&nbsp;<?php echo $emp_data['empname'] ?></strong><font style = "color:red; font-size:18px;">&nbsp;&nbsp;[Please update your information.] </font></br></span>
				</h4>
				<hr />
			<form id="info_form" method="post" enctype="multipart/form-data" class="form-horizontal">
				<div>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				</div>
				<table class="table1" border="1" style="width:104%">
					<thead>
						<tr style="text-align:center">
							<th style="text-align:center; width:40%;"><strong>Description</strong></th>
							<th style="text-align:center; width:60%;"><strong>Information</strong></th>
						</tr>
					</thead>
					<tbody>
					
						<?php
						if($profile['da_cadare']){?>
						<tr>
							<td class="col_1">DA Cadre ID</td>
							<td class="col_2">
							</td><input type="text" id="empid" name="empid" value="<?php echo isset($profile['empid']) ? $profile['empid']: ''?>" class="form-control" readonly></tr>
						<?php
						}else{?>
						<tr>
							<td class="col_1">Employee PAN</td>
							<td class="col_2"><input type="text" id="empid" name="empid" value="<?php echo isset($profile['empid']) ? $profile['empid']: ''?>" class="form-control" readonly></td>
						</tr>
						<?php
						}?>
						<tr>
							<td class="col_1">Office ID</td>
							<td class="col_2"><input type="text" id="office_id" name="office_id" value="<?php echo isset($profile['office_id']) ? $profile['office_id']: ''?>" class="form-control" readonly></td>
						</tr>
						<tr>
							<td class="col_1">Name</td>
							<td class="col_2"><input type="text" id="empname" name="empname" value="<?php echo isset($profile['empname']) ? $profile['empname']: ''?>" class="form-control" readonly></td>
						</tr>
						<tr>
							<td class="col_1">Father's Name</td>
							<td class="col_2"><input type="text" id="father_name" name="father_name" value="<?php echo isset($profile['father_name']) ? $profile['father_name']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Gender</td>
							<td class="col_2">
								<select id="gender" name="gender" class="form-control" >
										<option data-value="0" value="">--Select--</option>
												
<!--										<option data-value="1" value="MALE"> MALE </option>	
											<option data-value="2" value="FEMALE"> FEMALE </option>
													
											<option data-value="1" value="MALE" selected="selected" > MALE </option>
											<option data-value="2" value="FEMALE" selected="selected" > FEMALE </option>
													
-->
										<option data-value="1" value="MALE" <?=$profile['gender']=='MALE' ? 'selected="selected"': '' ;?>> MALE</option>
										<option data-value="2" value="FEMALE" <?=$profile['gender']=='FEMALE' ? 'selected="selected"': '' ;?>> FEMALE</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">NIC Email</td>
							<td class="col_2"><input type="text" id="nicmail" name="nicmail" value="<?php echo isset($profile['nicmail']) ? $profile['nicmail']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Email</td>
							<td class="col_2"><input type="text" id="email" name="email" value="<?php echo isset($profile['email']) ? $profile['email']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Phone</td>
							<td class="col_2"><input type="text" id="mbno" name="mbno" value="<?php echo isset($profile['mbno']) ? $profile['mbno']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Category</td>
							<td class="col_2">
								<select id="category" name="category" class="form-control" >
										<option data-value="0" value="">--Select--</option>
										<option data-value="1" value="GENERAL" <?=$profile['category']=='GENERAL' ? 'selected="selected"': '' ;?>> GENERAL</option>
										<option data-value="2" value="OBC" <?=$profile['category']=='OBC' ? 'selected="selected"': '' ;?>> OBC</option>
										<option data-value="3" value="SC" <?=$profile['category']=='SC' ? 'selected="selected"': '' ;?>> SC</option>
										<option data-value="4" value="ST" <?=$profile['category']=='ST' ? 'selected="selected"': '' ;?>> ST</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">Educational Stream</td>
							<td class="col_2">
								<select id="stream" name="stream" class="form-control" >
										<option data-value="0" value="">--Select--</option>
										<option data-value="1" value="GENERAL COURSE" <?=$profile['stream']=='GENERAL COURSE' ? 'selected="selected"': '' ;?>> GENERAL COURSE</option>
										<option data-value="2" value="TECHNICAL COURSE" <?=$profile['stream']=='TECHNICAL COURSE' ? 'selected="selected"': '' ;?>> TECHNICAL COURSE</option>
										<option data-value="3" value="MEDICAL COURSE" <?=$profile['stream']=='MEDICAL COURSE' ? 'selected="selected"': '' ;?>> MEDICAL COURSE</option>
										<option data-value="4" value="VOCATIONAL COURSE" <?=$profile['stream']=='VOCATIONAL COURSE' ? 'selected="selected"': '' ;?>> VOCATIONAL COURSE</option>
										<option data-value="5" value="DIPLOMA COURSE" <?=$profile['stream']=='DIPLOMA COURSE' ? 'selected="selected"': '' ;?>> DIPLOMA COURSE</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">Qualification</td>
							<td class="col_2"><input type="text" id="qualifi" name="qualifi" value="<?php echo isset($profile['qualifi']) ? $profile['qualifi']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">Date of Birth</td>
							<td class="col_2"><input type="text" id="dob" name="dob" value="<?php echo isset($profile['dob']) ? get_datepicker_date($profile['dob']): ''?>" class="form-control" readonly></td>
						</tr>
						<tr>
							<td class="col_1">Blood Group</td>
							<td class="col_2"><input type="text" id="blodd_grp" name="blodd_grp" value="<?php echo isset($profile['blodd_grp']) ? $profile['blodd_grp']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">Department</td>
							<td class="col_2"><input type="text" id="dept_appt" name="dept_appt" value="<?php echo isset($profile['dept_appt']) ? $profile['dept_appt']: ''?>" class="form-control" readonly></td>
						</tr>
						<tr>
							<td class="col_1">Office</td>
							<td class="col_2"><input type="text" id="office" name="office" value="<?php echo isset($profile['office']) ? $profile['office']: ''?>" class="form-control" readonly></td>
						</tr>
						<tr>
							<td class="col_1">Office ID Card No</td>
							<td class="col_2"><input type="text" id="id_cardno" name="id_cardno" value="<?php echo isset($profile['id_cardno']) ? $profile['id_cardno']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Voter Card No</td>
							<td class="col_2"><input type="text" id="voter_cardno" name="voter_cardno" value="<?php echo isset($profile['voter_cardno']) ? $profile['voter_cardno']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Aadhaar Card No</td>
							<td class="col_2"><input type="text" id="aadhaar_cardno" name="aadhaar_cardno" value="<?php echo isset($profile['aadhaar_cardno']) ? $profile['aadhaar_cardno']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Date of Appointment in Goveronment Service</td>
							<td class="col_2"><input type="text" id="doapp" name="doapp" value="<?php echo isset($profile['doapp']) ? get_datepicker_date($profile['doapp']): ''?>" class="form-control datepicker"  ></td>
						</tr>
						<tr>
							<td class="col_1">Date of Joining in this Office</td>
							<td class="col_2"><input type="text" id="doj_off" name="doj_off" value="<?php echo isset($profile['doj_off']) ? get_datepicker_date($profile['doj_off']): ''?>" class="form-control datepicker" ></td>
						</tr>
						<tr>
							<td class="col_1" >Joining Type</td>
							<td class="col_2">
								<select id="joning_type" name="joning_type" class="form-control" >
										<option data-value="0" value="">--Select--</option>
										<option data-value="1" value="DIRECT RECRUIT" <?=$profile['joning_type']=='DIRECT RECRUIT' ? 'selected="selected"': '' ;?>> DIRECT RECRUIT</option>
										<option data-value="2" value="MUTUAL TRANSFER" <?=$profile['joning_type']=='MUTUAL TRANSFER' ? 'selected="selected"': '' ;?>> MUTUAL TRANSFER</option>
										<option data-value="3" value="UNILATERAL TRANSFER" <?=$profile['joning_type']=='UNILATERAL TRANSFER' ? 'selected="selected"': '' ;?>> UNILATERAL TRANSFER</option>
										<option data-value="4" value="COMPASSIONATE APPOINTMENT" <?=$profile['joning_type']=='COMPASSIONATE APPOINTMENT' ? 'selected="selected"': '' ;?>> COMPASSIONATE APPOINTMENT</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">Date of Retirement</td>
							<td class="col_2"><input type="text" id="dor" name="dor" value="<?php echo isset($profile['dor']) ? get_datepicker_date($profile['dor']): ''?>" class="form-control" readonly></td>
						</tr>
						<tr>
							<td class="col_1">Date of Promotion to the present Post / Designation</td>
							<td class="col_2"><input type="text" id="promotion_dt" name="promotion_dt" value="<?php echo isset($profile['promotion_dt']) ? get_datepicker_date($profile['promotion_dt']): ''?>" class="form-control datepicker" ></td>
						</tr>
						<tr>
							<td class="col_1">Promoted from the Post / Designation</td>
							<td class="col_3">
								<select id="promo_from" name="promo_from" class="form-control" >
									<option data-value="0" value="">--Select--</option>
									<option data-value="1" value="ACCOUNTANT GENERAL" <?=$profile['promo_from']=='ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?>>ACCOUNTANT GENERAL</option>
									<option data-value="2" value="PR. ACCOUNTANT GENERAL" <?=$profile['promo_from']=='PR. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?>>PR. ACCOUNTANT GENERAL</option>
									<option data-value="3" value="ACCOUNTANT" <?=$profile['promo_from']=='ACCOUNTANT' ? 'selected="selected"': '' ;?>>ACCOUNTANT</option>
									<option data-value="4" value="ACCOUNTS OFFICER" <?=$profile['promo_from']=='ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >ACCOUNTS OFFICER</option>
									<option data-value="5" value="ASSTT. ACCOUNTS OFFICER"  <?=$profile['promo_from']=='ASSTT. ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >ASSTT. ACCOUNTS OFFICER</option>
									<option data-value="6" value="ASSTT. ACCOUNTS OFFICER (Adhoc)" <?=$profile['promo_from']=='ASSTT. ACCOUNTS OFFICER (Adhoc)' ? 'selected="selected"': '' ;?> >ASSTT. ACCOUNTS OFFICER (Adhoc)</option>
									<option data-value="7" value="CANTEEN ATTENDENT" <?=$profile['promo_from']=='CANTEEN ATTENDENT' ? 'selected="selected"': '' ;?> >CANTEEN ATTENDENT</option>
									<option data-value="8" value="CANTEEN MANAGER" <?=$profile['promo_from']=='CANTEEN MANAGER' ? 'selected="selected"': '' ;?>>CANTEEN MANAGER</option>
									<option data-value="9" value="CLERK TYPIST" <?=$profile['promo_from']=='CLERK TYPIST' ? 'selected="selected"': '' ;?>>CLERK TYPIST</option>
									<option data-value="10" value="DATA ENTRY OPERATOR" <?=$profile['promo_from']=='DATA ENTRY OPERATOR' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR</option>
									<option data-value="11" value="DATA ENTRY OPERATOR-I" <?=$profile['promo_from']=='DATA ENTRY OPERATOR-I' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR-I</option>
									<option data-value="12" value="DATA ENTRY OPERATOR-II" <?=$profile['promo_from']=='DATA ENTRY OPERATOR-II' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR-II</option>
									<option data-value="13" value="DIVISIONAL ACCOUNTANT" <?=$profile['promo_from']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTANT</option>
									<option data-value="14" value="DIVISIONAL ACCOUNTS OFFICER-I" <?=$profile['promo_from']=='DIVISIONAL ACCOUNTS OFFICER-I' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-I</option>
									<option data-value="15" value="DIVISIONAL ACCOUNTS OFFICER-II" <?=$profile['promo_from']=='DIVISIONAL ACCOUNTS OFFICER-II' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-II</option>
									<option data-value="16" value="DY. ACCOUNTANT GENERAL" <?=$profile['promo_from']=='DY. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?> >DY. ACCOUNTANT GENERAL</option>
									<option data-value="17" value="SR.DY. ACCOUNTANT GENERAL" <?=$profile['promo_from']=='SR.DY. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?> >SR.DY. ACCOUNTANT GENERAL</option>
									<option data-value="18" value="HINDI OFFICER" <?=$profile['promo_from']=='HINDI OFFICER' ? 'selected="selected"': '' ;?> >HINDI OFFICER</option>
									<option data-value="18" value="JUNIOR TRANSLATOR" <?=$profile['promo_from']=='JUNIOR TRANSLATOR' ? 'selected="selected"': '' ;?> >JUNIOR TRANSLATOR</option>
									<option data-value="33" value="SENIOR TRANSLATOR" <?=$profile['promo_from']=='SENIOR TRANSLATOR' ? 'selected="selected"': '' ;?> >SENIOR TRANSLATOR</option>
									<option data-value="20" value="MULTI TASKING STAFF" <?=$profile['promo_from']=='MULTI TASKING STAFF' ? 'selected="selected"': '' ;?> >MULTI TASKING STAFF</option>
									<option data-value="21" value="PA TO DAG (ADMIN)" <?=$profile['promo_from']=='PA TO DAG (ADMIN)' ? 'selected="selected"': '' ;?> >PA TO DAG (ADMIN)</option>
									<option data-value="22" value="PA TO DAG (ACCOUNTS)" <?=$profile['promo_from']=='A TO DAG (ACCOUNTS)' ? 'selected="selected"': '' ;?> >PA TO DAG (ACCOUNTS)</option>
									<option data-value="23" value="PA TO DAG (FUND)" <?=$profile['promo_from']=='PA TO DAG (FUND)' ? 'selected="selected"': '' ;?> >PA TO DAG (FUND)</option>
									<option data-value="24" value="PA TO DAG (PENSION)" <?=$profile['promo_from']=='PA TO DAG (PENSION)' ? 'selected="selected"': '' ;?> >PA TO DAG (PENSION)</option>
									<option data-value="25" value="SR. ACCOUNTANT" <?=$profile['promo_from']=='SR. ACCOUNTANT' ? 'selected="selected"': '' ;?> >SR. ACCOUNTANT</option>
									<option data-value="26" value="SR. ACCOUNTS CLERK" <?=$profile['promo_from']=='SR. ACCOUNTS CLERK' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS CLERK</option>
									<option data-value="27" value="SR. ACCOUNTS OFFICER" <?=$profile['promo_from']=='SR. ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS OFFICER</option>
									<option data-value="28" value="SR. PRIVATE SECRETARY" <?=$profile['promo_from']=='SR. PRIVATE SECRETARY' ? 'selected="selected"': '' ;?> >SR. PRIVATE SECRETARY</option>
									<option data-value="29" value="STENO GR-I" <?=$profile['promo_from']=='STENO GR-I' ? 'selected="selected"': '' ;?> >STENO GR-I</option>
									<option data-value="30" value="SUPERVISOR" <?=$profile['promo_from']=='SUPERVISOR' ? 'selected="selected"': '' ;?> >SUPERVISOR</option>
									<option data-value="31" value="WELFARE ASSISTANT" <?=$profile['promo_from']=='WELFARE ASSISTANT' ? 'selected="selected"': '' ;?> >WELFARE ASSISTANT</option>
									<option data-value="32" value="SR. ACCOUNTANT" <?=$profile['promo_from']=='SR. ACCOUNTANT' ? 'selected="selected"': '' ;?> >SR. ACCOUNTANT</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">Present Post / Designation</td>
							<td class="col_3">
								<select id="desig" name="desig" class="form-control" required>
									<option data-value="0" value="">--Select--</option>
									<option data-value="1" value="ACCOUNTANT GENERAL" <?=$profile['desig']=='ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?>>ACCOUNTANT GENERAL</option>
									<option data-value="2" value="PR. ACCOUNTANT GENERAL" <?=$profile['desig']=='PR. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?>>PR. ACCOUNTANT GENERAL</option>
									<option data-value="3" value="ACCOUNTANT" <?=$profile['desig']=='ACCOUNTANT' ? 'selected="selected"': '' ;?>>ACCOUNTANT</option>
									<option data-value="4" value="ACCOUNTS OFFICER" <?=$profile['desig']=='ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >ACCOUNTS OFFICER</option>
									<option data-value="5" value="ASSTT. ACCOUNTS OFFICER"  <?=$profile['desig']=='ASSTT. ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >ASSTT. ACCOUNTS OFFICER</option>
									<option data-value="6" value="ASSTT. ACCOUNTS OFFICER (Adhoc)" <?=$profile['desig']=='ASSTT. ACCOUNTS OFFICER (Adhoc)' ? 'selected="selected"': '' ;?> >ASSTT. ACCOUNTS OFFICER (Adhoc)</option>
									<option data-value="7" value="CANTEEN ATTENDENT" <?=$profile['desig']=='CANTEEN ATTENDENT' ? 'selected="selected"': '' ;?> >CANTEEN ATTENDENT</option>
									<option data-value="8" value="CANTEEN MANAGER" <?=$profile['desig']=='CANTEEN MANAGER' ? 'selected="selected"': '' ;?>>CANTEEN MANAGER</option>
									<option data-value="9" value="CLERK TYPIST" <?=$profile['desig']=='CLERK TYPIST' ? 'selected="selected"': '' ;?>>CLERK TYPIST</option>
									<option data-value="10" value="DATA ENTRY OPERATOR" <?=$profile['desig']=='DATA ENTRY OPERATOR' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR</option>
									<option data-value="11" value="DATA ENTRY OPERATOR-I" <?=$profile['desig']=='DATA ENTRY OPERATOR-I' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR-I</option>
									<option data-value="12" value="DATA ENTRY OPERATOR-II" <?=$profile['desig']=='DATA ENTRY OPERATOR-II' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR-II</option>
									<option data-value="13" value="DIVISIONAL ACCOUNTANT" <?=$profile['desig']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTANT</option>
									<option data-value="14" value="DIVISIONAL ACCOUNTS OFFICER-I" <?=$profile['desig']=='DIVISIONAL ACCOUNTS OFFICER-I' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-I</option>
									<option data-value="15" value="DIVISIONAL ACCOUNTS OFFICER-II" <?=$profile['desig']=='DIVISIONAL ACCOUNTS OFFICER-II' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-II</option>
									<option data-value="16" value="DY. ACCOUNTANT GENERAL" <?=$profile['desig']=='DY. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?> >DY. ACCOUNTANT GENERAL</option>
									<option data-value="17" value="SR.DY. ACCOUNTANT GENERAL" <?=$profile['desig']=='SR.DY. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?> >SR.DY. ACCOUNTANT GENERAL</option>
									<option data-value="18" value="HINDI OFFICER" <?=$profile['desig']=='HINDI OFFICER' ? 'selected="selected"': '' ;?> >HINDI OFFICER</option>
									<option data-value="18" value="JUNIOR TRANSLATOR" <?=$profile['desig']=='JUNIOR TRANSLATOR' ? 'selected="selected"': '' ;?> >JUNIOR TRANSLATOR</option>
									<option data-value="33" value="SENIOR TRANSLATOR" <?=$profile['desig']=='SENIOR TRANSLATOR' ? 'selected="selected"': '' ;?> >SENIOR TRANSLATOR</option>
									<option data-value="20" value="MULTI TASKING STAFF" <?=$profile['desig']=='MULTI TASKING STAFF' ? 'selected="selected"': '' ;?> >MULTI TASKING STAFF</option>
									<option data-value="21" value="PA TO DAG (ADMIN)" <?=$profile['desig']=='PA TO DAG (ADMIN)' ? 'selected="selected"': '' ;?> >PA TO DAG (ADMIN)</option>
									<option data-value="22" value="PA TO DAG (ACCOUNTS)" <?=$profile['desig']=='A TO DAG (ACCOUNTS)' ? 'selected="selected"': '' ;?> >PA TO DAG (ACCOUNTS)</option>
									<option data-value="23" value="PA TO DAG (FUND)" <?=$profile['desig']=='PA TO DAG (FUND)' ? 'selected="selected"': '' ;?> >PA TO DAG (FUND)</option>
									<option data-value="24" value="PA TO DAG (PENSION)" <?=$profile['desig']=='PA TO DAG (PENSION)' ? 'selected="selected"': '' ;?> >PA TO DAG (PENSION)</option>
									<option data-value="25" value="SR. ACCOUNTANT" <?=$profile['desig']=='SR. ACCOUNTANT' ? 'selected="selected"': '' ;?> >SR. ACCOUNTANT</option>
									<option data-value="26" value="SR. ACCOUNTS CLERK" <?=$profile['desig']=='SR. ACCOUNTS CLERK' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS CLERK</option>
									<option data-value="27" value="SR. ACCOUNTS OFFICER" <?=$profile['desig']=='SR. ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS OFFICER</option>
									<option data-value="28" value="SR. PRIVATE SECRETARY" <?=$profile['desig']=='SR. PRIVATE SECRETARY' ? 'selected="selected"': '' ;?> >SR. PRIVATE SECRETARY</option>
									<option data-value="29" value="STENO GR-I" <?=$profile['desig']=='STENO GR-I' ? 'selected="selected"': '' ;?> >STENO GR-I</option>
									<option data-value="30" value="SUPERVISOR" <?=$profile['desig']=='SUPERVISOR' ? 'selected="selected"': '' ;?> >SUPERVISOR</option>
									<option data-value="31" value="WELFARE ASSISTANT" <?=$profile['desig']=='WELFARE ASSISTANT' ? 'selected="selected"': '' ;?> >WELFARE ASSISTANT</option>
									<option data-value="32" value="SR. ACCOUNTANT" <?=$profile['desig']=='SR. ACCOUNTANT' ? 'selected="selected"': '' ;?> >SR. ACCOUNTANT</option>

								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">Group</td>
							<td class="col_2">
								<select id="group_name" name="group_name" class="form-control" required >
										<option data-value="0" value="">--Select--</option>
										<option data-value="1" value="ADMINISTRATION" <?=$profile['group_name']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
										<option data-value="2" value="ACCOUNTS" <?=$profile['group_name']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
										<option data-value="3" value="FUND" <?=$profile['group_name']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
										<option data-value="4" value="PENSION" <?=$profile['group_name']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
										<option data-value="5" value="IAD" <?=$profile['group_name']=='IAD' ? 'selected="selected"': '' ;?>>IAD</option>
										<option data-value="6" value="SECRETARIATE" <?=$profile['group_name']=='SECRETARIATE' ? 'selected="selected"': '' ;?>> SECRETARIATE</option>
										<option data-value="7" value="DIVISIONAL ACCOUNTANT" <?=$profile['group_name']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?>> DIVISIONAL ACCOUNTANT</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td class="col_1">Present Section</td>
							<td class="col_2">
							<input style = "background-color: #eee; border: none;  padding-top: 5px; padding-bottom: 3px;" type="text" id="section" name="section" value="<?php echo isset($profile['section']) ? $profile['section']: ''?>" class="form-control" readonly>
							<span>
							
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
							</span>
							</td>
						</tr>
						<tr>
							<td class="col_1"> Earlier Section</td>
							<td class="col_2" ><span >
							<input style = "background-color: #eee; border: none; padding-top: 5px; padding-bottom: 3px;" type="text" id="trans_from" name="trans_from" value="<?php echo isset($profile['trans_from']) ? $profile['trans_from']: ''?>" class="" readonly>
							</span>
							<span >
							<select id="trans_from" name="trans_from" class = "form-control" >
								<option value="">--Select--</option>
								<?php
								if(isset($section_list) && !empty($section_list)){
									foreach($section_list as $sections){
										echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
									}
								}
								?>
							</select>
							</span>
							</td>
						</tr>
						<tr>
							<td class="col_1">Transfer Order Date</td>
							<td class="col_2"><input type="text" id="trans_order_dt" name="trans_order_dt" value="<?php echo isset($profile['trans_order_dt']) ? get_datepicker_date($profile['trans_order_dt']): ''?>" class="form-control datepicker" ></td>
						</tr>
						<tr>
							<td class="col_1">Service Book No</td>
							<td class="col_2"><input type="text" id="service_bk_no" name="service_bk_no" value="<?php echo isset($profile['service_bk_no']) ? $profile['service_bk_no']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">GPF Ac No / PRAN No</td>
							<td class="col_2"><input type="text" id="gpf_ac_no" name="gpf_ac_no" value="<?php echo isset($profile['gpf_ac_no']) ? $profile['gpf_ac_no']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Pay level</td>
							<td class="col_2" style = "height: 45px"> <span >
								<input style = "background-color: #eee; border: none; " type="text" id="screen1" name="" value="<?php echo isset($profile['level_pay']) ? $profile['level_pay']: ''?>" class="" readonly >
								</span>
								<span>
								<select id="level_pay" name="level_pay" class=" col_2 level" >
									<option value="">--Select--</option>
									<option value="1">Level 1 (1800 GP)</option>
									<option value="2">Level 2 (1900 GP)</option>
									<option value="3">Level 3 (2000 GP)</option>
									<option value="4">Level 4 (2400 GP)</option>
									<option value="5">Level 5 (2800 GP)</option>
									<option value="6">Level 6 (4200 GP)</option>
									<option value="7">Level 7 (4600 GP)</option>
									<option value="8">Level 8 (4800 GP)</option>
									<option value="9">Level 9 (5400 GP)</option>
									<option value="10">Level 10 (5400 GP)</option>
									<option value="11">Level 11 (6600 GP)</option>
									<option value="12">Level 12 (7600 GP)</option>
									<option value="13">Level 13 (8700 GP)</option>
									<option value="13A">Level 13A (8900 GP)</option>
									<option value="14">Level 14 (10000 GP)</option>
								</select>
								<span>
							</td>
						</tr>
						<tr>
							<td class="col_1">Basic Pay</td>
							<td class="col_2" style = "height: 45px">
							<span >
								<input style = "background-color: #eee; border: none;" type="text" id="screen2" name="" value="<?php echo isset($profile['basic_pay']) ? $profile['basic_pay']: ''?>" class="" readonly >
								<input style = "background-color: #eee; border: none;" type="hidden" id="screen3" name="basic_pay"  class="" readonly >
							</span>
							<select id = "bp" class="basic" onClick = "PaySelect();" >
								<option value="">--Select--</option>
							</select>
							</td>		
						</tr>
<!--
						<tr>
							<td class="col_1">Basic Pay</td>
							<td class="col_2"><input type="text" id="basic_pay" name="basic_pay" value="<?php echo isset($profile['basic_pay']) ? $profile['basic_pay']: ''?>" class="form-control" >
							</td>	
						</tr>
-->
						<tr>
							<td class="col_1">Presently on Deputation ?</td>
							<td class="col_2">
							<select id="deputation_status" name="deputation_status" class="form-control" >
									<option data-value="0" value=""> ---- Select ----</option>
									<option data-value="1" value="Yes" <?=$profile['deputation_status']=='Yes' ? 'selected="selected"': '' ;?>> Yes</option>
									<option data-value="2" value="No" <?=$profile['deputation_status']=='No' ? 'selected="selected"': '' ;?>> No</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">Gratuity Nomination</td>
							<td class="col_2"><input type="text" id="gratuity_nomination" name="gratuity_nomination" value="<?php echo isset($profile['gratuity_nomination']) ? $profile['gratuity_nomination']: ''?>" class="form-control" readonly ></td>
							
						</tr>
						<tr>
							<td class="col_1">GIS Nomination</td>
							<td class="col_2"><input type="text" id="gis_nomination" name="gis_nomination" value="<?php echo isset($profile['gis_nomination']) ? $profile['gis_nomination']: ''?>" class="form-control" readonly></td>
							
						</tr>
						
						<tr>
							<td class="col_1">Address</td>
							<td class="col_2"><input type="text" id="address1" name="address1" value="<?php echo isset($profile['address1']) ? $profile['address1']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">Post Office</td>
							<td class="col_2"><input type="text" id="postoffice" name="postoffice" value="<?php echo isset($profile['postoffice']) ? $profile['postoffice']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">District</td>
							<td class="col_2"><input type="text" id="district" name="district" value="<?php echo isset($profile['district']) ? $profile['district']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">State</td>
							<td class="col_2"><input type="text" id="state" name="state" value="<?php echo isset($profile['state']) ? $profile['state']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">Pin</td>
							<td class="col_2"><input type="text" id="pin" name="pin" value="<?php echo isset($profile['pin']) ? $profile['pin']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">Upload Passport-size Picture (Max 70 kb; jpg/jpeg/png )<br><span style = "font-size: 13px; weight;bold; color: red"> Rename your picture with your full name and upload it.(i.e. anil_kumar_roy OR anil_kr_roy )</span></br></td>
							<td class="col_2">
								<input id="attachment" type="file" name="picture" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
								<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($picture != ''){echo '&nbsp;<a href="'.base_url().'files/agae/picture/'.$picture.'" target="_blank">'.$picture.'</a>';}?></span>
							</td>
						</tr>
						
						<tr>
							<td class="col_1"><b>Declaration :</b><br>(For document varification only, not content.)</td>
							<td class="col_2">							
								<input id="1" type="checkbox" class="checkbx" name="agree"  onclick="show_hide_submit();selectcheckbox(this.id)" /><font color="#C70039">&nbsp;&nbsp;I agree that information as well as other records / documents pertaining to me is correct.</font><br></br>
								<input id="2" type="checkbox" class="checkbx" name="not_agree"  onclick="show_hide_submit2();selectcheckbox(this.id)" /><font color="#C70039">&nbsp;&nbsp;I am not agree.The reason is as below:-</font><br><br>								
								<input id="remark" type="text" name="remark" class="form-control" maxlength="250" placeholder="<?php echo $this->lang->line('limit_200_words'); ?>" disabled ></td>
						</tr>
						
<!--						
						<tr>
							<td class="col_1">Gradation List Page No</td>
							<td class="col_2"><input type="text" id="grd_pageno" name="grd_pageno" value="<?php //echo isset($profile['grd_pageno']) ? $profile['grd_pageno']: ''?>" class="form-control" readonly></td>
							
						</tr>
-->
						<tr>
							<td class="col_1">
								<input type="reset" class="btn btn-primary" Value="CANCEL" />
							</td>
							<td class="col_2">
								<input id="submit_btn" type="submit" class="btn btn-success" Value="UPDATE" disabled >
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
 var basicArray ={"1":[18000,18500,19100,19700,20300,20900,21500,22100,22800,23500,24200,24900,25600,26400,27200,28000,28800,29700,30600,31500,32400,33400,34400,35400,36500,37600,38700,39900,41100,42300,43600,44900,46200,47600,49000,50500,52000,53600,55200,56900],"2":[19900,20500,21100,21700,22400,23100,23800,24500,25200,26000,26800,27600,28400,29300,30200,31100,32000,33000,34000,35000,36100,37200,38300,39400,40600,41800,43100,44400,45700,47100,48500,50000,51500,53000,54600,56200,57900,59600,61400,63200],"3":[21700,22400,23100,23800,24500,25200,26000,26800,27600,28400,29300,30200,31100,32000,33000,34000,35000,36100,37200,38300,39400,40600,41800,43100,44400,45700,47100,48500,50000,51500,53000,54600,56200,57900,59600,61400,63200,65100,67100,69100],"4":[25500,26300,27100,27900,28700,29600,30500,31400,32300,33300,34300,35300,36400,37500,38600,39800,41000,42200,43500,44800,46100,47500,48900,50400,51900,53500,55100,56800,58500,60300,62100,64000,65900,67900,69900,72000,74200,76400,78700,81100],"5":[29200,30100,31000,31900,32900,33900,34900,35900,37000,38100,39200,40400,41600,42800,44100,45400,46800,48200,49600,51100,52600,54200,55800,57500,59200,61000,62800,64700,66600,68600,70700,72800,75000,77300,79600,82000,84500,87000,89600,92300],"6":[35400,36500,37600,38700,39900,41100,42300,43600,44900,46200,47600,49000,50500,52000,53600,55200,56900,58600,60400,62200,64100,66000,68000,70000,72100,74300,76500,78800,81200,83600,86100,88700,91400,94100,96900,99800,102800,105900,109100,112400],"7":[44900,46200,47600,49000,50500,52000,53600,55200,56900,58600,60400,62200,64100,66000,68000,70000,72100,74300,76500,78800,81200,83600,86100,88700,91400,94100,96900,99800,102800,105900,109100,112400,115800,119300,122900,126600,130400,134300,138300,142400],"8":[47600,49000,50500,52000,53600,55200,56900,58600,60400,62200,64100,66000,68000,70000,72100,74300,76500,78800,81200,83600,86100,88700,91400,94100,96900,99800,102800,105900,109100,112400,115800,119300,122900,126600,130400,134300,138300,142400,146700,151100],"9":[53100,54700,56300,58000,59700,61500,63300,65200,67200,69200,71300,73400,75600,77900,80200,82600,85100,87700,90300,93000,95800,98700,101700,104800,107900,111100,114400,117800,121300,124900,128600,132500,136500,140600,144800,149100,153600,158200,162900,167800],"10":[56100,57800,59500,61300,63100,65000,67000,69000,71100,73200,75400,77700,80000,82400,84900,87400,90000,92700,95500,98400,101400,104400,107500,110700,114000,117400,120900,124500,128200,132000,136000,140100,144300,148600,153100,157700,162400,167300,172300,177500],"11":[67700,69700,71800,74000,76200,78500,80900,83300,85800,88400,91100,93800,96600,99500,102500,105600,108800,112100,115500,119000,122600,126300,130100,134000,138000,142100,146400,150800,155300,160000,164800,169700,174800,180000,185400,191000,196700,202600,208700],"12":[78800,81200,83600,86100,88700,91400,94100,96900,99800,102800,105900,109100,112400,115800,119300,122900,126600,130400,134300,138300,142400,146700,151100,155600,160300,165100,170100,175200,180500,185900,191500,197200,203100,209200],"13":[123100,126800,130600,134500,138500,142700,147000,151400,155900,160600,165400,170400,175500,180800,186200,191800,197600,203500,209600,215900],"13A":[131100,135000,139100,143300,147600,152000,156600,161300,166100,171100,176200,181500,186900,192500,198300,204200,210300,216600],"14":[144200,148500,153000,157600,162300,167200,172200,177400,182700,188200,193800,199600,205600,211800,218200],"15":[182200,187700,193300,199100,205100,211300,217600,224100],"16":[205400,211600,217900,224400],"17":[225000],"18":[250000]};
    $(document).ready(function () {
        $('.level').on('change', function () {
            $('.basic').html('<option>Please wait..</option>');
            var level = $(this).val();
            //var newList=;
            var str = '';
            for (var i = 0; i < basicArray[level].length; i++) {
                str += '<option>' + basicArray[level][i] + '</option>';
            }
            setTimeout(function () {
                $('.basic').html(str);
            }, 500);
       
		});
		
		 $('.basic').on('click', function () {
			 var levelValue = $('.level').val();
			 var basicValue = $('.basic').val();
			document.getElementById("screen1").value =levelValue;
			document.getElementById("screen2").value =basicValue;
			document.getElementById("screen3").value =basicValue;
		});
	});
	

</script>

<script type="text/javascript">
/*
function PaySelect(){
	 alert(" Update to take effect." );
}
*/
function previewImage(file_obj,container_id){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if( ext == 'jpg' || ext == 'jpeg' || ext == 'png'){
      $('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
    }else{
      $('#attachment').val(''); 
      $('#'+container_id).html('');      
      alert('file type not supported! Supported file types are .jpg, .jpeg ,.png');
    }
	}
}
function previewMultipleImage(file_obj,container_id){
   if (file_obj.files && file_obj.files[0]) {
    for(var i = 0; i< file_obj.files.length; i++){
      var url = file_obj.files[i].name;
      var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();      
      if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' ){
        $('#'+container_id).append('<br/><em>&nbsp;&nbsp;' + url + '</em>');
      }else{
        $('#attachment').val('');
        $('#'+container_id).html('');      
        alert('file type not supported! Supported file types are : .jpg,.jpeg,.png');
        break;
      }

    }   
  }
}
function browse(){
	$('#attachment').click();
}

function show_hide_submit(){
	if($('#1').is(':checked')){
		$('#submit_btn').prop('disabled',false);
		$('#remark').prop('disabled',true);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function show_hide_submit2(){
	if($('#2').is(':checked')){
		$('#submit_btn').prop('disabled',false);
		$('#remark').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function selectcheckbox(id){
	for ( var i =1; i<=2;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
}

</script>