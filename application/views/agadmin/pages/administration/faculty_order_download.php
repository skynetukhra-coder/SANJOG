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
$training_order = isset($row['training_order']) ? $row['training_order'] : '';
$order_date = isset($row['order_date']) ? $row['order_date'] : '';
$training_id = isset($row['training_id']) ? $row['training_id'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$emp_section = isset($row['emp_section']) ? $row['emp_section'] : '';
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$office_nm = isset($row['office_nm']) ? $row['office_nm'] : '';
$training_mode = isset($row['training_mode']) ? $row['training_mode'] : '';
$training_type = isset($row['training_type']) ? $row['training_type'] : '';
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
		  <td align="left"> Order No : <?php echo set_value('training_order',$training_order) ?>
		  || Dated : <?php echo get_datepicker_date(set_value('order_date',$order_date))?></td>
		</tr>
		<tr> 
		  <td align="center"> 
            <div><b><font color="#000000" size="-1"><p align="center">OFFICE ORDER</p></font></b></div>
		  </td>
		</tr>
		<tr align="center"> 
		  <td align="center"> 
			<div ><b><u><p align="center"><?php echo set_value('training_type',$training_type)?> Training Courses on <?php echo set_value('title',$title)?>.</p></u></b></div>
		  </td>
		</tr>
			<tr align="justify"> 
			  <td align="justify" width="7%" height="40"><p>&nbsp;</p> 
				<p align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				In accordance with the kind order of the Pr. Accountant General, 
				<?php echo set_value('location',$location)?>
				<?php echo set_value('training_mode',$training_mode)?>&nbsp;
				<?php echo set_value('training_type',$training_type)?>
				Programme on <?php echo set_value('title',$title)?> (Trg. ID-<?php echo set_value('training_id',$training_id)?> )
				from <?php echo get_datepicker_date(set_value('training_from',$training_from))?> to <?php echo get_datepicker_date(set_value('training_to',$training_to))?>
				at 	<?php  echo set_value('location',$location)?>
				(Detailed programme schedule is available at your nic mail) will be held through Microsoft Teams. For online training course, the participants can join the training classes from office or from home. The link for joining the training classes 
				and necessary technical support will be provided by ITSC.
				</p>
				<p align="justify" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				The training sessions are to be interactive in nature, and therefore, the lecturer is to adopt a participative method and resort to practical examples and problem-solving exercises as often as deemed necessary.
				</p>
				<p align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				For the faculty(ies) who is/are nominated from this office, the detailed schedule of the Training Course will be available under 'Office Document->Circular / Office Order' in Employee Login of this office website, otherwise, the same will be sent to the email of the faculty concerned.
				</p>
				<p>&nbsp;</p>
				<p><b>Detail of the Training Course:</b> <?php  echo set_value('description',$description)?>.</p>
				<p><b>Date of Training: From: </b><?php echo get_datepicker_date(set_value('training_from',$training_from))?> to <?php echo get_datepicker_date(set_value('training_to',$training_to))?>.
				<p><b>Time of Training: From: </b><?php echo (set_value('trg_time',$trg_time))?> .
				<p>&nbsp;</p>
				<p style = "text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
				<b><u>List of faculties for this course: </u></b></p>
			</td>
		</tr>
		</table>
        <table  width="100%"  align="center" style ="font-size:11px;" >
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
			<td> 
             Training Date : From <?php echo strtoupper($trainees['faculty_trg_dt_from'])?>
              To  <?php echo strtoupper($trainees['faculty_trg_dt_to']) ?>
		   || Time : From <?php echo strtoupper($trainees['faculty_trg_time']) ?>  
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
	  <img src="/usr/local/apache24/htdocs/files/agae/signature/<?php echo $trainees['sign_tag']?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br>
	  <span>[<?php echo strtoupper($trainees['officer_name'])?>] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <span></br><br>
	  <span> <?php echo strtoupper($trainees['officer_desig'])?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></br>
	  <p>&nbsp;</p>
	  <p style = "text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  **Do not take any print out unless it is urgengly necessary.</p>
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
</form>
</div>