<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$tr_cd = isset($row['tr_cd']) ? $row['tr_cd'] : '';
$tr_nm = isset($row['tr_nm']) ? $row['tr_nm'] : '';
$para_year = isset($row['para_year']) ? $row['para_year'] : '';
$para_month = isset($row['para_month']) ? $row['para_month'] : '';
$para_no = isset($row['para_no']) ? $row['para_no'] : '';
$para_desc = isset($row['para_desc']) ? $row['para_desc'] : '';
$ir_ref_no = isset($row['ir_ref_no']) ? $row['ir_ref_no'] : '';
$ir_ref_date = isset($row['ir_ref_date']) ? $row['ir_ref_date'] : '';
$para_status = isset($row['para_status']) ? $row['para_status'] : '';
$try_ref_no = isset($row['try_ref_no']) ? $row['try_ref_no'] : '';
$try_ref_date = isset($row['try_ref_date']) ? $row['try_ref_date'] : '';
$try_ir_remark = isset($row['try_ir_remark']) ? $row['try_ir_remark'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Treasury</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		  <div class="control-group">
            <label class="control-label">Treasury Code<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="tr_cd" name="tr_cd" value="<?php echo set_value('tr_cd',$tr_cd)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Treasury Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="tr_nm" name="tr_nm" value="<?php echo set_value('tr_nm',$tr_nm)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Para Year<span class="required"></span></label>
            <div class="controls">
              <input type="text" id="para_year" name="para_year" value="<?php echo set_value('para_year',$para_year)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Para Month<span class="required"></span></label>
            <div class="controls">
              <input type="text" id="para_month" name="para_month" value="<?php echo set_value('para_month',$para_month)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Para No<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="para_no" name="para_no" value="<?php echo set_value('para_no',$para_no)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <input type="text" name="para_desc" value="<?php echo set_value('para_desc',$para_desc)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">IR Reference</label>
            <div class="controls">
              <input type="text" name="ir_ref_no" value="<?php echo set_value('ir_ref_no',$ir_ref_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">IR Reference No</label>
            <div class="controls">
              <input type="text" name="ir_ref_date" value="<?php echo set_value('ir_ref_date',$ir_ref_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Treasury Ref No</label>
            <div class="controls">
              <input type="text" name="try_ref_no" value="<?php echo set_value('try_ref_no',$try_ref_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Treasury Ref Date</label>
            <div class="controls">
              <input type="text" name="try_ref_date" value="<?php echo set_value('try_ref_date',$try_ref_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Treasury Remark</label>
            <div class="controls">
              <input type="text" name="try_ir_remark" value="<?php echo set_value('try_ir_remark',$try_ir_remark)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Para Status</label>
            <div class="controls">
				<select id="para_status" name="para_status" class="form-control" >
					<option data-value="0" value=""> ---- Select Status----</option>
					<option data-value="1" value="Pending" <?=$row['para_status']=='Pending' ? 'selected="selected"': '' ;?>> Pending</option>
					<option data-value="2" value="Settled" <?=$row['para_status']=='Settled' ? 'selected="selected"': '' ;?>> Settled</option>
				</select>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_outsttanding_paras'">Cancel</button>
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