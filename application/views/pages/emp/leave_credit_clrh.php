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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_leave'); ?> </div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="clCr()" >CL / HR Credited</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="clDr()" >CL / HR Availed</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_leave_credited'); ?>CL / HR credited</strong></h4>
				<hr />
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Leave :</label>
									<select name="leave_type" class="form-control" required>
										<option value=""> -----Select leave-----</option>
										<option data-value="1" value="Casual Leave" <?php echo $this->input->get('leave_type') == 'Casual Leave' ? 'selected' : ''?> >Casual Leave</option>
										<option data-value="2" value="Restricted Holiday"<?php echo $this->input->get('leave_type') == 'Restricted Holiday' ? 'selected' : ''?> >Restricted Holiday</option>
										
									</select>
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-4">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/leave_credit'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
				
				
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Type</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Credited On</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									$s2=0;
									foreach($office_orders as $leaves){
										$s2 += $leaves['no_days']; ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $leaves['leave_type'] ?></td>
											<td><?php echo get_datepicker_date($leaves['cr_from_date']) ?></td>
											<td><?php echo get_datepicker_date($leaves['cr_to_date']) ?></td>
											<td><?php echo $leaves['no_days'] ?></td>
											<td><?php echo get_datepicker_date($leaves['credit_date']) ?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="6">No records found!</td></tr>';
								}
							?>
						</tbody>
					
					</table>
					
			<div>
				<table>
					<tr>
						<td style="text-align:center">*</td>
						<td><?php 
						if(!empty($office_orders)){
							
							//echo $s2; 
						}	
						else{
							//echo '0'; ;
							}?>
						</td>   
					</tr>	
				</table>
			</div>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function clCr() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_credit_clrh/';
}
function clDr() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_clrh/';
}
function elCr(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_credit_others/';
}
function elDr(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_debit/';
}
</script>
