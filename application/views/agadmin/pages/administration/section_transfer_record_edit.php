<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$emp_id = isset($row['emp_id']) ? $row['emp_id'] : '';
$mbno = isset($row['mbno']) ? $row['mbno'] : '';
$emp_pic = isset($row['emp_pic']) ? $row['emp_pic'] : '';
$emp_name = isset($row['emp_name']) ? $row['emp_name'] : '';
$emp_desig = isset($row['emp_desig']) ? $row['emp_desig'] : '';
$order_group = isset($row['order_group']) ? $row['order_group'] : '';
$trans_order_no = isset($row['trans_order_no']) ? $row['trans_order_no'] : '';
$trans_order_dt = isset($row['trans_order_dt']) ? $row['trans_order_dt'] : '';
$trans_from_grp = isset($row['trans_from_grp']) ? $row['trans_from_grp'] : '';
$trans_from_sec = isset($row['trans_from_sec']) ? $row['trans_from_sec'] : '';
$trans_to_grp = isset($row['trans_to_grp']) ? $row['trans_to_grp'] : '';
$trans_to_sec = isset($row['trans_to_sec']) ? $row['trans_to_sec'] : '';
$charge_type = isset($row['charge_type']) ? $row['charge_type'] : '';
$trans_note = isset($row['trans_note']) ? $row['trans_note'] : '';
$trans_release_dt = isset($row['trans_release_dt']) ? $row['trans_release_dt'] : '';
$trans_join_dt = isset($row['trans_join_dt']) ? $row['trans_join_dt'] : '';
$status = isset($row['status']) ? $row['status'] : '';

?>
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php //echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Update Record</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">

        <form id="form_sample_1" method="post" class="form-horizontal"  enctype="multipart/form-data">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">Employee ID<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="emp_id" name="emp_id" value="<?php echo set_value('emp_id',$emp_id)?>"  class="span12 m-wrap " readonly >
			   <input type="hidden" id="mbno" name="mbno" value="<?php echo set_value('mbno',$mbno)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Employee Name [MB]<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="emp_name" name="emp_name" value="<?php echo set_value('emp_name',$emp_name)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="emp_desig" name="emp_desig" value="<?php echo set_value('emp_desig',$emp_desig)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Group <span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="order_group" name="order_group" value="<?php echo set_value('order_group',$order_group)?>" class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order No <span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="trans_order_no" name="trans_order_no" value="<?php echo set_value('trans_order_no',$trans_order_no)?>" class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Date<span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="trans_order_dt" name="trans_order_dt" value="<?php echo set_value('trans_order_dt',$trans_order_dt)?>" class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section Staff Category <span class="required">*</span></label>
            <div class="controls">
				<select id="staff_type" name="staff_type" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="Staff" >Dealing Staff</option>
					<option data-value="2" value="Incharge" > Section Incharge</option>
					<option data-value="3" value="BO" > Branch Officer</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Transfer From Group </label>
            <div class="controls">
				<input type="text" id="trans_from_grp" name="trans_from_grp" value="<?php echo isset($section_group['group_name']) ? $section_group['group_name']: ''?>" class="span12 m-wrap " readonly >
<!--
			 <select id="trans_from_grp" name="trans_from_grp" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" <?=$row['trans_from_grp']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" <?=$row['trans_from_grp']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
					<option data-value="3" value="FUND" <?=$row['trans_from_grp']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
					<option data-value="4" value="PENSION" <?=$row['trans_from_grp']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
				</select>
-->
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Transfer From Section<span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="trans_from_sec" name="trans_from_sec" value="<?php echo isset($section_group['section']) ? $section_group['section']: ''?>" class="span12 m-wrap " readonly >
<!--
				<select id="trans_from_sec" name="trans_from_sec"  >
					<option value=""> -- Select Section --</option>
						<?php
						if(isset($section_list) && !empty($section_list)){
							foreach($section_list as $sections){
								echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
							}
						}
					?>
				</select>
-->
            </div>
          </div>
		  		 
		 <div class="control-group">
            <label class="control-label">Releasing Authority</label>
            <div class="controls">
              <div class="filter-area">
                <div class="filter-row">
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
<!--                   <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All		-->
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
              <div class="epmloyees-list" style="border: 1px outset #d6d6c2; width:100%; max-height: 100px; overflow: auto;">
        				 <?php
        			  foreach($relea_officers as $emp){
        			  	   echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input type="radio" name="release_autho_pan" value="'.$emp['empname'].'@@@'.$emp['desig'].'@@@'.$emp['empid'].'" />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
        			  }?>
              </div>
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Transfer To Group</label>
            <div class="controls">
			   <select id="trans_to_grp" name="trans_to_grp" onchange="filterSectionsByGroup(this.value);filterEmployeeByDesignation2(this.value)" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" <?=$row['trans_to_grp']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" <?=$row['trans_to_grp']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
					<option data-value="3" value="FUND" <?=$row['trans_to_grp']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
					<option data-value="4" value="PENSION" <?=$row['trans_to_grp']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
					<option data-value="4" value="IAD" <?=$row['trans_to_grp']=='IAD' ? 'selected="selected"': '' ;?>> IAD</option>
					<option data-value="4" value="SECRETARIATE" <?=$row['trans_to_grp']=='SECRETARIATE' ? 'selected="selected"': '' ;?>> SECRETARIATE</option>
				</select>
            </div>
          </div>

		  <div class="control-group">
            <label class="control-label">Transfer To Section</label>
            <div class="controls">
              <div class="filter-area">
                <div class="filter-row">
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
 <!--                  <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All		-->
                  </div>
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
                
					<select id="filter-groups" onchange="filterSectionsByGroupS(this.value)">
                      <option value="all">Select Group</option>
                      <?php
                        foreach($groups as $value){
                          echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                      ?>
                    </select>
					
                  </div>
                  <div class="filter" style="display: inline-block; margin: 0px 0px 0px 10px;">
                    <input id="selected-only3" type="checkbox" onclick="checkSelectedOnly3()" /> &nbsp; Selected Only
                  </div>
                </div> 
              </div>
              <div class="epmloyees-list" style="border: 1px outset #d6d6c2; width:100%; max-height: 100px; overflow: auto;">
        				 <?php
        			  foreach($sections_list as $sec){
						echo '<div class="group-row" data-group="'.strtolower($sec['sec_br_group']).'"><input  type="checkbox"  name="emp_section['.$sec['sec_index'].']" value="'.$sec['section'].'" '.(in_array($sec['sec_index'],$emp_section) ? 'checked' : '').' />&nbsp; '.$sec['section'].'  ['.$sec['sec_index'].'  ]</div>';
						//echo '<div class="group-row" data-group="'.strtolower($sec['sec_br_group']).'"><input type="checkbox"  name="trans_emp_sec" value="'.$sec['sec_index'].'@@@'.$sec['section'].'" '.(in_array($sec['sec_index'],$emp_section) ? 'checked' : '').' />&nbsp; '.$sec['section'].'  ['.$sec['sec_index'].'  ]  || '.$sec['bo_index'].'</div>';
          			  }?>
              </div>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Branch To BO <br><span style = "color: red;">[Only for BO]</span></br></label>
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
              <div class="epmloyees-list" style="border: 1px outset #d6d6c2; width:100%; max-height: 100px; overflow: auto;">
        				 <?php
        			  foreach($branches as $branch){
        			  	 //echo '<div class="emp-row" data-group="'.strtolower($emp['desig']).'"><input type="checkbox" name="emp_branch['.$emp['empid'].']" '.(in_array($emp['empid'],$emp_branch) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].'/ '.$emp['mbno'].' ]</div>';
						 echo '<div class="group-row" data-group="'.strtolower($branch['sec_br_group']).'"><input type="checkbox"  name="emp_branch['.$branch['sec_index'].']" value="'.$branch['section'].'" '.(in_array($branch['sec_index'],$emp_branch) ? 'checked' : '').' />&nbsp; '.$branch['section'].'  ['.$branch['sec_index'].'  ]</div>';
        			  }?>
              </div>
            </div>
          </div>
		  
		  
		  
		  <div class="control-group">
            <label class="control-label">Joining Authority</label>
            <div class="controls">
              <div class="filter-area">
                <div class="filter-row">
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
 <!--                   <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All		-->
                  </div>
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
                    <select id="filter-designation2" onchange="filterEmployeeByDesignation2(this.value)">
                      <option value="all">Select Group</option>
                      <?php
                        foreach($jGroup as $value){
                          echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                      ?>
                    </select>
                  </div>
                  <div class="filter" style="display: inline-block; margin: 0px 0px 0px 10px;">
                    <input id="selected-only2" type="checkbox" onclick="checkSelectedOnly2()" /> &nbsp; Selected Only
                  </div>
                </div> 
              </div>
              <div class="epmloyees-list" style="border: 1px outset #d6d6c2; width:100%; max-height: 100px; overflow: auto;">
        				 <?php
        			  foreach($join_officers as $empj){
        			  	  echo '<div class="emp-row2" data-designation="'.strtolower($empj['group_name']).'"><input  type="radio" name="joing_autho_pan"  value="'.$empj['empname'].'@@@'.$empj['desig'].'@@@'.$empj['empid'].'" />&nbsp; '.$empj['empname'].'  ['.$empj['desig'].' / '.$empj['empid'].' ]</div>';
        			  }?>
              </div>
            </div>
          </div>		  

		  <div class="control-group">
            <label class="control-label">Order Type <span class="required">*</span></label>
            <div class="controls">
				<select id="charge_type" name="charge_type" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="Fresh" <?=$row['charge_type']=='Fresh' ? 'selected="selected"': '' ;?>> Fresh Transfer</option>
					<option data-value="2" value="Additional" <?=$row['charge_type']=='Additional' ? 'selected="selected"': '' ;?>> Additional Charge Allotment</option>
					<option data-value="3" value="Link" <?=$row['charge_type']=='Link' ? 'selected="selected"': '' ;?>> Link Charge Allotment</option>
				</select>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Transfer Note</label>
            <div class="controls">
              <textarea id="trans_note" name="trans_note" class="span12 m-wrap"> <?php echo set_value('trans_note',$trans_note)?></textarea>
            </div>
          </div>


	  
		  <div class="control-group">
            <label class="control-label">Released On</label>
            <div class="controls">
             <input type="text" id="trans_release_dt" name="trans_release_dt" value="<?php echo get_datepicker_date(set_value('trans_release_dt',$trans_release_dt))?>" class="span12 m-wrap datepicker" readonly >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Joined On</label>
            <div class="controls">
             <input type="text" id="trans_join_dt" name="trans_join_dt" value="<?php echo get_datepicker_date(set_value('trans_join_dt',$trans_join_dt))?>" class="span12 m-wrap datepicker" readonly >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Status</label>
            <div class="controls">
             <input type="text" id="status" name="status" value="<?php echo set_value('status',$status)?>" class="span12 m-wrap " readonly>
			</div>
          </div>
		  
		  <div>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_transfer_record'">Cancel</button>
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


function filterEmployeeByDesignation2(group_name){
  group_name = group_name.toLowerCase();
   $('.emp-row2').each(function(i){
      if(group_name != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-designation') == group_name){
          $(this).css('display','block');
        }
      }else{
        $(this).css('display','block');
      }
    });
   checkUncheckAll2();
}
function checkSelectedOnly2(){
  let isChecked = $('#selected-only2').is(':checked');
  $('.emp-row2').each(function(i){
    if(isChecked){
      if(!$(this).find('input').prop('checked')){
        $(this).css('display','none');
      }
    }else{
      $(this).css('display','block');
    }
  });
}
function checkUncheckAll2(){
  var desig = $('#filter-designation2').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.emp-row2').each(function(i){
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
function checkSelectedOnly3(){
  let isChecked = $('#selected-only3').is(':checked');
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
function checkUncheckAll3(){
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