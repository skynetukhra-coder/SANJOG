<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$series = isset($row['series']) ? $row['series'] : '';
$ac_code = isset($row['ac_code']) ? $row['ac_code'] : '';
$emp_code = isset($row['emp_code']) ? $row['emp_code'] : '';
$fst_nme = isset($row['fst_nme']) ? $row['fst_nme'] : '';
$dob = isset($row['dob']) ? $row['dob'] : '';
$nm_father_e = isset($row['nm_father_e']) ? $row['nm_father_e'] : '';
$date_o_join = isset($row['date_o_join']) ? $row['date_o_join'] : '';
$allot_dt = isset($row['allot_dt']) ? $row['allot_dt'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$nomination = isset($row['nomination']) ? $row['nomination'] : '';
$cur_ddo = isset($row['cur_ddo']) ? $row['cur_ddo'] : '';
$email_id = isset($row['email_id']) ? $row['email_id'] : '';
$mobile_no = isset($row['mobile_no']) ? $row['mobile_no'] : '';
$dor = isset($row['dor']) ? $row['dor'] : '';
$auto_account_no = isset($row['auto_account_no']) ? $row['auto_account_no'] : '';
$nomination_copy = isset($row['nomination_copy']) ? $row['nomination_copy'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) != '' ? 'Edit' : 'Add' ?> Subscriber</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		  <div class="control-group">
            <label class="control-label">Series<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="series" name="series" value="<?php echo set_value('series',$series)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Accounts Code<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="ac_code" name="ac_code" value="<?php echo set_value('ac_code',$ac_code)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Employee Code<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="emp_code" name="emp_code" value="<?php echo set_value('emp_code',$emp_code)?>" class="span12 m-wrap">
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
              <input type="text" id="fst_nme" name="fst_nme" value="<?php echo set_value('fst_nme',$fst_nme)?>" class="span12 m-wrap">
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Father's Name</label>
            <div class="controls">
              <input type="text" id="nm_father_e" name="nm_father_e" value="<?php echo set_value('nm_father_e',$nm_father_e)?>" class="span12 m-wrap">
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date Of Birth</label>
            <div class="controls">
              <input type="text" id="dob" name="dob" value="<?php echo set_value('dob',$dob)?>" class="span12 m-wrap">
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Mobile</label>
            <div class="controls">
              <input type="text" name="mobile_no" value="<?php echo set_value('mobile_no',$mobile_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input type="text" name="email_id" value="<?php echo set_value('email_id',$email_id)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">New Password</label>
            <div class="controls">
              <input type="password" name="password" value="" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date Of Join</label>
            <div class="controls">
              <input type="text" name="date_o_join" value="<?php echo set_value('date_o_join',$date_o_join)?>" class="span12 m-wrap">
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date Of Allotment</label>
            <div class="controls">
              <input type="text" name="allot_dt" value="<?php echo set_value('allot_dt',$allot_dt)?>" class="span12 m-wrap">
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Basic Pay</label>
            <div class="controls">
              <input type="text" name="basic_pay" value="<?php echo set_value('basic_pay',$basic_pay)?>" class="span12 m-wrap">
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Nomination</label>
            <div class="controls">
              <input type="text" name="nomination" value="<?php echo set_value('nomination',$nomination)?>" class="span12 m-wrap">
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Nomination Copy</label>
            <div class="controls">
              <input type="text" name="nomination_copy" value="<?php echo set_value('nomination_copy',$nomination_copy)?>" class="span12 m-wrap">
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Auto Account No</label>
            <div class="controls">
              <input type="text" name="auto_account_no" value="<?php echo set_value('auto_account_no',$auto_account_no)?>" class="span12 m-wrap">
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Current DDO</label>
            <div class="controls">
              <input type="text" name="cur_ddo" value="<?php echo set_value('cur_ddo',$cur_ddo)?>" class="span12 m-wrap">
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/subscriber'">Cancel</button>
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