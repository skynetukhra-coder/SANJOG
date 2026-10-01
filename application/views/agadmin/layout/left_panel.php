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
<div class="span3" id="sidebar" style="margin: 1em 0em;">
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