
<div class="quick-link on-site-tree">
  <h3 class="medium"><?php echo isset($name) ? $name : "Menu"; ?></h3>
	<div id="tree" class="span3">
		<ul id="menu-group-1" class="nav menu">  
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_ersa/information">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_information'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_ersa/profile">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_profile'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_ersa/documents">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_documents'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_ersa/service_book">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_service_book'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_ersa/logout">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('logout'); ?></span>                      
				</a>
			</li>
		</ul>          
	</div>      
</div>