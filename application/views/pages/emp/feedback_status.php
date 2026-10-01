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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?> &raquo; Status</div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="myExamDept()" >Exam Applcation (Dept.)</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myExamNonDept()" >Exam Permission (Non-Dept)</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="myPassport()" >Passport appliication</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myBill()" >Bill Reimbursement</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab4" onclick="myFeedback()" >Feedback</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_service_boo'); ?>My Feedback Status</strong></h4>
				<hr />
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Feedback Date</th>
								<th style="text-align:center">Feedback</th>
								<th style="text-align:center">Action Taken</th>
								<th style="text-align:center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($feedbacks)){
									$sl = 1;
									foreach($feedbacks as $records){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo get_datepicker_date($records['feed_date']) ?></td>
											<td><?php echo $records['details'] ?></td>
											<td> <?php if(strtolower($records['status']) == 'close'){?>
												<?php echo $records['administration_action_taken'] ?> <?php echo $records['accounts_action_taken'] ?> <?php echo $records['fund_action_taken'] ?> <?php echo $records['pension_action_taken'] ?>
												<?php }else{
													echo '';
												}
												?>
											</td>
											<td><?php echo ucwords($records['status']) ?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="5">No record found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function myExamDept() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_exam_info/';
}
function myExamNonDept() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_exam_other_info/';
}
function myPassport(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_passport_info/';
}
function myBill(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/bill_details/';
}
function myFeedback(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/feedback_status/';
}
</script>