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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_training'); ?> </div>
			<div class="login-box">
										<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="myOrder()" >Office Order</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab1" onclick="myTrainingAll()" >Trainings</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="myTrainingOrder()" >Training Order</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myFacultyOrder()" >Faculty Order</a></li>
							<li><a data-toggle="tab" href="#tab4" onclick="myTransfer()" >Transfer Order</a></li>
							<li><a data-toggle="tab" href="#tab5" onclick="myTryInsOrder()" >Try. Inspection Order</a></li>
						</ul>
					</div>
				<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_training'); ?></strong></h4>
				<hr />
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-6">
									<label class="name-label">Select Training :</label>
									<select name="training_type" class="form-control" required>
										<option value=""> -- Select Training--</option>
										<option data-value="1" value="EDP Training" <?php echo $this->input->get('training_type') == 'EDP Training' ? 'selected' : ''?> >EDP Training</option>
										<option data-value="2" value="Non-EDP Training"<?php echo $this->input->get('training_type') == 'Non-EDP Training' ? 'selected' : ''?> >Non-EDP Training</option>
										
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-3">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/training_details_all'" value="<?php echo $this->lang->line('clear'); ?>" />
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
<!--								<th style="text-align:center">View </th>				
								<th style="text-align:center">Feedback</th>
								<th style="text-align:center">Oeder</th>
-->
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = 1;
									foreach($results as $row){
							 ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $row['training_mode']?></td>
											<td><?php echo $row['training_type']?></td>
											<td><?php echo $row['description'] ?></td>
											<td><?php echo $row['location'] ?></td>
											<td><?php echo get_datepicker_date($row['training_from']) ?></td>
											<td><?php echo get_datepicker_date($row['training_to']) ?></td>
											<td><?php echo $row['training_days'] ?></td>
<!--
											<td align="center">
											<?php
											if(strtolower($row['feedback_status']) !== 'submitted'){?>
											<button id ="print" class="btn btn-mini btn-success" 
											onclick="goFeedback('<?php echo $row['trg_detail_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto" >
											<i class="icon-pencil icon-white"></i>Form</button>
												&nbsp;
											<?php }
											else{ 
												 echo $row['feedback_status'];
											}?>
											</td>
											<td>
											<button id ="print" class="btn btn-mini btn-success" 
											onclick="goPrint('<?php echo $row['training_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto" >
											<i class="icon-pencil icon-white"></i> Print</button>
											</td>

											<td class="text-center" onclick="goPrint('<?php //echo $row['training_id'] ?>')"> <a href="<?php //echo SITE_BASE_URL?>emp/training_order_download" target="_blank"><img src="<?php //echo SITE_BASE_URL?>assets/images/PDF.png" style="max-height:50px;"/></a></td>
										
-->											</tr>
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

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_order_print/' + id;
    }
}
function myOrder() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/documents/';
}
function myTrainingAll() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_details_all/';
}
function myTrainingOrder() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_details/';
}
function myFacultyOrder(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/faculty_details/';
}
function myTransfer(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/transfer_order/';
}
function myTryInsOrder(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/treasury_insp_details/';
}
</script>