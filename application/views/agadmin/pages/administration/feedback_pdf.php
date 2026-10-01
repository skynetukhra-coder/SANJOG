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
$feed_id = isset($row['feed_id']) ? $row['feed_id'] : '';
$feed_date = isset($row['feed_date']) ? $row['feed_date'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$mobile = isset($row['mobile']) ? $row['mobile'] : '';
$email = isset($row['email']) ? $row['email'] : '';
$visit_for= isset($row['visit_for']) ? $row['visit_for'] : '';
$office = isset($row['office']) ? $row['office'] : '';
$gpf_no = isset($row['gpf_no']) ? $row['gpf_no'] : '';
$ppo_no_file_id_application_no = isset($row['ppo_no_file_id_application_no']) ? $row['ppo_no_file_id_application_no'] : '';
$details = isset($row['details']) ? $row['details'] : '';
$administration = isset($row['administration']) ? $row['administration'] : '';
$administration_action_required = isset($row['administration_action_required']) ? $row['administration_action_required'] : '';
$administration_action_taken = isset($row['administration_action_taken']) ? $row['administration_action_taken'] : '';
$accounts = isset($row['accounts']) ? $row['accounts'] : '';
$accounts_action_required = isset($row['accounts_action_required']) ? $row['accounts_action_required'] : '';
$accounts_action_taken = isset($row['accounts_action_taken']) ? $row['accounts_action_taken'] : '';
$fund = isset($row['fund']) ? $row['fund'] : '';
$fund_action_required = isset($row['fund_action_required']) ? $row['fund_action_required'] : '';
$fund_action_taken = isset($row['fund_action_taken']) ? $row['fund_action_taken'] : '';
$pension = isset($row['pension']) ? $row['pension'] : '';
$pension_action_required = isset($row['pension_action_required']) ? $row['pension_action_required'] : '';
$pension_action_taken = isset($row['pension_action_taken']) ? $row['pension_action_taken'] : '';
?>

<div>
<form bgcolor="#FFFFFF" text="#000000"> 
	<div class "">
	  <table width="100%" align="center">
		<tr> 
		  <td align="center" style ="line-height: 2"> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL 
			  (A&E), WEST BENGAL </p></font></b></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center"> 
            <div><b><font color="#000000" size="-1"><p align="center">Grievance / Feedback</p></font></b></div>
		  </td>
		</tr>
	</table>

	<table width="100%" align="center">	
		<thead>
            <tr>
               <th style=" text-align: left; background:#d6d6c2; font-size:12px; font-family:arial;letter-spacing:1px;">Description</th>
			   <th style=" text-align: left; background:#d6d6c2; font-size:12px; font-family:arial;letter-spacing:1px;">Information</th>
               
			</tr>
         </thead>
         <tbody>
			<tr align="justify"> 
				<td style=" text-align: left; background:#f5f5f0; font-size:12px; font-family:arial;letter-spacing:1px;">Feedback ID :<br>Date :</br></td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;">
						<?php echo set_value('feed_id',$feed_id)?><br><?php echo get_datepicker_date(set_value('feed_date',$feed_date))?></br>
					</p>
				</td>
			</tr>
			<tr>
				<td style=" text-align: left; background:#f5f5f0; font-size:12px; font-family:arial;letter-spacing:1px;">Name :<br>Mobile :</br><br>Email :</br></td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;">
						<?php echo set_value('name',$name)?><br><?php echo set_value('mobile',$mobile)?></br><br><?php echo set_value('email',$email)?></br>
					</p>
				</td>
			</tr>
			<tr>
				<td style=" text-align: left; background:#f5f5f0; font-size:12px; font-family:arial;letter-spacing:1px;">Visit For :</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;">
						<?php echo set_value('visit_for',$visit_for)?>
					</p>
				</td>
			</tr>
			<tr>
				<td style=" text-align: left; background:#f5f5f0; font-size:12px; font-family:arial;letter-spacing:1px;">GPF No :<br>Pension Application ID:</br></td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;">
						<?php echo set_value('gpf_no',$gpf_no)?>
						<br><?php echo set_value('ppo_no_file_id_application_no',$ppo_no_file_id_application_no)?></br>
					</p>
				</td>
			</tr>
			<tr>
				<td style=" text-align: left; background:#f5f5f0; font-size:12px; font-family:arial;letter-spacing:1px;">Details:</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;">
						<?php echo set_value('details',$details)?>
					</p>
				</td>
			</tr>
			<tr>
				 <td style=" text-align: left; background:#f5f5f0; font-size:12px; font-family:arial;letter-spacing:1px;">Wing Concerned</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;">
						Administration : <?php echo set_value('administration',$administration)?>
						<br>Accounts : <?php echo set_value('accounts',$accounts)?></br>
						<br>Fund : <?php echo set_value('fund',$fund)?></br>
						<br>Pension : <?php echo set_value('pension',$pension)?></br>
					</p>
				</td>
			</tr>
			<tr>
				 <td style=" text-align: left; background:#f5f5f0; font-size:12px; font-family:arial;letter-spacing:1px;">Action to be Taken</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;">
						Administration : <?php echo set_value('administration_action_required',$administration_action_required)?>
						<br>Accounts : <?php echo set_value('accounts_action_required',$accounts_action_required)?></br>
						<br>Fund : <?php echo set_value('fund_action_required',$fund_action_required)?></br>
						<br>Pension : <?php echo set_value('pension_action_required',$pension_action_required)?></br>
					</p>
				</td>
			</tr>
			<tr>
				<td style=" text-align: left; background:#f5f5f0; font-size:12px; font-family:arial;letter-spacing:1px;">Action Taken</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;">
						Administration : <?php echo set_value('administration_action_taken',$administration_action_taken)?>
						<br>Accounts : <?php echo set_value('accounts_action_taken',$accounts_action_taken)?></br>
						<br>Fund : <?php echo set_value('fund_action_taken',$fund_action_taken)?></br>
						<br>Pension : <?php echo set_value('pension_action_taken',$pension_action_taken)?></br>
					</p>
				</td>
			</tr>
			
		</tbody>
	</table>
	</div>
</form>
</div>