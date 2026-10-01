<?php
$page_name = isset($row['page_name']) ? $row['page_name'] : '';
$status = isset($row['status']) ? $row['status'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Blog</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate">
          <fieldset>
          <div class="control-group">
            <label class="control-label">Blog Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="dynamic_url_base" name="page_name" value="<?php echo set_value('page_name',$page_name)?>" data-required="1" class="span12 m-wrap" required>
			  <span class="help-block">&nbsp; ( Identification name only. It will not displayed in Site.)</span>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Status<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap" name="status" required>
				<option value="ACTIVE" <?php echo set_select('status', "ACTIVE", ($status == "ACTIVE" ? true : false)); ?> >Active</option>
				<option value="INACTIVE" <?php echo set_select('status', "INACTIVE", ($status == "INACTIVE" ? true : false)); ?> >Inactive</option>
              </select>
            </div>
          </div>
		  <!--Page Content Multilingual-->
		 <div class="block">
		 	<div class="block-content collapse in" style="margin-left:0; margin-right:0; margin-top:0;border-top:1px solid #ccc">
      			<div class="span12">
					  <ul class="nav nav-tabs" style="background:#ccc">
					  <?php
					  	$i = 0;
					  	foreach($lang as $l){
							echo '<li '.($i++ == 0 ? ' class="active" ' : '').' style="width:'.((100/count($lang))).'%; text-align:center;"><a href="#lang_'.$l['language_id'].'" style="border-left:none;border-top:none">'.$l['language_name'].'</a></li>';
						}
					  ?>
					  </ul>
				</div>
				<div class="span12">
					  <div class="tab-content">
					  	<?php
					  	$i = 0;
					  	foreach($lang as $l){
							$p_title = isset($page_details[$l['language_id']]['page_title']) ? $page_details[$l['language_id']]['page_title'] : '';
							$p_desc = isset($page_details[$l['language_id']]['page_desc']) ? $page_details[$l['language_id']]['page_desc'] : '';
							$m_title = isset($page_details[$l['language_id']]['meta_title']) ? $page_details[$l['language_id']]['meta_title'] : '';
							$m_key = isset($page_details[$l['language_id']]['meta_keywords']) ? $page_details[$l['language_id']]['meta_keywords'] : '';
							$m_desc = isset($page_details[$l['language_id']]['meta_description']) ? $page_details[$l['language_id']]['meta_description'] : '';
							?>
							<div id="lang_<?php echo $l['language_id'] ?>" class="tab-pane fade in <?php echo ($i++ == 0 ? ' active ' : '') ?>">
							  <div class="control-group">
								<label class="control-label">Blog Title<span class="required">*</span></label>
								<div class="controls">
								  <input type="text" name="lang[<?php echo $l['language_id']?>][page_title]" value="<?php echo set_value('lang['.$l['language_id'].'[page_title]',$p_title)?>" data-required="1" class="span12 m-wrap" required>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Blog Details</label>
								<div class="controls">
								 <textarea id="editor<?php echo $l['language_id']?>" name="lang[<?php echo $l['language_id']?>][page_desc]" style="width:80%;"><?php echo $p_desc ?></textarea>
								</div>
							  </div>
						  	 
						</div>
						<?php
						}
					  ?>
					  </div>
			  	</div>
			</div>
		 </div>
		  <!--Page Content Multilingual-->
		  
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>contents'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url();?>editor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>editor/ckeditor/config.js"></script>
<script src="<?php echo base_url();?>editor/ckfinder/ckfinder.js"></script>
<script data-sample="1">
<?php
	foreach($lang as $l){?>
	
	//CKEDITOR.addCss( '.cke_editable { font-size: 15px; padding: 2em; }' );
	var editor_<?php echo $l['language_id'] ?> = CKEDITOR.replace( 'editor<?php echo $l['language_id'] ?>', {
		//extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left,margin-top}',
		// Adding drag and drop image upload.
		extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
		uploadUrl: '<?php echo SITE_BASE_URL?>editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
		// Configure your file manager integration. This example uses CKFinder 3 for PHP.
		filebrowserBrowseUrl: '<?php echo SITE_BASE_URL?>editor/ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl: '<?php echo SITE_BASE_URL?>editor/ckfinder/ckfinder.html?type=Images',
		filebrowserUploadUrl: '<?php echo SITE_BASE_URL?>editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl: '<?php echo SITE_BASE_URL?>editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	
		height: 550,
	
		removeDialogTabs: 'image:advanced;link:advanced'
	} );
	CKFinder.setupCKEditor( editor_<?php echo $l['language_id'] ?>, 'editor/ckfinder/' );  
<?php
	}?>	
</script>
<script>
$(document).ready(function(){
	
	
	$('#dynamic_url_base').on('blur',function(){
		var txt = $(this).val();
		ckeckUniqueURL(txt);
	});
	$('#dynamic_url').on('blur',function(){
		var txt = $(this).val();
		ckeckUniqueURL(txt);
	});
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $('.nav-tabs a').on('shown.bs.tab', function(event){
        var x = $(event.target).text();         // active tab
        var y = $(event.relatedTarget).text();  // previous tab
        $(".act span").text(x);
        $(".prev span").text(y);
    });
});
function ckeckUniqueURL(txt){
	var set_url = txt.replace(/\s+/g, '-').toLowerCase();
	$('#dynamic_url').val(set_url);
	// check url exists
	$.ajax({
		'url':'<?php echo ADMIN_BASE_URL?>pages/check_url_exists/<?php echo $this->uri->segment(4) ?>',
		'data':{'url':set_url},
		'success' : function(data){
			var obj = $.parseJSON(data);
			var status = obj.status;
			if(status){
				$('#dynamic_url').css('border','1px solid red');
				$('#dynamic_url').focus();
				$('#error_text_url').text('This url already exists!');
			}else{
				$('#dynamic_url').css('border','1px solid #ccc');
				$('#dynamic_url_abs').text(set_url);
				$('#error_text_url').text('');
			}
		}
	});
}
</script>