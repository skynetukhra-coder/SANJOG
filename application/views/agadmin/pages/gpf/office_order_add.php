<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$title = isset($row['title']) ? $row['title'] : '';
$details = isset($row['details']) ? $row['details'] : '';
$order_dt = isset($row['order_dt']) ? date('d-m-Y',strtotime($row['order_dt'])) : '';
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
            <label class="control-label">Wing:<span class="star">*</span></label>
				<div class="controls">
					<select name="wing" class="form-control" required>
						<option value="">-----Select Wing----</option>
						<option value="administration" <?php echo $this->input->get('wing') == 'administration' ? 'selected' : ''?> ><?php echo $this->lang->line('administrator_wing'); ?></option>
						<option value="record" <?php echo $this->input->get('wing') == 'record' ? 'selected' : ''?> ><?php echo $this->lang->line('record_wing'); ?></option>
						<option value="accounts" <?php echo $this->input->get('wing') == 'accounts' ? 'selected' : ''?> ><?php echo $this->lang->line('accounts_wing'); ?></option>
						<option value="fund" <?php echo $this->input->get('wing') == 'fund' ? 'selected' : ''?> ><?php echo $this->lang->line('fund_wing'); ?></option>
						<option value="pension" <?php echo $this->input->get('wing') == 'pension' ? 'selected' : ''?> ><?php echo $this->lang->line('pension_wing'); ?></option>
						<option value="training" <?php echo $this->input->get('wing') == 'training' ? 'selected' : ''?> ><?php echo $this->lang->line('training_wing'); ?></option>
						<option value="da_cadre" <?php echo $this->input->get('wing') == 'da_cadre' ? 'selected' : ''?> ><?php echo $this->lang->line('da_cadre_wing'); ?></option>
					</select>
				</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Title<span class="required">*</span></label>
              <div class="controls">
              <select id="title" name="title" class="form-control" required>
					<option data-value="0" value="">---- Select Title ----</option>
					<option data-value="1" value="Office Order">Office Order</option>
					<option data-value="2" value="Service Book">Service Book</option>
					<option data-value="3" value="GPF Statement">GPF Statement</option>
				</select>
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <textarea id="details" name="details" class="span12 m-wrap"> <?php echo set_value('details',$details)?></textarea>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Date</label>
            <div class="controls">
             <input type="text" id="order_dt" name="order_dt" value="<?php echo set_value('order_dt',$order_dt)?>" data-required="1" class="span12 m-wrap datepicker" data-provide="datepicker" autocomplete="off">
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
            <label class="control-label">Employee Concerned</label>
            <div class="controls">
              <div class="filter-area">
                <div class="filter-row">
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
<!--                    <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All		-->
                  </div>
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
                    <select id="filter-designation" onchange="filterEmployeeByDesignation(this.value)">
                      <option value="all">Select Designation</option>
                      <?php
                        foreach($designation as $value){
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
              <div class="epmloyees-list" style="width:100%; max-height: 300px; overflow: auto;">
        				 <?php
        			  foreach($employees as $emp){
						//echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input type="checkbox" name="emp_concerned['.$emp['empid'].']" '.(in_array($emp['empid'],$asign_emp) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
						echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input type="checkbox"  name="emp_concerned['.$emp['empid'].']" value="'.$emp['mbno'].'" '.(in_array($emp['empid'],$asign_emp) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' / '.$emp['mbno'].' ]</div>';
        			  }?>
              </div>
            </div>
          </div>
		    <div>
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/office_order'">Cancel</button>
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
      if(ext ==  'pdf'){
        $('#'+container_id).append('<br/><em>&nbsp;&nbsp;' + url + '</em>');
      }else{
        $('#attachment').val('');
        $('#'+container_id).html('');      
        alert('file type not supported! Supported file types is ".pdf" only');
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