<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$loan_id = isset($row['loan_id']) ? $row['loan_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$emp_section = isset($row['emp_section']) ? $row['emp_section'] : '';
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$office_nm = isset($row['office_nm']) ? $row['office_nm'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$loan_type = isset($row['loan_type']) ? $row['loan_type'] : '';
$interest_type = isset($row['interest_type']) ? $row['interest_type'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$loan_order_no = isset($row['loan_order_no']) ? $row['loan_order_no'] : '';
$order_date = isset($row['order_date']) ? $row['order_date'] : '';
$loan_amount = isset($row['loan_amount']) ? $row['loan_amount'] : '';
$installment_no = isset($row['installment_no']) ? $row['installment_no'] : '';
$interest = isset($row['interest']) ? $row['interest'] : '';
$paid_loan_amount = isset($row['paid_loan_amount']) ? $row['paid_loan_amount'] : '';
$bill_no = isset($row['bill_no']) ? $row['bill_no'] : '';
//$upload_dt = isset($row['upload_dt']) ? $row['upload_dt'] : '';
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
              <input type="text" id="desig" name="desig" value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap">
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
            <label class="control-label">Loan Type</label>
            <div class="controls">
              <input type="text" name="loan_type" value="<?php echo set_value('loan_type',$loan_type)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Interest Type</label>
            <div class="controls">
              <input type="text" name="interest_type" value="<?php echo set_value('interest_type',$interest_type)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <input type="text" name="description" value="<?php echo set_value('description',$description)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Loan Order No</label>
            <div class="controls">
              <input type="text" name="loan_order_no" value="<?php echo set_value('loan_order_no',$loan_order_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order date</label>
            <div class="controls">
              <input type="text" name="order_date" value="<?php echo set_value('order_date',$order_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Loan Amount</label>
            <div class="controls">
              <input type="text" name="loan_amount" value="<?php echo set_value('loan_amount',$loan_amount)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Installments</label>
            <div class="controls">
              <input type="text" name="installment_no" value="<?php echo set_value('installment_no',$installment_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Total Interest</label>
            <div class="controls">
              <input type="text" name="interest" value="<?php echo set_value('interest',$interest)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Total Amount Paid</label>
            <div class="controls">
              <input type="text" name="paid_loan_amount" value="<?php echo set_value('paid_loan_amount',$paid_loan_amount)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Bill No</label>
            <div class="controls">
              <input type="text" name="bill_no" value="<?php echo set_value('bill_no',$bill_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_ii/loan'">Cancel</button>
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