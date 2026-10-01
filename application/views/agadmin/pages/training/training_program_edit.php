<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$trang_id = isset($row['trang_id']) ? $row['trang_id'] : '';
$fin_year = isset($row['fin_year']) ? $row['fin_year'] : '';
$training_mode = isset($row['training_mode']) ? $row['training_mode'] : '';
$training_type = isset($row['training_type']) ? $row['training_type'] : '';
$title = isset($row['title']) ? $row['title'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$location	 = isset($row['location']) ? $row['location'] : '';
$training_from = isset($row['training_from']) ? $row['training_from'] : '';
$training_to = isset($row['training_to']) ? $row['training_to'] : '';
$training_days = isset($row['training_days']) ? $row['training_days'] : '';
$trg_time = isset($row['trg_time']) ? $row['trg_time'] : '';
$training_assign_dt = isset($row['training_assign_dt']) ? $row['training_assign_dt'] : '';
$training_order = isset($row['training_order']) ? $row['training_order'] : '';
$order_date = isset($row['order_date']) ? $row['order_date'] : '';
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
            <label class="control-label">Training ID<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="trang_id" name="trang_id" value="<?php echo set_value('trang_id',$trang_id)?>" class="span12 m-wrap" required readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year <span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="fin_year" name="fin_year" value="<?php echo set_value('fin_year',$fin_year)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Location</label>
            <div class="controls">
				<select id="location" name="location" class="form-control" required>
					<option data-value="0" value=""> ---- Select Training Location----</option>
					<option data-value="1" value="In-house"<?=$row['location']=='In-house' ? 'selected="selected"': '' ;?>> In-house</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Trainig Mode<span class="required">*</span></label>
            <div class="controls">
				<select id="training_mode" name="training_mode" class="form-control" required>
					<option data-value="0" value=""> ---- Select Training Mode----</option>
					<option data-value="1" value="Online"<?=$row['training_mode']=='Online' ? 'selected="selected"': '' ;?>> Online</option>
					<option data-value="2" value="Offline"<?=$row['training_mode']=='Offline' ? 'selected="selected"': '' ;?>> Offline</option>
					
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Training Type<span class="required">*</span></label>
            <div class="controls">
              <select id="training_type" name="training_type" class="form-control" required>
					<option data-value="0" value=""> ---- Select Training Type----</option>
					<option data-value="1" value="EDP Training"<?=$row['training_type']=='EDP Training' ? 'selected="selected"': '' ;?>> EDP Training</option>
					<option data-value="2" value="Non-EDP Training"<?=$row['training_type']=='Non-EDP Training' ? 'selected="selected"': '' ;?>> Non-EDP Training</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Title </label>
            <div class="controls">
              <input type="text" name="title" value="<?php echo set_value('title',$title)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <input type="text" name="description" value="<?php echo set_value('description',$description)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Training From</label>
            <div class="controls">
              <input type="text" name="training_from" value="<?php echo get_datepicker_date(set_value('training_from',$training_from))?>" class="span12 m-wrap datepicker" required >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Training To</label>
            <div class="controls">
              <input type="text" name="training_to" value="<?php echo get_datepicker_date(set_value('training_to',$training_to))?>" class="span12 m-wrap datepicker"required >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Training Days</label>
            <div class="controls">
              <input type="text" name="training_days" value="<?php echo set_value('training_days',$training_days)?>" class="span12 m-wrap" required >
            </div>
          </div> 
		   <div class="control-group">
            <label class="control-label">Training Time</label>
            <div class="controls">
              <input type="text" name="trg_time" value="<?php echo set_value('trg_time',$trg_time)?>" class="span12 m-wrap" placeholder = "Enter as '11 a.m.' or '11:00 a.m. to 5:30 p.m.'" required >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Trg. Assignment Date</label>
            <div class="controls">
              <input type="text" name="training_assign_dt" value="<?php echo get_datepicker_date(set_value('training_assign_dt',$training_assign_dt)) ?>" class="span12 m-wrap datepicker" required >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Training Order</label>
            <div class="controls">
              <input type="text" name="training_order" value="<?php echo set_value('training_order',$training_order)?>" class="span12 m-wrap" required >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Date</label>
            <div class="controls">
              <input type="text" name="order_date" value="<?php echo get_datepicker_date(set_value('order_date',$order_date))?>" class="span12 m-wrap datepicker" required >
            </div>
          </div>
		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>training/training_program'">Cancel</button>
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