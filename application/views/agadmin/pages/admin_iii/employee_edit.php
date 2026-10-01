<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$office_id = isset($row['office_id']) ? $row['office_id'] : '';
$empname = isset($row['empname']) ? $row['empname'] : '';
$aadhaar_cardno = isset($row['aadhaar_cardno']) ? $row['aadhaar_cardno'] : '';
$level_pay = isset($row['level_pay']) ? $row['level_pay'] : '';
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
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$office = isset($row['office']) ? $row['office'] : '';
$dept_appt = isset($row['dept_appt']) ? $row['dept_appt'] : '';
$doj_off = isset($row['doj_off']) ? $row['doj_off'] : '';
$joning_type = isset($row['joning_type']) ? $row['joning_type'] : '';
$blodd_grp = isset($row['blodd_grp']) ? $row['blodd_grp'] : '';
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
$net_qservice = isset($row['net_qservice']) ? $row['net_qservice'] : '';
$emp_pen = isset($row['emp_pen']) ? $row['emp_pen'] : '';
$pen_resiry = isset($row['pen_resiry']) ? $row['pen_resiry'] : '';
$cvp = isset($row['cvp']) ? $row['cvp'] : '';
$cvp_bill_no = isset($row['cvp_bill_no']) ? $row['cvp_bill_no'] : '';
$cvp_bill_mth = isset($row['cvp_bill_mth']) ? $row['cvp_bill_mth'] : '';
$cvp_bill_yr = isset($row['cvp_bill_yr']) ? $row['cvp_bill_yr'] : '';
$crg = isset($row['crg']) ? $row['crg'] : '';
$crg_bill_no = isset($row['crg_bill_no']) ? $row['crg_bill_no'] : '';
$crg_bill_mth = isset($row['crg_bill_mth']) ? $row['crg_bill_mth'] : '';
$crg_bill_yr = isset($row['crg_bill_yr']) ? $row['crg_bill_yr'] : '';
$cgegis = isset($row['cgegis']) ? $row['cgegis'] : '';
$cgeis_bill_no = isset($row['cgeis_bill_no']) ? $row['cgeis_bill_no'] : '';
$cgeis_bill_mth = isset($row['cgeis_bill_mth']) ? $row['cgeis_bill_mth'] : '';
$cgeis_bill_yr = isset($row['cgeis_bill_yr']) ? $row['cgeis_bill_yr'] : '';
$leave_salary = isset($row['leave_salary']) ? $row['leave_salary'] : '';
$lsalary_bill_no = isset($row['lsalary_bill_no']) ? $row['lsalary_bill_no'] : '';
$lsalary_bill_mth = isset($row['lsalary_bill_mth']) ? $row['lsalary_bill_mth'] : '';
$lsalary_bill_yr = isset($row['lsalary_bill_yr']) ? $row['lsalary_bill_yr'] : '';
$gpf = isset($row['gpf']) ? $row['gpf'] : '';
$gpf_bill_no = isset($row['gpf_bill_no']) ? $row['gpf_bill_no'] : '';
$gpf_bill_mth = isset($row['gpf_bill_mth']) ? $row['gpf_bill_mth'] : '';
$gpf_bill_yr = isset($row['gpf_bill_yr']) ? $row['gpf_bill_yr'] : '';
$fmly_pen_ordi = isset($row['fmly_pen_ordi']) ? $row['fmly_pen_ordi'] : '';
$fmly_pen_dt_from = isset($row['fmly_pen_dt_from']) ? $row['fmly_pen_dt_from'] : '';
$fmly_pen_dt_to = isset($row['gpf_bill_mth']) ? $row['fmly_pen_dt_to'] : '';
$fmly_pen_enhd = isset($row['fmly_pen_enhd']) ? $row['fmly_pen_enhd'] : '';
$med_option = isset($row['med_option']) ? $row['med_option'] : '';
$ppo_no = isset($row['ppo_no']) ? $row['ppo_no'] : '';
$ppo_dt = isset($row['ppo_dt']) ? $row['ppo_dt'] : '';
$pautho = isset($row['pautho']) ? $row['pautho'] : '';
$pautho_dt = isset($row['pautho_dt']) ? $row['pautho_dt'] : '';

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
            <label class="control-label">Employee Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empname" name="empname" value="<?php echo set_value('empname',$empname)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="desig" name="desig" value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Employee PAN<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" required readonly>
            </div>
          </div>		  
		  <div class="control-group">
            <label class="control-label">Office ID<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="office_id" name="office_id" value="<?php echo set_value('office_id',$office_id)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Addhar Card<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="aadhaar_cardno" name="aadhaar_cardno" value="<?php echo set_value('aadhaar_cardno',$aadhaar_cardno)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Birth</label>
            <div class="controls">
              <input type="text" name="dob" value="<?php echo get_datepicker_date(set_value('dob',$dob))?>" class="span12 m-wrap datepicker" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Appointment</label>
            <div class="controls">
              <input type="text" name="doapp" value="<?php echo get_datepicker_date(set_value('doapp',$doapp))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Joining in Office</label>
            <div class="controls">
              <input type="text" name="doj_off" value="<?php echo get_datepicker_date(set_value('doj_off',$doj_off))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Retirement</label>
            <div class="controls">
              <input type="text" name="dor" value="<?php echo get_datepicker_date(set_value('dor',$dor))?>" class="span12 m-wrap datepicker" readonly>
            </div>
          </div>		  
		  <div class="control-group">
            <label class="control-label">Mobile</label>
            <div class="controls">
              <input type="text" name="mbno" value="<?php echo set_value('mbno',$mbno)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Nic Email</label>
            <div class="controls">
              <input type="text" name="nicmail" value="<?php echo set_value('nicmail',$nicmail)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input type="text" name="email" value="<?php echo set_value('email',$email)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Pay Level</label>
            <div class="controls">
              <input type="text" name="level_pay" value="<?php echo set_value('level_pay',$level_pay)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Last Basic Pay</label>
            <div class="controls">
              <input type="text" name="basic_pay" value="<?php echo set_value('basic_pay',$basic_pay)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Net Qualifying Service</label>
            <div class="controls">
              <input type="text" name="net_qservice" value="<?php echo set_value('net_qservice',$net_qservice)?>" class="span12 m-wrap" placeholder = '99 Years 99 Months 99 Days'>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Pension Admissible [Rs]</label>
            <div class="controls">
              <input type="text" name="emp_pen" value="<?php echo set_value('emp_pen',$emp_pen)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Residuary Pension [Rs]</label>
            <div class="controls">
              <input type="text" name="pen_resiry" value="<?php echo set_value('pen_resiry',$pen_resiry)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">CVP [Rs]</label>
            <div class="controls">
              <input type="text" name="cvp" value="<?php echo set_value('cvp',$cvp)?>" class="span12 m-wrap" >
            </div>
          </div>
		 <div class="control-group">
            <label class="control-label">CVP Bill No</span></label>
			<div class="controls" class="form-control" >
			<span > 
            <div style = "width: 20%; float: left">
              <input type="text" name="cvp_bill_no" value="<?php echo set_value('cvp_bill_no',$cvp_bill_no)?>" >
            </div>	
            <div style = "width: 20%; float: left">
              <select class="form-control" name="cvp_bill_mth" >
					<option value="">-----Select Month----</option>
					<option value="1" <?php echo set_select('cvp_bill_mth', "1", ($cvp_bill_mth == "1" ? true : false)); ?>  >1</option>
					<option value="2" <?php echo set_select('cvp_bill_mth', "2", ($cvp_bill_mth == "2" ? true : false)); ?>  >2</option>
					<option value="3" <?php echo set_select('cvp_bill_mth', "3", ($cvp_bill_mth == "3" ? true : false)); ?>  >3</option>
					<option value="4" <?php echo set_select('cvp_bill_mth', "4", ($cvp_bill_mth == "4" ? true : false)); ?>  >4</option>
					<option value="5" <?php echo set_select('cvp_bill_mth', "5", ($cvp_bill_mth == "5" ? true : false)); ?>  >5</option>
					<option value="6" <?php echo set_select('cvp_bill_mth', "6", ($cvp_bill_mth == "6" ? true : false)); ?>  >6</option>
					<option value="7" <?php echo set_select('cvp_bill_mth', "7", ($cvp_bill_mth == "7" ? true : false)); ?>  >7</option>
					<option value="8" <?php echo set_select('cvp_bill_mth', "8", ($cvp_bill_mth == "8" ? true : false)); ?>  >8</option>
					<option value="9" <?php echo set_select('cvp_bill_mth', "9", ($cvp_bill_mth == "9" ? true : false)); ?>  >9</option>
					<option value="10" <?php echo set_select('cvp_bill_mth', "10", ($cvp_bill_mth == "10" ? true : false)); ?>  >10</option>
					<option value="11" <?php echo set_select('cvp_bill_mth', "11", ($cvp_bill_mth == "11" ? true : false)); ?>  >11</option>
					<option value="12" <?php echo set_select('cvp_bill_mth', "12", ($cvp_bill_mth == "12" ? true : false)); ?>  >12</option>
				</select>
            </div>
			<div style = "width: 20%; float: left">
              <input type="text" name="cvp_bill_yr" value="<?php echo set_value('cvp_bill_yr',$cvp_bill_yr)?>" readonly>
            </div>
            <div style = "width: 20%; float: left">
                <select name="cvp_bill_yr" class="form-control" >
					<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
					<?php
						for($i = date('Y'); $i >= 1980; $i--){
							echo '<option value="'.$i.'" '.($this->input->get('cvp_bill_yr',true) == $i ? 'selected': '').' >'.$i.'</option>';
					}?>
				</select>
            </div>
			</span>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">CRG [Rs] </label>
            <div class="controls">
              <input type="text" name="crg" value="<?php echo set_value('crg',$crg)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">CRG Bill No</span></label>
			<div class="controls" class="form-control" >
			<span > 
            <div style = "width: 20%; float: left">
              <input type="text" name="crg_bill_no" value="<?php echo set_value('crg_bill_no',$crg_bill_no)?>" >
            </div>	
            <div style = "width: 20%; float: left">
              <select class="form-control" name="crg_bill_mth" >
					<option value="">-----Select Month----</option>
					<option value="1" <?php echo set_select('crg_bill_mth', "1", ($crg_bill_mth == "1" ? true : false)); ?>  >1</option>
					<option value="2" <?php echo set_select('crg_bill_mth', "2", ($crg_bill_mth == "2" ? true : false)); ?>  >2</option>
					<option value="3" <?php echo set_select('crg_bill_mth', "3", ($crg_bill_mth == "3" ? true : false)); ?>  >3</option>
					<option value="4" <?php echo set_select('crg_bill_mth', "4", ($crg_bill_mth == "4" ? true : false)); ?>  >4</option>
					<option value="5" <?php echo set_select('crg_bill_mth', "5", ($crg_bill_mth == "5" ? true : false)); ?>  >5</option>
					<option value="6" <?php echo set_select('crg_bill_mth', "6", ($crg_bill_mth == "6" ? true : false)); ?>  >6</option>
					<option value="7" <?php echo set_select('crg_bill_mth', "7", ($crg_bill_mth == "7" ? true : false)); ?>  >7</option>
					<option value="8" <?php echo set_select('crg_bill_mth', "8", ($crg_bill_mth == "8" ? true : false)); ?>  >8</option>
					<option value="9" <?php echo set_select('crg_bill_mth', "9", ($crg_bill_mth == "9" ? true : false)); ?>  >9</option>
					<option value="10" <?php echo set_select('crg_bill_mth', "10", ($crg_bill_mth == "10" ? true : false)); ?>  >10</option>
					<option value="11" <?php echo set_select('crg_bill_mth', "11", ($crg_bill_mth == "11" ? true : false)); ?>  >11</option>
					<option value="12" <?php echo set_select('crg_bill_mth', "12", ($crg_bill_mth == "12" ? true : false)); ?>  >12</option>
			  </select>
            </div>
			<div style = "width: 20%; float: left">
              <input type="text" name="crg_bill_yr" value="<?php echo set_value('crg_bill_yr',$crg_bill_yr)?>" readonly>
            </div>
            <div style = "width: 20%; float: left">
                <select name="crg_bill_yr" class="form-control" >
					<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
					<?php
						for($i = date('Y'); $i >= 1980; $i--){
							echo '<option value="'.$i.'" '.($this->input->get('crg_bill_yr',true) == $i ? 'selected': '').' >'.$i.'</option>';
					}?>
				</select>
            </div>
			</span>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">CGEGIS [Rs]</label>
            <div class="controls">
              <input type="text" name="cgegis" value="<?php echo set_value('cgegis',$cgegis)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">CGEGIS Bill No</span></label>
			<div class="controls" class="form-control" >
			<span > 
            <div style = "width: 20%; float: left">
              <input type="text" name="cgeis_bill_no" value="<?php echo set_value('cgeis_bill_no',$cgeis_bill_no)?>" >
            </div>	
            <div style = "width: 20%; float: left">
              <select class="form-control" name="cgeis_bill_mth" >
					<option value="">-----Select Month----</option>
					<option value="1" <?php echo set_select('cgeis_bill_mth', "1", ($cgeis_bill_mth == "1" ? true : false)); ?>  >1</option>
					<option value="2" <?php echo set_select('cgeis_bill_mth', "2", ($cgeis_bill_mth == "2" ? true : false)); ?>  >2</option>
					<option value="3" <?php echo set_select('cgeis_bill_mth', "3", ($cgeis_bill_mth == "3" ? true : false)); ?>  >3</option>
					<option value="4" <?php echo set_select('cgeis_bill_mth', "4", ($cgeis_bill_mth == "4" ? true : false)); ?>  >4</option>
					<option value="5" <?php echo set_select('cgeis_bill_mth', "5", ($cgeis_bill_mth == "5" ? true : false)); ?>  >5</option>
					<option value="6" <?php echo set_select('cgeis_bill_mth', "6", ($cgeis_bill_mth == "6" ? true : false)); ?>  >6</option>
					<option value="7" <?php echo set_select('cgeis_bill_mth', "7", ($cgeis_bill_mth == "7" ? true : false)); ?>  >7</option>
					<option value="8" <?php echo set_select('cgeis_bill_mth', "8", ($cgeis_bill_mth == "8" ? true : false)); ?>  >8</option>
					<option value="9" <?php echo set_select('cgeis_bill_mth', "9", ($cgeis_bill_mth == "9" ? true : false)); ?>  >9</option>
					<option value="10" <?php echo set_select('cgeis_bill_mth', "10", ($cgeis_bill_mth == "10" ? true : false)); ?>  >10</option>
					<option value="11" <?php echo set_select('cgeis_bill_mth', "11", ($cgeis_bill_mth == "11" ? true : false)); ?>  >11</option>
					<option value="12" <?php echo set_select('cgeis_bill_mth', "12", ($cgeis_bill_mth == "12" ? true : false)); ?>  >12</option>
				  </select>
            </div>
			<div style = "width: 20%; float: left">
              <input type="text" name="cgeis_bill_yr" value="<?php echo set_value('cgeis_bill_yr',$cgeis_bill_yr)?>" readonly>
            </div>
            <div style = "width: 20%; float: left">
                <select name="cgeis_bill_yr" class="form-control" >
					<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
					<?php
						for($i = date('Y'); $i >= 1980; $i--){
							echo '<option value="'.$i.'" '.($this->input->get('cgeis_bill_yr',true) == $i ? 'selected': '').' >'.$i.'</option>';
					}?>
				</select>
            </div>
			</span>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Salary [Rs]</label>
            <div class="controls">
              <input type="text" name="leave_salary" value="<?php echo set_value('leave_salary',$leave_salary)?>" class="span12 m-wrap" >
            </div>
          </div>
		 <div class="control-group">
            <label class="control-label">Leave Salary Bill No</span></label>
			<div class="controls" class="form-control" >
			<span > 
            <div style = "width: 20%; float: left">
              <input type="text" name="lsalary_bill_no" value="<?php echo set_value('lsalary_bill_no',$lsalary_bill_no)?>" >
            </div>	
            <div style = "width: 20%; float: left">
              <select class="form-control" name="lsalary_bill_mth" >
					<option value="">-----Select Month----</option>
					<option value="1" <?php echo set_select('lsalary_bill_mth', "1", ($lsalary_bill_mth == "1" ? true : false)); ?>  >1</option>
					<option value="2" <?php echo set_select('lsalary_bill_mth', "2", ($lsalary_bill_mth == "2" ? true : false)); ?>  >2</option>
					<option value="3" <?php echo set_select('lsalary_bill_mth', "3", ($lsalary_bill_mth == "3" ? true : false)); ?>  >3</option>
					<option value="4" <?php echo set_select('lsalary_bill_mth', "4", ($lsalary_bill_mth == "4" ? true : false)); ?>  >4</option>
					<option value="5" <?php echo set_select('lsalary_bill_mth', "5", ($lsalary_bill_mth == "5" ? true : false)); ?>  >5</option>
					<option value="6" <?php echo set_select('lsalary_bill_mth', "6", ($lsalary_bill_mth == "6" ? true : false)); ?>  >6</option>
					<option value="7" <?php echo set_select('lsalary_bill_mth', "7", ($lsalary_bill_mth == "7" ? true : false)); ?>  >7</option>
					<option value="8" <?php echo set_select('lsalary_bill_mth', "8", ($lsalary_bill_mth == "8" ? true : false)); ?>  >8</option>
					<option value="9" <?php echo set_select('lsalary_bill_mth', "9", ($lsalary_bill_mth == "9" ? true : false)); ?>  >9</option>
					<option value="10" <?php echo set_select('lsalary_bill_mth', "10", ($lsalary_bill_mth == "10" ? true : false)); ?>  >10</option>
					<option value="11" <?php echo set_select('lsalary_bill_mth', "11", ($lsalary_bill_mth == "11" ? true : false)); ?>  >11</option>
					<option value="12" <?php echo set_select('lsalary_bill_mth', "12", ($lsalary_bill_mth == "12" ? true : false)); ?>  >12</option>
				  </select>
            </div>
			<div style = "width: 20%; float: left">
              <input type="text" name="lsalary_bill_yr" value="<?php echo set_value('lsalary_bill_yr',$lsalary_bill_yr)?>" readonly>
            </div>
            <div style = "width: 20%; float: left">
                <select name="lsalary_bill_yr" class="form-control" >
					<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
					<?php
						for($i = date('Y'); $i >= 1980; $i--){
							echo '<option value="'.$i.'" '.($this->input->get('lsalary_bill_yr',true) == $i ? 'selected': '').' >'.$i.'</option>';
					}?>
				</select>
            </div>
			</span>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">GPF [Rs]</label>
            <div class="controls">
              <input type="text" name="gpf" value="<?php echo set_value('gpf',$gpf)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">GPF Bill No</span></label>
			<div class="controls" class="form-control" >
			<span > 
            <div style = "width: 20%; float: left">
              <input type="text" name="gpf_bill_no" value="<?php echo set_value('gpf_bill_no',$gpf_bill_no)?>" >
            </div>	
            <div style = "width: 20%; float: left">
              <select class="form-control" name="gpf_bill_mth" >
					<option value="">-----Select Month----</option>
					<option value="1" <?php echo set_select('gpf_bill_mth', "1", ($gpf_bill_mth == "1" ? true : false)); ?>  >1</option>
					<option value="2" <?php echo set_select('gpf_bill_mth', "2", ($gpf_bill_mth == "2" ? true : false)); ?>  >2</option>
					<option value="3" <?php echo set_select('gpf_bill_mth', "3", ($gpf_bill_mth == "3" ? true : false)); ?>  >3</option>
					<option value="4" <?php echo set_select('gpf_bill_mth', "4", ($gpf_bill_mth == "4" ? true : false)); ?>  >4</option>
					<option value="5" <?php echo set_select('gpf_bill_mth', "5", ($gpf_bill_mth == "5" ? true : false)); ?>  >5</option>
					<option value="6" <?php echo set_select('gpf_bill_mth', "6", ($gpf_bill_mth == "6" ? true : false)); ?>  >6</option>
					<option value="7" <?php echo set_select('gpf_bill_mth', "7", ($gpf_bill_mth == "7" ? true : false)); ?>  >7</option>
					<option value="8" <?php echo set_select('gpf_bill_mth', "8", ($gpf_bill_mth == "8" ? true : false)); ?>  >8</option>
					<option value="9" <?php echo set_select('gpf_bill_mth', "9", ($gpf_bill_mth == "9" ? true : false)); ?>  >9</option>
					<option value="10" <?php echo set_select('gpf_bill_mth', "10", ($gpf_bill_mth == "10" ? true : false)); ?>  >10</option>
					<option value="11" <?php echo set_select('gpf_bill_mth', "11", ($gpf_bill_mth == "11" ? true : false)); ?>  >11</option>
					<option value="12" <?php echo set_select('gpf_bill_mth', "12", ($gpf_bill_mth == "12" ? true : false)); ?>  >12</option>
				  </select>
            </div>
			<div style = "width: 20%; float: left">
              <input type="text" name="gpf_bill_yr" value="<?php echo set_value('gpf_bill_yr',$gpf_bill_yr)?>" readonly>
            </div>
            <div style = "width: 20%; float: left">
                <select name="gpf_bill_yr" class="form-control" >
					<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
					<?php
						for($i = date('Y'); $i >= 1980; $i--){
							echo '<option value="'.$i.'" '.($this->input->get('gpf_bill_yr',true) == $i ? 'selected': '').' >'.$i.'</option>';
					}?>
				</select>
            </div>
			</span>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Ordinary Family Pension [Rs]</label>
            <div class="controls">
              <input type="text" name="fmly_pen_ordi" value="<?php echo set_value('fmly_pen_ordi',$fmly_pen_ordi)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Enhanced Family Pension [Rs]</label>
            <div class="controls">
              <input type="text" name="fmly_pen_enhd" value="<?php echo set_value('fmly_pen_enhd',$fmly_pen_enhd)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date From</label>
            <div class="controls">
               <input type="text" name="fmly_pen_dt_from" value="<?php echo get_datepicker_date(set_value('fmly_pen_dt_from',$fmly_pen_dt_from))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date To</label>
            <div class="controls">
               <input type="text" name="fmly_pen_dt_to" value="<?php echo get_datepicker_date(set_value('fmly_pen_dt_to',$fmly_pen_dt_to))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Medical Option</span></label>
            <div class="controls">
              <select id="nic" name="med_option" class="form-control" >
					<option value="">-----Select Option----</option>
					<option value="AMA" <?php echo set_select('med_option', "AMA", ($med_option == "AMA" ? true : false)); ?>  >AMA</option>
					<option value="CGHS" <?php echo set_select('med_option', "CGHS", ($med_option == "CGHS" ? true : false)); ?>  >CGHS</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">PPO NO<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="ppo_no" value="<?php echo set_value('ppo_no',$ppo_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">PPO Date<span class="required">*</span></label>
            <div class="controls">
               <input type="text" name="ppo_dt" value="<?php echo get_datepicker_date(set_value('ppo_dt',$ppo_dt))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		 <div class="control-group">
            <label class="control-label">Authority<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="pautho" value="<?php echo set_value('pautho',$pautho)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Authority Date<span class="required">*</span></label>
            <div class="controls">
               <input type="text" name="pautho_dt" value="<?php echo get_datepicker_date(set_value('pautho_dt',$pautho_dt))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		 
		  
		  <div class="control-group">
            <label class="control-label">Address Line</label>
            <div class="controls">
              <input type="text" name="address1" value="<?php echo set_value('address1',$address1)?>" class="span12 m-wrap"  >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Post Office</label>
            <div class="controls">
              <input type="text" name="postoffice" value="<?php echo set_value('postoffice',$postoffice)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">District</label>
            <div class="controls">
              <input type="text" name="district" value="<?php echo set_value('district',$district)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">State</label>
            <div class="controls">
              <input type="text" name="state" value="<?php echo set_value('state',$state)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Pin Code</label>
            <div class="controls">
              <input type="text" name="pin" value="<?php echo set_value('pin',$pin)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/employee'">Cancel</button>
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