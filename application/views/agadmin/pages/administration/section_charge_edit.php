<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$empname = isset($row['empname']) ? $row['empname'] : '';
$emp_desig = isset($row['emp_desig']) ? $row['emp_desig'] : '';
$allot_group = isset($row['allot_group']) ? $row['allot_group'] : '';
$trans_order_no = isset($row['trans_order_no']) ? $row['trans_order_no'] : '';
$trans_order_dt = isset($row['trans_order_dt']) ? $row['trans_order_dt'] : '';
$allotment_dt = isset($row['allotment_dt']) ? $row['allotment_dt'] : '';
$charge_from_dt = isset($row['charge_from_dt']) ? $row['charge_from_dt'] : '';
$charge_to_dt = isset($row['charge_to_dt']) ? $row['charge_to_dt'] : '';
$allot_autho_nm = isset($row['allot_autho_nm']) ? $row['allot_autho_nm'] : '';
$allot_autho_desig = isset($row['allot_autho_desig']) ? $row['allot_autho_desig'] : '';
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
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Employee Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empname" name="empname" value="<?php echo set_value('empname',$empname)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="emp_desig" name="emp_desig" value="<?php echo set_value('emp_desig',$emp_desig)?>"  class="span12 m-wrap " readonly >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Order Issueing Group <span class="required">*</span></label>
            <div class="controls">
				<select id="allot_group" name="allot_group" class="form-control" required readonly>
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" <?=$row['allot_group']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" <?=$row['allot_group']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
					<option data-value="3" value="FUND" <?=$row['allot_group']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
					<option data-value="4" value="PENSION" <?=$row['allot_group']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
				</select>
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
				<input type="text" id="trans_order_dt" name="trans_order_dt" value="<?php echo set_value('trans_order_dt',$trans_order_dt)?>" class="span12 m-wrap datepicker" readonly >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Authority Name</label>
            <div class="controls">
             <input type="text" id="allot_autho_nm" name="allot_autho_nm" value="<?php echo set_value('allot_autho_nm',$allot_autho_nm)?>" class="span12 m-wrap " readonly >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Authority Designation</label>
            <div class="controls">
             <input type="text" id="allot_autho_desig" name="allot_autho_desig" value="<?php echo set_value('allot_autho_desig',$allot_autho_desig)?>" class="span12 m-wrap " readonly >
			</div>
          </div>
		 <div class="control-group">
            <label class="control-label">Allotment Date</label>
            <div class="controls">
             <input type="text" id="allotment_dt" name="allotment_dt" value="<?php echo get_datepicker_date(set_value('allotment_dt',$allotment_dt))?>" class="span12 m-wrap datepicker" readonly >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Charge Start Date</label>
            <div class="controls">
             <input type="text" id="charge_from_dt" name="charge_from_dt" value="<?php echo get_datepicker_date(set_value('charge_from_dt',$charge_from_dt))?>" class="span12 m-wrap datepicker" >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Charge End Date</label>
            <div class="controls">
             <input type="text" id="charge_to_dt" name="charge_to_dt" value="<?php echo get_datepicker_date(set_value('charge_to_dt',$charge_to_dt))?>" class="span12 m-wrap datepicker" >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Status</label>
            <div class="controls">
			 <select id="status" name="status" class="form-control" required >
					<option data-value="0" value=""> ---- Select Status----</option>
					<option data-value="1" value="Active"<?=$row['status']=='Active' ? 'selected="selected"': '' ;?>> Active</option>
					<option data-value="2" value="Closed" <?=$row['status']=='Closed' ? 'selected="selected"': '' ;?>> Closed</option>
				</select>
			</div>
          </div>
		  
		  <div>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_charge'">Cancel</button>
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

</script>