<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$try_insp_id = isset($row['try_insp_id']) ? $row['try_insp_id'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$tr_nm = isset($row['tr_nm']) ? $row['tr_nm'] : '';
$emp_section = isset($row['emp_section']) ? $row['emp_section'] : '';
$try_insp_year = isset($row['try_insp_year']) ? $row['try_insp_year'] : '';
$try_insp_month = isset($row['try_insp_month']) ? $row['try_insp_month'] : '';
$treasury_nm = isset($row['treasury_nm']) ? $row['treasury_nm'] : '';
$dist_nam = isset($row['dist_nam']) ? $row['dist_nam'] : '';
$period_under_inspct = isset($row['period_under_inspct']) ? $row['period_under_inspct'] : '';
$try_insp_from = isset($row['try_insp_from']) ? $row['try_insp_from'] : '';
$try_insp_to = isset($row['try_insp_to']) ? $row['try_insp_to'] : '';
$insp_days = isset($row['insp_days']) ? $row['insp_days'] : '';
$insp_party_nos	 = isset($row['insp_party_nos']) ? $row['insp_party_nos'] : '';
$try_insp_order = isset($row['try_insp_order']) ? $row['try_insp_order'] : '';
$insp_order_date = isset($row['insp_order_date']) ? $row['insp_order_date'] : '';
$nos_ir_paras = isset($row['nos_ir_paras']) ? $row['nos_ir_paras'] : '';
$advance_bill_no = isset($row['advance_bill_no']) ? $row['advance_bill_no'] : '';
$adv_bill_date = isset($row['adv_bill_date']) ? $row['adv_bill_date'] : '';
$adv_bill_amt = isset($row['adv_bill_amt']) ? $row['adv_bill_amt'] : '';
$bill_no = isset($row['bill_no']) ? $row['bill_no'] : '';
$bill_date = isset($row['bill_date']) ? $row['bill_date'] : '';
$bill_amt = isset($row['bill_amt']) ? $row['bill_amt'] : '';
$insp_status = isset($row['insp_status']) ? $row['insp_status'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Employee Training</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		  <div class="control-group">
            <label class="control-label">Inspection ID<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="try_insp_id" name="try_insp_id" value="<?php echo set_value('try_insp_id',$try_insp_id)?>" class="span12 m-wrap" required readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name <span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="name" value="<?php echo set_value('name',$name)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="desig" value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section<span class="required">*</span></label>
			<div class="controls">
				<input type="text" name="emp_section" value="<?php echo set_value('emp_section',$emp_section)?>" class="span12 m-wrap" readonly>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Inspection ID<span class="required">*</span></label>
			<div class="controls">
				<input type="text" name="try_insp_id" value="<?php echo set_value('try_insp_id',$try_insp_id)?>" class="span12 m-wrap" readonly>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year <span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="try_insp_year" value="<?php echo set_value('try_insp_year',$try_insp_year)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Month<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="try_insp_month" value="<?php echo set_value('try_insp_month',$try_insp_month)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Treasury<span class="required">*</span></label>
			<div class="controls">
				<input type="text" name="treasury_nm" value="<?php echo set_value('treasury_nm',$treasury_nm)?>" class="span12 m-wrap" readonly>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">District<span class="required">*</span></label>
			<div class="controls">
				<input type="text" name="dist_nam" value="<?php echo set_value('dist_nam',$dist_nam)?>" class="span12 m-wrap" readonly>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Period Under Inspecion<span class="required">*</span></label>
			<div class="controls">
				<input type="text" name="period_under_inspct" value="<?php echo set_value('period_under_inspct',$period_under_inspct)?>" class="span12 m-wrap" readonly>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Inspecion From<span class="required">*</span> </label>
            <div class="controls">
              <input type="text" name="try_insp_from" value="<?php echo set_value('try_insp_from',$try_insp_from)?>" class="span12 m-wrap datepicker" readonly>
			 </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Inspecion To<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="try_insp_to" value="<?php echo set_value('try_insp_to',$try_insp_to)?>" class="span12 m-wrap datepicker" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Inspecion Days</label>
            <div class="controls">
              <input type="text" name="insp_days" value="<?php echo set_value('insp_days',$insp_days)?>" class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Party No</label>
            <div class="controls">
              <input type="text" name="insp_party_nos" value="<?php echo set_value('insp_party_nos',$insp_party_nos)?>" class="span12 m-wrap " readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order No</label>
            <div class="controls">
              <input type="text" name="try_insp_order" value="<?php echo set_value('try_insp_order',$try_insp_order)?>" class="span12 m-wrap "readonly >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Date</label>
            <div class="controls">
              <input type="text" name="insp_order_date" value="<?php echo set_value('insp_order_date',$insp_order_date)?>" class="span12 m-wrap" readonly >
            </div>
          </div> 
		   <div class="control-group">
            <label class="control-label">Advance Bill No</label>
            <div class="controls">
              <input type="text" name="advance_bill_no" value="<?php echo set_value('advance_bill_no',$advance_bill_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Advance Bill Date </label>
            <div class="controls">
              <input type="text" name="adv_bill_date" value="<?php echo set_value('adv_bill_date',$adv_bill_date)?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Advance Bill Amount</label>
            <div class="controls">
              <input type="text" name="adv_bill_amt" value="<?php echo set_value('adv_bill_amt',$adv_bill_amt)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Bill No</label>
            <div class="controls">
              <input type="text" name="bill_no" value="<?php echo set_value('bill_no',$bill_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Bill Date </label>
            <div class="controls">
              <input type="text" name="bill_date" value="<?php echo set_value('bill_date',$bill_date)?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Bill Amount</label>
            <div class="controls">
              <input type="text" name="bill_amt" value="<?php echo set_value('bill_amt',$bill_amt)?>" class="span12 m-wrap " >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Status<span class="required">*</span></label>
            <div class="controls">
              <select class="form-control" name="insp_status" required>
					<option value="">-----Select Month----</option>
					<option value="Pending" <?php echo set_select('insp_status', "Pending", ($insp_status == "Pending" ? true : false)); ?>  >Pending</option>
					<option value="Inspcted" <?php echo set_select('insp_status', "Inspcted", ($insp_status == "Inspcted" ? true : false)); ?>  >Inspcted</option>
				  </select>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspector_record'">Cancel</button>
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
</script>