<style>
.table1 td{text-align:center font:5px}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo;<?php echo $this->lang->line('my_documen'); ?>Leave History </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('my_documen'); ?>Leave History of the Employee</strong></h4>
				<hr />
					<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-4">
										 <label class="name-label"><?php echo $this->lang->line('empid'); ?> Employee PAN :</label>
										  <input type="text" id="" name="empid" value="<?php echo $this->input->get('empid',true)?>" class="form-control"/>
										</div>
										<div class="col-sm-4">
									<label class="name-label">Select Leave :</label>
									<select id = "leave_type" name="leave_type" class="form-control" required>
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Casual Leave"<?php echo $this->input->get('leave_type') == 'Casual Leave' ? 'selected' : ''?> >Casual Leave</option>
										<option data-value="2" value="Child Care Leave"<?php echo $this->input->get('leave_type') == 'Child Care Leave' ? 'selected' : ''?> >Child Care Leave</option>
										<option data-value="3" value="Half Pay Leave"<?php echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Half Pay Leave</option>
<!--        							<option data-value="4" value="Half Pay Leave"<?php //echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Commuted Leave</option>			-->
										<option data-value="5" value="Earned Leave" <?php echo $this->input->get('leave_type') == 'Earned Leave' ? 'selected' : ''?> >Earned Leave</option>
										<option data-value="6" value="Extra-Ordinary Leave"<?php echo $this->input->get('leave_type') == 'Extra-Ordinary Leave' ? 'selected' : ''?> >Extra-Ordinary Leave</option>
										<option data-value="7" value="Maternity Leave"<?php echo $this->input->get('leave_type') == 'Maternity Leave' ? 'selected' : ''?> > Maternity Leave</option>
										<option data-value="8" value="Paternity Leave"<?php echo $this->input->get('leave_type') == 'Paternity Leave' ? 'selected' : ''?> >Paternity Leave</option>
										<option data-value="9" value="Restricted Holiday"<?php echo $this->input->get('leave_type') == 'Restricted Holiday' ? 'selected' : ''?> >Restricted Holiday</option>
										<option data-value="10" value="Study Leave"<?php echo $this->input->get('leave_type') == 'Study Leave' ? 'selected' : ''?> >Study Leave</option>
									</select>
								</div>
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
				
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center ">Sl No</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Type</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Ground</th>
								<th style="text-align:center">Leave Satus</th>
								<th style="text-align:center">Joining Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($leaves)){
									$sl = 1;
									foreach($leaves as $row){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $row['name'] ?></td>
											<td><?php echo $row['leave_type'] ?></td>
											<td style="text-align:center"><?php echo get_datepicker_date($row['leave_from']) ?></td>
											<td style="text-align:center"><?php echo get_datepicker_date($row['leave_to']) ?></td>
											<td style="text-align:center"><?php echo $row['leave_day_no'] ?></td>
											<td><?php echo $row['ground'] ?></td>
											<td style="text-align:center"><?php echo $row['leave_status'] ?></td>
											<td style="text-align:center"><?php echo $row['joining_status'] ?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td style="text-align:center" colspan="9">No Records found !</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
				<div class="pagination"><?php //echo $this->pagination->create_links();?></div>
		</div>
	</div>
</div>
