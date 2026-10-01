<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$try_insp_id = isset($row['try_insp_id']) ? $row['try_insp_id'] : '';
$insp_year = isset($row['insp_year']) ? $row['insp_year'] : '';
$insp_month = isset($row['insp_month']) ? $row['insp_month'] : '';
$tr_nm = isset($row['tr_nm']) ? $row['tr_nm'] : '';
$period_under_insp = isset($row['period_under_insp']) ? $row['period_under_insp'] : '';
$insp_party_no = isset($row['insp_party_no']) ? $row['insp_party_no'] : '';
$insp_from = isset($row['insp_from']) ? $row['insp_from'] : '';
$insp_to = isset($row['insp_to']) ? $row['insp_to'] : '';
$insp_days = isset($row['insp_days']) ? $row['insp_days'] : '';
$distance_hq = isset($row['distance_hq']) ? $row['distance_hq'] : '';
$report_hq = isset($row['report_hq']) ? $row['report_hq'] : '';
$insp_order = isset($row['insp_order']) ? $row['insp_order'] : '';
$order_date = isset($row['order_date']) ? $row['order_date'] : '';
$try_ir_no = isset($row['try_ir_no']) ? $row['try_ir_no'] : '';
$try_ir_date = isset($row['try_ir_date']) ? $row['try_ir_date'] : '';
$nos_ir_paras = isset($row['nos_ir_paras']) ? $row['nos_ir_paras'] : '';
$ir_file_link = isset($row['ir_file_link']) ? $row['ir_file_link'] : '';
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
            <label class="control-label">Inspection ID<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="try_insp_id" name="try_insp_id" value="<?php echo set_value('try_insp_id',$try_insp_id)?>" class="span12 m-wrap" required readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year <span class="required">*</span></label>
            <div class="controls">
              <select name="insp_year" class="form-control" required >
					<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
						<?php
							for($i = date('Y')+1; $i >= 2019; $i--){
							echo '<option value="'.$i.'" '.($this->input->get('insp_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
						}?>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Month<span class="required">*</span></label>
            <div class="controls">
              <select class="form-control" name="insp_month" required >
					<option value="">-----Select Month----</option>
					<option value="January" >January</option>
					<option value="February" >February</option>
					<option value="March"  >March</option>
					<option value="April"  >April</option>
					<option value="May"  >May</option>
					<option value="June" >June</option>
					<option value="July" >July</option>
					<option value="August"  >August</option>
					<option value="September"  >September</option>
					<option value="October"  >October</option>
					<option value="November" >November</option>
					<option value="December" >December</option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Treasury<span class="required">*</span></label>
			<div class="controls">
				<select name="tr_nm" style="height:34px;" required >
					<option value=""> -- Select --</option>
						<?php
						if(isset($treasury_list) && !empty($treasury_list)){
							foreach($treasury_list as $treasuries){
								echo '<option value="'.$treasuries['tr_nm'].'">'.$treasuries['tr_nm'].'</option>';
							}
						}
						?>
					</select>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">District<span class="required">*</span></label>
			<div class="controls">
				<select name="dist_nm" style="height:34px;" required >
					<option value=""> -- Select --</option>
						<?php
						if(isset($district_list) && !empty($district_list)){
							foreach($district_list as $disticts){
								echo '<option value="'.$disticts['dist_name'].'">'.$disticts['dist_name'].'</option>';
							}
						}
						?>
					</select>
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Period Under Inspection<span class="required">*</span></label>
			<div class="controls">
				<input type="text" name="period_under_insp" value="<?php echo set_value('period_under_insp',$period_under_insp)?>" class="span12 m-wrap" >
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Party No<span class="required">*</span></label>
            <div class="controls">
              <select class="form-control" name="insp_party_no" required >
					<option value="">-----Select Month----</option>
					<option value="Treasury Inspection Party-I">Treasury Inspection Party-I </option>
					<option value="Treasury Inspection Party-II">Treasury Inspection Party-II </option>
					<option value="Treasury Inspection Party-III">Treasury Inspection Party-III </option>
					<option value="Treasury Inspection Party-IV">Treasury Inspection Party-IV </option>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Inspection From<span class="required">*</span> </label>
            <div class="controls">
              <input type="text" name="insp_from" value="<?php echo set_value('insp_from',$insp_from)?>" class="span12 m-wrap datepicker" required>
			 </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Inspection To<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="insp_to" value="<?php echo set_value('insp_to',$insp_to)?>" class="span12 m-wrap datepicker" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Inspection Days<span class="required">*</span></label>
            <div class="controls">
             <select name="insp_days" class="form-control" required >
					<option value="">-- Select Days --</option>
						<?php
							for($i = 1; $i <= 30; $i++){
							echo '<option value="'.$i.'" '.($this->input->get('insp_days',true) == $i ? 'selected': '').' >'.$i.'</option>';
						}?>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Distance from HQ<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="distance_hq" value="<?php echo set_value('distance_hq',$distance_hq)?>" class="span12 m-wrap "required >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Report to HQ<span class="required">*</span> </label>
            <div class="controls">
              <input type="text" name="report_hq" value="<?php echo set_value('report_hq',$report_hq)?>" class="span12 m-wrap datepicker" required>
			 </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order No<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="insp_order" value="<?php echo set_value('insp_order',$insp_order)?>" class="span12 m-wrap "required >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Date<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="order_date" value="<?php echo set_value('order_date',$order_date)?>" class="span12 m-wrap" required >
            </div>
          </div> 
		   <div class="control-group">
            <label class="control-label">IR No</label>
            <div class="controls">
              <input type="text" name="try_ir_no" value="<?php echo set_value('try_ir_no',$try_ir_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">IT Issue Date </label>
            <div class="controls">
              <input type="text" name="try_ir_date" value="<?php echo set_value('try_ir_date',$try_ir_date)?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">No of Paras</label>
            <div class="controls">
              <input type="text" name="nos_ir_paras" value="<?php echo set_value('nos_ir_paras',$nos_ir_paras)?>" class="span12 m-wrap " >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">IR PDF link</label>
            <div class="controls">
              <input type="text" name="ir_file_link" value="<?php echo set_value('ir_file_link',$ir_file_link)?>" class="span12 m-wrap " >
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspection'">Cancel</button>
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