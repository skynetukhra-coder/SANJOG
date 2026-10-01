
<div class="quick-link on-site-tree">
  <h3 class="medium"><?php echo isset($name) ? $name : "Menu"; ?></h3>
	<div id="tree" class="span3">
		<ul id="menu-group-1" class="nav menu">  
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>ddo/dashboard">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_dashboard'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>ddo/subscriber_ddo">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_dash'); ?>Update Subscriber's DDO</span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>ddo/application_document">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_dash'); ?>Submit Application / Document</span>                      
				</a>
			</li>
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-1">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('for_try'); ?> View Status </span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-1">
						<li class="deeper parent ">
							<a href="<?php echo SITE_BASE_URL?>ddo/all_gpf_acnos">
								<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
								<span class="lbl"><?php echo $this->lang->line('my_dash'); ?>GPF No Allotment Applications</span>                      
							</a>
						</li>
						<li class="deeper parent ">
							<a href="<?php echo SITE_BASE_URL?>ddo/all_nominations">
								<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
								<span class="lbl"><?php echo $this->lang->line('my_dash'); ?>Nominations Applications</span>                      
							</a>
						</li>
						<li class="deeper parent ">
							<a href="<?php echo SITE_BASE_URL?>ddo/all_adjustments">
								<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
								<span class="lbl"><?php echo $this->lang->line('my_dash'); ?>Missing Cr./ Dr. Adjustment</span>                      
							</a>
						</li>
				</ul>
			</li>
									
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>ddo/profile">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_profile'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>ddo/logout">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('logout'); ?></span>                      
				</a>
			</li>
		</ul>          
	</div>      
</div>   