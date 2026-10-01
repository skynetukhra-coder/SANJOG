<style>
.table1 td{text-align:center}
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_gpf_statement'); ?> </div>
			<div class="login-box">
				<h4><strong>Leave Details</strong></h4>
				<hr />
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Leave Type</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									foreach($office_orders as $leaves){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $leaves['leave_type'] ?></td>
											<td><?php echo date('d-m-Y',strtotime($leaves['leave_from'])) ?></td>
											<td><?php echo date('d-m-Y',strtotime($leaves['leave_to'])) ?></td>
											<<td><?php echo $leaves['leave_day_no'] ?></td>
											<td><?php echo $leaves['application_dt']?></td>
											<td><?php echo $leaves['leave_status']?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="5">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>