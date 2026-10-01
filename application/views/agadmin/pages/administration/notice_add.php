<?php
$title = isset($row['title']) ? $row['title'] : '';
$title_hindi = isset($row['title_hindi']) ? $row['title_hindi'] : '';
$title_bengali = isset($row['title_bengali']) ? $row['title_bengali'] : '';
$link_file = isset($row['link_file']) ? $row['link_file'] : '';
$url_link = isset($row['url_link']) ? $row['url_link'] : '';
$display = isset($row['display']) ? $row['display'] : '';
$flash = isset($row['flash']) ? $row['flash'] : '';
$expiry_dt = isset($row['expiry_dt']) && $row['expiry_dt'] != '0000-00-00' ? date('d-m-Y',strtotime($row['expiry_dt'])) : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Whats new</div>
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
<!--
		  <div class="control-group">
            <label class="control-label">Upload File</label>
            <div class="controls">
			  <span>
			  	<input id="attachment" type="file" name="link_file" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
			  	<div><button type="button" class="btn btn-inverse" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($link_file != ''){echo '&nbsp;<a href="'.$link_file.'" target="_blank">'.$link_file.'</a>';}?></span></div>
			  </span>
            </div>
          </div>
-->
		  <div class="control-group">
            <label class="control-label">Link Full Url</label>
            <div class="controls">
              <input type="text" id="" name="url_link" value="<?php echo set_value('url_link',$url_link)?>" data-required="1" class="span12 m-wrap" placeholder = "Do not enter URL for flash notice.">
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Display ?</label>
            <div class="controls">
				<select id="display" name="display" class="form-control" >
					<option data-value="0" value=""> ---- Select Display----</option>
					<option data-value="1" value="yes"> Yes</option>
					<option data-value="2" value="no"> No</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Flash / Notice ?</label>
            <div class="controls">
				<select id="flash" name="flash" class="form-control" >
					<option data-value="0" value=""> ---- Select Display----</option>
					<option data-value="1" value="word"> Flash Word</option>
					<option data-value="2" value="yes"> Flash Notice</option>
					<option data-value="3" value="no"> Notice</option>
					<option data-value="4" value="acheivement">Acheivement</option>
					<option data-value="5" value="performance">Performance</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Expiry Date<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="expiry_dt" value="<?php echo set_value('expiry_dt',$expiry_dt)?>" class="span12 m-wrap datepicker" data-provide="datepicker" autocomplete="off" required>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/notice'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy',minDate:'today'});
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
		if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'doc' || ext == 'docx' || ext == 'csv' || ext == 'xls' || ext == 'xlsx' || ext == 'pdf'){
      $('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
    }else{
      $('#attachment').val(''); 
      $('#'+container_id).html('');      
      alert('file type not supported! Supported file types are : .jpg,.png,.jpeg,.doc,.docx,.csv,.xls,.xlsx,.pdf');
    }
	}
}
</script>