<style>
.table1 td{
	text-align:center;
	font-size:12px;
}
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
			<div class="msg_cont">
				<div class="success">
					<?php if(isset($success) && !empty($success)){
						echo '<div class="msg">'.$success.'</div>';
					  }else if($this->session->flashdata('success')){
					  	echo '<div class="msg">'.$this->session->flashdata('success').'</div>';
					  }
				 ?>
				</div>
				<div class="err">
					<?php if(isset($error) && !empty($error)){
						echo '<div class="msg">'.$error.'</div>';
					  }else if($this->session->flashdata('error')){
					  	echo '<div class="msg">'.$this->session->flashdata('error').'</div>';
					  }
				 ?>
				</div>
			</div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="myOrder()" >Office Order</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myTrainingAll()" >Trainings</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab2" onclick="myTrainingOrder()" >Training Order</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myFacultyOrder()" >Faculty Order</a></li>
							<li><a data-toggle="tab" href="#tab4" onclick="myTransfer()" >Transfer Order</a></li>
							<li><a data-toggle="tab" href="#tab5" onclick="myTryInsOrder()" >Try. Inspection Order</a></li>
						</ul>
					</div>
				<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_training'); ?> Order</strong></h4>
				<hr />
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Training :</label>
									<select name="records" class="form-control" required>
										<option value=""> -- Select Training--</option>
										<option data-value="1" value="EDP Training" <?php echo $this->input->get('records') == 'EDP Training' ? 'selected' : ''?> >EDP Training</option>
										<option data-value="2" value="Non-EDP Training"<?php echo $this->input->get('records') == 'Non-EDP Training' ? 'selected' : ''?> >Non-EDP Training</option>
										
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
								<th style="text-align:center">Mode</th>
								<th style="text-align:center">Type</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Location</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
<!--								<th style="text-align:center">View </th>				-->
								<th style="text-align:center">Evaluation</th>
								<th style="text-align:center">Feedback</th>
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
											<td><?php echo $trainings['fin_year']?></td>
											<td><?php echo $trainings['training_mode']?></td>
											<td><?php echo $trainings['training_type']?></td>
											<td><?php echo $trainings['description'] ?></td>
											<td><?php echo $trainings['location'] ?></td>
											<td><?php echo get_datepicker_date($trainings['training_from']) ?></td>
											<td><?php echo get_datepicker_date($trainings['training_to']) ?></td>
											<td><?php echo $trainings['training_days'] ?></td>
											
											<td>
												<?php
												if($trainings['eval_status'] == 'Pending'){
													if(trim($trainings['evaluation_link']) != ''){
														echo '<a target="_blank" href="'.$trainings['evaluation_link'].'" target="_blank"><img src="'.SITE_BASE_URL.'assets/images/Laptop.png" style="max-height:40px;"/></a><br/>';
													}
												}else{
													echo $trainings['evaluation_link'] ;
												}
												?>
											</td>
											<td>
											<?php
											if($trainings['feedback_status'] !== 'Submitted'){?>
											<button id ="print" class="btn-mini btn-primary" 
											onclick="goFeedback('<?php echo $trainings['trg_detail_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto" >
											<i class="icon-pencil icon-white"></i>Form</button>
											<?php }
											else{ 
												 echo $trainings['feedback_status'];
											}?>
											</td>
<!--											--- For training_order_print
											<td>
											<button id ="print" class="btn-mini btn-success" 
											onclick="goPrint('<?php echo $trainings['training_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto" >
											<i class="icon-pencil icon-white"></i> Print</button>
											</td>
-->
											<td class="text-center" onclick="goPrint('<?php echo (!empty($trainings['training_id']) ? $trainings['training_id']: 'x' )?>')"> <img src="<?php echo SITE_BASE_URL?>assets/images/PDF.png" style="max-height:40px;"/></a></td>
										
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="12">No records found!</td></tr>';
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
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_order_download/' + id;  // training_order_print
    }
}
function goFeedback(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_feedback/' + id;
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