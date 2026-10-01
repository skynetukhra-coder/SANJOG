<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php

$family_member_id = isset($row['family_member_id']) ? $row['family_member_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
$member_name = isset($row['member_name']) ? $row['member_name'] : '';
$family_relation = isset($row['family_relation']) ? $row['family_relation'] : '';
$member_dob = isset($row['member_dob']) ? $row['member_dob'] : '';
$first_second_child = isset($row['first_second_child']) ? $row['first_second_child'] : '';
$ph_status = isset($row['ph_status']) ? $row['ph_status'] : '';
$ph_percentage = isset($row['ph_percentage']) ? $row['ph_percentage'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Family Member</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		  <div class="control-group">
            <label class="control-label">Employee PAN<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Member Nane</label>
            <div class="controls">
              <input type="text" name="member_name" value="<?php echo set_value('member_name',$member_name)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Relation</label>
            <div class="controls">
              <input type="text" name="family_relation" value="<?php echo set_value('family_relation',$family_relation)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">DOB</label>
            <div class="controls">
              <input type="text" name="member_dob" value="<?php echo set_value('member_dob',$member_dob)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Child</label>
            <div class="controls">
              <select id="nic" name="first_second_child" class="form-control" >
					<option data-value="1" value="First Child" <?=$row['first_second_child']=='First Child' ? 'selected="selected"': '' ;?>> First Child</option>
					<option data-value="2" value="Second Child" <?=$row['first_second_child']=='Second Child' ? 'selected="selected"': '' ;?>>Second Child</option>
					<option data-value="3" value="NA" <?=$row['first_second_child']=='NA' ? 'selected="selected"': '' ;?>>Not Applicable</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Physical Status</label>
            <div class="controls">
              <input type="text" name="ph_status" value="<?php echo set_value('ph_status',$ph_status)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Percentage</label>
            <div class="controls">
              <input type="text" name="ph_percentage" value="<?php echo set_value('ph_percentage',$ph_percentage)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/family_member'">Cancel</button>
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