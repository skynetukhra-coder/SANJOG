<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$emp_name = isset($row['emp_name']) ? $row['emp_name'] : '';
$extension_no = isset($row['extension_no']) ? $row['extension_no'] : '';

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
            <label class="control-label">Group<span class="required">*</span></label>
            <div class="controls">
				<select id="group_nm" name="group_nm" class="form-control" required readonly>
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" <?=$row['group_nm']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" <?=$row['group_nm']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
					<option data-value="3" value="FUND" <?=$row['group_nm']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
					<option data-value="4" value="PENSION" <?=$row['group_nm']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
					<option data-value="5" value="SECRETARIATE" <?=$row['group_nm']=='SECRETARIATE' ? 'selected="selected"': '' ;?>>SECRETARIATE</option>
					<option data-value="6" value="OTHER" <?=$row['group_nm']=='OTHER' ? 'selected="selected"': '' ;?>>OTHER</option>
				</select>
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
            <label class="control-label">Officer's Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="emp_name" name="emp_name" value="<?php echo set_value('emp_name',$emp_name)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Extension No<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="extension_no" name="extension_no" value="<?php echo set_value('extension_no',$extension_no)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>pension/epabx_list'">Cancel</button>
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