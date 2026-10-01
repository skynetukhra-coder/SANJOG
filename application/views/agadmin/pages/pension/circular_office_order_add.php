<?php
$wing = isset($row['wing']) ? $row['wing'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$description_hindi = isset($row['description_hindi']) ? $row['description_hindi'] : '';
$description_bengali = isset($row['description_bengali']) ? $row['description_bengali'] : '';
$pdf_name = isset($row['pdf_name']) ? $row['pdf_name'] : '';
$url_link = isset($row['url_link']) ? $row['url_link'] : '';
$sl_no = isset($row['sl_no']) ? $row['sl_no'] : 0;
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Circular Office Order</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">Description in English<span class="required">*</span></label>
            <div class="controls">
              <textarea id="details" name="description" class="span12 m-wrap"><?php echo set_value('description',$description)?></textarea>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description in Hindi<span class="required">*</span></label>
            <div class="controls">
              <textarea id="details_hindi" name="description_hindi" class="span12 m-wrap"><?php echo set_value('description_hindi',$description_hindi)?></textarea>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description in Bengali<span class="required">*</span></label>
            <div class="controls">
              <textarea id="details_bengali" name="description_bengali" class="span12 m-wrap"><?php echo set_value('description_bengali',$description_bengali)?></textarea>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Wing<span class="required">*</span></label>
            <div class="controls">
				  <select class="span12 m-wrap" name="wing" required>
					<option value="">-----Select Wing----</option>
					<option value="administration" <?php echo set_select('wing', "administration", ($wing == "administration" ? true : false)); ?>  >Administration</option>
					<option value="accounts" <?php echo set_select('wing', "accounts", ($wing == "accounts" ? true : false)); ?> >Accounts</option>
					<option value="fund" <?php echo set_select('wing', "fund", ($wing == "fund" ? true : false)); ?> >Fund</option>
					<option value="pension" <?php echo set_select('wing', "pension", ($wing == "pension" ? true : false)); ?> >Pension</option>
					<option value="da_cadre" <?php echo set_select('wing', "da_cadre", ($wing == "da_cadre" ? true : false)); ?> >DA Cadre Wing</option>
				  </select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Upload File</label>
            <div class="controls">
      			  <span>
      			  	<input id="attachment" type="file" name="attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
      			  	<div><button type="button" class="btn btn-inverse" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($pdf_name != ''){echo '&nbsp;<a href="'.base_url().'files/'.$pdf_name.'" target="_blank">'.$pdf_name.'</a>';}?></span></div>
      			  </span>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Link Url</label>
            <div class="controls">
              <input type="text" id="" name="url_link" value="<?php echo set_value('url_link',$url_link)?>" data-required="1" class="span12 m-wrap">
			  <span class="help-block">&nbsp; (Optional, add Full Url or upload file.)</span>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Sl no.</label>
            <div class="controls">
              <input type="text" id="" name="sl_no" value="<?php echo set_value('sl_no',$sl_no)?>" data-required="1" class="span12 m-wrap">
			  <span class="help-block">&nbsp; (Optional, Sorting index no.)</span>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>pension/circular_office_order'">Cancel</button>
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
    }else if(ext == 'doc' || ext == 'docx' || ext == 'csv' || ext == 'xls' || ext == 'xlsx' || ext == 'pdf'){
      $('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
    }else{
      $('#attachment').val(''); 
      $('#'+container_id).html('');      
      alert('file type not supported! Supported file types are : .jpg,.png,.jpeg,.doc,.docx,.csv,.xls,.xlsx,.pdf');
    }
  }
}
</script>