<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php

$leavcr_id = isset($row['leavcr_id']) ? $row['leavcr_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
//$name = isset($row['name']) ? $row['name'] : '';
//$desig = isset($row['desig']) ? $row['desig'] : '';
//$leave_basic_pay = isset($row['leave_basic_pay']) ? $row['leave_basic_pay'] : '';
//$section = isset($row['section']) ? $row['section'] : '';
$leave_type = isset($row['leave_type']) ? $row['leave_type'] : '';
$cr_from_date = isset($row['cr_from_date']) ? $row['cr_from_date'] : '';
$cr_to_date = isset($row['cr_to_date']) ? $row['cr_to_date'] : '';
$no_days = isset($row['no_days']) ? $row['no_days'] : '';
$credit_date = isset($row['credit_date']) ? $row['credit_date'] : '';
$update_dt = isset($row['update_dt']) ? $row['update_dt'] : '';

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
            <label class="control-label">Leave Type</label>
            <div class="controls">
              <input type="text" name="leave_type" value="<?php echo set_value('leave_type',$leave_type)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">From</label>
            <div class="controls">
              <input type="text" name="cr_from_date" value="<?php echo set_value('cr_from_date',$cr_from_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">To</label>
            <div class="controls">
              <input type="text" name="cr_to_date" value="<?php echo set_value('cr_to_date',$cr_to_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Days Credited</label>
            <div class="controls">
              <input type="text" name="no_days" value="<?php echo set_value('no_days',$no_days)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Credit Date</label>
            <div class="controls">
              <input type="text" name="credit_date" value="<?php echo set_value('credit_date',$credit_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Update Date</label>
            <div class="controls">
              <input type="text" name="update_dt" value="<?php echo set_value('update_dt',$update_dt)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_credit'">Cancel</button>
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