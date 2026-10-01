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
$vend_nm = isset($row['vend_nm']) ? $row['vend_nm'] : '';
$bank_nm = isset($row['bank_nm']) ? $row['bank_nm'] : '';
$niq_no = isset($row['niq_no']) ? $row['niq_no'] : '';
$niq_dt = isset($row['niq_dt']) ? $row['niq_dt'] : '';
$amt = isset($row['amt']) ? $row['amt'] : '';
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
            <div><b><font color="#000000" size="-1"><p align="center">List of Bank Guarantees / EMDs</p></font></b></div>
		  </td>
		</tr>
	</table>
	<table width="100%" align="center">	
		<thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Sl No:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Vendor</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Bank</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">NIQ/ NIQ Date</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Amount:</th>
			</tr>
         </thead>
         <tbody> 
          <?php
				 if(!empty($rows)){
					$sl = 1;
					foreach($rows as $row){
					 ?>
          <tr> 
            <td> 
              <?php echo $sl++ ?>
            </td>
            <td> 
              <?php echo ($row['vend_nm'])?>
            </td>
			<td> 
              <?php echo ($row['bank_nm'])?>
            </td>
			<td> 
               <?php echo ($row['niq_no'])?><br><?php echo get_datepicker_date($row['niq_dt'])?></br>
            </td>
			<td> 
              <?php echo ($row['amt'])?>
            </td>
          </tr>
            <?php	}
				}else{
					echo '<tr><td colspan="5">No records found!</td></tr>';
				}
			?> 
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