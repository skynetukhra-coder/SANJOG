<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$encash_id = isset($row['encash_id']) ? $row['encash_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$emp_section = isset($row['emp_section']) ? $row['emp_section'] : '';
$group_nm = isset($row['group_nm']) ? $row['group_nm'] : '';
$office_nm = isset($row['office_nm']) ? $row['office_nm'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$ltc_htc = isset($row['ltc_htc']) ? $row['ltc_htc'] : '';
$encashment_no = isset($row['encashment_no']) ? $row['encashment_no'] : '';
$from_date = isset($row['from_date']) ? $row['from_date'] : '';
$to_date = isset($row['to_date']) ? $row['to_date'] : '';
$no_days_encash = isset($row['no_days_encash']) ? $row['no_days_encash'] : '';
$el_credit = isset($row['el_credit']) ? $row['el_credit'] : '';
$da_rate = isset($row['da_rate']) ? $row['da_rate'] : '';
$encash_amount = isset($row['encash_amount']) ? $row['encash_amount'] : '';
$income_tax_amount = isset($row['income_tax_amount']) ? $row['income_tax_amount'] : '';
$encash_order_no = isset($row['encash_order_no']) ? $row['encash_order_no'] : '';
$encash_date = isset($row['encash_date']) ? $row['encash_date'] : '';
$bill_no = isset($row['bill_no']) ? $row['bill_no'] : '';
$bill_date = isset($row['bill_date']) ? $row['bill_date'] : '';
$income_tax_status = isset($row['income_tax_status']) ? $row['income_tax_status'] : '';
$status = isset($row['status']) ? $row['status'] : '';

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
            <label class="control-label">Encashment NO</label>
            <div class="controls">
              <input type="text" name="encashment_no" value="<?php echo set_value('encashment_no',$encashment_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <input type="text" name="description" value="<?php echo set_value('description',$description)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">LTC / HTC</label>
            <div class="controls">
              <input type="text" name="ltc_htc" value="<?php echo set_value('ltc_htc',$ltc_htc)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">From Date</label>
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
            <label class="control-label">No of Days Encahsed</label>
            <div class="controls">
              <input type="text" name="no_days_encash" value="<?php echo set_value('no_days_encash',$no_days_encash)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">No of Days Encahsed</label>
            <div class="controls">
              <input type="text" name="el_credit" value="<?php echo set_value('el_credit',$el_credit)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">DA Rate</label>
            <div class="controls">
              <input type="text" name="da_rate" value="<?php echo set_value('da_rate',$da_rate)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Encashment Amount</label>
            <div class="controls">
              <input type="text" name="encash_amount" value="<?php echo set_value('encash_amount',$encash_amount)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">I.Tax Amount</label>
            <div class="controls">
              <input type="text" name="income_tax_amount" value="<?php echo set_value('income_tax_amount',$income_tax_amount)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">I.Tax Status</label>
            <div class="controls">
              <select id="income_tax_status" name="income_tax_status" class="form-control" required>
					<option data-value="0" value="">---- Select Status ----</option>
					<option data-value="1" value="Deducted">Deducted</option>
					<option data-value="2" value="Not Deducted">Not Deducted</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order No</label>
            <div class="controls">
              <input type="text" name="encash_order_no" value="<?php echo set_value('encash_order_no',$encash_order_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Date</label>
            <div class="controls">
              <input type="text" name="encash_date" value="<?php echo set_value('encash_date',$encash_date)?>" class="span12 m-wrap" >
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
              <input type="text" name="bill_date" value="<?php echo set_value('bill_date',$bill_date)?>" class="span12 m-wrap datepicker" >
            </div>
          </div>	
         <div class="control-group">
            <label class="control-label">Status</label>
            <div class="controls">
              <select id="status" name="status" class="form-control" required>
					<option data-value="0" value="">---- Select Status ----</option>
					<option data-value="1" value="Availed">Availed</option>
					<option data-value="2" value="Pending">Pending</option>
					<option data-value="3" value="Cancelled">Cancelled</option>
				</select>
            </div>
          </div>			  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_ii/encashment'">Cancel</button>
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