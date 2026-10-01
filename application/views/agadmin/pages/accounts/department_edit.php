<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$dept_id = isset($row['dept_id']) ? $row['dept_id'] : '';
$users = isset($row['users']) ? $row['users'] : '';
$grnt_cd = isset($row['grnt_cd']) ? $row['grnt_cd'] : '';
$grnt_d = isset($row['grnt_d']) ? $row['grnt_d'] : '';
$user_name = isset($row['user_name']) ? $row['user_name'] : '';
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
            <label class="control-label">Department Code<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="grnt_cd" name="grnt_cd" value="<?php echo set_value('grnt_cd',$grnt_cd)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Department Users</label>
            <div class="controls">
              <input type="text" id="users" name="users" value="<?php echo set_value('users',$users)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Department Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="grnt_d" name="grnt_d" value="<?php echo set_value('grnt_d',$grnt_d)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">User's Name</label>
            <div class="controls">
              <input type="text" name="user_name" value="<?php echo set_value('user_name',$user_name)?>" class="span12 m-wrap" >
            </div>
          </div>	
		  <div class="control-group">
            <label class="control-label">User's Designation</label>
            <div class="controls">
              <input type="text" name="user_desig" value="<?php echo set_value('user_desig',$user_desig)?>" class="span12 m-wrap" >
            </div>
          </div>		  
		  <div class="control-group">
            <label class="control-label">User's Mobile</label>
            <div class="controls">
              <input type="text" name="mb_no" value="<?php echo set_value('mb_no',$mb_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">User's Email</label>
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
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/department'">Cancel</button>
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