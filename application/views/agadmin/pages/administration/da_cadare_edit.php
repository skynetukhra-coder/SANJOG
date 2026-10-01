<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$empname = isset($row['empname']) ? $row['empname'] : '';
$father_name = isset($row['father_name']) ? $row['father_name'] : '';
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
$office = isset($row['office']) ? $row['office'] : '';
$dept_appt = isset($row['dept_appt']) ? $row['dept_appt'] : '';
$doj_off = isset($row['doj_off']) ? $row['doj_off'] : '';
$joning_type = isset($row['joning_type']) ? $row['joning_type'] : '';
$blodd_grp = isset($row['blodd_grp']) ? $row['blodd_grp'] : '';


// Details
$desig = isset($row['desig']) ? $row['desig'] : '';
$qualifi = isset($row['qualifi']) ? $row['qualifi'] : '';
$address1 = isset($row['address1']) ? $row['address1'] : '';
$state = isset($row['state']) ? $row['state'] : '';
$district = isset($row['district']) ? $row['district'] : '';
$postoffice = isset($row['postoffice']) ? $row['postoffice'] : '';
$pin = isset($row['pin']) ? $row['pin'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$grd_slno = isset($row['grd_slno']) ? $row['grd_slno'] : '';
$grd_pageno = isset($row['grd_pageno']) ? $row['grd_pageno'] : '';
$id_cardno = isset($row['id_cardno']) ? $row['id_cardno'] : '';
$gratuity_nomination = isset($row['gratuity_nomination']) ? $row['gratuity_nomination'] : '';
$gis_nomination = isset($row['gis_nomination']) ? $row['gis_nomination'] : '';
$do_exp = isset($row['do_exp']) ? $row['do_exp'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Da Cadre</div>
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
            <label class="control-label">Employee Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empname" name="empname" value="<?php echo set_value('empname',$empname)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Father Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="father_name" name="father_name" value="<?php echo set_value('father_name',$father_name)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Gender<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="gender" name="gender" value="<?php echo set_value('gender',$gender)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mobile</label>
            <div class="controls">
              <input type="text" name="mbno" value="<?php echo set_value('mbno',$mbno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Nic Email</label>
            <div class="controls">
              <input type="text" name="nicmail" value="<?php echo set_value('nicmail',$nicmail)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Nic Email Proposed</label>
            <div class="controls">
              <input type="text" name="nicmail_proposed" value="<?php echo set_value('nicmail_proposed',$nicmail_proposed)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input type="text" name="email" value="<?php echo set_value('email',$email)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">New Password</label>
            <div class="controls">
              <input type="password" name="password" value="" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Category<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="category" value="<?php echo set_value('category',$category)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Stream<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="stream" value="<?php echo set_value('stream',$stream)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Birth</label>
            <div class="controls">
              <input type="text" name="dob" value="<?php echo set_value('dob',$dob)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Retirement</label>
            <div class="controls">
              <input type="text" name="dor" value="<?php echo set_value('dor',$dor)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Date of Appointment</label>
            <div class="controls">
              <input type="text" name="doapp" value="<?php echo set_value('doapp',$doapp)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office</label>
            <div class="controls">
              <input type="text" name="office" value="<?php echo set_value('office',$office)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Department</label>
            <div class="controls">
              <input type="text" name="dept_appt" value="<?php echo set_value('dept_appt',$dept_appt)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">doj_off</label>
            <div class="controls">
              <input type="text" name="doj_off" value="<?php echo set_value('doj_off',$doj_off)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Joining Type</label>
            <div class="controls">
              <input type="text" name="joning_type" value="<?php echo set_value('joning_type',$joning_type)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Blood Gruop</label>
            <div class="controls">
              <input type="text" name="blodd_grp" value="<?php echo set_value('blodd_grp',$blodd_grp)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation</label>
            <div class="controls">
              <input type="text" name="desig" value="<?php echo set_value('desig',$desig)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Qualification</label>
            <div class="controls">
              <input type="text" name="qualifi" value="<?php echo set_value('qualifi',$qualifi)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">State</label>
            <div class="controls">
              <input type="text" name="state" value="<?php echo set_value('state',$state)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">District</label>
            <div class="controls">
              <input type="text" name="district" value="<?php echo set_value('district',$district)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Post Office</label>
            <div class="controls">
              <input type="text" name="postoffice" value="<?php echo set_value('postoffice',$postoffice)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Pin Code</label>
            <div class="controls">
              <input type="text" name="pin" value="<?php echo set_value('pin',$pin)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Section</label>
            <div class="controls">
              <input type="text" name="section" value="<?php echo set_value('section',$section)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">grd_slno</label>
            <div class="controls">
              <input type="text" name="grd_slno" value="<?php echo set_value('grd_slno',$grd_slno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">grd_pageno</label>
            <div class="controls">
              <input type="text" name="grd_pageno" value="<?php echo set_value('grd_pageno',$grd_pageno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">ID Card No</label>
            <div class="controls">
              <input type="text" name="id_cardno" value="<?php echo set_value('id_cardno',$id_cardno)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Gratuity Nomination</label>
            <div class="controls">
              <input type="text" name="gratuity_nomination" value="<?php echo set_value('gratuity_nomination',$gratuity_nomination)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">GIS Nomination</label>
            <div class="controls">
              <input type="text" name="gis_nomination" value="<?php echo set_value('gis_nomination',$gis_nomination)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">do_exp</label>
            <div class="controls">
              <input type="text" name="do_exp" value="<?php echo set_value('do_exp',$do_exp)?>" class="span12 m-wrap" >
            </div>
          </div>
		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/da_cadare'">Cancel</button>
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