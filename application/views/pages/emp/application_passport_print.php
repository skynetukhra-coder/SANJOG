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
$pappl_id = isset($records['pappl_id']) ? $records['pappl_id'] : '';
$psl_no = isset($records['psl_no']) ? $records['psl_no'] : '';
$pappli_yr = isset($records['pappli_yr']) ? $records['pappli_yr'] : '';
$empid = isset($records['empid']) ? $records['empid'] : '';
$name = isset($records['name']) ? $records['name'] : '';
$f_name = isset($records['f_name']) ? $records['f_name'] : '';
$res_address = isset($records['res_address']) ? $records['res_address'] : '';
$desig = isset($records['desig']) ? $records['desig'] : '';
$mbno = isset($records['mbno']) ? $records['mbno'] : '';
$emp_section = isset($records['emp_section']) ? $records['emp_section'] : '';
$group_nm = isset($records['group_nm']) ? $records['group_nm'] : '';
$office_nm = isset($records['office_nm']) ? $records['office_nm'] : '';
$emp_type = isset($records['emp_type']) ? $records['emp_type'] : '';
$basic_pay = isset($records['basic_pay']) ? $records['basic_pay'] : '';
$id_card_no = isset($records['id_card_no']) ? $records['id_card_no'] : '';
$dob = isset($records['dob']) ? $records['dob'] : '';
$doj = isset($records['doj']) ? $records['doj'] : '';
$passport_no = isset($records['passport_no']) ? $records['passport_no'] : '';
$pexpiry_dt = isset($records['pexpiry_dt']) ? $records['pexpiry_dt'] : '';
$reason_pp = isset($records['reason_pp']) ? $records['reason_pp'] : '';
$period_visit = isset($records['period_visit']) ? $records['period_visit'] : '';
$visit_dt = isset($records['visit_dt']) ? $records['visit_dt'] : '';
$visit_addr = isset($records['visit_addr']) ? $records['visit_addr'] : '';
$days_leave = isset($records['days_leave']) ? $records['days_leave'] : '';
$leave_from = isset($records['leave_from']) ? $records['leave_from'] : '';
$leave_to = isset($records['leave_to']) ? $records['leave_to'] : '';
$cash_doc = isset($records['cash_doc']) ? $records['cash_doc'] : '';
$discipl_action = isset($records['discipl_action']) ? $records['discipl_action'] : '';
$pre_visit = isset($records['pre_visit']) ? $records['pre_visit'] : '';

$attachment = isset($records['attachment']) ? $records['attachment'] : '';
$appli_date = isset($records['appli_date']) ? $records['appli_date'] : '';
$reccomendation = isset($records['reccomendation']) ? $records['reccomendation'] : '';
$reason_recco = isset($records['reason_recco']) ? $records['reason_recco'] : '';

$bo_nm = isset($records['bo_nm']) ? $records['bo_nm'] : '';
$bo_desig = isset($records['bo_desig']) ? $records['bo_desig'] : '';
$bo_remrk = isset($members['bo_remrk']) ? $members['bo_remrk'] : '';
$bo_dt = isset($members['bo_dt']) ? $members['bo_dt'] : '';
$aao_name = isset($records['aao_name']) ? $records['aao_name'] : '';
$aao_desig = isset($records['aao_desig']) ? $records['aao_desig'] : '';
$aao_remrk = isset($members['aao_remrk']) ? $members['aao_remrk'] : '';
$aao_dt = isset($members['aao_dt']) ? $members['aao_dt'] : '';
$sao_name = isset($records['sao_name']) ? $records['sao_name'] : '';
$sao_desig = isset($records['sao_desig']) ? $records['sao_desig'] : '';
$sao_remrk = isset($members['sao_remrk']) ? $members['sao_remrk'] : '';
$sao_dt = isset($members['sao_dt']) ? $members['sao_dt'] : '';
$dag_name = isset($records['dag_name']) ? $records['dag_name'] : '';
$dag_desig = isset($records['dag_desig']) ? $records['dag_desig'] : '';
$dag_remrk = isset($members['dag_remrk']) ? $members['dag_remrk'] : '';
$dag_dt = isset($members['dag_dt']) ? $members['dag_dt'] : '';
$pag_name = isset($records['pag_name']) ? $records['pag_name'] : '';
$pag_desig = isset($records['pag_desig']) ? $records['pag_desig'] : '';
$pag_remrk = isset($members['pag_remrk']) ? $members['pag_remrk'] : '';
$pag_dt = isset($members['pag_dt']) ? $members['pag_dt'] : '';
$appli_status = isset($records['appli_status']) ? $records['appli_status'] : '';
$update_dt = isset($records['update_dt']) ? $records['update_dt'] : '';
$upload_dt = isset($records['upload_dt']) ? $records['upload_dt'] : '';
$currently_with = isset($records['currently_with']) ? $records['currently_with'] : '';

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
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">Application seeking ‘NO OBJECTION CERTIFICATE/IDENTITY CERTIFICATE’ for obtaining <?php echo $record['pass_ren_visa']?></p></div>
		  </td>
		</tr>
	  </table>
	  <p style = "text-align: right" >Application No : <?php echo $record['psl_no']?></p>
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
				<div><b><font size="-1">Section</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['emp_section']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">4</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Reasons for which he/she intends to obtain Passport/Visa and how he/she proposes to support himself/herself during his/her stay abroad if he/she intents so to do.
				</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['reason_pp']?><br><font size="-1"><?php echo $record['source_fund']?></br></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">5</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Probable stay abroad</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['period_visit']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">6</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Time of Visit</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo get_datepicker_date($record['visit_dt'])?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">7</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Address abroad</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['visit_addr']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">8</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Whether leave has been applied for ?</b></font><br><font size="-1">(Mention the period with date)</font></br></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php if(!empty($record['days_leave'])){echo 'Yes : ';} echo $record['days_leave']?> <br>From <?php echo $record['leave_from']?> To <?php echo $record['leave_to']?></br></font></div>
			  </td>
			</tr>
			
			
			<tr> 
			  <td> 
				<div><b><font size="-1">9</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Passport No</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['passport_no']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">10</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date of expiry of its validity</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo get_datepicker_date($record['pexpiry_dt'])?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">11</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Whether handles cash or secret documents ?</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['cash_doc'] ?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">12</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Whether there is any disciplinary proceedings/Court Case/Vigilance Case pending against him/her?</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['discipl_action']?></font></div>
			  </td>
			</tr>
			
			<tr> 
			  <td> 
				<div><b><font size="-1">13</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Whether visited any foreign country previously?</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['pre_visit']?></font></div>
			  </td>
			</tr>
		</table>
	 <p>&nbsp;</p>
<!-- Page-2 -->
	 <table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Date  : <?php echo get_datepicker_date($record['appli_date'])?> <span><br>
				  <span> Place : Kolkata<?php //echo set_value('decl_place',$decl_place)?> </span></br>
				  <p>&nbsp;</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Name : <?php echo $record['name'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><br>
				  <span>Designation: <?php echo $record['desig'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
     <p>  <?php echo $record['reccomendation']?> for grant of N.O.C as applied for.</p>	
	 <p>&nbsp;</p>
	 <table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Name  : <?php echo $record['bo_nm'] ?> <span><br>
				  <span> Branch Officer : <?php echo $record['bo_desig'] ?></span></br>
				  <p>&nbsp;</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Name : <?php echo $record['dag_name_rev'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><br>
				  <span>Group Officer: <?php echo $record['dag_desig_rev'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>

	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	  <table width="100%" >
		<tr > 
		  <td align="center" style ="line-height: 2; "> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E), WEST BENGAL </p></font></b><font size=""><p align="center">Treasury Buildings :: Kolkata-1</p></font></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">CERTIFICATE</p></div>
		  </td>
		</tr>
	  </table>
    <p>&nbsp;</p>
     <p>Certified that there is no ground to believe that the applicant Shri/Smt. <?php echo $record['name']?> could figure adversely on the security records of the Government.</p>
	 <p>&nbsp;</p>
	 <table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Name  : <?php echo $record['bo_nm']?><span><br>
				  <span> Reporting Officer : <?php echo $record['bo_desig']?></span></br>
				  <p>&nbsp;</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Name : <?php echo $record['dag_name_rev']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><br>
				  <span>Reviewing Officer:  <?php echo $record['dag_desig_rev']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
	 <p>&nbsp;</p>
    <p>Remarks of Disciplinary Seat of Administration-I Section  : &nbsp;&nbsp;<?php echo $record['aao_remrk_dicip']?></p>
	 <p>&nbsp;</p>
	 <table width="100%">
		<tr>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Name : <?php echo $record['aao_name_dicip']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><br>
				  <span>Asstt. Accounts Officer (Admn.I): <?php echo $record['aao_desig_dicip']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
	 <p>&nbsp;</p>
<!--
	 <p align="justify">Remark of Administration-I Section  : &nbsp;&nbsp;<?php echo $record['aao_remrk']?></p>
	 <p>&nbsp;</p>
	 <table width="100%">
		<tr>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Name : <?php echo $record['aao_name']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><br>
				  <span>Asstt. Accounts Officer (Admn.I): <?php echo $record['aao_desig']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
-->
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
<!-- Page-3 -->
	  <table width="100%" >
		<tr > 
		  <td align="center" style ="line-height: 2; "> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E), WEST BENGAL </p></font></b><font size=""><p align="center">Treasury Buildings :: Kolkata-1</p></font></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">Additional Information</p></div>
		  </td>
		</tr>
	  </table>
	  <table width="100%" align="center">
			<tr> 
			  <td style ="border: none" > 
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">1</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Father's name</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['f_name']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">2</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Status (whether temporary or permanent)</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['emp_type']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">3</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Family members</font></b></div>
			  </td>
			  <td> 
				<div>
					<table width="100%"  align="center" style ="font-size:11px;" >
						 <thead>
							<tr>
							   <th style="border: none; text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Sl No:</th>
							   <th style="border: none;  text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Name </th>
							   <th style="border: none;  text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Date of Birth</th>
							   <th style="border: none; text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Relation</th>
							</tr>
						 </thead>
						  <tbody> 
						  <?php
								 if(!empty($members)){
									$sl = 1;
									foreach($members as $member){
									 ?>
						  <tr> 
							<td style ="border: none"> 
							  <?php echo $sl++ ?>
							</td>
							<td style ="border: none"> 
							  <?php echo strtoupper($member['member_name'])?>
							</td>
							<td style ="border: none"> 
							  <?php echo get_datepicker_date($member['member_dob'])?>
							</td>
							<td style ="border: none"> 
							  <?php echo strtoupper($member['family_relation'])?>
							</td>
						  </tr>
						  <?php	}
										}else{
											echo '<tr><td colspan="4">Nil</td></tr>';
										}
								?>
						  </tbody> 
					</table>
				</div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">4</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Identity Card No.</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['id_card_no']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">5</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Date of appointment (in this office)</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['doj']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">6</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Passport size photographs – 2 copies (only for Passport)</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php //echo $record['pic']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">7</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Contact No</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['mbno'] ?></font></div>
			  </td>
			</tr>
	  </table>
	  <p align="left">&nbsp;</p>
	  <p align="left">&nbsp;</p>
	  <p align="left">&nbsp;</p>
	  <table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Date  : <?php echo get_datepicker_date($record['appli_date'])?> <span><br>
				  <span> Place : Kolkata<?php //echo set_value('decl_place',$decl_place)?> </span></br>
				  <p>&nbsp;</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Name : <?php echo $record['name']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><br>
				  <span>Designation:  <?php echo $record['desig'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
	 <p>&nbsp;</p>
	 <p>Documents to be submitted :-</p>
	 <p align="justify">1. Xerox copy of Photo Identity Proof of dependent family members i.e. Aadhaar Card/ Voter Identity Card/ etc. should be attached (for applying passport) </p>
	 <p align="justify">2. Xerox copy of Passport should be attached (for applying VISA).</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	  
<!-- Page-4 

<p style = "page-break-before: always;">&nbsp;</p>   -->
	  <table width="100%" >
		<tr > 
		  <td align="center" style ="line-height: 2; "> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E), WEST BENGAL </p></font></b><font size=""><p align="center">Treasury Buildings :: Kolkata-1</p></font></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">ANNEXURE ‘E’</p></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">DECLARATION OF THE APPLICANT</p></div>
		  </td>
		</tr>
	  </table>
	 <p align="justify">I, <?php echo $record['name']?>, son/daughter/wife of Shri <?php echo $record['f_name']?> residing at <?php echo $record['res_address']?> date of birth <?php echo get_datepicker_date($record['dob'])?> being an applicant for issue of passport, do hereby solemnly affirm and state the following:</p>
	 <p align="justify">1.	That the names of my parents and spouse are as follows:</p>
		<table  width="100%"  align="center" style ="font-size:11px;" >
		 <thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Sl No:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Name </th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Father's Name</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Mother's Name</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Spouse's Name</th>
			</tr>
         </thead>

			<?php
				 if(!empty($wives_husb)){
					$sl = 1;
					foreach($wives_husb as $wife){
					 ?>
          <tr> 
            <td> 
              <?php echo $sl++ ?>
            </td>
            <td> 
				<?php echo $record['name']?>
              <?php //echo strtoupper($wife['member_name'])?>
            </td>
			<td> 
			   <?php echo $record['f_name']?>
               <?php //echo strtoupper($wife['memb_fname'])?>
            </td>
			<td> 
			  <?php echo $record['m_name']?>
              <?php //echo strtoupper($wife['memb_mname'])?>
            </td>
			<td> 
			  <?php echo strtoupper($wife['member_name'])?>
            </td>
          </tr>
          <?php	}
						}else{
							//echo '<tr><td colspan="4">Nil</td></tr>';
						}
				?>
          </tbody> 
	    </table>
<!--
		<table width="100%"  align="center" style ="font-size:11px;">
		<tbody> 
		  <tr> 
            <td> 
              <?php //echo '#' ?>
            </td>
            <td> 
              <?php ///echo $record['name']?>
            </td>
			<td> 
               <?php //echo $record['f_name']?>
            </td>
			<td> 
              <?php //echo $record['m_name']?>
            </td>
          </tr>
		 </table>
-->
	 <p align="justify" style = "font-size:13px; font-family:arial; ">2.	That I am a continuous resident at the above mentioned address from <?php echo $record['res_address']?>.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">3.	That I am a citizen of India by birth/descent/registration/naturalization and that I have neither acquired the citizenship of another country nor have surrendered or been terminated/deprived of my citizenship of India.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">4.	That I have not, at any time during the period of five years immediately preceding the date of this declaration, been convicted by any court in India for any offence involving moral turpitude, nor sentenced in respect thereof to imprisonment for not less than two years.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">5.	That no proceedings in respect of any criminal offence alleged to have been committed by me are pending before any criminal court in India.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">6.	That no warrant or summons for my appearance, and no warrant for my arrest, has been issued by a court under any law for the time being in force, and that my departure from India has not been prohibited by order of any such court.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">7.	That I have never been repatriated from abroad back to India at the expense of Government of India/I was repatriated from abroad back to India at the expense of Government of India, but reimbursed expenditure incurred in connection with such repatriation.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">8.	That I will not engage in activities prejudicial to the sovereignty and integrity of India.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">9.	That my departure from India will not be detrimental to the security of India.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">10.	That my presence outside India will not prejudice the friendly relations of India with any foreign country.</p>
	  <p align="left">&nbsp;</p>
	  <table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Date  : <?php echo get_datepicker_date($record['appli_date'])?> <span><br>
				  <span> Place : Kolkata<?php //echo set_value('decl_place',$decl_place)?> </span></br>
				  <p>&nbsp;</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Signature of the Employee &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><br>
				  <span>Name : <?php echo $record['name'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span></br><br>
				  <span>Designation:  <?php echo $record['desig'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
<!-- Page-5 -->	    
	  <table width="100%" >
		<tr > 
		  <td align="center" style ="line-height: 2; "> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E), WEST BENGAL </p></font></b><font size=""><p align="center">Treasury Buildings :: Kolkata-1</p></font></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">ANNEXURE ‘E’</p></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">DECLARATION OF THE APPLICANT</p></div>
		  </td>
		</tr>
	  </table>
	 <p align="justify">I, <?php echo $wife_hus['member_name']?>, son/daughter/wife of Shri <?php echo $wife_hus['memb_fname']?> residing at <?php echo $record['res_address']?> date of birth <?php echo get_datepicker_date($wife_hus['member_dob'])?> being an applicant for issue of passport, do hereby solemnly affirm and state the following:</p>
	 <p align="justify">1.	That the names of my parents and spouse are as follows:</p>
		<table  width="100%"  align="center" style ="font-size:11px;" >
		 <thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Sl No:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Name </th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Father's Name</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Mother's Name</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Spouse's Name</th>
			</tr>
         </thead>
			<?php
				 if(!empty($wives_husb)){
					$sl = 1;
					foreach($wives_husb as $wife){
					 ?>
          <tr> 
            <td> 
              <?php echo $sl++ ?>
            </td>
            <td> 
              <?php echo strtoupper($wife['member_name'])?>
            </td>
			<td> 
               <?php echo strtoupper($wife['memb_fname'])?>
            </td>
			<td> 
              <?php echo strtoupper($wife['memb_mname'])?>
            </td>
			<td> 
               <?php echo $record['name']?>
            </td>
          </tr>
          <?php	}
						}else{
							//echo '<tr><td colspan="4">Nil</td></tr>';
						}
				?>
          </tbody> 
	    </table>
<!--
		<table width="100%"  align="center" style ="font-size:11px;">
		<tbody> 
		  <tr> 
            <td> 
              <?php echo '#' ?>
            </td>
            <td> 
              <?php echo $record['name']?>
            </td>
			<td> 
               <?php echo $record['f_name']?>
            </td>
			<td> 
              <?php echo $record['m_name']?>
            </td>
          </tr>
		 </table>
-->
	 <p align="justify" style = "font-size:13px; font-family:arial; ">2.	That I am a continuous resident at the above mentioned address from <?php echo $record['res_address']?>.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">3.	That I am a citizen of India by birth/descent/registration/naturalization and that I have neither acquired the citizenship of another country nor have surrendered or been terminated/deprived of my citizenship of India.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">4.	That I have not, at any time during the period of five years immediately preceding the date of this declaration, been convicted by any court in India for any offence involving moral turpitude, nor sentenced in respect thereof to imprisonment for not less than two years.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">5.	That no proceedings in respect of any criminal offence alleged to have been committed by me are pending before any criminal court in India.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">6.	That no warrant or summons for my appearance, and no warrant for my arrest, has been issued by a court under any law for the time being in force, and that my departure from India has not been prohibited by order of any such court.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">7.	That I have never been repatriated from abroad back to India at the expense of Government of India/I was repatriated from abroad back to India at the expense of Government of India, but reimbursed expenditure incurred in connection with such repatriation.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">8.	That I will not engage in activities prejudicial to the sovereignty and integrity of India.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">9.	That my departure from India will not be detrimental to the security of India.</p>
	 <p align="justify" style = "font-size:13px; font-family:arial; ">10.	That my presence outside India will not prejudice the friendly relations of India with any foreign country.</p>
	  <p align="left">&nbsp;</p>
	  <table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Date  : <?php echo get_datepicker_date($record['appli_date'])?> <span><br>
				  <span> Place : Kolkata<?php //echo set_value('decl_place',$decl_place)?> </span></br>
				  <p>&nbsp;</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Signature of the Applicant &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><br>
				  <span>Name : <?php echo $record['name'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span></br><br>
				  <span>Designation:  <?php echo $record['desig'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
				  <br><p align="right">&nbsp;</p><p align="right">&nbsp;</p>
				  <span>Signature of the Employee &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span></br>
			 </td>
		</tr>  
	 </table>
<!-- Page-6 -->
	 <p>&nbsp;</p>
	  <table width="100%" >
		<tr > 
		  <td align="center" style ="line-height: 2; "> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E), WEST BENGAL </p></font></b><font size=""><p align="center">Treasury Buildings :: Kolkata-1</p></font></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">ANNEXURE ‘D’</p></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><font size="-1"><p align="center">DECLARATION BY APPLICANT’S PARENT(S) OR GUARDIAN FOR ISSUE OF PASSPORT TO MINOR</p></font></div>
		  </td>
		</tr>
	  </table>
	<p>&nbsp;</p>
	 <p align="justify">I/we <?php echo $record['name']?> resident of <?php echo $record['res_address']?> hereby affirm that the particulars given below are 
	 of the monor(s) of whom I/we am/are the parents/guardian.</p>
	 <p>1.	Particulars of minor child :-</p>
	 
		<table  width="100%"  align="center" style ="font-size:11px;" >
		 <thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Sl No:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Name </th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Father's Name</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Mother's Name</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Date of Birth</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Birth Place</th>
			</tr>
         </thead>
          <tbody> 
          <?php
				 if(!empty($minors)){
					$sl = 1;
					foreach($minors as $minor){
					 ?>
          <tr> 
            <td> 
              <?php echo $sl++ ?>
            </td>
            <td> 
			  <?php echo strtoupper($minor['minor_name'])?>
            </td>
			<td> 
			  <?php echo $record['name']?>
            </td>
			<td> 
              <?php echo $wife_hus['member_name']?>
            </td>
			<td> 
              <?php echo get_datepicker_date($minor['minor_dob'])?>
            </td>
			<td> 
              <?php echo $minor['minor_pbrith']?>
            </td>
          </tr>
          <?php	}
						}else{
							echo '<tr><td colspan="6">Nil</td></tr>';
						}
				?>
          </tbody> 
	    </table>
	 
	
	 <p align="justify">2.	The minor child mentioned above is a citizen of India.</p>
	 <p align="justify">3.	I/We undertake the entire responsibility for his/her expenses.</p>
	 <p align="justify">4.	I/We solemnly declare that he/she has not lost, surrendered or been deprived of his/her citizenship of India and that the information given in respect of him/her in this application is true.</p>
	 <p align="justify">5.	It is also certified that I/we am/are holding/not holding valid India passport(s).</p>
	 <p align="left">&nbsp;</p>
	 <p align="left" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;">
	 <span> Date  : <?php echo get_datepicker_date($record['appli_date'])?> <span><br>
	 <span> Place : Kolkata<?php //echo set_value('decl_place',$decl_place)?> </span></br></p>
	  <table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  
				  <p>&nbsp;</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Employee's Name : <?php echo $record['name']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
				  <br><span>Passport No :  <?php echo $record['passport_no'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
				  <br><span>Aadhaar Card No:  <?php echo $record['adh_card_no']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
				  <br><span>Voter ID Card No:  <?php echo $record['v_card_no']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Husband's/Wife's Name : <?php echo $wife_hus['member_name']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
				  <br><span>Passport No :  <?php echo $wife_hus['member_pp_no'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
				  <br><span>Aadhaar Card No:  <?php echo $wife_hus['member_acard_no']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
				  <br><span>Voter ID Card No:  <?php echo $wife_hus['member_vcard_no']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
	 <p>&nbsp;</p>
<!-- Page-7 -->
	  <table width="100%" >
		<tr > 
		  <td align="center" style ="line-height: 2; "> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E), WEST BENGAL </p></font></b><font size=""><p align="center">Treasury Buildings :: Kolkata-1</p></font></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><p align="center">P R O F O R M A</p></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center" style ="line-height: 2; "> 
			<div ><font size="-1"><p align="center">(See O.M. No.11013/7/2004-Estt.(A) dated 5th October, 2004 and dated 15th December, 2004)</p></font></div>
		  </td>
		</tr>
	  </table>
    <p></p>
	  <table width="100%" align="center">
			<tr> 
			  <td style ="border: none" > 
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
				<div><b><font size="-1">Basic Pay</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['basic_pay']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">4</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Ministry/Department (Specify Central/State/PSU)</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['office_nm']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">5</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Passport No</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['passport_no']?></font></div>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">6</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Details of private foreign travel to be undertaken</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['desig']?></font></div>
			  </td>
			</tr>
	  </table>
	  <table  width="100%"  align="center" style ="font-size:11px;" >
          <thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Sl No:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Period of abroad </th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Names of Foreign Countries to be visited</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Purpose</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Estimated Expenditure (Travel, board/lodging visa, misc. etc.)</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Source of funds</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Remarks</th>
			</tr>
         </thead>
		  <tbody> 
          <?php
				 if(!empty($fvigits)){
					$sl = 1;
					foreach($fvigits as $visit){
					 ?>
          <tr> 
            <td> 
              <?php echo $sl++ ?>
            </td>
            <td> 
              <?php echo strtoupper($visit['visit_fm'])?> To <?php echo strtoupper($visit['visit_to'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['f_country'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['visit_purpose'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['est_expnd'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['source_fnd'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['emp_rmk'])?>
            </td>
          </tr>
          <?php	}
						}else{
							echo '<tr><td colspan="7">Nil</td></tr>';
						}
				?>
          </tbody> 
	  </table>
	  <table width="100%" align="center">
			<tr> 
			  <td style ="border: none" > 
				<p>&nbsp;</p>
			  </td>
			</tr>
			<tr> 
			  <td> 
				<div><b><font size="-1">7</font></b></div>
			  </td>
			  <td> 
				<div><b><font size="-1">Details of previous private foreign travel, if any undertaken during the last four years (as under item No.6)</font></b></div>
			  </td>
			  <td> 
				<div><font size="-1"><?php echo $record['name']?></font></div>
			  </td>
			</tr>
		</table>	  
	  <table  width="100%"  align="center" style ="font-size:11px;" >
          <thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Sl No:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Period of abroad </th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Names of Foreign Countries to be visited</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Purpose</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Estimated Expenditure (Travel, board/lodging visa, misc. etc.)</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Source of funds</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Remarks</th>
			</tr>
         </thead>
		  <tbody> 
          <?php
				 if(!empty($pvigits)){
					$sl = 1;
					foreach($pvigits as $visit){
					 ?>
          <tr> 
            <td> 
              <?php echo $sl++ ?>
            </td>
            <td> 
              <?php echo strtoupper($visit['visit_fm'])?> To <?php echo strtoupper($visit['visit_to'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['f_country'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['visit_purpose'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['est_expnd'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['source_fnd'])?>
            </td>
			<td> 
              <?php echo strtoupper($visit['emp_rmk'])?>
            </td>
          </tr>
          <?php	}
						}else{
							echo '<tr><td colspan="7">Nil</td></tr>';
						}
				?>
          </tbody> 
	  </table>
	  <p align="left">&nbsp;</p>
	  <table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Date  : <?php echo get_datepicker_date($record['appli_date'])?> <span><br>
				  <span> Place : Kolkata<?php //echo set_value('decl_place',$decl_place)?> </span></br>
				  <p>&nbsp;</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span>Name : <?php echo $record['name']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
				  <br><span>Passport No :  <?php echo $record['passport_no'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
				  <br><span>Aadhaar Card No:  <?php echo $record['adh_card_no'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
				  <br><span>Voter ID Card No:  <?php echo $record['v_card_no'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
	  <p>&nbsp; **Please do not take any print out unless it is absolutely necessary</p>

    </div>
</form>
</div>