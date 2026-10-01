<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$exam_name = isset($row['exam_name']) ? $row['exam_name'] : '';
$exam_appli_yr = isset($row['exam_appli_yr']) ? $row['exam_appli_yr'] : '';
$appli_date = isset($row['appli_date']) ? $row['appli_date'] : '';
$appli_status = isset($row['appli_status']) ? $row['appli_status'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">Update EPABX Extension Details</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">PAN<span class="required">*</span></label>
            <div class="controls">
				 <input type="text" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">NAME</label>
            <div class="controls">
               <input type="text"  value="<?php echo set_value('name',$name)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
               <input type="text"  value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Examination<span class="required">*</span></label>
            <div class="controls">
              <input type="text" value="<?php echo set_value('exam_name',$exam_name)?>, <?php echo set_value('exam_appli_yr',$exam_appli_yr)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Applied On<span class="required">*</span></label>
            <div class="controls">
               <input type="text"  value="<?php echo set_value('appli_date',$appli_date)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Appliication Status<span class="required">*</span></label>
            <div class="controls">
             <select id="appli_status" name="appli_status" class="form-control" required  >
					<option data-value="0" value=""> ---- Select Status----</option>
					<option data-value="1" value="Accepted" <?=$row['appli_status']=='Accepted' ? 'selected="selected"': '' ;?>> Accepted</option>
					<option data-value="2" value="Rejected" <?=$row['appli_status']=='Rejected' ? 'selected="selected"': '' ;?>> Rejected</option>
					<option data-value="3" value="Exam Over" <?=$row['appli_status']=='Exam Over' ? 'selected="selected"': '' ;?>>Exam Over</option>
					<option data-value="4" value="Successful" <?=$row['appli_status']=='Successful' ? 'selected="selected"': '' ;?>>Successful</option>
					<option data-value="5" value="Unsuccessful" <?=$row['appli_status']=='Unsuccessful' ? 'selected="selected"': '' ;?>>Unsuccessful</option>
					<option data-value="4" value="Postponed" <?=$row['appli_status']=='Postponed' ? 'selected="selected"': '' ;?>>Postponed</option>
					<option data-value="5" value="Cancelled" <?=$row['appli_status']=='Cancelled' ? 'selected="selected"': '' ;?>>Cancelled</option>
				</select>
            </div>
          </div>
		   
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/application_exam_other_list'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
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