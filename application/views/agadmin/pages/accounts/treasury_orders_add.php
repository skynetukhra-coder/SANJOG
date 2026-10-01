<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$title = isset($row['title']) ? $row['title'] : '';
$details = isset($row['details']) ? $row['details'] : '';
$upload_dt = isset($row['upload_dt']) ? date('d-m-Y',strtotime($row['upload_dt'])) : '';
$attachment = isset($row['attachment']) ? $row['attachment'] : '';
?>
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Office Order</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal"  enctype="multipart/form-data">
          <fieldset>
          <div class="control-group">
            <label class="control-label">Title<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="title" name="title" value="<?php echo set_value('title',$title)?>" data-required="1" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <textarea id="details" name="details" class="span12 m-wrap"> <?php echo set_value('details',$details)?></textarea>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office Order Date</label>
            <div class="controls">
             <input type="text" id="upload_dt" name="upload_dt" value="<?php echo $upload_dt?>" data-required="1" class="span12 m-wrap datepicker" data-provide="datepicker" autocomplete="off">
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Upload File</label>
            <div class="controls">
              <span>
                <input id="attachment" type="file" name="attachment[]" multiple class="span12 m-wrap" onchange="previewMultipleImage(this,'up_file_display')" style="display:none"/>
                <div><button type="button" class="btn btn-inverse" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"></span></div>
              </span>
    			  <?php /* ?>
            <span>
    			  	<input id="attachment" type="file" name="attachment[]" class="span12 m-wrap" multiple/>
    			  </span>
            <?php */ ?>
            </div>
          </div>
    		  <div class="control-group">
            <label class="control-label">Treasury Concerned</label>
            <div class="controls">
              <div class="filter-area">
                <div class="filter-row">
<!--                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
                    <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All
                  </div>
-->
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
                    <select id="filter-treasury" onchange="filterTreasuryByTryName(this.value)">
                      <option value="all">Select Treasury User</option>
                      <?php
                        foreach($description as $value){
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
              <div class="treasury-list" style="width:100%; max-height: 300px; overflow: auto;">
        				 <?php
        			  foreach($tryusers as $try){
        			  	echo '<div class="try-row" data-description="'.strtolower($try['tr_nm']).'"><input type="checkbox" name="tusers_concerned['.$try['users'].']" '.(in_array($try['users'],$asign_try) ? 'checked' : '').' />&nbsp; '.$try['tr_nm'].'  ['.$try['users'].' / '.$try['mb_no'].' ]</div>';
        			  }?>
              </div>
            </div>
          </div>
		    <div>
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_orders'">Cancel</button>
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
function filterTreasuryByTryName(tr_nm){
  tr_nm = tr_nm.toLowerCase();
   $('.try-row').each(function(i){
      if(tr_nm != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-description') == tr_nm){
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
  $('.try-row').each(function(i){
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
  var tr_nm = $('#filter-description').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.try-row').each(function(i){
    $(this).find('input').prop('checked',false);
    if(isChecked){
      if(tr_nm != 'all'){
        if($(this).attr('data-description') == tr_nm){
          $(this).find('input').prop('checked',true);
        }
      }else{
        $(this).find('input').prop('checked',true);
      }
    }    
  });
}
</script>