<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$sec_br_group = isset($row['sec_br_group']) ? $row['sec_br_group'] : '';

$empid = isset($row['empid']) ? $row['empid'] : '';
$office_id = isset($row['office_id']) ? $row['office_id'] : '';
$empname = isset($row['empname']) ? $row['empname'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$group_name = isset($row['group_name']) ? $row['group_name'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$order_group = isset($row['order_group']) ? $row['order_group'] : '';
$trans_order_no = isset($row['trans_order_no']) ? $row['trans_order_no'] : '';
$trans_order_dt = isset($row['trans_order_dt']) ? $row['trans_order_dt'] : '';
$allotment_dt = isset($row['allotment_dt']) ? $row['allotment_dt'] : '';
$allot_autho_nm = isset($row['allot_autho_nm']) ? $row['allot_autho_nm'] : '';
$allot_autho_desig = isset($row['allot_autho_desig']) ? $row['allot_autho_desig'] : '';
$status = isset($row['status']) ? $row['status'] : '';
?>
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php //echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Initial Section / Branch Assignment</div>
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
            <label class="control-label">Employee Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="emp_name" name="emp_name" value="<?php echo set_value('empname',$empname)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="desig" name="emp_desig" value="<?php echo set_value('desig',$desig)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Group<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="group_name" name="allot_group" value="<?php echo set_value('group_name',$group_name)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Section<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="section" name="section" value="<?php echo set_value('section',$section)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Order Issueing Group <span class="required">*</span></label>
            <div class="controls">
				<select id="allot_group" name="allot_group" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" > ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" > ACCOUNTS</option>
					<option data-value="3" value="FUND" >FUND</option>
					<option data-value="4" value="PENSION" > PENSION</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order No <span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="trans_order_no" name="trans_order_no" value="<?php echo set_value('trans_order_no',$trans_order_no)?>" class="span12 m-wrap "  >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Date<span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="trans_order_dt" name="trans_order_dt" value="<?php echo set_value('trans_order_dt',$trans_order_dt)?>" class="span12 m-wrap datepicker"  >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Authority Name</label>
            <div class="controls">
             <input type="text" id="allot_autho_nm" name="allot_autho_nm" value="<?php echo set_value('allot_autho_nm',$allot_autho_nm)?>" class="span12 m-wrap " >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Authority Designation</label>
            <div class="controls">
             <input type="text" id="allot_autho_desig" name="allot_autho_desig" value="<?php echo set_value('allot_autho_desig',$allot_autho_desig)?>" class="span12 m-wrap " >
			</div>
          </div>
		 <div class="control-group">
            <label class="control-label">Allotment Date</label>
            <div class="controls">
             <input type="text" id="allotment_dt" name="allotment_dt" value="<?php echo get_datepicker_date(set_value('allotment_dt',$allotment_dt))?>" class="span12 m-wrap datepicker" >
			</div>
          </div>	
		  <div class="control-group">
            <label class="control-label">Section Staff Category <span class="required">*</span></label>
            <div class="controls">
				<select id="staff_type" name="staff_type" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="Incharge" > Section Incharge</option>
					<option data-value="2" value="BO" > Branch Officer</option>
					<option data-value="3" value="Staff" >Dealing Staff</option>
				</select>
            </div>
          </div>
		 <div class="control-group">
            <label class="control-label">Present Group <span class="required">*</span></label>
            <div class="controls">
				<select id="present_group" name="present_group" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" > ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" > ACCOUNTS</option>
					<option data-value="3" value="FUND" >FUND</option>
					<option data-value="4" value="PENSION" > PENSION</option>
				</select>
            </div>
          </div>
    	 <div class="control-group">
            <label class="control-label">Section Assignment <br><span style = "color: red;">[For Section Incharge]</span></br></label>
            <div class="controls">
              <div class="filter-area">
                <div class="filter-row">
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
 <!--                  <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All		-->
                  </div>
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
        			  foreach($sections as $sec){
        			  	 //echo '<div class="emp-row" data-group="'.strtolower($emp['desig']).'"><input type="checkbox" name="emp_section['.$emp['empid'].']" '.(in_array($emp['empid'],$emp_section) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].'/ '.$emp['mbno'].' ]</div>';
						 echo '<div class="group-row" data-group="'.strtolower($sec['sec_br_group']).'"><input  type="checkbox"  name="emp_section['.$sec['sec_index'].']" value="'.$sec['section'].'" '.(in_array($sec['sec_index'],$emp_section) ? 'checked' : '').' />&nbsp; '.$sec['section'].'  ['.$sec['sec_index'].'  ]</div>';
        			  }?>
              </div>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Branch Assignment <br><span style = "color: red;">[For Branch Officer]</span></br></label>
            <div class="controls">
              <div class="filter-area">
<!--			  
                <div class="filter-row">
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
                    <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All
                  </div>
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
-->
              </div>
              <div class="epmloyees-list" style="border: 1px outset #d6d6c2; width:100%; max-height: 200px; overflow: auto;">
        				 <?php
        			  foreach($branches as $branch){
        			  	 //echo '<div class="emp-row" data-group="'.strtolower($emp['desig']).'"><input type="checkbox" name="emp_branch['.$emp['empid'].']" '.(in_array($emp['empid'],$emp_section) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].'/ '.$emp['mbno'].' ]</div>';
						 echo '<div class="group-row" data-group="'.strtolower($branch['sec_br_group']).'"><input type="checkbox"  name="emp_branch['.$branch['sec_index'].']" value="'.$branch['section'].'" '.(in_array($branch['sec_index'],$emp_section) ? 'checked' : '').' />&nbsp; '.$branch['section'].'  ['.$branch['sec_index'].'  ]</div>';
        			  }?>
              </div>
            </div>
          </div>
		  
		    <div>
				<input type="hidden" id="status" name="status" value="Active"  class="span12 m-wrap " readonly >
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_bo_incharge'">Cancel</button>
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
   checkUncheckAll();
}
function checkSelectedOnly(){
  let isChecked = $('#selected-only').is(':checked');
  $('.group-row').each(function(i){
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
  var sections = $('#filter-groups').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.group-row').each(function(i){
    $(this).find('input').prop('checked',false);
    if(isChecked){
      if(sections != 'all'){
        if($(this).attr('data-group') == sections){
          $(this).find('input').prop('checked',true);
        }
      }else{
        $(this).find('input').prop('checked',true);
      }
    }    
  });
}
</script>