<?php 
$empid = isset($emp_data['empid']) ? $emp_data['empid']: '1';
$level_pay = isset($emp_data['level_pay']) ? $emp_data['level_pay']: '1';
$desig = isset($emp_data['desig']) ? $emp_data['desig']: '1';
$section = isset($emp_data['section']) ? $emp_data['section']: '1';
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
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-1">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('kms_document'); ?></span>                      
                    </a>
                <ul class="children nav-child unstyled small collapse" id="sub-1">
                        <li>
                            <a href="<?php echo SITE_BASE_URL?>emp/administrative_order">
							<span class="lbl"><?php echo $this->lang->line('administrative_orde'); ?>Administrative Order</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/kms_document">
							<span class="lbl"><?php echo $this->lang->line('books_manual'); ?></span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/training_material">
							<span class="lbl"><?php echo $this->lang->line('training_material'); ?></span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/treasury_ir">
							<span class="lbl"><?php echo $this->lang->line('ob_suspense'); ?>Try. Inspection Report</span>                      
							</a>
                        </li>
				</ul>
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
							<span class="lbl"><?php echo $this->lang->line('my_documen'); ?>Office Order</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/service_book">
							<span class="lbl"><?php echo $this->lang->line('_service_book'); ?>Service Book</span>                      
							</a>
                        </li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/apar_booklet">
							<span class="lbl"><?php echo $this->lang->line('_apar'); ?>Aprisal Report</span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/gpf_statement">
							<span class="lbl"><?php echo $this->lang->line('_gpf_statement'); ?>GPF Statement</span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/emp_form_sixteen">
							<span class="lbl"><?php echo $this->lang->line('my_ap'); ?> Form - 16</span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/property_statement">
							<span class="lbl"><?php echo $this->lang->line('my_p'); ?>Asset Declaration</span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/bill_details">
							<span class="lbl"><?php echo $this->lang->line('my_g'); ?>Reimbursement Bill Status</span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/application_exam_info">
							<span class="lbl"><?php echo $this->lang->line('my_g'); ?>Exam Application Status</span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/application_exam_other_info">
							<span class="lbl"><?php echo $this->lang->line('my_g'); ?>Exam Permission Status</span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/application_passport_info">
							<span class="lbl"><?php echo $this->lang->line('my_g'); ?>Passport Application Status</span>                      
							</a>
						</li>
						<li>
                            <a href="<?php echo SITE_BASE_URL?>emp/family">
							<span class="lbl"><?php echo $this->lang->line('my_g'); ?>Family Member</span>                      
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
				</ul>
			</li>
			<li class="deeper parent ">
				<a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-4">
					<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
					<span class="lbl"><?php echo $this->lang->line('_training'); ?>My Order</span>                      
				</a>
				<ul class="children nav-child unstyled small collapse" id="sub-4">
					<li>
					    <a href="<?php echo SITE_BASE_URL?>emp/transfer_order">
						<span class="lbl"><?php echo $this->lang->line('exam_applicati'); ?>Transfer</span>                      
						</a>
                    </li>
					<li>
					    <a href="<?php echo SITE_BASE_URL?>emp/training_details">
						<span class="lbl"><?php echo $this->lang->line('exam_applicati'); ?>As a Trainee</span>                      
						</a>
                    </li>
                    <li>
					    <a href="<?php echo SITE_BASE_URL?>emp/faculty_details">
						<span class="lbl"><?php echo $this->lang->line('exam_applicati'); ?>As a Faculty</span>                      
						</a>
                    </li>
					<li>
                        <a href="<?php echo SITE_BASE_URL?>emp/treasury_insp_details">
						<span class="lbl"><?php echo $this->lang->line('my_ap'); ?>As a Try. Inspector</span>                      
						</a>
					</li>
				</ul>
			</li>
			
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
                                <span class="lbl"><?php echo $this->lang->line('my_leave_credited'); ?>CL / RH credited</span> 
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_clrh">
                                <span class="lbl"><?php echo $this->lang->line('my_cl_rh_availed'); ?> CL / RH availed</span> 
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_credit_others">
                                <span class="lbl"><?php echo $this->lang->line('my_leave_credited'); ?>Other Leaves credited</span> 
                            </a>
                        </li>
                        <li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_debit">
                                <span class="lbl"><?php echo $this->lang->line('my_leave_debit_other'); ?>Other Leaves availed</span> 
                            </a>
                        </li>
						
					</ul>
				</li>	
				<li class="deeper parent ">
						<a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-6">
							<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
							<span class="lbl"><?php echo $this->lang->line('my_application'); ?> & Declaration</span>                      
						</a>
						<ul class="children nav-child unstyled small collapse" id="sub-6">
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/application">     
								<span class="lbl"><?php echo $this->lang->line('exam_application'); ?> (Departmental)</span>                      
								</a>
							</li>	
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/application_exam_other">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?> Permission for Examination (Non-Deptl)</span>                      
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/application_passport">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?>Apply for NOC for VISA / Passport </span>                      
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
								<a href="<?php echo SITE_BASE_URL?>emp/leave_application_clrh">
								<span class="lbl"><?php echo $this->lang->line('my_cl_rh_application'); ?></span>                         
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/leave_application">
								<span class="lbl"><?php echo $this->lang->line('leave_application'); ?></span>                      
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/property_st_self">
								<span class="lbl"><?php echo $this->lang->line('my_'); ?>Asset Declaration for Self</span>                      
								</a>
							</li>
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/property_st_dependent">
								<span class="lbl"><?php echo $this->lang->line('my_'); ?>Asset Declaration for Dependents</span>                      
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
			<?php if($level_pay >= 8 ){ ?>
				<li class="deeper parent ">
                    <a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-8">
                        <span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
                        <span class="lbl"><?php echo $this->lang->line('leave_sanction_reco_approv'); ?>Recommendation / Sanction / Cancel </span>                      
                    </a>
                    <ul class="children nav-child unstyled small collapse" id="sub-8">
                        <li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_pending_clrh">
                                <span class="lbl"><?php echo $this->lang->line('my_cl_rh_sanction'); ?></span>    
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_pending_recommendation_all">
                                <span class="lbl"><?php echo $this->lang->line('other_leave_for_recommendati'); ?>Recommendation for Other Leave</span>         
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_pending_sanction_all">
                                <span class="lbl"><?php echo $this->lang->line('other_leave_for_sanctio'); ?>Sanction of Other Leave</span> 
                            </a>
                        </li>
                        <li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_joining_report_all">
                                <span class="lbl"><?php echo $this->lang->line('joining_report_approval'); ?></span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/leave_sanctioned_all">
                                <span class="lbl"> <?php echo $this->lang->line('view_all_sanctioned_leave'); ?></span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/cl_deduction">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adjustment'); ?></span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/application_pending_recommendation">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Recommendation for Exam (Deptl)</span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/application_pending_recomd">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Recommendation for Exam (Non-Deptl)</span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/application_pending_permission">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Permission for non-dept. Examination</span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/application_pending_pr">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Recommendation for NOC for Passport</span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/application_pending_pp">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>NOC Process for Passport</span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/bill_pending_recomd">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Bill for Recommendation</span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/bill_pending_sanction">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Bill for Reimbursement</span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/transfer_release">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Transfer for Release  </span>      
                            </a>
                        </li>
						<li>
                            <a class="" href="<?php echo SITE_BASE_URL?>emp/transfer_joining">
                                <span class="lbl"><?php echo $this->lang->line('casual_leave_adj'); ?>Transfer for Joining </span>      
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
			
		<?php if($desig == 'DY. ACCOUNTANT GENERAL' || $desig == 'SR. DY. ACCOUNTANT GENERAL' || $empid == 'ABMPN8092N' || $empid == 'AEJPM4439C' || $empid == 'ABVPC6794M' || $empid == 'AFGPP1627K' || $empid == 'AUMPB6168Q' ){ ?>				
				<li class="deeper parent ">
						<a class="tree-parent" data-toggle="collapse" data-parent="#menu-group-1" href="#sub-11">
							<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
							<span class="lbl"><?php echo $this->lang->line('my_applic'); ?> Feedback Monitoring</span>                      
						</a>
						<ul class="children nav-child unstyled small collapse" id="sub-11">
							<li>
								<a href="<?php echo SITE_BASE_URL?>emp/feedback_all">     
								<span class="lbl"><?php echo $this->lang->line('exam_app'); ?>Feedback Monitoring</span>                      
								</a>
							</li>
						</ul>
				</li>	
			<?php } ?>
			<li class="deeper parent ">
					<a href="<?php echo SITE_BASE_URL?>emp/feedback_status">
						<span class="sign"><i class="fa fa-lg fa-caret-right"></i></span>
						<span class="lbl"><?php echo $this->lang->line('my_feedback_status'); ?></span>                      
					</a>
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