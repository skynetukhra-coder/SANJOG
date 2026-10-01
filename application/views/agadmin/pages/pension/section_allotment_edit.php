<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$empname = isset($row['empname']) ? $row['empname'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$sectn_indx = isset($row['sec_br_group']) ? $row['sec_br_group'] : '';
$section_desc = isset($row['section_desc']) ? $row['section_desc'] : '';
$charge_type = isset($row['charge_type']) ? $row['charge_type'] : '';

?>
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php //echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?>Section Record</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">

        <form id="form_sample_1" method="post" class="form-horizontal"  enctype="multipart/form-data">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">Employee ID<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name<span class="required">*</span></label>
            <div class="controls">
			    <input type="text" id="empname" name="empname" value="<?php echo set_value('empname',$empname)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
			   <input type="text" id="desig" name="desig" value="<?php echo set_value('desig',$desig)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section <span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="section_desc" name="section_desc" value="<?php echo set_value('section_desc',$section_desc)?>" class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Charge Type <span class="required">*</span></label>
            <div class="controls">
				<select id="charge_type" name="charge_type" class="form-control" required >
					<option data-value="0" value=""> ---- Select Type----</option>
					<option data-value="1" value="Primary" <?=$row['charge_type']=='Primary' ? 'selected="selected"': '' ;?>> Primary Charge</option>
					<option data-value="2" value="Additional" <?=$row['charge_type']=='Additional' ? 'selected="selected"': '' ;?>> Additional Charge</option>
					<option data-value="3" value="Link" <?=$row['charge_type']=='Link' ? 'selected="selected"': '' ;?>> Link Charge</option>
				</select>
            </div>
          </div>
		  <div>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/section_allotment'">Cancel</button>
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
      if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'doc' || ext == 'docx' || ext == 'csv' || ext == 'xls' || ext == 'xlsx' || ext == 'pdf'){
        $('#'+container_id).append('<br/><em>&nbsp;&nbsp;' + url + '</em>');
      }else{
        $('#attachment').val('');
        $('#'+container_id).html('');      
        alert('file type not supported! Supported file types are : .jpg,.png,.jpeg,.doc,.docx,.csv,.xls,.xlsx,.pdf');
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
function checkSelectedOnly(){
  let isChecked = $('#selected-only').is(':checked');
  $('.emp-row').each(function(i){
    if(isChecked){
      if(!$(this).find('input').prop('checked')){
        $(this).css('display','none');
      }
    }else{
      $(this).css('display','block');
    }
  });
}
function checkUncheckAll(){
  var desig = $('#filter-designation').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.emp-row').each(function(i){
    $(this).find('input').prop('checked',false);
    if(isChecked){
      if(desig != 'all'){
        if($(this).attr('data-designation') == desig){
          $(this).find('input').prop('checked',true);
        }
      }else{
        $(this).find('input').prop('checked',true);
      }
    }    
  });
}
</script>