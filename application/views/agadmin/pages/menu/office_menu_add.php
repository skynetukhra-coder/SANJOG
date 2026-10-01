<?php
$menu_name = isset($row['menu_name']) ? $row['menu_name'] : '';
$status = isset($row['status']) ? $row['status'] : '';
$parent_menu_id = isset($row['sub_menu_id']) ? $row['sub_menu_id'] : '';
$page_id = isset($row['page_id']) ? $row['page_id'] : '';
$url_link = isset($row['url_link']) ? $row['url_link'] : '';
$wing = isset($row['wing']) ? $row['wing'] : '';
$sort = isset($row['sort']) ? $row['sort'] : 1;
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Office Menu</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
          <fieldset>
          <div class="control-group">
            <label class="control-label">Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" id="" name="menu_name" value="<?php echo set_value('menu_name',$menu_name)?>" data-required="1" class="span12 m-wrap" required>
			  <span class="help-block">&nbsp; ( Identification name only. It will not displayed in Site.)</span>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Sort</label>
            <div class="controls">
              <input type="number" id="" name="sort" value="<?php echo set_value('sort',$sort)?>" data-required="1" class="span12 m-wrap" required>
			  <span class="help-block">&nbsp; ( Adjust listing order. Default value 100 .)</span>
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Menu<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap" name="sub_menu_id" data-live-search="true" required>
			  	<option value="0">-- Parent Menu --</option>
				<?php
					function callsub($sub,$parent_id = 0,$inner,$parent_menu_id){
									$submenu = $sub[$parent_id];
									$sb = 1;
									++$inner;
									foreach($submenu as $r){?>
										 <option value="<?php echo $r['office_menu_id'] ?>" <?php echo $r['office_menu_id'] == $parent_menu_id ? 'selected' :'' ?> ><?php echo str_repeat('-----',$inner).'&nbsp;'.$r['menu_name'] ?></option>
										 
									<?php 
										if(isset($sub[$r['office_menu_id']])){
											//$inner++;
											callsub($sub,$r['office_menu_id'],$inner,$parent_menu_id);
										}
									}
								}
					if(!empty($results)){
						foreach($results as $row){?>
							<option value="<?php echo $row['office_menu_id'] ?>" <?php echo $row['office_menu_id'] == $parent_menu_id ? 'selected' :'' ?> ><?php echo $row['menu_name'] ?></option>
							<?php
							if(isset($sub[$row['office_menu_id']])){
								// Has sub menu
								$inner = 1;
								callsub($sub,$row['office_menu_id'],$inner,$parent_menu_id);
							}
						?>
					<?php
						}
					}
				?>
              </select>
            </div>
          </div>
		  <?php
		  if(strtolower($this->session->userdata('admin_type')) == 'superadmin'){?>
		  <div class="control-group">
            <label class="control-label">Wing<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap" name="wing" required>
			  	<option value="all wing">All wing</option>
				<option value="administration" <?php echo set_select('wing', "administration", ($wing == "administration" ? true : false)); ?>  >Administration</option>
				<option value="accounts" <?php echo set_select('wing', "accounts", ($wing == "accounts" ? true : false)); ?> >Accounts</option>
				<option value="fund" <?php echo set_select('wing', "fund", ($wing == "fund" ? true : false)); ?> >Fund</option>
				<option value="pension" <?php echo set_select('wing', "pension", ($wing == "pension" ? true : false)); ?> >Pension</option>
              </select>
            </div>
          </div>
		  <?php
		  }
		  ?>
		  <div class="control-group">
            <label class="control-label">Content<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap selectpicker" name="page_id" required  data-live-search="true">
				<option value="0">-- Select --</option>
				<?php
					if(!empty($pages)){
						foreach($pages as $page){?>
							<option value="<?php echo $page['page_id'] ?>" <?php echo $page['page_id'] == $page_id ? 'selected' :'' ?> >[<?php echo $page['type'] ?>] &nbsp;<?php echo $page['page_name'] ?></option>
					<?php
						}
					}
				?>
              </select>
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label">Link Url</label>
            <div class="controls">
              <input type="text" id="" name="url_link" value="<?php echo set_value('url_link',$url_link)?>" data-required="1" class="span12 m-wrap">
			  <span class="help-block">&nbsp; (Optional, add content or add Full Url for this menu .)</span>
            </div>
          </div>
		  <!--<div class="control-group">
            <label class="control-label">Status<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap" name="status" required>
				<option value="ACTIVE" <?php echo set_select('status', "ACTIVE", ($status == "ACTIVE" ? true : false)); ?> >Active</option>
				<option value="INACTIVE" <?php echo set_select('status', "INACTIVE", ($status == "INACTIVE" ? true : false)); ?> >Inactive</option>
              </select>
            </div>
          </div>-->
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
							$display_name = isset($menu_details[$l['language_id']]['display_name']) ? $menu_details[$l['language_id']]['display_name'] : '';
							?>
							<div id="lang_<?php echo $l['language_id'] ?>" class="tab-pane fade in <?php echo ($i++ == 0 ? ' active ' : '') ?>">
							  <div class="control-group">
								<label class="control-label">Menu Title<span class="required">*</span></label>
								<div class="controls">
								  <input type="text" name="lang[<?php echo $l['language_id']?>][display_name]" value="<?php echo set_value('lang['.$l['language_id'].'[display_name]',$display_name)?>" data-required="1" class="span12 m-wrap">
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
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>menu/ag-ae'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="<?php echo base_url()?>assets/admin/bootstrap/css/bootstrap-select.min.css">
<script src="<?php echo base_url()?>assets/admin/bootstrap/js/bootstrap-select.min.js"></script>
<script>
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