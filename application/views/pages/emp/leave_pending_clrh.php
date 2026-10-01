<style>
.table1 td{
	text-align:center
	
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('leave_for_sanction'); ?> </div>
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
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="clSanc()" >CL RH for Sanction</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="clDeduc()" >CL Deduction</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('leave_for_sanctio'); ?>CL And RH for Sanction</strong></h4>
				<hr />
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Leave :</label>
									<select name="leave_type" class="form-control" >
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Casual Leave"<?php echo $this->input->get('leave_type') == 'Casual Leave' ? 'selected' : ''?> >Casual Leave</option>
										<option data-value="2" value="Restricted Holiday"<?php echo $this->input->get('leave_type') == 'Restricted Holiday' ? 'selected' : ''?> >Restricted Holiday</option>
									</select>
								</div>
								<div class="col-sm-2">
									<label class="name-label">Select Year :</label>
									<select name="leave_dr_year" class="form-control" >
										<option value="">---Year---</option>
										<?php
										for($i = date('Y'); $i >= 2019; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-3">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/leave_pending_clrh'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
				
					<table class="table1" border="1" style="width:100%">
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
								<th style="text-align:center">Action</th>
								<th style="text-align:center">History</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									$s2=0;
									
									foreach($results as $leaves){
										$s2 += $leaves['leave_day_no']; ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $leaves['name'] ?></td>
											<td><?php echo $leaves['leave_type'] ?></td>
											<td><?php echo get_datepicker_date($leaves['leave_from']) ?></td>
											<td><?php echo get_datepicker_date($leaves['leave_to']) ?></td>
											<td><?php echo $leaves['leave_day_no'] ?></td>
											<td><?php echo get_datepicker_date($leaves['application_dt']) ?></td>
											<td id "leave_st"><?php echo $leaves['leave_status']?></td>
											<td>
											<button id ="edit" class="btn-mini btn-primary" 
											onclick="goEdit('<?php echo $leaves['leav_id'] ?>')" ><i 
												class="icon-pencil icon-white"></i> Action</button>
											</td>
											<td>
											<button id ="view" class="btn-mini btn-success" 
											onclick="goView('<?php echo $leaves['empid'] ?>')" ><i 
												class="icon-pencil icon-white"></i> View</button>
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="10">No records found!</td></tr>';
								}
							?>
						</tbody>
					
					</table>
					
			<div>
				
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
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_sanction_clrh/' + id;
    }
}
function goView(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_history_clrh';
    }
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
<script>
function clSanc() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_pending_clrh/';
}
function clDeduc(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/cl_deduction/';
}
</script>