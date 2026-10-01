<?php
$wing = isset($row['wing']) ? $row['wing'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> FAQ</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate">
          <fieldset>
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
				<div class="span11">
					  <div class="tab-content">
					  	<?php
					  	$i = 0;
					  	foreach($lang as $l){
							$category = isset($page_details[$l['language_id']]['category']) ? $page_details[$l['language_id']]['category'] : '';
							$question = isset($page_details[$l['language_id']]['question']) ? $page_details[$l['language_id']]['question'] : '';
							$answer = isset($page_details[$l['language_id']]['answer']) ? $page_details[$l['language_id']]['answer'] : '';
							?>
							<div id="lang_<?php echo $l['language_id'] ?>" class="tab-pane fade in <?php echo ($i++ == 0 ? ' active ' : '') ?>">
							  <div class="control-group">
								<label class="control-label">Category<span class="required">*</span></label>
								<div class="controls">
								  <input type="text" name="lang[<?php echo $l['language_id']?>][category]" value="<?php echo set_value('lang['.$l['language_id'].'[category]',$category)?>" data-required="1" class="span12 m-wrap" required>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Question<span class="required">*</span></label>
								<div class="controls">
								  <input type="text" name="lang[<?php echo $l['language_id']?>][question]" value="<?php echo set_value('lang['.$l['language_id'].'[question]',$question)?>" data-required="1" class="span12 m-wrap" required>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Answer</label>
								<div class="controls">
								 <textarea id="editor<?php echo $l['language_id']?>" name="lang[<?php echo $l['language_id']?>][answer]" style="width:80%;"><?php echo $answer ?></textarea>
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
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>faq/aggssa'">Cancel</button>
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
		height: 100,
	} );
<?php
}?>	
$(document).ready(function(){
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
</script>