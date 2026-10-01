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
$exam_odr_id = isset($record['exam_odr_id']) ? $record['exam_odr_id'] : '';
$empid = isset($record['empid']) ? $record['empid'] : '';
$name = isset($record['name']) ? $record['name'] : '';
$desig = isset($record['desig']) ? $record['desig'] : '';
$emp_section = isset($record['emp_section']) ? $record['emp_section'] : '';
$group_nm = isset($record['group_nm']) ? $record['group_nm'] : '';
$office_nm = isset($record['office_nm']) ? $record['office_nm'] : '';
$emp_type = isset($record['emp_type']) ? $record['emp_type'] : '';
$emp_category = isset($record['emp_category']) ? $record['emp_category'] : '';
$basic_pay = isset($record['basic_pay']) ? $record['basic_pay'] : '';
$emp_qualifi = isset($record['emp_qualifi']) ? $record['emp_qualifi'] : '';
$dob = isset($record['dob']) ? $record['dob'] : '';
$doj = isset($record['doj']) ? $record['doj'] : '';
$service_as_on = isset($record['service_as_on']) ? $record['service_as_on'] : '';
$service_period = isset($record['service_period']) ? $record['service_period'] : '';
$ser_bk_age = isset($record['ser_bk_age']) ? $record['ser_bk_age'] : '';
$exam_sl_no = isset($record['exam_sl_no']) ? $record['exam_sl_no'] : '';
$exam_appli_yr = isset($record['exam_appli_yr']) ? $record['exam_appli_yr'] : '';
$exam_name = isset($record['exam_name']) ? $record['exam_name'] : '';
$conducted_by = isset($record['conducted_by']) ? $record['conducted_by'] : '';
$post_applied = isset($record['post_applied']) ? $record['post_applied'] : '';
$post_pay_level = isset($record['post_pay_level']) ? $record['post_pay_level'] : '';
$advtiser = isset($record['advtiser']) ? $record['advtiser'] : '';
$govt_foreign = isset($record['govt_foreign']) ? $record['govt_foreign'] : '';
$emp_undertking = isset($record['emp_undertking']) ? $record['emp_undertking'] : '';
$quali_for_post = isset($record['quali_for_post']) ? $record['quali_for_post'] : '';
$expri_for_post = isset($record['expri_for_post']) ? $record['expri_for_post'] : '';
$age_as_on = isset($record['age_as_on']) ? $record['age_as_on'] : '';
$other_qualifi = isset($record['other_qualifi']) ? $record['other_qualifi'] : '';
$service_bk_qualifi = isset($record['service_bk_qualifi']) ? $record['service_bk_qualifi'] : '';
$recom_experi = isset($record['recom_experi']) ? $record['recom_experi'] : '';
$ser_bk_age_on = isset($record['ser_bk_age_on']) ? $record['ser_bk_age_on'] : '';
$sbk_other_qualifi = isset($record['sbk_other_qualifi']) ? $record['sbk_other_qualifi'] : '';
$eligibility = isset($record['eligibility']) ? $record['eligibility'] : '';
$attachment = isset($record['attachment']) ? $record['attachment'] : '';
$appli_date = isset($record['appli_date']) ? $record['appli_date'] : '';
$reccomendation = isset($record['reccomendation']) ? $record['reccomendation'] : '';
$reason_recco = isset($record['reason_recco']) ? $record['reason_recco'] : '';
$aao_name = isset($record['aao_name']) ? $record['aao_name'] : '';
$aao_desig = isset($record['aao_desig']) ? $record['aao_desig'] : '';
$aao_remrk = isset($record['aao_remrk']) ? $record['aao_remrk'] : '';
$aao_dt = isset($record['aao_dt']) ? $record['aao_dt'] : '';
$sao_name = isset($record['sao_name']) ? $record['sao_name'] : '';
$sao_desig = isset($record['sao_desig']) ? $record['sao_desig'] : '';
$sao_remrk = isset($record['sao_remrk']) ? $record['sao_remrk'] : '';
$sao_dt = isset($record['sao_dt']) ? $record['sao_dt'] : '';
$dag_name = isset($record['dag_name']) ? $record['dag_name'] : '';
$dag_desig = isset($record['dag_desig']) ? $record['dag_desig'] : '';
$dag_remrk = isset($record['dag_remrk']) ? $record['dag_remrk'] : '';
$dag_dt = isset($record['dag_dt']) ? $record['dag_dt'] : '';
$pag_name = isset($record['pag_name']) ? $record['pag_name'] : '';
$pag_desig = isset($record['pag_desig']) ? $record['pag_desig'] : '';
$pag_remrk = isset($record['pag_remrk']) ? $record['pag_remrk'] : '';
$pag_dt = isset($record['pag_dt']) ? $record['pag_dt'] : '';
$appli_status = isset($record['appli_status']) ? $record['appli_status'] : '';
$update_dt = isset($record['update_dt']) ? $record['update_dt'] : '';
$upload_dt = isset($record['upload_dt']) ? $record['upload_dt'] : '';
$currently_with = isset($record['currently_with']) ? $record['currently_with'] : '';

?>

<div>
<form bgcolor="#FFFFFF" text="#000000"> 
	<div class "">
	  <table width="100%" >
		<tr > 
		  <td align="center" style ="line-height: 2; "> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E), WEST BENGAL </p></font></b><font size=""><p align="center">Treasury Buildings :: Kolkata-1</p></font></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">Sub :- Forwarding of application for employment elsewhere</p></div>
		  </td>
		</tr>
	  </table>
	  <p style = "text-align: right" >Serial No : <?php echo $record['exam_sl_no']?></p>
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
				<div><font size="-1"><?php echo $record['name']?></font></div>
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
				<div><font size="-1"><?php echo $record['desig']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">3</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Whether Permanent / Quasi Permanent/ Temporary</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['emp_type']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">4</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date of Joining</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo get_datepicker_date($record['doj'])?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">5</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Total Service as on (<?php echo get_datepicker_date($record['age_as_on']) ?>)</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo getAgeOn($record['doj'],$record['age_as_on']) ?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">6</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Whether SC / ST / OBC ?</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['emp_category']?></font></div>
			  </td>
			</tr>
			
			<tr> 
			  <td> 
				<div><b><font size="-1">7</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Examination Name / Recruitment.</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['exam_name']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1"> 7(i)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Post Applied for </font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['post_applied']?></font></div>
			  </td>
			</tr>
			<tr> 
			   <td> 
				<div><b><font size="-1"> 7(ii)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Pay level of the post</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['post_pay_level']?></font></div>
			  </td>
			</tr>
			<tr> 
			   <td> 
				<div><b><font size="-1"> 7(iii)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Advertiser</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['advtiser']?></font></div>
			  </td>
			</tr>
			<tr> 
			   <td> 
				<div><b><font size="-1">8</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Whether Foreign Service or another Govt. /Dept.</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['govt_foreign']?></font></div>
			  </td>
			</tr>
			<tr> 
			   <td> 
				<div><b><font size="-1">9</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Undertaking to resign as per rules </font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['emp_undertking']?></font></div>
			  </td>
			</tr>
			<tr> 
			   <td> 
				<div><b><font size="-1">10(i)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Qualification required</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['quali_for_post']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">10(ii)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Experience, if any</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['expri_for_post']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">10(iii)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Age as on (<?php echo get_datepicker_date($record['age_as_on']) ?>) </font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo getAgeOn($record['dob'],$record['age_as_on']) ?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">10(iv)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Other Qualification, if any</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['other_qualifi']?></font></div>
			  </td>
			</tr>
						
			<tr> 
			  <td> 
				<div><b><font size="-1">11(i)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Employee's Qualification</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['emp_qualifi']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">11(ii)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Experience, if any</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['expri_for_post']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">11(iii)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date of Birth</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo get_datepicker_date($record['dob'])?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">11(iv)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Age as on (<?php echo get_datepicker_date($record['age_as_on']) ?>)</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo getAgeOn($record['dob'],$record['age_as_on']) ?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">11(iv)</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Other Qualification, if any </font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['emp_qualifi']?></font></div>
			  </td>
			</tr>
		</table>
	 <p>&nbsp;</p>
     <p>The applicant  <?php echo $record['eligibility']?> all the eligibility criteria as per the advertisement.</p>	
	 <p>&nbsp;</p>
     <p>The application <?php echo $record['reccomendation']?> .</p>
	 <p>&nbsp;</p>
     <p>Reason for <?php echo $record['reason_rec_seclt']?> : </p>
	 <p><?php echo $record['reason_recco']?></p>
	 <p>&nbsp;</p>
     <p>Remark : <?php echo $record['aao_remrk']?></p>
	  <p style = "text-align: left">
	  <span>Name : <?php echo strtoupper($record['aao_name'])?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <span>
	  <span> Desig: <?php echo strtoupper($record['aao_desig'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	  <span>Date : <?php echo strtoupper($record['aao_dt'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	  <p>&nbsp;</p>
	  <p>Remark : <?php echo $record['sao_remrk']?></p>
	  <p style = "text-align: left">
	  <span>Name : <?php echo strtoupper($record['sao_name'])?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <span>
	  <span> Desig: <?php echo strtoupper($record['sao_desig'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	  <span>Date : <?php echo strtoupper($record['sao_dt'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	  <p>&nbsp;</p>
	  <p>Remark : <?php echo $record['dag_remrk']?></p>
	  <p style = "text-align: left">
	  <span>Name : <?php echo strtoupper($record['dag_name'])?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <span>
	  <span> Desig: <?php echo strtoupper($record['dag_desig'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	  <span>Date : <?php echo strtoupper($record['dag_dt'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	  <p>&nbsp;</p>
<?php If (!empty($record['pag_name'])){ ?>
	  <p>Remark : <?php echo $record['pag_remrk']?></p>
	  <p style = "text-align: left">
	  <span>Name : <?php echo strtoupper($record['pag_name'])?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <span>
	  <span> Desig: <?php echo strtoupper($record['pag_desig'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	  <span>Date : <?php echo strtoupper($record['pag_dt'])?>
<?php } ?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	  <p>&nbsp;</p>
	  <p align="left">&nbsp;
	  **Please do not take any print out unless it is absolutely necessary</p>

    </div>
</form>
</div>