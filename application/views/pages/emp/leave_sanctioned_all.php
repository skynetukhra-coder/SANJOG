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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo;<?php echo $this->lang->line('leave_for_sanction'); ?> </div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li class="active"><a data-toggle="tab" href="#tab" onclick="leaveSanctioned()" >Sanctioned Leave</a></li>
							<li ><a data-toggle="tab" href="#tab1" onclick="leaveEmp()" >CL / RH of Employee</a></li>
						</ul>
					</div>
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
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label"><?php echo $this->lang->line('search'); ?> :</label>
									<input type="text" id="" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control"/  placeholder="Search by Name or PAN">
								</div>
								<div class="col-sm-4">
									<label class="name-label">Select Leave :</label>
									<select id = "leave_type" name="leave_type" class="form-control" required>
											<option value=""> -- Select leave--</option>
											<option data-value="1" value="Casual Leave"<?php echo $this->input->get('leave_type') == 'Casual Leave' ? 'selected' : ''?> >Casual Leave</option>
											<option data-value="2" value="Child Care Leave"<?php echo $this->input->get('leave_type') == 'Child Care Leave' ? 'selected' : ''?> >Child Care Leave</option>
											<option data-value="3" value="Half Pay Leave"<?php echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Half Pay Leave</option>
<!--        								<option data-value="4" value="Half Pay Leave"<?php //echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Commuted Leave</option>			-->
											<option data-value="5" value="Earned Leave" <?php echo $this->input->get('leave_type') == 'Earned Leave' ? 'selected' : ''?> >Earned Leave</option>
											<option data-value="6" value="Extra-Ordinary Leave"<?php echo $this->input->get('leave_type') == 'Extra-Ordinary Leave' ? 'selected' : ''?> >Extra-Ordinary Leave</option>
											<option data-value="7" value="Maternity Leave"<?php echo $this->input->get('leave_type') == 'Maternity Leave' ? 'selected' : ''?> > Maternity Leave</option>
											<option data-value="8" value="Paternity Leave"<?php echo $this->input->get('leave_type') == 'Paternity Leave' ? 'selected' : ''?> >Paternity Leave</option>
											<option data-value="9" value="Restricted Holiday"<?php echo $this->input->get('leave_type') == 'Restricted Holiday' ? 'selected' : ''?> >Restricted Holiday</option>
											<option data-value="10" value="Study Leave"<?php echo $this->input->get('leave_type') == 'Study Leave' ? 'selected' : ''?> >Study Leave</option>
										</select>
								</div>
								<div class="col-sm-2">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-2">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/leave_sanctioned_all'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
					
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">PAN</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Type</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Status</th>
								<th style="text-align:center">Action</th>
								<th style="text-align:center">History</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = 1;
									foreach($results as $row){?>
										<tr>
												<td><?php echo $sl++ ?></td>
												<td><?php echo $row['empid'] ?></td>
												<td><?php echo $row['name'] ?></td>
												<td><?php echo $row['leave_type'] ?></td>
												<td><?php echo get_datepicker_date($row['leave_from']) ?></td>
												<td><?php echo get_datepicker_date($row['leave_to']) ?></td>
												<td><?php echo $row['leave_day_no'] ?></td>
												<td><?php echo get_datepicker_date($row['application_dt']) ?></td>
												<td id "leave_st"><?php echo $row['leave_status']?></td>
												<td>
												<button id ="edit" class="btn-mini btn-primary" 
												onclick="goEdit('<?php echo $row['leav_id'] ?>')" ><i 
													class="icon-pencil icon-white"></i> Action</button>
												</td>
												<td>
												<button id ="view" class="btn-mini btn-success" 
												onclick="goView('<?php echo $row['empid'] ?>')" ><i 
													class="icon-pencil icon-white"></i> View</button>
												</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="11">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
				<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_application_sanction/' + id;
    }
}
function goView(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_history';
    }
}

function leaveSanctioned() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_sanctioned_all/';
}
function leaveEmp() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_all_emp/';
}
/*
 function edit_btn(leave_st,edit) 
{
    if (leave_st.value == "draft") 
    {
        document.getElementById("edit").disabled = false;		
    }
    else 
    {       
		document.getElementById("edit").disabled = true;
    }	
*/	
	
</script>
