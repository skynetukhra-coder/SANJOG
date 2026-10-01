<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$sec_index = isset($row['sec_index']) ? $row['sec_index'] : '';
$sec_br_type = isset($row['sec_br_type']) ? $row['sec_br_type'] : '';
$sec_br_group = isset($row['sec_br_group']) ? $row['sec_br_group'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$officer_nm = isset($row['officer_nm']) ? $row['officer_nm'] : '';

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
            <label class="control-label">Section ID<span class="required">*</span></label>
            <div class="controls">
              <input <?php echo empty($row['sec_index']) ?'':'readonly' ?> type="text" id="sec_index" name="sec_index" value="<?php echo set_value('sec_index',$sec_index)?>"  class="span12 m-wrap "  >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Type<span class="required">*</span></label>
            <div class="controls">
			   <select id="sec_br_type" name="sec_br_type" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="section" > Section </option>
					<option data-value="2" value="branch" > Branch</option>
				</select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Group<span class="required">*</span></label>
            <div class="controls">
			  <select id="sec_br_group" name="sec_br_group" onchange="filterSectionsByGroup(this.value);" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" >ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" >ACCOUNTS</option>
					<option data-value="3" value="FUND" >FUND</option>
					<option data-value="4" value="PENSION" >PENSION</option>
					<option data-value="5" value="IAD" >IAD</option>
					<option data-value="6" value="SECRETARIATE" >SECRETARIATE</option>
				</select>
            </div>
          </div>
		  		   <div class="control-group">
            <label class="control-label">Branch Officer <br><span style = "color: red;"></span></br></label>
            <div class="controls">
              <div class="filter-area">			  
                <div class="filter-row">
<!--
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
                    <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All
                  </div>
-->
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
                    <select id="filter-groups" onchange="filterSectionsByGroup(this.value)">
                      <option value="all">Select Group</option>
                      <?php
                        foreach($groups as $value){
                          echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                      ?>
                    </select>

                  </div>
                  <div class="filter" style="display: inline-block; margin: 0px 0px 0px 10px;">
                    <input id="selected-only" type="checkbox" onclick="checkSelectedOnly()" /> &nbsp; Selected Only
                  </div>

                </div> 
              </div>
              <div class="epmloyees-list" style="border: 1px outset #d6d6c2; width:100%; max-height: 200px; overflow: auto;">
        				 <?php
        			  foreach($branches as $branch){
						 echo '<div class="group-row" data-group="'.strtolower($branch['sec_br_group']).'"><input type="radio"  name="emp_branch" value="'.$branch['sec_index'].'@@@'.$branch['section'].'" '.(in_array($branch['sec_index'],$branch) ? '' : '').' />&nbsp; '.$branch['section'].'</div>';
        			  }?>
              </div>
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Section <span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="section" name="section" value="<?php echo set_value('section',$section)?>" class="span12 m-wrap " required >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Officer's Name <span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="officer_nm" name="officer_nm" value="<?php echo set_value('officer_nm',$officer_nm)?>" class="span12 m-wrap "  >
            </div>
          </div>
		  <div>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section'">Cancel</button>
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
function filterSectionsByGroup(sec_br_group){
  sec_br_group = sec_br_group.toLowerCase();
   $('.group-row').each(function(i){
      if(sec_br_group != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-group') == sec_br_group){
          $(this).css('display','block');
        }
      }else{
        $(this).css('display','block');
      }
    });
   checkUncheckAll3();
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