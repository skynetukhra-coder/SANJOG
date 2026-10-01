<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$trang_id = isset($row['trang_id']) ? $row['trang_id'] : '';
$empid = isset($row['empid']) ? $row['empid'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$emp_section = isset($row['emp_section']) ? $row['emp_section'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$training_order = isset($row['training_order']) ? $row['training_order'] : '';
$fin_year = isset($row['fin_year']) ? $row['fin_year'] : '';
$order_date = isset($row['order_date']) ? $row['order_date'] : '';
$training_type = isset($row['training_type']) ? $row['training_type'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$location	 = isset($row['location']) ? $row['location'] : '';
$training_from = isset($row['training_from']) ? $row['training_from'] : '';
$training_to = isset($row['training_to']) ? $row['training_to'] : '';
$training_days = isset($row['training_days']) ? $row['training_days'] : '';
$evaluation_link = isset($row['evaluation_link']) ? $row['evaluation_link'] : '';
$eval_status = isset($row['eval_status']) ? $row['eval_status'] : '';
$bill_no = isset($row['bill_no']) ? $row['bill_no'] : '';
$advance_bill_no = isset($row['advance_bill_no']) ? $row['advance_bill_no'] : '';
//$upload_dt = isset($row['upload_dt']) ? $row['upload_dt'] : '';
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
            <label class="control-label">Employee Id<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Trainig ID<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="trang_id" name="trang_id" value="<?php echo set_value('trang_id',$trang_id)?>" class="span12 m-wrap" required readonly>
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
            <label class="control-label">Basic Pay</label>
            <div class="controls">
              <input type="text" name="basic_pay" value="<?php echo set_value('basic_pay',$basic_pay)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year</label>
            <div class="controls">
              <input type="text" name="fin_year" value="<?php echo set_value('fin_year',$fin_year)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Training Order</label>
            <div class="controls">
              <input type="text" name="training_order" value="<?php echo set_value('training_order',$training_order)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Date</label>
            <div class="controls">
              <input type="text" name="order_date" value="<?php echo set_value('order_date',$order_date)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Training Type</label>
            <div class="controls">
              <input type="text" name="training_type" value="<?php echo set_value('training_type',$training_type)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <input type="text" name="description" value="<?php echo set_value('description',$description)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Location</label>
            <div class="controls">
              <input type="text" name="location" value="<?php echo set_value('location',$location)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Training From</label>
            <div class="controls">
              <input type="text" name="training_from" value="<?php echo set_value('training_from',$training_from)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Training To</label>
            <div class="controls">
              <input type="text" name="training_to" value="<?php echo set_value('training_to',$training_to)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Training Days</label>
            <div class="controls">
              <input type="text" name="training_days" value="<?php echo set_value('training_days',$training_days)?>" class="span12 m-wrap" >
            </div>
          </div> 
		   <div class="control-group">
            <label class="control-label">Evaluation / Link</label>
            <div class="controls">
              <input type="text" name="evaluation_link" value="<?php echo set_value('evaluation_link',$evaluation_link)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Evaluation Status</label>
            <div class="controls">
				<select name="eval_status" class="form-control" required>
					<option value=""> -- Select Training--</option>
					<option data-value="1" value="Pending" <?php echo $this->input->get('eval_status') == 'Pending' ? 'selected' : ''?> >Pending</option>
					<option data-value="2" value="Over"<?php echo $this->input->get('eval_status') == 'Over' ? 'selected' : ''?> >Over</option>
				</select>
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Bill No</label>
            <div class="controls">
              <input type="text" name="bill_no" value="<?php echo set_value('bill_no',$bill_no)?>" class="span12 m-wrap" >
            </div>
          </div>  
		  <div class="control-group">
            <label class="control-label">Advance Bill No</label>
            <div class="controls">
              <input type="text" name="advance_bill_no" value="<?php echo set_value('advance_bill_no',$advance_bill_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  
		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>training/training'">Cancel</button>
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