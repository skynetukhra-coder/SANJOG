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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_leave_encashment'); ?> </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('my_leave_encashment'); ?></strong></h4>
				<hr />

				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-6">
									<label class="name-label">Select Leave :</label>
									<select name="records" class="form-control" required>
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Availed" <?php echo $this->input->get('records') == 'Availed' ? 'selected' : ''?> >Availed</option>
										<option data-value="2" value="Pending"<?php echo $this->input->get('records') == 'Pending' ? 'selected' : ''?> >Pending</option>
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-3">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/leave_encashment'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days Encash</th>
								<th style="text-align:center">Amount</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									$s2=0;
									$s3=60;
									foreach($office_orders as $leaves){
											$s2 += $leaves['no_days_encash']; 	
										?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $leaves['description'] ?></td>
											<td><?php echo get_datepicker_date($leaves['from_date']) ?></td>
											<td><?php echo get_datepicker_date($leaves['to_date']) ?></td>
											<td><?php echo $leaves['no_days_encash'] ?></td>
											<td><?php echo $leaves['encash_amount'] ?></td>
											<td><?php echo get_datepicker_date($leaves['application_dt']) ?></td>
											<td><?php echo $leaves['status'] ?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="8">No records found!</td></tr>';
								}
							?>
						</tbody>
					
					</table>
					
			<div>
				<table>
					<tr>
						<td style="text-align:center">** No of days Leave encashed :</td>
						<td><b><?php
						if($this->input->get('year') == 'Availed'){
							if(!empty($office_orders)){	
								echo $s2; 
							}	
							else{
								echo '0'; 
								}
						}else{
							echo '0';
						}
						?>	
						</b></td>
						<td>
						</td>
						<td ><font color="#F08080"><b> ** No of days due  for Leave encashment :
						<?php 
						if($this->input->get('year') == 'Availed'){
							if(!empty($office_orders)){	
								echo $s3-$s2; 
							}	
							else{
								echo '0'; 
								}
						}else{
							echo '0';
						}?>
						</b></font></td>
					</tr>	
				</table>
			</div>	
			</div>
		</div>
	</div>
</div>