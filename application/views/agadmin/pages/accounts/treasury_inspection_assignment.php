<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$try_insp_id = isset($row['try_insp_id']) ? $row['try_insp_id'] : '';
$insp_year = isset($row['insp_year']) ? $row['insp_year'] : '';
$insp_month = isset($row['insp_month']) ? $row['insp_month'] : '';
$tr_nm = isset($row['tr_nm']) ? $row['tr_nm'] : '';
$dist_nm = isset($row['dist_nm']) ? $row['dist_nm'] : '';
$period_under_insp = isset($row['period_under_insp']) ? $row['period_under_insp'] : '';
$insp_party_no = isset($row['insp_party_no']) ? $row['insp_party_no'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$insp_from = isset($row['insp_from']) ? $row['insp_from'] : '';
$insp_to = isset($row['insp_to']) ? $row['insp_to'] : '';
$insp_days = isset($row['insp_days']) ? $row['insp_days'] : '';
$insp_order = isset($row['insp_order']) ? $row['insp_order'] : '';
$order_date = isset($row['order_date']) ? $row['order_date'] : '';
$distance_hq = isset($row['distance_hq']) ? $row['distance_hq'] : '';
$report_hq = isset($row['report_hq']) ? $row['report_hq'] : '';
$try_ir_no = isset($row['try_ir_no']) ? $row['try_ir_no'] : '';
$try_ir_date = isset($row['try_ir_date']) ? $row['try_ir_date'] : '';
$nos_ir_paras = isset($row['nos_ir_paras']) ? $row['nos_ir_paras'] : '';
$ir_file_link = isset($row['ir_file_link']) ? $row['ir_file_link'] : '';

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
            <label class="control-label">Inspection ID<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="try_insp_id" name="try_insp_id" value="<?php echo set_value('try_insp_id',$try_insp_id)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="insp_year" name="insp_year" value="<?php echo date('Y');?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Month<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="insp_month" name="insp_month" value="<?php echo date('F');?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Party No<span class="required">*</span></label>
            <div class="controls">
				<select id="insp_party_no" name="insp_party_no" class="form-control" >
					<option data-value="0" value="">--Select--</option>
						<option data-value="1" value="Treasury Part-I" selected="selected" > Treasury Part-I </option>
						<option data-value="2" value="Treasury Part-II" selected="selected" > Treasury Part-II </option>
						<option data-value="1" value="Treasury Part-III" selected="selected" > Treasury Part-III </option>
						<option data-value="1" value="Treasury Part-IV" selected="selected" > Treasury Part-IV </option>
					</select>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Treasury<span class="required">*</span></label>
            <div class="controls">
				<select name="tr_nm" style="height:34px;">
					<option value=""> -- Select --</option>
					<?php
						if(isset($treasuries) && !empty($treasuries)){
							foreach($treasuries as $try){
								echo '<option value="'.$try['tr_nm'].'">'.$try['tr_nm'].'</option>';
							}
						}
					?>
				</select>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">District </label>
            <div class="controls">
				<select name="dist_nm" style="height:34px;">
					<option value=""> -- Select --</option>
					<?php
						if(isset($districts) && !empty($districts)){
							foreach($districts as $dist){
								echo '<option value="'.$dist['dist_name'].'">'.$dist['dist_name'].'</option>';
							}
						}
						?>
				</select>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Period Under Inspection<span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="period_under_insp" name="period_under_insp" value="<?php echo set_value('period_under_insp',$period_under_insp)?>" class="span12 m-wrap "  >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <textarea id="description" name="description" class="span12 m-wrap"  > <?php echo set_value('description',$description)?></textarea>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">From</label>
            <div class="controls">
				<input type="text" id="insp_from" name="insp_from" value="<?php echo set_value('insp_from',$insp_from)?>" class="span12 m-wrap datepicker "  >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">To<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="insp_to" name="insp_to" value="<?php echo set_value('insp_to',$insp_to)?>"  class="span12 m-wrap  datepicker"  >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">No of Days <span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="insp_days" name="insp_days" value="<?php echo set_value('insp_days',$insp_days)?>" class="span12 m-wrap "  >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">File No</label>
            <div class="controls">
             <input type="text" id="insp_order" name="insp_order" value="<?php echo set_value('insp_order',$insp_order)?>"  class="span12 m-wrap "  >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Approval Date</label>
            <div class="controls">
             <input type="text" id="order_date" name="order_date" value="<?php echo set_value('order_date',$order_date)?>" class="span12 m-wrap datepicker"  >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Distance from HQ<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="distance_hq" value="<?php echo set_value('distance_hq',$distance_hq)?>" class="span12 m-wrap "required >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Report to HQ<span class="required">*</span> </label>
            <div class="controls">
              <input type="text" name="report_hq" value="<?php echo set_value('report_hq',$report_hq)?>" class="span12 m-wrap datepicker" required>
			 </div>
          </div>
<!--		  
		  <div class="control-group">
            <label class="control-label">Order No<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="insp_order" value="<?php echo set_value('insp_order',$insp_order)?>" class="span12 m-wrap "required >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Date<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="order_date" value="<?php echo set_value('order_date',$order_date)?>" class="span12 m-wrap" required >
            </div>
          </div> 
-->
		   <div class="control-group">
            <label class="control-label">IR No</label>
            <div class="controls">
              <input type="text" name="try_ir_no" value="<?php echo set_value('try_ir_no',$try_ir_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">IT Issue Date </label>
            <div class="controls">
              <input type="text" name="try_ir_date" value="<?php echo set_value('try_ir_date',$try_ir_date)?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">No of Paras</label>
            <div class="controls">
              <input type="text" name="nos_ir_paras" value="<?php echo set_value('nos_ir_paras',$nos_ir_paras)?>" class="span12 m-wrap " >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">IR PDF link</label>
            <div class="controls">
              <input type="text" name="ir_file_link" value="<?php echo set_value('ir_file_link',$ir_file_link)?>" class="span12 m-wrap"  placeholder ="Full URL" >
            </div>
          </div>
    	 <div class="control-group">
            <label class="control-label">Employee Concerned</label>
            <div class="controls">
              <div class="filter-area">
                <div class="filter-row">
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
                    <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All
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
              <div class="epmloyees-list" style="border: 1px outset #d6d6c2; width:100%; max-height: 200px; overflow: auto;">
        				 <?php
        			  foreach($employees as $emp){
        			  	 //echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input type="checkbox" name="emp_concerned['.$emp['empid'].']" '.(in_array($emp['empid'],$asign_emp) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].'/ '.$emp['mbno'].' ]</div>';
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
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspection'">Cancel</button>
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