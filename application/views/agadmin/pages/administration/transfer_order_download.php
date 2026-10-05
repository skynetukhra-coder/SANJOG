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
$trans_order_no = isset($row['trans_order_no']) ? $row['trans_order_no'] : '';
$trans_order_dt = isset($row['trans_order_dt']) ? $row['trans_order_dt'] : '';
$training_id = isset($row['training_id']) ? $row['training_id'] : '';
$emp_name = isset($row['emp_name']) ? $row['emp_name'] : '';
$emp_desig = isset($row['emp_desig']) ? $row['emp_desig'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$trans_from_sec = isset($row['trans_from_sec']) ? $row['trans_from_sec'] : '';
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$office_nm = isset($row['office_nm']) ? $row['office_nm'] : '';
$training_mode = isset($row['training_mode']) ? $row['training_mode'] : '';
$trans_type = isset($row['trans_type']) ? $row['trans_type'] : '';
$title = isset($row['title']) ? $row['title'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$training_from = isset($row['training_from']) ? $row['training_from'] : '';
$training_to = isset($row['training_to']) ? $row['training_to'] : '';
$trg_time = isset($row['trg_time']) ? $row['trg_time'] : '';
$training_days = isset($row['training_days']) ? $row['training_days'] : '';
$location = isset($row['location']) ? $row['location'] : '';

?>

<div>
<form bgcolor="#FFFFFF" text="#000000"> 
	<div class "">
	  <table width="100%" align="center">
<!--
		<tr> 
		  <td style ="line-height: 2"> 
			<div ><b><font size="+1"><p align="center">OFFICE OF THE PR. ACCOUNTANT GENERAL 
			  (A&E), WEST BENGAL </p></font></b></div>
		  </td>
		</tr>
		<tr> 
		  <td style ="border: none" > 
			<p>&nbsp;</p>
		  </td>
		</tr>
-->
		<tr style ="font-size:16px;">
		  <td align="left"> Order No : <?php echo set_value('trans_order_no',$trans_order_no) ?>
		  || Dated : <?php echo get_datepicker_date(set_value('trans_order_dt',$trans_order_dt))?></td>
		</tr>
		<tr> 
		  <td align="center"> 
            <div><b><font color="#000000" size="-1"><p align="center">OFFICE ORDER</p></font></b></div>
		  </td>
		</tr>
		<tr align="center"> 
		  <td align="center"> 
			<div ><b><u><p align="center"><?php //echo set_value('trans_type',$trans_type)?> Transfer <?php //echo set_value('title',$title)?>.</p></u></b></div>
		  </td>
		</tr>
			<tr align="justify"> 
			  <td  height="40" align="justify"><p>&nbsp;</p> 
				<p align="justify" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				In accordance with the kind order of the Pr. Accountant General, 
				<?php //echo set_value('location',$location) ?>
				<?php //echo set_value('training_mode',$training_mode) ?> &nbsp;
				<?php //echo set_value('training_type',$training_type) ?>
				Transfer <?php //echo set_value('title',$title)?> (ID-<?php //echo set_value('training_id',$training_id)?> )
				Year <?php //echo get_datepicker_date(set_value('training_from',$training_from))?> -----------Month -----------<?php //echo get_datepicker_date(set_value('training_to',$training_to))?>
				Transfer Type 	<?php  //echo set_value('location',$location)?> ---------.
				For releasing and joining of the transferred employees, the records will be available under 'Transfer for Release' / 'Transfer for Joining' tabs in the Employee Login of the concerned authorities of this office website.</p>
				<p style = "text-align: justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				The trnsfer is to be implemented with immediate effect.  </p>
				<p>&nbsp;</p>
				
				<p>&nbsp;</p>				
				<p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b><u>List of Transferred Employees: </u></b></p>
			</td>
			</tr>
		</table>
      <div align="center">
        <table  width="100%"  align="center" style ="font-size:10px;" >
          <thead>
				<tr style="text-align:center">
					<th style="text-align:center">Sl No</th>
					<th style="text-align:center">Name & Desig.</th>
					<th style="text-align:center">Transfer From</th>
					<th style="text-align:center">Transfer To</th>
				</tr>
			</thead>
		  <tbody> 
          <?php
				 if(!empty($candidates)){
					$sl = 1;
					foreach($candidates as $trainees){
					 ?>
          <tr> 
            <td> 
              <?php echo $sl++ ?>
            </td>
            <td> 
              <?php echo strtoupper($trainees['emp_name'])?>
              / 
              <?php echo strtoupper($trainees['emp_desig']) ?>
            </td>
			<td> 
              <?php echo strtoupper($trainees['trans_from_sec']) ?>  <?php echo strtoupper($trainees['trans_from_grp']) ?>
            </td>
			<td> 
              <?php echo strtoupper($trainees['trans_from_sec']) ?>   <?php echo strtoupper($trainees['trans_to_grp']) ?>
            </td>
          </tr>
          <?php	}
						}else{
							echo '<tr><td colspan="4">No records found!</td></tr>';
						}
				?>
          </tbody> 
        </table>
      </div>
	  <p style = "text-align: right"><span>
	  <img src="<?php echo FCPATH; ?>files/agae/signature/<?php echo $trainees['sign_tag']?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br>
	  <span>[<?php echo strtoupper($trainees['autho_name'])?>] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <span></br><br>
	  <span> <?php echo strtoupper($trainees['autho_desig'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
	  <p>&nbsp;</p>
	  <p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  **Please do not take any print out unless it is absolutely necessary</p>
      <table width="100%"   height="39" align="center">
        <tr> 
          <td width="7%" height="67"> 
            <div> 
              <p>Copy forwarded for necessary action to :-</p>
            </div>
            <div> 
				<table width="100%" align="left" >
					<tr>
					  <td width="50%">1. Secretary to the Pr. A.G.(A&E); </td>
					  <td width="50%">2. PA to DAG (Admn);</td>
					</tr>
					<tr>
					  <td width="50%">3. PA to DAG (A/cs & VLC); </td>
                      <td width="50%">4. Senior PS to DAG (Fund);</td>
					</tr>
					<tr>
					  <td width="50%">5. PA to DAG (Pension); </td>	
					  <td width="50%">6. Sr.AO, Welfare;</td>
					</tr>
					<tr>
					  <td width="50%">7. IAO; </td>	
					  <td width="50%">8. Sr.A.O. (Admn.I);</td>
					</tr>
					<tr>
					  <td width="50%">9. Sr.AO (Admn.II & III); </td>
					  <td width="50%">10. Sr.A.O. (Pen-coord);</td>
					</tr>
					<tr>
					  <td width="50%">11. Sr.A.O. (AM); </td>
					  <td width="50%">12. Sr. A.O. (FM);</td>
					</tr>
					<tr>
					  <td width="50%">13. Sr. AO/ITSC; </td>
					  <td width="50%">14. AAO/Hindi Cell for Hindi rendition of these 
						orders and annexure thereto;</td>
					</tr>
					<tr>
					  <td width="50%">15. Members of the faculty; </td>
					  <td width="50%">16. All participants;</td>
					</tr>
				</table>
            </div>
          </td>
        </tr>
      </table>
    </div>
</form>
</div>