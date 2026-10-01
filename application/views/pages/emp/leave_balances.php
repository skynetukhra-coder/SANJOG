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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_leave_balance'); ?> </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('my_leave_balance'); ?> Uploaded</strong></h4>
				<hr />
				
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-6">
									<label class="name-label">Select Leave :</label>
									<select name="leave_type" class="form-control" required>
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Earned Leave" <?php echo $this->input->get('leave_type') == 'Earned Leave' ? 'selected' : ''?> >Earned Leave</option>
										<option data-value="2" value="Half Pay Leave"<?php echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Half Pay Leave</option>
										<option data-value="3" value="Chilld Care Leave"<?php echo $this->input->get('leave_type') == 'Chilld Care Leave' ? 'selected' : ''?> >Chilld Care Leave</option>
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-3">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/leave_balances'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
				
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Leave Type</th>
								<th style="text-align:center">As On</th>
								<th style="text-align:center">Credited</th> 
								<th style="text-align:center">Availed</th>
								<th style="text-align:center">Balance</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($all_balances)){
									$sl = 1;
									foreach($all_balances as $balances){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $balances['leave_type'] ?></td>
											<td><?php echo get_datepicker_date($balances['as_on']) ?></td>
											<td><?php  echo $balances['leave_cr']?></td>
											<td><?php  echo $balances['leave_dr']?></td>
											<td><?php echo $balances['leave_cb']?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="6">No records found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>