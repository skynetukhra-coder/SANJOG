<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php

$empid = isset($row['empid']) ? $row['empid'] : '';
$empname = isset($row['empname']) ? $row['empname'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$leave_cr_year = isset($row['leave_cr_year']) ? $row['leave_cr_year'] : '';
$leave_type = isset($row['leave_type']) ? $row['leave_type'] : '';
$cr_from_date = isset($row['cr_from_date']) ? $row['cr_from_date'] : '';
$cr_to_date = isset($row['cr_to_date']) ? $row['cr_to_date'] : '';
$no_days = isset($row['no_days']) ? $row['no_days'] : '';
$leave_cb = isset($row['leave_cb']) ? $row['leave_cb'] : '';
$status = isset($row['status']) ? $row['status'] : '';
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
            <label class="control-label">Year<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="leave_cr_year" name="leave_cr_year" value="<?php echo set_value('leave_cr_year',$leave_cr_year)?>" class="span12 m-wrap"  readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Type<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="leave_type" name="leave_type" value="<?php echo set_value('leave_type',$leave_type)?>" class="span12 m-wrap"  readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Period <span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="" name="" value="From   <?php echo get_datepicker_date(set_value('cr_from_date',$cr_from_date))?>     To    <?php echo get_datepicker_date(set_value('cr_to_date',$cr_to_date))?>   [ <?php echo set_value('no_days',$no_days)?> Days]" class="span12 m-wrap"  readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Balance</label>
            <div class="controls">
				 <input type="text" id="leave_cb" name="leave_cb" value="<?php echo set_value('leave_cb',$leave_cb)?>" class="span12 m-wrap"  readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Status</label>
            <div class="controls">
              <select id="leave_status" name="status" class="form-control" required >
					<option data-value="0" value=""> ---- Change Status----</option>
					<option data-value="1" value="Active" <?=$row['status']=='Active' ? 'selected="selected"': '' ;?>> Active</option>
					<option data-value="2" value="Close" <?=$row['status']=='Close' ? 'selected="selected"': '' ;?>> Close</option>
				</select>
            </div>
          </div>	    
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_credit_admin'">Cancel</button>
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