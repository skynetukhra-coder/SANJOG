<?php 
$empid = isset($emp_data['empid']) ? $emp_data['empid']: '1';
$level_pay = isset($emp_data['level_pay']) ? $emp_data['level_pay']: '1';
$desig = isset($emp_data['desig']) ? $emp_data['desig']: '1';
$section = isset($emp_data['section']) ? $emp_data['section']: '1';
$rol_st = isset($emp_data['rol_st']) ? $emp_data['rol_st']: 'N';
?>
<div class="quick-link on-site-tree">
	<div class="dark" style="text-align:center; color: white; font-size:18px; font-weight:bold; font-family:arial;letter-spacing:4px;">
		<span>SANJOG</span>
	</div>
 <h3 class="medium"><?php echo isset($name) ? $name : "Menu"; ?></h3>
	<div id="tree" class="span3">
		<ul id="menu-group-1" class="nav menu">  
			
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp/information">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('my_information'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp/administrative_order">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('kms_document'); ?></span>                      
				</a>
			</li>
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-2">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('office_document'); ?></span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-2">
                        <li>
                            <a href="<?php echo SITE_BASE_URL?>emp/notice_board">
							<span class="lbl"><?php echo $this->lang->line('circular_office_ord'); ?>Notice Board</span>              
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/circular">
							<span class="lbl"><?php echo $this->lang->line('circular_office_order'); ?></span>              
							</a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_BASE_URL?>emp/gradation">
							<span class="lbl"><?php echo $this->lang->line('gradation_list'); ?></span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/epabx">
							<span class="lbl"><?php echo $this->lang->line('epabx_extension'); ?></span>                   
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/employee_search">
							<span class="lbl"><?php echo $this->lang->line('epabx_ext'); ?>Search Employee</span>                   
							</a>
						</li>
						
						<?php if($desig == 'SR. ACCOUNTS OFFICER' ){ ?>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/hierarchy_bo">
							<span class="lbl"><?php echo $this->lang->line('my_g'); ?>Hierarchy</span>                      
							</a>
						</li>
						<?php }else{ ?>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/hierarchy">
							<span class="lbl"><?php echo $this->lang->line('my_g'); ?>Hierarchy</span>                      
							</a>
						</li>
						<?php } ?>
						
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/employee_charge_sec">
							<span class="lbl"><?php echo $this->lang->line('epabx_ext'); ?>Charge Allotment</span>                   
							</a>
						</li>
				</ul>
			</li>
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-3">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('my_document'); ?></span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-3">
                    <?php if($level_pay >= 8 ){ ?>
					   <li>
                            <a href="<?php echo SITE_BASE_URL?>emp/pending_works">
							<span class="lbl"><?php echo $this->lang->line('pending_works'); ?>Pending Works</span>                      
							</a>
                        </li>
					<?php } ?>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/message_box">
							<span class="lbl"><?php echo $this->lang->line('my_documen'); ?>Messages</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/documents">
							<span class="lbl"><?php echo $this->lang->line('my_documen'); ?>Orders</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/service_book">
							<span class="lbl"><?php echo $this->lang->line('_service_book'); ?>Documents</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/application_exam_info">
							<span class="lbl"><?php echo $this->lang->line('my_g'); ?>Status</span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/family">
							<span class="lbl"><?php echo $this->lang->line('my_g'); ?>Family Member</span>                      
							</a>
						</li>
				</ul>
			</li>
			<?php if($section == 'IT SUPPORT CELL' && $rol_st == 'Y'){ ?>	
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-4">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('my_lea'); ?>IT Support Cell</span>                      
                    </a>
                    <ul class="children nav-child unstyled small collapse" id="sub-4">					
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/emdbg_proc_bill">
                                <span class="lbl"><?php echo $this->lang->line('my_lea'); ?>Procurement Bills</span> 
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/emdbg_cons">
                                <span class="lbl"><?php echo $this->lang->line('my_lea'); ?>Consumables / Software</span> 
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/emdbg_all">
                                <span class="lbl"><?php echo $this->lang->line('my_lea'); ?>EMD and BG</span> 
                            </a>
                        </li>
                        <li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/hardware_ser">
                                <span class="lbl"><?php echo $this->lang->line('my_lea'); ?>Hardware</span> 
                            </a>
                        </li>
					</ul>
			  </li>
			<?php } ?>
			
			
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-5">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('my_leave'); ?></span>                      
                    </a>
                    <ul class="children nav-child unstyled small collapse" id="sub-5">
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_improper">
                                <span class="lbl"><?php echo $this->lang->line('my_leave_credited'); ?>Leave For Re-submission</span> 
                            </a>
                        </li>
                        <li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_credit_clrh">
                                <span class="lbl"><?php echo $this->lang->line('my_leave_credited'); ?>CL / RH</span> 
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_credit_others">
                                <span class="lbl"><?php echo $this->lang->line('my_cl_rh_availed'); ?> Other Leave</span> 
                            </a>
                        </li>
					</ul>
				</li>	
				<li class="deeper parent ">
						<a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-6">
							<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
							<span class="lbl"><?php echo $this->lang->line('my_applicati'); ?> Apply / Declare</span>                      
						</a>
						<ul class="children nav-child unstyled small collapse" id="sub-6">
														<li>
								<a href="<?php echo SITE_BASE_URL?>emp/leave_application_clrh">
								<span class="lbl"><?php echo $this->lang->line('exam_applic'); ?>CL / RH</span>                         
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/leave_application">
								<span class="lbl"><?php echo $this->lang->line('exam_applic'); ?>Other Leave</span>                      
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/application">     
								<span class="lbl"><?php echo $this->lang->line('exam_applic'); ?> Departmental Examination</span>                      
								</a>
							</li>	
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/application_exam_other">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?> Permission for Examination (Non-Deptl)</span>                      
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/foreign_visits">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?>NOC for VISA / Passport </span>                      
								</a>
							</li>
<!--							
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/bill_submit">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?> Submit Bill for Reimbursement</span>                      
								</a>
							</li>
-->							
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/property_st_self">
								<span class="lbl"><?php echo $this->lang->line('my_'); ?>Asset Declaration</span>                      
								</a>
							</li>
						</ul>
				</li>
			<?php if($empid == 'ACIPN6392E' || $empid == 'BVOPB8179D' || $empid == 'AUMPB6168Q' ){ ?>				
				<li class="deeper parent ">
						<a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-7">
							<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
							<span class="lbl"><?php echo $this->lang->line('my_applic'); ?> Document Verification</span>                      
						</a>
						<ul class="children nav-child unstyled small collapse" id="sub-7">
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/application_pending_permission_all">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?>Permission for Examination (Non-Deptl)</span>                      
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/application_pending_passport_all">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?>N.O.C. for Passport / VISA</span>                      
								</a>
							</li>
<!--							
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/bill_details_all">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?>Reimbursement Bill </span>                      
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/leave_application_chk_all">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?> Medicial Certificate </span>                      
								</a>
							</li>
-->
						</ul>
				</li>	
			<?php } ?>
			<?php if($level_pay >= 8 || $desig == 'PR. ACCOUNTANT GENERAL' || $desig == 'DY. ACCOUNTANT GENERAL' || $desig == 'SR.DY. ACCOUNTANT GENERAL' || $empid == 'SR. ACCOUNTS OFFICER' || $empid == 'ASSTT. ACCOUNTS OFFICER' || $empid == 'SUPERVISOR' ){ ?>
				<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-8">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('leave_sanction_reco_approv'); ?>Recommendation / Sanction / Cancel </span>                      
                    </a>
                    <ul class="children nav-child unstyled small collapse" id="sub-8">
                        <li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_pending_clrh">
                                <span class="lbl"><?php echo $this->lang->line('my_cl_rh_sancti'); ?>CL / RH</span>    
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_pending_recommendation_all">
                                <span class="lbl"><?php echo $this->lang->line('other_leave_for_recommendati'); ?>Other Leave</span>         
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_sanctioned_all">
                                <span class="lbl"> <?php echo $this->lang->line('view_all_sanctioned_leave'); ?> & CL / RH</span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/application_pending_recommendation">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Recommendation Process</span>      
                            </a>
                        </li>
						
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/application_pending_permission">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Approval Process (Admin Sec)</span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/transfer_release">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Transfer Process</span>      
                            </a>
                        </li>
					</ul>
				</li>
			
			<li class="deeper parent ">
					<a href="<?php echo SITE_BASE_URL?>emp/leave_report">
						<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
						<span class="lbl"><?php echo $this->lang->line(''); ?>Leave Report (CL / RH)</span>                      
					</a>
			</li>
			<?php } ?>	
				<li class="deeper parent ">
						<a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-9">
							<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
							<span class="lbl"><?php echo $this->lang->line('my_applic'); ?> Grievance/Feedback (Coordn.)</span>                      
						</a>
						<ul class="children nav-child unstyled small collapse" id="sub-9">
							<?php  if(($desig == 'ASSTT. ACCOUNTS OFFICER') && ($section == 'ADMINISTRATION-I' || $section == 'ACCOUNTS MISCELLANEOUS' || $section == 'FUND MISCELLANEOUS' || $section == 'PENSION COORDINATION' ||$section == 'IT SUPPORT CELL')){  ?>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/feedback_filter">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?>All Grievance/Feedback</span>                      
								</a>
							</li>
							<?php } ?>
							<?php if($desig == 'DY. ACCOUNTANT GENERAL' || $desig == 'SR.DY. ACCOUNTANT GENERAL' || in_array($empid, array('ABMPN8092N', 'AEJPM4439C', 'ABVPC6794M', 'AFGPP1627K', 'AUMPB6168Q')) || !empty($this->session->userdata('is_grievance_admin'))){ ?>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/grievance_all">     
								<span class="lbl">Grievance Process</span>                      
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/feedback_all">     
								<span class="lbl">Feedback Process</span>                      
								</a>
							</li>
							<?php } ?>
						</ul>
				</li>	
			
			<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-10">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('kms_docum'); ?>Utilities</span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-10">
                        <li>
                            <a href="<?php echo SITE_BASE_URL?>emp/retirement_pension">
							<span class="lbl"><?php echo $this->lang->line('administrative_o'); ?>Retirement Benifit</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/encashment_leave">
							<span class="lbl"><?php echo $this->lang->line('administrative_o'); ?>Leave Encashment</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/apar_calculator">
							<span class="lbl"><?php echo $this->lang->line('administrative_o'); ?>Apar Grade </span>                      
							</a>
                        </li>
						
				</ul>
			</li>
			<li class="deeper parent ">
				<a href="<?php echo SITE_BASE_URL?>emp/logout">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('logout'); ?></span>                      
				</a>
			</li>
		</ul>          
	</div>      
</div>