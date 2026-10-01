<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$office_id = isset($row['office_id']) ? $row['office_id'] : '';
$empname = isset($row['empname']) ? $row['empname'] : '';
$father_name = isset($row['father_name']) ? $row['father_name'] : '';
$group_name = isset($row['group_name']) ? $row['group_name'] : '';
$gender = isset($row['gender']) ? $row['gender'] : '';
$mbno = isset($row['mbno']) ? $row['mbno'] : '';
$category = isset($row['category']) ? $row['category'] : '';
$stream = isset($row['stream']) ? $row['stream'] : '';
$dob = isset($row['dob']) ? $row['dob'] : '';
$dor = isset($row['dor']) ? $row['dor'] : '';
$nicmail = isset($row['nicmail']) ? $row['nicmail'] : '';
$nicmail_proposed = isset($row['nicmail_proposed']) ? $row['nicmail_proposed'] : '';
$email = isset($row['email']) ? $row['email'] : '';
$doapp = isset($row['doapp']) ? $row['doapp'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$office = isset($row['office']) ? $row['office'] : 'PR. ACCOUNTANT GENERAL (A&E) WEST BENGAL';
$dept_appt = isset($row['dept_appt']) ? $row['dept_appt'] : 'INDIAN AUDIT AND ACCOUNTS DEPARTMENT';
$doj_off = isset($row['doj_off']) ? $row['doj_off'] : '';
$promotion_dt = isset($row['promotion_dt']) ? $row['promotion_dt'] : '';
$promo_from = isset($row['promo_from']) ? $row['promo_from'] : '';
$trans_from = isset($row['trans_from']) ? $row['trans_from'] : '';
$trans_order_dt = isset($row['trans_order_dt']) ? $row['trans_order_dt'] : '';
$joning_type = isset($row['joning_type']) ? $row['joning_type'] : '';
$blodd_grp = isset($row['blodd_grp']) ? $row['blodd_grp'] : '';
$service_bk_no = isset($row['service_bk_no']) ? $row['service_bk_no'] : '';
$id_cardno = isset($row['id_cardno']) ? $row['id_cardno'] : '';
$voter_cardno = isset($row['voter_cardno']) ? $row['voter_cardno'] : '';
$aadhaar_cardno = isset($row['aadhaar_cardno']) ? $row['aadhaar_cardno'] : '';
$gpf_ac_no = isset($row['gpf_ac_no']) ? $row['gpf_ac_no'] : '';
$deputation_status = isset($row['deputation_status']) ? $row['deputation_status'] : '';
$emp_status = isset($row['emp_status']) ? $row['emp_status'] : '';
$picture = isset($row['picture']) ? $row['picture'] : '';
$status = isset($row['status']) ? $row['status'] : '';

// Details
$offic_id = isset($row['offic_id']) ? $row['offic_id'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$qualifi = isset($row['qualifi']) ? $row['qualifi'] : '';
$address1 = isset($row['address1']) ? $row['address1'] : '';
$state = isset($row['state']) ? $row['state'] : '';
$district = isset($row['district']) ? $row['district'] : '';
$postoffice = isset($row['postoffice']) ? $row['postoffice'] : '';
$pin = isset($row['pin']) ? $row['pin'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$grd_slno = isset($row['grd_slno']) ? $row['grd_slno'] : '';
$grd_pageno = isset($row['grd_pageno']) ? $row['grd_pageno'] : '';
$id_cardno = isset($row['id_cardno']) ? $row['id_cardno'] : '';
$gratuity_nomination = isset($row['gratuity_nomination']) ? $row['gratuity_nomination'] : '';
$gis_nomination = isset($row['gis_nomination']) ? $row['gis_nomination'] : '';
$do_exp = isset($row['do_exp']) ? $row['do_exp'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">Update Employee's Section</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
<!--		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>			-->
		  <div class="control-group">
            <label class="control-label">Employee PAN<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" required readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office ID(Master)<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="office_id" name="office_id" value="<?php echo set_value('office_id',$office_id)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office ID(Details)<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="offic_id" name="offic_id" value="<?php echo set_value('offic_id',$offic_id)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Employee Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empname" name="empname" value="<?php echo strtoupper(set_value('empname',$empname))?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Picture<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="picture" name="picture" value="<?php echo set_value('picture',$picture)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office</label>
            <div class="controls">
              <input type="text" name="office" value="PR. ACCOUNTANT GENERAL (A&E) WEST BENGAL" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Department</label>
            <div class="controls">
              <input type="text" name="dept_appt" value="INDIAN AUDIT AND ACCOUNTS DEPARTMENT" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Section</label>
            <div class="controls">
              <input type="text" name="section" value="<?php echo set_value('section',$section)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Group</label>
            <div class="controls">
              <select id="group_name" name="group_name" class="form-control" >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" <?=$row['group_name']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" <?=$row['group_name']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
					<option data-value="3" value="FUND" <?=$row['group_name']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
					<option data-value="4" value="PENSION" <?=$row['group_name']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
					<option data-value="5" value="IAD" <?=$row['group_name']=='IAD' ? 'selected="selected"': '' ;?>>IAD</option>
					<option data-value="6" value="SECRETARIATE" <?=$row['group_name']=='SECRETARIATE' ? 'selected="selected"': '' ;?>> SECRETARIATE</option>
					<option data-value="7" value="DIVISIONAL ACCOUNTANT" <?=$row['group_name']=='DIVISIONAL ACCOUNTANT' ? 'selected="selected"': '' ;?>> DIVISIONAL ACCOUNTANT</option>
				</select>
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
            <label class="control-label">Section Assignment</label>
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
						 echo '<div class="group-row" data-group="'.strtolower($sec['sec_br_group']).'"><input type="checkbox"  name="emp_section['.$sec['sec_index'].']" value="'.$sec['section'].'" '.(in_array($sec['sec_index'],$emp_section) ? 'checked' : '').' />&nbsp; '.$sec['section'].'  ['.$sec['sec_index'].'  ]</div>';
        			  }?>
              </div>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Branch Assignment </label>
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
						 echo '<div class="group-row" data-group="'.strtolower($branch['sec_br_group']).'"><input  type="checkbox"  name="emp_branch['.$branch['sec_index'].']" value="'.$branch['section'].'" '.(in_array($branch['sec_index'],$emp_section) ? 'checked' : '').' />&nbsp; '.$branch['section'].'  ['.$branch['sec_index'].'  ]</div>';
        			  }?>
              </div>
            </div>
          </div>
		  
		   
		  <div class="control-group">
            <label class="control-label">Login Status<span class="required">*</span></label>
            <div class="controls">
              <select id="status" name="status" class="form-control" required>
					<option data-value="0" value="">---- Select Status ----</option>
					<option data-value="1" value="Active" <?=$row['status']=='Active' ? 'selected="selected"': '' ;?>>Active</option>
					<option data-value="2" value="Deactivated" <?=$row['status']=='Deactivated' ? 'selected="selected"': '' ;?>>Deactivate</option>
				</select>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee'">Cancel</button>
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
		}else{
			$('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
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