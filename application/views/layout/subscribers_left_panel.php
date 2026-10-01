<div class="quick-link on-site-tree">
  <h3 class="medium"><?php echo isset($name) ? $name : "Menu"; ?></h3>
	<div id="tree" class="span3">
		<ul id="menu-group-1" class="nav menu">  
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>subs/dashboard">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('dashboard')?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>subs/account_statement">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('gpf_ac_statement')?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>subs/missing_debit_credit">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('missing_debit_credit')?></span>                      
				</a>
			</li>
<!--			
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>subs/ddo_file_status">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('missing_debit_cred')?>Status of Application submitted by DDO</span>                      
				</a>
			</li>
-->			
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>subs/final_payment_authority">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('final_payment_authority')?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>subs/rates_of_interest">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('rate_of_interest')?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>subs/profile">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('update_profile'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>subs/logout">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('logout')?></span>                      
				</a>
			</li>
		</ul>          
	</div>      
</div> 