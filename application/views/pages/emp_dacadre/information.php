<style>
td{	padding:5px;}
tr{	height: 30px;}
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_dacadre_left_panel',$header);?>
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
				<h4><strong>Welcome,</strong> <?php echo $emp_data['empname'] ?></h4>
				<hr />
			<form id="info_form" method="post" class="form-horizontal">
				<div>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				</div>
				<fieldset>
				<table border="1" style="width:100%">
					<tbody>
					
						<?php
						if($profile['da_cadare']){?>
						<tr>
							<td class="col_1">DA Cadre PAN</td>
							<td class="col_2">
							<input type="text" id="empid" name="empid" value="<?php echo isset($profile['empid']) ? $profile['empid']: ''?>" class="form-control" readonly></td>
						</tr>
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
												<option data-value="0" value=""> ---- Select Gender----</option>
												
<!--												<option data-value="1" value="MALE"> MALE </option>	
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
												<option data-value="0" value=""> ---- Select Category----</option>
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
												<option data-value="0" value=""> ---- Select stream----</option>
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
							<td class="col_1">Department</td>
							<td class="col_2"><input type="text" id="dept_appt" name="dept_appt" value="<?php echo isset($profile['dept_appt']) ? $profile['dept_appt']: ''?>" class="form-control" readonly></td>
						</tr>
						<tr>
							<td class="col_1">Office</td>
							<td class="col_2"><input type="text" id="office" name="office" value="<?php echo isset($profile['office']) ? $profile['office']: ''?>" class="form-control" readonly></td>
						</tr>
						<tr>
							<td class="col_1">ID Card No</td>
							<td class="col_2"><input type="text" id="id_cardno" name="id_cardno" value="<?php echo isset($profile['id_cardno']) ? $profile['id_cardno']: ''?>" class="form-control" ></td>
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
							<td class="col_1">Date of Retirement</td>
							<td class="col_2"><input type="text" id="dor" name="dor" value="<?php echo isset($profile['dor']) ? get_datepicker_date($profile['dor']): ''?>" class="form-control" readonly></td>
						</tr>
						<tr>
							<td class="col_1" >Joining Type</td>
							<td class="col_2">
								<select id="joning_type" name="joning_type" class="form-control" >
												<option data-value="0" value=""> ---- Select stream----</option>
												<option data-value="1" value="DIRECT RECRUIT" <?=$profile['joning_type']=='DIRECT RECRUIT' ? 'selected="selected"': '' ;?>> DIRECT RECRUIT</option>
												<option data-value="2" value="MUTUAL TRANSFER" <?=$profile['joning_type']=='MUTUAL TRANSFER' ? 'selected="selected"': '' ;?>> MUTUAL TRANSFER</option>
												<option data-value="3" value="UNILATERAL TRANSFER" <?=$profile['joning_type']=='UNILATERAL TRANSFER' ? 'selected="selected"': '' ;?>> UNILATERAL TRANSFER</option>
												<option data-value="4" value="COMPASSIONATE APPOINTMENT" <?=$profile['joning_type']=='COMPASSIONATE APPOINTMENT' ? 'selected="selected"': '' ;?>> COMPASSIONATE APPOINTMENT</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">Designation</td>
							<td class="col_3">
								<select id="desig" name="desig" class="form-control" required>
									
									<option data-value="1" value="DIVISIONAL ACCOUNTANT" <?=$profile['desig']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTANT</option>
									<option data-value="2" value="DIVISIONAL ACCOUNTS OFFICER-I" <?=$profile['desig']=='DIVISIONAL ACCOUNTS OFFICER-I' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-I</option>
									<option data-value="3" value="DIVISIONAL ACCOUNTS OFFICER-II" <?=$profile['desig']=='DIVISIONAL ACCOUNTS OFFICER-II' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-II</option>
									<option data-value="4" value="DY. ACCOUNTANT GENERAL" <?=$profile['desig']=='DY. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?> >DY. ACCOUNTANT GENERAL</option>
									<option data-value="5" value="SR. ACCOUNTS CLERK" <?=$profile['desig']=='SR. ACCOUNTS CLERK' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS CLERK</option>
									<option data-value="6" value="SR. ACCOUNTS OFFICER" <?=$profile['desig']=='SR. ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS OFFICER</option>
									<option data-value="7" value="SR. DIVISIONAL ACCOUNTS OFFICER" <?=$profile['desig']=='SR. DIVISIONAL ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >SR. DIVISIONAL ACCOUNTS OFFICER</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">Posting Divison</td>
							<td class="col_2">
							<input type="text" id="section" name="section" value="<?php echo isset($profile['section']) ? $profile['section']: ''?>" class="form-control" >
							</td>
						</tr>
						
						<tr>
							<td class="col_1">Group</td>
							<td class="col_2">
								<select id="group_name" name="group_name" class="form-control" required >
										<option data-value="0" value=""> ---- Select stream----</option>
										<option data-value="1" value="ADMINISTRATION" <?=$profile['group_name']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
										<option data-value="2" value="ACCOUNTS" <?=$profile['group_name']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
										<option data-value="3" value="FUND" <?=$profile['group_name']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
										<option data-value="4" value="PENSION" <?=$profile['group_name']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
										<option data-value="5" value="DIVISIONAL ACCOUNTANT" <?=$profile['group_name']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?>> DIVISIONAL ACCOUNTANT</option>
								</select>
							</td>
						</tr>
							<td class="col_1">Basic Pay</td>
							<td class="col_2"><input type="text" id="basic_pay" name="basic_pay" value="<?php echo isset($profile['basic_pay']) ? $profile['basic_pay']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">GPF Ac No / PRAN No</td>
							<td class="col_2"><input type="text" id="gpf_ac_no" name="gpf_ac_no" value="<?php echo isset($profile['gpf_ac_no']) ? $profile['gpf_ac_no']: ''?>" class="form-control" ></td>
						</tr>
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
							<td class="col_2"><input type="text" id="gratuity_nomination" name="gratuity_nomination" value="<?php echo isset($profile['gratuity_nomination']) ? $profile['gratuity_nomination']: ''?>" class="form-control" readonly></td>
							
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
							<td class="col_1">State</td>
							<td class="col_2"><input type="text" id="state" name="state" value="<?php echo isset($profile['state']) ? $profile['state']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">District</td>
							<td class="col_2"><input type="text" id="district" name="district" value="<?php echo isset($profile['district']) ? $profile['district']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">Post Office</td>
							<td class="col_2"><input type="text" id="postoffice" name="postoffice" value="<?php echo isset($profile['postoffice']) ? $profile['postoffice']: ''?>" class="form-control" ></td>
							
						</tr>
						<tr>
							<td class="col_1">Pin</td>
							<td class="col_2"><input type="text" id="pin" name="pin" value="<?php echo isset($profile['pin']) ? $profile['pin']: ''?>" class="form-control" ></td>
							
						</tr>					
						<tr>
							<td class="col_1"><b>Declaration :</b><br>(For document varification only, not content.)</td>
							<td class="col_2">
								<input id="1" type="checkbox" class="checkbx" name="agree"  onclick="show_hide_submit();selectcheckbox(this.id)" /><font color="#C70039">&nbsp;&nbsp;I agree that information as well as other records / documents pertaining to me is correct.</font><br /><br />
								<input id="2" type="checkbox" class="checkbx" name="not_agree"  onclick="show_hide_submit2();selectcheckbox(this.id)" /><font color="#C70039">&nbsp;&nbsp;I am not agree.The reason is as below:-</font><br /><br />
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

<script>
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