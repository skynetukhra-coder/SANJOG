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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?> &raquo; Orders </div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="myOrder()" >Office Order</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myTrainingAll()" >Trainings</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="myTrainingOrder()" >Training Order</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myFacultyOrder()" >Faculty Order</a></li>
							<li><a data-toggle="tab" href="#tab4" onclick="myTransfer()" >Transfer Order</a></li>
							<li class="active" ><a data-toggle="tab5" href="#tab4" onclick="myTryInsOrder()" >Try. Inspection Order</a></li>
						</ul>
					</div>
				<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_traini'); ?>My Treasury Inspection Order</strong></h4>
				<hr />
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Year :</label>
										<select name="try_insp_year" class="form-control" >
											<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
											<?php
												for($i = date('Y')+1; $i >= 2019; $i--){
												echo '<option value="'.$i.'" '.($this->input->get('try_insp_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
											}?>
										</select>
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-4">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/training_details'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
				
				
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Year</th>
								<th style="text-align:center">Treasury</th>
								<th style="text-align:center">Inspection Period</th>
								<th style="text-align:center">Party No</th>
								<th style="text-align:center">Schedule</th>
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Print</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									foreach($office_orders as $order){
							 ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $order['try_insp_month']?>, <?php echo $order['try_insp_year']?></td>
											<td><?php echo $order['treasury_nm']?></td>
											<td><?php echo $order['period_under_inspct'] ?></td>
											<td><?php echo $order['insp_party_nos'] ?></td>
											<td><?php echo get_datepicker_date($order['try_insp_from']) ?> to <?php echo get_datepicker_date($order['try_insp_to']) ?></td>
											<td><?php echo $order['insp_days'] ?></td>
<!--											<td>
											<button id ="print" class="btn-mini btn-success" 
											onclick="goPrint('<?php echo $order['insp_rec_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto" >
											<i class="icon-pencil icon-white"></i> Print</button>
											</td>
-->
											<td class="text-center" onclick="goPrint('<?php echo $order['try_insp_prg_id'] ?>')"> <img src="<?php echo SITE_BASE_URL?>assets/images/PDF.png" style="max-height:40px;"/></a></td>
										
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="8">No records found!</td></tr>';
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
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/treasury_inspection_order_print/' + id;
    }
}
</script>

<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
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