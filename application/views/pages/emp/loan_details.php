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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_loans'); ?> </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('my_loans'); ?></strong></h4>
				<hr />
				

				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-6">
									<label class="name-label">Select Loan :</label>
									<select name="records" class="form-control" required>
										<option value=""> -- Select loan--</option>
										<option data-value="1" value="GPF Advance" <?php echo $this->input->get('records') == 'GPF Advance' ? 'selected' : ''?> >GPF Advance</option>
										<option data-value="2" value="GPF Withdrawal" <?php echo $this->input->get('records') == 'GPF Withdrawal' ? 'selected' : ''?> >GPF Withdrawal</option>
										<option data-value="3" value="Computer Advance"<?php echo $this->input->get('records') == 'Computer Advance' ? 'selected' : ''?> >Computer Advance</option>
										<option data-value="4" value="House Building Advance"<?php echo $this->input->get('records') == 'House Building Advance' ? 'selected' : ''?> >House Building Advance</option>
										
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-3">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/loan_details'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
				
				
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Purpose</th>
								<th style="text-align:center">Loan Amount</th>
								<th style="text-align:center">Order No</th>     
								<th style="text-align:center">Date</th>
								<th style="text-align:center">Paid Amount</th>
								<th style="text-align:center">Bill No</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									foreach($office_orders as $loan){
									?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $loan['description'] ?></td>
											<td><?php echo $loan['loan_amount'] ?></td>
											<td><?php echo $loan['loan_order_no'] ?></td>
											<td><?php echo get_datepicker_date($loan['order_date']) ?></td>
											<td><?php echo $loan['paid_loan_amount'] ?></td>
											<td><?php echo $loan['bill_no']?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="7">No records found!</td></tr>';
								}
							?>
						</tbody>
					
					</table>
				
			</div>
		</div>
	</div>
</div>