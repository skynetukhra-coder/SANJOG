<style>
table1, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}
th {
  text-align: left;
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
<!-- Page-1 -->
<div>
<form bgcolor="#FFFFFF" text="#000000"> 
	<div class "">
	  <table width="100%" >
		<tr > 
		  <td align="center" style ="line-height: 2; "> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E), WEST BENGAL </p></font></b><font size=""><p align="center">Treasury Buildings :: Kolkata-1</p></font></div>
		  </td>
		</tr>
	  </table>
	  <table width="100%" align="center">
			<tr> 
			  <td style ="border: none" > 
				<p>&nbsp;</p>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">1</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Name</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['empname']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">2</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Designation</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['desig']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">3</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Employee PAN</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['empid']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">4</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Office ID</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['office_id']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">5</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Addhar Card</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['aadhaar_cardno']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">6</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date of Birth</font></b></div>
			  </td>
			  <td> 
				<div><?php echo get_datepicker_date($record['dob'])?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">7</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date of Appointment</font></b></div>
			  </td>
			  <td> 
				<div><?php echo get_datepicker_date($record['doapp'])?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">8</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date of Joining in Office</font></b></div>
			  </td>
			  <td> 
				<div><?php echo get_datepicker_date($record['doj_off'])?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">9</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date of Retirement</font></b></div>
			  </td>
			  <td> 
				<div><?php echo get_datepicker_date($record['dor'])?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">10</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Contact Details</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['mbno']?><br><?php echo $record['nicmail']?></br><br><?php echo $record['email']?></br></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">11</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Last Pay</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['basic_pay']?> of Level <?php echo $record['level_pay']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">12</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Net Qualifying Service</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['net_qservice']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">13</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Pension Admissible [Rs]</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['emp_pen']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">14</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Residuary Pension [Rs]</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['pen_resiry']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">15</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">CVP [Rs]</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['cvp']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">16</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">CVP Bill No</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['cvp_bill_no']?> of <?php echo $record['cvp_bill_mth']?> / <?php echo $record['cvp_bill_yr']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">17</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">CRG [Rs]</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['crg']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">18</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">CRG Bill No</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['crg_bill_no']?> of <?php echo $record['crg_bill_mth']?> / <?php echo $record['crg_bill_yr']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">19</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">CGEGIS [Rs]</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['cgegis']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">20</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">CGEGIS Bill No</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['cgeis_bill_no']?> of <?php echo $record['cgeis_bill_mth']?> / <?php echo $record['cgeis_bill_yr']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">21</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Leave Salary [Rs]</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['leave_salary']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">22</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Leave Salary Bill No</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['lsalary_bill_no']?> of <?php echo $record['lsalary_bill_mth']?> / <?php echo $record['lsalary_bill_yr']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">23</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">GPF [Rs]</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['gpf']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">24</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">GPF Bill No</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['gpf_bill_no']?> of <?php echo $record['gpf_bill_mth']?> / <?php echo $record['gpf_bill_yr']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">25</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Ordinary Family Pension [Rs]</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['fmly_pen_ordi']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">26</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Enhanced Family Pension [Rs]</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['fmly_pen_enhd']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">27</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date From</font></b></div>
			  </td>
			  <td> 
				<div><?php echo get_datepicker_date($record['fmly_pen_dt_from'])?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">28</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date To</font></b></div>
			  </td>
			  <td> 
				<div><?php echo get_datepicker_date($record['fmly_pen_dt_to'])?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">29</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Medical Option</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['med_option']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">30</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">PPO NO</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['ppo_no']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">31</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">PPO Date</font></b></div>
			  </td>
			  <td> 
				<div><?php echo get_datepicker_date($record['ppo_dt'])?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">32</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Authority</font></b></div>
			  </td>
			  <td> 
				<div><?php echo $record['pautho']?></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">33</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Authority Date</font></b></div>
			  </td>
			  <td> 
				<div><?php echo get_datepicker_date($record['pautho_dt'])?></div>
			  </td>
			</tr>
			
			
			<tr> 
			  <td> 
				<div><b><font size="-1">34</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Address</div>
			  </td>
			  <td> 
				<div><?php echo $record['address1']?>,<br><?php echo $record['postoffice']?>, <?php echo $record['state']?>,</br><br><?php echo $record['pin']?></br></div>
			  </td>
			</tr>
		</table>
	 <p>&nbsp;</p>
	  <p align="left">&nbsp;</p>
	  <p>&nbsp; **Please do not take any print out unless it is absolutely necessary</p>

    </div>
</form>
</div>