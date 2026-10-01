
<div class="quick-link on-site-tree">
  <h3 class="medium" style="text-align:center"><?php echo isset($user_name) ? $user_name : ''?><?php echo isset($grnt_cd) ? ' ('.$grnt_cd.')' : ""; ?></h3>
	<div id="tree" class="span3">
		<ul id="menu-group-1" class="nav menu">  
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>department/dashboard">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_dashboard'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>department/orders">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('crclr_ofc_ordr'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-1">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('reports'); ?> </span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-1">
                        <li>
                            <a href="<?php echo SITE_BASE_URL?>department/civil_accounts">
							<span class="lbl"><?php echo $this->lang->line('civil_accounts'); ?></span>                      
							</a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_BASE_URL?>department/expenditure_report">
							<span class="lbl"><?php echo $this->lang->line('expenditure_report'); ?></span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>department/appreciation_note">
							<span class="lbl"><?php echo $this->lang->line('appreciation_note'); ?></span>                      
							</a>
						</li>
				</ul>
			</li>	
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-2" href="#sub-2">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('for_dept'); ?> </span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-2">
                        <li>
                            <a href="<?php echo SITE_BASE_URL?>department/documents">
							<span class="lbl"><?php echo $this->lang->line('documents'); ?></span>                      
							</a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_BASE_URL?>department/reconciliation">
							<span class="lbl"><?php echo $this->lang->line('reconciliation'); ?></span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>department/warning_slip">
							<span class="lbl"><?php echo $this->lang->line('warning'); ?></span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>department/ac_dc_bills">
							<span class="lbl"><?php echo $this->lang->line('ac_dc_bills'); ?></span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>department/investment">
							<span class="lbl"><?php echo $this->lang->line('investment'); ?></span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>department/gia_uc">
							<span class="lbl"><?php echo $this->lang->line('gia_uc'); ?></span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>department/loan_advance">
							<span class="lbl"><?php echo $this->lang->line('loan'); ?>Loan & Advance</span>                      
							</a>
						</li>
				</ul>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>department/profile">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('update_profile'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>department/logout">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('logout'); ?></span>                      
				</a>
			</li>
		</ul>          
	</div>      
</div>