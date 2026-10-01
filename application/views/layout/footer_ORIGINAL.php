
</div>
</section>

<footer>
  <div class="container">
  	<p><?php echo $this->lang->line('content_owned_by'); ?></p>
    <p><img src="<?php echo SITE_BASE_URL?>assets/images/loc-img.png" alt="" />&nbsp; <?php echo $this->lang->line('ftr_ae_info'); ?></p>
	<p><img src="<?php echo SITE_BASE_URL?>assets/images/loc-img.png" alt="" />&nbsp; <?php echo $this->lang->line('ftr_gssa_info'); ?></p>
	<p><img src="<?php echo SITE_BASE_URL?>assets/images/loc-img.png" alt="" />&nbsp; <?php echo $this->lang->line('ftr_ersa_info'); ?></p>
	<div id="total_visitors">
		<a style="color:#fff" href="<?php echo SITE_BASE_URL?>sitemap"><?php echo $this->lang->line('sitemap'); ?></a> | 
		<a style="color:#fff" href="<?php echo SITE_BASE_URL?>content/terms-condition"><?php echo $this->lang->line('terms_condition'); ?></a> | 
		<a style="color:#fff" href="<?php echo SITE_BASE_URL?>content/privacy-policy"><?php echo $this->lang->line('privacy_policy'); ?></a> | 
		<a style="color:#fff" href="<?php echo SITE_BASE_URL?>content/copyright-policy"><?php echo $this->lang->line('copyright_policy'); ?></a> | 
		<a style="color:#fff" href="<?php echo SITE_BASE_URL?>content/hyperlink-policy"><?php echo $this->lang->line('hyperlink_policy'); ?></a> |
		<a style="color:#fff" href="<?php echo SITE_BASE_URL?>content/accessibility-statement"><?php echo $this->lang->line('accessibility_statement'); ?></a> |
		<a style="color:#fff" href="<?php echo SITE_BASE_URL?>content/help"><?php echo $this->lang->line('help'); ?></a> 
	</div>
	<div id="total_visitors">
		<?php echo $this->lang->line('visitors'); ?> : <span class="vcd" style="font-size:20px;font-family: monospace"><?php echo get_total_visitor()?></span> | 
		<?php echo $this->lang->line('last_updated'); ?> : <span class="vcd" style="font-size:20px;font-family: monospace"><?php echo get_last_updated()?></span>
	</div>
  </div>
  
</footer>
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery-ui.js"></script>
<script src="<?php echo SITE_BASE_URL?>assets/js/bootstrap.js" async></script>
<script src="<?php echo SITE_BASE_URL?>assets/js/script.js"></script>
<script>
<?php
if($this->session->userdata('set_font')){
	if($this->session->userdata('set_font') == 'increase'){
		echo '$(document).ready(function(){increseFont()});';
	}else if($this->session->userdata('set_font') == 'decrese'){
		echo '$(document).ready(function(){decreseFont()});';
	}else{
		echo '$(document).ready(function(){defaultFont()});';
	}	
}	
?>
</script>
<div id="myBtn" class="scroll-top-btn" onclick="topFunction()"><i class="fa fa-angle-up" style="font-size:35px;"></i></div>
</body></html>