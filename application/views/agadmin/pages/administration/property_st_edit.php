<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$empid = isset($row['empid']) ? $row['empid'] : '';
$emp_name = isset($row['emp_name']) ? $row['emp_name'] : '';
$emp_desig = isset($row['emp_desig']) ? $row['emp_desig'] : '';
$service_belg = isset($row['service_belg']) ? $row['service_belg'] : '';
$mobile_no = isset($row['mobile_no']) ? $row['mobile_no'] : '';
$b_pay = isset($row['b_pay']) ? $row['b_pay'] : '';
$pst_as_on = isset($row['pst_as_on']) ? $row['pst_as_on'] : '';
$pst_year = isset($row['pst_year']) ? $row['pst_year'] : '';
$decl_for = isset($row['decl_for']) ? $row['decl_for'] : '';
$decl_date = isset($row['decl_date']) ? $row['decl_date'] : '';
$decl_place	 = isset($row['decl_place']) ? $row['decl_place'] : '';

$proty_location_1 = isset($row['proty_location_1']) ? $row['proty_location_1'] : '';
$proty_detail_1 = isset($row['proty_detail_1']) ? $row['proty_detail_1'] : '';
$prsnt_value_1 = isset($row['prsnt_value_1']) ? $row['prsnt_value_1'] : '';
$proty_owner_1 = isset($row['proty_owner_1']) ? $row['proty_owner_1'] : '';
$mode_acquin_1 = isset($row['mode_acquin_1']) ? $row['mode_acquin_1'] : '';
$income_proty_1 = isset($row['income_proty_1']) ? $row['income_proty_1'] : '';
$remark_1 = isset($row['remark_1']) ? $row['remark_1'] : '';
$proty_location_2 = isset($row['proty_location_2']) ? $row['proty_location_2'] : '';
$proty_detail_2 = isset($row['proty_detail_2']) ? $row['proty_detail_2'] : '';
$prsnt_value_2 = isset($row['prsnt_value_2']) ? $row['prsnt_value_2'] : '';
$proty_owner_2 = isset($row['proty_owner_2']) ? $row['proty_owner_2'] : '';
$mode_acquin_2 = isset($row['mode_acquin_2']) ? $row['mode_acquin_2'] : '';
$income_proty_2 = isset($row['income_proty_2']) ? $row['income_proty_2'] : '';
$remark_2 = isset($row['remark_2']) ? $row['remark_2'] : '';

$proty_location_3 = isset($row['proty_location_3']) ? $row['proty_location_3'] : '';
$proty_detail_3 = isset($row['proty_detail_3']) ? $row['proty_detail_3'] : '';
$prsnt_value_3 = isset($row['prsnt_value_3']) ? $row['prsnt_value_3'] : '';
$proty_owner_3 = isset($row['proty_owner_3']) ? $row['proty_owner_3'] : '';
$mode_acquin_3 = isset($row['mode_acquin_3']) ? $row['mode_acquin_3'] : '';
$income_proty_3 = isset($row['income_proty_3']) ? $row['income_proty_3'] : '';
$remark_3 = isset($row['remark_3']) ? $row['remark_3'] : '';
$proty_location_4 = isset($row['proty_location_4']) ? $row['proty_location_4'] : '';
$proty_detail_4 = isset($row['proty_detail_4']) ? $row['proty_detail_4'] : '';
$prsnt_value_4 = isset($row['prsnt_value_4']) ? $row['prsnt_value_4'] : '';
$proty_owner_4 = isset($row['proty_owner_4']) ? $row['proty_owner_4'] : '';
$mode_acquin_4 = isset($row['mode_acquin_4']) ? $row['mode_acquin_4'] : '';
$income_proty_4 = isset($row['income_proty_4']) ? $row['income_proty_4'] : '';
$remark_4 = isset($row['remark_4']) ? $row['remark_4'] : '';
$proty_location_5 = isset($row['proty_location_5']) ? $row['proty_location_5'] : '';
$proty_detail_5 = isset($row['proty_detail_5']) ? $row['proty_detail_5'] : '';
$prsnt_value_5 = isset($row['prsnt_value_5']) ? $row['prsnt_value_5'] : '';
$proty_owner_5 = isset($row['proty_owner_5']) ? $row['proty_owner_5'] : '';
$mode_acquin_5 = isset($row['mode_acquin_5']) ? $row['mode_acquin_5'] : '';
$income_proty_5 = isset($row['income_proty_5']) ? $row['income_proty_5'] : '';
$remark_5 = isset($row['remark_5']) ? $row['remark_5'] : '';
$proty_location_6 = isset($row['proty_location_6']) ? $row['proty_location_6'] : '';
$proty_detail_6 = isset($row['proty_detail_6']) ? $row['proty_detail_6'] : '';
$prsnt_value_6 = isset($row['prsnt_value_6']) ? $row['prsnt_value_6'] : '';
$proty_owner_6 = isset($row['proty_owner_6']) ? $row['proty_owner_6'] : '';
$mode_acquin_6 = isset($row['mode_acquin_6']) ? $row['mode_acquin_6'] : '';
$income_proty_6 = isset($row['income_proty_6']) ? $row['income_proty_6'] : '';
$remark_6 = isset($row['remark_6']) ? $row['remark_6'] : '';
$proty_location_7 = isset($row['proty_location_7']) ? $row['proty_location_7'] : '';
$proty_detail_7 = isset($row['proty_detail_7']) ? $row['proty_detail_7'] : '';
$prsnt_value_7 = isset($row['prsnt_value_7']) ? $row['prsnt_value_7'] : '';
$proty_owner_7 = isset($row['proty_owner_7']) ? $row['proty_owner_7'] : '';
$mode_acquin_7 = isset($row['mode_acquin_7']) ? $row['mode_acquin_7'] : '';
$income_proty_7 = isset($row['income_proty_7']) ? $row['income_proty_7'] : '';
$remark_7 = isset($row['remark_7']) ? $row['remark_7'] : '';
$proty_location_8 = isset($row['proty_location_8']) ? $row['proty_location_8'] : '';
$proty_detail_8 = isset($row['proty_detail_8']) ? $row['proty_detail_8'] : '';
$prsnt_value_8 = isset($row['prsnt_value_8']) ? $row['prsnt_value_8'] : '';
$proty_owner_8 = isset($row['proty_owner_8']) ? $row['proty_owner_8'] : '';
$mode_acquin_8 = isset($row['mode_acquin_8']) ? $row['mode_acquin_8'] : '';
$income_proty_8 = isset($row['income_proty_8']) ? $row['income_proty_8'] : '';
$remark_8 = isset($row['remark_8']) ? $row['remark_8'] : '';
$proty_location_9 = isset($row['proty_location_9']) ? $row['proty_location_9'] : '';
$proty_detail_9 = isset($row['proty_detail_9']) ? $row['proty_detail_9'] : '';
$prsnt_value_9 = isset($row['prsnt_value_9']) ? $row['prsnt_value_9'] : '';
$proty_owner_9 = isset($row['proty_owner_9']) ? $row['proty_owner_9'] : '';
$mode_acquin_9 = isset($row['mode_acquin_9']) ? $row['mode_acquin_9'] : '';
$income_proty_9 = isset($row['income_proty_9']) ? $row['income_proty_9'] : '';
$remark_9 = isset($row['remark_9']) ? $row['remark_9'] : '';
$proty_location_10 = isset($row['proty_location_10']) ? $row['proty_location_10'] : '';
$proty_detail_10 = isset($row['proty_detail_10']) ? $row['proty_detail_10'] : '';
$prsnt_value_10 = isset($row['prsnt_value_10']) ? $row['prsnt_value_10'] : '';
$proty_owner_10 = isset($row['proty_owner_10']) ? $row['proty_owner_10'] : '';
$mode_acquin_10 = isset($row['mode_acquin_10']) ? $row['mode_acquin_10'] : '';
$income_proty_10 = isset($row['income_proty_10']) ? $row['income_proty_10'] : '';
$remark_10 = isset($row['remark_10']) ? $row['remark_10'] : '';

?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Asset Declaration</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
		  <p style="color:red">** Note: All Date field should be <b > YYYY-MM-DD </b> and datetime format should be <b> YYYY-MM-DD hh:mm:ss </b></p>
		  <div class="control-group">
            <label class="control-label">Employee Id<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="empid" name="empid" value="<?php echo set_value('empid',$empid)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Name <span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="emp_name" name="emp_name" value="<?php echo set_value('emp_name',$emp_name)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Designation<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="emp_desig" name="emp_desig" value="<?php echo set_value('emp_desig',$emp_desig)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Department</label>
            <div class="controls">
              <input type="text" id="service_belg" name="service_belg" value="<?php echo set_value('service_belg',$service_belg)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Basic Pay</label>
            <div class="controls">
              <input type="text" id="b_pay" name="b_pay" value="<?php echo set_value('b_pay',$b_pay)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mobile No</label>
            <div class="controls">
              <input type="text" id="mobile_no" name="mobile_no" value="<?php echo set_value('mobile_no',$mobile_no)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">As On Date</label>
            <div class="controls">
              <input type="text" name="pst_as_on" value="<?php echo set_value('pst_as_on',$pst_as_on)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year</label>
            <div class="controls">
              <input type="text" id="mobile_no" name="pst_year" value="<?php echo set_value('pst_year',$pst_year)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Declaration For</label>
            <div class="controls">
			  <select name="decl_for" class="form-control" >
					<option data-value="1" value="Self" <?=$row['decl_for']=='Self' ? 'selected="selected"': '' ;?>> Self</option>
					<option data-value="2" value="Dependent" <?=$row['decl_for']=='Dependent' ? 'selected="selected"': '' ;?>> Dependent</option>
				</select>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Sl No of the property to be edited</label>
            <div class="controls">
			  <select id = "property_slno" name="property_slno" class="form-control" >
				   <option data-value="0" value="0">All</option>
				   <option data-value="1" value="1">1</option>
				   <option data-value="2" value="2">2</option>
				   <option data-value="3" value="3">3</option>
				   <option data-value="4" value="4">4</option>
				   <option data-value="5" value="5">5</option>
				   <option data-value="6" value="6">6</option>
				   <option data-value="7" value="7">7</option>
				   <option data-value="8" value="8">8</option>
				   <option data-value="9" value="9">9</option>
				   <option data-value="10" value="10">10</option>
				   
			  </select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Delcaration Date</label>
            <div class="controls">
              <input type="text" id="decl_date" name="decl_date" value="<?php echo set_value('decl_date',$decl_date)?>" class="span12 m-wrap" >
            </div>
          </div>

		  <div class="control-group">
            <label class="control-label">Property Location 1</label>
            <div class="controls">
              <input type="text" id="proty_location_1" name="proty_location_1" value="<?php echo set_value('proty_location_1',$proty_location_1)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 1</label>
            <div class="controls">
              <input type="text" id="proty_detail_1" name="proty_detail_1" value="<?php echo set_value('proty_detail_1',$proty_detail_1)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value 1</label>
            <div class="controls">
              <input type="text" id="prsnt_value_1" name="prsnt_value_1" value="<?php echo set_value('prsnt_value_1',$prsnt_value_1)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner 1</label>
            <div class="controls">
              <input type="text" id="proty_owner_1" name="proty_owner_1" value="<?php echo set_value('proty_owner_1',$proty_owner_1)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 1</label>
            <div class="controls">
              <input type="text" id="mode_acquin_1" name="mode_acquin_1" value="<?php echo set_value('mode_acquin_1',$mode_acquin_1)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 1</label>
            <div class="controls">
              <input type="text" id="income_proty_1" name="income_proty_1" value="<?php echo set_value('income_proty_1',$income_proty_1)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 1</label>
            <div class="controls">
              <input type="text" id="remark_1" name="remark_1" value="<?php echo set_value('remark_1',$remark_1)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Property Location 2</label>
            <div class="controls">
              <input type="text" id="proty_location_2" name="proty_location_2" value="<?php echo set_value('proty_location_2',$proty_location_2)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 2</label>
            <div class="controls">
              <input type="text" id="proty_detail_2" name="proty_detail_2" value="<?php echo set_value('proty_detail_2',$proty_detail_2)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value 2</label>
            <div class="controls">
              <input type="text" id="prsnt_value_2" name="prsnt_value_2" value="<?php echo set_value('prsnt_value_2',$prsnt_value_2)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner 2</label>
            <div class="controls">
              <input type="text" id="proty_owner_2" name="proty_owner_2" value="<?php echo set_value('proty_owner_2',$proty_owner_2)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 2</label>
            <div class="controls">
              <input type="text" id="mode_acquin_2" name="mode_acquin_2" value="<?php echo set_value('mode_acquin_2',$mode_acquin_2)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 2</label>
            <div class="controls">
              <input type="text" id="income_proty_2" name="income_proty_2" value="<?php echo set_value('income_proty_2',$income_proty_2)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 2</label>
            <div class="controls">
              <input type="text" id="remark_2" name="remark_2" value="<?php echo set_value('remark_2',$remark_2)?>" class="span12 m-wrap" >
            </div>
          </div> 	  
		<div class="control-group">
            <label class="control-label">Property Location 3</label>
            <div class="controls">
              <input type="text" id="proty_location_3" name="proty_location_3" value="<?php echo set_value('proty_location_3',$proty_location_3)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 3</label>
            <div class="controls">
              <input type="text" id="proty_detail_3" name="proty_detail_3" value="<?php echo set_value('proty_detail_3',$proty_detail_3)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value 3</label>
            <div class="controls">
              <input type="text" id="prsnt_value_3" name="prsnt_value_3" value="<?php echo set_value('prsnt_value_3',$prsnt_value_3)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner 3</label>
            <div class="controls">
              <input type="text" id="proty_owner_3" name="proty_owner_3" value="<?php echo set_value('proty_owner_3',$proty_owner_3)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 3</label>
            <div class="controls">
              <input type="text" id="mode_acquin_3" name="mode_acquin_3" value="<?php echo set_value('mode_acquin_3',$mode_acquin_3)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 3</label>
            <div class="controls">
              <input type="text" id="income_proty_3" name="income_proty_3" value="<?php echo set_value('income_proty_3',$income_proty_3)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 3</label>
            <div class="controls">
              <input type="text" id="remark_3" name="remark_3" value="<?php echo set_value('remark_3',$remark_3)?>" class="span12 m-wrap" >
            </div>
          </div> 	  
		  <div class="control-group">
            <label class="control-label">Property Location 4</label>
            <div class="controls">
              <input type="text" id="proty_location_4" name="proty_location_4" value="<?php echo set_value('proty_location_4',$proty_location_4)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 4</label>
            <div class="controls">
              <input type="text" id="proty_detail_4" name="proty_detail_4" value="<?php echo set_value('proty_detail_4',$proty_detail_4)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value 4</label>
            <div class="controls">
              <input type="text" id="prsnt_value_4" name="prsnt_value_4" value="<?php echo set_value('prsnt_value_4',$prsnt_value_4)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner 4</label>
            <div class="controls">
              <input type="text" id="proty_owner_4" name="proty_owner_4" value="<?php echo set_value('proty_owner_4',$proty_owner_4)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 4</label>
            <div class="controls">
              <input type="text" id="mode_acquin_4" name="mode_acquin_4" value="<?php echo set_value('mode_acquin_4',$mode_acquin_4)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 4</label>
            <div class="controls">
              <input type="text" id="income_proty_4" name="income_proty_4" value="<?php echo set_value('income_proty_4',$income_proty_4)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 4</label>
            <div class="controls">
              <input type="text" id="remark_4" name="remark_4" value="<?php echo set_value('remark_4',$remark_4)?>" class="span12 m-wrap" >
            </div>
          </div> 	  
		  <div class="control-group">
            <label class="control-label">Property Location 5</label>
            <div class="controls">
              <input type="text" id="proty_location_5" name="proty_location_5" value="<?php echo set_value('proty_location_5',$proty_location_5)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 5</label>
            <div class="controls">
              <input type="text" id="proty_detail_5" name="proty_detail_5" value="<?php echo set_value('proty_detail_5',$proty_detail_5)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value 5</label>
            <div class="controls">
              <input type="text" id="prsnt_value_5" name="prsnt_value_5" value="<?php echo set_value('prsnt_value_5',$prsnt_value_5)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner 5</label>
            <div class="controls">
              <input type="text" id="proty_owner_5" name="proty_owner_5" value="<?php echo set_value('proty_owner_5',$proty_owner_5)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 5</label>
            <div class="controls">
              <input type="text" id="mode_acquin_5" name="mode_acquin_5" value="<?php echo set_value('mode_acquin_5',$mode_acquin_5)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 5</label>
            <div class="controls">
              <input type="text" id="income_proty_5" name="income_proty_5" value="<?php echo set_value('income_proty_5',$income_proty_5)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 5</label>
            <div class="controls">
              <input type="text" id="remark_5" name="remark_5" value="<?php echo set_value('remark_5',$remark_5)?>" class="span12 m-wrap" >
            </div>
          </div> 	  
		  <div class="control-group">
            <label class="control-label">Property Location 6</label>
            <div class="controls">
              <input type="text" id="proty_location_6" name="proty_location_6" value="<?php echo set_value('proty_location_6',$proty_location_6)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 6</label>
            <div class="controls">
              <input type="text" id="proty_detail_6" name="proty_detail_6" value="<?php echo set_value('proty_detail_6',$proty_detail_6)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value 6</label>
            <div class="controls">
              <input type="text" id="prsnt_value_6" name="prsnt_value_6" value="<?php echo set_value('prsnt_value_6',$prsnt_value_6)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner 6</label>
            <div class="controls">
              <input type="text" id="proty_owner_6" name="proty_owner_6" value="<?php echo set_value('proty_owner_6',$proty_owner_6)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 6</label>
            <div class="controls">
              <input type="text" id="mode_acquin_6" name="mode_acquin_6" value="<?php echo set_value('mode_acquin_6',$mode_acquin_6)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 6</label>
            <div class="controls">
              <input type="text" id="income_proty_6" name="income_proty_6" value="<?php echo set_value('income_proty_6',$income_proty_6)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 6</label>
            <div class="controls">
              <input type="text" id="remark_6" name="remark_6" value="<?php echo set_value('remark_6',$remark_6)?>" class="span12 m-wrap" >
            </div>
          </div> 	  
		  <div class="control-group">
            <label class="control-label">Property Location 7</label>
            <div class="controls">
              <input type="text" id="proty_location_7" name="proty_location_7" value="<?php echo set_value('proty_location_7',$proty_location_7)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 7</label>
            <div class="controls">
              <input type="text" id="proty_detail_7" name="proty_detail_7" value="<?php echo set_value('proty_detail_7',$proty_detail_7)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value  7</label>
            <div class="controls">
              <input type="text" id="prsnt_value_7" name="prsnt_value_7" value="<?php echo set_value('prsnt_value_7',$prsnt_value_7)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner  7</label>
            <div class="controls">
              <input type="text" id="proty_owner_7" name="proty_owner_7" value="<?php echo set_value('proty_owner_7',$proty_owner_7)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 7</label>
            <div class="controls">
              <input type="text" id="mode_acquin_7" name="mode_acquin_7" value="<?php echo set_value('mode_acquin_7',$mode_acquin_7)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 7</label>
            <div class="controls">
              <input type="text" id="income_proty_7" name="income_proty_7" value="<?php echo set_value('income_proty_7',$income_proty_7)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 7</label>
            <div class="controls">
              <input type="text" id="remark_7" name="remark_7" value="<?php echo set_value('remark_7',$remark_7)?>" class="span12 m-wrap" >
            </div>
          </div> 	  
		  <div class="control-group">
            <label class="control-label">Property Location 8</label>
            <div class="controls">
              <input type="text" id="proty_location_8" name="proty_location_8" value="<?php echo set_value('proty_location_8',$proty_location_8)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 8</label>
            <div class="controls">
              <input type="text" id="proty_detail_8" name="proty_detail_8" value="<?php echo set_value('proty_detail_8',$proty_detail_8)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value 8</label>
            <div class="controls">
              <input type="text" id="prsnt_value_8" name="prsnt_value_8" value="<?php echo set_value('prsnt_value_8',$prsnt_value_8)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner 8</label>
            <div class="controls">
              <input type="text" id="proty_owner_8" name="proty_owner_8" value="<?php echo set_value('proty_owner_8',$proty_owner_8)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 8</label>
            <div class="controls">
              <input type="text" id="mode_acquin_8" name="mode_acquin_8" value="<?php echo set_value('mode_acquin_8',$mode_acquin_8)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 8</label>
            <div class="controls">
              <input type="text" id="income_proty_8" name="income_proty_8" value="<?php echo set_value('income_proty_8',$income_proty_8)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 8</label>
            <div class="controls">
              <input type="text" id="remark_8" name="remark_8" value="<?php echo set_value('remark_8',$remark_8)?>" class="span19 m-wrap" >
            </div>
          </div> 	  
		  <div class="control-group">
            <label class="control-label">Property Location 9</label>
            <div class="controls">
              <input type="text" id="proty_location_9" name="proty_location_9" value="<?php echo set_value('proty_location_9',$proty_location_9)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 9</label>
            <div class="controls">
              <input type="text" id="proty_detail_9" name="proty_detail_9" value="<?php echo set_value('proty_detail_9',$proty_detail_9)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value 9</label>
            <div class="controls">
              <input type="text" id="prsnt_value_9" name="prsnt_value_9" value="<?php echo set_value('prsnt_value_9',$prsnt_value_9)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner 9</label>
            <div class="controls">
              <input type="text" id="proty_owner_9" name="proty_owner_9" value="<?php echo set_value('proty_owner_9',$proty_owner_9)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 9</label>
            <div class="controls">
              <input type="text" id="mode_acquin_9" name="mode_acquin_9" value="<?php echo set_value('mode_acquin_9',$mode_acquin_9)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 9</label>
            <div class="controls">
              <input type="text" id="income_proty_9" name="income_proty_9" value="<?php echo set_value('income_proty_9',$income_proty_9)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 9</label>
            <div class="controls">
              <input type="text" id="remark_9" name="remark_9" value="<?php echo set_value('remark_9',$remark_9)?>" class="span12 m-wrap" >
            </div>
          </div> 	  
		  <div class="control-group">
            <label class="control-label">Property Location 10</label>
            <div class="controls">
              <input type="text" id="proty_location_10" name="proty_location_10" value="<?php echo set_value('proty_location_10',$proty_location_10)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Details 10</label>
            <div class="controls">
              <input type="text" id="proty_detail_10" name="proty_detail_10" value="<?php echo set_value('proty_detail_10',$proty_detail_10)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Present Property Value 10</label>
            <div class="controls">
              <input type="text" id="prsnt_value_10" name="prsnt_value_10" value="<?php echo set_value('prsnt_value_10',$prsnt_value_10)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Property Owner 10</label>
            <div class="controls">
              <input type="text" id="proty_owner_10" name="proty_owner_10" value="<?php echo set_value('proty_owner_10',$proty_owner_10)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Mode of Aquisition 10</label>
            <div class="controls">
              <input type="text" id="mode_acquin_10" name="mode_acquin_10" value="<?php echo set_value('mode_acquin_10',$mode_acquin_10)?>" class="span12 m-wrap" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Income from Property 10</label>
            <div class="controls">
              <input type="text" id="income_proty_10" name="income_proty_10" value="<?php echo set_value('income_proty_10',$income_proty_10)?>" class="span12 m-wrap" >
            </div>
          </div> 
		  <div class="control-group">
            <label class="control-label">Remark 10</label>
            <div class="controls">
              <input type="text" id="remark_10" name="remark_10" value="<?php echo set_value('remark_10',$remark_10)?>" class="span12 m-wrap" >
            </div>
          </div> 	  
		  
		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/property_st_admn'">Cancel</button>
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