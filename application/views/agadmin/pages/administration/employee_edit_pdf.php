<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style> 
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$office_id = isset($row['office_id']) ? $row['office_id'] : '';
$empname = isset($row['empname']) ? $row['empname'] : '';
$father_name = isset($row['father_name']) ? $row['father_name'] : '';
$group_name = isset($row['group_name']) ? $row['group_name'] : '';
$gender = isset($row['gender']) ? $row['gender'] : '';
$mbno = isset($row['mbno']) ? $row['mbno'] : '';
$category = isset($row['category']) ? $row['category'] : '';
$stream = isset($row['stream']) ? $row['stream'] : '';
$dob = isset($row['dob']) ? $row['dob'] : '';
$dor = isset($row['dor']) ? $row['dor'] : '';
$nicmail = isset($row['nicmail']) ? $row['nicmail'] : '';
$nicmail_proposed = isset($row['nicmail_proposed']) ? $row['nicmail_proposed'] : '';
$email = isset($row['email']) ? $row['email'] : '';
$doapp = isset($row['doapp']) ? $row['doapp'] : '';
$level_pay = isset($row['level_pay']) ? $row['level_pay'] : '';
$basic_pay = isset($row['basic_pay']) ? $row['basic_pay'] : '';
$office = isset($row['office']) ? $row['office'] : 'PR. ACCOUNTANT GENERAL (A&E) WEST BENGAL';
$dept_appt = isset($row['dept_appt']) ? $row['dept_appt'] : 'INDIAN AUDIT AND ACCOUNTS DEPARTMENT';
$doj_off = isset($row['doj_off']) ? $row['doj_off'] : '';
$promotion_dt = isset($row['promotion_dt']) ? $row['promotion_dt'] : '';
$promo_from = isset($row['promo_from']) ? $row['promo_from'] : '';
$trans_from = isset($row['trans_from']) ? $row['trans_from'] : '';
$trans_order_dt = isset($row['trans_order_dt']) ? $row['trans_order_dt'] : '';
$joning_type = isset($row['joning_type']) ? $row['joning_type'] : '';
$blodd_grp = isset($row['blodd_grp']) ? $row['blodd_grp'] : '';
$service_bk_no = isset($row['service_bk_no']) ? $row['service_bk_no'] : '';
$id_cardno = isset($row['id_cardno']) ? $row['id_cardno'] : '';
$voter_cardno = isset($row['voter_cardno']) ? $row['voter_cardno'] : '';
$aadhaar_cardno = isset($row['aadhaar_cardno']) ? $row['aadhaar_cardno'] : '';
$gpf_ac_no = isset($row['gpf_ac_no']) ? $row['gpf_ac_no'] : '';
$deputation_status = isset($row['deputation_status']) ? $row['deputation_status'] : '';
$emp_status = isset($row['emp_status']) ? $row['emp_status'] : '';
$picture = isset($row['picture']) ? $row['picture'] : '';
$status = isset($row['status']) ? $row['status'] : '';

// Details
$offic_id = isset($row['offic_id']) ? $row['offic_id'] : '';
$desig = isset($row['desig']) ? $row['desig'] : '';
$qualifi = isset($row['qualifi']) ? $row['qualifi'] : '';
$address1 = isset($row['address1']) ? $row['address1'] : '';
$state = isset($row['state']) ? $row['state'] : '';
$district = isset($row['district']) ? $row['district'] : '';
$postoffice = isset($row['postoffice']) ? $row['postoffice'] : '';
$pin = isset($row['pin']) ? $row['pin'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$sect_idx = isset($row['sect_idx']) ? $row['sect_idx'] : '';
$branch_desc = isset($row['branch_desc']) ? $row['branch_desc'] : '';
$branch_indx = isset($row['branch_indx']) ? $row['branch_indx'] : '';
$grd_slno = isset($row['grd_slno']) ? $row['grd_slno'] : '';
$grd_pageno = isset($row['grd_pageno']) ? $row['grd_pageno'] : '';
$id_cardno = isset($row['id_cardno']) ? $row['id_cardno'] : '';
$nomination = isset($row['nomination']) ? $row['nomination'] : '';
$family_memb = isset($row['family_memb']) ? $row['family_memb'] : '';
$do_exp = isset($row['do_exp']) ? $row['do_exp'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">Update Employee information</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" enctype="multipart/form-data" class="form-horizontal">
          <fieldset>
<!--		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>			-->
		  <div class="control-group">
            <label class="control-label">Employee PAN<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" required readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Employee Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empname" name="empname" value="<?php echo set_value('empname',$empname)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		<div class="control-group">
            <label class="control-label">Designation</label>
            <div class="controls">
              <input type="text" id="desig" name="desig" value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
<!--		  
		<div class="control-group">
            <label class="control-label">Present Section</label>
            <div class="controls">
              <select id="section" name="section" class="form-control" >
					<option value=""> -- Select Section to update--</option>
					<?php
						if(isset($section_list) && !empty($section_list)){
							foreach($section_list as $sections){
								echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
							}
						}
					?>
				</select>
            </div>
        </div>

		<div class="control-group">
            <label class="control-label">Employee's Picture<span class="required">*</span></label>
            <div class="controls">
              <input id="attachment" type="file" name="picture" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
			  <button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($picture != ''){echo '&nbsp;<a href="'.base_url().'files/agae/picture/'.$picture.'" target="_blank">'.$picture.'</a>';}?></span>
            </div>
         </div>
-->
		<div class="control-group">
            <label class="control-label">Nomination Copy<span class="required">*</span></label>
            <div class="controls">
              <input id="attachment" type="file" name="nomination" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
			  <button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($nomination != ''){echo '&nbsp;<a href="'.base_url().'files/agae/picture/'.$nomination.'" target="_blank">'.$nomination.'</a>';}?></span>
            </div>
         </div>
		 <div class="control-group">
            <label class="control-label">Family Members<span class="required">*</span></label>
            <div class="controls">
              <input id="attachment2" type="file" name="family_memb" class="span12 m-wrap" onchange="previewImage2(this,'up_file_display2')" style="display:none"/>
			  <button type="button" class="" onclick="browse2()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display2"><?php if($family_memb != ''){echo '&nbsp;<a href="'.base_url().'files/agae/picture/'.$family_memb.'" target="_blank">'.$family_memb.'</a>';}?></span>
            </div>
         </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee'">Cancel</button>
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
		if( ext == 'pdf' || ext == 'jpg'){
      $('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
    }else{
      $('#attachment').val(''); 
      $('#'+container_id).html('');      
      alert('Upload pdf file only.');
    }
	}
}
function browse2(){
	$('#attachment2').click();
}
function previewImage2(file_obj,container_id1){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if( ext == 'pdf'){
      $('#'+container_id1).html('<em>&nbsp;&nbsp;' + filename + '</em>');
    }else{
      $('#attachment2').val(''); 
      $('#'+container_id1).html('');      
      alert('Upload pdf file only.');
    }
	}
}
</script>