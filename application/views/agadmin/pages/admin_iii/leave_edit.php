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
$leave_type = isset($row['leave_type']) ? $row['leave_type'] : '';
$leave_from = isset($row['leave_from']) ? $row['leave_from'] : '';
$leave_to = isset($row['leave_to']) ? $row['leave_to'] : '';
$leave_day_no = isset($row['leave_day_no']) ? $row['leave_day_no'] : '';
$ground = isset($row['ground']) ? $row['ground'] : '';
$application_joining_dt = isset($row['application_joining_dt']) ? $row['application_joining_dt'] : '';
$leave_address = isset($row['leave_address']) ? $row['leave_address'] : '';
$application_dt = isset($row['application_dt']) ? $row['application_dt'] : '';
$approve_date = isset($row['approve_date']) ? $row['approve_date'] : '';
$joined_on = isset($row['joined_on']) ? $row['joined_on'] : '';
$leave_status = isset($row['leave_status']) ? $row['leave_status'] : '';
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
              <input type="text" id="name" name="name" value="<?php echo set_value('name',$name)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation</label>
            <div class="controls">
              <input type="text" name="desig" value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Basic Pay<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="leave_basic_pay" name="leave_basic_pay" value="<?php echo set_value('leave_basic_pay',$leave_basic_pay)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section</label>
            <div class="controls">
              <input type="text" name="section" value="<?php echo set_value('section',$section)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">leave_type</label>
            <div class="controls">
              <input type="text" name="leave_type" value="<?php echo set_value('leave_type',$leave_type)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">leave_from</label>
            <div class="controls">
              <input type="text" name="leave_from" value="<?php echo set_value('leave_from',$leave_from)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">leave_to</label>
            <div class="controls">
              <input type="text" name="leave_to" value="<?php echo set_value('leave_to',$leave_to)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">leave_day_no</label>
            <div class="controls">
              <input type="text" name="leave_day_no" value="<?php echo set_value('leave_day_no',$leave_day_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">ground<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="ground" value="<?php echo set_value('ground',$ground)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">application_dt</label>
            <div class="controls">
              <input type="text" name="application_dt" value="<?php echo set_value('application_dt',$application_dt)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Joined on</label>
            <div class="controls">
              <input type="text" name="joined_on" value="<?php echo set_value('joined_on',$joined_on)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">leave status</label>
            <div class="controls">
              <input type="text" name="leave_status" value="<?php echo set_value('leave_status',$leave_status)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">approve_date</label>
            <div class="controls">
              <input type="text" name="approve_date" value="<?php echo set_value('approve_date',$approve_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave'">Cancel</button>
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