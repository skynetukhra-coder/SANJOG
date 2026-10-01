<?php

$leav_id = isset($row['leav_id']) ? $row['leav_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$leave_basic_pay = isset($row['leave_basic_pay']) ? $row['leave_basic_pay'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$office_nm = isset($row['office_nm']) ? $row['office_nm'] : '';
$leave_type = isset($row['leave_type']) ? $row['leave_type'] : '';
$leave_from = isset($row['leave_from']) ? $row['leave_from'] : '';
$leave_to = isset($row['leave_to']) ? $row['leave_to'] : '';
$leave_day_no = isset($row['leave_day_no']) ? $row['leave_day_no'] : '';
$ground = isset($row['ground']) ? $row['ground'] : '';
$leave_address = isset($row['leave_address']) ? $row['leave_address'] : '';
$application_dt = isset($row['application_dt']) ? $row['application_dt'] : '';
$leave_status = isset($row['leave_status']) ? $row['leave_status'] : '';
$sanction_autho = isset($row['sanction_autho']) ? $row['sanction_autho'] : '';
$sanction_autho_desig = isset($row['sanction_autho_desig']) ? $row['sanction_autho_desig'] : '';
$approve_date = isset($row['approve_date']) ? $row['approve_date'] : '';
$upload_dt = isset($row['upload_dt']) ? $row['upload_dt'] : '';

?>


<div>
<form bgcolor="#FFFFFF" text="#000000"> 
<div>
      <table width="90%" border ="1" color="red" align="center">
        <tr> 
      <td> 
        <div align="center"><b><font size="+1">OFFICE OF THE PR. ACCOUNTANT GENERAL 
          (A&E), WEST BENGAL </font></b></div>
      </td>
    </tr>
    
    <tr> 
      <td> 
        <div align="center">FORM  </div>
      </td>
    </tr>
    <tr> 
      <td> 
            <div align="center">APPLICATION FOR CASUAL LEAVE /RESTRICTED HOLIDAYS</div>
      </td>
    </tr>
  </table>
      <div></div>
      <div> 
        <table width="90%" border="" align="center">
          <tr> 
            <td colspan="2" height="260"> 
              <p>To,</p>
              <p> 
                <?php echo set_value('sanction_autho',$sanction_autho)?>
                ,</p>
              <p> 
                <?php echo set_value('sanction_autho_desig',$sanction_autho_desig)?>
              </p>
              <p>O/o Pr. Accountant General (A&amp;E), WB,</p>
              <p>Treasury Buildings,</p>
              <p>2 Government Place (West),</p>
              <p>Kolkata -700001.</p>
              <p>&nbsp;</p>
            </td>
          </tr>
          <tr> 
            <td colspan="2" height="25"> 
              <p>Sir,</p>
              <p>I would like to inform you that I shall be /was unable to attend 
                office for a period of 
                <?php echo set_value('leave_day_no',$leave_day_no)?>
                day(s) 
                <?php echo set_value('leave_type',$leave_type)?>
                from 
                <?php echo get_datepicker_date(set_value('leave_from',$leave_from)) ?>
                to 
                <?php echo get_datepicker_date(set_value('leave_to',$leave_to)) ?>
                due to 
                <?php echo set_value('ground',$ground)?>
                . </p>
              <p>It is therefore, requested to sanction 
                <?php echo set_value('leave_day_no',$leave_day_no)?>
                day(s) 
                <?php echo set_value('leave_type',$leave_type)?>
                and oblige.</p>
              <p align="right">Your's faithfully,</p>
			  <p>&nbsp;</p>
			  <p align="left">Leave Adress : <?php echo set_value('leave_address',$leave_address) ?></p>
			  <p>&nbsp;</p>
            </td>
          </tr>
          <tr> 
            <td width="71%" height="33">
              <p>Application Date : 
                <?php echo get_datepicker_date(set_value('application_dt',$application_dt)) ?>
              </p>
              <p>Leave Status: 
                <?php echo set_value('leave_status',$leave_status) ?>
              </p>
			  <p>Authority  : 
                <?php echo set_value('sanction_autho',$sanction_autho) ?> 
				<br> Designation  : <?php echo set_value('sanction_autho_desig',$sanction_autho_desig) ?> <br> Approved Date : <?php echo get_datepicker_date(set_value('approve_date',$approve_date)) ?></br>
              </p>
            </td>
            <td width="29%" height="33"> 
              <?php echo set_value('name',$name)?>, 
              <p> 
                <?php echo set_value('desig',$desig)?>
              </p>
			  <p> 
                <?php echo set_value('section',$section)?>
              </p>
            </td>
        </table>
      </div>
      <p>&nbsp;</p>
    </div>
  </form>
</div>


