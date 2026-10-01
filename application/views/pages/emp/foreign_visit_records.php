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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?> </div>
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
					
				<div class = "col-sm-12">&nbsp;</div>
				<div class = "col-sm-12">
					<div class="col-md-10 col-sm-12" align= "left">
						<h4><strong><?php echo $this->lang->line('my_gp'); ?>Foreign Visit Records</strong></h4>
					</div>
					<div class="col-md-2 col-sm-12" align= "right">
						<button type="button" class="btn-success btn-xm" onclick="goBack()"> BACK </button>
					</div>
				</div>
				<div class = "col-sm-12">&nbsp;</div>
				<hr />
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Country</th>
								<th style="text-align:center">Period</th>
								<th style="text-align:center">Purpose</th>
								<th style="text-align:center">Expenditure</th>
								<th style="text-align:center">Source</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($visits)){
									$sl = 1;
									foreach($visits as $visit){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $visit['emp_name'] ?></td>
											<td><?php echo get_datepicker_date($visit['visit_fm']) ?> To <?php echo get_datepicker_date($visit['visit_to']) ?></td>
											<td><?php echo $visit['visit_purpose'] ?></td>
											<td><?php echo $visit['est_expnd'] ?></td>
											<td><?php echo $visit['source_fnd'] ?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="7">No documents found!</td></tr>';
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
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/foreign_visits_edit/' + id;
    }
}
function goBack() {
  window.history.back();
}
function AppForm() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_passport/';
}
function myVisit() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/foreign_visits/';
    //}
}
</script>