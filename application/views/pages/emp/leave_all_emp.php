<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
		<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; Utilities</div>
		<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="leaveSanctioned()" >Sanctioned Leave</a></li>
							<li class="active"><a data-toggle="tab" href="#tab1" onclick="leaveEmp()" >CL / RH of Employee</a></li>
						</ul>
					</div>
				<div>&nbsp;</div>				
		<div class="right-panel">
			<div>
				<div class="page-details">
					<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-3">
									<label class="name-label"><?php //echo $this->lang->line('search'); ?>PAN :</label>
									<input type="text" id="" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control"/  placeholder="Search by Name or PAN">
								</div>
								<div class="col-sm-4">
									<label class="name-label">Select Leave :</label>
									<select id = "leave_type" name="leave_type" class="form-control" required>
											<option value=""> -- Select leave--</option>
											<option data-value="1" value="Casual Leave"<?php echo $this->input->get('leave_type') == 'Casual Leave' ? 'selected' : ''?> >Casual Leave</option>
<!--										<option data-value="2" value="Child Care Leave"<?php echo $this->input->get('leave_type') == 'Child Care Leave' ? 'selected' : ''?> >Child Care Leave</option>
											<option data-value="3" value="Half Pay Leave"<?php echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Half Pay Leave</option>
											<option data-value="4" value="Half Pay Leave"<?php //echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Commuted Leave</option>
											<option data-value="5" value="Earned Leave" <?php echo $this->input->get('leave_type') == 'Earned Leave' ? 'selected' : ''?> >Earned Leave</option>
											<option data-value="6" value="Extra-Ordinary Leave"<?php echo $this->input->get('leave_type') == 'Extra-Ordinary Leave' ? 'selected' : ''?> >Extra-Ordinary Leave</option>
											<option data-value="7" value="Maternity Leave"<?php echo $this->input->get('leave_type') == 'Maternity Leave' ? 'selected' : ''?> > Maternity Leave</option>
											<option data-value="8" value="Paternity Leave"<?php echo $this->input->get('leave_type') == 'Paternity Leave' ? 'selected' : ''?> >Paternity Leave</option>			-->
											<option data-value="9" value="Restricted Holiday"<?php echo $this->input->get('leave_type') == 'Restricted Holiday' ? 'selected' : ''?> >Restricted Holiday</option>
<!--										<option data-value="10" value="Study Leave"<?php echo $this->input->get('leave_type') == 'Study Leave' ? 'selected' : ''?> >Study Leave</option>			-->
										</select>
								</div>
								<div class="col-sm-3">
									<label class="name-label">Select Year :</label>
									<select name="leave_year" class="form-control" required>
										<option value="">---Year---</option>
										<?php
										for($i = date('Y'); $i >= 2019; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
									</select>
								</div>
								<div class="col-sm-2">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
							</div>
						</div>
					</form>
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Type</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = 1;
									foreach($results as $row){?>
										<tr>
												<td><?php echo $sl++ ?></td>
												<td><?php echo $row['name'] ?></td>
												<td><?php echo $row['leave_type'] ?></td>
												<td><?php echo get_datepicker_date($row['leave_from']) ?></td>
												<td><?php echo get_datepicker_date($row['leave_to']) ?></td>
												<td><?php echo $row['leave_day_no'] ?></td>
												<td><?php echo get_datepicker_date($row['application_dt']) ?></td>
												<td id "leave_st"><?php echo $row['leave_status']?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="8">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
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
function leaveSanctioned() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_sanctioned_all/';
}
function leaveEmp() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_all_emp/';
}

</script>