
</div>
</section>
<footer class="footer-top">
<div class="container">
	<div class="footer-grid">
		<div class="footer-link-col">
			<ul class="footer-links-list">
				<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="https://cag.gov.in/ae/west-bengal/en/page-ae-west-bengal-terms-conditions-kol" target="_blank"><?php echo $this->lang->line('terms_condition'); ?></a></li>
				<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="https://cag.gov.in/ae/west-bengal/en/page-ae-west-bengal-accessibility-statement-kol" target="_blank"><?php echo $this->lang->line('accessibility_statement'); ?></a></li>
			</ul>
		</div>
		<div class="footer-link-col">
			<ul class="footer-links-list">
				<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="https://cag.gov.in/ae/west-bengal/en/page-ae-west-bengal-privacy-policy-kol" target="_blank"><?php echo $this->lang->line('privacy_policy'); ?></a></li>
				<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="https://cag.gov.in/ae/west-bengal/en/sitemap" target="_blank"><?php echo $this->lang->line('sitemap'); ?></a></li>
			</ul>
		</div>
		<div class="footer-link-col">
			<ul class="footer-links-list">
				<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="https://cag.gov.in/ae/west-bengal/en/page-ae-west-bengal-copyright-policy-kol" target="_blank"><?php echo $this->lang->line('copyright_policy'); ?></a></li>
				<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="https://cag.gov.in/ae/west-bengal/en/page-ae-west-bengal-help-kol" target="_blank"><?php echo $this->lang->line('help'); ?></a></li>
			</ul>
		</div>
		<div class="footer-link-col">
			<ul class="footer-links-list">
				<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="https://cag.gov.in/ae/west-bengal/en/page-ae-west-bengal-hyperlinking-policy-kol" target="_blank"><?php echo $this->lang->line('hyperlink_policy'); ?></a></li>
			</ul>
		</div>
	</div>
</div>
</footer>
<footer class="footer-bottom">
  <div class="container">
	<div class="footer-bottom-flex">
		<p class="footer-copyright-text">© Copyright <?php echo date('Y'); ?> - <?php echo $this->lang->line('content_owned_by'); ?> the O/o : <?php echo $this->lang->line('ag_ae'); ?>. All Rights Reserved.</p>
	</div>

<!--  
   --   Office Addres and visitor count  -
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
-->	
<!--   /Office Addres and visitor count  -->

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