<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$tr_cd = isset($row['tr_cd']) ? $row['tr_cd'] : '';
$tr_name = isset($row['tr_name']) ? $row['tr_name'] : '';
$yr_ta = isset($row['yr_ta']) ? $row['yr_ta'] : '';
$tr_mn = isset($row['tr_mn']) ? $row['tr_mn'] : '';
$lop_cac = isset($row['lop_cac']) ? $row['lop_cac'] : '';
$mjh_cd = isset($row['mjh_cd']) ? $row['mjh_cd'] : '';
$smjh_cd = isset($row['smjh_cd']) ? $row['smjh_cd'] : '';
$mih_cd = isset($row['mih_cd']) ? $row['mih_cd'] : '';
$sbh_cd = isset($row['sbh_cd']) ? $row['sbh_cd'] : '';
$dtlh_cd = isset($row['dtlh_cd']) ? $row['dtlh_cd'] : '';
$sdtlh_cd = isset($row['sdtlh_cd']) ? $row['sdtlh_cd'] : '';
$tv_tc_no = isset($row['tv_tc_no']) ? $row['tv_tc_no'] : '';
$incorp_year = isset($row['incorp_year']) ? $row['incorp_year'] : '';
$incorp_month = isset($row['incorp_month']) ? $row['incorp_month'] : '';
$lop_cac_amt = isset($row['lop_cac_amt']) ? $row['lop_cac_amt'] : '';
$action_status = isset($row['action_status']) ? $row['action_status'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Treasury</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		  <div class="control-group">
            <label class="control-label">Treasury Code<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="tr_cd" name="tr_cd" value="<?php echo set_value('tr_cd',$tr_cd)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Treasury Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="tr_name" name="tr_name" value="<?php echo set_value('tr_name',$tr_name)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year<span class="required"></span></label>
            <div class="controls">
              <input type="text" id="yr_ta" name="yr_ta" value="<?php echo set_value('yr_ta',$yr_ta)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Month<span class="required"></span></label>
            <div class="controls">
              <input type="text" id="tr_mn" name="tr_mn" value="<?php echo set_value('tr_mn',$tr_mn)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">LOP /CAC</label>
            <div class="controls">
              <input type="text" name="lop_cac" value="<?php echo set_value('lop_cac',$lop_cac)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Head of Accounts<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="mjh_cd" name="mjh_cd" value="<?php echo $row['mjh_cd'] ?>-<?php echo $row['smjh_cd'] ?>-<?php echo $row['mih_cd'] ?>-<?php echo $row['sbh_cd'] ?>-<?php echo $row['dtlh_cd'] ?>-<?php echo $row['sdtlh_cd'] ?>-<?php echo $row['cv_cd'] ?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Voucher /Challan </label>
            <div class="controls">
              <input type="text" name="tv_tc_no" value="<?php echo set_value('tv_tc_no',$tv_tc_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  
		   <div class="control-group">
            <label class="control-label">LOP /CAC</label>
            <div class="controls">
              <input type="text" name="lop_cac_amt" value="<?php echo set_value('lop_cac_amt',$lop_cac_amt)?>" class="span12 m-wrap" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Incorporation Month<span class="required">*</span></label>
            <div class="controls">
               <select class="form-control" name="incorp_month" required>
					<option value="">-----Select Month----</option>
					<option value="January" <?php echo set_select('incorp_month', "January", ($incorp_month == "January" ? true : false)); ?>  >January</option>
					<option value="February" <?php echo set_select('incorp_month', "February", ($incorp_month == "February" ? true : false)); ?>  >February</option>
					<option value="March" <?php echo set_select('incorp_month', "March", ($incorp_month == "March" ? true : false)); ?>  >March</option>
					<option value="April" <?php echo set_select('incorp_month', "April", ($incorp_month == "April" ? true : false)); ?>  >April</option>
					<option value="May" <?php echo set_select('incorp_month', "May", ($incorp_month == "January" ? true : false)); ?>  >May</option>
					<option value="June" <?php echo set_select('incorp_month', "June", ($incorp_month == "June" ? true : false)); ?>  >June</option>
					<option value="July" <?php echo set_select('incorp_month', "July", ($incorp_month == "July" ? true : false)); ?>  >July</option>
					<option value="August" <?php echo set_select('incorp_month', "August", ($incorp_month == "August" ? true : false)); ?>  >August</option>
					<option value="September" <?php echo set_select('incorp_month', "September", ($incorp_month == "September" ? true : false)); ?>  >September</option>
					<option value="October" <?php echo set_select('incorp_month', "October", ($incorp_month == "October" ? true : false)); ?>  >October</option>
					<option value="November" <?php echo set_select('incorp_month', "November", ($incorp_month == "November" ? true : false)); ?>  >November</option>
					<option value="December" <?php echo set_select('incorp_month', "December", ($incorp_month == "December" ? true : false)); ?>  >December</option>
					<option value="March Supplimentary" <?php echo set_select('incorp_month', "March Supplimentary", ($incorp_month == "March Supplimentary" ? true : false)); ?>  >March Supplimentary</option>
				  </select>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Incorporation Year<span class="required">*</span></label>
            <div class="controls">
				<select name="incorp_year" style="height:34px;" required>
					<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
						<?php
							for($i = date('Y'); $i >= 2019; $i--){
							echo '<option value="'.$i.'" '.($this->input->get('incorp_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
						}?>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Action Status<span class="required">*</span></label>
            <div class="controls">
				<select id="action_status" name="action_status" class="form-control" required>
					<option data-value="0" value=""> ---- Select Status----</option>
					<option data-value="1" value="Pending" <?=$row['action_status']=='Pending' ? 'selected="selected"': '' ;?>> Pending</option>
					<option data-value="2" value="Incorporated" <?=$row['action_status']=='Incorporated' ? 'selected="selected"': '' ;?>> Incorporated</option>
				</select>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_currection_slip'">Cancel</button>
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