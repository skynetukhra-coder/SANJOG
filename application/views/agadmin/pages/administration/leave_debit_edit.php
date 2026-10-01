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
$leave_status = isset($row['leave_status']) ? $row['leave_status'] : '';


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
              <input type="text" id="leave_basic_pay" name="leave_basic_pay" value="<?php echo set_value('leave_basic_pay',$leave_basic_pay)?>" class="span12 m-wrap"  >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section</label>
            <div class="controls">
				<select id="section" name="section" class="form-control" required>
					<option value=""> -- Select Section to update--</option>
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
            <label class="control-label">Group</label>
            <div class="controls">
                <select id="group_nm" name="group_nm" class="form-control" required >
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
            <label class="control-label">Leave Status</label>
            <div class="controls">
              <select id="leave_status" name="leave_status" class="form-control" required >
					<option data-value="0" value=""> ---- Change Status----</option>
					<option data-value="1" value="Submitted" <?=$row['leave_status']=='Submitted' ? 'selected="selected"': '' ;?>> Submitted</option>
					<option data-value="2" value="Recommended" <?=$row['leave_status']=='Recommended' ? 'selected="selected"': '' ;?>> Recommended</option>
					<option data-value="3" value="Sanctioned" <?=$row['leave_status']=='Sanctioned' ? 'selected="selected"': '' ;?>> Sanctioned</option>
					<option data-value="4" value="Aproved" <?=$row['leave_status']=='Aproved' ? 'selected="selected"': '' ;?>> Aproved</option>
					<option data-value="5" value="Cancelled" <?=$row['leave_status']=='Cancelled' ? 'selected="selected"': '' ;?>> Cancelled</option>
				</select>
            </div>
          </div>	    
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/leave_debit'">Cancel</button>
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