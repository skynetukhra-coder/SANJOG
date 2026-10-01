<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$tr_cd = isset($row['tr_cd']) && !empty($row['tr_cd']) ? $row['tr_cd'] : '';
$ins_prog_year_1 = isset($row['ins_prog_year_1']) && !empty($row['ins_prog_year_1']) ? $row['ins_prog_year_1'] : '';
$ins_prog_file_1 = isset($row['ins_prog_file_1']) && !empty($row['ins_prog_file_1']) ? $row['ins_prog_file_1'] : '';
$ins_prog_year_2 = isset($row['ins_prog_year_2']) && !empty($row['ins_prog_year_2']) ? $row['ins_prog_year_2'] : '';
$ins_prog_file_2 = isset($row['ins_prog_file_2']) && !empty($row['ins_prog_file_2']) ? $row['ins_prog_file_2'] : '';
$ins_prog_year_3 = isset($row['ins_prog_year_3']) && !empty($row['ins_prog_year_3']) ? $row['ins_prog_year_3'] : '';
$ins_prog_file_3 = isset($row['ins_prog_file_3']) && !empty($row['ins_prog_file_3']) ? $row['ins_prog_file_3'] : '';
$ins_report_year_1 = isset($row['ins_report_year_1']) && !empty($row['ins_report_year_1']) ? $row['ins_report_year_1'] : '';
$ins_report_file_1 = isset($row['ins_report_file_1']) && !empty($row['ins_report_file_1']) ? $row['ins_report_file_1'] : '';
$ins_report_year_2 = isset($row['ins_report_year_2']) && !empty($row['ins_report_year_2']) ? $row['ins_report_year_2'] : '';
$ins_report_file_2 = isset($row['ins_report_file_2']) && !empty($row['ins_report_file_2']) ? $row['ins_report_file_2'] : '';
$ins_report_year_3 = isset($row['ins_report_year_3']) && !empty($row['ins_report_year_3']) ? $row['ins_report_year_3'] : '';
$ins_report_file_3 = isset($row['ins_report_file_3']) && !empty($row['ins_report_file_3']) ? $row['ins_report_file_3'] : '';
$outs_para_year_1 = isset($row['outs_para_year_1']) && !empty($row['outs_para_year_1']) ? $row['outs_para_year_1'] : '';
$outs_para_file_1 = isset($row['outs_para_file_1']) && !empty($row['outs_para_file_1']) ? $row['outs_para_file_1'] : '';
$outs_para_year_2 = isset($row['outs_para_year_2']) && !empty($row['outs_para_year_2'])  ? $row['outs_para_year_2'] : '';
$outs_para_file_2 = isset($row['outs_para_file_2']) && !empty($row['outs_para_file_2'])  ? $row['outs_para_file_2'] : '';
$outs_para_year_3 = isset($row['outs_para_year_3']) && !empty($row['outs_para_year_3'])  ? $row['outs_para_year_3'] : '';
$outs_para_file_3 = isset($row['outs_para_file_3']) && !empty($row['outs_para_file_3'])  ? $row['outs_para_file_3'] : '';
$annual_report_year_1 = isset($row['annual_report_year_1']) && !empty($row['annual_report_year_1'])  ? $row['annual_report_year_1'] : '';
$annual_report_file_1 = isset($row['annual_report_file_1']) && !empty($row['annual_report_file_1'])  ? $row['annual_report_file_1'] : '';
$annual_report_year_2 = isset($row['annual_report_year_2']) && !empty($row['annual_report_year_2'])  ? $row['annual_report_year_2'] : '';
$annual_report_file_2 = isset($row['annual_report_file_2']) && !empty($row['annual_report_file_2'])  ? $row['annual_report_file_2'] : '';
$annual_report_year_3 = isset($row['annual_report_year_3']) && !empty($row['annual_report_year_3'])  ? $row['annual_report_year_3'] : '';
$annual_report_file_3 = isset($row['annual_report_file_3']) && !empty($row['annual_report_file_3'])  ? $row['annual_report_file_3'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Treasury Files</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal" enctype="multipart/form-data">
          <fieldset>
		  <div class="control-group">
            <label class="control-label">Treasury Id<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="tr_cd" name="tr_cd" value="<?php echo set_value('tr_cd',$tr_cd)?>" class="span12 m-wrap" readonly>
            </div>
          </div>
		  <?php 
		  $max_year = date('m') <= 3 ? date('Y') : date('Y') + 1;
		  $year_range_1 = ($max_year - 1).' - '.$max_year;
		  $year_range_2 = ($max_year - 2).' - '.($max_year - 1);
		  $year_range_3 = ($max_year - 3).' - '.($max_year - 2);
		  $year_range_4 = ($max_year - 4).' - '.($max_year - 3);
		  $year_range_5 = ($max_year - 5).' - '.($max_year - 4);
		  ?>
		  <h5 class="gap1">Treasury Inspection Programme and Team Inspection</h5>
		  
		  <div class="control-group">
            <label class="control-label">File 1</label>
            <div class="controls">
              <select class="span4 m-wrap" name="ins_prog_year_1">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $ins_prog_year_1 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $ins_prog_year_1 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $ins_prog_year_1 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $ins_prog_year_1 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $ins_prog_year_1 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			  <input type="file" name="ins_prog_file_1"/><?php echo $ins_prog_file_1 != '' ? '<a target="_blank" href="'.base_url().'files/'.$ins_prog_file_1.'">'.$ins_prog_file_1.'</a>' : '' ?>
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">File 2</label>
            <div class="controls">
              <select class="span4 m-wrap" name="ins_prog_year_2">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $ins_prog_year_2 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $ins_prog_year_2 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $ins_prog_year_2 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $ins_prog_year_2 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $ins_prog_year_2 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			 <input type="file" name="ins_prog_file_2"/><?php echo $ins_prog_file_2 != '' ? '<a target="_blank" href="'.base_url().'files/'.$ins_prog_file_2.'">'.$ins_prog_file_2.'</a>' : ''  ?>
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">File 3</label>
            <div class="controls">
              <select class="span4 m-wrap" name="ins_prog_year_3">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $ins_prog_year_3 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $ins_prog_year_3 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $ins_prog_year_3 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $ins_prog_year_3 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $ins_prog_year_3 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			  <input type="file" name="ins_prog_file_3"/><?php echo $ins_prog_file_3 != '' ? '<a target="_blank" href="'.base_url().'files/'.$ins_prog_file_3.'">'.$ins_prog_file_3.'</a>' : ''  ?>
            </div>
          </div>
		  
		  <h5 class="gap1">Treasury Inspection Report</h5>
		  
		  <div class="control-group">
            <label class="control-label">File 1</label>
            <div class="controls">
              <select class="span4 m-wrap" name="ins_report_year_1">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $ins_report_year_1 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $ins_report_year_1 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $ins_report_year_1 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $ins_report_year_1 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $ins_report_year_1 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			  <input type="file" name="ins_report_file_1"/><?php echo $ins_report_file_1 != '' ? '<a target="_blank" href="'.base_url().'files/'.$ins_report_file_1.'">'.$ins_report_file_1.'</a>' : ''  ?>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">File 2</label>
            <div class="controls">
              <select class="span4 m-wrap" name="ins_report_year_2">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $ins_report_year_2 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $ins_report_year_2 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $ins_report_year_2 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $ins_report_year_2 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $ins_report_year_2 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			 <input type="file" name="ins_report_file_2"/><?php echo $ins_report_file_2 != '' ? '<a target="_blank" href="'.base_url().'files/'.$ins_report_file_2.'">'.$ins_report_file_2.'</a>' : ''  ?>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">File 3</label>
            <div class="controls">
              <select class="span4 m-wrap" name="ins_report_year_3">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $ins_report_year_3 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $ins_report_year_3 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $ins_report_year_3 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $ins_report_year_3 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $ins_report_year_3 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			  <input type="file" name="ins_report_file_3"/><?php echo $ins_report_file_3 != '' ? '<a target="_blank" href="'.base_url().'files/'.$ins_report_file_3.'">'.$ins_report_file_3.'</a>' : ''  ?>
            </div>
          </div>
		  
		  <h5 class="gap1">Outstanding Paras</h5>
		  
		  <div class="control-group">
            <label class="control-label">File 1</label>
            <div class="controls">
              <select class="span4 m-wrap" name="outs_para_year_1">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $outs_para_year_1 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $outs_para_year_1 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $outs_para_year_1 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $outs_para_year_1 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $outs_para_year_1 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			   <input type="file" name="outs_para_file_1"/><?php echo $outs_para_file_1 != '' ? '<a target="_blank" href="'.base_url().'files/'.$outs_para_file_1.'">'.$outs_para_file_1.'</a>' : ''  ?>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">File 2</label>
            <div class="controls">
              <select class="span4 m-wrap" name="outs_para_year_2">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $outs_para_year_2 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $outs_para_year_2 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $outs_para_year_2 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $outs_para_year_2 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $outs_para_year_2 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			  <input type="file" name="outs_para_file_2"/><?php echo $outs_para_file_2 != '' ? '<a target="_blank" href="'.base_url().'files/'.$outs_para_file_2.'">'.$outs_para_file_2.'</a>' : ''  ?>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">File 3</label>
            <div class="controls">
              <select class="span4 m-wrap" name="outs_para_year_3">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $outs_para_year_3 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $outs_para_year_3 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $outs_para_year_3 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $outs_para_year_3 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $outs_para_year_3 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			   <input type="file" name="outs_para_file_3"/><?php echo $outs_para_file_3 != '' ? '<a target="_blank" href="'.base_url().'files/'.$outs_para_file_3.'">'.$outs_para_file_3.'</a>' : ''  ?>
            </div>
          </div>
		  
		  <h5 class="gap1">Annual Reports</h5>
		  
		  <div class="control-group">
            <label class="control-label">File 1</label>
            <div class="controls">
              <select class="span4 m-wrap" name="annual_report_year_1">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $annual_report_year_1 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $annual_report_year_1 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $annual_report_year_1 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $annual_report_year_1 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $annual_report_year_1 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			  <input type="file" name="annual_report_file_1"/><?php echo $annual_report_file_1 != '' ? '<a target="_blank" href="'.base_url().'files/'.$annual_report_file_1.'">'.$annual_report_file_1.'</a>' : ''  ?>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">File 2</label>
            <div class="controls">
              <select class="span4 m-wrap" name="annual_report_year_2">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $annual_report_year_2 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $annual_report_year_2 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $annual_report_year_2 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $annual_report_year_2 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $annual_report_year_2 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			  <input type="file" name="annual_report_file_2"/><?php echo $annual_report_file_2 != '' ? '<a target="_blank" href="'.base_url().'files/'.$annual_report_file_2.'">'.$annual_report_file_2.'</a>' : ''  ?>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">File 3</label>
            <div class="controls">
              <select class="span4 m-wrap" name="annual_report_year_3">
					<option value="" > -- Select Year -- </option>
					<option value="<?php echo $year_range_1 ?>" <?php echo $annual_report_year_3 == $year_range_1 ? 'selected' : ''?> ><?php echo $year_range_1 ?></option>
                    <option value="<?php echo $year_range_2 ?>" <?php echo $annual_report_year_3 == $year_range_2 ? 'selected' : ''?> ><?php echo $year_range_2 ?></option>
					<option value="<?php echo $year_range_3 ?>" <?php echo $annual_report_year_3 == $year_range_3 ? 'selected' : ''?> ><?php echo $year_range_3 ?></option>
					<option value="<?php echo $year_range_4 ?>" <?php echo $annual_report_year_3 == $year_range_4 ? 'selected' : ''?> ><?php echo $year_range_4 ?></option>
					<option value="<?php echo $year_range_5 ?>" <?php echo $annual_report_year_3 == $year_range_5 ? 'selected' : ''?> ><?php echo $year_range_5 ?></option>
			  </select>
			   <input type="file" name="annual_report_file_3"/><?php echo $annual_report_file_3 != '' ? '<a target="_blank" href="'.base_url().'files/'.$annual_report_file_3.'">'.$annual_report_file_3.'</a>' : ''  ?>
            </div>
          </div>
		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury'">Cancel</button>
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