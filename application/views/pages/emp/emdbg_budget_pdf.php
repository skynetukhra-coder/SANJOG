<style>
table1, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px; font-size:12px;
}
th {
  text-align: left;
}
</style>
<?php
$alot_cons_amt = isset($alot_cons['alot_cons_amt']) ? $alot_cons['alot_cons_amt'] : '0';
$cons_amt = isset($cons['cons_amt']) ? $cons['cons_amt'] : '0';
$alot_amc_amt = isset($alot_amc['alot_amc_amt']) ? $alot_amc['alot_amc_amt'] : '0';
$amc_amt = isset($amc['amc_amt']) ? $amc['amc_amt'] : '0';
$alot_hw_amt = isset($alot_hware['alot_hw_amt']) ? $alot_hware['alot_hw_amt'] : '0';
$hw_amt = isset($hware['hw_amt']) ? $hware['hw_amt'] : '0';
$alot_sw_amt = isset($alot_sware['alot_sw_amt']) ? $alot_sware['alot_sw_amt'] : '0';
$sw_amt = isset($sware['sw_amt']) ? $sware['sw_amt'] : '0';
$alot_oth_amt = isset($alot_other['alot_oth_amt']) ? $alot_other['alot_oth_amt'] : '0';
$oth_amt = isset($other['oth_amt']) ? $other['oth_amt'] : '0';
$alot_sms_amt = isset($alot_sms['alot_sms_amt']) ? $alot_sms['alot_sms_amt'] : '0';
$sms_amt = isset($sms['sms_amt']) ? $sms['sms_amt'] : '0';
$alot_oios_amt = isset($alot_oios['alot_oios_amt']) ? $alot_oios['alot_oios_amt'] : '0';
$oios_amt = isset($oios['oios_amt']) ? $oios['oios_amt'] : '0';
$alot_furni_amt = isset($alot_furni['alot_furni_amt']) ? $alot_furni['alot_furni_amt'] : '0';
$furni_amt = isset($furni['furni_amt']) ? $furni['furni_amt'] : '0';
$alot_machi_amt = isset($alot_machi['alot_machi_amt']) ? $alot_machi['alot_machi_amt'] : '0';
$machi_amt = isset($machi['machi_amt']) ? $machi['machi_amt'] : '0';
?>

<div>
<form bgcolor="#FFFFFF" text="#000000"> 
	<div class "">
	  <table width="100%" align="center">
		<tr> 
		  <td align="center" style ="line-height: 2"> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E), WEST BENGAL </p></font></b></div>
		  </td>
		</tr>
		<tr> 
		  <td align="center"> 
            <div><b><font color="#000000" size="-1"><p align="center">Budget Allotment and Expenditure(AS on <?php echo date('d-m-Y')?>) </p></font></b></div>
		  </td>
		</tr>
	</table>
	<table width="100%" align="center">	
		<thead>
							<tr style="text-align:center">
								<th style="text-align:center">*</th>
								<th style="text-align:center">Consumables</th>
								<th style="text-align:center">AMC</th>
								<th style="text-align:center">Hardware</th>
								<th style="text-align:center">Software</th>
								<th style="text-align:center">Others</th>
								<th style="text-align:center">SMS</th>
								<th style="text-align:center">OIOS</th>
								<th style="text-align:center">Furniture</th>
								<th style="text-align:center">Machinary</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Allotment</td>
								<td><?php echo $alot_cons_amt; ?></td>
								<td><?php echo $alot_amc_amt;  ?></td>
								<td><?php echo $alot_hw_amt;  ?></td>
								<td><?php echo $alot_sw_amt;  ?></td>
								<td><?php echo $alot_oth_amt; ?></td>
								<td><?php echo $alot_sms_amt; ?></td>
								<td><?php echo $alot_oios_amt;  ?></td>
								<td><?php echo $alot_furni_amt;  ?></td>
								<td><?php echo $alot_machi_amt;  ?></td>
							</tr>
							<tr>
								<td>Expenditure</td>
								<td><?php echo $cons_amt; ?></td>
								<td><?php echo $amc_amt;  ?></td>
								<td><?php echo $hw_amt;  ?></td>
								<td><?php echo $sw_amt;  ?></td>
								<td><?php echo $oth_amt; ?></td>
								<td><?php echo $sms_amt; ?></td>
								<td><?php echo $oios_amt;  ?></td>
								<td><?php echo $furni_amt;  ?></td>
								<td><?php echo $machi_amt;  ?></td>
							</tr>
							<tr>
								<td> Balance</td>
								<td><?php echo ($alot_cons_amt - $cons_amt); ?></td>
								<td><?php echo ($alot_amc_amt - $amc_amt); ?></td>
								<td><?php echo ($alot_hw_amt - $hw_amt); ?></td>
								<td><?php echo ($alot_sw_amt - $sw_amt); ?></td>
								<td><?php echo ($alot_oth_amt - $oth_amt); ?></td>
								<td><?php echo ($alot_sms_amt - $sms_amt); ?></td>
								<td><?php echo ($alot_oios_amt - $oios_amt); ?></td>
								<td><?php echo ($alot_furni_amt - $furni_amt); ?></td>
								<td><?php echo ($alot_machi_amt - $machi_amt); ?></td>
							</tr>
						</tbody>
	</table>
	<table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Date  :<?php echo get_datepicker_date(date('d-m-Y '))?> <span><br>
				  <span> Place :<?php echo 'Kolkata' ?> </span></br>
			</td>
		</tr>  
	 </table>
	</div>
</form>
</div>