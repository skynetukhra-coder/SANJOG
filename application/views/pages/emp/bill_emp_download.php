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
$aao_remrk = isset($members['aao_remrk']) ? $members['aao_remrk'] : '';
$aao_dt = isset($members['aao_dt']) ? $members['aao_dt'] : '';
$sao_name = isset($record['sao_name']) ? $record['sao_name'] : '';
$sao_desig = isset($record['sao_desig']) ? $record['sao_desig'] : '';
$sao_remrk = isset($members['sao_remrk']) ? $members['sao_remrk'] : '';
$sao_dt = isset($members['sao_dt']) ? $members['sao_dt'] : '';
$dag_name = isset($record['dag_name']) ? $record['dag_name'] : '';
$dag_desig = isset($record['dag_desig']) ? $record['dag_desig'] : '';
$dag_remrk = isset($members['dag_remrk']) ? $members['dag_remrk'] : '';
$dag_dt = isset($members['dag_dt']) ? $members['dag_dt'] : '';
$pag_name = isset($record['pag_name']) ? $record['pag_name'] : '';
$pag_desig = isset($record['pag_desig']) ? $record['pag_desig'] : '';
$pag_remrk = isset($members['pag_remrk']) ? $members['pag_remrk'] : '';
$pag_dt = isset($members['pag_dt']) ? $members['pag_dt'] : '';
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
			<div ><p align="center"> Bill for Payment </p></div>
		  </td>
		</tr>
	  </table>
	   <div align="center">
        <table  width="100%"  align="center" style ="font-size:10px;" >
          <thead>
				<tr style="text-align:center">
					<th style="text-align:center">Sl No</th>
					<th style="text-align:center">Bill No</th>
					<th style="text-align:center">Description</th>
					<th style="text-align:center">Bill Amount</th> 
					<th style="text-align:center">Tax Deduction</th>					
					<th style="text-align:center">Amount Payable</th>
					<th style="text-align:center">Adv Bill No</th>
					<th style="text-align:center">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(!empty($records)){
						$sl = 1;
						foreach($records as $bills){?>
						<tr>
							<td><?php echo $sl++ ?></td>
							<td><?php echo $bills['name'] ?></td>
							<td><?php echo $bills['desig'] ?></td>
							<td><?php echo $bills['bill_amount'] ?></td>
							<td><?php echo $bills['tax_deduct_amt'] ?></td>
							<td><?php echo $bills['amount_paid']?></td>
							<td><?php echo $bills['advance_bill_no']?></td>
							<td><?php echo $bills['appli_status']?></td>
						</tr>
						<?php	}
							}else{
								echo '<tr><td colspan="9">No Record found!</td></tr>';
							}
				?>
			</tbody>
        </table>
      </div>
	 <p>&nbsp;</p><p>&nbsp;</p>
	  <p style = "text-align: left">
	  <span>Name : <?php //echo strtoupper($record['pag_name'])?> 
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <span>
	  <span> Desig: <?php // strtoupper($record['pag_desig'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </span>
	  <span>Date : <?php //echo strtoupper($record['pag_dt'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	  <p>&nbsp;</p>
	  <p align="left">&nbsp;
	  **Please do not take any print out unless it is absolutely necessary</p>

    </div>
</form>
</div>