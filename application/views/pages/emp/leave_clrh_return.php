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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_leave'); ?> </div>
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
		<div class="muted pull-left" style = "color: #FF5733; font-size:18px;">
			<p>&nbsp&nbsp</p>
			<p>&nbsp&nbsp !!! &nbsp&nbsp Edit & submit your pending leave(s) of the year for sanction as below. </p>
			<p>&nbsp&nbsp !!! &nbsp&nbsp Click Convert Button to convert your Casual Leave to Restricted Holiday or vice versa. </p>
			<p>&nbsp&nbsp !!! &nbsp&nbsp In case, this / these leave(s) is/are of previous year(s), contact IT Support Cell to clear this / these leave(s). </p>
		</div>
			<div class="login-box">
					
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('clrh_credit'); ?>Casual Leave/ Restricted Holiday Returned or Held</strong></h4>
				<hr />
				
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Year</th>
								<th style="text-align:center">Leave</th>
								<th style="text-align:center">Ground</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Status</th>
								<th style="text-align:center">Action</th>
								<th style="text-align:center">CL/RH</th>
							</tr>
						</thead>
						<tbody >
						
							<?php
								
								if(!empty($leave_debits)){	
									foreach($leave_debits as $leaves){
										
										?>
										<tr>
											<td style="font-size: 8px"><b><?php echo $leaves['leave_dr_year'] ?></b></td>
											<td><?php echo $leaves['leave_type'] ?></td>
											<td><?php echo $leaves['ground'] ?></td>
											<td><?php echo  get_datepicker_date($leaves['leave_from']) ?></td>
											<td><?php echo  get_datepicker_date($leaves['leave_to']) ?></td>
											<td><?php echo $leaves['leave_day_no'] ?></td>
											<td><?php echo get_datepicker_date($leaves['application_dt']) ?></td>
											<td id "leave_st"><?php echo $leaves['leave_status']?></td>
											<td align="center"style = "width: 12%;" >
											<?php
											if(strtolower($leaves['leave_status']) == 'submitted'){?>
											<button id ="hold" class="btn-mini btn-warning" 
											onclick="goHold('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Hold</button>
												&nbsp;
											<?php }?>
											<?php
											if(strtolower($leaves['leave_status']) == 'submitted'||strtolower($leaves['leave_status']) == 'held'|| strtolower($leaves['leave_status']) == 'returned'){?>
											<button id ="edit" class="btn-mini btn-primary" 
											onclick="goEdit('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Edit</button>
												&nbsp;
											<?php }?>
												
											<button id ="print" class="btn-mini btn-success" 
											onclick="goPrint('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto" ><i 
												class="icon-pencil icon-white"></i> View</button>
											</td>
											<td align="center"style = "width: 7%;" >		
											<button id ="convert" class="btn-mini btn-warning" 
											onclick="goConvert('<?php echo $leaves['leav_id']?>')" style="display:inline-block; padding:2px; margin:2px; width:auto" ><i 
												class="icon-pencil icon-white"></i> Convert</button>
											</td>
										</tr>
										
								<?php	}
								}else{
									echo '<tr><td colspan="10">No records found!</td></tr>';
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
function goHold(id, type) {
    if (id != undefined) {
		var conf = confirm('Do you want to hold this leave from the Authority for submission later?');
		if(conf){
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_application_hold_clrh/' + id;
		}
    }
}
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_application_clrh_edit/' + id;
    }
}
function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_application_clrh_print/' + id;
    }
}
function goConvert(id, type) {
    if (id != undefined) {
		var conf = confirm('Do you want to convert Casual Leave to Restricted Holiday or vice versa?');
       if(conf){
			window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_convert/' + id;
	   }
    }
}
</script>

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