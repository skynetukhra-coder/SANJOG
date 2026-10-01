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
							<li class="active" ><a data-toggle="tab" href="#tab3" onclick="myBill()" >Bill Reimbursement</a></li>
							<li><a data-toggle="tab" href="#tab4" onclick="myFeedback()" >Feedback</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_bills'); ?></strong></h4>
				<hr />
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Bill Type :</label>
									<select name="records" class="form-control" required>
										<option value=""> -- Select Bill--</option>
										<option data-value="1" value="TA Bill" <?php echo $this->input->get('records') == 'TA Bill' ? 'selected' : ''?> >TA Bill</option>
										<option data-value="2" value="LTC Bill"<?php echo $this->input->get('records') == 'LTC Bill' ? 'selected' : ''?> >LTC Bill</option>
										<option data-value="2" value="Medical Bill"<?php echo $this->input->get('records') == 'Medical Bill' ? 'selected' : ''?> >Medical Bill</option>
										<option data-value="2" value="Education Allowance Bill"<?php echo $this->input->get('records') == 'Education Allowance Bill' ? 'selected' : ''?> >Education Allowance Bill</option>
										<option data-value="2" value="News Paper Bill"<?php echo $this->input->get('records') == 'News Paper Bill' ? 'selected' : ''?> >News Paper Bill</option>
										<option data-value="2" value="Advance Bill"<?php echo $this->input->get('records') == 'Advance Bill' ? 'selected' : ''?> >Advance Bill</option>
										<option data-value="2" value="Adjustment Bill"<?php echo $this->input->get('records') == 'Adjustment Bill' ? 'selected' : ''?> >Adjustment Bill</option>
									</select>
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-4">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/bill_details'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Bill No</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Block</th>
								<th style="text-align:center">Bill Date</th>
								<th style="text-align:center">Bill Amount</th>     
								<th style="text-align:center">Amount Paid</th>
								<th style="text-align:center">Adv Bill No</th>
								<th style="text-align:center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									foreach($office_orders as $leaves){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $leaves['bill_no'] ?></td>
											<td><?php echo $leaves['description'] ?></td>
											<td><?php echo $leaves['block'] ?></td>
											<td><?php echo get_datepicker_date($leaves['bill_date']) ?></td>
											<td><?php echo $leaves['bill_amount'] ?></td>
											<td><?php echo $leaves['amount_paid']?></td>
											<td><?php echo $leaves['advance_bill_no']?></td>
											<td><?php echo $leaves['appli_status']?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="9">No Record found!</td></tr>';
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