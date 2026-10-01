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
$comp_no = isset($row['comp_no']) ? $row['comp_no'] : '';
$item = isset($row['item']) ? $row['item'] : '';
$brand = isset($row['brand']) ? $row['brand'] : '';
$descp = isset($row['descp']) ? $row['descp'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$mach_no = isset($row['mach_no']) ? $row['mach_no'] : '';
$remk = isset($row['remk']) ? $row['remk'] : '';
$vendor = isset($row['vendor']) ? $row['vendor'] : '';
$out_date = isset($row['out_date']) ? $row['out_date'] : '';
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
            <div><b><font color="#000000" size="-1"><p align="center">List of Pending Hardware Items (AS on <?php echo date('d-m-Y')?>) </p></font></b></div>
		  </td>
		</tr>
	</table>
	<table width="100%" align="center">	
		<thead>
            <tr>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Sl No:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Complaint No:</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Item No / Brand:</th>
               <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Manchine NO:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Description:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Section:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Vendor / Date:</th>
			   <th style=" text-align: left; background:#ebebe0; font-size:10px; font-family:arial;letter-spacing:1px;">Remark :</th>
			</tr>
         </thead>
         <tbody>
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
              <?php echo ($row['comp_no'])?>
            </td>
			<td> 
               <?php echo ($row['item'])?><br><?php echo ($row['brand'])?></br>
            </td>
			<td> 
              <?php echo ($row['mach_no'])?>
            </td>
			<td> 
              <?php echo ($row['descp'])?>
            </td>
			<td> 
              <?php echo ($row['section'])?>
            </td>
			<td> 
              <?php echo $row['vendor']?><br><?php echo get_datepicker_date($row['out_date'])?></br>
            </td>
			<td> 
              <?php echo ($row['remk'])?>
            </td>
          </tr>
            <?php	}
				}else{
					echo '<tr><td colspan="8">No records found!</td></tr>';
				}
			?>
          </tbody> 
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