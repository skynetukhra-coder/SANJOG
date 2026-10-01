<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$feed_id = isset($row['feed_id']) ? $row['feed_id'] : '';
$visit_for = isset($row['visit_for']) ? $row['visit_for'] : '';
$gpf_no = isset($row['gpf_no']) ? $row['gpf_no'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$overall_service_rating = isset($row['overall_service_rating']) ? $row['overall_service_rating'] : '';
$details = isset($row['details']) ? $row['details'] : '';
$administration = isset($row['administration']) ? $row['administration'] : '';
$administration_action_required = isset($row['administration_action_required']) ? $row['administration_action_required'] : '';
$administration_action_taken = isset($row['administration_action_taken']) ? $row['administration_action_taken'] : '';

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
            <label class="control-label">Feedback Id </label>
            <div class="controls">
              <input type="text" id="feed_id" name="feed_id" value="<?php echo set_value('feed_id',$feed_id)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Visit For </label>
            <div class="controls">
              <input type="text" id="visit_for" name="visit_for" value="<?php echo set_value('visit_for',$visit_for)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">GPF A/c No </label>
            <div class="controls">
              <input type="text" id="gpf_no" name="gpf_no" value="<?php echo set_value('gpf_no',$gpf_no)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name </label>
            <div class="controls">
              <input type="text" id="name" name="name" value="<?php echo set_value('name',$name)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">details </label>
            <div class="controls">
              <input type="text" id="details" name="details" value="<?php echo set_value('details',$details)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Over All Rating </label>
            <div class="controls">
              <input type="text" id="overall_service_rating" name="overall_service_rating" value="<?php echo set_value('overall_service_rating',$overall_service_rating)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Action by Administration </label>
            <div class="controls">
				<input type="text" id="administration" name="administration" value="<?php echo set_value('administration',$administration)?>" class="form-control" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Action to be Taken </label>
            <div class="controls">
              <input type="text" id="administration_action_required" name="administration_action_required" value="<?php echo set_value('administration_action_required',$administration_action_required)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Action Taken </label>
            <div class="controls">
              <input type="text" id="administration_action_taken" name="administration_action_taken" value="<?php echo set_value('administration_action_taken',$administration_action_taken)?>" class="span12 m-wrap" >
            </div>
          </div>

		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/feedback'">Cancel</button>
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