<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$emp_id = isset($row['emp_id']) ? $row['emp_id'] : '';
$full_name = isset($row['full_name']) ? $row['full_name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$exm_nm = isset($row['exm_nm']) ? $row['exm_nm'] : '';
$exm_month = isset($row['exm_month']) ? $row['exm_month'] : '';
$exm_year = isset($row['exm_year']) ? $row['exm_year'] : '';
$applied_on = isset($row['applied_on']) ? $row['applied_on'] : '';
$result_order_no = isset($row['result_order_no']) ? $row['result_order_no'] : '';
$result_order_dt = isset($row['result_order_dt']) ? $row['result_order_dt'] : '';
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
				 <input type="text" value="<?php echo set_value('emp_id',$emp_id)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">NAME</label>
            <div class="controls">
               <input type="text"  value="<?php echo set_value('full_name',$full_name)?>" class="span12 m-wrap" readonly>
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
              <input type="text" value="<?php echo set_value('exm_nm',$exm_nm)?> - <?php echo set_value('exm_month',$exm_month)?>, <?php echo set_value('exm_year',$exm_year)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Applied On<span class="required">*</span></label>
            <div class="controls">
               <input type="text"  value="<?php echo set_value('applied_on',$applied_on)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Appliication Status<span class="required">*</span></label>
            <div class="controls">
             <select id="application_status" name="application_status" class="form-control" required  >
					<option data-value="0" value=""> ---- Select Status----</option>
					<option data-value="1" value="Accepted" <?=$row['application_status']=='Accepted' ? 'selected="selected"': '' ;?>> Accepted</option>
					<option data-value="2" value="Rejected" <?=$row['application_status']=='Rejected' ? 'selected="selected"': '' ;?>> Rejected</option>
					<option data-value="3" value="Exam Over" <?=$row['application_status']=='Exam Over' ? 'selected="selected"': '' ;?>>Exam Over</option>
					<option data-value="4" value="Successful" <?=$row['application_status']=='Successful' ? 'selected="selected"': '' ;?>>Successful</option>
					<option data-value="5" value="Unsuccessful" <?=$row['application_status']=='Unsuccessful' ? 'selected="selected"': '' ;?>>Unsuccessful</option>
					<option data-value="4" value="Postponed" <?=$row['application_status']=='Postponed' ? 'selected="selected"': '' ;?>>Postponed</option>
					<option data-value="5" value="Cancelled" <?=$row['application_status']=='Cancelled' ? 'selected="selected"': '' ;?>>Cancelled</option>
					<option data-value="6" value="Submitted" <?=$row['application_status']=='Submitted' ? 'selected="selected"': '' ;?>>Submitted</option>
					<option data-value="7" value="With BO" <?=$row['application_status']=='With BO' ? 'selected="selected"': '' ;?>>With BO</option>
					<option data-value="8" value="Recomended" <?=$row['application_status']=='Recomended' ? 'selected="selected"': '' ;?>>Recomended</option>
					
				</select>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Result Order No <span class="required">*</span></label>
            <div class="controls">
              <input type="text" name = "result_order_no" value="<?php echo set_value('result_order_no',$result_order_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Result Order Date<span class="required">*</span></label>
            <div class="controls">
               <input type="text" name = "result_order_dt" value="<?php echo set_value('result_order_dt',$result_order_dt)?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Submit to the Authority</label>
            <div class="controls">
                <select id="pan_update" name="pan_update" class="form-control"  required>
					<option data-value="0" value="NIL"> ---- NOT TO BE UPDATED----</option>
					<option data-value="1" value="AAO">AAO [Sectional Authority]</option>
					<option data-value="2" value="SAO">Sr. AO [for Recommendation] </option>
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
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>training/application_exam_list'">Cancel</button>
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