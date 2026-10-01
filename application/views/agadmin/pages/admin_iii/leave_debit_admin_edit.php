<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php

$leav_id = isset($row['leav_id']) ? $row['leav_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$leave_basic_pay = isset($row['leave_basic_pay']) ? $row['leave_basic_pay'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$leave_dr_year = isset($row['leave_dr_year']) ? $row['leave_dr_year'] : '';
$leave_type = isset($row['leave_type']) ? $row['leave_type'] : '';
$leave_from = isset($row['leave_from']) ? $row['leave_from'] : '';
$leave_to = isset($row['leave_to']) ? $row['leave_to'] : '';
$leave_day_no = isset($row['leave_day_no']) ? $row['leave_day_no'] : '';
$leave_status = isset($row['leave_status']) ? $row['leave_status'] : '';
$recom_autho = isset($row['recom_autho']) ? $row['recom_autho'] : '';
$recom_date = isset($row['recom_date']) ? $row['recom_date'] : '';
$sanction_autho = isset($row['sanction_autho']) ? $row['sanction_autho'] : '';
$approve_date = isset($row['approve_date']) ? $row['approve_date'] : '';
$joining_status = isset($row['joining_status']) ? $row['joining_status'] : '';
$joining_autho = isset($row['joining_autho']) ? $row['joining_autho'] : '';
$joining_approval_dt = isset($row['joining_approval_dt']) ? $row['joining_approval_dt'] : '';
$mc_varified = isset($row['mc_varified']) ? $row['mc_varified'] : '';
$servicebk_record = isset($row['servicebk_record']) ? $row['servicebk_record'] : '';
?>
<div class="row-fluid">
  <div class="block">
	<div class="row-fluid">
	<div class="navbar navbar-inner block-header">
		<div class="muted pull-left" style = "color:red; font-size:18px;">
			<marquee direction="left"  onMouseOver="this.stop()" onMouseOut="this.start()">
			Please!!! Don't "Cancel" any leave from here. Only to update the Leave Status to "Submitted" to enable the applicant to edit it and resubmit.
			Ignore other options. These are for use of DBA Controller only.
			</marquee>
		</div>
	</div>
</div>
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Leave Records</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		  <div class="control-group">
            <label class="control-label">Employee Id<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Employee Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="name" name="name" value="<?php echo set_value('name',$name)?>" class="span12 m-wrap" required readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation</label>
            <div class="controls">
              <input type="text" name="desig" value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Basic Pay<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="leave_basic_pay" name="leave_basic_pay" value="<?php echo set_value('leave_basic_pay',$leave_basic_pay)?>" class="span12 m-wrap"  readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Period <span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="" name="" value="From   <?php echo get_datepicker_date(set_value('leave_from',$leave_from))?>     To/And    <?php echo get_datepicker_date(set_value('leave_to',$leave_to))?>   [ <?php echo set_value('leave_day_no',$leave_day_no)?> Days]" class="span12 m-wrap"  readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section</label>
            <div class="controls">
				 <input type="text" id="section" name="section" value="<?php echo set_value('section',$section)?>" class="span12 m-wrap"  readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Group</label>
            <div class="controls">
                <select id="group_nm" name="group_nm" class="form-control" readonly >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" <?=$row['group_nm']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" <?=$row['group_nm']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
					<option data-value="3" value="FUND" <?=$row['group_nm']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
					<option data-value="4" value="PENSION" <?=$row['group_nm']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
					<option data-value="5" value="DIVISIONAL ACCOUNTANT" <?=$row['group_nm']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?>> DIVISIONAL ACCOUNTANT</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Type</label>
            <div class="controls">
				<select id="leave_type" name="leave_type" class="form-control" required>
					<option data-value="0" value=""> ---- Select Leave----</option>
					<option data-value="1" value="Casual Leave" <?=$row['leave_type']=='Casual Leave' ? 'selected="selected"': '' ;?>> Casual Leave</option>
					<option data-value="2" value="Restricted Holiday" <?=$row['leave_type']=='Restricted Holiday' ? 'selected="selected"': '' ;?>> Restricted Holiday</option>
					<option data-value="3" value="Earned Leave" <?=$row['leave_type']=='Earned Leave' ? 'selected="selected"': '' ;?>> Earned Leave</option>
					<option data-value="4" value="Half Pay Leave" <?=$row['leave_type']=='Half Pay Leave' ? 'selected="selected"': '' ;?>> Half Pay Leave</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year</label>
            <div class="controls">
				 <input type="text" id="leave_dr_year" name="leave_dr_year" value="<?php echo set_value('leave_dr_year',$leave_dr_year)?>" class="span12 m-wrap"  >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Status</label>
            <div class="controls">
              <select id="leave_status" name="leave_status" class="form-control" required >
					<option data-value="0" value=""> ---- Change Status----</option>
					<option data-value="1" value="Submitted" <?=$row['leave_status']=='Submitted' ? 'selected="selected"': '' ;?>> Submitted</option>
					<option data-value="2" value="Returned" <?=$row['leave_status']=='Returned' ? 'selected="selected"': '' ;?>> Returned</option>
					<option data-value="3" value="Held" <?=$row['leave_status']=='Held' ? 'selected="selected"': '' ;?>> Held</option>
					<option data-value="4" value="Recommended" <?=$row['leave_status']=='Recommended' ? 'selected="selected"': '' ;?>> Recommended</option>
					<option data-value="5" value="Sanctioned" <?=$row['leave_status']=='Sanctioned' ? 'selected="selected"': '' ;?>> Sanctioned</option>
					<option data-value="6" value="Approved" <?=$row['leave_status']=='Approved' ? 'selected="selected"': '' ;?>> Approved</option>
					<option data-value="7" value="Allowed" <?=$row['leave_status']=='Allowed' ? 'selected="selected"': '' ;?>> Allowed</option>
					<option data-value="8" value="Cancelled" <?=$row['leave_status']=='Cancelled' ? 'selected="selected"': '' ;?>> Cancelled</option>
				</select>
				<?php If ($row['leave_status']=='Recommended'){ ?>
					<div style = "float: center"><input type="text" id="" name="" value="By - <?php echo set_value('recom_autho',$recom_autho)?> / <?php echo set_value('recom_date',$recom_date)?>" class="span12 m-wrap" readonly ></div>
				<?php } If ($row['leave_status']=='Sanctioned' or $row['leave_status']=='Approved'){ ?>
					<div style = "float: center"><input type="text" id="" name="" value="By - <?php echo set_value('sanction_autho',$sanction_autho)?> / <?php echo set_value('approve_date',$approve_date)?>" class="span12 m-wrap" readonly ></div>
				<?php } ?>
		   </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Joining Status</label>
            <div class="controls">
              <select id="joining_status" name="joining_status" class="form-control" required >
					<option data-value="0" value=""> ---- Change Status----</option>
					<option data-value="1" value="Submitted" <?=$row['joining_status']=='Submitted' ? 'selected="selected"': '' ;?>> Submitted</option>
					<option data-value="2" value="Approved" <?=$row['joining_status']=='Approved' ? 'selected="selected"': '' ;?>> Approved</option>
					<option data-value="3" value="Pending" <?=$row['joining_status']=='Pending' ? 'selected="selected"': '' ;?>> Pending</option>
					<option data-value="4" value="Not applicable" <?=$row['joining_status']=='Not applicable' ? 'selected="selected"': '' ;?>> Not applicable</option>
				</select>
				<div style = "float: center"><input type="text" id="" name="" value="By - <?php echo set_value('joining_autho',$joining_autho)?> / <?php echo set_value('joining_approval_dt',$joining_approval_dt)?>" class="span12 m-wrap" readonly ></div>
            </div>
          </div>	
		   <div class="control-group">
            <label class="control-label">Medical Certificate Varification Status</label>
            <div class="controls">
              <select id="mc_varified" name="mc_varified" class="form-control" required >
					<option data-value="0" value="Pending"> ---- Change Status----</option>
					<option data-value="1" value="Verified" <?=$row['mc_varified']=='Verified' ? 'selected="selected"': '' ;?>> Verified</option>
					<option data-value="2" value="Pending" <?=$row['mc_varified']=='Pending' ? 'selected="selected"': '' ;?>> Pending</option>
					<option data-value="3" value="Not applicable" <?=$row['mc_varified']=='Not applicable' ? 'selected="selected"': '' ;?>> Not applicable</option>
				</select>
            </div>
          </div>	
		   <div class="control-group">
            <label class="control-label">Service Book Entry Status</label>
            <div class="controls">
              <select id="servicebk_record" name="servicebk_record" class="form-control" required >
					<option data-value="0" value="Pending"> ---- Change Status----</option>
					<option data-value="1" value="Entry Made" <?=$row['servicebk_record']=='Entry Made' ? 'selected="selected"': '' ;?>> Entry Made</option>
					<option data-value="2" value="Pending" <?=$row['servicebk_record']=='Pending' ? 'selected="selected"': '' ;?>> Pending</option>
					<option data-value="3" value="Not applicable" <?=$row['servicebk_record']=='Not applicable' ? 'selected="selected"': '' ;?>> Not applicable</option>
				</select>
            </div>
          </div>	
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_debit_admin'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
	
});
function browse(){
	$('#attachment').click();
}
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
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