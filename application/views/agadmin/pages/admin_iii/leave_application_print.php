<?php

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
$leave_commu_days = isset($row['leave_commu_days']) ? $row['leave_commu_days'] : '0';
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
$recommendation = isset($row['recommendation']) ? $row['recommendation'] : '';
$recom_autho = isset($row['recom_autho']) ? $row['recom_autho'] : '';
$recom_autho_desig = isset($row['recom_autho_desig']) ? $row['recom_autho_desig'] : '';
$recom_date = isset($row['recom_date']) ? $row['recom_date'] : '';
$sanction_desc = isset($row['sanction_desc']) ? $row['sanction_desc'] : '';
$sanction_autho = isset($row['sanction_autho']) ? $row['sanction_autho'] : '';
$sanction_autho_desig = isset($row['sanction_autho_desig']) ? $row['sanction_autho_desig'] : '';
$approve_date = isset($row['approve_date']) ? $row['approve_date'] : '';
$leave_status = isset($row['leave_status']) ? $row['leave_status'] : '';
$joining_status = isset($row['joining_status']) ? $row['joining_status'] : '';
$upload_dt = isset($row['upload_dt']) ? $row['upload_dt'] : '';

?>


<div>
<form bgcolor="#FFFFFF" text="#000000"> 
<div>
  <table width="96%" border ="1" color="red" align="center">
  <tr> 
      <td> 
        <div align="center"><b><font size="+1">OFFICE OF THE PR. ACCOUNTANT GENERAL 
          (A&E), WEST BENGAL </font></b></div>
      </td>
    </tr>
    <tr> 
      <td> 
        <div align="center">THE SECOND SCHEDULE </div>
      </td>
    </tr>
    <tr> 
      <td> 
        <div align="center">FORM I </div>
      </td>
    </tr>
    <tr> 
      <td> 
        <div align="center">APPLICAILON FOR LEAVE OR FOR EXTENSION OF LEAVE </div>
      </td>
    </tr>
  </table>
</div>
<div>
    <table width="96%" border="" align="center">
      <tr> 
        <td width="3%" height="31"> 
          <div align="center">1</div>
        </td>
        <td width="38%" height="31">Name of applicant </td>
        <td width="59%" height="31">
          <?php echo set_value('name',$name)?>
        </td>
      </tr>
      <tr> 
          <td width="3%" height="28"> 
            <div align="center">2</div>
        </td>
          <td width="38%" height="28">Post held </td>
          <td width="59%" height="28"> 
            <?php echo set_value('desig',$desig)?>
          </td>
      </tr>
      <tr> 
          <td width="3%" height="30"> 
            <div align="center">3</div>
        </td>
          <td width="38%" height="30">Department, Office and Section </td>
          <td width="59%" height="30">
            <?php echo set_value('section',$section)?>
          </td>
      </tr>
      <tr> 
          <td width="3%" height="28"> 
            <div align="center">4</div>
        </td>
          <td width="38%" height="28">Pay</td>
          <td width="59%" height="28">
            <?php echo set_value('leave_basic_pay',$leave_basic_pay)?>
          </td>
      </tr>
      <tr> 
          <td width="3%" height="41"> 
            <div align="center">5</div>
        </td>
          <td width="38%" height="41">House rent and other compensatory allowances 
            drawn in the present post</td>
          <td width="59%" height="41"> 
            <?php echo set_value('admissibility',$admissibility)?>
          </td>
      </tr>
      <tr> 
          <td width="3%" height="34"> 
            <div align="center">6</div>
        </td>
          <td width="38%" height="34">Nature and period of leave applied for and 
            date from which required</td>
          <td width="59%" height="34">
            <?php //echo set_value('leave_basic_pay',$leave_basic_pay)?>
          </td>
      </tr>
	 </table>
</div>
<div>
	 <table width="96%" border="" align="center">
		<tr>	
		  <td width="10%">Leave applied for</td>
          <td width="23%">
		  <?php if ($ground =='Leave Encashment'){ echo set_value('ground',$ground); echo '  of  ';}  ?> 
		   <?php echo set_value('leave_type',$leave_type)?> (debited) for 
            <?php echo set_value('leave_day_no',$leave_day_no)?> days 
			
          </td>
		<td width="17%">Commuted Leave for</td>
          <td width="10%">
		  
            <?php echo set_value('leave_commu_days',$leave_commu_days)?> days 
			
          </td>
          <td width="8%">From</td>
          <td width="10%"> 
            <?php echo get_datepicker_date(set_value('leave_from',$leave_from)) ?>
          </td>
			
          <td width="8%">To</td>
          <td width="10%">
            <?php echo get_datepicker_date(set_value('leave_to',$leave_to)) ?>
          </td>
		</tr>
	</table>
</div>
<div>
	<table width="96%" border="" align="center">
      <tr> 
          <td width="3%" height="35"> 
            <div align="center">7</div>
        </td>
          <td width="52%" height="35"> 
            <p>Sundays and holidays, if any, proposed to be- Prefixed /Suffixed 
            to leave</p>
        </td>
          <td width="45%" height="35">&nbsp;</td>
      </tr>
    </table>
</div>
<div>
	<table width="96%" border="" align="center">
	<tr>	
          <td width="8%">Prefix</td>
          <td width="33%"> 
            <?php echo set_value('pre_desc',$pre_desc)?>
          </td>
          <td width="15%">From</td>
          <td width="16%"> 
            <?php echo get_datepicker_date(set_value('pre_from',$pre_from)) ?>
          </td>
          <td width="14%">To</td>
          <td width="14%"> 
            <?php echo get_datepicker_date(set_value('pre_to',$pre_to)) ?>
          </td>
    </tr>
	<tr>	
          <td width="8%">Suffix</td>
          <td width="33%"> 
            <?php echo set_value('suff_desc',$suff_desc)?>
          </td>
          <td width="15%">From</td>
          <td width="16%"> 
            <?php echo get_datepicker_date(set_value('suff_from',$suff_from)) ?>
          </td>
          <td width="14%">To</td>
          <td width="14%"> 
            <?php echo get_datepicker_date(set_value('suff_to',$suff_to)) ?>
          </td>
    </tr>
	</table>
</div>
<div>
	<table width="96%" border="" align="center">
      <tr> 
          <td width="3%" height="29"> 
            <div align="center">8</div>
        </td>
          <td width="38%" height="29">Grounds on which leave is applied for </td>
          <td width="59%" height="29">
            <?php echo set_value('ground',$ground)?>
          </td>
      </tr>
      <tr> 
          <td width="3%" height="33"> 
            <div align="center">9</div>
        </td>
          <td width="38%" height="33">Date of return from last leave and the nature 
            and period of that leave </td>
          <td width="59%" height="33">&nbsp; </td>
      </tr>
    </table>
</div>
<div>
	<table width="96%" border="" align="center">
		<tr>	
		  <td width="20%">Proposed Joining Date /Return Date</td>
          <td width="10%"> 
            <?php echo get_datepicker_date(set_value('last_leave_joined_on',$last_leave_joined_on)) ?>
          </td>
			
          <td width="15%">Nature of Last Leave</td>
          <td width="18%"> 
            <?php echo set_value('last_leave_type',$last_leave_type)?>
          </td>
			
          <td width="6%">From</td>
          <td width="13%"> 
            <?php echo get_datepicker_date(set_value('last_leave_from',$last_leave_from)) ?>
          </td>
			
          <td width="5%">To</td>
          <td width="13%"> 
            <?php echo get_datepicker_date(set_value('last_leave_to',$last_leave_to)) ?>
          </td>
		</tr>
	</table>
</div>
<div>
    <table width="96%" border="" align="center">
      <tr> 
          <td width="2%" height="39"> 
            <div align="center">10</div>
        </td>
          <td width="39%" height="39">I propose/do not propose to avail myself 
            of leave travel concession for the block years</td>
          <td width="59%" height="39"> 
            <?php echo set_value('block',$block)?>
          </td>
      </tr>
      <tr> 
          <td width="2%" height="35"> 
            <div align="center">11</div>
        </td>
          <td width="39%" height="35">Address during leave period </td>
          <td width="59%" height="35"> 
            <?php echo set_value('leave_address',$leave_address)?>
          </td>
      </tr>
      <tr> 
          <td width="2%" height="26"> 
            <div align="center"></div>
        </td>
          <td width="39%" height="26">Date: 
            <?php echo get_datepicker_date(set_value('application_dt',$application_dt)) ?>
          </td>
          <td width="59%" height="26">Applicant : 
            <?php echo set_value('name',$name)?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Designation : 
            <?php echo set_value('desig',$desig)?>
          </td>
      </tr>
      <tr> 
          <td width="2%" height="27"> 
            <div align="center">12</div>
        </td>
          <td width="39%" height="27"> 
            <?php echo set_value('recommendation',$recommendation)?>
          </td>
          <td width="59%" height="27">Authority : 
            <?php echo set_value('recom_autho',$recom_autho)?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Designation : 
            <?php echo set_value('recom_autho_desig',$recom_autho_desig)?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: 
            <?php echo get_datepicker_date(set_value('recom_date',$recom_date)) ?>
          </td>
      </tr>
    </table>
</div>
<div>
	  <table width="96%" border=""  height="39" align="center">
		<tr>
			  
          <td width="7%" height="40">&nbsp;&nbsp;&nbsp;13. Certified that 
            <?php echo set_value('leave_type',$leave_type)?>
            for  <?php echo set_value('leave_day_no',$leave_day_no)?>
			days from 
            <?php echo get_datepicker_date(set_value('leave_from',$leave_from))?>
            to 
            <?php echo get_datepicker_date(set_value('leave_to',$leave_to))?>
            is admissible under Rule...................... of the Central Civil 
            Services (Leave) Rules. 1972.</td>
		</tr>
	  </table>
</div>
<div>
    <table width="96%" border="" align="center">
      <tr> 
          <td width="3%" height="27"> 
            <div align="center"></div>
        </td>
          <td width="38%" height="27">Date</td>
          <td width="59%" height="27">Signature :
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  Designation : </td>
      </tr>
      <tr> 
          <td width="3%" height="25"> 
            <div align="center">14</div>
        </td>
          <td width="38%" height="25">Leave Status: 
            <?php echo set_value('leave_status',$leave_status)?>
          </td>
          <td width="59%" height="25">Remark : 
            <?php echo set_value('sanction_desc',$sanction_desc)?>
          </td>
      </tr>
      <tr> 
        <td width="3%"> 
            <div align="center"></div>
        </td>
          <td width="38%">Joining Status: 
            <?php echo set_value('joining_status',$joining_status)?>
          </td>
          <td width="59%">Authority : 
            <?php echo set_value('sanction_autho',$sanction_autho)?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			Designation: 
            <?php echo set_value('sanction_autho_desig',$sanction_autho_desig)?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			Date: 
            <?php echo get_datepicker_date(set_value('approve_date',$approve_date)) ?>
          </td>
      </tr>
     
    </table>
</div>
<div>
  <table width="96%" border="" height="39" align="center">
    <tr>
          <td width="3%" height="35">&nbsp;</td>
          <td width="97%" height="35">*lf the applicant is drawing any cornper!satory 
            ai1owance, it should also be indicated in the orders on the expiry 
            of leave,the Goverunient servant is likely to return to the same post 
            or to another post carrying similar allowance. </td>
    </tr>
  </table>
</div>
</form>
</div>


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
