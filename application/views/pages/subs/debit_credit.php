<style>
th,td{line-height:15px; padding:5px}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/subscribers_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="login-box">
				<h4>Credit and Debit details of this financial year</h4>
				<hr />
				<table border="1" style="width:100%">
					<thead>
						<tr style="text-align:center">
							<th style="text-align:center">Year</th>
							<th style="text-align:center">Subscription</th>
							<th style="text-align:center">Refund</th>
							<th style="text-align:center">Other</th>
							<th style="text-align:center">Debit</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!empty($debit_credit)){
							foreach($debit_credit as $dr_cr){
							?>
								<tr>
									<td style="text-align:center"><?php echo $dr_cr['month'].'/'.$dr_cr['yr'] ?></td>
									<td style="text-align:center"><?php echo $dr_cr['subscription'] ?></td>
									<td style="text-align:center"><?php echo $dr_cr['refund'] ?></td>
									<td style="text-align:center"><?php echo $dr_cr['other'] ?></td>
									<td style="text-align:center"><?php echo $dr_cr['debit'] ?></td>
								</tr>
						<?php
							}
						}else{?>
							<tr>
								<td colspan="5" style="font-size:12px"><?php echo $this->lang->line('no_data_found')?></td>
							</tr>
						<?php
						}?>					
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>