<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$tr_cd = isset($row['tr_cd']) ? $row['tr_cd'] : '';
$users = isset($row['users']) ? $row['users'] : '';
$user_name = isset($row['user_name']) ? $row['user_name'] : '';
$user_desig = isset($row['user_desig']) ? $row['user_desig'] : '';
$tr_nm = isset($row['tr_nm']) ? $row['tr_nm'] : '';
$emailid = isset($row['emailid']) ? $row['emailid'] : '';
$mb_no = isset($row['mb_no']) ? $row['mb_no'] : '';
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
            <label class="control-label">Users<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="users" name="users" value="<?php echo set_value('users',$users)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		 <div class="control-group">
            <label class="control-label">Treasury Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="tr_nm" name="tr_nm" value="<?php echo set_value('tr_nm',$tr_nm)?>" class="span12 m-wrap" required>
            </div>
          </div>
		 <div class="control-group">
            <label class="control-label">User Name<span class="required"></span></label>
            <div class="controls">
              <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name',$user_name)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">User Desig<span class="required"></span></label>
            <div class="controls">
              <input type="text" id="user_desig" name="user_desig" value="<?php echo set_value('user_desig',$user_desig)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mobile</label>
            <div class="controls">
              <input type="text" name="mb_no" value="<?php echo set_value('mb_no',$mb_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input type="text" name="emailid" value="<?php echo set_value('emailid',$emailid)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">New Password</label>
            <div class="controls">
              <input type="password" name="password" value="" class="span12 m-wrap" >
            </div>
          </div>
		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury'">Cancel</button>
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