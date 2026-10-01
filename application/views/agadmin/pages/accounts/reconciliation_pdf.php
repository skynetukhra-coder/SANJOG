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
$dept_cd = isset($row['dept_cd']) ? $row['dept_cd'] : '';
$grnt_d = isset($dept['grnt_d']) ? $dept['grnt_d'] : '';
$order_type = isset($row['order_type']) ? $row['order_type'] : '';
$dyear = isset($row['dyear']) ? $row['dyear'] : '';
$dept_remark = isset($row['dept_remark']) ? $row['dept_remark'] : '';
$action_status = isset($row['action_status']) ? $row['action_status'] : '';
$dept_official_name = isset($row['dept_official_name']) ? $row['dept_official_name'] : '';
$dept_official_desig = isset($row['dept_official_desig']) ? $row['dept_official_desig'] : '';
$dept_date = isset($row['dept_date']) ? $row['dept_date'] : '';
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
		  <td align="center"> Certificate of Reconciliation</td>
		</tr>
		<tr> 
		  <td align="center"> 
            <div><b><font color="#000000" size="4"><p align="center"><?php echo set_value('grnt_d',$grnt_d)?> [<?php echo set_value('dept_cd',$dept_cd)?> ]</p></font></b></div>
		  </td>
		</tr>
	</table>
	<table width="100%" align="center">	
		<thead>
            <tr>
			   <th style=" text-align: center; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Type</th>
			   <th style=" text-align: center; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Year</th>
               <th style=" text-align: center; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Remarks of Department</th>
			   <th style=" text-align: center; background:#ebebe0; font-size:12px; font-family:arial;letter-spacing:1px;">Status</th>
			</tr>
         </thead>
         <tbody>
			<tr align="justify"> 
				<td align="center"> 
					<p  style=" text-align: center; font-size:12px; font-family:arial;letter-spacing:1px;"><?php echo set_value('order_type',$order_type)?> of Expenditure</p>
				</td>
				<td align="center"> 
					<p style=" text-align: center; font-size:12px; font-family:arial;letter-spacing:1px;"><?php echo $dyear-1 ?> - <?php echo set_value('dyear',$dyear)?></p>
				</td>
				<td align="left"> 
					<p style=" text-align: left; font-size:12px; font-family:arial;letter-spacing:1px;"><?php echo set_value('dept_remark',$dept_remark)?></p>
				</td>
				<td align="center"> 
					<p style=" text-align: center; font-size:12px; font-family:arial;letter-spacing:1px;"><?php echo set_value('action_status',$action_status)?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<table width="100%">
		<tr>
			<td align="left"  style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span> Date  : <?php echo get_datepicker_date(set_value('dept_date',$dept_date))?> <span><br>
				  <span> Place : Kolkata</span></br>
				  <p>&nbsp;</p>
				   <p># This is a system generated copy.</p>
			</td>
			<td align="right" style = "border: none; text-align: right; font-size:11px; font-family:arial; letter-spacing:1px;" >
				  <span><?php echo set_value('dept_official_name',$dept_official_name)?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span><br>
				  <span> <?php echo set_value('dept_official_desig',$dept_official_desig)?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
			 </td>
		</tr>  
	 </table>
	</div>
</form>
</div>