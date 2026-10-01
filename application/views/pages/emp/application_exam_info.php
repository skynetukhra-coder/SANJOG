<style>
.table1 td{text-align:center;
	font-size:13px;
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?> &raquo; Status</div>
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
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="myExamDept()" >Exam Applcation (Dept.)</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myExamNonDept()" >Exam Permission (Non-Dept)</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="myPassport()" >Passport appliication</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myBill()" >Bill Reimbursement</a></li>
							<li><a data-toggle="tab" href="#tab4" onclick="myFeedback()" >Feedback</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>Examination Application for recommendation</strong></h4>
				<hr />
				
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Desig</th>
								<th style="text-align:center">Section</th>
								<th style="text-align:center">Examination</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									$s2=0;
									
									foreach($office_orders as $leaves){
									//	$s2 += $leaves['leave_day_no']; ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $leaves['full_name'] ?></td>
											<td><?php echo $leaves['desig'] ?></td>
											<td><?php echo $leaves['section_name'] ?></td>
											<td><?php echo $leaves['exm_nm'] ?> [<?php echo $leaves['exm_month'] ?>-<?php echo $leaves['exm_year'] ?>]</td>
											<td><?php echo get_datepicker_date($leaves['applied_on']) ?></td>
											<td><?php echo $leaves['application_status'] ?></td>
											
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="9">No records found!</td></tr>';
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
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_recommendation/' + id;
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