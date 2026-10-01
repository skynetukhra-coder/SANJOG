<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$bill_id = isset($row['bill_id']) ? $row['bill_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$emp_section = isset($row['emp_section']) ? $row['emp_section'] : '';
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$office_nm = isset($row['office_nm']) ? $row['office_nm'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$bill_no = isset($row['bill_no']) ? $row['bill_no'] : '';
$bill_date = isset($row['bill_date']) ? $row['bill_date'] : '';
$bill_amount = isset($row['bill_amount']) ? $row['bill_amount'] : '';
$bill_type = isset($row['bill_type']) ? $row['bill_type'] : '';
$description = isset($row['description']) ? $row['description'] : '';
//$block	 = isset($row['block']) ? $row['block'] : '';
$from_date = isset($row['from_date']) ? $row['from_date'] : '';
$to_date = isset($row['to_date']) ? $row['to_date'] : '';
$block = isset($row['block']) ? $row['block'] : '';
$child_no = isset($row['child_no']) ? $row['child_no'] : '';
$child_select = isset($row['child_select']) ? $row['child_select'] : '';
$location = isset($row['location']) ? $row['location'] : '';
$treatment_type = isset($row['treatment_type']) ? $row['treatment_type'] : '';
$doctor = isset($row['doctor']) ? $row['doctor'] : '';
$fit_unfit = isset($row['fit_unfit']) ? $row['fit_unfit'] : '';
$amount_paid = isset($row['amount_paid']) ? $row['amount_paid'] : '';
$payment_date = isset($row['payment_date']) ? $row['payment_date'] : '';
$advance_bill_no = isset($row['advance_bill_no']) ? $row['advance_bill_no'] : '';
$status = isset($row['status']) ? $row['status'] : '';
?>

<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Employee</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		  <div class="control-group">
            <label class="control-label">Employee Id<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name <span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="name" name="name" value="<?php echo set_value('name',$name)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="desig" name="desig" value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section</label>
            <div class="controls">
              <input type="text" id="emp_section" name="emp_section" value="<?php echo set_value('emp_section',$emp_section)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Group</label>
            <div class="controls">
              <input type="text" id="group_nm" name="group_nm" value="<?php echo set_value('group_nm',$group_nm)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office</label>
            <div class="controls">
              <input type="text" id="office_nm" name="office_nm" value="<?php echo set_value('office_nm',$office_nm)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Basic Pay</label>
            <div class="controls">
              <input type="text" name="basic_pay" value="<?php echo set_value('basic_pay',$basic_pay)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Bill Type</label>
            <div class="controls">
              <input type="text" name="bill_type" value="<?php echo set_value('bill_type',$bill_type)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <input type="text" name="description" value="<?php echo set_value('description',$description)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Bill No</label>
            <div class="controls">
              <input type="text" name="bill_no" value="<?php echo set_value('bill_no',$bill_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Bill Date</label>
            <div class="controls">
              <input type="text" name="bill_date" value="<?php echo set_value('bill_date',$bill_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Bill Amount</label>
            <div class="controls">
              <input type="text" name="bill_amount" value="<?php echo set_value('bill_amount',$bill_amount)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Advance Bill No</label>
            <div class="controls">
              <input type="text" name="advance_bill_no" value="<?php echo set_value('advance_bill_no',$advance_bill_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Fron Date</label>
            <div class="controls">
              <input type="text" name="from_date" value="<?php echo set_value('from_date',$from_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">To Date</label>
            <div class="controls">
              <input type="text" name="to_date" value="<?php echo set_value('to_date',$to_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Block Year/ Session</label>
            <div class="controls">
              <input type="text" name="block" value="<?php echo set_value('block',$block)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Child No</label>
            <div class="controls">
              <input type="text" name="child_no" value="<?php echo set_value('child_no',$child_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Child For</label>
            <div class="controls">
              <input type="text" name="child_select" value="<?php echo set_value('child_select',$child_select)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Location </label>
            <div class="controls">
              <input type="text" name="location" value="<?php echo set_value('location',$location)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Treatment Type </label>
            <div class="controls">
              <input type="text" name="treatment_type" value="<?php echo set_value('treatment_type',$treatment_type)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Doctor's Name </label>
            <div class="controls">
              <input type="text" name="doctor" value="<?php echo set_value('doctor',$doctor)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Fit Un-Fit </label>
            <div class="controls">
              <input type="text" name="fit_unfit" value="<?php echo set_value('fit_unfit',$fit_unfit)?>" class="span12 m-wrap" >
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Amount Paid</label>
            <div class="controls">
              <input type="text" name="amount_paid" value="<?php echo set_value('amount_paid',$amount_paid)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Payment Date</label>
            <div class="controls">
              <input type="text" name="payment_date" value="<?php echo set_value('payment_date',$payment_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Status</label>
            <div class="controls">
              <input type="text" name="status" value="<?php echo set_value('status',$status)?>" class="span12 m-wrap" required >
            </div>
          </div>		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_ii/bills'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
	
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
</script>