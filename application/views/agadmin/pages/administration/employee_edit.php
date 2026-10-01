<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$office_id = isset($row['office_id']) ? $row['office_id'] : '';
$empname = isset($row['empname']) ? $row['empname'] : '';
$father_name = isset($row['father_name']) ? $row['father_name'] : '';
$group_name = isset($row['group_name']) ? $row['group_name'] : '';
$gender = isset($row['gender']) ? $row['gender'] : '';
$mbno = isset($row['mbno']) ? $row['mbno'] : '';
$category = isset($row['category']) ? $row['category'] : '';
$stream = isset($row['stream']) ? $row['stream'] : '';
$dob = isset($row['dob']) ? $row['dob'] : '';
$dor = isset($row['dor']) ? $row['dor'] : '';
$nicmail = isset($row['nicmail']) ? $row['nicmail'] : '';
$nicmail_proposed = isset($row['nicmail_proposed']) ? $row['nicmail_proposed'] : '';
$email = isset($row['email']) ? $row['email'] : '';
$doapp = isset($row['doapp']) ? $row['doapp'] : '';
$level_pay = isset($row['level_pay']) ? $row['level_pay'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$office = isset($row['office']) ? $row['office'] : 'PR. ACCOUNTANT GENERAL (A&E) WEST BENGAL';
$dept_appt = isset($row['dept_appt']) ? $row['dept_appt'] : 'INDIAN AUDIT AND ACCOUNTS DEPARTMENT';
$da_cadare = isset($row['da_cadare']) ? $row['da_cadare'] : '';
$doj_off = isset($row['doj_off']) ? $row['doj_off'] : '';
$promotion_dt = isset($row['promotion_dt']) ? $row['promotion_dt'] : '';
$promo_from = isset($row['promo_from']) ? $row['promo_from'] : '';
$trans_from = isset($row['trans_from']) ? $row['trans_from'] : '';
$trans_order_dt = isset($row['trans_order_dt']) ? $row['trans_order_dt'] : '';
$joning_type = isset($row['joning_type']) ? $row['joning_type'] : '';
$blodd_grp = isset($row['blodd_grp']) ? $row['blodd_grp'] : '';
$service_bk_no = isset($row['service_bk_no']) ? $row['service_bk_no'] : '';
$id_cardno = isset($row['id_cardno']) ? $row['id_cardno'] : '';
$voter_cardno = isset($row['voter_cardno']) ? $row['voter_cardno'] : '';
$aadhaar_cardno = isset($row['aadhaar_cardno']) ? $row['aadhaar_cardno'] : '';
$gpf_ac_no = isset($row['gpf_ac_no']) ? $row['gpf_ac_no'] : '';
$deputation_status = isset($row['deputation_status']) ? $row['deputation_status'] : '';
$emp_status = isset($row['emp_status']) ? $row['emp_status'] : '';
$picture = isset($row['picture']) ? $row['picture'] : '';
$status = isset($row['status']) ? $row['status'] : '';

// Details
$offic_id = isset($row['offic_id']) ? $row['offic_id'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$qualifi = isset($row['qualifi']) ? $row['qualifi'] : '';
$address1 = isset($row['address1']) ? $row['address1'] : '';
$state = isset($row['state']) ? $row['state'] : '';
$district = isset($row['district']) ? $row['district'] : '';
$postoffice = isset($row['postoffice']) ? $row['postoffice'] : '';
$pin = isset($row['pin']) ? $row['pin'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$sect_idx = isset($row['sect_idx']) ? $row['sect_idx'] : '';
$branch_desc = isset($row['branch_desc']) ? $row['branch_desc'] : '';
$branch_indx = isset($row['branch_indx']) ? $row['branch_indx'] : '';
$grd_slno = isset($row['grd_slno']) ? $row['grd_slno'] : '';
$grd_pageno = isset($row['grd_pageno']) ? $row['grd_pageno'] : '';
$id_cardno = isset($row['id_cardno']) ? $row['id_cardno'] : '';
$nomination = isset($row['nomination']) ? $row['nomination'] : '';
$family_memb = isset($row['family_memb']) ? $row['family_memb'] : '';
$do_exp = isset($row['do_exp']) ? $row['do_exp'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">Update Employee information</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
<!--		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>			-->
		  <div class="control-group">
            <label class="control-label">Employee PAN<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" required readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office ID(Master)<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="office_id" name="office_id" value="<?php echo set_value('office_id',$office_id)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office ID(Details)<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="offic_id" name="offic_id" value="<?php echo set_value('offic_id',$offic_id)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Employee Cadre<span class="required">*</span></label>
            <div class="controls">
              <select id="da_cadare" name="da_cadare" class="form-control" >
					<option data-value="0" value="">---- Select ----</option>
					<option data-value="1" value="0"<?=$row['da_cadare']=='0' ? 'selected="selected"': '' ;?>>AG (A&E) Employee</option>
					<option data-value="2" value="1"<?=$row['da_cadare']=='1' ? 'selected="selected"': '' ;?>>DA Cadre Employee</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Employee Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empname" name="empname" value="<?php echo set_value('empname',$empname)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Picture<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="picture" name="picture" value="<?php echo set_value('picture',$picture)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Father Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="father_name" name="father_name" value="<?php echo set_value('father_name',$father_name)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Gender<span class="required">*</span></label>
            <div class="controls">
              <select id="nic" name="gender" class="form-control" >
					<option data-value="0" value="">---- Select ----</option>
					<option data-value="1" value="MALE"<?=$row['gender']=='MALE' ? 'selected="selected"': '' ;?>>MALE</option>
					<option data-value="2" value="FEMALE"<?=$row['gender']=='FEMALE' ? 'selected="selected"': '' ;?>>FEMALE</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mobile</label>
            <div class="controls">
              <input type="number" name="mbno" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder = "10 DIGIT ONLY" value="<?php echo set_value('mbno',$mbno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Nic Email</label>
            <div class="controls">
              <input type="text" name="nicmail" value="<?php echo set_value('nicmail',$nicmail)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Nic Email Proposed </span></label>
            <div class="controls">
              <select id="nic" name="nicmail_proposed" class="form-control" >
					<option data-value="0" value="">---- Select ----</option>
					<option data-value="1" value="Exist"<?=$row['nicmail_proposed']=='Exist' ? 'selected="selected"': '' ;?>>Exist</option>
					<option data-value="2" value="Yes"<?=$row['nicmail_proposed']=='Yes' ? 'selected="selected"': '' ;?>>Yes</option>
					<option data-value="3" value="No"<?=$row['nicmail_proposed']=='No' ? 'selected="selected"': '' ;?>>No</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input type="text" name="email" value="<?php echo set_value('email',$email)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">New Password</label>
            <div class="controls">
              <input type="password" name="password" value="" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Category<span class="required">*</span></label>
            <div class="controls">
              <select id="category" name="category" class="form-control" >
					<option data-value="0" value=""> ---- Select Category----</option>
					<option data-value="1" value="GENERAL" <?=$row['category']=='GENERAL' ? 'selected="selected"': '' ;?>> GENERAL</option>
					<option data-value="2" value="OBC" <?=$row['category']=='OBC' ? 'selected="selected"': '' ;?>> OBC</option>
					<option data-value="3" value="SC" <?=$row['category']=='SC' ? 'selected="selected"': '' ;?>> SC</option>
					<option data-value="4" value="ST" <?=$row['category']=='ST' ? 'selected="selected"': '' ;?>> ST</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Stream<span class="required">*</span></label>
            <div class="controls">
             <select id="stream" name="stream" class="form-control" >
					<option data-value="0" value=""> ---- Select stream----</option>
					<option data-value="1" value="GENERAL COURSE" <?=$row['stream']=='GENERAL COURSE' ? 'selected="selected"': '' ;?>> GENERAL COURSE</option>
					<option data-value="2" value="TECHNICAL COURSE" <?=$row['stream']=='TECHNICAL COURSE' ? 'selected="selected"': '' ;?>> TECHNICAL COURSE</option>
					<option data-value="3" value="MEDICAL COURSE" <?=$row['stream']=='MEDICAL COURSE' ? 'selected="selected"': '' ;?>> MEDICAL COURSE</option>
					<option data-value="4" value="VOCATIONAL COURSE" <?=$row['stream']=='VOCATIONAL COURSE' ? 'selected="selected"': '' ;?>> VOCATIONAL COURSE</option>
					<option data-value="5" value="DIPLOMA COURSE" <?=$row['stream']=='DIPLOMA COURSE' ? 'selected="selected"': '' ;?>> DIPLOMA COURSE</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Qualification</label>
            <div class="controls">
              <input type="text" name="qualifi" value="<?php echo set_value('qualifi',$qualifi)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Birth</label>
            <div class="controls">
              <input type="text" name="dob" value="<?php echo get_datepicker_date(set_value('dob',$dob))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Retirement</label>
            <div class="controls">
              <input type="text" name="dor" value="<?php echo get_datepicker_date(set_value('dor',$dor))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Appointment to Govt Service</label>
            <div class="controls">
              <input type="text" name="doapp" value="<?php echo get_datepicker_date(set_value('doapp',$doapp))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Joining in this Office</label>
            <div class="controls">
              <input type="text" name="doj_off" value="<?php echo get_datepicker_date(set_value('doj_off',$doj_off))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office</label>
            <div class="controls">
              <input type="text" name="office" value="<?php echo set_value('office',$office)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Department</label>
            <div class="controls">
              <input type="text" name="dept_appt" value="<?php echo set_value('dept_appt',$dept_appt)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Service Book No</label>
            <div class="controls">
              <input type="text" name="service_bk_no" value="<?php echo set_value('service_bk_no',$service_bk_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Office ID Card No</label>
            <div class="controls">
              <input type="text" name="id_cardno" value="<?php echo set_value('id_cardno',$id_cardno)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Voter Card No</label>
            <div class="controls">
              <input type="text" name="voter_cardno" value="<?php echo set_value('voter_cardno',$voter_cardno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Aadhaar Card No</label>
            <div class="controls">
              <input type="text" name="aadhaar_cardno" value="<?php echo set_value('aadhaar_cardno',$aadhaar_cardno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">GPF Ac No / PRAN No</label>
            <div class="controls">
              <input type="text" name="gpf_ac_no" value="<?php echo set_value('gpf_ac_no',$gpf_ac_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Pay Level</label>
            <div class="controls">
              <input type="text" name="level_pay" value="<?php echo set_value('level_pay',$level_pay)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Basic Pay</label>
            <div class="controls">
              <input type="text" name="basic_pay" value="<?php echo set_value('basic_pay',$basic_pay)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Joining Type</label>
            <div class="controls">
				<select id="joning_type" name="joning_type" class="form-control" >
					<option data-value="0" value=""> ---- Select Joining Type----</option>
					<option data-value="1" value="DIRECT RECRUIT" <?=$row['joning_type']=='DIRECT RECRUIT' ? 'selected="selected"': '' ;?>> DIRECT RECRUIT</option>
					<option data-value="2" value="MUTUAL TRANSFER" <?=$row['joning_type']=='MUTUAL TRANSFER' ? 'selected="selected"': '' ;?>> MUTUAL TRANSFER</option>
					<option data-value="3" value="UNILATERAL TRANSFER" <?=$row['joning_type']=='UNILATERAL TRANSFER' ? 'selected="selected"': '' ;?>> UNILATERAL TRANSFER</option>
					<option data-value="4" value="COMPASSIONATE APPOINTMENT" <?=$row['joning_type']=='COMPASSIONATE APPOINTMENT' ? 'selected="selected"': '' ;?>> COMPASSIONATE APPOINTMENT</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Blood Gruop</label>
            <div class="controls">
              <input type="text" name="blodd_grp" value="<?php echo set_value('blodd_grp',$blodd_grp)?>" class="span12 m-wrap" >
            </div>
          </div>
		 <div class="control-group">
            <label class="control-label">Date of Last Promotion</label>
            <div class="controls">
              <input type="text" name="promotion_dt" value="<?php echo get_datepicker_date(set_value('promotion_dt',$promotion_dt))?>" class="span12 m-wrap datepicker" >
            </div>
         </div>
		  <div class="control-group">
            <label class="control-label"> Promoted from the Post</label>
            <div class="controls">
              <select id="promo_from" name="promo_from" class="form-control" >
					<option data-value="0" value=""> ---- Select Designation----</option>
					<option data-value="1" value="ACCOUNTANT GENERAL" <?=$row['promo_from']=='ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?>>ACCOUNTANT GENERAL</option>
					<option data-value="2" value="PR. ACCOUNTANT GENERAL" <?=$row['promo_from']=='PR. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?>>PR. ACCOUNTANT GENERAL</option>
					<option data-value="3" value="ACCOUNTANT" <?=$row['promo_from']=='ACCOUNTANT' ? 'selected="selected"': '' ;?>>ACCOUNTANT</option>
					<option data-value="4" value="ACCOUNTS OFFICER" <?=$row['promo_from']=='ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >ACCOUNTS OFFICER</option>
					<option data-value="5" value="ASSTT. ACCOUNTS OFFICER"  <?=$row['promo_from']=='ASSTT. ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >ASSTT. ACCOUNTS OFFICER</option>
					<option data-value="6" value="ASSTT. ACCOUNTS OFFICER (Adhoc)" <?=$row['promo_from']=='ASSTT. ACCOUNTS OFFICER (Adhoc)' ? 'selected="selected"': '' ;?> >ASSTT. ACCOUNTS OFFICER (Adhoc)</option>
					<option data-value="31" value="ASSTT. SUPERVISOR" <?=$row['promo_from']=='SUPERVISOR' ? 'selected="selected"': '' ;?> >ASSTT. SUPERVISOR</option>
					<option data-value="7" value="CANTEEN ATTENDENT" <?=$row['promo_from']=='CANTEEN ATTENDENT' ? 'selected="selected"': '' ;?> >CANTEEN ATTENDENT</option>
					<option data-value="8" value="CANTEEN MANAGER" <?=$row['promo_from']=='CANTEEN MANAGER' ? 'selected="selected"': '' ;?>>CANTEEN MANAGER</option>
					<option data-value="9" value="CLERK TYPIST" <?=$row['promo_from']=='CLERK TYPIST' ? 'selected="selected"': '' ;?>>CLERK TYPIST</option>
					<option data-value="10" value="DATA ENTRY OPERATOR" <?=$row['promo_from']=='DATA ENTRY OPERATOR' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR</option>
					<option data-value="11" value="DATA ENTRY OPERATOR-I" <?=$row['promo_from']=='DATA ENTRY OPERATOR-I' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR-I</option>
					<option data-value="12" value="DATA ENTRY OPERATOR-II" <?=$row['promo_from']=='DATA ENTRY OPERATOR-II' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR-II</option>
					<option data-value="13" value="DIVISIONAL ACCOUNTANT" <?=$row['promo_from']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTANT</option>
					<option data-value="14" value="DIVISIONAL ACCOUNTS OFFICER-I" <?=$row['promo_from']=='DIVISIONAL ACCOUNTS OFFICER-I' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-I</option>
					<option data-value="15" value="DIVISIONAL ACCOUNTS OFFICER-II" <?=$row['promo_from']=='DIVISIONAL ACCOUNTS OFFICER-II' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-II</option>
					<option data-value="16" value="DY. ACCOUNTANT GENERAL" <?=$row['promo_from']=='DY. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?> >DY. ACCOUNTANT GENERAL</option>
					<option data-value="17" value="SR.DY. ACCOUNTANT GENERAL" <?=$row['promo_from']=='SR.DY. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?> >SR.DY. ACCOUNTANT GENERAL</option>
					<option data-value="18" value="HINDI OFFICER" <?=$row['promo_from']=='HINDI OFFICER' ? 'selected="selected"': '' ;?> >HINDI OFFICER</option>
					<option data-value="19" value="JUNIOR TRANSLATOR" <?=$row['promo_from']=='JUNIOR TRANSLATOR' ? 'selected="selected"': '' ;?> >JUNIOR TRANSLATOR</option>
					<option data-value="33" value="SENIOR TRANSLATOR" <?=$row['promo_from']=='SENIOR TRANSLATOR' ? 'selected="selected"': '' ;?> >SENIOR TRANSLATOR</option>
					<option data-value="20" value="MULTI TASKING STAFF" <?=$row['promo_from']=='MULTI TASKING STAFF' ? 'selected="selected"': '' ;?> >MULTI TASKING STAFF</option>
					<option data-value="21" value="PA TO DAG (ADMIN)" <?=$row['promo_from']=='PA TO DAG (ADMIN)' ? 'selected="selected"': '' ;?> >PA TO DAG (ADMIN)</option>
					<option data-value="22" value="PA TO DAG (ACCOUNTS)" <?=$row['promo_from']=='A TO DAG (ACCOUNTS)' ? 'selected="selected"': '' ;?> >PA TO DAG (ACCOUNTS)</option>
					<option data-value="23" value="PA TO DAG (FUND)" <?=$row['promo_from']=='PA TO DAG (FUND)' ? 'selected="selected"': '' ;?> >PA TO DAG (FUND)</option>
					<option data-value="24" value="PA TO DAG (PENSION)" <?=$row['promo_from']=='PA TO DAG (PENSION)' ? 'selected="selected"': '' ;?> >PA TO DAG (PENSION)</option>
					<option data-value="25" value="SR. ACCOUNTANT" <?=$row['promo_from']=='SR. ACCOUNTANT' ? 'selected="selected"': '' ;?> >SR. ACCOUNTANT</option>
					<option data-value="26" value="SR. ACCOUNTS CLERK" <?=$row['promo_from']=='SR. ACCOUNTS CLERK' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS CLERK</option>
					<option data-value="27" value="SR. ACCOUNTS OFFICER" <?=$row['promo_from']=='="SR. ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS OFFICER</option>					
					<option data-value="34" value="SR. ACCOUNTS OFFICER (Adhoc)" <?=$row['promo_from']=='="SR. ACCOUNTS OFFICER (Adhoc)' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS OFFICER (Adhoc)</option>
					<option data-value="28" value="SR. PRIVATE SECRETARY" <?=$row['promo_from']=='SR. PRIVATE SECRETARY' ? 'selected="selected"': '' ;?> >SR. PRIVATE SECRETARY</option>
					<option data-value="29" value="STENO GR-I" <?=$row['promo_from']=='STENO GR-I' ? 'selected="selected"': '' ;?> >STENO GR-I</option>
					<option data-value="30" value="SUPERVISOR" <?=$row['promo_from']=='SUPERVISOR' ? 'selected="selected"': '' ;?> >SUPERVISOR</option>
					<option data-value="31" value="ASSTT. SUPERVISOR" <?=$row['promo_from']=='SUPERVISOR' ? 'selected="selected"': '' ;?> >ASSTT. SUPERVISOR</option>
					<option data-value="32" value="WELFARE ASSISTANT" <?=$row['promo_from']=='WELFARE ASSISTANT' ? 'selected="selected"': '' ;?> >WELFARE ASSISTANT</option>
					<option data-value="33" value="SR. ACCOUNTANT" <?=$row['promo_from']=='SR. ACCOUNTANT' ? 'selected="selected"': '' ;?> >SR. ACCOUNTANT</option>

				</select>
            </div>
          </div>
		<div class="control-group">
            <label class="control-label">Present Post / Designation</label>
            <div class="controls">
              <select id="desig" name="desig" class="form-control" >
					<option data-value="0" value=""> ---- Select Designation----</option>
					<option data-value="1" value="ACCOUNTANT GENERAL" <?=$row['desig']=='ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?>>ACCOUNTANT GENERAL</option>
					<option data-value="2" value="PR. ACCOUNTANT GENERAL" <?=$row['desig']=='PR. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?>>PR. ACCOUNTANT GENERAL</option>
					<option data-value="3" value="ACCOUNTANT" <?=$row['desig']=='ACCOUNTANT' ? 'selected="selected"': '' ;?>>ACCOUNTANT</option>
					<option data-value="4" value="ACCOUNTS OFFICER" <?=$row['desig']=='ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >ACCOUNTS OFFICER</option>
					<option data-value="5" value="ASSTT. ACCOUNTS OFFICER"  <?=$row['desig']=='ASSTT. ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >ASSTT. ACCOUNTS OFFICER</option>
					<option data-value="6" value="ASSTT. ACCOUNTS OFFICER (Adhoc)" <?=$row['desig']=='ASSTT. ACCOUNTS OFFICER (Adhoc)' ? 'selected="selected"': '' ;?> >ASSTT. ACCOUNTS OFFICER (Adhoc)</option>
					<option data-value="31" value="ASSTT. SUPERVISOR" <?=$row['desig']=='SUPERVISOR' ? 'selected="selected"': '' ;?> >ASSTT. SUPERVISOR</option>
					<option data-value="7" value="CANTEEN ATTENDENT" <?=$row['desig']=='CANTEEN ATTENDENT' ? 'selected="selected"': '' ;?> >CANTEEN ATTENDENT</option>
					<option data-value="8" value="CANTEEN MANAGER" <?=$row['desig']=='CANTEEN MANAGER' ? 'selected="selected"': '' ;?>>CANTEEN MANAGER</option>
					<option data-value="9" value="CLERK TYPIST" <?=$row['desig']=='CLERK TYPIST' ? 'selected="selected"': '' ;?>>CLERK TYPIST</option>
					<option data-value="10" value="DATA ENTRY OPERATOR" <?=$row['desig']=='DATA ENTRY OPERATOR' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR</option>
					<option data-value="11" value="DATA ENTRY OPERATOR-I" <?=$row['desig']=='DATA ENTRY OPERATOR-I' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR-I</option>
					<option data-value="12" value="DATA ENTRY OPERATOR-II" <?=$row['desig']=='DATA ENTRY OPERATOR-II' ? 'selected="selected"': '' ;?> >DATA ENTRY OPERATOR-II</option>
					<option data-value="13" value="DIVISIONAL ACCOUNTANT" <?=$row['desig']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTANT</option>
					<option data-value="14" value="DIVISIONAL ACCOUNTS OFFICER-I" <?=$row['desig']=='DIVISIONAL ACCOUNTS OFFICER-I' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-I</option>
					<option data-value="15" value="DIVISIONAL ACCOUNTS OFFICER-II" <?=$row['desig']=='DIVISIONAL ACCOUNTS OFFICER-II' ? 'selected="selected"': '' ;?> >DIVISIONAL ACCOUNTS OFFICER-II</option>
					<option data-value="16" value="DY. ACCOUNTANT GENERAL" <?=$row['desig']=='DY. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?> >DY. ACCOUNTANT GENERAL</option>
					<option data-value="17" value="SR.DY. ACCOUNTANT GENERAL" <?=$row['desig']=='SR.DY. ACCOUNTANT GENERAL' ? 'selected="selected"': '' ;?> >SR.DY. ACCOUNTANT GENERAL</option>
					<option data-value="18" value="HINDI OFFICER" <?=$row['desig']=='HINDI OFFICER' ? 'selected="selected"': '' ;?> >HINDI OFFICER</option>
					<option data-value="19" value="JUNIOR TRANSLATOR" <?=$row['desig']=='JUNIOR TRANSLATOR' ? 'selected="selected"': '' ;?> >JUNIOR TRANSLATOR</option>
					<option data-value="33" value="SENIOR TRANSLATOR" <?=$row['desig']=='SENIOR TRANSLATOR' ? 'selected="selected"': '' ;?> >SENIOR TRANSLATOR</option>
					<option data-value="20" value="MULTI TASKING STAFF" <?=$row['desig']=='MULTI TASKING STAFF' ? 'selected="selected"': '' ;?> >MULTI TASKING STAFF</option>
					<option data-value="21" value="PA TO DAG (ADMIN)" <?=$row['desig']=='PA TO DAG (ADMIN)' ? 'selected="selected"': '' ;?> >PA TO DAG (ADMIN)</option>
					<option data-value="22" value="PA TO DAG (ACCOUNTS)" <?=$row['desig']=='A TO DAG (ACCOUNTS)' ? 'selected="selected"': '' ;?> >PA TO DAG (ACCOUNTS)</option>
					<option data-value="23" value="PA TO DAG (FUND)" <?=$row['desig']=='PA TO DAG (FUND)' ? 'selected="selected"': '' ;?> >PA TO DAG (FUND)</option>
					<option data-value="24" value="PA TO DAG (PENSION)" <?=$row['desig']=='PA TO DAG (PENSION)' ? 'selected="selected"': '' ;?> >PA TO DAG (PENSION)</option>
					<option data-value="25" value="SR. ACCOUNTANT" <?=$row['desig']=='SR. ACCOUNTANT' ? 'selected="selected"': '' ;?> >SR. ACCOUNTANT</option>
					<option data-value="26" value="SR. ACCOUNTS CLERK" <?=$row['desig']=='SR. ACCOUNTS CLERK' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS CLERK</option>
					<option data-value="27" value="SR. ACCOUNTS OFFICER" <?=$row['desig']=='="SR. ACCOUNTS OFFICER' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS OFFICER</option>
					<option data-value="34" value="SR. ACCOUNTS OFFICER (Adhoc)" <?=$row['promo_from']=='="SR. ACCOUNTS OFFICER (Adhoc)' ? 'selected="selected"': '' ;?> >SR. ACCOUNTS OFFICER (Adhoc)</option>
					<option data-value="28" value="SR. PRIVATE SECRETARY" <?=$row['desig']=='SR. PRIVATE SECRETARY' ? 'selected="selected"': '' ;?> >SR. PRIVATE SECRETARY</option>
					<option data-value="29" value="STENO GR-I" <?=$row['desig']=='STENO GR-I' ? 'selected="selected"': '' ;?> >STENO GR-I</option>
					<option data-value="30" value="SUPERVISOR" <?=$row['desig']=='SUPERVISOR' ? 'selected="selected"': '' ;?> >SUPERVISOR</option>
					<option data-value="32" value="WELFARE ASSISTANT" <?=$row['desig']=='WELFARE ASSISTANT' ? 'selected="selected"': '' ;?> >WELFARE ASSISTANT</option>
					<option data-value="33" value="SR. ACCOUNTANT" <?=$row['desig']=='SR. ACCOUNTANT' ? 'selected="selected"': '' ;?> >SR. ACCOUNTANT</option>
					
				</select>
            </div>
          </div>
		<div class="control-group">
            <label class="control-label">Whether on Deputation?</label>
            <div class="controls">
				<select id="deputation_status" name="deputation_status" class="form-control" >
					<option data-value="0" value=""> ---- Select ----</option>
					<option data-value="1" value="Yes" <?=$row['deputation_status']=='Yes' ? 'selected="selected"': '' ;?>> Yes</option>
					<option data-value="2" value="No" <?=$row['deputation_status']=='No' ? 'selected="selected"': '' ;?>> No</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">State</label>
            <div class="controls">
              <input type="text" name="state" value="<?php echo set_value('state',$state)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">District</label>
            <div class="controls">
              <input type="text" name="district" value="<?php echo set_value('district',$district)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Post Office</label>
            <div class="controls">
              <input type="text" name="postoffice" value="<?php echo set_value('postoffice',$postoffice)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Pin Code</label>
            <div class="controls">
              <input type="text" name="pin" value="<?php echo set_value('pin',$pin)?>" class="span12 m-wrap" >
            </div>
          </div>
<!--		  
		  <div class="control-group">
            <label class="control-label">Present Section</label>
            <div class="controls">
              <select id="section" name="section" class="form-control" >
					<option value=""> -- Select Section to update--</option>
					<?php
						if(isset($section_list) && !empty($section_list)){
							foreach($section_list as $sections){
								echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
							}
						}
					?>
				</select>
            </div>
          </div>
-->
		  <div class="control-group">
            <label class="control-label">Present Section</label>
            <div class="controls">
              <input type="text" name="section" value="<?php echo set_value('section',$section)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section Index</label>
            <div class="controls">
              <input type="text" name="sect_idx" value="<?php echo set_value('sect_idx',$sect_idx)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Branch Officer</label>
            <div class="controls">
              <input type="text" name="branch_desc" value="<?php echo set_value('branch_desc',$branch_desc)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Branch Index</label>
            <div class="controls">
              <input type="text" name="branch_indx" value="<?php echo set_value('branch_indx',$branch_indx)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Group</label>
            <div class="controls">
                <select id="group_name" name="group_name" class="form-control" >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" <?=$row['group_name']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" <?=$row['group_name']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
					<option data-value="3" value="FUND" <?=$row['group_name']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
					<option data-value="4" value="PENSION" <?=$row['group_name']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
					<option data-value="5" value="IAD" <?=$row['group_name']=='IAD' ? 'selected="selected"': '' ;?>>IAD</option>
					<option data-value="6" value="SECRETARIATE" <?=$row['group_name']=='SECRETARIATE' ? 'selected="selected"': '' ;?>> SECRETARIATE</option>
					<option data-value="7" value="DIVISIONAL ACCOUNTANT" <?=$row['group_name']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?>> DIVISIONAL ACCOUNTANT</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label"> Transferred from</label>
            <div class="controls">
              <select id="trans_from" name="trans_from" class="form-control" >
					<option value=""> -- Select Section to update--</option>
					<?php
						if(isset($section_list) && !empty($section_list)){
							foreach($section_list as $sections){
								echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
							}
						}
					?>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Transfer</label>
            <div class="controls">
              <input type="text" name="trans_order_dt" value="<?php echo get_datepicker_date(set_value('trans_order_dt',$trans_order_dt))?>" class="span12 m-wrap datepicker" >
            </div>
         </div>
		  <div class="control-group">
            <label class="control-label">Gradation SL No</label>
            <div class="controls">
              <input type="text" name="grd_slno" value="<?php echo set_value('grd_slno',$grd_slno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Gradation Page No</label>
            <div class="controls">
              <input type="text" name="grd_pageno" value="<?php echo set_value('grd_pageno',$grd_pageno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">ID Card No</label>
            <div class="controls">
              <input type="text" name="id_cardno" value="<?php echo set_value('id_cardno',$id_cardno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Nomination </label>
            <div class="controls">
              <input type="text" name="" value="<?php echo set_value('nomination',$nomination)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Family Member</label>
            <div class="controls">
              <input type="text" name="" value="<?php echo set_value('family_memb',$family_memb)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Status of Eemployee </span></label>
            <div class="controls">
               <select id="status" name="emp_status" class="form-control" required>
					<option data-value="0" value="">---- Select Status ----</option>
					<option data-value="1" value="Working" <?=$row['emp_status']=='Working' ? 'selected="selected"': '' ;?>>Working in Office</option>
					<option data-value="2" value="Deputation" <?=$row['emp_status']=='Deputation' ? 'selected="selected"': '' ;?>>On Deputation</option>
					<option data-value="3" value="Technical Resignation" <?=$row['emp_status']=='Technical Resignation' ? 'selected="selected"': '' ;?>>Technical Resignation</option>
					<option data-value="4" value="Transferred" <?=$row['emp_status']=='Transferred' ? 'selected="selected"': '' ;?>>Transferred to other Office</option>
					<option data-value="5" value="Retired" <?=$row['emp_status']=='Retired' ? 'selected="selected"': '' ;?>>Retired on Superannuation</option>
					<option data-value="6" value="Voluntarily Retired" <?=$row['emp_status']=='Voluntarily Retired' ? 'selected="selected"': '' ;?>>Voluntarily Retired</option>
					<option data-value="7" value="Resigned" <?=$row['emp_status']=='Resigned' ? 'selected="selected"': '' ;?>>Resigned</option>
					<option data-value="8" value="Died in Harness" <?=$row['emp_status']=='Died in Harness' ? 'selected="selected"': '' ;?>>Died in Harness</option>
					<option data-value="9" value="Expired" <?=$row['emp_status']=='Expired' ? 'selected="selected"': '' ;?>>Expired after Superannuation</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Transfer/ VR/ Resignation/ Expiry</label>
            <div class="controls">
              <input type="text" name="do_exp" value="<?php echo get_datepicker_date(set_value('do_exp',$do_exp)) ?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Login Status<span class="required">*</span></label>
            <div class="controls">
              <select id="status" name="status" class="form-control" required>
					<option data-value="0" value="">---- Select Status ----</option>
					<option data-value="1" value="Active" <?=$row['status']=='Active' ? 'selected="selected"': '' ;?>>Active</option>
					<option data-value="2" value="Deactivated" <?=$row['status']=='Deactivated' ? 'selected="selected"': '' ;?>>Deactivate</option>
				</select>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function browse(){
	$('#attachment').click();
}
function previewImage(file_obj,container_id){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if(ext == 'jpg' || ext == 'jpeg' || ext == 'png'){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#' + container_id).html('<img src="" style="max-height:150px; max-width:150px; margin:5px; border:1px solid gray;">');
				$('#' + container_id + ' img').attr('src', e.target.result);
			};
			reader.readAsDataURL(file_obj.files[0]);
		}else{
			$('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
		}
	}
}
</script>