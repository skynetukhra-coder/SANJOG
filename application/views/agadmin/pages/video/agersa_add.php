<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> video</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal" enctype="multipart/form-data">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">Upload Video</label>
            <div class="controls">
			  <span>
			  	<input id="attachment" type="file" name="video" accept="video/*" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
			  	<div><button type="button" class="btn btn-inverse" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"></span></div>
			  </span>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
			  	<p class="error" style="color:red; font-weight:bold">Only .mp4 type file accepted</p>
			</div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>video/agersa'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function browse(){
	$('#attachment').click();
}
function previewImage(file_obj,container_id){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if(ext == 'mp4'){
			$('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
		}else{
	      $('#attachment').val(''); 
	      $('#'+container_id).html('');      
	      alert('file type not supported!');
	    }
	}
}
</script>