<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$transf_order_id = isset($row['transf_order_id']) ? $row['transf_order_id'] : '';
$transf_order_no = isset($row['transf_order_no']) ? $row['transf_order_no'] : '';
$transf_order_dt = isset($row['transf_order_dt']) ? $row['transf_order_dt'] : '';
$transf_year = isset($row['transf_year']) ? $row['transf_year'] : '';
$transf_month = isset($row['transf_month']) ? $row['transf_month'] : '';
$transf_type = isset($row['transf_type']) ? $row['transf_type'] : '';
$transf_group = isset($row['transf_group']) ? $row['transf_group'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$transf_sanct_autho= isset($row['transf_sanct_autho']) ? $row['transf_sanct_autho'] : '';
$transf_sanct_autho_dt = isset($row['transf_sanct_autho_dt']) ? $row['transf_sanct_autho_dt'] : '';
$transf_sign_autho= isset($row['transf_sign_autho']) ? $row['transf_sign_autho'] : '';
$order_file_link = isset($row['order_file_link']) ? $row['order_file_link'] : '';
$pdf_name = isset($row['pdf_name']) ? $row['pdf_name'] : '';

?>
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php //echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Office Order</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">

        <form id="form_sample_1" method="post" class="form-horizontal"  enctype="multipart/form-data">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">Transfer Order ID<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="transf_order_id" name="trans_ord_id" value="<?php echo set_value('transf_order_id',$transf_order_id)?>"  class="span12 m-wrap " readonly>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Year<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="transf_year" name="transf_year" value="<?php echo date('Y');?>"  class="span12 m-wrap "  readonly>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Month<span class="required">*</span></label>
            <div class="controls">
			<input type="text" id="transf_month" name="transf_month" value="<?php echo date('F');?>"  class="span12 m-wrap "  readonly>	
			
<!--			
             	  <select class="form-transf_month" name="transf_month" required >
					<option value="">-----Select Month----</option>
					<option value="January" <?=$row['transf_month']=='January' ? 'selected="selected"': '' ;?>>January</option>
					<option value="February" <?=$row['transf_month']=='February' ? 'selected="selected"': '' ;?>>February</option>
					<option value="March" <?=$row['transf_month']=='March' ? 'selected="selected"': '' ;?>>March</option>
					<option value="April" <?=$row['transf_month']=='April' ? 'selected="selected"': '' ;?>>April</option>
					<option value="May" <?=$row['transf_month']=='May' ? 'selected="selected"': '' ;?>>May</option>
					<option value="June" <?=$row['transf_month']=='June' ? 'selected="selected"': '' ;?>>June</option>
					<option value="July" <?=$row['transf_month']=='July' ? 'selected="selected"': '' ;?>>July</option>
					<option value="August" <?=$row['transf_month']=='August' ? 'selected="selected"': '' ;?>>August</option>
					<option value="September" <?=$row['transf_month']=='September' ? 'selected="selected"': '' ;?>>September</option>
					<option value="October" <?=$row['transf_month']=='October' ? 'selected="selected"': '' ;?>>October</option>
					<option value="November" <?=$row['transf_month']=='November' ? 'selected="selected"': '' ;?>>November</option>
					<option value="December" <?=$row['transf_month']=='December' ? 'selected="selected"': '' ;?>>December</option>
				</select>
-->
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Order No <span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="transf_order_no" name="transf_order_no" value="<?php echo set_value('transf_order_no',$transf_order_no)?>" class="span12 m-wrap " >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Order Date<span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="transf_order_dt" name="transf_order_dt" value="<?php echo get_datepicker_date(set_value('transf_order_dt',$transf_order_dt))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Transfer Type </label>
            <div class="controls">
				<input type="text" id="transf_type" name="transf_type" value="Section Transfer" class="span12 m-wrap " readonly >
<!--			
				<select id="transf_type" name="transf_type" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="Section Transfer" <?=$row['transf_type']=='Section Transfer' ? 'selected="selected"': '' ;?>>Section Transfer (In Group)</option>
					<option data-value="2" value="Group Transfer" <?=$row['transf_type']=='Group Transfer' ? 'selected="selected"': '' ;?>> Group Transfer</option>
					<option data-value="3" value="Office Transfer" <?=$row['transf_type']=='Office Transfer' ? 'selected="selected"': '' ;?>>Office Transfer</option>
				</select>
-->				
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Order Issuing Group<span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="transf_group" name="transf_group" value="ACCOUNTS" class="span12 m-wrap " readonly >
<!--
				<select id="transf_group" name="transf_group" class="form-control" required >
					<option data-value="0" value=""> ---- Select Group----</option>
					<option data-value="1" value="ADMINISTRATION" <?=$row['transf_group']=='ADMINISTRATION' ? 'selected="selected"': '' ;?>> ADMINISTRATION</option>
					<option data-value="2" value="ACCOUNTS" <?=$row['transf_group']=='ACCOUNTS' ? 'selected="selected"': '' ;?>> ACCOUNTS</option>
					<option data-value="3" value="FUND" <?=$row['transf_group']=='FUND' ? 'selected="selected"': '' ;?>>FUND</option>
					<option data-value="4" value="PENSION" <?=$row['transf_group']=='PENSION' ? 'selected="selected"': '' ;?>> PENSION</option>
				</select>
-->
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <textarea id="description" name="description" class="span12 m-wrap" > <?php echo set_value('description',$description)?></textarea>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Sanctioning Authority <span class="required">*</span></label>
            <div class="controls">
				<select id="transf_sanct_autho" name="transf_sanct_autho" class="form-control" required >
					<option data-value="0" value=""> ---- Select Authority----</option>
					<option data-value="1" value="Pr. Accountant General (A&E)"<?=$row['transf_sanct_autho']=='Pr. Accountant General (A&E)' ? 'selected="selected"': '' ;?>> Pr. Accountant General (A&E)</option>
					<option data-value="2" value="Dy. Accountant General (A/cs & VLC)" <?=$row['transf_sanct_autho']=='Dy. Accountant General (A/cs & VLC)' ? 'selected="selected"': '' ;?>>Dy. Accountant General (A/cs & VLC)</option>
				</select>
            </div>
          </div>
		   <div class="control-group">
            <label class="control-label">Sanctioned Date<span class="required">*</span></label>
            <div class="controls">
				<input type="text" id="transf_sanct_autho_dt" name="transf_sanct_autho_dt" value="<?php echo get_datepicker_date(set_value('transf_sanct_autho_dt',$transf_sanct_autho_dt))?>" class="span12 m-wrap datepicker" >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Signing Authority<span class="">*</span></label>
            <div class="controls">
				<input type="text" id="transf_sign_autho" name="transf_sign_autho" value="dagacvlc" class="span12 m-wrap " readonly >
<!--
				<select id="transf_sign_autho" name="transf_sign_autho" class="form-control" required >
					<option data-value="0" value=""> ---- Select Authority----</option>
					<option data-value="1" value="pagae" <?=$row['transf_sign_autho']=='pagae' ? 'selected="selected"': '' ;?>> Pr. Accountant General (A&E)</option>
					<option data-value="2" value="dagadmn" <?=$row['transf_sign_autho']=='dagadmn' ? 'selected="selected"': '' ;?>> Dy Accountant General (Admin)</option>
					<option data-value="3" value="dagacvlc" <?=$row['transf_sign_autho']=='dagacvlc' ? 'selected="selected"': '' ;?>>Dy. Accountant General (A/cs & VLC)</option>
					<option data-value="4" value="dagpen" <?=$row['transf_sign_autho']=='dagpen' ? 'selected="selected"': '' ;?>> Dy. Accountant General (Pension)</option>
					<option data-value="4" value="dagfund" <?=$row['transf_sign_autho']=='dagfund' ? 'selected="selected"': '' ;?>> Dy. Accountant General (Fund)</option>
					<option data-value="2" value="boadmn" <?=$row['transf_sign_autho']=='boadmn' ? 'selected="selected"': '' ;?>> Branch Officer (Admin) </option>
					<option data-value="3" value="boam" <?=$row['transf_sign_autho']=='boam' ? 'selected="selected"': '' ;?>>Branch Officer (AM)</option>
					<option data-value="4" value="bofm" <?=$row['transf_sign_autho']=='bofm' ? 'selected="selected"': '' ;?>> Branch Officer (FM)</option>
					<option data-value="4" value="bopenc" <?=$row['transf_sign_autho']=='bopenc' ? 'selected="selected"': '' ;?>> Branch Officer (Pen Coordn)</option>
				</select>
-->
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Upload Attachment</label>
            <div class="controls">
      			 <span class="help-block" style = "color: red;">Add Full Url as Attachment Link if already uploaded,  otherwise Upload Attachment.</span>
				 <span>
					<input id="attachment" type="file" name="attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
      			  	<div><button type="button" class="btn btn-inverse" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($pdf_name != ''){echo '&nbsp;<a href="'.base_url().'files/'.$pdf_name.'" target="_blank">'.$pdf_name.'</a>';}?></span></div>
      			  </span>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Attachment Link</label>
            <div class="controls">
				<input type="text" id="order_file_link" name="order_file_link" value="<?php echo set_value('order_file_link',$order_file_link)?>" class="span12 m-wrap "  >	
			</div>
          </div>
		  
    	 <div class="control-group">
            <label class="control-label">Employee Concerned</label>
            <div class="controls">
              <div class="filter-area">
                <div class="filter-row">
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
                    <input id="all-checked" type="checkbox" onclick="checkUncheckAll()" /> &nbsp; All
                  </div>
                  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
                    <select id="filter-designation" onchange="filterEmployeeByDesignation(this.value)">
                      <option value="all">Select Designation</option>
                      <?php
                        foreach($designation as $value){
                          echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                      ?>
                    </select>
                  </div>
                  <div class="filter" style="display: inline-block; margin: 0px 0px 0px 10px;">
                    <input id="selected-only" type="checkbox" onclick="checkSelectedOnly()" /> &nbsp; Selected Only
                  </div>
                </div> 
              </div>
              <div class="epmloyees-list" style="border: 1px outset #d6d6c2; width:100%; max-height: 200px; overflow: auto;">
        				 <?php
        			  foreach($employees as $emp){
        			  	 //echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input type="checkbox" name="emp_concerned['.$emp['empid'].']" '.(in_array($emp['empid'],$asign_emp) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].'/ '.$emp['mbno'].' ]</div>';
						 echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input type="checkbox"  name="emp_concerned['.$emp['empid'].']" value="'.$emp['mbno'].'" '.(in_array($emp['empid'],$asign_emp) ? 'checked' : '').' />&nbsp; '.$emp['empname'].'  ['.$emp['desig'].' / '.$emp['empid'].' / '.$emp['mbno'].' ]</div>';
        			  }?>
              </div>
            </div>
          </div>
		    <div>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />		
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_transfer'">Cancel</button>
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
function previewMultipleImage(file_obj,container_id){
   if (file_obj.files && file_obj.files[0]) {
    for(var i = 0; i< file_obj.files.length; i++){
      var url = file_obj.files[i].name;
      var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();      
      if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'doc' || ext == 'docx' || ext == 'csv' || ext == 'xls' || ext == 'xlsx' || ext == 'pdf'){
        $('#'+container_id).append('<br/><em>&nbsp;&nbsp;' + url + '</em>');
      }else{
        $('#attachment').val('');
        $('#'+container_id).html('');      
        alert('file type not supported! Supported file types are : .jpg,.png,.jpeg,.doc,.docx,.csv,.xls,.xlsx,.pdf');
        break;
      }

    }   
  }
}
function filterEmployeeByDesignation(desig){
  desig = desig.toLowerCase();
   $('.emp-row').each(function(i){
      if(desig != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-designation') == desig){
          $(this).css('display','block');
        }
      }else{
        $(this).css('display','block');
      }
    });
   checkUncheckAll();
}
function checkSelectedOnly(){
  let isChecked = $('#selected-only').is(':checked');
  $('.emp-row').each(function(i){
    if(isChecked){
      if(!$(this).find('input').prop('checked')){
        $(this).css('display','none');
      }
    }else{
      $(this).css('display','block');
    }
  });
}
function checkUncheckAll(){
  var desig = $('#filter-designation').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.emp-row').each(function(i){
    $(this).find('input').prop('checked',false);
    if(isChecked){
      if(desig != 'all'){
        if($(this).attr('data-designation') == desig){
          $(this).find('input').prop('checked',true);
        }
      }else{
        $(this).find('input').prop('checked',true);
      }
    }    
  });
}
</script>