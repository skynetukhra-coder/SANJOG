<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$admin_details = array();
$admin_type = '';
$uri_seg_1 = $this->uri->segment(2);
$uri_seg_2 = $this->uri->segment(3);
$uri_seg_3 = $this->uri->segment(4);

if($this->session->userdata('admin_details')){
	$admin_details = $this->session->userdata('admin_details');
	$admin_type = strtolower($admin_details['admin_type_name']);
}else{
	redirect(ADMIN_BASE_URL);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="referrer" content="origin">
<title>AG Bengal</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo SITE_BASE_URL ?>assets/images/favicon.png" type="image/png" sizes="16x16">
<link href="<?php echo SITE_BASE_URL ?>assets/admin/vendors/jquery-ui.min.css" rel="stylesheet" />
<link href="<?php echo SITE_BASE_URL ?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo SITE_BASE_URL ?>assets/admin/css/styles.css" rel="stylesheet" media="screen">
<link href="<?php echo SITE_BASE_URL ?>assets/admin/css/responsive.css" rel="stylesheet" media="screen">
<!--<link href="<?php echo SITE_BASE_URL ?>assets/admin/css/menu.css" rel="stylesheet">-->
</head>
<body>
<script src="<?php echo SITE_BASE_URL ?>assets/admin/vendors/jquery-1.9.1.js"></script>

<script src="<?php echo SITE_BASE_URL ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script src="<?php echo SITE_BASE_URL ?>assets/admin/vendors/jquery-ui-1.10.3.js"></script>
<script src="<?php echo SITE_BASE_URL ?>assets/admin/assets/scripts.js"></script>
<!--<script src="<?php echo SITE_BASE_URL ?>assets/admin/assets/menu.js"></script>-->
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
<div class="header">
	<div class="logo">
		<a href="javascript:void(0)"><img src="<?php echo SITE_BASE_URL ?>assets/images/logo.png"></a>
	</div>
	<div class="header-middle-content">
		<div class="admin-type"><strong><?php echo isset($admin_details['admin_type_name']) ? ucfirst($admin_details['admin_type_name']) . (strtolower($admin_details['admin_type_name']) != 'superadmin' ? ' Admin' : ''): '' ?></strong></div>
	</div>
	<div class="flag">
		<img src="<?php echo SITE_BASE_URL ?>assets/images/flag.gif" style="max-height:65px;">
	</div>
</div>
<div class="navbar">
  <div class="navbar-inner">
    <div class="container-fluid"> 
      <div class="navbar-wrap">
      <ul class="nav pull-right">
          <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo isset($admin_details['name']) ? $admin_details['name'] : '' ?> <i class="caret"></i> </a>
            <ul class="dropdown-menu">
              <li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL.'profile'?>">Profile</a> </li>
			  <li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL.'profile/change_password'?>">Change Password</a> </li>
              <li class="divider"></li>
              <li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL.'logout'?>">Logout</a> </li>
            </ul>
          </li>
        </ul>
        
    <a class="navbar-toggle" role="button" data-toggle="collapse" data-target=".nav-collapse" aria-expanded"false"> 
    <span class="icon-bar"><img src="<?php echo SITE_BASE_URL ?>assets/admin/images/toggle-menu.png"></span>
    </a>
      <div class="nav-collapse collapse">
        
        <ul class="nav navbar-nav">
          <li class="<?php echo $uri_seg_1 == 'dashboard' ? 'active' : '' ?>"> <a href="<?php echo ADMIN_BASE_URL?>dashboard">Dashboard</a> </li>
		  <?php 
		  if($admin_type == "superadmin"){?>
			  <li class="dropdown <?php echo $uri_seg_1 == 'members' ? ' active' : '' ?>"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Members <i class="caret"></i> </a>
				<ul class="dropdown-menu">
				  <li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>members">List Members</a> </li>
				  <li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>members/add">Add Member</a> </li>
				</ul>
			  </li>
			  
		  <?php
		  }?>
		  <li class="dropdown <?php echo $uri_seg_1 == 'menu' ? ' active' : '' ?>"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Menus <i class="caret"></i> </a>
			<ul class="dropdown-menu">
				<?php 
			// 		if($admin_type == "superadmin" || $admin_type == "administration" || $admin_type == "accounts" || $admin_type == "fund" || $admin_type == "pension" || $admin_type == "pao" || $admin_type == "admin_ii"|| $admin_type == "admin_iii" || $admin_type == "training" ||$admin_type == "record" || $admin_type == "wm"|| $admin_type == "grievance"){ 
 					if($admin_type == "superadmin" ){?>
			  		<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>menu/ag-ae"><?php echo $this->lang->line('agae'); ?></a> </li>
			  <?php
			 	 }
				 //if($admin_type == "superadmin" || $admin_type == "g&ssa"){
					 if($admin_type == "superadmin" ){
			  ?>
<!--			  <li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>menu/ag-gssa"><?php echo $this->lang->line('pr_ag_ssa'); ?></a> </li>	-->
			  <?php
			 	 }
				 //if($admin_type == "superadmin" || $admin_type == "e&rsa"){
					 if($admin_type == "superadmin" ){
			  ?>
<!--			  <li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>menu/ag-ersa"><?php echo $this->lang->line('age_rsa'); ?></a> </li>	-->
			  <?php
			 	 }
				 if($admin_type == "superadmin"){
			  ?>
				  <li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>menu/tender-notice">Tender Notice</a> </li>
				  <li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>menu/contact-us">Contact Us</a> </li>
			  <?php
			 	 }
			  ?>
			</ul>
		  </li>
		  <?php 
		  
		  	if($admin_type == "superadmin" || $admin_type == "administration" || $admin_type == "accounts" || $admin_type == "fund" || $admin_type == "pension" || $admin_type == "pao" || $admin_type == "admin_ii" || $admin_type == "admin_iii" || $admin_type == "training" ||$admin_type == "record" || $admin_type == "wm" || $admin_type == "grievance"){
		   ?>
		  <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('agae'); ?> <i class="caret"></i> </a>
		  	<ul class="dropdown-menu">
			<?php
			  if($admin_type == "administration" || $admin_type == "superadmin"){?>
				 <li class="dropdown-submenu"> <a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Administration</a>
					<ul class="dropdown-menu">
<!--						
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Public View</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/tender_notice">Tender Notice</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/circular_office_order">Upload Circular or Office Order</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/exam_result">Upload Examination Result</a></li>
							</ul>
						</li>
-->						
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Employee</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/employee">Employee records</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/sections">Section List</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/apar_booklet">Upload Employee's APAR</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/service_book">Service Book of Employee</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/property_st_list">Asset Declarations</a></li>						
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/application_passport_list">Passport Applications </a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Order / Circular</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/document_order">Orders /Documents to All Employee</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/office_order">Office Orders to Employee Concerned</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/order_employee">View Office Orders issued to Employees</a></li>
							</ul>
						</li>					
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Transfer</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/charge_master">Charge Details</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/section_transfer">Generate Transfer Order</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/section_transfer_record">List of Employees Transferred</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/section_allotment">View Section Allotment Records</a></li>						
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Training</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/training_program">Training Assignment</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/training">Participant Records</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/faculty">Faculty Records </a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Notice</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/notice">Notice </a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/notice_flash">Notice Flash</a></li>
							</ul>
						</li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/feedback">Feedback Review</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/epabx_list">Update EPABX Nos</a></li>
					</ul>
				 </li>
			  <?php
			  }
			  
			  if($admin_type == "superadmin" || $admin_type == "admin_ii"){?>
				<li class="dropdown-submenu"> <a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Administration-II</a> 
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_ii/form_sixteen">Upload Form - 16</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_ii/document_order">All Circular / Order to All Employee</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_ii/office_order">Office Orders to Employee Concerned</a></li>						
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_ii/bills">Bills Records</a></li>
<!--
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_ii/loan">Loan Records</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_ii/encashment">Leave Encashment</a></li>
-->
						<?php /*? */?>
					</ul>
				</li>
			  <?php
			  }
			  
			  if($admin_type == "superadmin" || $admin_type == "admin_iii"){?>
				<li class="dropdown-submenu"> <a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Administration-III</a> 
					<ul class="dropdown-menu">
<!--						
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Public View</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/circular_office_order">Upload Circular / Office Order </a></li>
							</ul>
						</li>
-->
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Employee</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/employee">Employee</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/family_member">Family Members</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Order / Circular</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/service_book">Upload Service Book of Employee</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/document_order">Orders /Documents to All Employee</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/office_order">Office Orders to Employee Concerned</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Leave</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_balance">Leave Balance Uploaded (First Time)</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_credit">Credite Leave (Periodically)</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_current_balance_clrh">CL / RH Leave Balance</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_current_balance">Other Leave Balance</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_debit">Leave availed / submitted</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_encashment">Leave Encashment</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_debit_cancel">Leave Cancelled</a></li>
							</ul>
						</li>
					</ul>
				</li>
			  <?php
			  }
			  
			   if( $admin_type == "superadmin" || $admin_type == "training" ){?>
				<li class="dropdown-submenu"> <a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Training</a> 
					<ul class="dropdown-menu">
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Training Records</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>training/training_program">Training Assignment</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>training/training">Participant Records</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>training/faculty">Faculty Records </a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>training/document_order">Annexure for All Circular</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>training/office_order">Annexure to Trainees & Faculties Concerned</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Exam Application</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>training/application_exam_list">Examination Applications (Departmental)</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>training/application_exam_other_list">Examination Applications (Non-Departmental)</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>training/application_invite">Invite Examination Application</a></li>		
							</ul>
						</li>
					</ul>
				</li>
			  <?php
			  }

			  if($admin_type == "superadmin" || $admin_type == "record"){?>
				<li class="dropdown-submenu"> <a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Record</a> 
					<ul class="dropdown-menu">
<!--
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Public View</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>record/circular_office_order">Upload Circular / Office Order </a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>record/tender_notice">Tender Notice</a></li>
							</ul>
						</li>
-->						
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Order / Circular</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>record/document_order">Orders /Documents to All Employee</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>record/office_order">Office Orders to Employee Concerned</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>record/order_employee">View Orders issued to Employees</a></li>
							</ul>
						</li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>record/epabx_list">Update EPABX Nos</a></li>
						<?php /*? */?>
					</ul>
				</li>
			  <?php
			  }if($admin_type == "superadmin" || $admin_type == "pao"){?>
				<li class="dropdown-submenu"> <a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">PAO Section</a> 
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pao/gpf_statement">Upload GPF Statement of Employee</a></li>
						<?php /*? */?>
					</ul>
				</li>
			  <?php
			  }
			  
			  if($admin_type == "superadmin" || $admin_type == "accounts"){?>
				<li class="dropdown-submenu"> <a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Accounts</a> 
					<ul class="dropdown-menu">
<!--
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Public View</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/circular_office_order">Upload Circular or Office Order</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/exam_result">Upload Examination Result</a></li>
							</ul>
						</li>
-->
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">DDOs </a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/ddo">DDO Office</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Treasury</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury">Treasury List</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury_reports">Treasury Reports</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury_currection_slip">Correction Memo</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury_misclassification">Accounts Correction</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury_obsuspense">Missing Vouchers</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury_outsttanding_paras">Outstanding Paras</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury_orders">Order to All Treasury</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury_document">Order to Treasury Concerned / Audit MATRIX</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury_inspection">Treasury Inspection Assignment</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/treasury_inspector_record">Treasury Inspectors' Records</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Department</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/department">Departments List</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/department_files">Files to Departments</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/department_acdc">AC DC Bills</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/department_gia">Department GAI (UC)</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/department_investment">Department investment</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/department_loan_advance">Department Loan & Advance</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Order / Circular</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/document_order">Orders /Documents to All Employee</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/office_order">Office Orders to Employee Concerned</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/order_employee">View Orders issued to Employees</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Transfer</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/section_transfer">Generate Transfer Order</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/section_transfer_record">List of Employees Transferred</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/section_allotment">View Section Allotment Records</a></li>						
							</ul>
						</li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/da_cadare">DA Cadre</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/training">Training Records</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/feedback">Feedback Review</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/epabx_list">Update EPABX Nos</a></li>
						<?php /*?><li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/monthly_file">Monthly Files</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/quarterly_file">Quarterly Files</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/yearly_file">Yearly Files</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>accounts/upload_files">Upload Files</a></li><?php */?>
					</ul>
				</li>
				<?php
			  }
			  if($admin_type == "superadmin" || $admin_type == "wm"){?>
				<li class="dropdown-submenu"> <a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">WM Section</a> 
					<ul class="dropdown-menu">
<!--
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Public View</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>wm/circular_office_order">Upload Circular or Office Order</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>wm/exam_result">Upload Examination Result</a></li>
							</ul>
						</li>
-->
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>wm/da_cadare">DA Cadre Employee</a></li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Transfer</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>wm/document_order">Imp. Orders/Documents to All Employee</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>wm/office_order">Imp. Office Orders to Employee Concerned</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>wm/order_employee">View Imp. Orders issued to Employees</a></li>						
							</ul>
						</li>
					</ul>
				</li>
			  
				
			  <?php
			  }
			  if($admin_type == "superadmin" || $admin_type == "fund"){?>
				 <li class="dropdown-submenu"> <a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Fund</a>
					<ul class="dropdown-menu">
<!--
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Public View</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/circular_office_order">Upload Circular or Office Order</a></li>
							</ul>
						</li>
-->
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/subscriber">Subscribers</a></li>
						<!--
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/fund">Annual Accounts Statements</a></li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">GPF Statement(.xls)</a>
							<ul class="dropdown-menu">
								
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/part_1">Upload Part I</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/part_2">Upload Part II</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/part_3">Upload Part III</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/part_4">Upload Part IV</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/part_5">Upload Part V</a></li>
							</ul>
						</li>
						-->
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">GPF Statement(.csv)</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/part_1_temp">Upload Part-I Data</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/part_2_temp">Upload Part-II Data</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/part_3_temp">Upload Part-III Data</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/part_4_temp">Upload Part-IV Data</a></li>
<!--							<li><a tabindex="-1" href="<?php //echo ADMIN_BASE_URL?>gpf/part_5_temp">Upload Part V Data</a></li>		-->
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/tax_nontax">Taxable Non-Taxable Data</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/signature_master">Signature Master</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">GPF Data</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/mjh_head">Major Head Master</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/rate_of_interest">Rates of Interest</a></li>	
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/case_status">FP Case Status</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/fp_authority">Final Payment Authority</a></li>
								<!--<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/fund">Final Payment Claim</a></li>-->
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/ledger">Credits / Debits Ledger</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/missingcr">Missing Credits (Online Adjustment)</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/missingcract">Missing Credits Action</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/missingcract_all">Missing Credits All</a></li>
							</ul>
						</li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/gpf_preview">Preview Ac Slip or FPA</a></li>
<!--					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/ddo_document">DDO Documents</a></li>		-->	
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Transfer</a>
							<ul class="dropdown-menu">
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/section_transfer">Generate Transfer Order</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/section_transfer_record">List of Employees Transferred</a></li>
								<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/section_allotment">View Section Allotment Records</a></li>						
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Order / Circular</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/document_order">Orders /Documents to All Employee</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/office_order">Office Orders to Employee Concerned</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/order_employee">View Orders issued to Employees</a></li>					
						</ul>
					</li>
						
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/training">Training Records</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/feedback">Feedback Review</a></li>
						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>gpf/epabx_list">Update EPABX Nos</a></li>
					</ul>
				  </li>
			  <?php
			  }
			  
			  if($admin_type == "superadmin" || $admin_type == "pension"){?>
		  	 <li class="dropdown-submenu"><a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Pension</a>
			 	<ul class="dropdown-menu">
<!--
					<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Public View</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/circular_office_order">Upload Circular or Office Order</a></li>
						</ul>
					</li>
-->
					<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Pension Data</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/pension">Pension</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/ppo">PPO</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/pensioner_spouse">Spouse</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/case_status">Case Status</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/case_dispatched">Case Dispatched</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/case_return">Case Return</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/upload_ppogpocpo">Upload PPO/GPO/CPO</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/upppogpocpo">Hirani-Upload PPO/GPO/CPO</a></li>				
						</ul>
					</li>
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/pension_payment">Pension Payment</a></li>	
					<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Transfer</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/section_transfer">Generate Transfer Order</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/section_transfer_record">List of Employees Transferred</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/section_allotment">View Section Allotment Records</a></li>						
						</ul>
					</li>
					<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Order / Circular</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/document_order">Orders /Documents to All Employee</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/office_order">Office Orders to Employee Concerned</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/order_employee">View Orders issued to Employees</a></li>						
						</ul>
					</li>
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/training">Training Records</a></li>
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/feedback">Feedback Review</a></li>
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pension/epabx_list">Update EPABX Nos</a></li>
				</ul>
			 </li>
		  <?php
		  }
		   if($admin_type == "superadmin" || $admin_type == "grievance"){?>
		  	 <li class="dropdown-submenu"><a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Grievance Monitoring</a>
			 	<ul class="dropdown-menu">
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>grievance/feedback_gen">General</a></li>
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>grievance/feedback_admn">Administration</a></li>
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>grievance/feedback_acs">Accounts</a></li>
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>grievance/feedback_fnd">Fund</a></li>
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>grievance/feedback_pen">Pension</a></li>
				</ul>
			 </li>
			 <li class="dropdown-submenu"><a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Grievance Records</a>
			 	<ul class="dropdown-menu">
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>grievance/feedback_griev">Grievance Records list</a></li>
				</ul>
			</li>
		  <?php
		  }
		  if($admin_type == "superadmin"){?>
		  	 <li class="dropdown-submenu"><a tabindex="-1" href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Web Admin Control</a>
			 	<ul class="dropdown-menu">
					<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Order Circular</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/order_employee">View Office Orders issued to Employees</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/training_employee">View Training Orders issued to Employees</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/all_office_order">View All Internal Office Order</a></li>
						</ul>
					</li>
					<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Employee</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/employee_login">Employee Login</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_credit_admin"> Leave Credit Status Update</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_debit_admin"> Leave Debit Status Update</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_current_balance_clrh_admin"> Leave CL/RH Balance Update</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>admin_iii/leave_current_balance_other_admin"> Leave Other Balance Update</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/application_invite"> Invite Examination Applications</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/property_st_admn">Asset Declarations</a></li>	
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/signature_master">Signature Master</a></li>
						</ul>
					</li>
					<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Section / Branch</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/section_br">Branch List</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/section">Section / Unit List</a></li>
						</ul>
					</li>
					<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Transfer Records</a>
						<ul class="dropdown-menu">
<!--						<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/section_bo_incharge">Initial Section Assignment</a></li>	-->
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/section_charge"> View Charge Allotment Records</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/section_allotment">View Section Allotment Records</a></li>
						</ul>
					</li>
					<li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown">Public View</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/tender_notice">Tender Notice</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/circular_office_order">Upload Circular or Office Order</a></li>
							<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>administration/exam_result">Upload Examination Result</a></li>
						</ul>
					</li>
					<li><a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>grievance/feedback">GO Feedback Review</a></li>
				</ul>
			 </li>
			 
		  <?php
		  }
		  ?>
		  	</ul>
		  </li>
		  <?php
		    }
//			if($admin_type == "superadmin" || $admin_type == "g&ssa"){
			if($admin_type == "superadmin" ){
		  ?>
<!--		  
		  <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('pr_ag_ssa'); ?><i class="caret"></i></a>
		  	<ul class="dropdown-menu">
				<li><a tabindex="-1" href="<?php //echo ADMIN_BASE_URL?>praggssa/circular_office_order">Circular Office Order</a></li>
				<li><a tabindex="-1" href="<?php //echo ADMIN_BASE_URL?>praggssa/tender_notice">Tender Notice</a></li>
				<li><a tabindex="-1" href="<?php //echo ADMIN_BASE_URL?>praggssa/employee">Employee</a></li>
				<li><a tabindex="-1" href="<?php //echo ADMIN_BASE_URL?>praggssa/office_order">Office Orders to Employee</a></li>
			</ul>
		  </li>
-->
		  <?php
			 }
//			if($admin_type == "superadmin" || $admin_type == "e&rsa"){
			if($admin_type == "superadmin" ){
		  ?>
<!--
		  <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('age_rsa'); ?> <i class="caret"></i> </a>
		  		<ul class="dropdown-menu">					
					<li><a tabindex="-1" href="<?php //echo ADMIN_BASE_URL?>agersa/circular_office_order">Circular Office Order</a></li>
					<li><a tabindex="-1" href="<?php //echo ADMIN_BASE_URL?>agersa/tender_notice">Tender Notice</a></li>
					<li><a tabindex="-1" href="<?php //echo ADMIN_BASE_URL?>agersa/employee">Employee</a></li>
					<li><a tabindex="-1" href="<?php //echo ADMIN_BASE_URL?>agersa/office_order">Office Orders to Employee</a></li>
				</ul>
		  </li>
-->		  
		  <?php
		  }?>
		  <li class="dropdown <?php echo $uri_seg_1 == 'contents' ? ' active' : '' ?>"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Contents <i class="caret"></i> </a>
            <ul class="dropdown-menu">
			   <?php 
				if($admin_type == "superadmin" || $admin_type == "administration" || $admin_type == "accounts" || $admin_type == "fund" || $admin_type == "pension"){
			   ?>
			  <li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('agae'); ?></a>
			  	 <ul class="dropdown-menu">
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>contents/agae">Show Content</a> </li>
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pages/add_agae">Add Page</a> </li>
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>links/add_agae">Add Link</a> </li>
				 </ul>
			  </li>
			  <?php
			 	 }
//				if($admin_type == "superadmin" || $admin_type == "g&ssa"){
				if($admin_type == "superadmin" ){
			  ?>
<!--
			  <li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('pr_ag_ssa'); ?></a>
			  	 <ul class="dropdown-menu">
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>contents/aggssa">Show Content</a> </li>
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pages/add_aggssa">Add Page</a> </li>
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>links/add_aggssa">Add Link</a> </li>
				 </ul>
			  </li>
-->
			  <?php
			  	}
//				if($admin_type == "superadmin" || $admin_type == "e&rsa"){
				if($admin_type == "superadmin" ){
			  ?>
<!--			  
			  <li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('age_rsa'); ?></a>
				 <ul class="dropdown-menu">
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>contents/agersa">Show Content</a> </li>
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>pages/add_agersa">Add Page</a> </li>
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>links/add_agersa">Add Link</a> </li>
				 </ul>
			  </li>
-->
			  <?php
				}
				if($this->session->userdata('admin_type') == 'superadmin'){?>
			  		<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>blocks/add">Add Block</a> </li>
					<li> <a tabindex="-1" href="<?php echo ADMIN_BASE_URL?>footer_pages">Footer Pages</a> </li>
			  <?php
			    }
			  ?>
            </ul>
          </li>
		  <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Others <i class="caret"></i> </a>
           <ul class="dropdown-menu">
		   	<?php 
			  if($admin_type == "superadmin" || $admin_type == "administration" || $admin_type == "accounts" || $admin_type == "fund" || $admin_type == "pension"){
			?>
			  <li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('agae'); ?></a>
			  	 <ul class="dropdown-menu">
					<li> <a href="<?php echo ADMIN_BASE_URL?>faq">FAQ</a>
					<li> <a href="<?php //echo ADMIN_BASE_URL?>whats_new">Whats New</a>
					<li> <a href="<?php echo ADMIN_BASE_URL?>feedback_active">Active Feedback</a>
					<li> <a href="<?php echo ADMIN_BASE_URL?>feedback">All Feedback</a>
					<li> <a href="<?php echo ADMIN_BASE_URL?>gallery">Image Gallery</a>
					<li> <a href="<?php echo ADMIN_BASE_URL?>video">Video Gallery</a>
				 </ul>
			  </li>
			<?php
			}
//			  if($admin_type == "superadmin" || $admin_type == "g&ssa"){
			  if($admin_type == "superadmin" ){
			?>
<!--			  
			  <li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('pr_ag_ssa'); ?></a>
			  	 <ul class="dropdown-menu">
					<li> <a href="<?php //echo ADMIN_BASE_URL?>faq/aggssa">FAQ</a>
					<li> <a href="<?php //echo ADMIN_BASE_URL?>whats_new/aggssa">Whats New</a>
					<li> <a href="<?php //echo ADMIN_BASE_URL?>feedback/aggssa">Feedback</a>
					<li> <a href="<?php //echo ADMIN_BASE_URL?>gallery/aggssa">Image Gallery</a>
					<li> <a href="<?php //echo ADMIN_BASE_URL?>video/aggssa">Video Gallery</a>
				 </ul>
			  </li>
<!--
			  <?php
			  }
//			  if($admin_type == "superadmin" || $admin_type == "e&rsa"){
			  if($admin_type == "superadmin" ){
			  ?>
<!--
			  <li class="dropdown-submenu"><a tabindex="-1"  href="javascript:void(0)" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('age_rsa'); ?></a>
				 <ul class="dropdown-menu">
					<li> <a href="<?php //echo ADMIN_BASE_URL?>faq/agersa">FAQ</a>
					<li> <a href="<?php //echo ADMIN_BASE_URL?>whats_new/agersa">Whats New</a>
					<li> <a href="<?php //echo ADMIN_BASE_URL?>feedback/agersa">Feedback</a>
					<li> <a href="<?php //echo ADMIN_BASE_URL?>gallery/agersa">Image Gallery</a>
					<li> <a href="<?php //echo ADMIN_BASE_URL?>video/agersa">Video Gallery</a>
				 </ul>
			  </li>
-->
			  <?php
			  }
			  ?>
            </ul>
          </li>
		  
		  <?php 
		  if($admin_type == "superadmin"){?>
		  <!--<li> <a href="<?php echo ADMIN_BASE_URL?>links">Quick Links</a> </li>-->
		  <!--<li> <a href="<?php echo ADMIN_BASE_URL?>gallery">Gallery</a> </li>
		  <li> <a href="<?php echo ADMIN_BASE_URL?>gallery">Contact Us</a> </li>
		  <li> <a href="<?php echo ADMIN_BASE_URL?>grievance">Grievances</a> </li>-->
		   <?php
		  }?>
		  <!--<li> <a href="<?php echo ADMIN_BASE_URL?>faqs">FAQs</a> </li>-->
        </ul>
      </div>
      <!--/.nav-collapse -->
      </div>
    </div>
  </div>
</div>
<div class="main-container">
	<div class="row-fluid">
			<?php
			if($this->session->flashdata('success')){?>
				<div class="alert alert-success">
					<button class="close" data-dismiss="alert">x</button>
					<strong>Success! </strong> <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php
			}else if(@validation_errors()){?>
				<div class="alert alert-error">
					<button class="close" data-dismiss="alert">x</button>
					<strong>Error! </strong> <?php echo @validation_errors(); ?>
				</div>

			<?php
			}else if($this->session->flashdata('error')){?>
				<div class="alert alert-error">
					<button class="close" data-dismiss="alert">x</button>
					<strong>Error! </strong> <?php echo $this->session->flashdata('error'); ?>
				</div>

			<?php
			}?>
			<?php
			if(isset($breadcrumb) && !empty($breadcrumb)){?>
			<div class="navbar">
				<div class="navbar-inner">
					<ul class="breadcrumb">
						<i class="icon-chevron-left hide-sidebar"><a href="#" title="Hide Sidebar" rel="tooltip">&nbsp;</a></i>
						<i class="icon-chevron-right show-sidebar" style="display:none;"><a href="#" title="Show Sidebar" rel="tooltip">&nbsp;</a></i>
						<li>
							<a href="#">Dashboard</a> <span class="divider">/</span>	
						</li>
						<li>
							<a href="#">Settings</a> <span class="divider">/</span>	
						</li>
						<li class="active">Tools</li>
					</ul>
				</div>
		</div>
		<?php
		}?>
	</div>
    
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "navbar-fixed-top") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

