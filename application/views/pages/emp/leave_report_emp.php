<style>
.table1 td{text-align:center;font-size: 13px}
</style>
<?php
$s2 = 0;
$s3 = 0;
?>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_leave'); ?> </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('clrh_credit'); ?>CL / RH submitted or availed by the Employee</strong></h4>
				<hr />
				<div>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Ground</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Status</th>
							</tr>
						</thead>
						<tbody >
							<?php
								if(!empty($leave_credit)){
									foreach($leave_credit as $credit){
										$s3 = $credit['no_days']; 
									}
								}else{
										$s3=0;
								}
							?>
							<?php
								if(!empty($leave_debits)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									
									foreach($leave_debits as $leaves){ 
									$s2 += $leaves['leave_day_no'];?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><font size = "1"> <?php echo $leaves['name'] ?></td>
											<td><?php echo  get_datepicker_date($leaves['leave_from']) ?></td>
											<td><?php echo  get_datepicker_date($leaves['leave_to']) ?></td>
											<td><?php echo $leaves['leave_day_no'] ?></td>
											<td><font size = "1"> <?php echo $leaves['ground'] ?></td>
											<td><?php echo get_datepicker_date($leaves['application_dt']) ?></td>
											<td id "leave_st"><?php echo $leaves['leave_status']?></td>
										</tr>
										
								<?php	}
								}else{
									echo '<tr><td colspan="8">No records found!</td></tr>';
								}
							?>
						</tbody>
					</table>
				</div>
				<div>
					<table>
						<tr>
							<td style="text-align:left"><u> Balance leave </u></td>
							<td style="text-align:right">  <?php //echo date('Y') ?> </td> 
						</tr>
						<tr>
							<td style="text-align:left">** Leave credited :</td>
							<td style="text-align:right">  <?php echo $s3; ?> </td> 
						</tr>
						<tr>
							<td style="text-align:left">** Leave Availed :</td>
							<td style="text-align:right"><?php 	echo $s2; ?> </td>   
						</tr>
						<tr>
							<td style="text-align:left"><b>** Present  Balance :</b></td>
							<td style="text-align:right"><b> <?php echo $s3- $s2; ?> <b/></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});


</script>
