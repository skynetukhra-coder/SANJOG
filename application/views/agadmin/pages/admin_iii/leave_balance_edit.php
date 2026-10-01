<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$leavb_id = isset($row['leavb_id']) ? $row['leavb_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
$leave_type = isset($row['leave_type']) ? $row['leave_type'] : '';
$as_on = isset($row['as_on']) ? $row['as_on'] : '';
$leave_ob = isset($row['leave_ob']) ? $row['leave_ob'] : '';
$leave_cr = isset($row['leave_cr']) ? $row['leave_cr'] : '';
$leave_dr = isset($row['leave_dr']) ? $row['leave_dr'] : '';
$leave_cb = isset($row['leave_cb']) ? $row['leave_cb'] : '';
$update_dt = isset($row['update_dt']) ? $row['update_dt'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Employee</div>
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
            <label class="control-label">Leave Type <span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="leave_type" name="leave_type" value="<?php echo set_value('leave_type',$leave_type)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">As On<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="as_on" name="as_on" value="<?php echo set_value('as_on',$as_on)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave OB</label>
            <div class="controls">
              <input type="text" id="leave_ob" name="leave_ob" value="<?php echo set_value('leave_ob',$leave_ob)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Credited</label>
            <div class="controls">
              <input type="text" name="leave_cr" value="<?php echo set_value('leave_cr',$leave_cr)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Availed</label>
            <div class="controls">
              <input type="text" name="leave_dr" value="<?php echo set_value('leave_dr',$leave_dr)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Balance</label>
            <div class="controls">
              <input type="text" name="leave_cb" value="<?php echo set_value('leave_cb',$leave_cb)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_balance'">Cancel</button>
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