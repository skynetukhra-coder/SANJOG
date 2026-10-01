<style>
.table1 td{text-align:center;font-size: 12px}
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_leave_de'); ?>Leave Report </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('my_leave_debi'); ?>Casual Leave and Restricted Holiday Report </strong></h4>
				<hr />
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
				<h4><strong>1. Employee wise View</strong></h4>
				<div>
					<form method="get" action="<?php echo SITE_BASE_URL ?>emp/leave_report_emp" >
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-5">
									<label class="name-label">Employee PAN :</label>
									<input id="emp_id" name="emp_id" type="text"  value="" class="form-control" >
								</div>
								<div class="col-sm-3">
									<label class="name-label">Select Leave :</label>
									<select name="leave_type" class="form-control" required>
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Casual Leave"<?php echo $this->input->get('leave_type') == 'Casual Leave' ? 'selected' : ''?> >Casual Leave</option>
										<option data-value="2" value="Restricted Holiday"<?php echo $this->input->get('leave_type') == 'Restricted Holiday' ? 'selected' : ''?> >Restricted Holiday</option>
									</select>
								</div>
								<div class="col-sm-2">
									<label class="name-label">Select Year :</label>
									<select name="year" class="form-control" required>
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
				</div>
				<h4><strong>2. Section wise report</strong></h4>
				<div>
					<form method="get" action="<?php echo SITE_BASE_URL ?>emp/leave_report"  target="_blank">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-5">
									<label class="name-label">Select Section :</label>
									<select id="section" name="section" class="form-control" required>
									<option value=""> -- Select Section --</option>
									<?php
										if(isset($section_list) && !empty($section_list)){
												foreach($section_list as $sections){
												echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="col-sm-3">
									<label class="name-label">Select Leave :</label>
									<select name="leave_type" class="form-control" required>
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Casual Leave"<?php echo $this->input->get('leave_type') == 'Casual Leave' ? 'selected' : ''?> >Casual Leave</option>
										<option data-value="2" value="Restricted Holiday"<?php echo $this->input->get('leave_type') == 'Restricted Holiday' ? 'selected' : ''?> >Restricted Holiday</option>
									</select>
								</div>
								<div class="col-sm-2">
									<label class="name-label">Select Year :</label>
									<select name="year" class="form-control" required>
										<option value="">---Year---</option>
										<?php
										for($i = date('Y'); $i >= 2019; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
									</select>
								</div>
								<div class="col-sm-2">
									<input type="submit"  class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								
							</div>
						</div>
					</form>
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
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_application_edit/' + id;
    }
}
function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_report_print/';
    }
}
function goJoining(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_joining/' + id;
    }
}
/*
 function edit_btn(leave_st,edit) 
{
    if (leave_st.value === "Pending") 
    {
        document.getElementById("edit").disabled = false;		
    }
    else 
    {       
		document.getElementById("edit").disabled = true;
    }		
*/	
</script>