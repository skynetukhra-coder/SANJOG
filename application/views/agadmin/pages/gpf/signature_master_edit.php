<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$sec_off_id = isset($row['sec_off_id']) ? $row['sec_off_id'] : '';
$desig_code = isset($row['desig_code']) ? $row['desig_code'] : '';
$officer_desig = isset($row['officer_desig']) ? $row['officer_desig'] : '';
$series = isset($row['series']) ? $row['series'] : '';
$statement_year = isset($row['statement_year']) ? $row['statement_year'] : '2022-03-31';
$officer_name = isset($row['officer_name']) ? $row['officer_name'] : '';
$officer_name_hindi = isset($row['officer_name_hindi']) ? $row['officer_name_hindi'] : '';
$sign_tag = isset($row['sign_tag']) ? $row['sign_tag'] : '';
$update_dt = isset($row['update_dt']) ? $row['update_dt'] : '';
?>  
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Signature</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal"  enctype="multipart/form-data">
          <fieldset>
          <div class="control-group">
            <label class="control-label">Record ID:<span class="star">*</span></label>
				<div class="controls">
					<input type="text" id="sec_off_id" name="sec_off_id" value="<?php echo set_value('sec_off_id',$sec_off_id)?>" class="span12 m-wrap" required readonly>
				</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation Code:<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="desig_code" name="desig_code" value="<?php echo set_value('desig_code',$desig_code)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation:</label>
            <div class="controls">
              <input type="text" name="officer_desig" value="<?php echo set_value('officer_desig',$officer_desig)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Statement Series:</label>
            <div class="controls">
				 <select class="form-control" id="series_code" name="series" required>
						<option value="">--- <?php echo $this->lang->line('choose_series_code'); ?> ---</option>
							<?php
								if(isset($series_codes)){
									foreach($series_codes as $code){
										echo '<option value="'.$code['series'].'">'.$code['series'].'</option>';
									}
								}
							?>
				</select>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Statement Year:</label>
            <div class="controls">
				 <input type="text" name="statement_year" value="<?php echo get_datepicker_date(set_value('statement_year',$statement_year))?>" class=" m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name in English:</label>
            <div class="controls">
				 <input type="text" name="officer_name" value="<?php echo set_value('officer_name',$officer_name)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name in Hindi:</label>
            <div class="controls">
				 <input type="text" name="officer_name_hindi" value="<?php echo set_value('officer_name_hindi',$officer_name_hindi)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Upload Signature<br><span style="color:red;font-size:10px">[Image MAX Size 200px X 100px]</span></br></label>
            <div class="controls">
              <span>
                <input id="attachment" type="file" name="sign_tag[]" multiple class="span12 m-wrap" onchange="previewMultipleImage(this,'up_file_display')" style="display:none"/>
                <div><button type="button" class="btn btn-inverse" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($sign_tag != ''){echo '&nbsp;<a href="'.base_url().'files/agae/signature/'.$sign_tag.'" target="_blank">'.$sign_tag.'</a>';}?></span></div>
			  </span>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label"><span style="color:red;font-size:12px">OR<span style="color:red;font-size:10px">:</label>  
          </div>
		  <div class="control-group">
            <label class="control-label">Signature Tag <br><span style="color:red;font-size:12px">[if already uploadded]<br><span style="color:red;font-size:10px"></label>
            <div class="controls">
				 <input type="text" name="sign_tag_text" value="<?php echo set_value('sign_tag',$sign_tag)?>" class="span12 m-wrap" >
            </div>
          </div>
		    <div>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/signature_master'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function browse(){
	$('#attachment').click();
}
function previewMultipleImage(file_obj,container_id){
   if (file_obj.files && file_obj.files[0]) {
    for(var i = 0; i< file_obj.files.length; i++){
      var url = file_obj.files[i].name;
      var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();      
      if(ext == 'jpg' || ext == 'jpeg' || ext == 'png'){
        $('#'+container_id).append('<br/><em>&nbsp;&nbsp;' + url + '</em>');
      }else{
        $('#attachment').val('');
        $('#'+container_id).html('');      
        alert('file type not supported! Supported file types are : .jpg,.jpeg,.png,');
        break;
      }

    }   
  }
}
function filterEmployeeByDesignation(desig){
  desig = desig.toLowerCase();
   $('.emp-row').each(function(i){
      if(desig != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-designation') == desig){
          $(this).css('display','block');
        }
      }else{
        $(this).css('display','block');
      }
    });
   checkUncheckAll();
}

</script>