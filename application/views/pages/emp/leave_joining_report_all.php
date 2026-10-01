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
							<li><a data-toggle="tab" href="#tab" onclick="elReco()" >Leave for Recommendation</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="elCheck()" >Leave for Check</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="elSanct()" >Leave for Sanction</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab3" onclick="JoinAp()" >Joining for Approval</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('leave_for_recommendatio'); ?>Joining for Approval</strong></h4>
				<hr />
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Leave :</label>
									<select name="leave_type" class="form-control" required>
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Child Care Leave"<?php echo $this->input->get('leave_type') == 'Child Care Leave' ? 'selected' : ''?> >Child Care Leave</option>
										<option data-value="2" value="Commutted Leave"<?php echo $this->input->get('leave_type') == 'Commutted Leave' ? 'selected' : ''?> >Commutted Leave</option>
										<option data-value="3" value="Earned Leave" <?php echo $this->input->get('leave_type') == 'Earned Leave' ? 'selected' : ''?> >Earned Leave</option>
										<option data-value="4" value="Extra-Ordinary Leave"<?php echo $this->input->get('leave_type') == 'Extra-Ordinary Leave' ? 'selected' : ''?> >Extra-Ordinary Leave</option>
										<option data-value="5" value="Maternity Leave"<?php echo $this->input->get('leave_type') == 'Maternity Leave' ? 'selected' : ''?> > Maternity Leave</option>
										<option data-value="6" value="Paternity Leave"<?php echo $this->input->get('leave_type') == 'Paternity Leave' ? 'selected' : ''?> >Paternity Leave</option>
										<option data-value="7" value="Study Leave"<?php echo $this->input->get('leave_type') == 'Study Leave' ? 'selected' : ''?> >Study Leave</option>
									</select>
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-4">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/leave_details'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
				
				
					<table class = "table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Type</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Leave Status</th>
								<th style="text-align:center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									$s2=0;
									
									foreach($results as $joining){
										$s2 += $joining['leave_day_no']; ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $joining['name'] ?></td>
											<td><?php echo $joining['leave_type'] ?></td>
											<td><?php echo get_datepicker_date($joining['leave_from']) ?></td>
											<td><?php echo get_datepicker_date($joining['leave_to']) ?></td>
											<td><?php echo $joining['leave_day_no'] ?></td>
											<td><?php echo get_datepicker_date($joining['application_dt']) ?></td>
											<td id "leave_st"><?php echo $joining['leave_status']?></td>
											<td>
											<button id ="edit" class="btn-mini btn-primary" 
											onclick="goEdit('<?php echo $joining['leav_id'] ?>')" ><i 
												class="icon-pencil icon-white"></i> Action</button>
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="9">No records found!</td></tr>';
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
							
						//	echo $s2; 
						}	
						else{
							echo '0'; ;
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
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_joining_approval/' + id;
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
function elReco() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_pending_recommendation_all/';
}
function elCheck(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_pending_check_all/';
}
function elSanct(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_pending_sanction_all/';
}
function JoinAp(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_joining_report_all/';
}
</script>