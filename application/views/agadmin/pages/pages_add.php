<?php
$page_name = isset($row['page_name']) ? $row['page_name'] : '';
$page_url = isset($row['page_url']) ? $row['page_url'] : '';
$wing = isset($row['wing']) ? $row['wing'] : '';
$status = isset($row['status']) ? $row['status'] : '';
$m_title = isset($row['meta_title']) ? $row['meta_title'] : '';
$m_key = isset($row['meta_keywords']) ? $row['meta_keywords'] : '';
$m_desc = isset($row['meta_description']) ? $row['meta_description'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Page</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate">
          <fieldset>
          <div class="control-group">
            <label class="control-label">Page Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="dynamic_url_base" name="page_name" value="<?php echo set_value('page_name',$page_name)?>" data-required="1" class="span12 m-wrap" required>
			  <span class="help-block">&nbsp; ( Identification name only. It will not displayed in Site.)</span>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Page URL<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="dynamic_url" name="page_url" value="<?php echo set_value('page_url',$page_url)?>" class="span12 m-wrap" required <?php echo $page_url != '' ? 'readonly' : '' ?> >
			  <span class="help-block"><span id="error_text_url" style="color:red"></span>&nbsp;e.g: <?php echo AGAE_BASE_URL ?>page/<span id="dynamic_url_abs"><?php echo $page_url != '' ? $page_url : 'XXX-XXX'?></span></span>
            </div>
          </div>
		  <?php
		  if(strtolower($this->session->userdata('admin_type')) == 'superadmin'){?>
		  <div class="control-group">
            <label class="control-label">Wing<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap" name="wing">
			  	<option value="" >All Wing</option>
				<option value="administration" <?php echo set_select('wing', "administration", ($wing == "administration" ? true : false)); ?>  >Administration</option>
				<option value="accounts" <?php echo set_select('wing', "accounts", ($wing == "accounts" ? true : false)); ?> >Accounts</option>
				<option value="fund" <?php echo set_select('wing', "fund", ($wing == "fund" ? true : false)); ?> >Fund</option>
				<option value="pension" <?php echo set_select('wing', "pension", ($wing == "pension" ? true : false)); ?> >Pension</option>
              </select>
            </div>
          </div>
		  <?php
		  }?>
		  <div class="control-group">
            <label class="control-label">Status<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap" name="status" required>
				<option value="ACTIVE" <?php echo set_select('status', "ACTIVE", ($status == "ACTIVE" ? true : false)); ?> >Active</option>
				<option value="INACTIVE" <?php echo set_select('status', "INACTIVE", ($status == "INACTIVE" ? true : false)); ?> >Inactive</option>
              </select>
            </div>
          </div>
		  <div class="control-group">
			<label class="control-label">Meta Title</label>
			<div class="controls">
			 <textarea name="meta_title" style="width:90%"><?php echo set_value('meta_title',$m_title)?></textarea>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label">Meta Keywords</label>
			<div class="controls">
			 <textarea name="meta_keywords" style="width:90%"><?php echo set_value('meta_keywords',$m_key)?></textarea>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label">Meta Description</label>
			<div class="controls">
			 <textarea name="meta_description" style="width:90%"><?php echo set_value('meta_description',$m_desc)?></textarea>
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
								<label class="control-label">Page Title<span class="required">*</span></label>
								<div class="controls">
								  <input type="text" name="lang[<?php echo $l['language_id']?>][page_title]" value="<?php echo set_value('lang['.$l['language_id'].'[page_title]',$p_title)?>" data-required="1" class="span12 m-wrap" required>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Page Details</label>
								<div class="controls">
								 <textarea id="editor<?php echo $l['language_id']?>" name="lang[<?php echo $l['language_id']?>][page_desc]" style="width:100%;"><?php echo $p_desc ?></textarea>
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
<script src="<?php echo SITE_BASE_URL;?>editor/ckeditor/ckeditor.js"></script>
<script src="<?php echo SITE_BASE_URL;?>editor/ckeditor/config.js"></script>
<script data-sample="1">
<?php
	foreach($lang as $l){?>
	var editor_<?php echo $l['language_id'] ?> = CKEDITOR.replace( 'editor<?php echo $l['language_id'] ?>', {
		height: 550,
	} );
<?php
	}?>	
</script>
<script>
$(document).ready(function(){
	
	<?php
	if($page_url == ''){?>
	$('#dynamic_url_base').on('blur',function(){
		var txt = $(this).val();
		ckeckUniqueURL(txt);
	});
	<?php
	}?>
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
	if($.trim(set_url) == ''){
		return;
	}
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