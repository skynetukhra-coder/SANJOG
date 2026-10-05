<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel', $header); ?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('home'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; Test View </div>
			<div class="panel panel-default" style="padding: 20px;">
				<h3 style="margin-top: 0; color: #275e93;">Employee Information & Diagnostics</h3>
				<p>Employee: <strong><?php echo isset($emp_data['empname']) ? html_escape($emp_data['empname']) : ''; ?></strong> (ID: <?php echo isset($emp_data['empid']) ? html_escape($emp_data['empid']) : ''; ?>)</p>
			</div>
		</div>
	</div>
</div>
