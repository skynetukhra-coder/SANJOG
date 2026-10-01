<div class="row">
	<style type="text/css">
	.page_row .root_lavel{
		border-bottom:1px solid gray;
	}
	.page_row h3.parent{
		margin-bottom:10px;
		cursor:pointer;
	}
	.page_row .sub{
		display:none;
	}
	.page_row .sub-item{
		padding:4px 0 4px 10px;
	}
	</style>
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="quick-link on-site-tree right_ac_entitle">
		  <h3 class="medium" onclick="window.location.href='<?php echo SITE_BASE_URL.'site/accounts_entitlement'?>'"><?php echo $this->lang->line('accounts_entitlement'); ?></h3>
		  <ul>
			<li><a href="<?php echo SITE_BASE_URL.'site/accounts_entitlement/accounts'?>">ACCOUNTS</a></li>
		  </ul>
		</div>
		<div class="right-panel">
		  
		  <div class="missionsec">
			<div class="page_row">
			  <?php echo '<h2>'.$site_for.'</h2>' ?>
			  <br />
			  <?php
				foreach($tabs as $tab){
					echo '<div class="root_lavel">';
					echo '<h3 class="parent">'.$tab['title'].'</h3>';
					if(isset($tab['sub']) && !empty($tab['sub'])){
						echo '<div class="sub">';
						foreach($tab['sub'] as $sub_tab){
							echo '<h4 class="sub-item">'.$sub_tab['title'].'</h4>';
						}
						echo '</div>';
					}
					echo '</div>';
				}
			  ?>
			</div>
		  </div>
		</div>
	</div>
	<div class="col-md-3 col-sm-4 col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
	  <?php $this->load->view('layout/accounts_entitlement');?>
	   </div>
	</div>
</div>