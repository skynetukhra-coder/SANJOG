<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$yr_ta = isset($row['yr_ta']) ? $row['yr_ta'] : '';
$tr_mn = isset($row['tr_mn']) ? $row['tr_mn'] : '';
$ddo = isset($row['ddo']) ? $row['ddo'] : '';
$tr_cd = isset($row['tr_cd']) ? $row['tr_cd'] : '';
$dept_old_remark = isset($row['dept_old_remark']) ? $row['dept_old_remark'] : '';
$dept_remark = isset($row['dept_remark']) ? $row['dept_remark'] : '';
$user_desig = isset($row['user_desig']) ? $row['user_desig'] : '';
$mb_no = isset($row['mb_no']) ? $row['mb_no'] : '';
$emailid = isset($row['emailid']) ? $row['emailid'] : '';
$password = isset($row['password']) ? $row['password'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) != '' ? 'Edit' : 'Add' ?> Department</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		   <div class="control-group">
            <label class="control-label">Financial Year<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="yr_ta" name="yr_ta" value="<?php echo set_value('yr_ta',$yr_ta)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Month<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="tr_mn" name="tr_mn" value="<?php echo set_value('tr_mn',$tr_mn)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Treasury Code<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="tr_cd" name="tr_cd" value="<?php echo set_value('tr_cd',$tr_cd)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">DDO Code<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="ddo" name="ddo" value="<?php echo set_value('ddo',$ddo)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Clasification Code<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="" name="" value="<?php echo $row['mjh_cd'] ?>-<?php echo $row['smjh_cd'] ?>-<?php echo $row['mih_cd'] ?>-<?php echo $row['sbh_cd'] ?>-<?php echo $row['dtlh_cd'] ?>-<?php echo $row['sdtlh_cd'] ?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Dept's Remark<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="" name="dept_old_remark" value="<?php echo set_value('dept_remark',$dept_remark)?>" class="span12 m-wrap" readonly>
			  <input type="hidden" name="dept_remark" value="" class="span12 m-wrap" >
            </div>
          </div>		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Reset' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department_loan_advance'">Cancel</button>
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