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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo;<?php echo $this->lang->line('my_documents'); ?> </div>
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
										<div class="col-sm-3">
									<label class="name-label">Select Leave :</label>
									<select name="leave_type" class="form-control" required>
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Casual Leave"<?php echo $this->input->get('leave_type') == 'Casual Leave' ? 'selected' : ''?> >Casual Leave</option>
										<option data-value="2" value="Restricted Holiday"<?php echo $this->input->get('leave_type') == 'Restricted Holiday' ? 'selected' : ''?> >Restricted Holiday</option>
									</select>
								</div>
								<div class="col-sm-2">
									<label class="name-label">Select Year :</label>
									<select name="leave_dr_year" class="form-control" required>
										<option value="">---Year---</option>
										<?php
										for($i = date('Y'); $i >= 2019; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('leave_dr_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
									</select>
								</div>
										<div class="col-sm-2"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
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
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									foreach($results as $row){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $row['name'] ?></td>
											<td><?php echo $row['leave_type'] ?></td>
											<td style="text-align:center"><?php echo get_datepicker_date($row['leave_from']) ?></td>
											<td style="text-align:center"><?php echo get_datepicker_date($row['leave_to']) ?></td>
											<td style="text-align:center"><?php echo $row['leave_day_no'] ?></td>
											<td><?php echo $row['ground'] ?></td>
											<td style="text-align:center"><?php echo $row['leave_status'] ?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="9">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
				<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		</div>
	</div>
</div>
