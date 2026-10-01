
<div class="quick-link on-site-tree">
	<div class="dark" style="text-align:center; color: white; font-size:18px; font-weight:bold; font-family:arial;letter-spacing:4px;">
		<span>SANJOG</span>
	</div>
  <h3 class="medium"><?php echo isset($name) ? $name : "Menu"; ?></h3>
	<div id="tree" class="span3">
		<ul id="menu-group-1" class="nav menu">  
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_dacadre/information">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_information'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_dacadre/circular">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('cir'); ?> Imp Office Order</span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_dacadre/documents">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_documents'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-1">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('_training'); ?>My Training Order</span>                      
				</a>
				<ul class="children nav-child unstyled small collapse" id="sub-1">
					<li>
					    <a href="<?php echo SITE_BASE_URL?>emp_dacadre/training_details">
						<span class="lbl"><?php echo $this->lang->line('exam_applicati'); ?>As a Trainee</span>                      
						</a>
                    </li>
                    <li>
					    <a href="<?php echo SITE_BASE_URL?>emp_dacadre/faculty_details">
						<span class="lbl"><?php echo $this->lang->line('exam_applicati'); ?>As a Faculty</span>                      
						</a>
                    </li>
				</ul>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_dacadre/profile">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('update_profile'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp_dacadre/logout">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('logout'); ?></span>                      
				</a>
			</li>
		</ul>          
	</div>      
</div>