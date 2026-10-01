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
$leave_from = isset($row['leave_from']) ? $row['leave_from'] : '';
$leave_to = isset($row['leave_to']) ? $row['leave_to'] : '';
$leave_day_no = isset($row['leave_day_no']) ? $row['leave_day_no'] : '';
$leave_address = isset($row['leave_address']) ? $row['leave_address'] : '';
$leave_status = isset($row['leave_status']) ? $row['leave_status'] : '';
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
            <label class="control-label">Leave From<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="leave_from" name="leave_from" value="<?php echo get_datepicker_date(set_value('leave_from',$leave_from))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave To<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="leave_to" name="leave_to" value="<?php echo get_datepicker_date(set_value('leave_to',$leave_to))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">No of Day(s)<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="leave_day_no" name="leave_day_no" value="<?php echo set_value('leave_day_no',$leave_day_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Leave Address<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="leave_address" name="leave_address" value="<?php echo set_value('leave_address',$leave_address)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Group</label>
            <div class="controls">
                <select id="group_nm" name="group_nm" class="form-control"  required>
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
            <label class="control-label">Section</label>
            <div class="controls">
				<select id="section" name="section" class = "form-control" required>
					<option value="">--Select--</option>
						<?php
						if(isset($section_list) && !empty($section_list)){
							foreach($section_list as $sections){
							echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
							}
						}
						?>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Submit to the Authority</label>
            <div class="controls">
                <select id="pan_update" name="pan_update" class="form-control"  required>
					<option data-value="0" value="NIL"> ---- NOT TO BE UPDATED----</option>
					<option data-value="1" value="RECO">Recommending Authority</option>
					<option data-value="2" value="SANC">Sanctioning Authority</option>
					<option data-value="3" value="JOIN">Joining Authority</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Authority Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="auth_nm" name="auth_nm" value="" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Authority Designation<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="auth_dg" name="auth_dg" value="" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">PAN NO<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="pan_no" name="pan_no" value="" class="span12 m-wrap" >
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