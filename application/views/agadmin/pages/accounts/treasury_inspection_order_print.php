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
$insp_order = isset($row['insp_order']) ? $row['insp_order'] : '';
$order_date = isset($row['order_date']) ? $row['order_date'] : '';
$try_insp_id = isset($row['try_insp_id']) ? $row['try_insp_id'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$emp_section = isset($row['emp_section']) ? $row['emp_section'] : '';
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$office_nm = isset($row['office_nm']) ? $row['office_nm'] : '';
$insp_year = isset($row['insp_year']) ? $row['insp_year'] : '';
$insp_month = isset($row['insp_month']) ? $row['insp_month'] : '';
$tr_nm = isset($row['tr_nm']) ? $row['tr_nm'] : '';
$insp_party_no = isset($row['insp_party_no']) ? $row['insp_party_no'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$insp_from = isset($row['insp_from']) ? $row['insp_from'] : '';
$insp_to = isset($row['insp_to']) ? $row['insp_to'] : '';
$period_under_insp = isset($row['period_under_insp']) ? $row['period_under_insp'] : '';
$insp_days = isset($row['insp_days']) ? $row['insp_days'] : '';
$report_hq = isset($row['report_hq']) ? $row['report_hq'] : '';
$distance_hq = isset($row['distance_hq']) ? $row['distance_hq'] : '';

?>


<div>
<form bgcolor="#FFFFFF" text="#000000"> 
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
		  <td align="left"> Order No : <?php echo set_value('insp_order',$insp_order) ?>
		  || Dated : <?php echo get_datepicker_date(set_value('order_date',$order_date))?></td>
		</tr>
		<tr> 
		  <td align="center"> 
            <div><b><font color="#000000" size="-1"><p align="center">OFFICE ORDER</p></font></b></div>
		  </td>
		</tr>
		<tr align="center"> 
		  <td align="center"> 
			<div ><b><u><p align="center"> Inspection of <?php echo set_value('tr_nm',$tr_nm)?> Treasury by  <?php echo set_value('insp_party_no',$insp_party_no)?> in  <?php echo set_value('insp_month',$insp_month)?>,  <?php echo set_value('insp_year',$insp_year)?>.</p></u></b></div>
		  </td>
		</tr>
		<tr > 
			<td align="justify"  height="40"><p>&nbsp;</p> 
				<p align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				In accordance with the kind order of the Pr. Accountant General, 
				a Treasury Inspection Programme (Try. Insp ID-<?php echo set_value('try_insp_id',$try_insp_id)?> )
				from <?php echo get_datepicker_date(set_value('insp_from',$insp_from))?> to <?php echo get_datepicker_date(set_value('insp_to',$insp_to))?> (<?php echo set_value('insp_days',$insp_days)?> days)
				to inspect <?php  echo set_value('description',$description)?> of <?php  echo set_value('tr_nm',$tr_nm)?> Treasury 
				is scheduled to be conducted in   <?php echo set_value('insp_month',$insp_month)?>,  <?php echo set_value('insp_year',$insp_year)?>. 
				The details of inspection programme are as under:- </p>
				<p>&nbsp;</p>
				<p><b>Name of Treasury:</b> <?php  echo set_value('tr_nm',$tr_nm)?>. </p>
				<p><b>Period Under Inspection:</b> <?php echo (set_value('period_under_insp',$period_under_insp))?>.</p>
				<p><b>Items under Inspection:</b>  <?php echo (set_value('description',$description))?>.</p>
				<p><b>Schedule of Inspection:</b> From <?php echo get_datepicker_date(set_value('insp_from',$insp_from))?> to <?php echo get_datepicker_date(set_value('insp_to',$insp_to))?>.</p>
				<p><b>Retun to Headquarter:</b> On <?php  echo get_datepicker_date(set_value('report_hq',$report_hq))?> (FN). <b>Distnce from HQ:</b> <?php  echo set_value('distance_hq',$distance_hq)?></p>
				<p>&nbsp;</p>
				<p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b><u>List of Inspectors: </u></b></p>
			</td>
		</tr>
	</table>
    <table  width="100%" align="center" style ="font-size:11px;" >
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
              <?php echo strtoupper($trainees['name'])?>
              / 
              <?php echo strtoupper($trainees['desig']) ?>
              / 
              <?php echo strtoupper($trainees['emp_section']) ?>
            </td>
          </tr>
          <?php	}
						}else{
							echo '<tr><td colspan="4">No records found!</td></tr>';
						}
				?>
        </tbody> 
    </table>
      <p style = "text-align: right"><span>
	  <img src="<?php echo FCPATH; ?>files/agae/signature/<?php echo $trainees['sign_tag']?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br>
	  <span>[<?php echo strtoupper($trainees['officer_name'])?>] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <span></br><br>
	  <span> <?php echo strtoupper($trainees['officer_desig'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
	  <p>&nbsp;</p>
	  <p style = "text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
					  <td width="50%">6. Sr.AO, Admin-I;</td>
					</tr>
					<tr>
					  <td width="50%">7. Sr. AO, Admin-II; </td> 
					  <td width="50%">8. Sr. AO, Pension Coordination;</td>
					</tr>
					<tr>
					  <td width="50%">9. PAO (Cash); </td> 
					  <td width="50%">10. All Inspectors.</td>
					</tr>
				</table>
            </div>
          </td>
        </tr>
      </table>
      <div align="center">
        <p>&nbsp;</p>
      </div>
      <p>&nbsp;</p>
</form>
</div>