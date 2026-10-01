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
		<div class="muted pull-left" style = "color: #513c96; font-size:18px;">
			<marquee direction="left"  onMouseOver="this.stop()" onMouseOut="this.start()">
			Hold your leave if (i) you want to Edit it or (ii) Not to submit to the Leave Sanctioning Authority now. Updating of information in "My Information" page is important before application of leave !!! 
			</marquee>
		</div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="clCr()" >CL / HR Credited</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab1" onclick="clDr()" >CL / HR Availed</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('clrh_credit'); ?>CL / RH submitted or availed</strong></h4>
				<hr />
				
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Leave :</label>
									<select name="leave_type" class="form-control" required>
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Casual Leave"<?php echo $this->input->get('leave_type') == 'Casual Leave' ? 'selected' : ''?> >Casual Leave</option>
										<option data-value="2" value="Restricted Holiday"<?php echo $this->input->get('leave_type') == 'Restricted Holiday' ? 'selected' : ''?> >Restricted Holiday</option>
									</select>
								</div>
								<div class="col-sm-4">
									<label class="name-label">Select Year :</label>
									<select name="year" class="form-control" required>
										<option value="">---Year---</option>
										<?php
										for($i = date('Y')+1; $i >= 2019; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
									</select>
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
							</div>
						</div>
					</form>

					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Ground</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>     
								<th style="text-align:center">Days</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Status</th>
								<th style="text-align:center">Action</th>
							</tr>
						</thead>
						<tbody >
						<?php
								if(!empty($leave_credit)){
									$s3=0;
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
									$s2=0;
									
									foreach($leave_debits as $leaves){
										$s2 += $leaves['leave_day_no']; ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><font size = "1"> <?php echo $leaves['ground'] ?></td>
											<td><?php echo  get_datepicker_date($leaves['leave_from']) ?></td>
											<td><?php echo  get_datepicker_date($leaves['leave_to']) ?></td>
											<td><?php echo $leaves['leave_day_no'] ?></td>
											<td><?php echo get_datepicker_date($leaves['application_dt']) ?></td>
											<td id "leave_st"><?php echo $leaves['leave_status']?></td>
											<td align="center"style = "width: 16%;" >
											<?php
											if(strtolower($leaves['leave_status']) == 'submitted'){?>
											<button id ="edit" class="btn-mini btn-warning" 
											onclick="goHold('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Hold</button>
												&nbsp;
											<?php }?>
											<?php
											if(strtolower($leaves['leave_status']) == 'held'|| strtolower($leaves['leave_status']) == 'returned'){?>
											<button id ="edit" class="btn-mini btn-primary" 
											onclick="goEdit('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Edit</button>
												&nbsp;
											<?php }?>
												
											<button id ="print" class="btn-mini btn-success" 
											onclick="goPrint('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto" ><i 
												class="icon-pencil icon-white"></i> View</button>
											</td>
										</tr>
										
								<?php	}
								}else{
									$s2=0;
									echo '<tr><td colspan="9">No records found!</td></tr>';
								}
							?>
						</tbody>
					
					</table>
					
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