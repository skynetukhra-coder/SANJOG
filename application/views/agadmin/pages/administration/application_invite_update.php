<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$exam_nm_id = isset($row['exam_nm_id']) ? $row['exam_nm_id'] : '';
$exam_name = isset($row['exam_name']) ? $row['exam_name'] : '';
$off_on = isset($row['off_on']) ? $row['off_on'] : '';
$exam_start_dt = isset($row['exam_start_dt']) ? $row['exam_start_dt'] : '';
$exam_end_dt = isset($row['exam_end_dt']) ? $row['exam_end_dt'] : '';
$status = isset($row['status']) ? $row['status'] : '';
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
            <label class="control-label">Sl No<span class="required">*</span></label>
            <div class="controls">
				 <input type="text" value="<?php echo set_value('exam_nm_id',$exam_nm_id)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Examination Name</label>
            <div class="controls">
               <input type="text"  value="<?php echo set_value('exam_name',$exam_name)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Examination Month</label>
            <div class="controls">
               <select id="exam_month" name="exam_month" class="form-control " required >
						<option data-value="0" value="">---Select---</option>
						<option data-value="1" value="January">January</option>
						<option data-value="2" value="February">February</option>
						<option data-value="3" value="March">March</option>
						<option data-value="4" value="April">April</option>
						<option data-value="5" value="May">May</option>
						<option data-value="6" value="June">June</option>
						<option data-value="7" value="July">July</option>
						<option data-value="8" value="August">August</option>
						<option data-value="9" value="September">September</option>
						<option data-value="10" value="October">October</option>
						<option data-value="11" value="c">November</option>
						<option data-value="12" value="December">December</option>		
				</select>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Examination Year</label>
            <div class="controls">
               <select name="exam_year" class="form-control" required>
					<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
					<?php
						for($i = date('Y')+1; $i >= 2023; $i--){
							echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
					}?>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Invite application ?<span class="required">*</span></label>
            <div class="controls">
				<select id="off_on" name="off_on" class="form-control " required >
					<option data-value="0" value=""> ---- Select ----</option>
					<option data-value="1" value="Yes" <?=$row['off_on']=='Yes' ? 'selected="selected"': '' ;?>> Yes</option>
					<option data-value="2" value="No" <?=$row['off_on']=='No' ? 'selected="selected"': '' ;?>> No</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Examination Start Date<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name = "exam_start_dt" value="<?php echo get_datepicker_date(set_value('exam_start_dt',$exam_start_dt))?>" class="span12 m-wrap datepicker" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Examination End Date<span class="required">*</span></label>
            <div class="controls">
               <input type="text" name = "exam_end_dt" value="<?php echo get_datepicker_date(set_value('exam_end_dt',$exam_end_dt))?>" class="span12 m-wrap datepicker" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Status<span class=""></span></label>
            <div class="controls">
              <select id="status" name="status" class="form-control " required >
					<option data-value="0" value=""> ---- Select State----</option>
					<option data-value="1" value="In process"> In process</option>
					<option data-value="2" value="-"> Not Invited</option>
				</select>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/application_invite'">Cancel</button>
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