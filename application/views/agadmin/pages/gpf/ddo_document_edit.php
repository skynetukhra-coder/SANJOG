<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$ddo_rec_id = isset($row['ddo_rec_id']) ? $row['ddo_rec_id'] : '';
$ddo_cd = isset($row['ddo_cd']) ? $row['ddo_cd'] : '';
$ddo_desptn = isset($profile['ddo_desptn']) ? $profile['ddo_desptn'] : '';
$drec_year = isset($row['drec_year']) ? $row['drec_year'] : '';
$drec_month = isset($row['drec_month']) ? $row['drec_month'] : '';
$drec_type = isset($row['drec_type']) ? $row['drec_type'] : '';
$doc_desc = isset($row['doc_desc']) ? $row['doc_desc'] : '';
$sub_name = isset($row['sub_name']) ? $row['sub_name'] : '';
$sub_ifms_id = isset($row['sub_ifms_id']) ? $row['sub_ifms_id'] : '';
$sub_series = isset($row['sub_series']) ? $row['sub_series'] : '';
$sub_ac_code = isset($row['sub_ac_code']) ? $row['sub_ac_code'] : '';
$sub_mbno = isset($row['sub_mbno']) ? $row['sub_mbno'] : '';
$ddo_attachment = isset($row['ddo_attachment']) ? $row['ddo_attachment'] : '';
$ag_remark = isset($row['ag_remark']) ? $row['ag_remark'] : '';
$drecd_status = isset($row['drecd_status']) ? $row['drecd_status'] : '';

$ddo_official_name = isset($profile['ddo_official_name']) ? $profile['ddo_official_name'] : '';
$ddo_official_desig = isset($profile['ddo_official_desig']) ? $profile['ddo_official_desig'] : '';
$ddo_official_contact = isset($profile['ddo_official_contact']) ? $profile['ddo_official_contact'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> DDO File</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		  <div class="control-group">
            <label class="control-label">DDO Code<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="ddo_cd" name="ddo_cd" value="<?php echo set_value('ddo_cd',$ddo_cd)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">DDO Description<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="ddo_desptn" name="ddo_desptn" value="<?php echo set_value('ddo_desptn',$ddo_desptn)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year<span class="required"></span></label>
            <div class="controls">
              <input type="text" id="drec_year" name="drec_year" value="<?php echo set_value('drec_year',$drec_year)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Month<span class="required"></span></label>
            <div class="controls">
              <input type="text" id="drec_month" name="drec_month" value="<?php echo set_value('drec_month',$drec_month)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Subscriber's Name</label>
            <div class="controls">
              <input type="text" name="sub_name" value="<?php echo set_value('sub_name',$sub_name)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">IFMS ID</label>
            <div class="controls">
              <input type="text" name="sub_ifms_id" value="<?php echo set_value('sub_ifms_id',$sub_ifms_id)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">GPF A/C No</label>
            <div class="controls">
              <input type="text" name="" value="<?php echo set_value('sub_series',$sub_series)?> / WB/ <?php echo set_value('sub_ac_code',$sub_ac_code)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Type<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="drec_type" name="drec_type" value="<?php echo set_value('drec_type',$drec_type)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <input type="text" name="doc_desc" value="<?php echo set_value('doc_desc',$doc_desc)?>" class="span12 m-wrap" readonly >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">AG Office Remark</label>
            <div class="controls">
              <input type="text" name="ag_remark" value="<?php echo set_value('ag_remark',$ag_remark)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Status</label>
            <div class="controls">
				<select id="drecd_status" name="drecd_status" class="form-control" required>
					<option data-value="0" value=""> ---- Select Status----</option>
					<option data-value="1" value="Received" <?=$row['drecd_status']=='Received' ? 'selected="selected"': '' ;?>> Received</option>
					<option data-value="2" value="Pending" <?=$row['drecd_status']=='Pending' ? 'selected="selected"': '' ;?>> Pending</option>
					<option data-value="3" value="Under Process" <?=$row['drecd_status']=='Under Process' ? 'selected="selected"': '' ;?>> Under Process</option>
					<option data-value="4" value="Alotted" <?=$row['drecd_status']=='Alotted' ? 'selected="selected"': '' ;?>> Alotted</option>
					<option data-value="5" value="Recorded" <?=$row['drecd_status']=='Settled' ? 'selected="selected"': '' ;?>> Recorded</option>
					<option data-value="6" value="Adjusted" <?=$row['drecd_status']=='Settled' ? 'selected="selected"': '' ;?>> Adjusted</option>
				</select>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/ddo_document'">Cancel</button>
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