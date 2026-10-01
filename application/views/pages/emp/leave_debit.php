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
			If your Leave Recommending Authority, in cases where it is required, or Leave Sanctioning Authority is unable to view your leave, you have not selected Leave Recommending Authority or Leave Sanctioning Authority properly. Edit the leave and select the Radio Button against your Leave Recommending Authority or Leave Sanctioning Authority. Check all other information and submit it. Updating of information in "My Information" page is important before application of leave !!! 
			</marquee>
		</div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="elCr()" >Other Leave Credited</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab1" onclick="elDr()" >Other Leave Availed</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_leave_debit_availed'); ?>Other Leaves submitted or availed</strong></h4>
				<hr />
				
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Leave :</label>
									<select name="leave_type" class="form-control" required>
										<option value=""> -- Select leave--</option>
										<option data-value="1" value="Child Care Leave"<?php echo $this->input->get('leave_type') == 'Child Care Leave' ? 'selected' : ''?> >Child Care Leave</option>
										<option data-value="2" value="Half Pay Leave"<?php echo $this->input->get('leave_type') == 'Half Pay Leave' ? 'selected' : ''?> >Half Pay Leave</option>
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
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>emp/leave_debit'" value="<?php echo $this->lang->line('clear'); ?>" />
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
								<th style="text-align:center">Joined On</th>
								<th style="text-align:center">LTC/HTC</th>
								<th style="text-align:center">Leave Status</th>
								<th style="text-align:center">Joining Status</th>
								<th style="text-align:center">Action</th>
								<th style="text-align:center">Joining</th>
							</tr>
						</thead>
						<tbody >
						<?php
								if(!empty($leave_credit)){
									$s3=0;
									foreach($leave_credit as $credit){
										$s3 += $credit['no_days']; 
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
											<td><?php echo get_datepicker_date($leaves['joining_dt']) ?></td>
											<td id "leave_st"><?php echo $leaves['block']?></td>
											<td id "leave_st"><?php echo $leaves['leave_status']?></td>
											<td id "leave_st"><?php echo $leaves['joining_status']?></td>
											<td align="center" style = "width: 16%;">
											<?php
											if(strtolower($leaves['leave_status']) == 'submitted'){?>
											<button id ="hold" class="btn-mini btn-warning" 
											onclick="goHold('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Hold</button>
												&nbsp;
											<?php }?>
											<?php
											if(strtolower($leaves['leave_status']) == 'held' || strtolower($leaves['leave_status'])== 'returned'){?>
											<button id ="edit" class="btn-mini btn-primary" 
											onclick="goEdit('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Edit</button>
												&nbsp;
											<?php }?>
											<button id ="print" class="btn-mini btn-success" 
											onclick="goPrint('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto" ><i 
												class="icon-pencil icon-white"></i> View</button>
											</td>
											<td align="center">
											<?php
											if((strtolower($leaves['leave_status']) == 'sanctioned'|| strtolower($leaves['leave_status']) == 'recommended' || strtolower($leaves['leave_status']) == 'submitted') && (strtolower($leaves['joining_status']) == 'pending')){?>
											<button id ="join" class="btn-mini btn-success" 
											onclick="goJoining('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i>Join</button>
												&nbsp;
											<?php } else{
											if((strtolower($leaves['leave_status']) == 'sanctioned'|| strtolower($leaves['leave_status']) == 'recommended' || strtolower($leaves['leave_status']) == 'submitted') && (strtolower($leaves['joining_status'])== 'submitted')){?>
											<button id ="join" class="btn-mini btn-primary" 
											onclick="goJoining('<?php echo $leaves['leav_id'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Edit</button>
												&nbsp;
											<?php }}?>
											</td>
										</tr>
										
								<?php	}
								}else{
									$s2=0;
									echo '<tr><td colspan="11">No records found!</td></tr>';
								}
							?>
						</tbody>
					
					</table>
					
			<div>
				<table>
					<tr>
						<td style="text-align:left">** Balance leave Uploaded </td>
						<td style="text-align:right"> <?php
								if(!empty($upload_balance)){
									$s4=0;
									foreach($upload_balance as $balance){											
											echo date('d-m-Y',strtotime($balance['as_on'])) ?>   :  <?php echo $balance['leave_cb'];    
											$s4=$balance['leave_cb']; 
									}
								}else{
									$s4=0;
									echo '0';
								}?>
						</td>
					</tr>
					<tr>
						<td style="text-align:left">** Leave credited :</td>
						<td style="text-align:right">  <?php echo $s3; ?> </td> 
					</tr>
					<tr>
						<td style="text-align:left">** Total Credited Leave :</td>
						<td style="text-align:right" > <?php  //echo $s4 + $s3; 
							if(!empty($current_balance)){
								foreach($current_balance as $cbalance){	
									if ($cbalance['leave_type']== 'Earned Leave'){
										if ($cbalance['leave_cb']>300){
											//echo '300'; echo ' + '; echo $cbalance['leave_cb']-300;
										}else{
											echo  $s4 + $s3;
										}
									}else{
										echo $s4 + $s3;
									}
								}
							}
							?> 
						<td>						
					</tr>
					<tr>
						<td style="text-align:left">** Leave Availed :</td>
						<td style="text-align:right">
						<?php 
							if(!empty($current_balance)){
									foreach($current_balance as $cbalance){	
										if ($cbalance['leave_type'] == 'Earned Leave' && $cbalance['leave_cb']>300){
											//echo 'Not Counted';
										}else{
											echo $s2;
										}
									}
							}
						?> 
						</td>   
					</tr>
					<tr>
						<td style="text-align:left"><b>** Present  Balance :</b></td>
						<td style="text-align:right"><b> <?php
								if(!empty($current_balance)){
									$s5=0;
									foreach($current_balance as $cbalance){	
										$s5=$cbalance['leave_cb']; 
										//echo date('d-m-Y',strtotime($balance['as_on'])) ?>    
											<?php 
											if ($cbalance['leave_type']== 'Earned Leave'){
												if ($cbalance['leave_cb']>300){
													echo '300'; echo ' + '; echo $cbalance['leave_cb']-300;;
												}else{
													echo $cbalance['leave_cb'];
												}
											}else{
												echo $cbalance['leave_cb'];
											}
									}
								}else{
									$s5=0;
									echo '0';
								}?> <b/></td>
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
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_application_hold/' + id;
		}
    }
}

function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_application_edit/' + id;
    }
}
function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_application_print/' + id;
    }
}
function goJoining(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/leave_joining/' + id;
    }
}
/*
function updateFeedback(id){
	var visit_for = $('input[name=visit_for]:checked').val();
	$('#visit_for_'+id).html(visit_for);
	$("#myModal").modal("toggle");
	$.post('<?php echo base_url()?>admin/feedback/update/'+id,{'visit_for':visit_for,'<?php echo $csrf['name'];?>':'<?php echo $csrf['hash'];?>'},function(data){
		var obj = $.parseJSON(data);
		alert(obj.msg);
	});
	
}

function goHold(id){
	if(id == undefined){
		alert('Wrong input!');
	}
	type = $('#visit_for_'+id).html();
	var html = '<div class="control-form">';
	html += '<label class="control-label" style="font-weight:bold">Purpose of Visit :</label>';
	html += '<div class="controls">';
	html += '<label><input type="radio" name="visit_for" '+ (type == 'General' ? 'checked' : '') +' value="General" style="margin: 0 5px;">General</label>';
    html += '<label><input type="radio" name="visit_for" '+ (type == 'Administrative' ? 'checked' : '') +' value="Administrative" style="margin: 0 5px;">Administrative</label>';
	html += '</div>';
	html += '</div>';
	html += '<br/>';
	html += '<div class="control-form">';
	html += '<div class="controls">';
	html += '<input type="submit" value="Update" onclick="updateFeedback('+id+')" />';
	html += '</div>';
	html += '</div>';
	$('#row_details').html(html);
	$("#myModal").modal("toggle");
}
*/
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