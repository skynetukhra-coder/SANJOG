<style>
.table1 td{text-align:center}
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_dacadre_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_training'); ?></div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('my_trainin'); ?>My Faculty Information</strong></h4>
				<hr />
				

				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-6">
									<label class="name-label">Select Training :</label>
									<select name="records" class="form-control" required>
										<option value=""> -- Select Training--</option>
										<option data-value="1" value="EDP Training" <?php echo $this->input->get('records') == 'EDP Training' ? 'selected' : ''?> >EDP Training</option>
										<option data-value="2" value="Non-EDP Training"<?php echo $this->input->get('records') == 'Non-EDP Training' ? 'selected' : ''?> >Non-EDP Training</option>
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-3">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp_dacadre/training_details'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
				
				
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Mode</th>
								<th style="text-align:center">Type</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Location</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
<!--								<th style="text-align:center">View </th>				-->
								<th style="text-align:center">Order</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									foreach($office_orders as $trainings){
							 ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $trainings['training_mode']?></td>
											<td><?php echo $trainings['training_type']?></td>
											<td><?php echo $trainings['description'] ?></td>
											<td><?php echo $trainings['location'] ?></td>
											<td><?php echo get_datepicker_date($trainings['training_from']) ?></td>
											<td><?php echo get_datepicker_date($trainings['training_to']) ?></td>
											<td><?php echo $trainings['training_days'] ?></td>
											<td class="text-center" onclick="goPrint('<?php echo $trainings['training_id'] ?>')"> <img src="<?php echo SITE_BASE_URL?>assets/images/PDF.png" style="max-height:40px;"/></a></td>
<!--										
										<td>
											<button id ="print" class="btn btn-mini btn-success" 
											onclick="goPrint('<?php echo $trainings['training_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto" >
											<i class="icon-pencil icon-white"></i> Print</button>
										</td>
-->
									</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="9">No records found!</td></tr>';
								}
							?>
						</tbody>
					
					</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp_dacadre/faculty_order_download/' + id; // faculty_order_print
    }
}

</script>