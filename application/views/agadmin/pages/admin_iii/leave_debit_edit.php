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
$office_nm = isset($row['office_nm']) ? $row['office_nm'] : '';
$leave_type = isset($row['leave_type']) ? $row['leave_type'] : '';
$leave_from = isset($row['leave_from']) ? $row['leave_from'] : '';
$leave_to = isset($row['leave_to']) ? $row['leave_to'] : '';
$leave_day_no = isset($row['leave_day_no']) ? $row['leave_day_no'] : '';
$ground = isset($row['ground']) ? $row['ground'] : '';
$admissibility = isset($row['admissibility']) ? $row['admissibility'] : '';
$application_joining_dt = isset($row['application_joining_dt']) ? $row['application_joining_dt'] : '';
$leave_address = isset($row['leave_address']) ? $row['leave_address'] : '';
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
$recom_autho = isset($row['recom_autho']) ? $row['recom_autho'] : '';
$recom_autho_desig = isset($row['recom_autho_desig']) ? $row['recom_autho_desig'] : '';
$recom_autho_pan = isset($row['recom_autho_pan']) ? $row['recom_autho_pan'] : '';
$recommendation = isset($row['recommendation']) ? $row['recommendation'] : '';
$recom_date = isset($row['recom_date']) ? $row['recom_date'] : '';
$sanction_autho = isset($row['sanction_autho']) ? $row['sanction_autho'] : '';
$sanction_autho_desig = isset($row['sanction_autho_desig']) ? $row['sanction_autho_desig'] : '';
$sanction_autho_pan = isset($row['sanction_autho_pan']) ? $row['sanction_autho_pan'] : '';
$sanction_desc = isset($row['sanction_desc']) ? $row['sanction_desc'] : '';
$approve_date = isset($row['approve_date']) ? $row['approve_date'] : '';
$leave_status = isset($row['leave_status']) ? $row['leave_status'] : '';
$servicebk_record = isset($row['servicebk_record']) ? $row['servicebk_record'] : '';
$servicebk_record_dt = isset($row['servicebk_record_dt']) ? $row['servicebk_record_dt'] : '';
$upload_dt = isset($row['upload_dt']) ? $row['upload_dt'] : '';

?>
<div class="row-fluid">
  <div class="block">
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
              <input type="text" id="leave_basic_pay" name="leave_basic_pay" value="<?php echo set_value('leave_basic_pay',$leave_basic_pay)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section</label>
            <div class="controls">
              <input type="text" name="section" value="<?php echo set_value('section',$section)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Group</label>
            <div class="controls">
              <input type="text" name="group_nm" value="<?php echo set_value('group_nm',$group_nm)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office</label>
            <div class="controls">
              <input type="text" name="office_nm" value="<?php echo set_value('office_nm',$office_nm)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Type</label>
            <div class="controls">
              <input type="text" name="leave_type" value="<?php echo set_value('leave_type',$leave_type)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave From</label>
            <div class="controls">
              <input type="text" name="leave_from" value="<?php echo set_value('leave_from',$leave_from)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave To</label>
            <div class="controls">
              <input type="text" name="leave_to" value="<?php echo set_value('leave_to',$leave_to)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">No of Days</label>
            <div class="controls">
              <input type="text" name="leave_day_no" value="<?php echo set_value('leave_day_no',$leave_day_no)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Ground of Leave<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="ground" value="<?php echo set_value('ground',$ground)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Admissibility<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="admissibility" value="<?php echo set_value('admissibility',$admissibility)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Application Date</label>
            <div class="controls">
              <input type="text" name="application_dt" value="<?php echo set_value('application_dt',$application_dt)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Last Leave Type</label>
            <div class="controls">
              <input type="text" name="last_leave_type" value="<?php echo set_value('last_leave_type',$last_leave_type)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Last Leave From</label>
            <div class="controls">
              <input type="text" name="last_leave_from" value="<?php echo set_value('last_leave_from',$last_leave_from)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Last Leave To</label>
            <div class="controls">
              <input type="text" name="last_leave_to" value="<?php echo set_value('last_leave_to',$last_leave_to)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Return from Last Leave</label>
            <div class="controls">
              <input type="text" name="last_leave_joined_on" value="<?php echo set_value('last_leave_joined_on',$last_leave_joined_on)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Prefixed From</label>
            <div class="controls">
              <input type="text" name="pre_from" value="<?php echo set_value('pre_from',$pre_from)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Prefixed To</label>
            <div class="controls">
              <input type="text" name="pre_to" value="<?php echo set_value('pre_to',$pre_to)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Prefixed Description</label>
            <div class="controls">
              <input type="text" name="pre_desc" value="<?php echo set_value('pre_desc',$pre_desc)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Suffixed From</label>
            <div class="controls">
              <input type="text" name="suff_from" value="<?php echo set_value('suff_from',$suff_from)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Suffixed To</label>
            <div class="controls">
              <input type="text" name="suff_to" value="<?php echo set_value('suff_to',$suff_to)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Suffixed Description</label>
            <div class="controls">
              <input type="text" name="suff_desc" value="<?php echo set_value('suff_desc',$suff_desc)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Recommendation</label>
            <div class="controls">
              <input type="text" name="recommendation" value="<?php echo set_value('recommendation',$recommendation)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Recommendation Date</label>
            <div class="controls">
              <input type="text" name="recom_date" value="<?php echo set_value('recom_date',$recom_date)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
              <input type="text" name="recom_autho" value="<?php echo set_value('recom_autho',$recom_autho)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation</label>
            <div class="controls">
              <input type="text" name="recom_autho_desig" value="<?php echo set_value('recom_autho_desig',$recom_autho_desig)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">PAN</label>
            <div class="controls">
              <input type="text" name="recom_autho_pan" value="<?php echo set_value('recom_autho_pan',$recom_autho_pan)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Sanction</label>
            <div class="controls">
              <input type="text" name="sanction_desc" value="<?php echo set_value('sanction_desc',$sanction_desc)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Sanction Date</label>
            <div class="controls">
              <input type="text" name="approve_date" value="<?php echo set_value('approve_date',$approve_date)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
              <input type="text" name="sanction_autho" value="<?php echo set_value('sanction_autho',$sanction_autho)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation</label>
            <div class="controls">
              <input type="text" name="sanction_autho_desig" value="<?php echo set_value('sanction_autho_desig',$sanction_autho_desig)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">PAN</label>
            <div class="controls">
              <input type="text" name="sanction_autho_pan" value="<?php echo set_value('sanction_autho_pan',$sanction_autho_pan)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Status</label>
            <div class="controls">
              <input type="text" name="leave_status" value="<?php echo set_value('leave_status',$leave_status)?>" class="span12 m-wrap" readonly>
            </div>
          </div>	  
		  <div>
		  <div class="control-group">
            <label class="control-label">Service Book Entry</label>
            <div class="controls">
				<select id="servicebk_record" name="servicebk_record" class="form-control" required>
					<option data-value="0" value="">---- Select Status ----</option>
					<option data-value="1" value="Entry made">Entry made</option>
					<option data-value="2" value="Pending">Pending</option>
				</select>
            </div>
          </div>	  
		  <div>
		  <div class="control-group">
            <label class="control-label">Entry Date</label>
            <div class="controls">
				<input type="text" name="servicebk_record_dt" value="<?php echo empty (get_datepicker_date(set_value('servicebk_record_dt',$servicebk_record_dt))) ? date("d-m-Y"): get_datepicker_date(set_value('servicebk_record_dt',$servicebk_record_dt)) ?> " class="span12 m-wrap datepicker" >
            </div>
          </div>	  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_debit'">Cancel</button>
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