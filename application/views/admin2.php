<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>AGB</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo SITE_BASE_URL ?>assets/images/favicon.png" type="image/png" sizes="16x16">
<link href="<?php echo SITE_BASE_URL ?>assets/theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo SITE_BASE_URL ?>assets/admin/css/styles.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="header">
	<div class="logo">
		<a href="javascript:void(0)"><img src="<?php echo SITE_BASE_URL ?>assets/images/logo.png"></a>
	</div>
	<div class="header-middle-content">
		<div class="admin-type"><strong>Administrator</strong></div>
	</div>
	<div class="flag">
		<img src="<?php echo SITE_BASE_URL ?>assets/images/flag.png">
	</div>
</div>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> Supratim Mukherjee <i class="caret"></i> </a>
            <ul class="dropdown-menu">
              <li> <a tabindex="-1" href="#">Profile</a> </li>
              <li class="divider"></li>
              <li> <a tabindex="-1" href="login.html">Logout</a> </li>
            </ul>
          </li>
        </ul>
        <ul class="nav">
          <li class="active"> <a href="#">Dashboard</a> </li>
          <li class="dropdown"> <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Main Menu <i class="caret"></i> </a>
            <ul class="dropdown-menu">
              <li> <a tabindex="-1" href="#">Sub Menu 1</a> </li>
              <li> <a tabindex="-1" href="#">Sub Menu 2</a> </li>
              <li> <a tabindex="-1" href="#">Sub Menu 3</a> </li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>
<div class="main-container">
	<div class="row-fluid">
		<div class="span3" id="sidebar">
			<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li>
                            <a href="index.html"><i class="icon-chevron-right"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="icon-chevron-right"></i> Calendar</a>
                        </li>
                        <li>
                            <a href="stats.html"><i class="icon-chevron-right"></i> Statistics (Charts)</a>
                        </li>
                        <li>
                            <a href="form.html"><i class="icon-chevron-right"></i> Forms</a>
                        </li>
                        <li>
                            <a href="tables.html"><i class="icon-chevron-right"></i> Tables</a>
                        </li>
                        <li>
                            <a href="buttons.html"><i class="icon-chevron-right"></i> Buttons &amp; Icons</a>
                        </li>
                        <li>
                            <a href="editors.html"><i class="icon-chevron-right"></i> WYSIWYG Editors</a>
                        </li>
                        <li class="active">
                            <a href="interface.html"><i class="icon-chevron-right"></i> UI &amp; Interface</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-success pull-right">731</span> Orders</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-success pull-right">812</span> Invoices</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-info pull-right">27</span> Clients</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-info pull-right">1,234</span> Users</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-info pull-right">2,221</span> Messages</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-info pull-right">11</span> Reports</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-important pull-right">83</span> Errors</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-warning pull-right">4,231</span> Logs</a>
                        </li>
                    </ul>
		</div>
		<div class="span9" id="content">
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>Success!</strong> This is a success message.
			</div>
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
			<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left">Bordered Table</div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
					<table class="table table-bordered">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>First Name</th>
						  <th>Last Name</th>
						  <th>Username</th>
						  <th>Action</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <td>1</td>
						  <td>Mark</td>
						  <td>Otto</td>
						  <td>@mdo</td>
						  <td><button class="btn tooltip-top" data-original-title="Tooltip in top">Top</button></td>
						</tr>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
			<div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Form Validation</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
					<!-- BEGIN FORM-->
					<form action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">
						<fieldset>
							<div class="alert alert-error hide">
								<button class="close" data-dismiss="alert"></button>
								You have some form errors. Please check below.
							</div>
							<div class="alert alert-success hide">
								<button class="close" data-dismiss="alert"></button>
								Your form validation is successful!
							</div>
  							<div class="control-group">
  								<label class="control-label">Name<span class="required">*</span></label>
  								<div class="controls">
  									<input type="text" name="name" data-required="1" class="span6 m-wrap">
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Email<span class="required">*</span></label>
  								<div class="controls">
  									<input name="email" type="text" class="span6 m-wrap">
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">URL<span class="required">*</span></label>
  								<div class="controls">
  									<input name="url" type="text" class="span6 m-wrap">
  									<span class="help-block">e.g: http://www.demo.com or http://demo.com</span>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Number<span class="required">*</span></label>
  								<div class="controls">
  									<input name="number" type="text" class="span6 m-wrap">
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Digits<span class="required">*</span></label>
  								<div class="controls">
  									<input name="digits" type="text" class="span6 m-wrap">
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Credit Card<span class="required">*</span></label>
  								<div class="controls">
  									<input name="creditcard" type="text" class="span6 m-wrap">
  									<span class="help-block">e.g: 5500 0000 0000 0004</span>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Occupation&nbsp;&nbsp;</label>
  								<div class="controls">
  									<input name="occupation" type="text" class="span6 m-wrap">
  									<span class="help-block">optional field</span>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Category<span class="required">*</span></label>
  								<div class="controls">
  									<select class="span6 m-wrap" name="category">
  										<option value="">Select...</option>
  										<option value="Category 1">Category 1</option>
  										<option value="Category 2">Category 2</option>
  										<option value="Category 3">Category 5</option>
  										<option value="Category 4">Category 4</option>
  									</select>
  								</div>
  							</div>
  							<div class="form-actions">
  								<button type="submit" class="btn btn-primary">Validate</button>
  								<button type="button" class="btn">Cancel</button>
  							</div>
						</fieldset>
					</form>
					<!-- END FORM-->
				</div>
			    </div>
			</div>
                     	<!-- /block -->
		    </div>
		</div>
	</div>
</div>
<script src="<?php echo SITE_BASE_URL ?>assets/theme/vendors/jquery-1.9.1.js"></script>
<script src="<?php echo SITE_BASE_URL ?>assets/theme/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo SITE_BASE_URL ?>assets/theme/assets/scripts.js"></script>
</body>
</html>
