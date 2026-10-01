<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$dyear = isset($row['dyear']) ? $row['dyear'] : '';
$dmonth = isset($row['dmonth']) ? $row['dmonth'] : '';
$order_type = isset($row['order_type']) ? $row['order_type'] : '';
$title = isset($row['title']) ? $row['title'] : '';
$details = isset($row['details']) ? $row['details'] : '';
$order_date = isset($row['order_date']) ? date('d-m-Y',strtotime($row['order_date'])) : '';
$upload_dt = isset($row['upload_dt']) ? date('d-m-Y',strtotime($row['upload_dt'])) : '';
$attachment = isset($row['attachment']) ? $row['attachment'] : '';
?>
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Office Order</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal"  enctype="multipart/form-data">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">Order Type<span class="required">*</span></label>
            <div class="controls">
					<select class="form-control" name="order_type" required>
						<option value="">----- Select Order Type ----</option>
						<option value="All Circular" <?php echo set_select('order_type', "All Circular", ($order_type == "All Circular" ? true : false)); ?>  >Order to All Treasury</option>
						<option value="Treasury Review Report" <?php echo set_select('order_type', "Treasury Review Report", ($order_type == "All Circular" ? true : false)); ?>  >Treasury Review Report</option>
					</select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Year<span class="required">*</span></label>
            <div class="controls">
              <select name="dyear" class="form-control" required>
					<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
						<?php
						for($i = date('Y')+1; $i >= 2019; $i--){
						echo '<option value="'.$i.'" '.($this->input->get('dyear',true) == $i ? 'selected': '').' >'.$i.'</option>';
						}?>
				</select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Month<span class="required">*</span></label>
            <div class="controls">
              <select class="form-control" name="dmonth" required>
					<option value="">-----Select Month----</option>
					<option value="January" <?php echo set_select('dmonth', "January", ($dmonth == "January" ? true : false)); ?>  >January</option>
					<option value="February" <?php echo set_select('dmonth', "February", ($dmonth == "February" ? true : false)); ?>  >February</option>
					<option value="March" <?php echo set_select('dmonth', "March", ($dmonth == "March" ? true : false)); ?>  >March</option>
					<option value="April" <?php echo set_select('dmonth', "April", ($dmonth == "April" ? true : false)); ?>  >April</option>
					<option value="May" <?php echo set_select('dmonth', "May", ($dmonth == "January" ? true : false)); ?>  >May</option>
					<option value="June" <?php echo set_select('dmonth', "June", ($dmonth == "June" ? true : false)); ?>  >June</option>
					<option value="July" <?php echo set_select('dmonth', "July", ($dmonth == "July" ? true : false)); ?>  >July</option>
					<option value="August" <?php echo set_select('dmonth', "August", ($dmonth == "August" ? true : false)); ?>  >August</option>
					<option value="September" <?php echo set_select('dmonth', "September", ($dmonth == "September" ? true : false)); ?>  >September</option>
					<option value="October" <?php echo set_select('dmonth', "October", ($dmonth == "October" ? true : false)); ?>  >October</option>
					<option value="November" <?php echo set_select('dmonth', "November", ($dmonth == "November" ? true : false)); ?>  >November</option>
					<option value="December" <?php echo set_select('dmonth', "December", ($dmonth == "December" ? true : false)); ?>  >December</option>
					<option value="March Supplimentary" <?php echo set_select('dmonth', "March Supplimentary", ($dmonth == "March Supplimentary" ? true : false)); ?>  >March Supplimentary</option>
				  </select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Title<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="title" name="title" value="<?php echo set_value('title',$title)?>" data-required="1" class="span12 m-wrap" required >
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
              <textarea id="details" name="details" class="span12 m-wrap"> <?php echo set_value('details',$details)?></textarea>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Office Order Date</label>
            <div class="controls">
             <input type="text" id="order_date" name="order_date" value="<?php echo $order_date?>" data-required="1" class="span12 m-wrap datepicker" data-provide="datepicker" autocomplete="off">
			</div>
          </div>
		  <div class="control-group">
            <label class="control-label">Upload File</label>
            <div class="controls">
              <span>
                <input id="attachment" type="file" name="attachment[]" multiple class="span12 m-wrap" onchange="previewMultipleImage(this,'up_file_display')" style="display:none"/>
                <div><button type="button" class="btn btn-inverse" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"></span></div>
              </span>
    			  <?php /* ?>
            <span>
    			  	<input id="attachment" type="file" name="attachment[]" class="span12 m-wrap" multiple/>
    			  </span>
            <?php */ ?>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Upload Date</label>
            <div class="controls">
             <input type="text" id="upload_dt" name="upload_dt" value="<?php echo $upload_dt?>" data-required="1" class="span12 m-wrap datepicker" data-provide="datepicker" autocomplete="off">
			</div>
          </div>
		   <div>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_orders'">Cancel</button>
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
      if(ext == 'pdf'){
        $('#'+container_id).append('<br/><em>&nbsp;&nbsp;' + url + '</em>');
      }else{
        $('#attachment').val('');
        $('#'+container_id).html('');      
        alert('file type not supported! Supported file types is .pdf only');
        break;
      }

    }   
  }
}
function filterDepartmentByDesignation(grnt_d){
  grnt_d = grnt_d.toLowerCase();
   $('.dept-row').each(function(i){
      if(grnt_d != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-description') == grnt_d){
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
  $('.dept-row').each(function(i){
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
  var grnt_d = $('#filter-description').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.dept-row').each(function(i){
    $(this).find('input').prop('checked',false);
    if(isChecked){
      if(grnt_d != 'all'){
        if($(this).attr('data-description') == grnt_d){
          $(this).find('input').prop('checked',true);
        }
      }else{
        $(this).find('input').prop('checked',true);
      }
    }    
  });
}
</script>