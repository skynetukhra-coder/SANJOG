<?php
$title = $row['title'] ?? '';
$title_hindi = $row['title_hindi'] ?? '';
$title_bengali = $row['title_bengali'] ?? '';
$image = $row['image'] ?? '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Gallery</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal" enctype="multipart/form-data">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">Title in English<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="" name="title" value="<?php echo set_value('title',$title)?>" data-required="1" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Title in Hindi<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="" name="title_hindi" value="<?php echo set_value('title_hindi',$title_hindi)?>" data-required="1" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Title in Bengali<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="" name="title_bengali" value="<?php echo set_value('title_bengali',$title_bengali)?>" data-required="1" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Upload File</label>
            <div class="controls">
			  <span>
			  	<input id="attachment" type="file" name="image" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
			  	<div><button type="button" class="btn btn-inverse" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($image != ''){echo '&nbsp;<img src="'.base_url().'galleryIMG/thumb/'.$image.'"/>';}?></span></div>
			  </span>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gallery'">Cancel</button>
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
		if(ext == 'jpg' || ext == 'jpeg' || ext == 'png'){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#' + container_id).html('<img src="" style="max-height:150px; max-width:150px; margin:5px; border:1px solid gray;">');
				$('#' + container_id + ' img').attr('src', e.target.result);
			};
			reader.readAsDataURL(file_obj.files[0]);
		}else{
      $('#attachment').val(''); 
      $('#'+container_id).html('');      
      alert('file type not supported! Supported file types are : .jpg,.png,.jpeg,.doc,.docx,.csv,.xls,.xlsx,.pdf');
    }
	}
}
</script>