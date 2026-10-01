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
$fyear = isset($row['fyear']) ? $row['fyear'] : '';
$series = isset($row['series']) ? $row['series'] : '';
$accode = isset($row['accode']) ? $row['accode'] : '';
$ob_nt = isset($row['ob_nt']) ? $row['ob_nt'] : '';
$dep_nt = isset($row['dep_nt']) ? $row['dep_nt'] : '';
$with_nt = isset($row['with_nt']) ? $row['with_nt'] : '';
$int_nt = isset($row['int_nt']) ? $row['int_nt'] : '';
$cb_nt = isset($row['cb_nt']) ? $row['cb_nt'] : '';
$ob_t = isset($row['ob_t']) ? $row['ob_t'] : '';
$dep_t = isset($row['dep_t']) ? $row['dep_t'] : '';
$with_t = isset($row['with_t']) ? $row['with_t'] : '';
$int_t = isset($row['int_t']) ? $row['int_t'] : '';
$cb_t = isset($row['cb_t']) ? $row['cb_t'] : '';
$tot_ob = isset($row['tot_ob']) ? $row['tot_ob'] : '';
$tot_dep = isset($row['tot_dep']) ? $row['tot_dep'] : '';
$tot_with = isset($row['tot_with']) ? $row['tot_with'] : '';
$tot_int = isset($row['tot_int']) ? $row['tot_int'] : '';
$tot_cb = isset($row['tot_cb']) ? $row['tot_cb'] : '';
$ua_ob = isset($row['ua_ob']) ? $row['ua_ob'] : '';
$ua_dep = isset($row['ua_dep']) ? $row['ua_dep'] : '';
$ua_cb = isset($row['ua_cb']) ? $row['ua_cb'] : '';
$tot_cb_in_wrd = isset($row['tot_cb_in_wrd']) ? $row['tot_cb_in_wrd'] : '';
$ua_cb_in_wrd = isset($row['ua_cb_in_wrd']) ? $row['ua_cb_in_wrd'] : '';
?>

<div>
<form bgcolor="#FFFFFF" text="#000000"> 
	<div class "">
	  <table width="100%" align="center">
		<tr> 
		  <td align="center" style ="line-height: 2"> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL(A&E), WEST BENGAL </p></font></b></div>
			<div ><b><font size="12"><p align="center">G.I. Press Building, 8 K. S. Roy Road, Kolkata-700001</p></font></b></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center"> 
            <div><b><font color="#000000" size="-1"><p align="center">Non-Taxable and Taxable Portion</p></font></b></div>
		  </td>
		</tr>
	</table>
	<table width="100%" align="center">
		<tr> 
		  <td align="left"> 
			<div ><p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b>GPF Account No : </b><?php echo set_value('series',$series)?>/WB/<?php echo set_value('accode',$accode)?> </p></div>
		  </td>
		  <td align="left"> 
			<div ><p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b>Financial Year ending on :</b> <?php echo get_datepicker_date(set_value('fyear',$fyear))?> </p></div>
		  </td>
		</tr>
	</table>
	<table width="100%" align="center">	
		<thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Type</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Opening Balance</th>
               <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Deposit</th>
               <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Withdrawal</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Interest</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Closing Balance</th>
			</tr>
         </thead>
         <tbody>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b>  </b>Non Taxable Portion</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b> </b><?php echo set_value('ob_nt',$ob_nt)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('dep_nt',$dep_nt)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b> </b><?php echo set_value('with_nt',$with_nt)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('int_nt',$int_nt)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('cb_nt',$cb_nt)?></p>
				</td>
			</tr>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b>  </b>Taxable Portion</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b>  </b><?php echo set_value('ob_t',$ob_t)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('dep_t',$dep_t)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b> </b> <?php echo set_value('with_t',$with_t)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('int_t',$int_t)?>*</p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('cb_t',$cb_t)?></p>
				</td>
			</tr>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b>  </b>Total Amount</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b>  </b><?php echo set_value('tot_ob',$tot_ob)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('tot_dep',$tot_dep)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b> </b><?php echo set_value('tot_with',$tot_with)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('tot_int',$tot_int)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('tot_cb',$tot_cb)?></p>
				</td>
			</tr>
			<tr align="justify"> 
				<td align="left" colspan="6" style="font-size:12px"> Rupees in Words : <?php echo set_value('tot_cb_in_wrd',$tot_cb_in_wrd)?>
				</td>
			</tr>
		</tbody>
	</table>
	<table width="100%" align="center">
		<tr> 
		  <td align="center"> 
            <div><b><font color="#000000" size="-1"><p align="center">Unauthorised Portion</p></font></b></div>
		  </td>
		</tr>
	</table>
	<table width="100%" align="center">	
		<thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Type</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Opening Balance</th>
               <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Deposit</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Closing Balance</th>
			</tr>
         </thead>
         <tbody>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b>  </b>Unauthorised</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b> </b><?php echo set_value('ua_ob',$ua_ob)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('ua_dep',$ua_dep)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><b> </b><?php echo set_value('ua_cb',$ua_cb)?></p>
				</td>
			</tr>
			<tr align="justify"> 
				<td align="left" colspan="4" style="font-size:12px"> Rupees in Words : <?php echo set_value('ua_cb_in_wrd',$ua_cb_in_wrd)?>
				</td>
			</tr>
		</tbody>
	</table>
	<div>&nbsp;</div>
	<div class="form-group row"><span style="font-size:13px; ">* Interest on Taxable Subscription only</span></div>
	</div>
</form>
</div>