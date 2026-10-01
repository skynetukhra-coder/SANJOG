<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$reason_pp = isset($row['reason_pp']) ? $row['reason_pp'] : '';
$appli_date = isset($row['appli_date']) ? $row['appli_date'] : '';
$result_order_no = isset($row['result_order_no']) ? $row['result_order_no'] : '';
$result_order_dt = isset($row['result_order_dt']) ? $row['result_order_dt'] : '';
$sec_off_remrk = isset($row['sec_off_remrk']) ? $row['sec_off_remrk'] : '';
$sec_off_nm = isset($row['sec_off_nm']) ? $row['sec_off_nm'] : '';
$sec_off_dt = isset($row['sec_off_dt']) ? $row['sec_off_dt'] : '';
$bo_remrk = isset($row['bo_remrk']) ? $row['bo_remrk'] : '';
$bo_nm = isset($row['bo_nm']) ? $row['bo_nm'] : '';
$bo_dt = isset($row['bo_dt']) ? $row['bo_dt'] : '';
$dag_remk_rev = isset($row['dag_remk_rev']) ? $row['dag_remk_rev'] : '';
$dag_name_rev = isset($row['dag_name_rev']) ? $row['dag_name_rev'] : '';
$dag_dt_rev = isset($row['dag_dt_rev']) ? $row['dag_dt_rev'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">Update EPABX Extension Details</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">PAN<span class="required">*</span></label>
            <div class="controls">
				 <input type="text" name = "empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">NAME</label>
            <div class="controls">
               <input type="text" name = "name" value="<?php echo set_value('name',$name)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
               <input type="text" name = "desig" value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description<span class="required">*</span></label>
            <div class="controls">
              <input type="text" value="<?php echo set_value('reason_pp',$reason_pp)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Applied On<span class="required">*</span></label>
            <div class="controls">
               <input type="text"  value="<?php echo get_datepicker_date(set_value('appli_date',$appli_date))?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section In-charge<span class="required">*</span></label>
            <div class="controls">
               <input type="text"  value="<?php echo set_value('sec_off_remrk',$sec_off_remrk)?> / <?php echo set_value('sec_off_nm',$sec_off_nm)?>(<?php echo get_datepicker_date(set_value('sec_off_dt',$sec_off_dt))?>)" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Branch Officer<span class="required">*</span></label>
            <div class="controls">
                <input type="text"  value="<?php echo set_value('bo_remrk',$bo_remrk)?> / <?php echo set_value('bo_nm',$bo_nm)?>(<?php echo get_datepicker_date(set_value('bo_dt',$bo_dt))?>)" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Group Officer<span class="required">*</span></label>
            <div class="controls">
                <input type="text"  value="<?php echo set_value('dag_remk_rev',$dag_remk_rev)?> / <?php echo set_value('dag_name_rev',$dag_name_rev)?>(<?php echo get_datepicker_date(set_value('dag_dt_rev',$dag_dt_rev))?>)" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Appliication Status<span class="required"> </span></label>
            <div class="controls">
             <select id="appli_status" name="appli_status" class="form-control"  >
					<option data-value="0" value=""> ---- Select Status----</option>
					<option data-value="8" value="Completed" <?=$row['appli_status']=='Completed' ? 'selected="selected"': '' ;?>> Completed</option>
					<option data-value="1" value="Accepted" <?=$row['appli_status']=='Accepted' ? 'selected="selected"': '' ;?>> Accepted</option>
					<option data-value="2" value="Rejected" <?=$row['appli_status']=='Rejected' ? 'selected="selected"': '' ;?>> Rejected</option>
					<option data-value="3" value="NOC Issued" <?=$row['appli_status']=='NOC Issued' ? 'selected="selected"': '' ;?>>NOC Issued</option>
					<option data-value="4" value="Submitted" <?=$row['appli_status']=='Submitted' ? 'selected="selected"': '' ;?>>Submitted</option>
					<option data-value="5" value="Forwarded" <?=$row['appli_status']=='Forwarded' ? 'selected="selected"': '' ;?>>Forwarded</option>
					<option data-value="6" value="Recommended" <?=$row['appli_status']=='Recommended' ? 'selected="selected"': '' ;?>>Recommended</option>
					<option data-value="7" value="Returned" <?=$row['appli_status']=='Returned' ? 'selected="selected"': '' ;?>>Returned</option>
				</select>
            </div>
          </div>

		  <div class="control-group">
            <label class="control-label">Employee Concerned</label>
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
              <div class="epmloyees-list" style="width:100%; max-height: 300px; overflow: auto;">
        				 <?php
        			  foreach($employees as $emp){
        			    echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input type="checkbox" name="emp_pan" value="'.$emp['empname'].'@@@'.$emp['desig'].'@@@'.$emp['empid'].'" />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' ]</div>';
        			  }?>
              </div>
            </div>
          </div>

		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/application_passport_list'">Cancel</button>
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