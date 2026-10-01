<style>
.table1 td{text-align:center;
		   font-size:12px;
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo;Feedback</div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('leave_sanctioned'); ?> Grievances for Action </strong></h4>
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
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Feedback No / Mobile No:</label>
									<input id = "search" name="search" class="form-control" placeholder = "Feedback No / Mobile No"/>
								</div>
								<div class="col-sm-4">
									<label class="name-label">Select Group :</label>
									<select id = "visit_for" name="visit_for" class="form-control" >
											<option value=""> -- Select Group--</option>
											<option data-value="1" value="General">General</option>
											<option data-value="1" value="Administrative">Administrative</option>
											<option data-value="1" value="Accounts">Accounts</option>
											<option data-value="1" value="Provident Fund">Provident Fund</option>
											<option data-value="1" value="Pension">Pension</option>
										</select>
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
							</div>
						</div>
				</form>
				<div class="form-group row">	
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style=" font-size:11px;text-align:center">Sl No</th>
								<th style=" font-size:11px;text-align:center">ID / Date</th>
								<th style=" font-size:11px;text-align:center">Submitted By</th>
								<th style=" font-size:11px;text-align:center">Group /GPF No </th>
								<th style=" font-size:11px;text-align:center">Description</th>
								<th style=" font-size:11px;text-align:center">Status</th>
								<th style=" font-size:11px;text-align:center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									foreach($results as $row){?>
										<tr>
												<td><?php echo $sl++ ?></td>
												<td><span style=" font-size:13px; font-weight: bold"><?php echo $row['feed_id'] ?></span><br><?php echo get_datepicker_date($row['feed_date']) ?></td>
												<td><?php echo $row['name'] ?><br><?php echo $row['mobile'] ?></td>
												<td><?php echo $row['visit_for'] ?><br><?php echo $row['gpf_no'] ?></br></td>
												<td style="font-size:11px;text-align:left; color: ">Description:<?php echo $row['details'] ?><br>
												<i>
												<?php if(!empty($row['administration_action_taken'])){ ?>
												Administration:-- <?php echo $row['administration_action_taken'] ?><br> 
												<?php }
												if(!empty($row['accounts_action_taken'])){
												?>
												Accounts:-- <?php echo $row['accounts_action_taken'] ?></br>
												<?php }
												if(!empty($row['fund_action_taken'])){
												?>
												Fund:-- <?php echo $row['fund_action_taken'] ?></br>
												<?php }
												if(!empty($row['pension_action_taken'])){
												?>
												Pension:-- <?php echo $row['pension_action_taken'] ?></i>
												<?php }												?>
												</td>
												<td id "leave_st"><?php echo $row['status']?>
												<?php 
												$date1=date_create(date('Y-m-d',strtotime($row['feed_date'])));
												$date2=date_create(date('Y-m-d',strtotime($row['due_date'])));
												$diff=date_diff($date1,$date2);
												$diffDays= intval($diff->format("%d"));
												if($diffDays < 6 ){
												?>
												<img width="20" height="20" title="Less than 5 days" src="<?php echo base_url()?>assets/images/flag_red.png" alt="">
												<?php } ?>
												</td>
												<td>
												<button id ="edit" class="btn-mini btn-primary" 
												onclick="goEdit('<?php echo $row['feed_id'] ?>')" ><i 
													class="icon-pencil icon-white"></i>Action</button>
												<br><span>&nbsp;</span>
												<button id ="edit" class="btn-mini btn-warning" 
												onclick="goClose('<?php echo $row['feed_id'] ?>')" ><i 
													class="icon-pencil icon-white"></i>&nbsp;Close&nbsp;</button></br>
												</td>
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
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/feedback_update/' + id;
    }
}
function goClose(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/grievance_close/' + id;
    }
}
</script>
