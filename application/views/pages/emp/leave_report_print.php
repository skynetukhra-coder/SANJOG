<?php
//$empid = isset($row['empid']) ? $row['empid'] : '';
$empname = isset($row['name']) ? $row['name'] : '';
//$desig = isset($row['desig']) ? $row['desig'] : '';

$leav_id = isset($row['leav_id']) ? $row['leav_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$leave_basic_pay = isset($row['leave_basic_pay']) ? $row['leave_basic_pay'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$office_nm = isset($row['office_nm']) ? $row['office_nm'] : '';
$leave_type = isset($row['leave_type']) ? $row['leave_type'] : '';
$leave_from = isset($row['leave_from']) ? $row['leave_from'] : '';
$leave_to = isset($row['leave_to']) ? $row['leave_to'] : '';
$leave_day_no = isset($row['leave_day_no']) ? $row['leave_day_no'] : '';
$ground = isset($row['ground']) ? $row['ground'] : '';
$admissibility = isset($row['admissibility']) ? $row['admissibility'] : '';
$application_joining_dt = isset($row['application_joining_dt']) ? $row['application_joining_dt'] : '';
$leave_address = isset($row['leave_address']) ? $row['leave_address'] : '';
$block = isset($row['block']) ? $row['block'] : '';
$application_dt = isset($row['application_dt']) ? $row['application_dt'] : '';
$last_leave_type = isset($row['last_leave_type']) ? $row['last_leave_type'] : '';
$last_leave_from = isset($row['last_leave_from']) ? $row['last_leave_from'] : '';
$last_leave_to = isset($row['last_leave_to']) ? $row['last_leave_to'] : '';
$last_leave_joined_on = isset($row['last_leave_joined_on']) ? $row['last_leave_joined_on'] : '';
$pre_from = isset($row['pre_from']) ? $row['pre_from'] : '';
$pre_to = isset($row['pre_to']) ? $row['pre_to'] : '';
$pre_desc = isset($row['pre_desc']) ? $row['pre_desc'] : '';
$suff_from = isset($row['suff_from']) ? $row['suff_from'] : '';
$suff_to = isset($row['suff_to']) ? $row['suff_to'] : '';
$suff_desc = isset($row['suff_desc']) ? $row['suff_desc'] : '';
$upload_dt = isset($row['upload_dt']) ? $row['upload_dt'] : '';

?>


<div>
<form bgcolor="#FFFFFF" text="#000000">
      <table width="78%" border ="1" color="red" align="center">
        <tr> 
      <td> 
        <div align="center"><b><font size="+1">OFFICE OF THE PR. ACCOUNTANT GENERAL 
          (A&E), WEST BENGAL </font></b></div>
      </td>
    </tr>
	<tr> 
      <td> 
        <div align="center">CASUAL LEAVE / RESTRICTED HOLIDAY REPORT </div>
      </td>
    </tr>
    <tr> 
      <td> 
        <div align="left">Section : <?php echo $section ?></div>
      </td>
    </tr>
  </table>
  <table border="1" width="78%" align="center">
        <thead> 
        <tr style="text-align:center">
          <th style="text-align:center" width="11%" bordercolor="#FFFFFF">Sl No</th>
          <th style="text-align:center" width="33%">Name</th>
		  <th style="text-align:center" width="33%">Designation</th>									
		</tr>
		</thead>
	<tbody >
			<?php
					if(!empty($section_employee)){
						$sl = intval($this->input->get('per_page',true)) + 1;
						
						foreach($section_employee as $employees){
					?>			
		<tr>							
          <td width="11%" bordercolor="#FFFFFF"> 
            <?php echo $sl++ ?>
          </td>							
          <td width="33%"><font size = "3"> 
            <?php echo $employees['empname'] ?>
          </td>
		  <td width="33%"><font size = "3"> 
            <?php echo $employees['desig'] ?>
          </td>
		</tr>   			
		
			<?php	}
					}else{
						echo '<tr><td colspan="11">No records found!</td></tr>';
						}
				?>			
	</tbody>
	</table>
      <table border="1" width="78%" align="center">
        <thead> 
        <tr style="text-align:center">
          <th style="text-align:center" width="8%" bordercolor="#FFFFFF">Sl No</th>
		  <th style="text-align:center" width="12%">Name</th>
		  <th style="text-align:center" width="10%">Leave Type</th>		  
          <th style="text-align:center" width="32%">Ground</th>
          <th style="text-align:center" width="10%">From</th>
          <th style="text-align:center" width="10%">To</th>
          <th style="text-align:center" width="8%">Days</th>
          <th style="text-align:center" width="12%">Status</th>
		 <th style="text-align:center" width="12%">Sanction Date</th>				
		</tr>
		</thead>
	<tbody >
					<?php
					if(!empty($leave_debits)){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($leave_debits as $leaves){ ?>
		<tr>							
          <td style="text-align:center" width="5%" bordercolor="#FFFFFF"> 
            <?php echo $sl++ ?>
          </td>
		  <td width="15%"><font size = "2"> 
            <?php echo $leaves['name'] ?>
          </td>
		  <td width="8%"><font size = "2"> 
            <?php echo $leaves['leave_type'] ?>
          </td>
          <td width="22%"><font size = "2"> 
            <?php echo $leaves['ground'] ?>
          </td>	
          <td style="text-align:center" width="8%"><font size = "2"> 
            <?php echo  get_datepicker_date($leaves['leave_from']) ?>
          </td>							
          <td style="text-align:center" width="8%"><font size = "2"> 
            <?php echo  get_datepicker_date($leaves['leave_to']) ?>
          </td>						
          <td style="text-align:center" width="7%"><font size = "2"> 
            <?php echo $leaves['leave_day_no'] ?>
          </td>													
          <td id "leave_st" style="text-align:center" width="12%"><font size = "2">
            <?php echo $leaves['leave_status']?>
          </td>
		  <td id "leave_st" style="text-align:center" width="14%"><font size = "2">
            <?php echo get_datepicker_date($leaves['approve_date'])?>
          </td>
		</tr>	
						<?php	}
								}else{
									echo '<tr><td colspan="9">No records found!</td></tr>';
								}
							?>
	</tbody>			
	</table>		
</div>

</form>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
	
});
function browse(){
	$('#attachment').click();
}
function previewImage(file_obj,container_id){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if(ext == 'jpg' || ext == 'jpeg' || ext == 'png'){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#' + container_id).html('<img src="" style="max-height:150px; max-width:150px; margin:5px; border:1px solid gray;">');
				$('#' + container_id + ' img').attr('src', e.target.result);
			};
			reader.readAsDataURL(file_obj.files[0]);
		}else{
			$('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
		}
	}
}
</script>
