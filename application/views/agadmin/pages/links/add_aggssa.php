<?php
$page_name = isset($row['page_name']) ? $row['page_name'] : '';
$page_url = isset($row['page_url']) ? $row['page_url'] : '';
$filename = isset($row['filename']) ? $row['filename'] : '';
$wing = isset($row['wing']) ? $row['wing'] : '';
$status = isset($row['status']) ? $row['status'] : '';
?>

<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Link for <?php echo $this->lang->line('pr_ag_ssa'); ?></div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
          <fieldset>
          <div class="control-group">
            <label class="control-label">Link Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="dynamic_url_base" name="page_name" value="<?php echo set_value('page_name',$page_name)?>" data-required="1" class="span12 m-wrap" required>
			  <span class="help-block">&nbsp; ( Identification name only. It will not displayed in Site.)</span>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Status<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap" name="status" required>
				<option value="ACTIVE" <?php echo set_select('status', "ACTIVE", ($status == "ACTIVE" ? true : false)); ?> >Active</option>
				<option value="INACTIVE" <?php echo set_select('status', "INACTIVE", ($status == "INACTIVE" ? true : false)); ?> >Inactive</option>
              </select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Upload File<span class="required">*</span></label>
            <div class="controls">
			  <span>
			  	<input type="text" value="<?php echo $filename != '' ? $filename : '' ?>" id="disp_name" name="file_name" class="span12 m-wrap" readonly="readonly" />
				<br/>
			  	<div><button type="button" class="btn btn-inverse" onclick="open_fms_file('disp_name')" style="margin-top:5px"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($filename != ''){echo '&nbsp;<a href="'.$filename.'" target="_blank">'.$filename.'</a>';}?></span></div>
			  </span>
            </div>
          </div>
		  <div>
		  
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>contents/aggssa'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="roxyCustomPanel2" style="display: none;"  title="File Management">
  <iframe src="/agwb/editor/filemanager/index.html?integration=custom&type=files&txtFieldId=disp_name" style="width:100%;height:100%" frameborder="0">
  </iframe>
</div>
<script>
$(document).ready(function(){
	$('#dynamic_url_base').on('blur',function(){
		var txt = $(this).val();
		ckeckUniqueURL(txt);
	});
	$('#dynamic_url').on('blur',function(){
		var txt = $(this).val();
		ckeckUniqueURL(txt);
	});
});
function ckeckUniqueURL(txt){
	var set_url = txt.replace(/\s+/g, '-').toLowerCase();
	if($.trim(set_url) == ''){
		return;
	}
	$('#dynamic_url').val(set_url);
	// check url exists
	$.ajax({
		'url':'<?php echo ADMIN_BASE_URL?>pages/check_url_exists/<?php echo $this->uri->segment(4) ?>',
		'data':{'url':set_url},
		'success' : function(data){
			var obj = $.parseJSON(data);
			var status = obj.status;
			if(status){
				$('#dynamic_url').css('border','1px solid red');
				$('#dynamic_url').focus();
				$('#error_text_url').text('This url already exists!');
			}else{
				$('#dynamic_url').css('border','1px solid #ccc');
				$('#dynamic_url_abs').text(set_url);
				$('#error_text_url').text('');
			}
		}
	});
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