<div class="quick-link on-site-tree">
  <h3 class="medium" style="text-align:center"><?php echo isset($user_name) ? $user_name : ''?><?php echo isset($users) ? ' ('.$users.')' : ""; ?></h3>
	
	<div id="tree" class="span3">
		<ul id="menu-group-1" class="nav menu">  
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>treasury/dashboard">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_dashboard'); ?></span>                      
				</a>
			</li>
	<?php if ($treasury_data['users'] !='AUDIT1'){ ?>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>treasury/treasury_review_report">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('crclr_ofc_o'); ?>Treasury Review Report</span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>treasury/orders">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('crclr_ofc_ordr'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>treasury/documents">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('crclr_ofc_o'); ?>Treasury Documents</span>                      
				</a>
			</li>
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-1">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('for_try'); ?> Treasury Inspection Report </span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-1">
						<li>
                            <a href="<?php echo SITE_BASE_URL?>treasury/treasury_ir">
							<span class="lbl"><?php echo $this->lang->line('ob_suspense'); ?>View TI Report</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>treasury/outstanding_paras">
							<span class="lbl"><?php echo $this->lang->line('ob_suspense'); ?> Status of TI Paras</span>                      
							</a>
                        </li>
				</ul>
			</li>
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-2" href="#sub-2">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('for_try'); ?> Treasury Report </span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-2">
						<li>
                            <a href="<?php echo SITE_BASE_URL?>treasury/treasury_report">
							<span class="lbl"><?php echo $this->lang->line('ob_suspense'); ?> Submit Report</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>treasury/treasury_reports_all">
							<span class="lbl"><?php echo $this->lang->line('ob_suspense'); ?>View submitted Report</span>                      
							</a>
                        </li>
				</ul>
			</li>
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-3" href="#sub-3">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('for_try'); ?>Treasury Accounts Correction </span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-3">
						<li>
                            <a href="<?php echo SITE_BASE_URL?>treasury/correction_slip_issue">
							<span class="lbl"><?php echo $this->lang->line('ob_suspense'); ?>Submit Correction Memo</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>treasury/all_correction_slips">
							<span class="lbl"><?php echo $this->lang->line('ob_suspense'); ?>View Correction Memo submitted</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>treasury/misclassification">
							<span class="lbl"><?php echo $this->lang->line('ob_suspense'); ?>Proposed by Pr. AG (A&E)</span>                      
							</a>
                        </li>
				</ul>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>treasury/ob_suspense">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('crclr_ofc_o'); ?>Treasury Missing Vouchers</span>                      
				</a>
			</li>
	<?php } ?>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>treasury/profile">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_profile'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>treasury/logout">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('logout'); ?></span>                      
				</a>
			</li>
		</ul>          
	</div> 
	
</div>