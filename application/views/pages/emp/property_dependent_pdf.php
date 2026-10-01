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
$pst_year = isset($row['pst_year']) ? $row['pst_year'] : '';
$pst_as_on = isset($row['pst_as_on']) ? $row['pst_as_on'] : '';
$emp_name = isset($row['emp_name']) ? $row['emp_name'] : '';
$emp_desig = isset($row['emp_desig']) ? $row['emp_desig'] : '';
$b_pay = isset($row['b_pay']) ? $row['b_pay'] : '';
$decl_date = isset($row['decl_date']) ? $row['decl_date'] : '';
$decl_place = isset($row['decl_place']) ? $row['decl_place'] : '';
$proty_location_1 = isset($row['proty_location_1']) ? $row['proty_location_1'] : '';
$proty_detail_1 = isset($row['proty_detail_1']) ? $row['proty_detail_1'] : '';
$prsnt_value_1 = isset($row['prsnt_value_1']) ? $row['prsnt_value_1'] : '';
$proty_owner_1 = isset($row['proty_owner_1']) ? $row['proty_owner_1'] : '';
$mode_acquin_1 = isset($row['mode_acquin_1']) ? $row['mode_acquin_1'] : '';
$income_proty_1 = isset($row['income_proty_1']) ? $row['income_proty_1'] : '';
$remark_1 = isset($row['remark_1']) ? $row['remark_1'] : '';
$proty_location_2 = isset($row['proty_location_2']) ? $row['proty_location_2'] : '';
$proty_detail_2 = isset($row['proty_detail_2']) ? $row['proty_detail_2'] : '';
$prsnt_value_2 = isset($row['prsnt_value_2']) ? $row['prsnt_value_2'] : '';
$proty_owner_2 = isset($row['proty_owner_2']) ? $row['proty_owner_2'] : '';
$mode_acquin_2 = isset($row['mode_acquin_2']) ? $row['mode_acquin_2'] : '';
$income_proty_2 = isset($row['income_proty_2']) ? $row['income_proty_2'] : '';
$remark_2 = isset($row['remark_2']) ? $row['remark_2'] : '';
$proty_location_3 = isset($row['proty_location_3']) ? $row['proty_location_3'] : '';
$proty_detail_3 = isset($row['proty_detail_3']) ? $row['proty_detail_3'] : '';
$prsnt_value_3 = isset($row['prsnt_value_3']) ? $row['prsnt_value_3'] : '';
$proty_owner_3 = isset($row['proty_owner_3']) ? $row['proty_owner_3'] : '';
$mode_acquin_3 = isset($row['mode_acquin_3']) ? $row['mode_acquin_3'] : '';
$income_proty_3 = isset($row['income_proty_3']) ? $row['income_proty_3'] : '';
$remark_3 = isset($row['remark_3']) ? $row['remark_3'] : '';
$proty_location_4 = isset($row['proty_location_4']) ? $row['proty_location_4'] : '';
$proty_detail_4 = isset($row['proty_detail_4']) ? $row['proty_detail_4'] : '';
$prsnt_value_4 = isset($row['prsnt_value_4']) ? $row['prsnt_value_4'] : '';
$proty_owner_4 = isset($row['proty_owner_4']) ? $row['proty_owner_4'] : '';
$mode_acquin_4 = isset($row['mode_acquin_4']) ? $row['mode_acquin_4'] : '';
$income_proty_4 = isset($row['income_proty_4']) ? $row['income_proty_4'] : '';
$remark_4 = isset($row['remark_4']) ? $row['remark_4'] : '';
$proty_location_5 = isset($row['proty_location_5']) ? $row['proty_location_5'] : '';
$proty_detail_5 = isset($row['proty_detail_5']) ? $row['proty_detail_5'] : '';
$prsnt_value_5 = isset($row['prsnt_value_5']) ? $row['prsnt_value_5'] : '';
$proty_owner_5 = isset($row['proty_owner_5']) ? $row['proty_owner_5'] : '';
$mode_acquin_5 = isset($row['mode_acquin_5']) ? $row['mode_acquin_5'] : '';
$income_proty_5 = isset($row['income_proty_5']) ? $row['income_proty_5'] : '';
$remark_5 = isset($row['remark_5']) ? $row['remark_5'] : '';
$proty_location_6 = isset($row['proty_location_6']) ? $row['proty_location_6'] : '';
$proty_detail_6 = isset($row['proty_detail_6']) ? $row['proty_detail_6'] : '';
$prsnt_value_6 = isset($row['prsnt_value_6']) ? $row['prsnt_value_6'] : '';
$proty_owner_6 = isset($row['proty_owner_6']) ? $row['proty_owner_6'] : '';
$mode_acquin_6 = isset($row['mode_acquin_6']) ? $row['mode_acquin_6'] : '';
$income_proty_6 = isset($row['income_proty_6']) ? $row['income_proty_6'] : '';
$remark_6 = isset($row['remark_6']) ? $row['remark_6'] : '';
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
		<tr style ="font-size:16px;">
		  <td align="center"> FORM -1 (DEPENDENTS)</td>
		</tr>
		<tr> 
		  <td align="center"> 
            <div><b><font color="#000000" size="-1"><p align="center">STATEMENT OF IMMOVABLE PROPERTY MADE OUT OF FUNDS (INCLUDING SHRIDHAN,GIFT, INHERITANCE ETC.) FOR THE YEAR <?php echo set_value('pst_year',$pst_year)?> (AS on <?php echo set_value('pst_as_on',$pst_as_on)?>) </p></font></b></div>
		  </td>
		</tr>
	</table>
	<table width="100%" align="center">
		<tr> 
		  <td align="left"> 
			<div ><p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>Name :</b><?php echo set_value('emp_name',$emp_name)?> </p></div>
		  </td>
		  <td align="left"> 
			<div ><p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>Present Post held :</b><?php echo set_value('emp_desig',$emp_desig)?> </p></div>
		  </td>
		  <td align="left"> 
			<div ><p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>Present Pay : </b>Rs. <?php echo set_value('b_pay',$b_pay)?>/- </p></div>
		  </td>
		</tr>
	</table>
	<table width="100%" align="center">	
		<thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Sl No:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Name of District,Sub-division, Taluk & Villlage in which property is situated:</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Name & Details of property, Housing Lands and Other Buildings:</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Present Value (Approx):</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">If not in own name, state in whose name held and his/ her relationship to the Govt. Servant:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">How accquired,whether by purchase, Lease, Mortgage, Gift, Inheritance or otherwise with date of aquisition & with details of person from whom acquired:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Annual Income from property:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Remark :</th>
			</tr>
         </thead>
         <tbody>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b> 1)</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b><?php echo set_value('proty_location_1',$proty_location_1)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_detail_1',$proty_detail_1)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b> </b>Rs. <?php echo set_value('prsnt_value_1',$prsnt_value_1)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_owner_1',$proty_owner_1)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('mode_acquin_1',$mode_acquin_1)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b>Rs. <?php echo set_value('income_proty_1',$income_proty_1)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('remark_1',$remark_1)?> </p>
				</td>
			</tr>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b>2)</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b><?php echo set_value('proty_location_2',$proty_location_2)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_detail_2',$proty_detail_2)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b> </b>Rs. <?php echo set_value('prsnt_value_2',$prsnt_value_2)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_owner_2',$proty_owner_2)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('mode_acquin_1',$mode_acquin_2)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b>Rs. <?php echo set_value('income_proty_2',$income_proty_2)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('remark_2',$remark_2)?></p>
				</td>
			</tr>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b>3)</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b><?php echo set_value('proty_location_3',$proty_location_3)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_detail_3',$proty_detail_3)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b> </b>Rs. <?php echo set_value('prsnt_value_3',$prsnt_value_3)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_owner_3',$proty_owner_3)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('mode_acquin_3',$mode_acquin_3)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b>Rs. <?php echo set_value('income_proty_3',$income_proty_3)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('remark_3',$remark_3)?> </p>
				</td>
			</tr>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b>4)</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b><?php echo set_value('proty_location_4',$proty_location_4)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_detail_4',$proty_detail_4)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b> </b>Rs. <?php echo set_value('prsnt_value_4',$prsnt_value_4)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_owner_4',$proty_owner_4)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('mode_acquin_4',$mode_acquin_4)?> </p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b>Rs. <?php echo set_value('income_proty_4',$income_proty_4)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('remark_4',$remark_4)?></p>
				</td>
			</tr>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b>5)</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b><?php echo set_value('proty_location_5',$proty_location_5)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_detail_5',$proty_detail_5)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b> </b>Rs. <?php echo set_value('prsnt_value_5',$prsnt_value_5)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_owner_5',$proty_owner_5)?> </p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('mode_acquin_5',$mode_acquin_5)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b>Rs. <?php echo set_value('income_proty_5',$income_proty_5)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('remark_5',$remark_5)?></p>
				</td>
			</tr>
			<tr align="justify"> 
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b>6)</p>
				</td>
				<td align="left"> 
					<p  style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b>  </b><?php echo set_value('proty_location_6',$proty_location_6)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_detail_6',$proty_detail_6)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b> </b>Rs. <?php echo set_value('prsnt_value_6',$prsnt_value_6)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('proty_owner_6',$proty_owner_6)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('mode_acquin_6',$mode_acquin_6)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b>Rs. <?php echo set_value('income_proty_6',$income_proty_6)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:10px; font-family:arial;letter-spacing:1px;"><b></b><?php echo set_value('remark_6',$remark_6)?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Date  :<?php echo get_datepicker_date(set_value('decl_date',$decl_date))?> <span><br>
				  <span> Place :<?php echo set_value('decl_place',$decl_place)?> </span></br>
				  <p>&nbsp;</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span><?php echo set_value('emp_name',$emp_name)?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><br>
				  <span> <?php echo set_value('emp_desig',$emp_desig)?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
	</div>
</form>
</div>